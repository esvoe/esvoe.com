<?php
/**
 * Created by PhpStorm.
 * User: zeratul
 * Date: 25.09.2017
 * Time: 11:40
 */

namespace App\Http\Controllers\Applications;


use App\ApplicationUser;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Teepluss\Theme\Facades\Theme;

class ActionController extends Controller
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

    /**
     * Remove applicationUser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unlinkApplication() {

        $link_id = $this->request->get('id');

        $link = ApplicationUser::where('id', $link_id)
            ->first();

        if (! $link)  {
            return redirect()->back();
        }

        $link->authorized = false;
        $link->update();
        $link->application->updateRating();
        $link->application->updateUserCount();
        $link->application->update();
        $link->delete();

        return redirect()->back();

    }

    public function rateApplicationAjax() {

        $id = $this->request->get('id');
        $rate = (int) $this->request->get('value');
        if ( $rate < 1 || $rate > 5) {
            return response()->json(array(
                'status' => '500',
                'message'=>'application.errors.parameters_damaged'
            ));
        }

        $application = Application::where('id', $id)
            ->where('is_active', true)
            ->first();

        if ( ! $application ) {
            return response()->json(array(
                'status' => '500',
                'message'=>'application.errors.application_not_found'
            ));
        }

        $user = Auth::user();

        $applicationUser = ApplicationUser::where('user_id', $user->id)
            ->where('app_id', $application->id)
            ->where('banned', false)
            ->where('authorized', true)
            ->first();

        if ( ! $applicationUser ) {
            return response()->json(array(
                'status' => '500',
                'message'=>'application.errors.user_link_not_found'
            ));
        }

        $applicationUser->rating = $rate;
        $applicationUser->update();

        // update rating
        $application->updateRating();
        $application->update();

        return response()->json(array(
            'status' => '200',
            'rating'=> $application->rating_packed,
        ));
    }


}