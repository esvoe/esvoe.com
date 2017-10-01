<?php
/**
 * Created by PhpStorm.
 * User: zeratul
 * Date: 12.09.2017
 * Time: 18:30
 */

namespace App\Http\Controllers\Applications;


use App\Models\Application;
use App\Models\ApplicationEndpoint;
use App\Models\ApplicationLog;
use App\Models\ApplicationUser;
use App\Http\Controllers\Controller;
use App\Setting;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Teepluss\Theme\Facades\Theme;

class AuthController extends Controller
{
    /**
     * @var \Illuminate\Http\Request
     */
    private $request;

    private $authSession = null;


    public function __construct(Request $request)
    {

        $this->request = $request;

        Log::useDailyFiles(storage_path().'/logs/oauth.log');

    }


    private function renderView($view, $args = array(), $layout = 'oauth') {

        return
            Theme::uses(Setting::get('current_theme', 'default'))->layout($layout)
            ->scope($view, $args)->render();
    }

    public function index() {

        $this->dropAuthSession();

        $validation = Validator::make($this->request->all(), [
            'id' => array(
                'required',
                'numeric',
            ),
            'perms' => array(
                'regex:/[a-zA-Z_,\-]+/u', // fixme: invalid chars allowed (NOT WORK AT ALL ! )
                'string',
            ),
            'params' => array(
                'string',
                'regex:/[\w\s]?/u'
            ),
            'endpoint' => array(
                'string',
            ),
            'explicit_auth' => array(
                'numeric'
            ),
            'explicit_perms' => array(
                'numeric'
            )
        ]);

        // call api on auth -> setting in apps

        if ($validation->fails()) {
            return redirect()->route('developer.oauth.error', array(
                'code' => 1201,
                'message' => 'WRONG_PARAMS'
            ));
        }

        // save values for next redirect

        $auth_id = (int) $this->request->get('id');

        $application = Application::where('id', $auth_id)
            ->where('is_active', true)
            // parameter allow auth
            ->first();

        if ( ! $application ) {
            return redirect()->route('developer.oauth.error', array(
                'code' => 1202,
                'message' => 'APPLICATION_NOT_FOUND'
            ));
        }

        //dd($application->permissions);

        if ( ! is_array($application->permissions)) {
            return redirect()->route('developer.oauth.error', array(
                'code' => 1240, // WRONG APP SETTINGS
                'message' => 'APP_SETTINGS_DAMAGED(PERMISSIONS)'
            ));
        }

        $appSettings = $application->settings;

        $requirePerms = $this->request->get('perms',[]);
        if ( $requirePerms ) {
            $requirePerms = explode('|', $requirePerms);
            foreach ($requirePerms as $k => $v) {
                $v = strtolower(trim($v));
                // todo: check if exists
                if ( ! $v) {
                    unset($requirePerms[$k]);
                } else {
                    $requirePerms[$k] = $v;
                }
            }
        }

        $redirectHash = $this->request->get('endpoint');
        $redirectUri = route('developer.oauth.redirect');

        $authSiteUri = null;

        if ( $redirectHash ) {

            $endpoint = ApplicationEndpoint::where('app_id', $application->id)
                ->where('name', $redirectHash)
                ->first();

            if ( ! $endpoint || ! $endpoint->redirect) {
                return redirect()->route('developer.oauth.error', array(
                    'code' => 1240, // WRONG APP SETTINGS
                    'message' => 'APP_SETTINGS_DAMAGED(AUTH.ENDPOINTS)',
                    'hash' => $redirectHash
                ));
            }


            $redirectUri = $endpoint->redirect;


            $authSiteUri = $endpoint->uri;

        }

        if ($authSiteUri) {
            // fixme: Theme not allow change headers  $response->header('X-Frame-Options', 'ALLOW-FROM '.$authSiteUri);
            // disable guard App::forgetMiddleware('Illuminate\Http\FrameGuard');
            //'X-Frame-Options' => 'DENY',
        }

        $redirectParams = $this->request->get('params');

        $explicitAuth = $this->request->get('explicit_auth') == 1;
        $explicitPerms = $this->request->get('explicit_perms') == 1;

        $authToken = sha1(random_bytes(20));

        $this->authSession = array(
            'app_id' => $application->id,
            'user_id' => 0,
            'perms'  => $requirePerms,
            'params' => $redirectParams,
            'redirect_uri' => $redirectUri,
            'redirect_hash' => $redirectHash,
            'redirect_params' => $redirectParams,
            'site_uri' => $authSiteUri,
            'explicit_auth' => $explicitAuth,
            'explicit_perms' => $explicitPerms,
            'user_ip' => \Request::ip(),
            'hash'=> bin2hex(random_bytes(5)),
            'time'=> time(),
            'auth_token' => $authToken,
            'time_create' => time(),
            'time_expire' => time() + 600,
        );

        $this->saveAuthSession();

        // get current user
        $user = Auth::user();

        if( ! $user ) {
            return redirect()->route('developer.oauth.login');
        }

        if ( $explicitAuth ) {
            return redirect()->route('developer.oauth.select');
        }

        $this->authSession['user_id'] = $user->id;
        $this->saveAuthSession();

        $applicationUser = ApplicationUser::where('app_id', $application->id)
            ->where('user_id', $user->id)
            ->withTrashed()
            ->first();

        // or app wants more permissions then has user link

        if ( ! $applicationUser ) {
            return redirect()->route('developer.oauth.connect');
        }

        if ( $applicationUser->banned ) {

            $this->authSession['user_id'] = 0;

            $status = 'error';
            $redirectUri = $this->authSession['redirect_uri'];

            $oSign = md5($status.
                $this->authSession['app_id'].
                $this->authSession['time'].
                $this->authSession['hash'].
                $this->authSession['user_id'].
                $application->api_key //fimxe: private_key
            );

            $payload = array(
                'status' => 'error',
                'message' => 'error.user.banned',
                'time' => $this->authSession['time'],
                'hash' => $this->authSession['hash'],
                'sign' => $oSign,
                'app_id' => $this->authSession['app_id'],
                'user_id' => $this->authSession['user_id'],
                'params' => $this->authSession['params'],
            );

            $this->dropAuthSession();
            $delim = strpos($redirectUri, "?") !== false ? '#' : '?';
            return redirect($redirectUri.$delim.http_build_query($payload));

        }

        if ( ! $applicationUser->authorized || $applicationUser->trashed() || $explicitPerms ) {
            return redirect()->route('developer.oauth.connect');
        }

        // Compare userLink permissions with requested permissions

        $requirePerms = array_merge(['authorize'], $application->permissions, $this->authSession['perms']);


        $currentPerms = $applicationUser->permissions;
        $permsGranted = count(array_intersect($currentPerms, $requirePerms)) == count($requirePerms);


        if ( ! $permsGranted ) {
            return redirect()->route('developer.oauth.connect');
        }

        // COMPLETE AUTH WITH 'authorized' status

        $status = 'authorize';
        $resultPerms = implode('|',$currentPerms);
        $oSign = md5($status.
            $this->authSession['app_id'].
            $this->authSession['time'].
            $this->authSession['hash'].
            $this->authSession['user_id'].
            $application->api_key
        );

        // replace auth token with existed
        $this->authSession['auth_token'] = $applicationUser->api_access_token;
        // todo: extend auth_token life

        $payload = array(
            'status' => $status,
            'time' => $this->authSession['time'],
            'hash' => $this->authSession['hash'],
            'sign' => $oSign,
            'app_id' => $this->authSession['app_id'],
            'user_id' => $this->authSession['user_id'],
            'perms' => $resultPerms,
            'token' => $this->authSession['auth_token'], //???
            'params' => $this->authSession['params']
        );

        $this->dropAuthSession();

        $delim = strpos($this->authSession['redirect_uri'], "?") !== false ? '#' : '?';

        return redirect($this->authSession['redirect_uri'].$delim.http_build_query($payload));

    }








    public function login() {
        // validating sessionID

        if ( ! $this->loadAuthSession()) {
            \Log::info('oauth.invalid_session');
            return redirect()->route('developer.oauth.error', array(
                'code' => 1230,
                'message' => 'INVALID_SESSION'
            ));
        }

        if ($this->request->method() === 'GET') {
            return $this->renderView('developer/auth/login', array('login'=> null, 'password'=>null));
        }

        if ($this->request->method() === 'POST') {

        }
        else {
            return $this->renderView('developer/auth/login', array('login'=> null, 'password'=>null));
        }
        return null;
    }
    public function loginPost() {

        if ( ! $this->loadAuthSession()) {
            \Log::info('oauth.invalid_session');
            return redirect()->route('developer.oauth.error', array(
                'code' => 1230, // Invalid session
            ));
        }

        // todo: if has no session flash -> do nothing
        $validation = Validator::make($this->request->all(), [
            'login' => array(
                'required',
            ),
            'password' => array(
                'required'
            ),
            'g-captcha' => array(
                'string'
            )
        ]);

        if ($validation->passes()) {

            $canLogin = false;

            $login = $this->request->get('login');
            $password = $this->request->get('password');

            $check_user = User::where('email', $login)->first();
            if ($check_user && $check_user->email_verified == 1) {
                $canLogin = true;
            }

            //todo: check if user completely authorized and dont require mail check or something

            if ($canLogin && Auth::attempt(['email' => $login, 'password' => $password], true)) {

                if ($user = Auth::user()) {

                    $this->authSession['user_id'] = $user->id;
                    $this->saveAuthSession();

                    $application = Application::where('id', $this->authSession['app_id'])
                        ->first();

                    $applicationUser = ApplicationUser::where('app_id', $application->id)
                        ->where('user_id', $user->id)
                        ->withTrashed()
                        ->first();

                    // or app wants more permissions then has user link

                    if ( ! $applicationUser ) {
                        return redirect()->route('developer.oauth.connect');
                    }

                    if ( $applicationUser->banned ) {

                        $this->authSession['user_id'] = 0;

                        $status = 'error';

                        $oSign = md5($status.
                            $this->authSession['app_id'].
                            $this->authSession['time'].
                            $this->authSession['hash'].
                            $this->authSession['user_id'].
                            $application->api_key
                        );

                        $payload = array(
                            'status' => 'error',
                            'message' => 'error.user.banned',
                            'time' => $this->authSession['time'],
                            'hash' => $this->authSession['hash'],
                            'sign' => $oSign,
                            'app_id' => $this->authSession['app_id'],
                            'user_id' => $this->authSession['user_id'],
                            'params' => $this->authSession['params'],
                        );

                        $this->dropAuthSession();
                        $delim = strpos($this->authSession['redirect_uri'], "?") !== false ? '#' : '?';
                        return redirect($this->authSession['redirect_uri'].$delim.http_build_query($payload));
                    }

                    if ( ! $applicationUser->authorized || $applicationUser->trashed() || $this->authSession['explicit_perms'] ) {
                        return redirect()->route('developer.oauth.connect');
                    }

                    // Compare userLink permissions with requested permissions

                    $requirePerms = array_merge(['authorize'],$application->permissions, $this->authSession['perms']);
                    $currentPerms = $applicationUser->permissions;

                    $permsGranted = count(array_intersect($currentPerms, $requirePerms)) == count($currentPerms);

                    if ( ! $permsGranted ) {
                        return redirect()->route('developer.oauth.connect');
                    }

                    // COMPLETE AUTH WITH 'authorized' status

                    $status = 'authorize';
                    $resultPerms = implode('|',$currentPerms);
                    $oSign = md5($status.
                        $this->authSession['app_id'].
                        $this->authSession['time'].
                        $this->authSession['hash'].
                        $this->authSession['user_id'].
                        $application->api_key
                    );

                    // replace with exist token
                    $this->authSession['auth_token'] = $applicationUser->api_access_token;
                    // todo: extend auth_token life

                    $payload = array(
                        'status' => $status,
                        'time' => $this->authSession['time'],
                        'hash' => $this->authSession['hash'],
                        'sign' => $oSign,
                        'app_id' => $this->authSession['app_id'],
                        'user_id' => $this->authSession['user_id'],
                        'perms' => $resultPerms,
                        'token' => $this->authSession['auth_token'], //???
                        'params' => $this->authSession['params']
                    );

                    $this->dropAuthSession();
                    $delim = strpos($this->authSession['redirect_uri'], "?") !== false ? '#' : '?';
                    return redirect($this->authSession['redirect_uri'].$delim.http_build_query($payload));
                }

            } else {
                return $this->renderView('developer/auth/login', array('login'=> $login, 'password'=>$password));
            }
        }
        else {
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
    }



    public function connect() {

        if ( ! $this->loadAuthSession()) {
            \Log::info('oauth.invalid_session');
            return redirect()->route('developer.oauth.error', array(
                'code' => 1230, // Invalid session
                'message' => 'INVALID_SESSION'
            ));
        }

        $user = Auth::user();

        if ( ! $user || $this->authSession['user_id'] != $user->id) {
            $this->dropAuthSession();
            return redirect()->route('developer.oauth.error', array(
                'code' => 1230, // Invalid session
                'message' => 'INVALID_USER'
            ));
        }

        $application = Application::where('id', $this->authSession['app_id'])
            ->first();

        if ( ! $application ) {
            $this->dropAuthSession();
            return redirect()->route('developer.oauth.error', array(
                'code' => 1219, // Invalid session (this time this is application)
                'message' => 'INVALID_APPLICATION'
            ));
        }

        $requirePerms = array_merge(['authorize'], $application->permissions, $this->authSession['perms']);

        $sessionID = md5('hash_'.$this->authSession['hash']);

        return $this->renderView('developer/auth/connect', compact('sessionID','user', 'application', 'requirePerms'));
    }

    public function connectPost() {

        if ( ! $this->loadAuthSession()) {
            \Log::info('oauth.invalid_session');
            return redirect()->route('developer.oauth.error', array(
                'code' => 1230, // Invalid session
            ));
        }

        $sessionID = md5('hash_'.$this->authSession['hash']);
        if ($sessionID !== $this->request->get('session_id')) {
            \Log::info('oauth.invalid_session');
            return redirect()->route('developer.oauth.error', array(
                'code' => 1230, // Invalid session
                'message' => 'INVALID_SESSION'
            ));
        }

        $user = Auth::user();

        if ( ! $user || $this->authSession['user_id'] != $user->id) {
            $this->dropAuthSession();
            return redirect()->route('developer.oauth.error', array(
                'code' => 1230, // Invalid session
                'message' => 'INVALID_USER'
            ));
        }

        $application = Application::where('id', $this->authSession['app_id'])
            ->first();

        if ( ! $application ) {
            $this->dropAuthSession();
            return redirect()->route('developer.oauth.error', array(
                'code' => 1219, // Invalid session (this time this is application)
                'message' => 'INVALID_APPLICATION'
            ));
        }

        $applicationUser = ApplicationUser::where('user_id', $user->id)
            ->where('app_id', $application->id)
            ->withTrashed()
            ->first();

        if ( ! $applicationUser ) {
            // must create new link

            $applicationUser = new ApplicationUser();
            $applicationUser->user_id = $user->id;
            $applicationUser->app_id = $application->id;
            $applicationUser->enabled = true;
        }

        if ( $applicationUser->banned ) {

            $this->authSession['user_id'] = 0;

            $status = 'error';

            $oSign = md5($status.
                $this->authSession['app_id'].
                $this->authSession['time'].
                $this->authSession['hash'].
                $this->authSession['user_id'].
                $application->api_key
            );

            $payload = array(
                'status' => 'error',
                'message' => 'error.user.banned',
                'time' => $this->authSession['time'],
                'hash' => $this->authSession['hash'],
                'sign' => $oSign,
                'app_id' => $this->authSession['app_id'],
                'user_id' => $this->authSession['user_id'],
                'params' => $this->authSession['params'],
            );

            $this->dropAuthSession();
            $delim = strpos($this->authSession['redirect_uri'], "?") !== false ? '#' : '?';
            return redirect($this->authSession['redirect_uri'].$delim.http_build_query($payload));
        }

        if ( $applicationUser->trashed()) {
            $applicationUser->restore();
        }

        $requirePerms = array_merge(['authorize'], $application->permissions, $this->authSession['perms']);

        $applicationUser->permissions = $requirePerms;

        if ($applicationUser->authorized) {
            if ($applicationUser->isDirty('permissions')) {
                $application->dispatchSocialEvent('user.permissions', array(
                    'app_id' => $application->id,
                    'user_id' => $user->id,
                    'permissions' => $applicationUser->permissions
                ));
            }
        }
        else {

            ApplicationLog::addApplicationUserLink($application, $user, $applicationUser->permissions, array('auth_type'=>'external'));

            $application->dispatchSocialEvent('user.link', array(
                'app_id' => $application->id,
                'user_id' => $user->id,
                'permissions' => $applicationUser->permissions,
                'auth_type' => 'external',
                'auth_params' => $this->authSession['params']
            ));

            // write to app logs
            $logRecord = new ApplicationLog();
            $logRecord->app_id = $application->id;
            $logRecord->user_id = $user->id;
            $logRecord->type = 1000;
            $logRecord->payload = array(
                'auth_type' => 'external',
                'auth_perms' => $applicationUser->permissions,
                'auth_params' => $this->authSession['params'],
            );
            $logRecord->save();
        }

        $applicationUser->authorized = true;

        $applicationUser->api_access_token = sha1(random_bytes(20));
        $applicationUser->api_access_token_expire = time() + (86400 * 5);

        $applicationUser->save();

        $status = 'authorize';
        $resultPerms = implode('|',$requirePerms);
        $oSign = md5($status.
            $this->authSession['app_id'].
            $this->authSession['time'].
            $this->authSession['hash'].
            $this->authSession['user_id'].
            $application->api_key
        );

        $this->authSession['auth_token'] = $applicationUser->api_access_token;

        $payload = array(
            'status' => $status,
            'time' => $this->authSession['time'],
            'hash' => $this->authSession['hash'],
            'sign' => $oSign,
            'app_id' => $this->authSession['app_id'],
            'user_id' => $this->authSession['user_id'],
            'perms' => $resultPerms,
            'token' => $this->authSession['auth_token'], //???
            'params' => $this->authSession['params']
        );

        $this->dropAuthSession();
        $delim = strpos($this->authSession['redirect_uri'], "?") !== false ? '#' : '?';
        return redirect($this->authSession['redirect_uri'].$delim.http_build_query($payload));

    }

    public function select() {

    }

    public function selectPost() {

    }

    public function abortPost() {

        if ( ! $this->loadAuthSession() ) {
            return redirect()->route('developer.oauth.error', array(
                'code' => 1230,
                'message' => 'INVALID_SESSION'
            ));
        }

        $sessionID = md5('hash_'.$this->authSession['hash']);
        if ($sessionID !== $this->request->get('session_id')) {
            \Log::info('oauth.invalid_session');
            return redirect()->route('developer.oauth.error', array(
                'code' => 1230, // Invalid session
            ));
        }

        $this->authSession['user_id'] = 0;

        $application = Application::where('id', $this->authSession['app_id'])->first();

        $status = 'cancel';
        $oSign = md5($status.
            $this->authSession['app_id'].
            $this->authSession['time'].
            $this->authSession['hash'].
            $this->authSession['user_id'].
            $application->api_key
        );
        $payload = array(
            'status' => $status,
            'time' => $this->authSession['time'],
            'hash' => $this->authSession['hash'],
            'sign' => $oSign,
            'app_id' => $this->authSession['app_id'],
            'user_id' => $this->authSession['user_id'],
            'params' => $this->authSession['params'],
        );

        $this->dropAuthSession();
        $delim = strpos($this->authSession['redirect_uri'], "?") !== false ? '#' : '?';
        return redirect($this->authSession['redirect_uri'].$delim.http_build_query($payload));
    }


    public function result() {

        $app_id = $this->request->get('app_id');
        $application = Application::where('id', $app_id)
            ->where('is_active', true)
            ->first();

        $status = $this->request->get('status');

        return $this->renderView('developer/auth/result', compact('application', 'status'), 'empty');
    }

    public function error() {
        return $this->renderView('developer/auth/error', array(), 'empty');
    }


    // HELPERS
    private function loadAuthSession() {
        // Validate session name
        if (! $this->request->session()->has('oauthSession')) {
            $this->authSession = null;
            return false;
        }
        $session = $this->request->session()->get('oauthSession');
        if ( ! $session ) {
            $this->authSession = null;
            return false;
        }
        if ( ! isset($session['time_expire']) || $session['time_expire'] < time()) {
            $this->authSession = null;
            $this->request->session()->forget('oauthSession');
            return false;
        }
        $this->authSession = $session;
        return true;
    }
    private function saveAuthSession() {
        if ( ! $this->authSession )
            return false;
        $this->authSession['last_online'] = time();
        $this->request->session()->put('oauthSession', $this->authSession);
        return true;
    }
    private function dropAuthSession() {
        if ( ! $this->authSession )
            return false;
        $this->request->session()->forget('oauthSession');
        return true;
    }

    private function getApiSession($user, $application) {

        $timeline = $user->timeline;

        return bin2hex(random_bytes(17));

        $api_url = 'http://sand.esvoe.com:5511/api/inner/access/token/create/' . $user->id . '/' . $application->id . '/' . $timeline->id;

        $client = new \GuzzleHttp\Client([
            'http_errors'=>false,
            'allow_redirects' => false,
            'timeout' => 60, // 60 seconds
            'headers' => [
                'User-Agent'    => 'esvoe.client.api/1.0',
                'Accept'        => 'application/json',
                'Referer'       => $this->request->root()
            ],
        ]);

        try {
            $response = $client->request('GET', $api_url);
        } catch( \GuzzleHttp\Exception\ClientException $exception ){
            \Log::error($exception->getMessage(), $exception->getTrace());
            return (object) [
                'status' => false,
                'message' => $exception->getMessage(),
            ];
        }

        return (object) [
            'status' => true,
            'session' => trim($response->getBody()->getContents()),
        ];
    }
}

