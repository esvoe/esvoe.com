<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Teepluss\Theme\Facades\Theme;

class UsersController extends Controller
{
    /**
     * @var \Illuminate\Http\Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        /** @noinspection PhpUndefinedClassInspection */
        Log::useDailyFiles(storage_path().'/logs/apps_categories.log');
    }


    private function renderView($view, $args = array(), $layout = 'default') {
        /** @noinspection PhpParamsInspection */
        /** @noinspection PhpUndefinedClassInspection */
        return Theme::uses(Setting::get('current_theme', 'default'))->layout($layout)
            ->scope($view, $args)->render();
    }

    public function index() {

        // Show applications list

        return $this->renderView('applications/users/index');
    }

    public function appUsersList() {
        return $this->renderView('applications/users/app_users');
    }

    public function appUserLogs() {
        return $this->renderView('applications/users/app_user_log');
    }

}