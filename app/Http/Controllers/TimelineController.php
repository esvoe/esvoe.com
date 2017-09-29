<?php

namespace App\Http\Controllers;

use Alaouy\Youtube\Facades\Youtube;
use App\Album;
use App\Announcement;
use App\Application;
use App\ApplicationUser;
use App\Category;
use App\Comment;
use App\Event;
use App\Group;
use App\Hashtag;
use App\Http\Requests\CreateTimelineRequest;
use App\Http\Requests\UpdateTimelineRequest;
use App\Media;
use App\Notification;
use App\Page;
use App\Post;
use App\Repositories\TimelineRepository;
use App\Role;
use App\Setting;
use App\Timeline;
use App\User;
use App\UserProfile;
use App\Wallpaper;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Thread;
use DB;
use File;
use Flash;
use Flavy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use LinkPreview\LinkPreview;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Storage;
use Teepluss\Theme\Facades\Theme;
use Validator;

class TimelineController extends AppBaseController
{
    /** @var TimelineRepository */
    private $timelineRepository;

    public function __construct(TimelineRepository $timelineRepo, Request $request)
    {
        $this->timelineRepository = $timelineRepo;
        $this->watchEventExpires();

        $this->request = $request;
        $this->checkCensored();
    }

    protected function checkCensored()
    {
        $messages['not_contains'] = 'The :attribute must not contain banned words';
        if ($this->request->method() == 'POST') {
            // Adjust the rules as needed
            $this->validate($this->request,
                [
                    'name' => 'not_contains',
                    'about' => 'not_contains',
                    'title' => 'not_contains',
                    'description' => 'not_contains',
                    'tag' => 'not_contains',
                    'email' => 'not_contains',
                    'body' => 'not_contains',
                    'link' => 'not_contains',
                    'address' => 'not_contains',
                    'website' => 'not_contains',
                    'display_name' => 'not_contains',
                    'key' => 'not_contains',
                    'value' => 'not_contains',
                    'subject' => 'not_contains',
                    'username' => 'not_contains',
                    'username' => 'not_contains',
                    'email' => 'email',
                ], $messages);
        }
    }

    public function watchEventExpires()
    {
        if (Auth::user()) {
            $events = Event::whereStrict('user_id', Auth::user()->id)->get();

            if ($events) {
                foreach ($events as $event) {
                    if (strtotime($event->end_date) < strtotime('-2 week')) {
                        $event->delete();
                        $event->timeline->delete();
                    }
                }
            }
        }

    }

    /**
     * Display a listing of the Timeline.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->timelineRepository->pushCriteria(new RequestCriteria($request));
        $timelines = $this->timelineRepository->all();

        return view('timelines.index')
            ->with('timelines', $timelines);
    }

    /**
     * Show the form for creating a new Timeline.
     *
     * @return Response
     */
    public function create()
    {
        return view('timelines.create');
    }

    /**
     * Store a newly created Timeline in storage.
     *
     * @param CreateTimelineRequest $request
     *
     * @return Response
     */
    public function store(CreateTimelineRequest $request)
    {
        $input = $request->all();

        $timeline = $this->timelineRepository->create($input);

        Flash::success('Timeline saved successfully.');

        return redirect(route('timelines.index'));
    }

    /**
     * Display the specified Timeline.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function showTimeline($username)
    {
        $admin_role_id = Role::where('name', '=', 'admin')->first();
        $posts = [];
        $timeline = Timeline::where('username', $username)->first();
        if (empty($timeline)) {
            $timelineId = User::where('esvoe_id', $username)->value('timeline_id');
            $timeline = Timeline::find($timelineId);
        }
        $user_post = '';
        $curStatuses = '';

        if ($timeline == null) {
            return redirect('/');
        }

        $timeline_posts = $timeline->posts()->where('active', 1)->orderBy('created_at',
            'desc')->with('comments')->paginate(Setting::get('items_page'));

        foreach ($timeline_posts as $timeline_post) {
            //This is for filtering reported(flag) posts, displaying non flag posts
            if ($timeline_post->check_reports($timeline_post->id) == false) {
                array_push($posts, $timeline_post);
            }
        }

        if ($timeline->type == 'user') {
            $type_friend = 0;
            $is_follower = 0;
            $requestInviteMe = 0;

            $user = User::where('timeline_id', $timeline['id'])->first();
            $user->online = ($user->last_online > (time() - config('app.online_timeout'))) ? true : false;
            $isMe = Auth::user()->id == $user->id;
            $sex = $user->gender;
            $available_relative = $this->getRelative($sex);
            $curStatuses = '';
            $curRelative = 0;
            $own_pages = $user->own_pages();
            $own_groups = $user->own_groups();
            $liked_pages = $user->pageLikes()->get();
            $joined_groups = $user->groups()->get();
            $joined_groups_count = $user->groups()->where('role_id', '!=', $admin_role_id->id)->where('status', '=',
                'approved')->get()->count();
            $user_events = $user->events()->whereDate('end_date', '>=', date('Y-m-d', strtotime(Carbon::now())))->get();
            $guest_events = $user->getEvents();

            $following_count = $user->following()->where('is_follower', '=', '1')->get()->count();
            //$followers_count = $user->followers()->where('is_follower', '=', '1')->get()->count();
            $followRequests = $user->followers()->where('type_friend', '=', '2')->get();

            $counters = [
                'albums' => 0,
                'photos' => 0,
                'videos' => 0,
                'friends' => $user->count_friend,
                'followers' => $user->count_follower,
                'pages' => 0,
                'groups' => 0,
                'events' => 0,
                'apps' => 0
            ];
            // albums
            $albumIds = Album::where('timeline_id', $user->timeline_id)->latest()->pluck('id');
            $counters['albums'] = $albumIds->count();
            $albums_last = Album::whereIn('id', $albumIds)
                ->get(['id', 'name'])
                ->map(function ($album) use ($user, &$counters) {
                    if (!empty($album->previewImage()->first())) {
                        $preview = $album->previewImage()->first()->albumUrl($user->username);
                    } elseif (!empty($album->photos()->first())) {
                        $preview = $album->photos()->first()->albumUrl($user->username);
                    } else {
                        $preview = '#';
                    }
                    $photos_count = 0;
                    $photos = [];
                    $album->photos()->where('media.type', 'image')
                        ->whereNotNull('media.source')
                        ->get()
                        ->each(function ($image) use (&$photos, &$photos_count) {
                            $year = date_create($image->created_at)->format('Y');
                            $photos["$year"][] = $image;
                            $photos_count++;
                        });
                    $videos = $album->photos()->where('media.type', '=', 'youtube')->get();
                    $videos_count = $videos->count();
                    $counters['photos'] += $photos_count;
                    $counters['videos'] += $videos_count;
                    return [
                        'name' => $album->name,
                        'preview' => $preview,
                        'href' => url($user->username . '/album/show/' . $album->id),
                        'photos' => $photos,
                        'videos' => $videos,
                        'photos_count' => $photos_count,
                        'videos_count' => $videos_count
                    ];
                });
            // last photos
            $mediaIds = DB::table('album_media')
                ->whereIn('album_id', $albumIds)
                ->distinct()
                ->pluck('media_id');
            $photos_last = Media::whereIn('id', $mediaIds)
                ->where('type', 'image')
                ->latest()
                ->take(4)
                ->get(['source'])
                ->map(function ($media) use ($user) {
                    return $media->albumUrl($user->username);
                });
            // friends
            $friends_last = $this->getFriendUsersOf($user->id, 6);
            // followers, friends, mutual friends and family
            $relations = [];
            $relations['friends'] = $this->getFriendUsersOf($user->id);
            $relations['followers'] = $user->followers()->where('is_follower', '=', '1')->get();
            $relations['mutual_friends'] = $this->getFriendUsersOf(Auth::id(), 0,
                $relations['friends']->pluck('id')->all());
            //$relations['family'] = [];
            $counters['friends'] = $relations['friends']->count();
            $counters['followers'] = $relations['followers']->count();
            // pages
            $counters['pages'] = $user->pages()->count();
            $pages_last = $user->pages()->latest()->take(2)->get();
            $pages_cat = [];
            foreach ($user->pages()->latest()->get() as $page) {
                $pages_cat[$page->category->name][] = $page;
            }
            // groups
            $groups_count = $user->groups();
            if (!$isMe) {
                $groups_count->where('groups.type', '<>', 'secret');
            }
            $counters['groups'] = $groups_count->count();
            $groups_last = $user->groups();
            if (!$isMe) {
                $groups_last->where('groups.type', '<>', 'secret');
            }
            $groups_last = $groups_last->latest()->take(2)->get()
                ->map(function ($group) {
                    $friends = collect();
                    $members = $group->users()->where('status', 'approved')->pluck('users.id')->all();
                    $isMember = in_array(Auth::id(), $members);
                    if (!empty($members)) {
                        $friends = $this->getFriendUsersOf(Auth::id(), 7, $members);
                    }
                    return [
                        'name' => $group->name,
                        'username' => $group->username,
                        'cover' => empty($group->cover) ? 'default-cover-group.png' : $group->cover,
                        'type' => $group->type,
                        'friends' => $friends,
                        'notMember' => !$isMember,
                        'friends_count' => empty($friendIds) ? 0 : number_format($friendIds->count(), 0, '', ' '),
                        'members_count' => number_format(count($members), 0, '', ' ')
                    ];
                });
            // events
            $events_last = $user->events()->withCount('users')->latest()->get()
                ->map(function ($event) use (&$counters) {
                    $event->cover = empty($event->cover) ? 'default-cover-event.png' : $event->cover;
                    $event->start_date = date_create($event->start_date);
                    $event->users = $event->users()->take(7)->get();
                    $counters['events']++;
                    return $event;
                });
            // applications
            $appsIds = ApplicationUser::where('user_id', $user->id)
                ->where('banned', false)
                ->where('authorized', true)
                ->pluck('app_id');
            $apps = Application::whereIn('id', $appsIds)
                ->whereNotNull('image_main')
                ->get();
            $counters['apps'] = $apps->count();
            $applications_cat = ['other' => []];
            foreach ($apps as $app) {
                $category = $app->category()->value('title');
                if (empty($category)) {
                    $category = 'other';
                }
                $app->ratingStr = empty($app->rating)
                    ? '0,0'
                    : number_format($app->rating['value'], 1, ',', '');
                $applications_cat[$category][] = $app;
            }
            $applications_cat = array_reverse($applications_cat);

            if (!$isMe) {
                $followers = DB::table('followers')
                    ->where('follower_id', '=', Auth::user()->id)
                    ->where('leader_id', '=', $user->id)
                    ->first();
                $following = DB::table('followers')
                    ->where('follower_id', '=', $user->id)
                    ->where('leader_id', '=', Auth::user()->id)
                    ->first();

                if ($followers) {
                    $type_friend = $followers->type_friend;
                    $is_follower = $followers->is_follower;
                    $curRelative = $followers->relative_id;
                    $curStatuses = isset($followers->statuses) ? '' : $followers->statuses;
                }
                if ($following && $following->type_friend == 1) {
                    $requestInviteMe = 1;
                    $type_friend = 4;
                }

                // dialog_id
                $dialog_id = Thread::between([Auth::id(), $user->id])->value('id');
                if (empty($dialog_id)) {
                    $dialog_id = 0;
                }
            }

            $confirm_follow_setting = $user->getUserSettings(Auth::user()->id);
            $follow_confirm = $confirm_follow_setting->confirm_follow;

            //get user settings
            $live_user_settings = $user->getUserPrivacySettings(Auth::user()->id, $user->id);
            $privacy_settings = explode('-', $live_user_settings);
            $timeline_post = $privacy_settings[0];
            $user_post = $privacy_settings[1];
        } elseif ($timeline->type == 'page') {
            $page = Page::where('timeline_id', '=', $timeline->id)->first();
            $page_members = $page->members();
            $user_post = 'page';
        } elseif ($timeline->type == 'group') {
            $group = Group::where('timeline_id', '=', $timeline->id)->first();
            $group_members = $group->members();
            $group_events = $group->getEvents($group->id);
            $ongoing_events = $group->getOnGoingEvents($group->id);
            $upcoming_events = $group->getUpcomingEvents($group->id);
            $user_post = 'group';
        } elseif ($timeline->type == 'event') {
            $user_post = 'event';
            $event = Event::where('timeline_id', '=', $timeline->id)->first();
        }

        $next_page_url = url('ajax/get-more-posts?page=2&username=' . $username);

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle($timeline->name . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('users/timeline',
            compact('user', 'timeline', 'posts', 'liked_pages', 'timeline_type', 'page', 'group', 'next_page_url',
                'joined_groups', 'isMe', 'is_follower', 'type_friend', 'available_relative', 'curStatuses',
                'curRelative', 'requestInviteMe', 'followRequests', 'following_count', 'counters', 'photos_last',
                'albums_last', 'friends_last', 'pages_last', 'pages_cat', 'groups_last', 'events_last', 'relations',
                'applications_cat', 'timeline_post', 'user_post', 'follow_confirm', 'joined_groups_count', 'own_pages',
                'own_groups', 'group_members', 'page_members', 'event', 'user_events', 'guest_events', 'username',
                'group_events', 'ongoing_events', 'upcoming_events', 'dialog_id'))->render();
    }

    private function getFriendUsersOf(int $userId, int $limit = 0, array $inScope = [])
    {
        if (empty($userId)) {
            return collect();
        }

        $friendIdsQuery = DB::table('followers')
            ->where('type_friend', config('friend.type.approve'));

        if (empty($inScope)) {
            $friendIdsQuery->where(function ($query) use ($userId) {
                $query->where('leader_id', $userId)
                    ->orWhere('follower_id', $userId);
            });
        } else {
            $friendIdsQuery->where(function ($query) use ($userId, $inScope) {
                $query->where(function ($query) use ($userId, $inScope) {
                    $query->where('leader_id', $userId)
                        ->whereIn('follower_id', $inScope);
                })
                    ->orWhere(function ($query) use ($userId, $inScope) {
                        $query->whereIn('leader_id', $inScope)
                            ->where('follower_id', $userId);
                    });
            });
        }

        $friendIdsQuery->latest();
        if (!empty($limit)) {
            $friendIdsQuery->take($limit * 3);
        }
        $friendIds = $friendIdsQuery->get(['leader_id', 'follower_id'])
            ->flatMap(function ($ids) {
                return [$ids->leader_id, $ids->follower_id];
            })
            ->unique()
            ->filter(function ($id) use ($userId) {
                return $id != $userId;
            });

        if (!empty($limit)) {
            $friendIds = $friendIds->take($limit);
        }
        $friends = User::find($friendIds->all());

        // looking for relation and mutual friends of current user
        if ($userId != Auth::id()) {
            $friends->transform(function ($user) {
                $follower = DB::table('followers')
                    ->where('follower_id', '=', Auth::user()->id)
                    ->where('leader_id', '=', $user->id)
                    ->first();
                $following = DB::table('followers')
                    ->where('follower_id', '=', $user->id)
                    ->where('leader_id', '=', Auth::user()->id)
                    ->first();

                if ($follower) {
                    $user->type_friend = $follower->type_friend;
                    $user->is_follower = $follower->is_follower;
                    $user->curRelative = $follower->relative_id;
                    $user->curStatuses = isset($follower->statuses) ? '' : $follower->statuses;
                }

                if ($following && $following->type_friend == 1) {
                    $user->requestInviteMe = 1;
                    $user->type_friend = 4;
                }

                return $user;
            });
        }

        return $friends;
    }

    private function getRelative($sex)
    {
        if ($sex != 'female') {
            $isMan = true;
        } else {
            $isMan = false;
        }
        $res = array();
        foreach (config('friend.relative_is_male') as $k => $v) {
            if ($v === $isMan) {
                $res[$k] = config('friend.relative.' . $k);
            }
        }
        return $res;
    }

    public function getMorePosts(Request $request)
    {
        $timeline = Timeline::where('username', $request->username)->first();

        $posts = $timeline->posts()->where('active', 1)->orderBy('created_at',
            'desc')->with('comments')->paginate(Setting::get('items_page'));
        $theme = Theme::uses('default')->layout('default');

        $responseHtml = '';
        foreach ($posts as $post) {
            $responseHtml .= $theme->partial('post', [
                'post' => $post,
                'timeline' => $timeline,
                'next_page_url' => $posts->appends(['username' => $request->username])->nextPageUrl()
            ]);
        }

        return $responseHtml;
    }

    public function showFeed(Request $request)
    {
        $mode = "showfeed";
        $user_post = 'showfeed';
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');

        $timeline = Timeline::where('username', Auth::user()->username)->first();

        $id = Auth::id();

        $trending_tags = trendingTags();
        $suggested_users = suggestedUsers();
        $suggested_groups = suggestedGroups();
        $suggested_pages = suggestedPages();

        // Check for hashtag
        if ($request->hashtag) {
            $hashtag = '#' . $request->hashtag;

            $posts = Post::where('description', 'like', "%{$hashtag}%")->where('active',
                1)->latest()->paginate(Setting::get('items_page'));
        } // else show the normal feed
        else {
            $posts = Post::where(function ($query) use ($id) {
                $query->whereIn('user_id', function ($query) use ($id) {
                    $query->select('leader_id')
                        ->from('followers')
                        ->where('follower_id', $id);
                })
                    ->orWhere('user_id', $id)
                    ->where('active', 1);
            })
                ->whereNotIn('id', function ($query) use ($id) {
                    $query->select('post_id')
                        ->from('hidden_posts')
                        ->where('user_id', $id);
                })
                ->latest()
                ->paginate(Setting::get('items_page'));
//                ->toSql();
        }

        if ($request->ajax) {
            $responseHtml = '';
            foreach ($posts as $post) {
                $responseHtml .= $theme->partial('post', [
                    'post' => $post,
                    'timeline' => $timeline,
                    'next_page_url' => $posts->appends(['ajax' => true, 'hashtag' => $request->hashtag])->nextPageUrl()
                ]);
            }

            return $responseHtml;
        }

        $announcement = Announcement::find(Setting::get('announcement'));
        if ($announcement != null) {
            $chk_isExpire = $announcement->chkAnnouncementExpire($announcement->id);

            if ($chk_isExpire == 'notexpired') {
                $active_announcement = $announcement;
                if (!$announcement->users->contains(Auth::user()->id)) {
                    $announcement->users()->attach(Auth::user()->id);
                }
            }
        }


        $next_page_url = url('ajax/get-more-feed?page=2&ajax=true&hashtag=' . $request->hashtag . '&username=' . Auth::user()->username);

        $theme->setTitle($timeline->name . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('home',
            compact('timeline', 'posts', 'next_page_url', 'trending_tags', 'suggested_users', 'active_announcement',
                'suggested_groups', 'suggested_pages', 'mode', 'user_post'))
            ->render();
    }

    public function showGlobalFeed(Request $request)
    {
        $mode = 'globalfeed';
        $user_post = 'globalfeed';
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');

        $timeline = Timeline::where('username', Auth::user()->username)->first();

        $id = Auth::id();

        $trending_tags = trendingTags();
        $suggested_users = suggestedUsers();
        $suggested_groups = suggestedGroups();
        $suggested_pages = suggestedPages();

        // Check for hashtag
        if ($request->hashtag) {
            $hashtag = '#' . $request->hashtag;

            $posts = Post::where('description', 'like', "%{$hashtag}%")->where('active',
                1)->latest()->paginate(Setting::get('items_page'));
        } // else show the normal feed
        else {
            $posts = Post::orderBy('created_at', 'desc')->where('active', 1)->paginate(Setting::get('items_page'));
        }

        if ($request->ajax) {
            $responseHtml = '';
            foreach ($posts as $post) {
                $responseHtml .= $theme->partial('post', [
                    'post' => $post,
                    'timeline' => $timeline,
                    'next_page_url' => $posts->appends(['ajax' => true, 'hashtag' => $request->hashtag])->nextPageUrl()
                ]);
            }

            return $responseHtml;
        }

        $announcement = Announcement::find(Setting::get('announcement'));
        if ($announcement != null) {
            $chk_isExpire = $announcement->chkAnnouncementExpire($announcement->id);

            if ($chk_isExpire == 'notexpired') {
                $active_announcement = $announcement;
                if (!$announcement->users->contains(Auth::user()->id)) {
                    $announcement->users()->attach(Auth::user()->id);
                }
            }
        }

        $next_page_url = url('ajax/get-global-feed?page=2&ajax=true&hashtag=' . $request->hashtag . '&username=' . Auth::user()->username);

        $theme->setTitle($timeline->name . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('home',
            compact('timeline', 'posts', 'next_page_url', 'trending_tags', 'suggested_users', 'active_announcement',
                'suggested_groups', 'suggested_pages', 'mode', 'user_post'))
            ->render();
    }

    public function changeAvatar(Request $request)
    {
        if (Config::get('app.env') == 'demo' && Auth::user()->username == 'bootstrapguru') {
            return response()->json(['status' => '201', 'message' => trans('common.disabled_on_demo')]);
        }
        $timeline = Timeline::where('id', $request->timeline_id)->first();

        if (($request->timeline_type == 'user' && $request->timeline_id == Auth::user()->timeline_id) ||
            ($request->timeline_type == 'page' && $timeline->page->is_admin(Auth::user()->id) == true) ||
            ($request->timeline_type == 'group' && $timeline->groups->is_admin(Auth::user()->id) == true)
        ) {
            if ($request->hasFile('change_avatar')) {
                $timeline_type = $request->timeline_type;

                $change_avatar = $request->file('change_avatar');
                $strippedName = str_replace(' ', '', $change_avatar->getClientOriginalName());
                $photoName = date('Y-m-d-H-i-s') . $strippedName;

                // Lets resize the image to the square with dimensions of either width or height , which ever is smaller.
                list($width, $height) = getimagesize($change_avatar->getRealPath());


                $avatar = Image::make($change_avatar->getRealPath());

                if ($width > $height) {
                    $avatar->crop($height, $height);
                } else {
                    $avatar->crop($width, $width);
                }

                $avatar->save(storage_path() . '/uploads/' . $timeline_type . 's/avatars/' . $photoName, 60);

                if ($request->timeline_type == 'user') {
                    UserProfile::where('user_id', Auth::id())
                        ->update(['avatar' => $photoName]);
                } else {
                    $media = Media::create([
                        'title' => $photoName,
                        'type' => 'image',
                        'source' => $photoName,
                    ]);

                    $timeline->avatar_id = $media->id;
                    $timeline->save();
                }

                return response()->json([
                    'status' => '200',
                    'avatar_url' => url($timeline_type . '/avatar/' . $photoName),
                    'message' => trans('messages.update_avatar_success')
                ]);
            } else {
                return response()->json(['status' => '201', 'message' => trans('messages.update_avatar_failed')]);
            }
        }
    }

    public function changeCover(Request $request)
    {
        if (Config::get('app.env') == 'demo' && Auth::user()->username == 'bootstrapguru') {
            return response()->json(['status' => '201', 'message' => trans('common.disabled_on_demo')]);
        }
        if ($request->hasFile('change_cover')) {
            $timeline_type = $request->timeline_type;

            $change_avatar = $request->file('change_cover');
            $strippedName = str_replace(' ', '', $change_avatar->getClientOriginalName());
            $photoName = date('Y-m-d-H-i-s') . $strippedName;
            $avatar = Image::make($change_avatar->getRealPath());
            $avatar->save(storage_path() . '/uploads/' . $timeline_type . 's/covers/' . $photoName, 60);

            $media = Media::create([
                'title' => $photoName,
                'type' => 'image',
                'source' => $photoName,
            ]);

            $timeline = Timeline::where('id', $request->timeline_id)->first();
            $timeline->cover_id = $media->id;

            if ($timeline->save()) {
                return response()->json([
                    'status' => '200',
                    'cover_url' => url($timeline_type . '/cover/' . $photoName),
                    'message' => trans('messages.update_cover_success')
                ]);
            }
        } else {
            return response()->json(['status' => '201', 'message' => trans('messages.update_cover_failed')]);
        }
    }

    public function createPost(Request $request)
    {
        $input = $request->all();

        $input['user_id'] = Auth::user()->id;

        $post = Post::create($input);
        $post->notifications_user()->sync([Auth::user()->id], true);

        if ($request->file('post_images_upload_modified')) {
            foreach ($request->file('post_images_upload_modified') as $postImage) {
                $strippedName = str_replace(' ', '', $postImage->getClientOriginalName());
                $photoName = date('Y-m-d-H-i-s') . $strippedName;

                $avatar = Image::make($postImage->getRealPath());
                $avatar->save(storage_path() . '/uploads/users/gallery/' . $photoName, 60);

                $media = Media::create([
                    'title' => $photoName,
                    'type' => 'image',
                    'source' => $photoName,
                ]);

                $post->images()->attach($media);
            }
        }

        if ($request->hasFile('post_video_upload')) {
            $uploadedFile = $request->file('post_video_upload');
            $s3 = Storage::disk('uploads');

            $timestamp = date('Y-m-d-H-i-s');

            $strippedName = $timestamp . str_replace(' ', '', $uploadedFile->getClientOriginalName());

            $s3->put('users/gallery/' . $strippedName, file_get_contents($uploadedFile));

            $basename = $timestamp . basename($request->file('post_video_upload')->getClientOriginalName(),
                    '.' . $request->file('post_video_upload')->getClientOriginalExtension());

            Flavy::thumbnail(storage_path() . '/uploads/users/gallery/' . $strippedName,
                storage_path() . '/uploads/users/gallery/' . $basename . '.jpg', 1); //returns array with file info

            $media = Media::create([
                'title' => $basename,
                'type' => 'video',
                'source' => $strippedName,
            ]);

            $post->images()->attach($media);
        }
        if ($post) {
            // Check for any mentions and notify them
            preg_match_all('/(^|\s)(@\w+)/', $request->description, $usernames);
            foreach ($usernames[2] as $value) {
                $timeline = Timeline::where('username', str_replace('@', '', $value))->first();
                $notification = Notification::create([
                    'user_id' => $timeline->user->id,
                    'post_id' => $post->id,
                    'notified_by' => Auth::user()->id,
                    'description_owner' => Auth::user()->name,
                    'description' => trans('common.mentioned_you_in_post'),
                    'type' => 'mention',
                    'link' => 'post/' . $post->id
                ]);
            }
            $timeline = Timeline::where('id', $request->timeline_id)->first();

            //Notify the user when someone posts on his timeline/page/group

            if ($timeline->type == 'page') {
                $notify_users = $timeline->page->users()->whereNotIn('user_id', [Auth::user()->id])->get();
                $notify_message = 'posted on this page';
            } elseif ($timeline->type == 'group') {
                $notify_users = $timeline->groups->users()->whereNotIn('user_id', [Auth::user()->id])->get();
                $notify_message = 'posted on this group';
            } else {
                $notify_users = $timeline->user()->whereNotIn('id', [Auth::user()->id])->get();
                $notify_message = 'posted on your timeline';
            }

            foreach ($notify_users as $notify_user) {
                Notification::create([
                    'user_id' => $notify_user->id,
                    'timeline_id' => $request->timeline_id,
                    'post_id' => $post->id,
                    'notified_by' => Auth::user()->id,
                    'description_owner' => Auth::user()->name,
                    'description' => $notify_message,
                    'type' => $timeline->type,
                    'link' => $timeline->username
                ]);
            }


            // Check for any hashtags and save them
            preg_match_all('/(^|\s)(#\w+)/', $request->description, $hashtags);
            foreach ($hashtags[2] as $value) {
                $timeline = Timeline::where('username', str_replace('@', '', $value))->first();
                $hashtag = Hashtag::where('tag', str_replace('#', '', $value))->first();
                if ($hashtag) {
                    $hashtag->count = $hashtag->count + 1;
                    $hashtag->save();
                } else {
                    Hashtag::create(['tag' => str_replace('#', '', $value), 'count' => 1]);
                }
            }

            // Let us tag the post friends :)
            if ($request->user_tags != null) {
                $post->users_tagged()->sync(explode(',', $request->user_tags));
            }
        }

        // $post->users_tagged = $post->users_tagged();
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('ajax');
        $postHtml = $theme->scope('timeline/post', compact('post', 'timeline'))->render();

        return response()->json(['status' => '200', 'data' => $postHtml]);
    }

    public function editPost(Request $request)
    {
        $post = Post::where('id', $request->post_id)->with('user')->first();
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('ajax');
        $postHtml = $theme->partial('edit-post', compact('post'));

        return response()->json(['status' => '200', 'data' => $postHtml]);
    }

    public function loadEmoji()
    {
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('ajax');
        $postHtml = $theme->partial('emoji');

        return response()->json(['status' => '200', 'data' => $postHtml]);
    }

    public function loadEmojiComment()
    {
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('ajax');
        $postHtml = $theme->partial('emoji-comment'/*, ['random'=>rand()]*/);

        return response()->json(['status' => '200', 'data' => $postHtml]);
    }

    public function updatePost(Request $request)
    {
        $post = Post::where('id', $request->post_id)->first();
        if ($post->user->id == Auth::user()->id) {
            $post->description = $request->description;
            $post->save();
        }

        return redirect('post/' . $post->id);
    }

    public function getSoundCloudResults(Request $request)
    {
        $soundcloudJson = file_get_contents('http://api.soundcloud.com/tracks.json?client_id=' . env('SOUNDCLOUD_CLIENT_ID') . '&q=' . $request->q);

        return response()->json(['status' => '200', 'data' => $soundcloudJson]);
    }

    public function postComment(Request $request)
    {
        $comment = Comment::create([
            'post_id' => $request->post_id,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'parent_id' => $request->comment_id,
            'youtube_title' => $request->youtube_title,
            'youtube_video_id' => $request->youtube_video_id,
        ]);

//        dd($request->file('comment_images_upload_modified')); die;

        if ($request->file('comment_images_upload_modified')) {
            foreach ($request->file('comment_images_upload_modified') as $commentImage) {
                $strippedName = str_replace(' ', '', $commentImage->getClientOriginalName());
                $photoName = date('Y-m-d-H-i-s') . $strippedName;

                $avatar = Image::make($commentImage->getRealPath());
                $avatar->save(storage_path() . '/uploads/users/gallery/' . $photoName, 60);

                $media = Media::create([
                    'title' => $photoName,
                    'type' => 'image',
                    'source' => $photoName,
                ]);

                $comment->images()->attach($media);
            }
        }

        $post = Post::where('id', $request->post_id)->first();
        $posted_user = $post->user;

        if ($comment) {
            if (Auth::user()->id != $post->user_id) {
                //Notify the user for comment on his/her post
                Notification::create([
                    'user_id' => $post->user_id,
                    'post_id' => $request->post_id,
                    'notified_by' => Auth::user()->id,
                    'description_owner' => Auth::user()->name,
                    'description' => trans('common.commented_on_your_post'),
                    'type' => 'comment_post',
                    'link' => "/post/{$post->id}#comment{$comment->id}"
                ]);
            }

            $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('ajax');
            if ($request->comment_id) {
                $reply = $comment;
                $main_comment = Comment::find($reply->parent_id);
                $main_comment_user = $main_comment->user;

                $user = User::find(Auth::user()->id);
                $user_settings = $user->getUserSettings($main_comment_user->id);
                if ($user_settings && $user_settings->email_reply_comment == 'yes') {
                    Mail::send('emails.commentreply_mail', ['user' => $user, 'main_comment_user' => $main_comment_user],
                        function ($m) use ($user, $main_comment_user) {
                            $m->from(Setting::get('noreply_email'), Setting::get('site_name'));
                            $m->to($main_comment_user->email,
                                $main_comment_user->name)->subject('New reply to your comment');
                        });
                }
                $postHtml = $theme->scope('timeline/reply', compact('reply', 'post'))->render();
            } else {
                $user = User::find(Auth::user()->id);
                $user_settings = $user->getUserSettings($posted_user->id);
                if ($user_settings && $user_settings->email_comment_post == 'yes') {
                    Mail::send('emails.commentmail', ['user' => $user, 'posted_user' => $posted_user],
                        function ($m) use ($user, $posted_user) {
                            $m->from(Setting::get('noreply_email'), Setting::get('site_name'));
                            $m->to($posted_user->email, $posted_user->name)->subject('New comment to your post');
                        });
                }

                $postHtml = $theme->scope('timeline/comment', compact('comment', 'post'))->render();
            }
        }

        return response()->json(['status' => '200', 'comment_id' => $comment->id, 'data' => $postHtml]);
    }

    public function likePost(Request $request)
    {
        $post = Post::findOrFail($request->post_id);
        $posted_user = $post->user;
        $like_count = $post->users_liked()->count();

        //Like the post
        if (!$post->users_liked->contains(Auth::user()->id)) {
            $post->users_liked()->attach(Auth::user()->id,
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            $post->notifications_user()->attach(Auth::user()->id);

            $user = User::find(Auth::user()->id);
            $user_settings = $user->getUserSettings($posted_user->id);
            if ($user_settings && $user_settings->email_like_post == 'yes') {
                Mail::send('emails.postlikemail', ['user' => $user, 'posted_user' => $posted_user],
                    function ($m) use ($posted_user, $user) {
                        $m->from(Setting::get('noreply_email'), Setting::get('site_name'));
                        $m->to($posted_user->email,
                            $posted_user->name)->subject($user->name . ' ' . trans('common.liked_your_post'));
                    });
            }

            //Notify the user for post like
            $notify_message = trans('common.liked_your_post'); // liked your post
            $notify_type = 'like_post';
            $status_message = 'successfully liked';

            if ($post->user->id != Auth::user()->id) {
                Notification::create([
                    'user_id' => $post->user->id,
                    'post_id' => $post->id,
                    'notified_by' => Auth::user()->id,
                    'description_owner' => Auth::user()->name,
                    'description' => $notify_message,
                    'type' => $notify_type
                ]);
            }

            return response()->json([
                'status' => '200',
                'liked' => true,
                'message' => $status_message,
                'likecount' => $like_count + 1
            ]);
        } //Unlike the post
        else {
            $post->users_liked()->detach([Auth::user()->id]);
            $post->notifications_user()->detach([Auth::user()->id]);

            //Notify the user for post unlike
            $notify_message = trans('common.unliked_your_post');
            $notify_type = 'unlike_post';
            $status_message = 'successfully unliked';

            if ($post->user->id != Auth::user()->id) {
                Notification::create([
                    'user_id' => $post->user->id,
                    'post_id' => $post->id,
                    'notified_by' => Auth::user()->id,
                    'description_owner' => Auth::user()->name,
                    'description' => $notify_message,
                    'type' => $notify_type
                ]);
            }

            return response()->json([
                'status' => '200',
                'liked' => false,
                'message' => $status_message,
                'likecount' => $like_count - 1
            ]);
        }

        if ($post) {
            $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('ajax');
            $postHtml = $theme->scope('timeline/post', compact('post'))->render();
        }

        return response()->json(['status' => '200', 'data' => $postHtml]);
    }

    public function likeComment(Request $request)
    {
        $comment = Comment::findOrFail($request->comment_id);
        $comment_user = $comment->user;

        if (!$comment->comments_liked->contains(Auth::user()->id)) {
            $comment->comments_liked()->attach(Auth::user()->id);
            $comment_likes = $comment->comments_liked()->get();
            $like_count = $comment_likes->count();

            //sending email notification
            $user = User::find(Auth::user()->id);
            $user_settings = $user->getUserSettings($comment_user->id);
            if ($user_settings && $user_settings->email_like_comment == 'yes') {
                Mail::send('emails.commentlikemail', ['user' => $user, 'comment_user' => $comment_user],
                    function ($m) use ($user, $comment_user) {
                        $m->from(Setting::get('noreply_email'), Setting::get('site_name'));
                        $m->to($comment_user->email,
                            $comment_user->name)->subject($user->name . ' ' . 'likes your comment');
                    });
            }

            //Notify the user for comment like
            if ($comment->user->id != Auth::user()->id) {
                Notification::create([
                    'user_id' => $comment->user_id,
                    'post_id' => $comment->post_id,
                    'notified_by' => Auth::user()->id,
                    'description_owner' => Auth::user()->name,
                    'description' => trans('common.liked_your_comment'),
                    'type' => 'like_comment'
                ]);
            }

            return response()->json([
                'status' => '200',
                'liked' => true,
                'message' => 'successfully liked',
                'likecount' => $like_count
            ]);
        } else {
            $comment->comments_liked()->detach([Auth::user()->id]);
            $comment_likes = $comment->comments_liked()->get();
            $like_count = $comment_likes->count();

            //Notify the user for comment unlike
            if ($comment->user->id != Auth::user()->id) {
                Notification::create([
                    'user_id' => $comment->user_id,
                    'post_id' => $comment->post_id,
                    'notified_by' => Auth::user()->id,
                    'description_owner' => Auth::user()->name,
                    'description' => trans('common.unliked_your_comment'),
                    'type' => 'unlike_comment'
                ]);
            }

            return response()->json([
                'status' => '200',
                'unliked' => false,
                'message' => 'successfully unliked',
                'likecount' => $like_count
            ]);
        }
    }

    public function sharePost(Request $request)
    {
        $post = Post::findOrFail($request->post_id);
        $posted_user = $post->user;


        if (!$post->users_shared->contains(Auth::user()->id)) {
            $post->users_shared()->attach(Auth::user()->id,
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            $post_share_count = $post->users_shared()->get()->count();
            // we need to insert the shared post into the timeline of the person who shared
            $input['user_id'] = Auth::user()->id;
            $post = Post::create([
                'timeline_id' => Auth::user()->timeline->id,
                'user_id' => Auth::user()->id,
                'shared_post_id' => $request->post_id,
            ]);


            if ($post->user_id != Auth::user()->id) {
                //Notify the user for post share
                Notification::create([
                    'user_id' => $post->user_id,
                    'post_id' => $request->post_id,
                    'notified_by' => Auth::user()->id,
                    'description_owner' => Auth::user()->name,
                    'description' => trans('common.shared_your_post'),
                    'type' => 'share_post',
                    'link' => '/' . Auth::user()->username
                ]);

                $user = User::find(Auth::user()->id);
                $user_settings = $user->getUserSettings($posted_user->id);

                if ($user_settings && $user_settings->email_post_share == 'yes') {
                    Mail::send('emails.postsharemail', ['user' => $user, 'posted_user' => $posted_user],
                        function ($m) use ($user, $posted_user) {
                            $m->from(Setting::get('noreply_email'), Setting::get('site_name'));
                            $m->to($posted_user->email,
                                $posted_user->name)->subject($user->name . ' ' . 'shared your post');
                        });
                }
            }

            return response()->json([
                'status' => '200',
                'shared' => true,
                'message' => 'successfully shared',
                'share_count' => $post_share_count
            ]);
        } else {
            $post->users_shared()->detach([Auth::user()->id]);
            $post_share_count = $post->users_shared()->get()->count();

            $sharedPost = Post::where('shared_post_id', $post->id)->delete();

            if ($post->user_id != Auth::user()->id) {
                //Notify the user for post share
                Notification::create([
                    'user_id' => $post->user_id,
                    'post_id' => $request->post_id,
                    'notified_by' => Auth::user()->id,
                    'description_owner' => Auth::user()->name,
                    'description' => trans('common.unshared_your_post'),
                    'type' => 'unshare_post',
                    'link' => '/' . Auth::user()->username
                ]);
            }

            return response()->json([
                'status' => '200',
                'unshared' => false,
                'message' => 'Successfully unshared',
                'share_count' => $post_share_count
            ]);
        }
    }

    public function pageLiked(Request $request)
    {
        $page = Page::where('timeline_id', '=', $request->timeline_id)->first();

        if ($page->likes->contains(Auth::user()->id)) {
            $page->likes()->detach([Auth::user()->id]);

            return response()->json(['status' => '200', 'like' => true, 'message' => 'successfully unliked']);
        }
    }

    public function pageReport(Request $request)
    {
        $timeline = Timeline::where('id', '=', $request->timeline_id)->first();

        if ($timeline->type == 'page') {
            $admins = $timeline->page->admins();
            $type_view = trans('common.page');
            $report_type = 'page_report';
        }
        if ($timeline->type == 'group') {
            $admins = $timeline->groups->admins();
            $type_view = trans('common.group');
            $report_type = 'group_report';
        }


        if (!$timeline->reports->contains(Auth::user()->id)) {
            $timeline->reports()->attach(Auth::user()->id, ['status' => 'pending']);

            if ($timeline->type == 'user') {
                Notification::create([
                    'user_id' => $timeline->user->id,
                    'timeline_id' => $timeline->id,
                    'notified_by' => Auth::user()->id,
                    'description_owner' => Auth::user()->name,
                    'description' => trans('common.reported_you'),
                    'type' => 'user_report'
                ]);
            } else {
                foreach ($admins as $admin) {
                    Notification::create([
                        'user_id' => $admin->id,
                        'timeline_id' => $timeline->id,
                        'notified_by' => Auth::user()->id,
                        'description_owner' => Auth::user()->name,
                        'description' => trans('common.reported_you') . ' ' . $type_view,
                        'type' => $report_type
                    ]);
                }
            }

            return response()->json(['status' => '200', 'reported' => true, 'message' => 'successfully reported']);

        } else {
            $timeline->reports()->detach([Auth::user()->id]);

            if ($timeline->type == 'user') {
                Notification::create([
                    'user_id' => $timeline->user->id,
                    'timeline_id' => $timeline->id,
                    'notified_by' => Auth::user()->id,
                    'description_owner' => Auth::user()->name,
                    'description' => trans('common.unreported_you'),
                    'type' => 'user_report'
                ]);
            } else {
                foreach ($admins as $admin) {
                    Notification::create([
                        'user_id' => $admin->id,
                        'timeline_id' => $timeline->id,
                        'notified_by' => Auth::user()->id,
                        'description_owner' => Auth::user()->name,
                        'description' => trans('common.unreported_your_page'),
                        'type' => 'page_report'
                    ]);
                }
            }

            return response()->json(['status' => '200', 'reported' => false, 'message' => 'successfully unreport']);
        }
    }

    public function timelineGroups(Request $request)
    {
        $group = Group::where('timeline_id', '=', $request->timeline_id)->first();

        if ($group->users->contains(Auth::user()->id)) {
            $group->users()->detach([Auth::user()->id]);

            return response()->json(['status' => '200', 'join' => true, 'message' => 'successfully unjoined']);
        }
    }

    public function getYoutubeVideo(Request $request)
    {
        $videoId = Youtube::parseVidFromURL($request->youtube_source);

        $video = Youtube::getVideoInfo($videoId);

        $videoData = [
            'id' => $video->id,
            'title' => $video->snippet->title,
            'iframe' => $video->player->embedHtml,
        ];

        return response()->json(['status' => '200', 'message' => $videoData]);
    }

    public function show($id)
    {
        $timeline = $this->timelineRepository->findWithoutFail($id);

        if (empty($timeline)) {
            Flash::error('Timeline not found');

            return redirect(route('timelines.index'));
        }

        return view('timelines.show')->with('timeline', $timeline);
    }

    /**
     * Show the form for editing the specified Timeline.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $timeline = $this->timelineRepository->findWithoutFail($id);

        if (empty($timeline)) {
            Flash::error('Timeline not found');

            return redirect(route('timelines.index'));
        }

        return view('timelines.edit')->with('timeline', $timeline);
    }

    /**
     * Update the specified Timeline in storage.
     *
     * @param int $id
     * @param UpdateTimelineRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTimelineRequest $request)
    {
        $timeline = $this->timelineRepository->findWithoutFail($id);

        if (empty($timeline)) {
            Flash::error('Timeline not found');

            return redirect(route('timelines.index'));
        }

        $timeline = $this->timelineRepository->update($request->all(), $id);

        Flash::success('Timeline updated successfully.');

        return redirect(route('timelines.index'));
    }

    /**
     * Remove the specified Timeline from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $timeline = $this->timelineRepository->findWithoutFail($id);

        if (empty($timeline)) {
            Flash::error('Timeline not found');

            return redirect(route('timelines.index'));
        }

        $this->timelineRepository->delete($id);

        Flash::success('Timeline deleted successfully.');

        return redirect(route('timelines.index'));
    }

    public function follow(Request $request)
    {
        $follow = User::where('timeline_id', '=', $request->timeline_id)->first();

        if (!$follow->followers->contains(Auth::user()->id)) {
            $follow->followers()->attach(Auth::user()->id, ['is_follower' => 1]);

            $user = User::find(Auth::user()->id);
            $user_settings = $user->getUserSettings($follow->id);

            if ($user_settings && $user_settings->email_follow == 'yes') {
                Mail::send('emails.followmail', ['user' => $user, 'follow' => $follow],
                    function ($m) use ($user, $follow) {
                        $m->from(Setting::get('noreply_email'), Setting::get('site_name'));
                        $m->to($follow->email, $follow->name)->subject($user->name . ' ' . trans('common.follows_you'));
                    });
            }

            //Notify the user for follow
            Notification::create([
                'user_id' => $follow->id,
                'timeline_id' => $request->timeline_id,
                'notified_by' => Auth::user()->id,
                'description_owner' => Auth::user()->name,
                'description' => trans('common.is_following_you'),
                'type' => 'follow'
            ]);

            return response()->json(['status' => '200', 'followed' => true, 'message' => 'successfully followed']);
        } else {
            $follow->followers()->detach([Auth::user()->id]);

            //Notify the user for follow
            Notification::create([
                'user_id' => $follow->id,
                'timeline_id' => $request->timeline_id,
                'notified_by' => Auth::user()->id,
                'description_owner' => Auth::user()->name,
                'description' => trans('common.is_unfollowing_you'),
                'type' => 'unfollow'
            ]);

            return response()->json(['status' => '200', 'followed' => false, 'message' => 'successfully unFollowed']);
        }
    }

    public function joiningGroup(Request $request)
    {
        $user_role_id = Role::where('name', '=', 'user')->first();
        $group = Group::where('timeline_id', '=', $request->timeline_id)->first();
        $group_timeline = $group->timeline;

        $users = $group->users()->get();

        if (!$group->users->contains(Auth::user()->id)) {
            $group->users()->attach(Auth::user()->id, ['role_id' => $user_role_id->id, 'status' => 'approved']);


            foreach ($users as $user) {
                if ($user->id != Auth::user()->id) {
                    //Notify the user for page like
                    Notification::create([
                        'user_id' => $user->id,
                        'timeline_id' => $request->timeline_id,
                        'notified_by' => Auth::user()->id,
                        'description_owner' => Auth::user()->name,
                        'description' => trans('common.joined_your_group'),
                        'type' => 'join_group'
                    ]);
                }

                if ($group->is_admin($user->id)) {
                    $group_admin = User::find($user->id);
                    $user = User::find(Auth::user()->id);
                    $user_settings = $user->getUserSettings($group_admin->id);
                    if ($user_settings && $user_settings->email_join_group == 'yes') {
                        Mail::send('emails.groupjoinmail', ['user' => $user, 'group_timeline' => $group_timeline],
                            function ($m) use ($user, $group_admin, $group_timeline) {
                                $m->from(Setting::get('noreply_email'), Setting::get('site_name'));
                                $m->to($group_admin->email)->subject($user->name . ' ' . trans('common.joined_your_group'));
                            });
                    }
                }
            }

            return response()->json(['status' => '200', 'joined' => true, 'message' => 'successfully joined']);
        } else {
            $group->users()->detach([Auth::user()->id]);

            foreach ($users as $user) {
                if ($user->id != Auth::user()->id) {
                    //Notify the user for page like
                    Notification::create([
                        'user_id' => $user->id,
                        'timeline_id' => $request->timeline_id,
                        'notified_by' => Auth::user()->id,
                        'description_owner' => Auth::user()->name,
                        'description' => trans('common.unjoined_your_group'),
                        'type' => 'unjoin_group'
                    ]);
                }
            }

            return response()->json(['status' => '200', 'joined' => false, 'message' => 'successfully unjoined']);
        }
    }

    public function joiningEvent(Request $request)
    {
        $event = Event::where('timeline_id', '=', $request->timeline_id)->first();
        $users = $event->users()->get();

        if (!$event->users->contains(Auth::user()->id)) {
            $event->users()->attach(Auth::user()->id);

            foreach ($users as $user) {
                if ($user->id != Auth::user()->id) {
                    //Notify the user for event join
                    Notification::create([
                        'user_id' => $user->id,
                        'timeline_id' => $request->timeline_id,
                        'notified_by' => Auth::user()->id,
                        'description_owner' => Auth::user()->name,
                        'description' => trans('common.attending_your_event'),
                        'type' => 'join_event'
                    ]);
                }
            }
            return response()->json(['status' => '200', 'joined' => true, 'message' => 'successfully joined']);
        } else {
            $event->users()->detach([Auth::user()->id]);

            foreach ($users as $user) {
                if ($user->id != Auth::user()->id) {
                    //Notify the user for page like
                    Notification::create([
                        'user_id' => $user->id,
                        'timeline_id' => $request->timeline_id,
                        'notified_by' => Auth::user()->id,
                        'description_owner' => Auth::user()->name,
                        'description' => trans('common.quit_attending_your_event'),
                        'type' => 'unjoin_event'
                    ]);
                }
            }
            return response()->json(['status' => '200', 'joined' => false, 'message' => 'successfully unjoined']);
        }
    }

    public function joiningClosedGroup(Request $request)
    {
        $user_role_id = Role::where('name', '=', 'user')->first();
        $group = Group::where('timeline_id', '=', $request->timeline_id)->first();

        if (!$group->users->contains(Auth::user()->id)) {
            $group->users()->attach(Auth::user()->id, ['role_id' => $user_role_id->id, 'status' => 'pending']);


            $users = $group->users()->get();
            foreach ($users as $user) {
                if (Auth::user()->id != $user->id) {
                    //Notify the user for page like
                    Notification::create([
                        'user_id' => $user->id,
                        'timeline_id' => $request->timeline_id,
                        'notified_by' => Auth::user()->id,
                        'description_owner' => Auth::user()->name,
                        'description' => trans('common.request_join_group'),
                        'type' => 'group_join_request'
                    ]);
                }
            }

            return response()->json([
                'status' => '200',
                'joinrequest' => true,
                'message' => 'successfully sent group join request'
            ]);
        } else {
            $checkStatus = $group->chkGroupUser($group->id, Auth::user()->id);

            if ($checkStatus && $checkStatus->status == 'approved') {
                $group->users()->detach([Auth::user()->id]);

                return response()->json(['status' => '200', 'join' => true, 'message' => 'unsuccessfully request']);
            } else {
                $group->users()->detach([Auth::user()->id]);

                return response()->json([
                    'status' => '200',
                    'joinrequest' => false,
                    'message' => 'unsuccessfully request'
                ]);
            }
        }
    }

    /**
     * @deprecated
     */
    public function userFollowRequest(Request $request)
    {
        $user = User::where('timeline_id', '=', $request->timeline_id)->first();
        if (!$user->followers->contains(Auth::user()->id)) {
            $user->followers()->attach(Auth::user()->id, ['is_follower' => 1]);
            //Notify the user for page like
            Notification::create([
                'user_id' => $user->id,
                'timeline_id' => Auth::user()->timeline_id,
                'notified_by' => Auth::user()->id,
                'description_owner' => Auth::user()->name,
                'description' => trans('common.request_follow'),
                'type' => 'follow_requested'
            ]);

            return response()->json([
                'status' => '200',
                'followrequest' => true,
                'message' => 'successfully sent user follow request'
            ]);
        } else {
            if ($request->follow_status == 'approved') {
                $user->followers()->detach([Auth::user()->id]);

                return response()->json([
                    'status' => '200',
                    'unfollow' => true,
                    'message' => 'unfollowed successfully'
                ]);
            } else {
                $user->followers()->detach([Auth::user()->id]);
                return response()->json([
                    'status' => '200',
                    'followrequest' => false,
                    'message' => 'unsuccessfully request'
                ]);
            }
        }
    }

    public function pageLike(Request $request)
    {
        $page = Page::where('timeline_id', '=', $request->timeline_id)->first();
        $page_timeline = $page->timeline;

        if (!$page->likes->contains(Auth::user()->id)) {
            $page->likes()->attach(Auth::user()->id);

            if (!$page->users->contains(Auth::user()->id)) {
                $users = $page->users()->get();
                foreach ($users as $user) {
                    //Notify the user for page like
                    Notification::create([
                        'user_id' => $user->id,
                        'timeline_id' => $request->timeline_id,
                        'notified_by' => Auth::user()->id,
                        'description_owner' => Auth::user()->name,
                        'description' => trans('common.liked_your_page'),
                        'type' => 'like_page'
                    ]);

                    if ($page->is_admin($user->id)) {
                        $page_admin = User::find($user->id);
                        $user = User::find(Auth::user()->id);
                        $user_settings = $user->getUserSettings($page_admin->id);
                        if ($user_settings && $user_settings->email_like_page == 'yes') {
                            Mail::send('emails.pagelikemail', ['user' => $user, 'page_timeline' => $page_timeline],
                                function ($m) use ($user, $page_admin, $page_timeline) {
                                    $m->from(Setting::get('noreply_email'), Setting::get('site_name'));
                                    $m->to($page_admin->email)->subject($user->name . ' ' . 'liked your page');
                                });
                        }
                    }
                }
            }

            return response()->json(['status' => '200', 'liked' => true, 'message' => 'Page successfully liked']);
        } else {
            $page->likes()->detach([Auth::user()->id]);

            if (!$page->users->contains(Auth::user()->id)) {
                $users = $page->users()->get();
                foreach ($users as $user) {
                    //Notify the user for page unlike
                    Notification::create([
                        'user_id' => $user->id,
                        'timeline_id' => $request->timeline_id,
                        'notified_by' => Auth::user()->id,
                        'description_owner' => Auth::user()->name,
                        'description' => trans('common.unliked_your_page'),
                        'type' => 'unlike_page'
                    ]);
                }
            }

            return response()->json(['status' => '200', 'liked' => false, 'message' => 'Page successfully unliked']);
        }
    }

    public function getNotifications(Request $request)
    {
        $post = Post::findOrFail($request->post_id);

        if (!$post->notifications_user->contains(Auth::user()->id)) {
            $post->notifications_user()->attach(Auth::user()->id);

            return response()->json(['status' => '200', 'notified' => true, 'message' => 'Successfull']);
        } else {
            $post->notifications_user()->detach([Auth::user()->id]);

            return response()->json(['status' => '200', 'unnotify' => false, 'message' => 'UnSuccessfull']);
        }
    }

    public function addPage($username)
    {
        $category_options = ['' => 'Select Category'] + Category::active()->pluck('name', 'id')->all();

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');

        $theme->setTitle(trans('common.create_page') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('timeline/create-page', compact('username', 'category_options'))->render();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'name' => 'required|max:30|min:5',
            'category' => 'required',
            'username' => 'required|max:26|min:5|alpha_num|unique:timelines|unique:users,esvoe_id'
        ];

        return Validator::make($data, $rules);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function groupPageSettingsValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
        ]);
    }

    public function createPage(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }

        //Create timeline record for userpage
        $timeline = Timeline::create([
            'username' => $request->username,
            'name' => $request->name,
            'about' => $request->about,
            'type' => 'page',
        ]);

        $page = Page::create([
            'timeline_id' => $timeline->id,
            'category_id' => $request->category,
            'member_privacy' => Setting::get('page_member_privacy'),
            'message_privacy' => Setting::get('page_message_privacy'),
            'timeline_post_privacy' => Setting::get('page_timeline_post_privacy'),
        ]);

        $role = Role::where('name', '=', 'Admin')->first();
        //below code inserting record in to page_user table
        $page->users()->attach(Auth::user()->id, ['role_id' => $role->id, 'active' => 1]);
        $message = 'Page created successfully';
        $username = $request->username;

        return redirect('/' . $timeline->username);
    }

    public function addGroup($username)
    {

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(trans('common.create_group') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('timeline/create-group', compact('username'))->render();
    }

    public function posts($username)
    {
        $admin_role_id = Role::where('name', '=', 'admin')->first();
        $timeline = Timeline::where('username', $username)->first();
        $posts = $timeline->posts()->where('active', 1)->orderBy('created_at',
            'desc')->with('comments')->paginate(Setting::get('items_page'));


        if ($timeline->type == 'user') {
            $follow_user_status = '';
            $user = User::where('timeline_id', $timeline['id'])->first();
            $liked_pages = $user->pageLikes()->get();
            $joined_groups = $user->groups()->get();
            $own_pages = $user->own_pages();
            $own_groups = $user->own_groups();
            $joined_groups_count = $user->groups()->where('role_id', '!=', $admin_role_id->id)->where('status', '=',
                'approved')->get()->count();

            $followRequests = $user->followers()->where('type_friend', '=', 1)->get();
            $following_count = $user->following()->where('is_follower', '=', 1)->get()->count();
            $followers_count = $user->followers()->where('is_follower', '=', 1)->get()->count();
            $follow_user_status = DB::table('followers')
                ->where('follower_id', '=', Auth::user()->id)
                ->where('leader_id', '=', $user->id)
                ->first();
            $user_events = $user->events()->whereDate('end_date', '>=', date('Y-m-d', strtotime(Carbon::now())))->get();
            $guest_events = $user->getEvents();


            if ($follow_user_status) {
                $follow_user_status = ($follow_user_status->type_friend == 3) ? 'approved' : 'pending';//todo change
            }

            $confirm_follow_setting = $user->getUserSettings(Auth::user()->id);
            $follow_confirm = $confirm_follow_setting->confirm_follow;

            $live_user_settings = $user->getUserPrivacySettings(Auth::user()->id, $user->id);
            $privacy_settings = explode('-', $live_user_settings);
            $timeline_post = $privacy_settings[0];
            $user_post = $privacy_settings[1];
        } else {
            $user = User::where('id', Auth::user()->id)->first();
        }

        $next_page_url = url('ajax/get-more-posts?page=2&username=' . $username);

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(trans('common.posts') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('timeline/posts',
            compact('timeline', 'user', 'posts', 'liked_pages', 'followRequests', 'joined_groups', 'own_pages',
                'own_groups', 'follow_user_status', 'following_count', 'followers_count', 'follow_confirm', 'user_post',
                'timeline_post', 'joined_groups_count', 'next_page_url', 'user_events', 'guest_events'))->render();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function groupPageValidator(array $data)
    {
        $rules = [
            'name' => 'required',
            'username' => 'required|max:16|min:5|alpha_num|unique:timelines|unique:users,esvoe_id'
        ];
        return Validator::make($data, $rules);
    }

    public function createGroupPage(Request $request)
    {
        $validator = $this->groupPageValidator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }

        //Create timeline record for userpage
        $timeline = Timeline::create([
            'username' => $request->username,
            'name' => $request->name,
            'about' => $request->about,
            'type' => 'group',
        ]);

        if ($request->type == 'open') {
            $group = Group::create([
                'timeline_id' => $timeline->id,
                'type' => $request->type,
                'active' => 1,
                'member_privacy' => 'everyone',
                'post_privacy' => 'members',
                'event_privacy' => 'only_admins',
            ]);
        } else {
            $group = Group::create([
                'timeline_id' => $timeline->id,
                'type' => $request->type,
                'active' => 1,
                'member_privacy' => Setting::get('group_member_privacy'),
                'post_privacy' => Setting::get('group_timeline_post_privacy'),
                'event_privacy' => Setting::get('group_event_privacy'),
            ]);
        }
        $role = Role::where('name', '=', 'Admin')->first();
        //below code inserting record in to page_user table
        if ($request->type == 'open' || $request->type == 'closed' || $request->type == 'secret') {
            $group->users()->attach(Auth::user()->id, ['role_id' => $role->id, 'status' => 'approved']);
        } else {
            $group->users()->attach(Auth::user()->id, ['role_id' => $role->id]);
        }

        $message = trans('messages.create_page_success');
        $username = $request->username;

        return redirect('/' . $timeline->username);
    }

    public function pagesGroups($username)
    {

        $timeline = Timeline::where('username', $username)->with('user')->first();
        if ($timeline == null) {
            return redirect('/');
        }
        if ($timeline->id == Auth::user()->timeline_id) {
            $user = $timeline->user;
            $userPages = $user->own_pages();
            $groupPages = $user->own_groups();
            $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
            $theme->setTitle('Pages & Groups | ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

            return $theme->scope('timeline/pages-groups', compact('username', 'userPages', 'groupPages'))->render();
        } else {
            return redirect($timeline->username);
        }
    }

    public function generalPageSettings($username)
    {
        $timeline = Timeline::where('username', $username)->with('page')->first();

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(trans('common.general_settings') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('page/settings/general', compact('timeline', 'username'))->render();
    }

    public function updateGeneralPageSettings(Request $request)
    {
        $validator = $this->groupPageSettingsValidator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }
        $timeline = Timeline::where('username', $request->username)->first();
        $timeline_values = $request->only('username', 'name', 'about');
        $update_timeline = $timeline->update($timeline_values);

        $page = Page::where('timeline_id', $timeline->id)->first();
        $page_values = $request->only('address', 'phone', 'website');
        $update_page = $page->update($page_values);


        Flash::success(trans('messages.update_Settings_success'));

        return redirect()->back();
    }

    public function privacyPageSettings($username)
    {
        $timeline = Timeline::where('username', $username)->first();
        $page_details = $timeline->page()->first();

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(trans('common.privacy_settings') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('page/settings/privacy', compact('timeline', 'username', 'page_details'))->render();
    }

    public function updatePrivacyPageSettings(Request $request)
    {
        $timeline = Timeline::where('username', $request->username)->first();
        $page = Page::where('timeline_id', $timeline->id)->first();
        $page->timeline_post_privacy = $request->timeline_post_privacy;
        $page->member_privacy = $request->member_privacy;
        $page->save();

        Flash::success(trans('messages.update_privacy_success'));

        return redirect()->back();
    }

    public function rolesPageSettings($username)
    {
        $timeline = Timeline::where('username', $username)->first();
        $page = $timeline->page;
        $page_members = $page->members();
        $roles = Role::pluck('name', 'id');

        $theme = Theme::uses('default')->layout('default');
        $theme->setTitle(trans('common.manage_roles') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('page/settings/roles', compact('timeline', 'page_members', 'roles', 'page'))->render();
    }

    public function likesPageSettings($username)
    {
        $timeline = Timeline::where('username', $username)->with('page')->first();
        $page_likes = $timeline->page->likes()->where('user_id', '!=', Auth::user()->id)->get();

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(trans('common.page_likes') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('page/settings/likes', compact('timeline', 'page_likes'))->render();
    }

    //Getting group members
    public function getGroupMember($username, $group_id)
    {
        $timeline = Timeline::where('username', $username)->with('groups')->first();
        $group = $timeline->groups;
        $group_members = $group->members();
        $group_events = $group->getEvents($group->id);
        $ongoing_events = $group->getOnGoingEvents($group->id);
        $upcoming_events = $group->getUpcomingEvents($group->id);

        $member_role_options = Role::pluck('name', 'id');

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(trans('common.members') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('users/members',
            compact('timeline', 'group_members', 'group', 'group_id', 'member_role_options', 'group_events',
                'ongoing_events', 'upcoming_events'))->render();
    }

    //Displaying group admins
    public function getAdminMember($username, $group_id)
    {
        $timeline = Timeline::where('username', $username)->with('groups')->first();
        $group = $timeline->groups;
        $group_admins = $group->admins();
        $group_members = $group->members();
        $member_role_options = Role::pluck('name', 'id');
        $group_events = $group->getEvents($group->id);
        $ongoing_events = $group->getOnGoingEvents($group->id);
        $upcoming_events = $group->getUpcomingEvents($group->id);

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(trans('common.admins') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('users/admin-group-member',
            compact('timeline', 'group', 'group_id', 'group_admins', 'member_role_options', 'group_members',
                'group_events', 'ongoing_events', 'upcoming_events'))->render();
    }

    //Displaying group members posts
    public function getGroupPosts($username, $group_id)
    {
        $user_post = 'group';
        $timeline = Timeline::where('username', $username)->with('groups')->first();
        $posts = $timeline->posts()->where('active', 1)->orderBy('created_at', 'desc')->with('comments')->get();
        $group = $timeline->groups;
        $group_members = $group->members();
        $group_events = $group->getEvents($group->id);
        $ongoing_events = $group->getOnGoingEvents($group->id);
        $upcoming_events = $group->getUpcomingEvents($group->id);
        $next_page_url = url('ajax/get-more-posts?page=2&username=' . $username);

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(trans('common.posts') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('timeline/groupposts',
            compact('timeline', 'group', 'posts', 'group_members', 'next_page_url', 'user_post', 'username',
                'group_events', 'ongoing_events', 'upcoming_events'))->render();
    }

    public function getJoinRequests($username, $group_id)
    {
        $group = Group::findOrFail($group_id);
        $requestedUsers = $group->pending_members();
        $timeline = Timeline::where('username', $username)->first();
        $group_members = $group->members();
        $group_events = $group->getEvents($group->id);
        $ongoing_events = $group->getOnGoingEvents($group->id);
        $upcoming_events = $group->getUpcomingEvents($group->id);

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(trans('common.join_requests') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('users/joinrequests',
            compact('timeline', 'username', 'requestedUsers', 'group_id', 'group', 'group_members', 'group_events',
                'ongoing_events', 'upcoming_events'))->render();
    }

    //Getting page members with count whose status approved
    public function getPageMember($username)
    {
        $timeline = Timeline::where('username', $username)->with('page')->first();
        $page = $timeline->page;
        $page_members = $page->members();
        $roles = Role::pluck('name', 'id');

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(trans('common.members') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('users/pagemembers', compact('timeline', 'page', 'roles', 'page_members'))->render();
    }

    //Displaying admin of the page
    public function getPageAdmins($username)
    {
        $timeline = Timeline::where('username', $username)->with('page')->first();
        $page = $timeline->page;
        $page_admins = $page->admins();
        $page_members = $page->members();
        $roles = Role::pluck('name', 'id');

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(trans('common.admins') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('users/pageadmins',
            compact('timeline', 'page', 'page_admins', 'roles', 'page_members'))->render();
    }

    // Displaying page likes
    public function getPageLikes($username)
    {
        $timeline = Timeline::where('username', $username)->with('page', 'page.likes', 'page.users')->first();
        $page = $timeline->page;
        $page_likes = $page->likes()->get();
        $page_members = $page->members();

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(trans('common.page_likes') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('timeline/page_likes',
            compact('timeline', 'page', 'page_likes', 'page_members'))->render();
    }

    //Displaying page members posts
    public function getPagePosts($username)
    {
        $user_post = 'page';
        $page_user_id = '';
        $timeline = Timeline::where('username', $username)->with('page', 'page.likes', 'page.users')->first();
        $page = $timeline->page;
        $posts = $timeline->posts()->where('active', 1)->orderBy('created_at', 'desc')->with('comments')->get();
        $page_members = $page->members();
        $next_page_url = url('ajax/get-more-posts?page=2&username=' . $username);

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(trans('common.posts') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('timeline/pageposts',
            compact('timeline', 'posts', 'page', 'page_user_id', 'page_members', 'next_page_url',
                'user_post'))->render();
    }

    //Assigning role for a member in group
    public function assignMemberRole(Request $request)
    {
        $chkUser_exists = '';
        $group = Group::findOrFail($request->group_id);
        $chkUser_exists = $group->chkGroupUser($request->group_id, $request->user_id);
        if ($chkUser_exists) {
            $result = $group->updateMemberRole($request->member_role, $request->group_id, $request->user_id);
            if ($result) {
                Flash::success(trans('messages.assign_role_success'));

                return redirect()->back();
            } else {
                Flash::success(trans('messages.assign_role_success'));

                return redirect()->back();
            }
        }
    }

    //Assigning role for a member in page
    public function assignPageMemberRole(Request $request)
    {
        $chkUser_exists = '';
        $page = Page::findOrFail($request->page_id);

        $chkUser_exists = $page->chkPageUser($request->page_id, $request->user_id);

        if ($chkUser_exists) {
            $result = $page->updatePageMemberRole($request->member_role, $request->page_id, $request->user_id);
            if ($result) {
                Flash::success(trans('messages.assign_role_success'));

                return redirect()->back();
            } else {
                Flash::success(trans('messages.assign_role_success'));

                return redirect()->back();
            }
        }
    }

    //Removing member from group
    public function removeGroupMember(Request $request)
    {
        $admin_role_id = Role::where('name', '=', 'admin')->first();
        $chkUser_exists = '';
        $group = Group::findOrFail($request->group_id);

        $group_admins = $group->users()->where('group_id', $group->id)->where('role_id', '=',
            $admin_role_id->id)->get()->count();
        $group_members = $group->users()->where('group_id', $group->id)->where('user_id', '=',
            $request->user_id)->first();

        if ($group_members->pivot->role_id == $admin_role_id->id && $group_admins > 1) {
            $chkUser_exists = $group->removeMember($request->group_id, $request->user_id);
        } elseif ($group_members->pivot->role_id != $admin_role_id->id) {
            $chkUser_exists = $group->removeMember($request->group_id, $request->user_id);
        }

        if ($chkUser_exists) {
            if (Auth::user()->id != $request->user_id) {
                //Notify the user for accepting group's join request
                Notification::create([
                    'user_id' => $request->user_id,
                    'timeline_id' => $group->timeline_id,
                    'notified_by' => Auth::user()->id,
                    'description_owner' => Auth::user()->name,
                    'description' => trans('common.removed_from_group'),
                    'type' => 'remove_group_member'
                ]);
            }

            return response()->json([
                'status' => '200',
                'deleted' => true,
                'message' => trans('messages.remove_member_group_success')
            ]);
        } else {
            return response()->json([
                'status' => '200',
                'deleted' => false,
                'message' => trans('messages.assign_admin_role_remove')
            ]);
        }
    }

    //Removing member from page
    public function removePageMember(Request $request)
    {
        $admin_role_id = Role::where('name', '=', 'admin')->first();
        $chkUser_exists = '';
        $page = Page::findOrFail($request->page_id);

        $page_admins = $page->users()->where('page_id', $page->id)->where('role_id', '=',
            $admin_role_id->id)->get()->count();
        $page_members = $page->users()->where('page_id', $page->id)->where('user_id', '=', $request->user_id)->first();

        if ($page_members->pivot->role_id == $admin_role_id->id && $page_admins > 1) {
            $chkUser_exists = $page->removePageMember($request->page_id, $request->user_id);
        } elseif ($page_members->pivot->role_id != $admin_role_id->id) {
            $chkUser_exists = $page->removePageMember($request->page_id, $request->user_id);
        }
        // else{
        //     return response()->json(['status' => '200','deleted' => false,'message'=>'Assign admin role for member and remove']);
        // }

        if ($chkUser_exists) {
            if (Auth::user()->id != $request->user_id) {
                //Notify the user for accepting page's join request
                Notification::create([
                    'user_id' => $request->user_id,
                    'timeline_id' => $page->timeline_id,
                    'notified_by' => Auth::user()->id,
                    'description_owner' => Auth::user()->name,
                    'description' => trans('common.removed_from_page'),
                    'type' => 'remove_page_member'
                ]);
            }

            return response()->json([
                'status' => '200',
                'deleted' => true,
                'message' => trans('messages.remove_member_page_success')
            ]);
        } else {
            return response()->json([
                'status' => '200',
                'deleted' => false,
                'message' => trans('messages.assign_admin_role_remove')
            ]);
        }
    }

    public function acceptJoinRequest(Request $request)
    {
        $group = Group::findOrFail($request->group_id);

        $chkUser = $group->chkGroupUser($request->group_id, $request->user_id);


        if ($chkUser) {
            $group_user = $group->updateStatus($chkUser->id);

            if ($group_user) {
                //Notify the user for accepting group's join request
                Notification::create([
                    'user_id' => $request->user_id,
                    'timeline_id' => $group->timeline_id,
                    'notified_by' => Auth::user()->id,
                    'description_owner' => Auth::user()->name,
                    'description' => trans('common.accepted_join_request'),
                    'type' => 'accept_group_join'
                ]);
            }

            Flash::success('Request Accepted');

            return response()->json([
                'status' => '200',
                'accepted' => true,
                'message' => trans('messages.join_request_accept')
            ]);
        }
    }

    public function rejectJoinRequest(Request $request)
    {
        $group = Group::findOrFail($request->group_id);
        $chkUser = $group->chkGroupUser($request->group_id, $request->user_id);

        if ($chkUser) {
            $group_user = $group->decilneRequest($chkUser->id);
            if ($group_user) {
                //Notify the user for rejected group's join request
                Notification::create([
                    'user_id' => $request->user_id,
                    'timeline_id' => $group->timeline_id,
                    'notified_by' => Auth::user()->id,
                    'description_owner' => Auth::user()->name,
                    'description' => trans('common.rejected_join_request'),
                    'type' => 'reject_group_join'
                ]);
            }

            Flash::success('Request Rejected');

            return response()->json([
                'status' => '200',
                'rejected' => true,
                'message' => trans('messages.join_request_reject')
            ]);
        }
    }

    public function updateUserGroupSettings(Request $request, $username)
    {
        $validator = $this->groupPageSettingsValidator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }

        $timeline = Timeline::where('username', $username)->first();
        $timeline->username = $username;
        $timeline->name = $request->name;
        $timeline->about = $request->about;
        $timeline->save();

        $group = Group::where('timeline_id', $timeline->id)->first();
        $group->type = $request->type;
        $group->member_privacy = $request->member_privacy;
        $group->post_privacy = $request->post_privacy;
        $group->event_privacy = $request->event_privacy;
        $group->save();

        Flash::success(trans('messages.update_group_settings'));

        return redirect()->back();
    }

    public function deleteComment(Request $request)
    {
        $comment = Comment::where('id', '=', $request->comment_id)->first();

        if ($comment->delete()) {
            if (Auth::user()->id != $comment->user->id) {
                //Notify the user for comment delete
                Notification::create([
                    'user_id' => $comment->user->id,
                    'post_id' => $comment->post_id,
                    'notified_by' => Auth::user()->id,
                    'description_owner' => Auth::user()->name,
                    'description' => trans('common.deleted_your_comment'),
                    'type' => 'delete_comment'
                ]);
            }

            return response()->json([
                'status' => '200',
                'deleted' => true,
                'message' => 'Comment successfully deleted'
            ]);
        } else {
            return response()->json(['status' => '200', 'notdeleted' => false, 'message' => 'Unsuccessfull']);
        }
    }

    public function deletePage(Request $request)
    {
        // $page = Page::where('id', '=', $request->page_id)->first();

        // if ($page->delete()) {
        //     $users = $page->users()->get();
        //     foreach ($users as $user) {
        //         if ($user->id != Auth::user()->id) {
        //             //Notify the user for page delete
        //         Notification::create(['user_id' => $user->id, 'timeline_id' => $page->timeline->id, 'notified_by' => Auth::user()->id, 'description' => Auth::user()->name.' deleted your page', 'type' => 'delete_page']);
        //         }
        //     }

        //     return response()->json(['status' => '200', 'deleted' => true, 'message' => 'Page successfully deleted']);
        // } else {
        //     return response()->json(['status' => '200', 'notdeleted' => false, 'message' => 'Unsuccessful']);
        // }

        $page = Page::where('id', '=', $request->page_id)->first();

        $page->timeline->reports()->detach();
        $page->users()->detach();
        $page->likes()->detach();

        //Deleting page notifications
        $timeline_alerts = $page->timeline()->with('notifications')->first();
        if (count($timeline_alerts->notifications) != 0) {
            foreach ($timeline_alerts->notifications as $notification) {
                $notification->delete();
            }
        }

        //Deleting page posts
        $timeline_posts = $page->timeline()->with('posts')->first();
        if (count($timeline_posts->posts) != 0) {
            foreach ($timeline_posts->posts as $post) {
                $post->deleteMe();
            }
        }

        $page_timeline = $page->timeline();
        $page->delete();
        $page_timeline->delete();

        return response()->json(['status' => '200', 'deleted' => true, 'message' => 'Page successfully deleted']);
    }

    public function deletePost(Request $request)
    {
        $post = Post::find($request->post_id);

        if ($post->user->id == Auth::user()->id) {
            $post->deleteMe();
        }
        return response()->json(['status' => '200', 'deleted' => true, 'message' => 'Post successfully deleted']);
    }

    public function reportPost(Request $request)
    {
        $post = Post::where('id', '=', $request->post_id)->first();
        $reported = $post->managePostReport($request->post_id, Auth::user()->id);

        if ($reported) {
            //Notify the user for reporting his post
            Notification::create([
                'user_id' => $post->user_id,
                'post_id' => $request->post_id,
                'notified_by' => Auth::user()->id,
                'description_owner' => Auth::user()->name,
                'description' => trans('common.reported_your_post'),
                'type' => 'report_post'
            ]);

            $post->user_hidden()->save(Auth::user());

            return response()->json(['status' => '200', 'reported' => true, 'message' => 'Post successfully reported']);
        }
    }

    public function singlePost($post_id)
    {
        $mode = 'posts';
        $post = Post::where('id', '=', $post_id)->first();
        $timeline = Auth::user()->timeline;

        $trending_tags = trendingTags();
        $suggested_users = suggestedUsers();
        $suggested_groups = suggestedGroups();
        $suggested_pages = suggestedPages();

        //Redirect to home page if post doesn't exist
        if ($post == null) {
            return redirect('/');
        }
        $theme = Theme::uses('default')->layout('default');
        $theme->setTitle(trans('common.post') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('timeline/single-post',
            compact('post', 'timeline', 'suggested_users', 'trending_tags', 'suggested_groups', 'suggested_pages',
                'mode'))->render();
    }

    public function eventsList(Request $request, $username)
    {
        $mode = "eventlist";

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');

        $user_events = Event::where('user_id', Auth::user()->id)->get();
        $id = Auth::id();

        $trending_tags = trendingTags();
        $suggested_users = suggestedUsers();
        $suggested_groups = suggestedGroups();
        $suggested_pages = suggestedPages();

        $next_page_url = url('ajax/get-more-feed?page=2&ajax=true&hashtag=' . $request->hashtag . '&username=' . $username);

        $theme->setTitle(trans('common.events') . ' | ' . Setting::get('site_title') . ' | ' . Setting::get('site_tagline'));

        return $theme->scope('home',
            compact('next_page_url', 'trending_tags', 'suggested_users', 'suggested_groups', 'suggested_pages', 'mode',
                'user_events', 'username'))
            ->render();
    }

    public function addEvent($username, $group_id = null)
    {
        $timeline_name = '';
        if ($group_id) {
            $group = Group::find($group_id);
            $timeline_name = $group->timeline->name;
        }

        $suggested_users = suggestedUsers();
        $suggested_groups = suggestedGroups();
        $suggested_pages = suggestedPages();

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        return $theme->scope('event-create',
            compact('suggested_users', 'suggested_groups', 'suggested_pages', 'username', 'group_id', 'timeline_name'))
            ->render();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateEventPage(array $data)
    {
//        return Validator::make($data, [
//            'name'        => 'required|max:30|min:5',
//            'start_date'  => 'required',
//            'end_date'    => 'required',
//            'location'    => 'required',
//            'type'        => 'required',
//        ]);

        $validator = Validator::make($data, [
            'name' => 'required|max:30|min:5',
            'start_date' => 'required',
            'end_date' => 'required',
            'location' => 'required',
            'type' => 'required',
            'eticket_event_id' => 'required',
        ]);
//        $validator->errors()->add('eticket_event_id', 'Empty!!!');

        $validator->after(function ($validator) {
            $data = $validator->getData();
            if (!$this->checkEventOnEticket($data['eticket_event_id'])) {
                $validator->errors()->add('eticket_event_id', 'События с таким ID на etickets не существует!');
            }
        });

        return $validator;
    }

    public function createEvent($username, Request $request)
    {
        $validator = $this->validateEventPage($request->all());

//        dd($validator->errors());

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }

        $start_date = date('Y-m-d H:i', strtotime($request->start_date));
        $end_date = date('Y-m-d H:i', strtotime($request->end_date));

        if ($start_date >= date('Y-m-d', strtotime(Carbon::now())) && $end_date >= $start_date) {
            $user_timeline = Timeline::where('username', $username)->first();
            $timeline = Timeline::create([
                'username' => $user_timeline->gen_num(),
                'name' => $request->name,
                'about' => $request->about,
                'type' => 'event',
            ]);

            $event = Event::create([
                'timeline_id' => $timeline->id,
                'type' => $request->type,
                'user_id' => Auth::user()->id,
                'location' => $request->location,
                'start_date' => date('Y-m-d H:i', strtotime($request->start_date)),
                'end_date' => date('Y-m-d H:i', strtotime($request->end_date)),
                'invite_privacy' => Setting::get('invite_privacy'),
                'timeline_post_privacy' => Setting::get('event_timeline_post_privacy'),
                'eticket_event_id' => $request->eticket_event_id,
            ]);

            if ($request->group_id) {
                $event->group_id = $request->group_id;
                $event->save();
            }

            $event->users()->attach(Auth::user()->id);
            Flash::success(trans('messages.create_event_success'));
            return redirect('/' . $timeline->username);
        } else {
            $message = 'Invalid date selection';
            return redirect()->back()->with('message', trans('messages.invalid_date_selection'));
        }
    }

    protected function checkEventOnEticket($id)
    {
        $client = new \GuzzleHttp\Client();

        $data = [
            'lang' => 'ua',
            'link' => $id,
        ];

        $response = $client->request('POST', 'https://e-tickets.esvoe.com/e_events', ['form_params' => $data]);
        $responseBody = json_decode($response->getBody(), true);

        if (!isset($responseBody['code']) || $responseBody['code'] != '1' || empty($responseBody['data'])) {
            return false;
        }

        return true;
    }

    //Displaying event posts
    public function getEventPosts($username)
    {
        $user_post = 'event';
        $timeline = Timeline::where('username', $username)->with('event', 'event.users')->first();
        $event = $timeline->event;

        if (!$event->is_eventadmin(Auth::user()->id, $event->id) && !$event->users->contains(Auth::user()->id)) {
            return redirect($username);
        }

        $posts = $timeline->posts()->where('active', 1)->orderBy('created_at', 'desc')->with('comments')->get();

        $next_page_url = url('ajax/get-more-posts?page=2&username=' . $username);

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(trans('common.posts') . ' | ' . Setting::get('site_title') . ' | ' . Setting::get('site_tagline'));

        return $theme->scope('timeline/eventposts',
            compact('timeline', 'posts', 'event', 'next_page_url', 'user_post'))->render();
    }

    //Displaying event guests
    public function displayGuests($username)
    {
        $timeline = Timeline::where('username', $username)->with('event')->first();
        $event = $timeline->event;
        $event_guests = $event->guests($event->user_id);

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(trans('common.invitemembers') . ' | ' . Setting::get('site_title') . ' | ' . Setting::get('site_tagline'));

        return $theme->scope('users/eventguests', compact('timeline', 'event', 'event_guests'))->render();
    }

    public function generalEventSettings($username)
    {
        $timeline = Timeline::where('username', $username)->with('event')->first();

        $event_details = $timeline->event()->first();

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(trans('common.general_settings') . ' | ' . Setting::get('site_title') . ' | ' . Setting::get('site_tagline'));

        return $theme->scope('event/settings', compact('timeline', 'username', 'event_details'))->render();
    }

    public function updateUserEventSettings($username, Request $request)
    {
        $validator = $this->validateEventPage($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }

        $start_date = date('Y-m-d H:i', strtotime($request->start_date));
        $end_date = date('Y-m-d H:i', strtotime($request->end_date));

        if ($start_date >= date('Y-m-d', strtotime(Carbon::now())) && $end_date >= $start_date) {
            $timeline = Timeline::where('username', $username)->first();
            $timeline_values = $request->only('name', 'about');
            $update_timeline = $timeline->update($timeline_values);

            $event = Event::where('timeline_id', $timeline->id)->first();
            $event_values = $request->only('type', 'location', 'invite_privacy', 'timeline_post_privacy');
            $event_values['start_date'] = date('Y-m-d H:i', strtotime($request->start_date));
            $event_values['end_date'] = date('Y-m-d H:i', strtotime($request->end_date));
            $update_values = $event->update($event_values);

            if ($request->group_id) {
                $event->group_id = $request->group_id;
                $event->save();
            }

            Flash::success(trans('messages.update_event_Settings'));
            return redirect()->back();
        } else {
            Flash::error(trans('messages.invalid_date_selection'));
            return redirect()->back();
        }
    }

    public function deleteEvent(Request $request)
    {
        $event = Event::find($request->event_id);

        //Deleting Events
        $event->users()->detach();

        // Deleting event posts
        $event_posts = $event->timeline()->with('posts')->first();

        if (count($event_posts->posts) != 0) {
            foreach ($event_posts->posts as $post) {
                $post->deleteMe();
            }
        }

        //Deleting event notifications
        $timeline_alerts = $event->timeline()->with('notifications')->first();

        if (count($timeline_alerts->notifications) != 0) {
            foreach ($timeline_alerts->notifications as $notification) {
                $notification->delete();
            }
        }

        $event_timeline = $event->timeline();
        $event->delete();
        $event_timeline->delete();

        return response()->json(['status' => '200', 'deleted' => true, 'message' => 'Event successfully deleted']);
    }

    public function allNotifications()
    {
        $mode = 'notifications';
        $notifications = Notification::where('user_id',
            Auth::user()->id)->with('notified_from')->latest()->paginate(Setting::get('items_page', 10));

        $trending_tags = trendingTags();
        $suggested_users = suggestedUsers();
        $suggested_groups = suggestedGroups();
        $suggested_pages = suggestedPages();

        if ($notifications == null) {
            return redirect('/');
        }

        $theme = Theme::uses('default')->layout('default');
        $theme->setTitle(trans('common.notifications') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('timeline/single-post',
            compact('notifications', 'suggested_users', 'trending_tags', 'suggested_groups', 'suggested_pages',
                'mode'))->render();
    }

    public function deleteNotification(Request $request)
    {
        $notification = Notification::find($request->notification_id);
        if ($notification->delete()) {
            Flash::success(trans('messages.notification_deleted_success'));

            return response()->json([
                'status' => '200',
                'notify' => true,
                'message' => 'Notification deleted successfully'
            ]);
        }
    }

    public function deleteAllNotifications(Request $request)
    {
        $notifications = Notification::where('user_id', Auth::user()->id)->get();

        if ($notifications) {
            foreach ($notifications as $notification) {
                $notification->delete();
            }

            Flash::success(trans('messages.notifications_deleted_success'));
            return response()->json([
                'status' => '200',
                'allnotify' => true,
                'message' => 'Notifications deleted successfully'
            ]);
        }
    }

    public function hidePost(Request $request)
    {
        $post = Post::where('id', '=', $request->post_id)->first();

        $post->user_hidden()->save(Auth::user());

        return response()->json(['status' => '200', 'hide' => true, 'message' => 'Post is hidden successfully']);

//        if ($post->user->id == Auth::user()->id) {
        /*        if ($post->timeline->id == Auth::user()->timeline->id) {
                    $post->active = 0;
                    $post->save();
                    $post->save();

                    return response()->json(['status' => '200', 'hide' => true, 'message' => 'Post is hidden successfully']);
                } else {
                    return response()->json(['status' => '200', 'unhide' => false, 'message' => 'Unsuccessful']);
                }*/
    }

    public function linkPreview()
    {
        $linkPreview = new LinkPreview('http://github.com');
        $parsed = $linkPreview->getParsed();
        foreach ($parsed as $parserName => $link) {
            echo $parserName . '<br>';
            echo $link->getUrl() . PHP_EOL;
            echo $link->getRealUrl() . PHP_EOL;
            echo $link->getTitle() . PHP_EOL;
            echo $link->getDescription() . PHP_EOL;
            echo $link->getImage() . PHP_EOL;
            print_r($link->getPictures());
            dd();
        }
    }

    public function deleteGroup(Request $request)
    {
        $group = Group::where('id', '=', $request->group_id)->first();

        $group->timeline->reports()->detach();

        //Deleting events in a group
        if (count($group->getEvents()) != 0) {
            foreach ($group->getEvents() as $event) {
                $event->users()->detach();

                // Deleting event posts
                $event_posts = $event->timeline()->with('posts')->first();

                if (count($event_posts->posts) != 0) {
                    foreach ($event_posts->posts as $post) {
                        $post->deleteMe();
                    }
                }

                //Deleting event notifications
                $timeline_alerts = $event->timeline()->with('notifications')->first();

                if (count($timeline_alerts->notifications) != 0) {
                    foreach ($timeline_alerts->notifications as $notification) {
                        $notification->delete();
                    }
                }

                $event_timeline = $event->timeline();
                $event->delete();
                $event_timeline->delete();
            }
        }
        $group->users()->detach();

        $timeline_alerts = $group->timeline()->with('notifications')->first();

        if (count($timeline_alerts->notifications) != 0) {
            foreach ($timeline_alerts->notifications as $notification) {
                $notification->delete();
            }
        }
        $timeline_posts = $group->timeline()->with('posts')->first();

        if (count($timeline_posts->posts) != 0) {
            foreach ($timeline_posts->posts as $post) {
                $post->deleteMe();
            }
        }
        $group_timeline = $group->timeline();
        $group->delete();
        $group_timeline->delete();

        return response()->json(['status' => '200', 'deleted' => true, 'message' => 'Group successfully deleted']);
    }

    public function allAlbums($username)
    {
        $timeline = Timeline::where('username', $username)->first();
        $albums = $timeline->albums()->with('photos')->get();

        $trending_tags = trendingTags();

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(Auth::user()->name . ' ' . Setting::get('title_seperator') . ' ' . trans('common.albums') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('albums/index', compact('timeline', 'albums', 'trending_tags'))->render();
    }

    public function allPhotos($username)
    {
        $timeline = Timeline::where('username', $username)->first();
        $albums = $timeline->albums()->get();

        if (count($albums) > 0) {
            foreach ($albums as $album) {
                $photos[] = $album->photos()->where('type', 'image')->get();
            }
            foreach ($photos as $photo) {
                foreach ($photo as $image) {
                    $images[] = $image;
                }
            }
        }
        $trending_tags = trendingTags();

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(Auth::user()->name . ' ' . Setting::get('title_seperator') . ' ' . trans('common.photos') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('albums/photos', compact('timeline', 'images', 'trending_tags'))->render();
    }

    public function allVideos($username)
    {
        $timeline = Timeline::where('username', $username)->first();
        if (Setting::get('announcement') != null) {
            $election = Announcement::find(Setting::get('announcement'));
        }

        $albums = $timeline->albums()->get();

        if (count($albums) > 0) {
            foreach ($albums as $album) {
                $photos[] = $album->photos()->where('type', 'youtube')->get();
            }
            foreach ($photos as $photo) {
                foreach ($photo as $video) {
                    $videos[] = $video;
                }
            }
        }

        $trending_tags = trendingTags();

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(Auth::user()->name . ' ' . Setting::get('title_seperator') . ' ' . trans('common.photos') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('albums/videos', compact('timeline', 'videos', 'trending_tags', 'election'))->render();
    }

    public function viewAlbum($username, $id)
    {
        $timeline = Timeline::where('username', $username)->first();
        $album = Album::where('id', $id)->with('photos')->first();

        $trending_tags = trendingTags();

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle($album->name . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('albums/show', compact('timeline', 'album', 'trending_tags'))->render();
    }

    public function albumPhotoEdit(Request $request)
    {
        $media = Media::find($request->media_id);
        if ($media->source) {
            return response()->json(['status' => '200', 'photo_src' => true, 'pic_source' => $media->source]);
        } else {
            return response()->json(['status' => '200', 'photo_src' => false]);
        }
    }

    public function createAlbum($username)
    {
        $suggested_users = suggestedUsers();
        $suggested_groups = suggestedGroups();
        $suggested_pages = suggestedPages();

        $timeline = Timeline::where('username', Auth::user()->username)->first();

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(trans('common.create_album') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('albums/create',
            compact('suggested_users', 'suggested_groups', 'suggested_pages', 'timeline'))->render();
    }

    protected function albumValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:30|min:5',
            'privacy' => 'required'
        ]);
    }

    public function saveImage(Request $request, $username)
    {

        $this->validate($request, [
            'file' => 'mimes:jpeg,bmp,png|dimensions:min_width=200,min_height=200'
        ]);
        // todo add max_file_size_validation max: get_max_file_size()

        $maxDims = config('image.max_user_image_dimensions');
        $file = $request->file('file');
        $strippedName = str_replace(' ', '', $file->getClientOriginalName());
        $photoName = date('Y-m-d-H-i-s') . $strippedName;
        $photo = Image::make($file->getRealPath());

        if (is_int($maxDims['width']) and is_int($maxDims['height'])) {
            $photo->resize($maxDims['width'], $maxDims['height'], function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        Storage::disk('albums')->makeDirectory($username . '/tmp');
        $photo->save(storage_path("uploads/albums/{$username}/tmp/{$photoName}"), 60);

    }

    public function saveAlbum(Request $request, $username)
    {
        // $validator = $this->albumValidator($request->only('name','privacy'));

        // if ($validator->fails()) {
        //     return redirect()->back()
        //           ->withInput($request->all())
        //           ->withErrors($validator->errors());
        // }

        $files = Storage::disk('albums')->files($username . '/tmp');

        if (count($files) < 1 || $request->name == null || $request->privacy == null) {
            Flash::error(trans('messages.album_validation_error'));
            return redirect()->back();
        }

        $input = $request->except('_token');
        $input['timeline_id'] = Timeline::where('username', $username)->first()->id;
        $album = Album::create($input);

        foreach ($files as $album_photo) {

            $fileName = File::basename($album_photo);
            $strippedName = str_replace(' ', '', $fileName);
            $photoName = date('Y-m-d-H-i-s') . $strippedName;
            $photoName = implode('/', array_slice(explode('-', $photoName), 0, 5)) . '/' . $photoName;

            Storage::disk('albums')->move($album_photo, $username . "/" . $photoName);

            $media = Media::create([
                'title' => $fileName,
                'type' => 'image',
                'source' => $photoName,
            ]);

            $album->photos()->attach($media->id);
        }

        if ($request->album_videos[0] != null) {
            foreach ($request->album_videos as $album_video) {
                $match;
                if (preg_match("/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/", $album_video, $match)) {
                    if ($match[2] != null) {
                        $videoId = Youtube::parseVidFromURL($album_video);
                        $video = Youtube::getVideoInfo($videoId);

                        $video = Media::create([
                            'title' => $video->snippet->title,
                            'type' => 'youtube',
                            'source' => $videoId,
                        ]);
                        $album->photos()->attach($video->id);
                    } else {
                        Flash::error(trans('messages.not_valid_url'));
                        return redirect()->back();
                    }
                } else {
                    Flash::error(trans('messages.not_valid_url'));
                    return redirect()->back();
                }
            }
        }

        Storage::disk('albums')->deleteDirectory($username . '/tmp');

        if ($album) {
            Flash::success(trans('messages.create_album_success'));
            return redirect('/' . $username . '/album/show/' . $album->id);
        } else {
            Flash::error(trans('messages.create_album_error'));
        }
        return redirect()->back();
    }

    public function editAlbum($username, $id)
    {
        $album = Album::where('id', $id)->with('photos')->first();

        $trending_tags = trendingTags();

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle($album->name . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('albums/edit', compact('album', 'trending_tags'))->render();
    }

    public function updateAlbum($username, $id, Request $request)
    {
        // $validator = $this->albumValidator($request->all());

        // if ($validator->fails()) {
        //     return redirect()->back()
        //           ->withInput($request->all())
        //           ->withErrors($validator->errors());
        // }
        if ($request->name == null || $request->privacy == null) {
            Flash::error(trans('messages.album_validation_error'));
            return redirect()->back();
        }

        $album = Album::findOrFail($id);
        $input = $request->except('_token', 'album_photos');
        $album->update($input);

        $files = Storage::disk('albums')->files($username . '/tmp');

        if (count($files)) {
            $maxDims = config('image.max_user_image_dimensions');
            foreach ($files as $album_photo) {

                $fileName = File::basename($album_photo);
                $strippedName = str_replace(' ', '', $fileName);
                $photoName = date('Y-m-d-H-i-s') . $strippedName;
                $photoName = implode('/', array_slice(explode('-', $photoName), 0, 5)) . '/' . $photoName;

                Storage::disk('albums')->move($album_photo, $username . "/" . $photoName);

                $media = Media::create([
                    'title' => $fileName,
                    'type' => 'image',
                    'source' => $photoName,
                ]);
                $album->photos()->attach($media->id);
            }
        }

        if ($request->album_videos[0] != null) {
            foreach ($request->album_videos as $album_video) {
                $match;
                if (preg_match("/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/", $album_video, $match)) {
                    if ($match[2] != null) {
                        $videoId = Youtube::parseVidFromURL($album_video);
                        $video = Youtube::getVideoInfo($videoId);

                        $video = Media::create([
                            'title' => $video->snippet->title,
                            'type' => 'youtube',
                            'source' => $videoId,
                        ]);
                        $album->photos()->attach($video->id);
                    } else {
                        Flash::error(trans('messages.not_valid_url'));
                        return redirect()->back();
                    }
                } else {
                    Flash::error(trans('messages.not_valid_url'));
                    return redirect()->back();
                }
            }
        }

        Storage::disk('albums')->deleteDirectory($username . '/tmp');

        if ($album) {
            Flash::success(trans('messages.update_album_success'));
            return redirect('/' . $username . '/album/show/' . $album->id);
        } else {
            Flash::error(trans('messages.update_album_error'));
        }
        return redirect()->back();
    }

    public function deleteAlbum($username, $photo_id)
    {
        $album = Album::findOrFail($photo_id);
        $album->photos()->detach();
        if ($album->delete()) {
            Flash::success(trans('messages.delete_album_success'));
        } else {
            Flash::error(trans('messages.delete_album_error'));
        }
        return redirect('/' . $username . '/albums');
    }

    public function addPreview($username, $id, $photo_id)
    {
        $album = Album::findOrFail($id);
        $album->preview_id = $photo_id;
        if ($album->save()) {
            Flash::success(trans('messages.update_preview_success'));
        } else {
            Flash::error(trans('messages.update_preview_error'));
        }
        return redirect()->back();
    }

    public function deleteMedia($username, $photo_id)
    {
        $media = Media::find($photo_id);
        $media->albums()->where('preview_id', $media->id)->update(['albums.preview_id' => null]);
        $media->albums()->detach();

        if ($media->delete()) {
            Flash::success(trans('messages.delete_media_success'));
        } else {
            Flash::error(trans('messages.delete_media_error'));
        }
        return redirect()->back();
    }

    public function unjoinPage(Request $request)
    {
        $page = Page::where('timeline_id', '=', $request->timeline_id)->first();

        if ($page->users->contains(Auth::user()->id)) {
            $page->users()->detach([Auth::user()->id]);

            return response()->json([
                'status' => '200',
                'join' => true,
                'username' => Auth::user()->username,
                'message' => 'successfully unjoined'
            ]);
        }
    }

    public function saveWallpaperSettings($username, Request $request)
    {
        if ($request->wallpaper == null) {
            Flash::error(trans('messages.no_file_added'));
            return redirect()->back();
        }

        $timeline = Timeline::where('username', $username)->first();
        $result = $timeline->saveWallpaper($request->wallpaper);
        if ($result) {
            Flash::success(trans('messages.wallpaper_added_activated'));
            return redirect()->back();
        }
    }

    public function toggleWallpaper($username, $action, Media $media)
    {
        $timeline = Timeline::where('username', $username)->first();

        $result = $timeline->toggleWallpaper($action, $media);

        if ($result == 'activate') {
            Flash::success(trans('messages.activate_wallpaper_success'));
        }
        if ($result == 'deactivate') {
            Flash::success(trans('messages.deactivate_wallpaper_success'));
        }
        return Redirect::back();
    }

    public function pageWallpaperSettings($username)
    {
        $timeline = Timeline::where('username', $username)->first();
        $wallpapers = Wallpaper::all();

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(trans('common.wallpaper_settings') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('page/settings/wallpaper', compact('timeline', 'wallpapers'))->render();
    }

    public function groupGeneralSettings($username)
    {
        $timeline = Timeline::where('username', $username)->first();

        $group_details = $timeline->groups()->first();

        $group = Group::where('timeline_id', '=', $timeline->id)->first();

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(trans('common.group_settings') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('group/settings/general', compact('timeline', 'username', 'group_details'))->render();
    }

    public function groupWallpaperSettings($username)
    {
        $timeline = Timeline::where('username', $username)->first();
        $wallpapers = Wallpaper::all();

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $theme->setTitle(trans('common.wallpaper_settings') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_title') . ' ' . Setting::get('title_seperator') . ' ' . Setting::get('site_tagline'));

        return $theme->scope('group/settings/wallpaper', compact('timeline', 'wallpapers'))->render();
    }

    public function hideComment(Request $request)
    {
        $comment = Comment::where('id', '=', $request->comment_id)->first();

        $comment->user_hidden()->save(Auth::user());

        return response()->json(['status' => '200', 'hide' => true, 'message' => 'Comment is hidden successfully']);
    }

    public function editComment(Request $request)
    {
        $comment = Comment::where('id', '=', $request->comment_id)->first();

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('ajax');
        $editCommentHtml = $theme->partial('edit-comment', compact('comment'));

        return response()->json(['status' => '200', 'data' => $editCommentHtml]);
    }

    public function saveEditComment(Request $request)
    {
        $comment = Comment::where('id', '=', $request->comment_id)->first();

        $comment->description = $request->description;

        $comment->save();

        return response()->json([
            'status' => '200',
            'edit' => true,
            'message' => 'Comment is saved',
            'data' => $request->description
        ]);
    }


    public function getNextPostComments(Request $request)
    {
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');

        $post = Post::where('id', $request->post_id)->first();

        $comments = Comment::where('post_id', $post->id)->latest()->paginate(Setting::get('items_page', 10));

        $responseHtml = '';
        foreach ($comments as $comment) {
            $responseHtml .= $theme->partial('comment', ['comment' => $comment, 'post' => $post]);

        }

//        return $responseHtml;

        return response()->json([
            'status' => '200',
            'comments' => $responseHtml,
            'comment_next_page_url' => $comments->appends(['ajax' => true])->nextPageUrl()
        ]);
    }
}
