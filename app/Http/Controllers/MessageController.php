<?php

namespace App\Http\Controllers;

use App\Events\MessagePublished;
use App\Hashtag;
use App\Media;
use App\Setting;
use App\Timeline;
use App\User;
use App\UserProfile;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Teepluss\Theme\Facades\Theme;
use Illuminate\Pagination\LengthAwarePaginator;

class MessageController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->checkCensored();
        
        $this->middleware('auth');
    }

    protected function checkCensored()
    {
        $messages['not_contains'] = 'The :attribute must not contain banned words';
        if($this->request->method() == 'POST') {
            // Adjust the rules as needed
            $this->validate($this->request, 
                [
                  'name'          => 'not_contains',
                  'about'         => 'not_contains',
                  'title'         => 'not_contains',
                  'description'   => 'not_contains',
                  'tag'           => 'not_contains',
                  'email'         => 'not_contains',
                  'body'          => 'not_contains',
                  'link'          => 'not_contains',
                  'address'       => 'not_contains',
                  'website'       => 'not_contains',
                  'display_name'  => 'not_contains',
                  'key'           => 'not_contains',
                  'value'         => 'not_contains',
                  'subject'       => 'not_contains',
                  'username'      => 'not_contains',
                  'email'         => 'email',
                ],$messages);
        }
    }

    /**
     * Show all of the message threads to the user.
     *
     * @return \Response
     */
    public function index()
    {
        $trending_tags = Hashtag::orderBy('count', 'desc')->get();
        if (count($trending_tags) > 0) {
            if (count($trending_tags) > (int) Setting::get('min_items_page')) {
                $trending_tags = $trending_tags->random((int) Setting::get('min_items_page'));
            }
        } else {
            $trending_tags = '';
        }

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(trans('common.messages').' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('messenger.index', compact('trending_tags'))->render();
    }

    /**
     * Shows a thread.
     *
     * @param $id
     *
     * @return \Response
     */
    public function show($id)
    {
        try {
            if (empty($id)) throw new \Exception('No thread id');
            if (!is_numeric($id)) throw new \Exception('Incorrect thread id');
            $thread = Thread::find($id);
            if (empty($thread)) throw new \Exception('Thread not found');
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }

        $userId = Auth::id();

        if (empty(Participant::where('thread_id', $id)->where('user_id', $userId)->first(['id']))) {
            return abort(404);
        }

        if ($thread->type == 'dialog') {
            $result = $this->prepareDialogFields($thread->toArray());
        } else {
            $result = $this->prepareGroupFields($thread->toArray());
        }
        
        $result['conversationMessages'] = $thread->messages()->withTrashed()->latest()->with('user')->paginate(15);
        $result['participants'] = $thread->participants()->where('user_id', $userId)->first(['last_read']);
        return response()->json($result);
    }

    /**
     * Create dialog
     *
     * @return \Response
     */
    public function createDialog()
    {
        $userId = $this->request->get('user', '');

        try {
            if (empty($userId)) throw new \Exception('No recipient');
            if (!is_numeric($userId)) throw new \Exception('Incorrect recipient');
            $recipientId = User::where('id', $userId)->value('id');
            $userDialogIds = $this->threadJoinParticipantQuery()
                ->where('participants.user_id', Auth::id())
                ->where('threads.type', 'dialog')
                ->pluck('threads.id');

            $dialog = Participant::where('user_id', $recipientId)
                ->whereIn('thread_id', $userDialogIds)
                ->first();

            if(!empty($dialog)){
                $Thread=Thread::where('id',$dialog->thread_id)->first();
                $Thread->updated_at=Carbon::now();
                $Thread->save();
            }
            else{
                $dialog = new Thread();
                $dialog->type = 'dialog';
                $dialog->subject = '';
                $dialog->save();
                $dialog->addParticipant([Auth::id(), $recipientId]);
            }

            return response()->json($this->prepareDialogFields($dialog->toArray()));
        } catch (\Exception $e) {
            return abort(400, $e->getMessage());
        };


    }

    /**
     * Create group-thread
     *
     * @return \Response
     */
    public function createGroup()
    {
        $res = $this->request->get('recipients', '');
        $subject=$this->request->subject;

        try {
            if (empty($res)) throw new \Exception('No recipients');
            $recipients = explode(',', $res);
            foreach ($recipients as &$id) {
                if (!is_numeric($id)) throw new \Exception('Incorrect recipients');
            }
        } catch (\Exception $e) {
            return abort(400, $e->getMessage());
        };

        $recipients[] = Auth::id();
        $newUserIds = User::whereIn('id', $recipients)->distinct()->pluck('id')->toArray();
        if(!$subject){
            $subject = $this->usersSubjectForGroup($newUserIds);
        }
        $thread = new Thread();
        $thread->type = 'group';
        $thread->subject = $subject;
        $thread->save();
        $thread->addParticipant($newUserIds);

        return response()->json($this->prepareGroupFields($thread->toArray()));
    }

    /**
     * add Participants
     *
     * @param $id int
     *
     * @return \Response
     */
    public function addParticipant($id){

        $newUserIds=explode(",", $this->request->get('recipients'));
        $thread=Thread::where('id',$id)->first();
        $thread->addParticipant($newUserIds);
        return response()->json($this->prepareGroupFields($thread->toArray()));
    }


    public function renameGroup($id){
        $subject = trim($this->request->get('subject', ''));

        $threadId = Participant::where([['thread_id', '=', (int) $id], ['user_id', '=', Auth::id()]])->value('thread_id');
        if (empty($threadId)) return abort(404, 'Incorrect thread id');

        $thread = Thread::where([['id', '=', $threadId], ['type', '=', 'group']])->first();
        if (empty($thread)) return abort(404, 'Incorrect thread id');

        $thread->subject=$subject;
        $thread->save();

        return response()->json(['status' => '200', 'thread' => $thread]);
    }
    /**
     * Edit group-thread
     *
     * @param $id int
     *
     * @return \Response
     */
    public function editGroup($id)
    {
        $res = $this->request->get('recipients', '');
        $subject = trim($this->request->get('subject', ''));

        try {
            if (empty($id)) throw new \Exception('No thread id');
            if (!is_numeric($id)) throw new \Exception('Incorrect thread id');
            $threadId = Participant::where([['thread_id', '=', $id], ['user_id', '=', Auth::id()]])
                ->value('thread_id');
            if (empty($threadId)) throw new \Exception('Incorrect thread id');
            $thread = Thread::where([['id', '=', $threadId], ['type', '=', 'group']])->first();
            if (empty($thread)) throw new \Exception('Incorrect thread id');
            $recipients = empty($res) ? [] : explode(',', $res);
            if (count($recipients)) {
                foreach ($recipients as &$i) {
                    if (!is_numeric($i)) throw new \Exception('Incorrect recipients');
                }
                $newUserIds = User::whereIn('id', $recipients)->distinct()->pluck('id')->toArray();
                if (empty($newUserIds)) throw new \Exception('Incorrect recipients');
            } else {
                throw new \Exception('Incorrect recipients');
            }
        } catch (\Exception $e) {
            return abort(400, $e->getMessage());
        };

        $currentParticipants = $thread->participants()->withTrashed()->get();

        //if (empty($newUserIds)) {
        //    $thread->removeParticipant($currentParticipants->pluck('user_id')->toArray());
        //    return response()->json(null);
        //}

        $thread->subject = empty($subject) ? $this->usersSubjectForGroup($newUserIds) : $subject;
        $thread->save();

        $add = array_diff($newUserIds, $currentParticipants->pluck('user_id')->toArray());
        foreach ($currentParticipants as $participant) {
            if (in_array($participant->user_id, $newUserIds)) {
                if ($participant->deleted_at) $participant->restore();
            } elseif ($participant->user_id == Auth::id()) {
                if (!$participant->deleted_at) $participant->delete();
            }
        }
        $thread->addParticipant($add);

        return response()->json($this->prepareGroupFields($thread->toArray()));
    }

    /**
     * Generate subject for group-thread on by users names
     *
     * @param $recipients array
     *
     * @return string
     */
    private function usersSubjectForGroup(array $userIds) {
        return UserProfile::whereIn('user_id', $userIds)
            ->distinct()
            ->take(3)
            ->get(['firstname', 'lastname'])
            ->map(function ($name) {return $name->firstname . (empty($name->lastname) ? '' : ' ' . $name->lastname);})
            ->implode(', ');
    }

    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     *
     * @return \Response
     */
    public function update($id)
    {
        try {
            if (empty($id)) throw new \Exception('No thread id');
            if (!is_numeric($id)) throw new \Exception('Incorrect thread id');
            if (!$this->request->has('message')) throw new \Exception('No message');
            $message = trim($this->request->get('message'));
            if (empty($message)) throw new \Exception('Empty message');
            $thread = Thread::find($id);
            if (empty($thread)) throw new \Exception('Thread not found');
            $participants = $thread->participants()->get();
            $userParticipant = $participants->first(function ($participant) {
                return $participant->user_id == Auth::id();
            });
            if (empty($userParticipant)) throw new \Exception('You do not have permission write to this thread');
        } catch (\Exception $e) {
            return abort(400, $e->getMessage());
        }


        // Message
        $message = Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::id(),
                'body'      => $message,
            ]
        );

        $userParticipant->last_read = new Carbon();
        $userParticipant->save();

        foreach ($participants as $participant) {
            $subject = '';
            if ($thread->type == 'dialog') $subject = Auth::user()->name;
            if ($thread->type == 'group') $subject = $thread->subject;
            $this->pushEvent(
                $message,
                $participant->user,
                'newMessage',
                ['type' => $thread->type, 'subject' => $subject]
            );
        }

/*        // Add replier as a participant
        $participant = Participant::firstOrCreate(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
            ]
        );*/

        return response()->json(null);
    }

    /**
     * Delete message from thread
     *
     * @param $id
     *
     * @return \Response
     */
    public function deleteMessage($id)
    {
        try {
            if (empty($id)) throw new \Exception('No message id');
            if (!is_numeric($id)) throw new \Exception('Incorrect message id');
            $message = Message::find($id);
            if (empty($message)) throw new \Exception('Message not found');
            if ($message->user_id !== Auth::id()) throw new \Exception("You not have permission to delete $id message");
        } catch (\Exception $e) {
            return abort(400, $e->getMessage());
        }

        $message->body = null;
        $message->save();
        $message->delete();

        $participants = Participant::where('thread_id', $message->thread_id)->get();

        foreach ($participants as $participant) {
            $this->pushEvent(
                $message,
                $participant->user,
                'deleteMessage'
            );
        }

        return response()->json(null);
    }

    /**
     * Get threads
     *
     * @return \Response
     */
    public function getThreads()
    {
        $threadType = $this->request->get('type', '');
        $paginate = 15;

        $data = $this->filterThreads([], $threadType);
        $result = $this->paginateAndPrepareFields($data, $paginate);

        return response()->json($result);
    }

    /**
     * Filter for messenger
     * return each item limit 10 no pagination
     *
     * @return \Response
     */
    public function filter()
    {
        $searchStr = trim($this->request->get('search', ''));
        $searchWords = empty($searchStr) ? [] : preg_split("#\s+#", $searchStr);
        $threadType = $this->request->get('type', '');
        if (empty($searchStr) && empty($searchWords) && empty($threadType)) return response()->json(['error' => 'noparams']);
        $limit = 10;
        $data = $result = [];

        if (empty($threadType)) {
            $data['dialog'] = $this->filterThreads($searchWords, 'dialog')->slice(0, $limit);
            $data['group'] = $this->filterThreads($searchWords, 'group')->slice(0, $limit);
        } else {
            $data[$threadType] = $this->filterThreads($searchWords, $threadType)->slice(0, $limit);
        }

        $friendsIds = $this->getFriendsIds();
        $data['friend'] = $this->getUsersByName($searchWords, $limit, ['inUserIds' => empty($friendsIds) ? [0] : $friendsIds]);
        $data['newuser'] = $this->getUsersByName($searchWords, $limit, ['noUserIds' => $data['friend']->pluck('id')->all()]);

        foreach ($data as $type => $items) {
            $pre = [];
            foreach ($items->toArray() as $item) {
                if (($type == 'newuser') || ($type == 'friend')) $pre[] = $this->prepareUserFields($item, $type);
                if ($type == 'dialog') $pre[] = $this->prepareDialogFields($item);
                if ($type == 'group') $pre[] = $this->prepareGroupFields($item);
            }
            $result = array_merge($result, $pre);
        }

        $result['params'] = [
            'search' => $searchStr,
            'words' => $searchWords,
            'threadType' => $threadType,
            'data' => $data
        ];

        return response()->json($result);
    }

    /**
     * Search/filter threads by subject and/or type
     *
     * @param $searchWords array
     * @param $threadType string
     *
     * @return Collection
     */
    private function filterThreads(array $searchWords = [], string $threadType = '')
    {
        $data = collect();

        if (!empty($threadType)) {
            if (($threadType !== 'dialog') && ($threadType !== 'group')) $threadType = '';
        }

        if (empty($searchWords)) {
            $data = $this->threadJoinParticipantQuery()
                ->where('participants.user_id', Auth::id());
            if ($threadType) $data->where('threads.type', $threadType);
            $data = $data->latest('updated_at')
                ->get(['threads.id', 'threads.type', 'threads.subject', 'threads.updated_at']);
        } else {
            if ($searchWords[0]{0} == '@') {
                // get only users
                $searchWords[0] = substr($searchWords[0], 1);
                $data = $this->getUsersByName($searchWords);
            } else {
                // get threads by subject
                if ($threadType !== 'dialog') {
                    $threadsQuery = $this->threadJoinParticipantQuery()
                        ->where([
                            ['participants.user_id', '=', Auth::id()],
                            ['type', '=', 'group']
                        ]);
                    foreach ($searchWords as $word) {
                        $threadsQuery->where('threads.subject', 'like', '%' . $word . '%');
                    };
                    $threads = $threadsQuery->get(['threads.id', 'threads.type', 'threads.subject', 'threads.updated_at']);
                    if ($threads->count()) $data = $data->merge($threads);
                }

                // get threads by user name
                $threadIds = $this->threadJoinParticipantQuery()
                    ->where('participants.user_id', Auth::id());
                if ($threadType) $threadIds->where('threads.type', $threadType);
                $threadIds = $threadIds->pluck('threads.id');
                $userIds = Participant::whereIn('thread_id', $threadIds)
                    ->distinct()
                    ->pluck('user_id');
                $usersQuery = UserProfile::whereIn('user_id', $userIds);
                foreach ($searchWords as $word) {
                    $usersQuery->where(function ($query) use ($word) {
                        $query->where('firstname', 'like', '%' . $word . '%')
                            ->orWhere('lastname', 'like', '%' . $word . '%');
                    });
                    //$usersQuery->where('firstname', 'like', '%' . $word . '%');
                };
                $userIds = $usersQuery->pluck('user_id');
                $threadIds = $this->threadJoinParticipantQuery()
                    ->whereIn('participants.user_id', $userIds)
                    ->whereNotIn('threads.id', $data->pluck('id'));
                if ($threadType) $threadIds->where('threads.type', $threadType);
                $threadIds = $threadIds->pluck('threads.id');
                $threads = $this->threadJoinParticipantQuery()
                    ->where('participants.user_id', Auth::id())
                    ->whereIn('threads.id', $threadIds)
                    ->get(['threads.id', 'threads.type', 'threads.subject', 'threads.updated_at']);
                if ($threads->count()) $data = $data->merge($threads);

                // sorting threads
                $data = $data->sortByDesc('updated_at');
            }
        }

        return $data;
    }

    /**
     * Paginate collection (with preparing fields)
     *
     * @param $data Collection
     * @param $paginate int
     *
     * @return array
     */
    private function paginateAndPrepareFields(Collection $data, int $paginate)
    {
        $path = $this->request->path();
        if ($paginate < 1) $paginate = 10;
        $page = (int)$this->request->get('page', 1);
        if ($page < 1) $page = 1;

        $count = $data->count();
        $result = (new LengthAwarePaginator($data, $count, $paginate, $page))->toArray();
        $result['data'] = array_slice($result['data'], ($paginate * ($page - 1)), $paginate);

        // prepare result fields
        foreach ($result['data'] as &$item) {
            if ($item['type'] == 'dialog') $item = $this->prepareDialogFields($item);
            if ($item['type'] == 'group') $item = $this->prepareGroupFields($item);
        };

        // paginate urls
        $result['path'] = $this->request->url();
        $searchUrlParam = $this->request->has('search') ? '&search=' . $this->request->get('search') : '';
        if (!empty($result['next_page_url'])) {
            $result['next_page_url'] = url($path
                . substr($result['next_page_url'], 1)
                . $searchUrlParam);
        }
        if (!empty($result['prev_page_url'])) {
            $result['prev_page_url'] = url($path
                . substr($result['prev_page_url'], 1)
                . $searchUrlParam);
        }

        return $result;
    }

    /**
     * Prepare user fields for response
     *
     * @param $item array
     * @param $type string
     *
     * @return array
     */
    private function prepareUserFields(array $item, string $type = 'newuser')
    {
        return [
            'type'          => $type,
            'avatar'        => $this->getAvatarUrl($item['avatar'], $item['gender']),
            'id'            => $item['id'],
            'subject'       => $item['firstname'] . ' ' . $item['lastname'],
            'updated_at'    => $item['created_at'],
            'text'          => __('messages.create_a_new_message'),
            'online'        => ($item['last_online'] > (time() - config('app.online_timeout'))) ? true : false
        ];
    }

    /**
     * Prepare dialog fields for response
     *
     * @param $item array
     *
     * @return array
     */
    private function prepareDialogFields(array $item)
    {
        $userId = Participant::where('thread_id', $item['id'])
            ->where('user_id', '<>', Auth::id())
            ->value('user_id');
        $user = User::where('id', $userId)
            ->first(['timeline_id', 'last_online']);
        $username = Timeline::where('id', $user->timeline_id)->value('username');
        $profile = UserProfile::where('user_id', $userId)->first(['firstname', 'lastname', 'avatar', 'gender']);

        return [
            'type'                  => 'dialog',
            'avatar'                => $this->getAvatarUrl($profile->avatar, $profile->gender),
            'id'                    => $item['id'],
            'subject'               => $profile->firstname . ' ' . $profile->lastname,
            'updated_at'            => $item['updated_at'],
            'text'                  => $this->getLastMessage($item['id']),
            'unreadedMessagesCount' => $this->unreadedMessagesCount(Auth::id(), $item['id']),
            'online'                => ($user->last_online > (time() - config('app.online_timeout'))) ? true : false,
            'username'              => $username
        ];
    }

    /**
     * Prepare group-thread fields for response
     *
     * @param $item array
     *
     * @return array
     */
    private function prepareGroupFields(array $item)
    {
        $userIds = Participant::where('thread_id', $item['id'])->pluck('user_id');
        $users = User::whereIn('users.id', $userIds)
            ->get(['id', 'timeline_id'])
            ->map(function ($user) {
                $username = Timeline::where('id', $user->timeline_id)->value('username');
                $profile = UserProfile::where('user_id', $user->id)->first(['firstname', 'lastname', 'avatar', 'gender']);
                return [
                    'id'        => $user->id,
                    'username'  => $username,
                    'name'      => $profile->firstname . ' ' . $profile->lastname,
                    'avatar'    => $this->getAvatarUrl($profile->avatar, $profile->gender)
                ];
            });

        return [
            'type'                  => 'group',
            //'avatar'                => url('group/avatar/default-group-avatar.png'),
            'avatar'                => collect($users)->pluck('avatar')->take(3)->all(),
            'id'                    => $item['id'],
            'subject'               => $item['subject'],
            'updated_at'            => $item['updated_at'],
            'text'                  => $this->getLastMessage($item['id']),
            'unreadedMessagesCount' => $this->unreadedMessagesCount(Auth::id(), $item['id']),
            'users'                 => $users
        ];
    }

    /**
     * Generate avatar url
     *
     * @param $avatar string
     * @param $gender string
     *
     * @return string
     */
    private function getAvatarUrl($avatar = '', $gender = 'other')
    {
        $result = 'default-' . $gender . '-avatar.png';
        if (!empty($avatar)) $result = $avatar;
        return url('user/avatar/' . $result);
    }

    private function getFriendsIds()
    {
        $result = collect();
        $friendType = config('friend.type', ['approve' => 3]);

        $followers = \DB::table('followers')
            ->where('type_friend', $friendType['approve'])
            ->where(function ($query) {
                $query->where('follower_id', Auth::id())
                    ->orWhere('leader_id', Auth::id());
            })
            ->get(['follower_id', 'leader_id']);
        foreach ($followers as $follower) {
            foreach ($follower as $id) {
                if ($id != Auth::id()) $result->push($id);
            }
        }
        return $result->unique()->all();
    }

    /**
     * Search users by name
     *
     * @param $words array
     * @param $limit int
     * @param $filter array
     *
     * @return Collection
     * user: id, gender, last_online, created_at, name, avatar_id, type = newuser
     */
    private function getUsersByName(array $words, int $limit = 0, array $filter = [])
    {
        if (!$words) return collect();
        if ($limit < 1) return collect();

        // get thread_id with current user and type = dialog -> dialogs of current user
        $userDialogIds = $this->threadJoinParticipantQuery()
            ->where([['participants.user_id', '=', Auth::id()], ['threads.type', '=', 'dialog']])
            ->pluck('threads.id');
        // get user_id of participants in user dialogs
        $dialogUserIds = Participant::whereIn('thread_id', $userDialogIds)->distinct()->pluck('user_id');
        $dialogUserIds[] = Auth::id();
        // prepare user ids query without users in dialog with current user
        $query = UserProfile::whereNotIn('user_id', $dialogUserIds);
        // check if need filter users in certain ids
        if (!empty($filter['inUserIds']) && is_array($filter['inUserIds'])) {
            $query->whereIn('user_id', $filter['inUserIds']);
        }
        // check if need filter users exclude ids
        if (!empty($filter['noUserIds']) && is_array($filter['noUserIds'])) {
            $query->whereNotIn('user_id', $filter['noUserIds']);
        }
        // add filter by name
        foreach ($words as $word) {
            $query->where(function ($query) use ($word) {
                $query->where('firstname', 'like', '%' . $word . '%')
                    ->orWhere('lastname', 'like', '%' . $word . '%');
            });
        }
        // limit
        if ($limit) $query->take($limit);
        // get result
        $userIds = $query->pluck('user_id');
        // get users
        $query = User::whereIn('id', $userIds);
        $result = $query
            ->get(['id', 'last_online', 'created_at'])
            ->map(function ($user) {
                $user['type'] = 'newuser';
                return $user;
            });
        return $result;
    }

    /**
     * Get last message body in thread
     *
     * @param $threadId int
     *
     * @return string
     */
    private function getLastMessage(int $threadId) {
        $message = Message::where('thread_id', $threadId)
            ->latest()->value('body');
        return $message;
    }

    /**
     * Get unreaded messages count in thread
     *
     * @param $userId int
     * @param $threadId int
     *
     * @return int
     */
    private function unreadedMessagesCount(int $userId, int $threadId)
    {
        $lastRead = Participant::where([
            ['thread_id', '=', $threadId],
            ['user_id', '=', $userId]])
            ->value('last_read');
        return Message::where([
            ['thread_id', '=', $threadId],
            ['created_at', '>', (empty($lastRead) ? 0 : $lastRead)]])
            ->count('id');
    }

    /**
     * Get unreaded threads counters
     *
     * @param $userId int
     * @param $types array based on ['threads', 'dialog', 'group']
     * @param $threadId int
     *
     * @return array
     * unreadedThreadsCount = all unreaded threads counter
     * unreadedDialogCount = unreaded dialogs counter
     * unreadedGroupCount = unreaded group threads counter
     * unreadedMessagesCount = unreaded messages count in thread
     */
    private function unreadedThreadsCount(int $userId, array $types = ['threads', 'dialog', 'group'], int $threadId = 0)
    {
        $result = [];
        $types = array_intersect(['threads', 'dialog', 'group'], $types);
        foreach ($types as $type) {
            $query = $this->threadJoinParticipantQuery()
                ->where('participants.user_id', '=', $userId)
                ->whereRaw('`participants`.`last_read` < `threads`.`updated_at`');
            if ($type !== 'threads') $query->where('threads.type', $type);
            $result['unreaded'.ucfirst($type).'Count'] = $query->count('threads.id');
        }
        if (!empty($threadId)) $result['unreadedMessagesCount'] = $this->unreadedMessagesCount($userId, $threadId);
        return $result;
    }

    /**
     * Start 'threads' join 'participants' query
     *
     * @return mixed
     */
    private function threadJoinParticipantQuery() {
        return Thread::join('participants', 'threads.id', '=', 'participants.thread_id')
            ->whereNull('participants.deleted_at')
            ->distinct();
    }

    /**
     * Mark messages as readed and send Pusher notification
     *
     * @return \Response
     */
    public function markReadMessage()
    {
        if (!$this->request->has('id')) return abort(400, 'No id(s)');
        $ids = $this->request->get('id');
        if (empty($ids)) return abort(400, 'Bad id(s)');
        if (!is_array($ids)) $ids = [$ids];
        foreach ($ids as &$id) {
            if (!is_numeric($id)) return abort(400, 'Incorrect id(s)');
        }
        $messages = Message::whereIn('id', $ids)->latest()->with('user')->get();
        if (empty($messages)) return abort(400, 'Message(s) not found');
        if ($messages->pluck('thread_id')->unique()->count() > 1) {
            return abort(400, 'Messages in different threads');
        }
        $participant = Participant::where([
            ['user_id', '=', Auth::id()],
            ['thread_id', '=', $messages->first()->thread_id]
        ])->first();
        if (empty($participant)) return abort(400, 'You do not have permission to read message(s) in foreign thread');

        if ($participant->last_read < $messages->first()->created_at) {
            $readedMessageIds = $messages->where('created_at', '>', $participant->last_read)->pluck('id');
            $participant->last_read = $messages->first()->created_at;
            $participant->save();
        }

        $this->pushEvent(
            $messages->first(),
            Auth::user(),
            'readMessage',
            ['readedMessageIds' => empty($readedMessageIds) ? 0 : $readedMessageIds]
        );

        return response()->json(null);
    }

    /**
     * @param $message Message
     * @param $receivers User
     * @param $action string
     * @param $params array
     *
     * @return void
     */
    private function pushEvent(Message $message, User $receiver, string $action, array $params = [])
    {
        event(new MessagePublished(
            $message,
            $receiver,
            $this->unreadedThreadsCount($receiver->id, ['threads', 'dialog'], $message->thread_id),
            $action,
            array_merge(['threadId' => $message->thread_id], $params)
        ));
        return;
    }

    /**
     * Get unreaded threads counters
     *
     * @return \Response
     */
    public function getUnreadThreads()
    {
        $params = [Auth::id()];
        if ($this->request->has('type')) {
            $params[] = is_array($this->request->get('type'))
                ? $this->request->get('type')
                : [$this->request->get('type')];
        }
        return response()->json(call_user_func_array([$this, 'unreadedThreadsCount'], $params));
    }

    /**
     * Get list for friends-right-bar
     *
     * @return \Response
     */
    public function getContacts()
    {
        $paginate = 30;

        $data = $this->filterThreads([], 'dialog');
        $result = $this->paginateAndPrepareFields($data, $paginate);

        return response()->json($result);
    }
}
