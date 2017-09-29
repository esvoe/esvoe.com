<?php
namespace App\Http\Controllers;

use App\User;
use App\Setting;
use App\Timeline;
use App\UserProfile;
use App\Wallet;
use App\Repositories\WalletRepository;
use App\Http\Requests;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Teepluss\Theme\Facades\Theme;
use Response;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;
use DB;

class FriendController extends Controller
{
    /** @var WalletRepository */
    private $walletRepository;
    
//    private $timeline;
    private $client;
    private $request;
    private $domain = 'http://localhost:5511/api/v1/';

    public function __construct(WalletRepository $walletRepo, Request $request)
    {
        $this->client = new Client;
        $this->request = $request;
        $this->walletRepository = $walletRepo;
        Log::useDailyFiles(storage_path().'/logs/friend.log');
    }

    public function index($username)
    {
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $relations = [];
        $relations['friends'] = Auth::user()->following()
            ->where('type_friend', config('friend.type.approve'))
            ->latest()->get()
            ->map(function ($user) {
                return TimelineController::getRelationOf($user);
            });

        $relations['followers'] = Auth::user()->following()
            ->where('is_follower', '1')
            ->latest()->get()
            ->map(function ($user) {
                return TimelineController::getRelationOf($user);
            });
        $relations['family'] = Auth::user()->following()
            ->whereNotNull('relative_id')
            ->latest()->get()
            ->map(function ($user) {
                return TimelineController::getRelationOf($user);
            });

        $available_relative = TimelineController::getRelative(Auth::user()->profile->gender);
        $inviteList = $this->loadFriend(Auth::user()->id);
        $suggested_users = suggestedUsers();

        return $theme->scope('friend/index', compact('relations', 'available_relative', 'inviteList', 'suggested_users'))->render();
    }

    public function tempShowInviteFriends() {
        $theme = Theme::uses('default')->layout('default');
        return $theme->scope('friend/single-post')->render();
    }

    public function showInviteFriends() {
        $inviteList = $this->loadFriend(Auth::user()->id);
        $countRequests = count($inviteList);
        $suggested_users = suggestedUsers();
        $theme = Theme::uses('default')->layout('default');
        return $theme->scope('friend/invite-friends', compact('inviteList', 'countRequests', 'suggested_users'))->render();
    }

    public function listInviteFriends()
    {
        $inviteList = $this->loadFriend(Auth::user()->id);
        if ($inviteList === FALSE) return '';
        $countRequests = count($inviteList);
        if ($countRequests > 5) {
            $inviteList = array_slice($inviteList, 0, 5);
        }
        $suggested_users = suggestedUsers();

        $theme = Theme::uses('default')->layout('ajax');
        return $theme->scope('friend/invite-item', compact('inviteList', 'countRequests', 'suggested_users'))->render();
//        return Theme::uses('default')->partial('friend/invite-item', compact('inviteList', 'countRequests'))->render();//take from partial
    }

    public function findPeople()
    {
        $query = DB::table('user_profiles');
        $is_start = false;
        if (null != $this->request->get('firstname') AND strlen($this->request->get('firstname')) > 3) {
            $query->where('firstname', 'like', "%{$this->request->get('firstname')}%");
            $is_start = true;
        }
        if (null != $this->request->get('lastname') AND strlen($this->request->get('lastname')) > 2) {
            $query->where('lastname', 'like', "%{$this->request->get('lastname')}%");
            $is_start = true;
        }
        if (null != $this->request->get('country') AND strlen($this->request->get('country')) > 2) {
            $query->where('country', 'like', "%{$this->request->get('country')}%");
            $is_start = true;
        }
        if (null != $this->request->get('city') AND strlen($this->request->get('city')) > 2) {
            $query->where('city', 'like', "%{$this->request->get('city')}%");
            $is_start = true;
        }
        if (null != $this->request->get('sex') AND strlen($this->request->get('sex')) > 2) {
            $query->where('gender', '=', $this->request->get('sex'));
            $is_start = true;
        }

        if (! $is_start) {
            return '';
        }

        $peopleList = $query
            ->join('users', 'user_profiles.user_id', '=', 'users.id')
            ->leftJoin('followers',function ($join) {
                $join->on('user_profiles.user_id', '=', 'followers.leader_id')
                ->where('followers.follower_id', '=', Auth::user()->id);
            })
            ->select('users.esvoe_id', 'user_id', 'firstname', 'lastname', 'avatar', 'gender', 'city', 'followers.type_friend')
            ->orderBy('user_profiles.id', 'desc')
            ->take(20)
            ->get();
//        dd($peopleList);
        if ($peopleList === FALSE) return '';

        $theme = Theme::uses('default')->layout('ajax');
        return $theme->scope('friend/find-people-item', compact('peopleList'))->render();
    }

    public function loadFriend($userId) {
        try {
            $res = $this->client->request('GET', $this->domain.'friend/invite/list/'.$userId);
        } catch (ClientException $e2) {
            Log::info('inviteList: ClientException = '.$e2. ' userId='.$userId);
            return array();
        } catch (RequestException $e) {
            Log::info('inviteList: RequestException = '.$e. ' userId='.$userId);
            return array();
        }
//        $countRequests = Auth::user()->followers()->where('type_friend', '=', '1')->count();

        $body = $res->getBody()->getContents();
        $inviteList = array();
        $js = json_decode($body, true);
        if ($js['err'] == 0) {
            $inviteList = $js['friends'];
        }
        return $inviteList;
    }

    public function prepareJson($res)
    {
        $body = $res->getBody()->getContents();
        Log::info('response: '.var_export($body, true));
        $result = $res->getStatusCode() == 200;
        if ($result) {
            $js = json_decode($body, true);
            $result = $js['err'] == 0 && $js['isValue'];
            Log::info('result: '.$result. ' err='.$js['err']. ' | obj = '.var_export($js, true));
        }
        return response()->json(['status' => '200', 'accepted' => true, 'result' => $result?'true':'false']);//, 'msg' => ''
    }

    public function addFriend(Request $request)
    {
//        $user = User::find($request->user_id);
//        $follow_user = $user->updateFollowStatus($request->user_id);
//        if ($follow_user) {
//            Flash::success(trans('messages.request_accepted'));
//        }
//        Notification::create(['user_id' => $request->user_id, 'timeline_id' => $user->timeline_id, 'notified_by' => Auth::user()->id, 'description' => Auth::user()->name.' '.trans('common.accepted_follow_request'), 'type' => 'accept_follow_request', 'link' => Auth::user()->username.'/followers']);
//        $res = $this->client->get($this->domain.'friend/add/'.Auth::user()->id.'/to/'.$request->user_id);
//        $result = $res->getStatusCode() == 200;
//        return response()->json(['status' => "{$res->getStatusCode()}", 'accepted' => true, 'result' => $result?'true':'false']);
//        return response()->json(['status' => '200', 'accepted' => true, 'result' => 'true']);
        try {
            $res = $this->client->get($this->domain . 'friend/add/' . Auth::user()->id . '/to/' . $request->user_id);
        } catch (ClientException $e2) {
            Log::info('inviteList: ClientException = '.$e2. ' userId='.$request->user_id);
            return response()->json(['status' => '201', 'accepted' => true, 'result' => 'false']);
        } catch (RequestException $e) {
            Log::info('inviteList: RequestException = '.$e .' - user='. $request->user_id);
            return response()->json(['status' => '201', 'accepted' => true, 'result' => 'false']);
        }
        return $this->prepareJson($res);
        //return $this->prepareJson($this->client->get($this->domain.'friend/add/'.Auth::user()->id.'/to/'.$request->user_id));
    }

    public function deleteFriend(Request $request)
    {
        $res = $this->client->get($this->domain.'friend/delete/'.Auth::user()->id.'/to/'.$request->user_id);
        return $this->prepareJson($res);
    }

    public function inviteCancel(Request $request) {
        return $this->prepareJson($this->client->get($this->domain.'friend/invite/cancel/'.Auth::user()->id.'/to/'.$request->user_id));
    }

    public function inviteAccept(Request $request) {
        return $this->prepareJson($this->client->get($this->domain.'friend/invite/approve/'.Auth::user()->id.'/to/'.$request->user_id));
    }

    public function inviteReject(Request $request) {
        return $this->prepareJson($this->client->get($this->domain.'friend/invite/reject/'.Auth::user()->id.'/to/'.$request->user_id));
    }

    public function followerAdd(Request $request) {
        return $this->prepareJson($this->client->get($this->domain.'follower/add/'.Auth::user()->id.'/to/'.$request->user_id));
    }

    public function followerRemove(Request $request) {
        return $this->prepareJson($this->client->get($this->domain.'follower/delete/'.Auth::user()->id.'/to/'.$request->user_id));
    }

    public function complain(Request $request) {
        return $this->prepareJson($this->client->get($this->domain.'user/complain/add/'.Auth::user()->id.'/to/'.$request->user_id));
    }

    public function block(Request $request) {
        return $this->prepareJson($this->client->get($this->domain.'user/block/add/'.Auth::user()->id.'/to/'.$request->user_id));
    }

    public function setStatus(Request $request) {
//        return response()->json(['status' => '200', 'accepted' => true, 'result' => 'true']);
        return $this->prepareJson($this->client->get($this->domain.'friend/status/add/'.Auth::user()->id.'/to/'.$request->user_id.'/'.$request->status));
    }

    public function setRelative(Request $request) {
        return $this->prepareJson($this->client->get($this->domain.'relative/set/'.Auth::user()->id.'/to/'.$request->user_id.'/'.$request->relative));
    }

}    

