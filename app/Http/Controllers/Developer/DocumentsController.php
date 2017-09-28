<?php
/**
 * Created by PhpStorm.
 * User: zeratul
 * Date: 07.09.2017
 * Time: 18:42
 */

namespace App\Http\Controllers\Developer;


use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Teepluss\Theme\Facades\Theme;

class DocumentsController extends Controller
{
    /**
     * @var \Illuminate\Http\Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        Log::useDailyFiles(storage_path().'/logs/apps_categories.log');
    }


    private function renderView($view, $args = array(), $layout = 'default') {

        return Theme::uses(Setting::get('current_theme', 'default'))->layout($layout)
            ->scope($view, $args)->render();
    }

    public function index() {

        // Show applications list

        return $this->renderView('developer/docs/index');
    }

    public function docsApi()
    {
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        return $theme->scope('developer/docs/api_index', compact('apps'))->render();
    }

    public function docsApiJs()
    {
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        return $theme->scope('developer/docs/api_js_index', compact('apps'))->render();
    }

    public function docsApiRest()
    {
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        return $theme->scope('developer/docs/api_rest_index', compact('apps'))->render();
    }
}