<?php
/**
 * Created by PhpStorm.
 * User: zeratul
 * Date: 27.09.2017
 * Time: 19:28
 */

namespace App\Http\Controllers\Applications;


use App\Application;
use App\ApplicationUser;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Illuminate\Http\Request;

class ApplicationAPIController extends Controller
{
    //app_id - ID приложения
    //app_key - уникальный ключ приложения
    //app_secret_key - секретный ключ приложения
    //session_key - сессия пользователя
    //session_secret_key - ключ сесси = MD5(access_token + application_secret_key), для вызова без сессии считаем session_secret_key = application_secret_key;
    //access_token - токен сгенерированный на автризации


    /**
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * @var array
     */
    private $apiParams = array();

    /**
     * @var String
     */
    private $apiMethod = null;

    /**
     * @var int
     */
    private $apiLevel = 0;

    /**
     * @var \App\Application
     */
    private $application;

    /**
     * @var \App\ApplicationUser
     */
    private $applicationUser;

    public function __construct(Request $request)
    {
        $this->request = $request;
        \Log::useDailyFiles(storage_path().'/logs/application-api.log');
    }

    public function simple() {
        $this->apiParams = $this->request->all();
        return $this->authorizeRequest();
    }

    public function internal() {
        return response()->json(array(
            'status' => 200,
            'data' => 'internal'
        ));
    }

    public function router($group, $method)
    {
        $this->apiParams = $this->request->all();
        $this->apiParams['method'] = $group . '.' . $method;

        return $this->authorizeRequest();
    }

    private function authorizeRequest() {

        $params = $this->apiParams;

        $auth_params = array ( 'app-id' => null, 'app-key' => null, 'access-token' => null, 'session-key' => null, 'session-secret-key' => null, 'sign' => null, 'timestamp' => null );
        foreach ( $auth_params as $key => $val ) {
            if ($this->request->has($key)) $auth_params[$key] = $this->request->get($key);
            if (in_array($key, ['sign', 'access-token', 'session-key', 'session-secret-key'])) {
                if ($this->request->headers->has($key)) $auth_params[$key] = $this->request->headers->get($key);
            }
        }
        $auth_params['app-id'] = (int) $auth_params['app-id'];
        $auth_params['timestamp'] = (int) $auth_params['timestamp'];

        // second validation
        if ( $auth_params['app-id'] <= 0 || ! $auth_params['sign'] ) {
            return response()->json(array(
                'code' => 1001,
                'data' => 'parameters.damaged',
                'message' => 'missing.auth.parameters.app_or_sign'
            ), 400);
        }

        if ( $auth_params['timestamp'] <= 0) {
            return response()->json(array(
                'code' => 1001,
                'data' => 'parameters.damaged',
                'message' => 'missing.auth.parameters.timestamp'
            ), 400);
        }

        // timestamp no late more than 12 hours

        $this->application = Application::where('id', $auth_params['app-id'])
            ->where('is_active', true)
            ->first();

        if ( ! $this->application ) {
            return response()->json(array(
                'code' => 1001,
                'data' => 'parameters.damaged',
                'message' => 'application.not.found'
            ), 400);
        }

        if ( ! $auth_params['access-token'] && ! $auth_params['session-key'] ) {
            // SERVER RELATED REQUESTS
            $auth_params['session-secret-key'] = $this->application->api_private_key;
            $this->apiLevel = 1; // server-server

            // server requests validates here
        }
        else {
            // USER RELATED REQUESTS
            if ($auth_params['session-key']) {
                $this->applicationUser = ApplicationUser::where('app_id', $this->application->id)
                    ->where('authorized', true)
                    ->where('banned', false)
                    ->where('api_session_key', $auth_params['session-key'])
                    ->where('api_session_key_expire', '>', time())
                    ->first();
            }
            else if ($auth_params['access-token']) {
                $this->applicationUser = ApplicationUser::where('app_id', $this->application->id)
                    ->where('authorized', true)
                    ->where('banned', false)
                    ->where('api_access_token', $auth_params['access-token'])
                    ->where('api_access_token_expire', '>', time())
                    ->first();
            }

            if ( ! $this->applicationUser ) {
                return response()->json(array(
                    'code' => 1001,
                    'data' => 'parameters.damaged',
                    'message'=>'user.link.not.found'
                ), 400);
            }

            if ( ! $auth_params['session-secret-key'] ) {
                if ( ! $auth_params['session-key'] ) {
                    $auth_params['session-secret-key'] = $this->application->api_private_key;
                    $this->apiLevel = 1; // server-server
                }
                else {
                    $auth_params['session-secret-key'] = sha1(strtolower($auth_params['access-token']) . $this->application->api_signing_key);
                    $this->apiLevel = 2; // application-sever (using access token)
                }
            } else {
                if ($auth_params['session-secret-key'] !== sha1($this->applicationUser->id . $this->applicationUser->api_session_key . $this->application->id . $this->application->api_signing_key . $this->application->api_private_key . '_secret_')) {
                    return response()->json(array(
                        'code' => 1001,
                        'data' => 'parameters.damaged',
                        'message' => 'session.missmatch',
                        //'valid' => sha1($this->applicationUser->id . $this->applicationUser->api_session_key . $this->application->id . $this->application->api_signing_key . $this->application->api_private_key . '_secret_')
                    ), 400);
                }
                $this->apiLevel = 3;
            }

            // client requests validates here.

        }

        ksort($params);
        $paramsString = '';
        foreach ($params as $k=>$v) {
            if ($k === 'access-token' || $k === 'session-key' || $k === 'session-secret-key' || $k === 'sign') continue;
            $paramsString .= $k.'='.$v;
        }
        $paramsString .= $auth_params['session-secret-key'];

        if ($auth_params['sign'] !== sha1($paramsString)) {
            return response()->json(array(
                'code' => 1001,
                'data' => 'parameters.damaged',
                'message' => 'signature.missmatch',
                //'valid' => sha1($paramsString)
            ), 400);
        }

        $this->apiMethod = $this->apiParams['method'];

        return $this->processRequest();
    }

    private function processRequest() {

        if ($this->apiMethod === 'user.info') {

            // check ip filters
            // check access level
            // check something more

            // collect data
            $user = User::where('id', $this->applicationUser->user_id)
                ->with('profile')
                ->first();

            if ( ! $user) {
                return response()->json(array(
                    'code' => 1100,
                    'data' => 'user.not.found',
                    'msg' => 'user_not_found'
                ), 200);
            }

            // update only if not expired

            $this->applicationUser->api_session_key_expire = time() + (60 * 30); // 30 minutes
            $this->applicationUser->update();

            return response()->json(array(
                "name" => $user->profile->firstname,
                "firstname" => $user->profile->firstname,
                "lastname" => $user->profile->lastname,
                "lang" => $user->language,
                "avatar" => $user->avatar,
            ), 200);
        }

        if ($this->apiMethod === 'user.profile') {

            // must access level
            // must have appUser
            // must permissions profile,

            $user = User::where('id', $this->applicationUser->user_id)
                ->with('profile')
                ->first();

            if ( ! $user) {
                return response()->json(array(
                    'code' => 1100,
                    'data' => 'user.not.found',
                    'msg' => 'user_not_found'
                ), 200);
            }

            $this->applicationUser->api_session_key_expire = time() + (60 * 30); // 30 minutes
            $this->applicationUser->update();

            return response()->json(array(
                "user_id" => $user->id,
                "firstname" => $user->profile->firstname,
                "lastname" => $user->profile->lastname,
                "avatar" => $user->avatar,
                "country" => $user->profile->country,
                "city" => $user->profile->city,
                "gender" => $user->profile->gender,
                "birthday" => $user->profile->birthday,
                "hobbies" => $user->profile->hobbies,
                "interests" => $user->profile->interests,
                "lang" => $user->language,
            ), 200);

        }

        if ($this->apiMethod === 'friend.list') {

            // must access level
            // must have appUser
            // must permissions profile,

            $user = $this->applicationUser->user;

            if ( ! $user) {
                return response()->json(array(
                    'code' => 1100,
                    'data' => 'user.not.found',
                    'msg' => 'user_not_found'
                ), 200);
            }

            // update only if not expired

            $this->applicationUser->api_session_key_expire = time() + (60 * 30); // 30 minutes
            $this->applicationUser->update();

            $ids = DB::table('followers')
                ->where('follower_id', $user->id)
                ->where('type_friend', config('friend.type.approve'))
                ->pluck('leader_id')->toArray();

            $users = User::whereIn('id', $ids)
                ->with('profile')
                ->get();

            $friend_list = [];

            foreach( $users as $friend ) {
                $friend_data = array(
                    'user_id' => $friend->id,
                    'userId' => $friend->id,
                    'name' => $friend->profile->firstname, //deprecated
                    'firstname' => $friend->profile->firstname,
                    'lastname' => $friend->profile->lastname,
                    'avatar' => $friend->avatar
                );
                $friend_list[] = $friend_data;
            }

            return response()->json(array(
                "friends" => $friend_list,
            ), 200);

        }

    }

}