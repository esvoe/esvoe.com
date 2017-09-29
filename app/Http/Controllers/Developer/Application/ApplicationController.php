<?php
/**
 * Created by PhpStorm.
 * User: zeratul
 * Date: 14.09.2017
 * Time: 16:47
 */

namespace App\Http\Controllers\Developer\Application;


use App\Application;
use App\ApplicationCategory;
use App\ApplicationEndpoint;
use App\ApplicationImage;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;
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
        Log::useDailyFiles(storage_path().'/logs/developer-application.log');
    }


    private function renderView($view, $args = array(), $layout = 'default') {
        return Theme::uses(Setting::get('current_theme', 'default'))->layout($layout)
            ->scope($view, $args)->render();
    }

    public function indexVue() {
        return $this->renderView('developer/application/vue1');
    }

    public function index() {
        $user = Auth::user();
        $applications = Application::where('user_id', $user->id)->get();
        return $this->renderView('developer/application/list', compact('applications'));
    }

    public function create() {
        return $this->renderView('developer/application/create');
    }

    public function createPost() {
        $validation = Validator::make($this->request->all(), [
            'title' => 'required|min:1|max:255',
            'type' => array(
                'required',
                'integer'
            )
        ]);
        $niceNames = array(
            'title' => '`Title`'
        );
        $validation->setAttributeNames($niceNames);

        if ($validation->fails()) {
            return redirect()->back()
                ->withInput($this->request->all())
                ->withErrors($validation->errors());
        }

        // self check unique name ?

        $user = Auth::user();
        $timeline = $user->timeline;
        $userWallet = $timeline->wallet()->first();
        $userWalletPayId = $userWallet->pay_id;

        $application = new Application();
        $application->user_id = $user->id;
        $application->type = $this->request->get('type');
        $application->state = 0;
        $application->title = $this->request->get('title');
        $application->permissions = [];
        $application->settings = array(
            'filter_rest_ips' => array(),
            'filter_redirect_urls' => array(),
            'filter_redirect_domains' => array(),
        );
        $application->save();

        $application->name = 'app'.$application->id;

        $key_priv = $this->createApiKey();

        $application->api_key = $key_priv;
        $application->api_private_key = $key_priv;

        if ( ! LOCAL_DEV_MODE()) {

            $response = $this->callPayApi('wallet/create', array(
                'user_id' => $application->id,
                'user_name' => $application->name,
                'user_nickname' => $application->title,
                'type' => 'application',
                'parent_id' => $userWalletPayId,
            ));

            if ($response->status && $response->response->response) {
                $application->pay_id = $response->response->pay_id;
                $application->pay_sign = $response->response->sign;
            } else {
                $application->forceDelete();
                return redirect()->back()
                    ->withInput($this->request->all())
                    ->withErrors(array('title' => 'Pay server error'));
            }
        }

        $application->update();

        Flash::success('Application '.$application->name.' created!');
        return redirect()->route('developer.applications.edit.details', array('id'=>$application->id));
    }

    public function editDetails($id) {
        $user = Auth::user();
        $timeline = $user->timeline;
        $userWallet = $timeline->wallet()->first();
        $userWalletPayId = $userWallet->pay_id;

        $application = Application::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if ( ! $application ) {
            return redirect()->route('developer.applications.index');
        }

        $annex = $application;

        $categories = ApplicationCategory::makeSelectList('--- Select ---');

        return $this->renderView('developer/application/edit-details', compact('application', 'categories'));
    }

    public function editDetailsPost($id) {

        $user = Auth::user();
        $timeline = $user->timeline;
        $userWallet = $timeline->wallet()->first();
        $userWalletPayId = $userWallet->pay_id;

        $application = Application::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if ( ! $application ) {
            return redirect()->route('developer.applications.index');
        }

        $validation = Validator::make($this->request->all(), [
            'title' => 'required|min:1|max:255',
            'description' => 'required|min:1|max:1023',
            'category_id' => 'numeric|exists:app_categories,id',
            'is_active' => 'numeric',
            'image_icon' => 'image|mimes:jpeg,jpg,png',
        ]);

        if ($validation->fails()) {
            return redirect()->back()
                ->withInput($this->request->all())
                ->withErrors($validation->errors());
        }

        $category = ApplicationCategory::where('type', $application->type)->first();

        if ($category) {
            $application->category_id = $category->id;
        }

        if ($image = $this->request->file('image_icon')) {
            $application->image_icon = $application->uploadImageIcon($image);
        }

        $application->title = $this->request->get('title');
        $application->description = $this->request->get('description');
        $application->category_id = $this->request->get('category_id') ? $this->request->get('category_id') : null;
        $application->is_visible = $this->request->get('is_visible') ? 1 : 0;
        //$application->is_active = $this->request->get('is_active') ? 1 : 0;

        $titleWasChanged = $application->isDirty('title');

        $application->save();

        // now update pay application name

        if ($titleWasChanged) {
            $response = $this->callPayApi('wallet/edit', [
                'pay_id' => $application->pay_id,
                'user_nickname' => $application->title,
            ]);

            if ($response->status && $response->response->response) {
                // all goes fine!
            } else {
                // has errors
                Log::error('update app wallet title error', ['response'=> $response]);
            }
        }

            Flash::success('App settings saved!');
            return redirect()->back();


    }

    public function editContainer($id) {

        $user = Auth::user();
        $timeline = $user->timeline;
        $userWallet = $timeline->wallet()->first();
        $userWalletPayId = $userWallet->pay_id;

        $application = Application::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if ( ! $application ) {
            return redirect()->route('developer.applications.index');
        }

        return $this->renderView('developer/application/edit-container', compact('application'));
    }

    public function editContainerPost($id) {
        $user = Auth::user();
        $timeline = $user->timeline;
        $userWallet = $timeline->wallet()->first();
        $userWalletPayId = $userWallet->pay_id;

        $application = Application::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if ( ! $application ) {
            return redirect()->route('developer.applications.index');
        }

        $validation = Validator::make($this->request->all(), [
            'api_url' => 'max:1024',
            'url_main' => 'max:1024',
        ]);

        if ($validation->fails()) {
            return redirect()->back()
                ->withInput($this->request->all())
                ->withErrors($validation->errors());
        }

        $application->api_url = $this->request->get('api_url');
        $application->url_main = $this->request->get('url_main');



        $application->update();


        Flash::success('App settings saved!');
        return redirect()->back();
    }

    public function editExternal($id)
    {
        $user = Auth::user();
        $timeline = $user->timeline;
        $userWallet = $timeline->wallet()->first();
        $userWalletPayId = $userWallet->pay_id;

        $application = Application::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$application) {
            return redirect()->route('developer.applications.index');
        }

        $endpoints = ApplicationEndpoint::where('app_id', $application->id)->get();

        return $this->renderView('developer/application/edit-endpoints', compact('application','endpoints'));
    }

    public function editPermissions($id) {
        $user = Auth::user();
        $timeline = $user->timeline;
        $userWallet = $timeline->wallet()->first();
        $userWalletPayId = $userWallet->pay_id;

        $application = Application::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if ( ! $application ) {
            return redirect()->route('developer.applications.index');
        }


        return $this->renderView('developer/application/edit-permissions', compact('application'));
    }

    public function editPermissionsPost($id) {

        $user = Auth::user();
        $timeline = $user->timeline;
        $userWallet = $timeline->wallet()->first();
        $userWalletPayId = $userWallet->pay_id;

        $application = Application::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if ( ! $application ) {
            return redirect()->route('developer.applications.index');
        }

        $application->permissions = array();
        $application->save();

        Flash::success('App settings saved!');
        return redirect()->back();
    }

    public function editImages($id) {

        $user = Auth::user();
        $timeline = $user->timeline;
        $userWallet = $timeline->wallet()->first();
        $userWalletPayId = $userWallet->pay_id;

        $application = Application::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if ( ! $application ) {
            return redirect()->route('developer.applications.index');
        }

        $screenshots = ApplicationImage::where('app_id', $application->id)
            ->get();

        return $this->renderView('developer/application/edit-images', compact('application', 'screenshots'));
    }

    public function editImagesPost($id) {

        $user = Auth::user();
        $timeline = $user->timeline;
        $userWallet = $timeline->wallet()->first();
        $userWalletPayId = $userWallet->pay_id;

        $application = Application::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if ( ! $application ) {
            return redirect()->route('developer.applications.index');
        }


        $validation = Validator::make($this->request->all(), [
            'image_main' => 'image|mimes:jpeg,jpg,png',
            'image_promo' => 'image|mimes:jpeg,jpg,png',
        ]);

        if ($validation->fails()) {
            return redirect()->back()
                ->withInput($this->request->all())
                ->withErrors($validation->errors());
        }

        if ($image = $this->request->file('image_icon')) {
            $application->image_icon = $application->uploadImageIcon($image);
        }
        if ($image = $this->request->file('image_main')) {
            $application->image_main = $application->uploadImageMain($image);
        }
        if ($image = $this->request->file('image_promo')) {
            $application->image_promo = $application->uploadImagePromo($image);
        }

        $result = $application->save();

        Flash::success('App settings saved!');
        return redirect()->back();

    }


    // images async upload



    // linked users



    // application stats



    // application action logs



    // application cashier



    // endpoints controllers
    public function endpointCreate($id) {

        $user = Auth::user();
        $timeline = $user->timeline;
        $userWallet = $timeline->wallet()->first();
        $userWalletPayId = $userWallet->pay_id;

        $application = Application::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if ( ! $application ) {
            return response()->json([
                'status' => '500',
                'message' => 'WRONG_PARAMS',
            ]);
        }

        $value_site = $this->request->get('site');
        $value_redirect = $this->request->get('redirect');

        if ( ! $value_site ) {
            return response()->json([
                'status' => '500',
                'message' => 'SITE_IS_REQUIRED',
            ]);
        }

        $value_domain = $value_site;

        if ( ! $value_domain ) {
            return response()->json([
                'status' => '500',
                'message' => 'ERROR_IN_DOMAIN',
            ]);
        }


        if ($value_redirect) {

        }

        $endpoints = ApplicationEndpoint::where('app_id', $application->id)->get();
        if (count($endpoints) >= 5) {
            return response()->json([
                'status' => '500',
                'message' => 'ENDPOINT_LIMIT_REACHED',
            ]);
        }

        $endpoint = new ApplicationEndpoint();
        $endpoint->app_id = $application->id;
        $endpoint->name = bin2hex(random_bytes(10));
        $endpoint->domain = $value_domain;
        $endpoint->url = $value_site;
        $endpoint->redirect = $value_redirect;

        $endpoint->save();

        return response()->json([
            'status' => '200',
            'message' => 'created',
            'data' => array(
                'name' => $endpoint->name,
                'site' => $endpoint->url,
                'redirect' => $endpoint->redirect
            )
        ]);
    }

    public function endpointDelete($id) {


        $user = Auth::user();
        $timeline = $user->timeline;
        $userWallet = $timeline->wallet()->first();
        $userWalletPayId = $userWallet->pay_id;

        $application = Application::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if ( ! $application ) {
            return response()->json([
                'status' => '500',
                'message' => 'WRONG_PARAMS',
            ]);
        }

        $endpoint = ApplicationEndpoint::where('app_id', $application->id)
            ->where('name', $this->request->get('endpoint'))
            ->first();

        if ( ! $endpoint) {
            return response()->json([
                'status' => '500',
                'message' => 'ENDPOINT_NOT_FOUND',
            ]);
        }

        $endpoint->delete();

        return response()->json([
            'status' => '200',
            'data' => array(
                'name'=> $endpoint->name
            ),
        ]);
    }

    public function endpointUpdate($id) {

        $user = Auth::user();
        $application = Application::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if ( ! $application ) {
            return response()->json([
                'status' => '500',
                'message' => 'WRONG_PARAMS',
            ]);
        }

        $validation = \Validator::make($this->request->all(), [
            'name' => array(
                'required',
                'max:20'
                ),
            'url' => array(
                'required',
                'regex:/^(https\:\/\/(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)$/',
                'max:128'
            ),
            'domain' => array(
                'max'=>'128'
            ),
            'redirect' => array(
                'required',
                'max:255',
                'regex:/^(https\:\/\/(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)$/',
            ),
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => '500',
                'data' => array(
                    'message' => 'VALIDATION_FAIL',
                    'errors'=> $validation->errors()
                )
            ]);
        }

        $endpoint = ApplicationEndpoint::where('app_id', $application->id)
            ->where('name', $this->request->get('name'))
            ->first();

        if ( ! $endpoint) {
            return response()->json([
                'status' => '500',
                'data' => array(
                    'message'=>'ENDPOINT_NOT_FOUND',
                    'errors' => array(
                        'name' => 'not_found'
                    )
                )
            ]);
        }

        $endpoint->url = $this->request->get('url');
        $endpoint->domain = $this->request->get('url');
        $endpoint->redirect = $this->request->get('redirect');

        $endpoint->update();
        //$is_url = filter_var($url, FILTER_VALIDATE_URL) !== false

        return response()->json([
            'status' => '200',
            'data' => array(
                'name' => $endpoint->name,
                'url' => $endpoint->url,
                'domain' => $endpoint->domain,
                'redirect' => $endpoint->redirect,
            ),
        ]);
    }


    public function screenshotUpload($id) {
        $user = Auth::user();
        $timeline = $user->timeline;
        $userWallet = $timeline->wallet()->first();
        $userWalletPayId = $userWallet->pay_id;

        $application = Application::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if ( ! $application ) {
            return response()->json([
                'status' => '500',
                'message' => 'WRONG_PARAMS',
            ]);
        }

        $validation = Validator::make($this->request->all(), [
            'fileToUpload' => 'image|mimes:jpeg,jpg,png',
        ]);

        if ($validation->fails()) {
            return redirect()->back()
                ->withInput($this->request->all())
                ->withErrors($validation->errors());
        }

        if ($image = $this->request->file('fileToUpload')) {

            $applicationImage = ApplicationImage::uploadScreenshot($image, $application->id);

        }


        return response()->json([
            'status' => '200',
            'content' => '<img src="'.static_uploads($applicationImage->path).'" class="img-thumbnail" style="height: 148px" width="230" height="148"/>',
        ]);
    }



    public function ajaxUpdatePayKey($id) {
        $user = Auth::user();
        $annex = Application::where('user_id', $user->id)->where('id', $id)->first();
        if (!$annex || $annex->user_id !== $user->id) {
            return response()->json([
                'status' => '403',
                'message' => 'permission_denied',
            ]);
        }

        $response = $this->callPayApi('wallet/sign', array(
            'pay_id' => $annex->pay_id,
            'type' => 'new',
        ));

        if ( $response->status && $response->response->response) {

            $annex->pay_sign = $response->response->sign;
            $annex->save();

            return response()->json([
                'status' => '200',
                'pay_sign' => $annex->pay_sign,
            ]);
        }

        return response()->json([
            'status' => '500',
            'message' => $response->response->message,
        ]);
    }

    public function ajaxUpdateApiKey($id) {
        $user = Auth::user();
        $application = Application::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if ( ! $application) {
            return response()->json([
                'status' => '500',
                'message' => 'application_missing',
            ]);
        }

        $key_priv = $this->createApiKey();

        $application->api_key = $key_priv;
        $application->api_private_key = $key_priv;
        $application->save();

        return response()->json([
            'status' => '200',
            'api_key' => $application->api_key,
        ]);

    }

    // helpers
    private function callPayApi($path, $payload, $timeout = 60, $method = 'POST') {

    if (strpos($path, '/') !== 0) {
        $path = '/'.$path;
    }
    $api_url = 'https://pay.esvoe.com'.$path;
    $client = new \GuzzleHttp\Client([
        'http_errors'=>false,
        'allow_redirects' => false,
        'timeout' => $timeout, // 60 seconds
        'headers' => [
            'User-Agent'    => 'esvoe.client.api/1.0',
            'Accept'        => 'application/json',
            'Referer'       => $this->request->root()
        ],
        'json' => $payload
    ]);

    try {
        $response = $client->request($method, $api_url);
    } catch( \GuzzleHttp\Exception\ClientException $exception ){
        \Log::error($exception->getMessage(), $exception->getTrace());
        return (object) [
            'status' => false,
            'message' => $exception->getMessage(),
        ];
    }

    try {
        $result = \GuzzleHttp\json_decode($response->getBody()->getContents()); // this method create stdClass instead of assoc array.
    } catch (\Exception $exception) {
        \Log::error($exception->getMessage(), $exception->getTrace());
        return (object) [
            'status' => false,
            'message' => $exception->getMessage(),
        ];
    }

    /*
    if ( ! $result->response) {
        return (object) [
            'status' => false,
            'message' => $result->message,
        ];
    }
    */

    Log::info("PayApi.Call", array('url'=>$api_url, 'request'=>$payload, 'status'=> true, 'response'=>$result));

    return (object) [
        'status' => true,
        'response' => $result,
    ];
}
    private function createApiKey() {
        return substr(md5(random_bytes(10)),0, 10).'-'.bin2hex(random_bytes(2)).'-'.bin2hex(random_bytes(3)).'-'.bin2hex(random_bytes(3));
    }
}