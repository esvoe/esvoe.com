<?php

namespace App\Http\Controllers\Applications;

use App\Application;
use App\ApplicationCategory;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Teepluss\Theme\Facades\Theme;

class CatalogController extends Controller
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

        // todo: state check

        $annexes_promo = Application::where('type',1)
            ->where('is_visible',true)
            ->where('is_active',true)
            ->inRandomOrder()
            ->limit(10)
            ->get();

        $annexes_recent = Application::where('type',1)
            ->where('is_visible',true)
            ->where('is_active',true)
            ->orderBy('created_at','desc')
            ->limit(10)
            ->get();

        $active_tab = 0;

        return $this->renderView('applications/catalog', compact('annexes_promo', 'annexes_recent', 'active_tab'));

    }

    public function showUserApps() {
        $annexes_promo = Application::where('is_active',true)->inRandomOrder()->limit(10)->get();

        $annexes_recent = Application::where('is_active', true)->orderBy('created_at','desc')->limit(10)->get();

        $active_tab = 1;

        return $this->renderView('applications/catalog', compact('annexes_promo', 'annexes_recent', 'active_tab'));

    }

    public function globalCatalog() {

        $categories = ApplicationCategory::getTree();

        $apps_promo10 = Application::where('is_active',true)->inRandomOrder()->limit(10)->get();

        $apps_recent10 = Application::where('is_active', true)->orderBy('created_at','desc')->limit(10)->get();

        return $this->renderView('applications/catalog/global', compact('categories', 'apps_promo10', 'apps_recent10'));
    }

    public function section($id) {

        $categories = ApplicationCategory::getTree();

        $apps_promo10 = Application::where('is_active',true)->inRandomOrder()->limit(10)->get();

        $apps_recent10 = Application::where('is_active', true)->orderBy('created_at','desc')->limit(10)->get();

        $section_categories = ApplicationCategory::where('parent_id', $id)->get();

        return $this->renderView('applications/catalog/global', compact('categories', 'apps_promo10', 'apps_recent10', 'section_categories'));
    }

    public function sectionGames($id) {

        $applications = Application::where('category_id', $id)->limit(20)->get();
        return $this->renderView('applications/catalog/global', 'categories', 'apps_promo10', 'apps_recent10', 'applications');
    }

    public function category($id) {

        $categories = ApplicationCategory::getTree();

        $apps_promo10 = Application::where('is_active',true)->inRandomOrder()->limit(10)->get();

        $apps_recent10 = Application::where('is_active', true)->orderBy('created_at','desc')->limit(10)->get();

        $applications = Application::where('category_id', $id)->limit(20)->get();

        return $this->renderView('applications/catalog/global', 'categories', 'apps_promo10', 'apps_recent10', 'applications');
    }

}