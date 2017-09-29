<?php

namespace App\Http\Controllers\Applications;

use App\Application;
use App\ApplicationCategory;
use App\ApplicationImage;
use App\ApplicationUser;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Teepluss\Theme\Facades\Theme;

class ApplicationController extends Controller
{
    /**
     * @var \Illuminate\Http\Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        Log::useDailyFiles(storage_path().'/logs/application.log');
    }

    public function renderSingleView($view, $args = array(), $statusCode = 200) {
        $content = Theme::uses(Setting::get('current_theme', 'default'))
            ->scope('applications.manage.user-apps')
            ->get('content');
        $content = new Response($content, $statusCode);
        return $content;
    }

    private function renderView($view, $args = array(), $layout = 'default') {
        return Theme::uses(Setting::get('current_theme', 'default'))
            ->layout($layout)
            ->scope($view, $args)->render();
    }

    public function index($name) {

        $user = Auth::user();
        $timeline = $user->timeline;
        $application = Application::where('name', $name)
            ->first();

        if ( ! $application ) {
            return redirect('/');
        }

        if ( ! $application->is_active && $application->user_id !== $user->id) {
            return redirect('/');
        }

        $applicationUser = ApplicationUser::where('app_id', $application->id)
            ->where('user_id', $user->id)
            ->where('authorized', true)
            ->where('banned', false)
            ->first();

        if ( ! $applicationUser ) {

            $linkHash = md5('application_link_'.$user->id.'-'.$application->id);
            $link_hash = $linkHash;

            $screenshots = ApplicationImage::where('app_id', $application->id)
                ->get();

            $permissions = array_merge(['authorize'], (array)$application->permissions);


            return $this->renderView('applications/container/details', compact('application', 'permissions', 'link_hash', 'screenshots'));
        }

        // back compability
        $gameName = $application->name;

        if ( ! $applicationUser->api_session_key || ! $applicationUser->api_session_key_expire || $applicationUser->api_session_key_expire->timestamp <= time()) {
            // create new token

            $applicationUser->api_session_key = sha1(random_bytes(20));
            $applicationUser->api_session_key_expire = time() + (60 * 30); // 30 minutes

            $applicationUser->update();
        }

        $session_key = $applicationUser->api_session_key;
        $session_secret_key = sha1($applicationUser->id . $applicationUser->api_session_key . $application->id . $application->api_signing_key . $application->api_private_key . '_secret_');

        $web_channel = 'ch_'.bin2hex(random_bytes(8));

        $params = array(
            'web_server' => url('/'),
            'web_channel' => $web_channel,
            'api_server' => url('/'),
            'api_session' => $session_key,
            'api_session_secret' => $session_secret_key,
            'user_id' => $user->id,
            'user_lang'=>Config::get('app.locale'),
            'lang'=>Config::get('app.locale'),
        );

        $iframe_url = $this->buildUrl($application->url_main, $params);

        $api_session_key = $session_key;


        Theme::asset()->add('name', 'js/api_server.js?t='.time());


        return $this->renderView('/applications/container/iframe', compact('application', 'iframe_url', 'api_session_key', 'web_channel', 'gameName'));
    }

    public function details($name) {
        $user = Auth::user();
        $application = Application::find();// \App\Application::where('id', $name)->orWhere('name', $name)->first();
        if ( ! $application ) {
            return redirect('/'); // fixme: redirect to real 404 page
        }
        $linkHash = md5('application_link_'.$application->id.'-'.csrf_token().'-'.$user->id);


        $screenshots = ApplicationImage::where('app_id', $application->id)
            ->get();

        return $this->renderView('applications/container/details', compact('application', 'perms', 'allow', 'link_hash','screenshots'));
    }

    public function preview($idOrName) {

        $user = Auth::user();
        $application = Application::where('id', $idOrName)
            ->orWhere('name', $idOrName)
            ->first();

        if ( ! $application) {
            return redirect('/');
        }

        return redirect()->route('applications.container', array('gamename'=>$application->name));

    }

    public function previewPost($id) {
        $user = Auth::user();

        $application = Application::where('id', $id)
            ->orWhere('name', $id)
            ->first();

        if ( ! $application) {
            return response()->json(array(
                'status' => '500',
                'message' => 'Application not found'
            ));
        }

        $applicationUser = ApplicationUser::where('app_id', $application->id)
            ->where('user_id', $user->id)
            ->where('authorized', true)
            ->where('enabled', true)
            ->first();

        if ( $applicationUser) {
            return response()->json(array(
                'status' => '501',
                'message' => 'Already connected'
            ));
            return response('already-connected', 404);
        }

        $linkHash = md5('application_link_'.$user->id.'-'.$application->id);

        $screenshots = ApplicationImage::where('app_id', $application->id)
            ->get();

        $permissions = array_merge(['authorize'], (array)$application->permissions);

        $content = Theme::uses(Setting::get('current_theme', 'default'))
            ->scope('applications.container.details-modal', compact('application', 'screenshots', 'permissions'))
            ->get('content');

        return response()->json(array(
            'status' => '200',
            'content' => $content
        ));

    }

    public function authorizeApplication($id) {

        $user = Auth::user();

        $application = Application::where('id', $id)->first();

        if ( ! $application) {
            return redirect()->back();
        }

        $linkHash = md5('application_link_'.$user->id.'-'.$application->id);

        if ($linkHash != $this->request->get('check')) {
            return redirect()->back();
        }

        $userLink = ApplicationUser::where('user_id', $user->id)
            ->where('app_id', $application->id)
            ->withTrashed()
            ->first();

        if ( ! $userLink ) {
            // create user link
            $userLink = new ApplicationUser();
            $userLink->user_id = $user->id;
            $userLink->app_id = $application->id;
            $userLink->enabled = true;

            if (!$application->permissions) {
                $application->permissions = array();
            }

            $userLink->permissions = array_merge(['authorize'], $application->permissions);
            $userLink->settings = array();
            $userLink->store = array();
            $userLink->save();
        }

        if ( ! $userLink->enabled ) {
            // Unable create link. User is banned
            return redirect()->back();
        }

        if ( ! $userLink->authorized) {
            $userLink->authorized = true;

            if (!$application->permissions) {
                $application->permissions = array();
            }

            $userLink->permissions = array_merge(['authorize'], $application->permissions);
            $userLink->update();

            $application->count_users = $application->count_users + 1;

                // todo: send signed auth notification to API url
                $application->dispatchSocialEvent('user.authorize', array(
                    'user_id' => $user->id,
                ));

            $application->save();
        }

        return redirect()->route('applications.container', array('gamename'=>$application->name));

    }

    public function userApplications() {

        $user = Auth::user();

        $links = ApplicationUser::where('user_id', $user->id)
            ->with('application')
            ->get();

        return $this->renderView('/applications/manage/user-apps', compact('links'));
    }

    // helper functions
    private function getApiSession($user_id, $game_id, $timeline_id) {

        $api_url = 'http://sand.esvoe.com:5511/api/inner/access/token/create/' . $user_id . '/' . $game_id . '/' . $timeline_id;

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

    private function buildUrl($baseUri, $params) {

        $queryString = '';
        $arrayLength = count($params);
        foreach ($params as $key => $val) {
            $queryString .= urlencode($key) . '=' . urlencode($val);
            $arrayLength--;
            if ($arrayLength) {
                $queryString .= '&';
            }
        }
        return sprintf("%s?%s", $baseUri, $queryString);
    }
}