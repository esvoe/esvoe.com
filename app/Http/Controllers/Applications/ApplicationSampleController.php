<?php
/**
 * Created by PhpStorm.
 * User: zeratul
 * Date: 28.09.2017
 * Time: 14:14
 */

namespace App\Http\Controllers\Applications;


use App\Models\Application;
use App\Http\Controllers\Controller;
use App\Setting;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Teepluss\Theme\Facades\Theme;

class ApplicationSampleController extends Controller
{
    /**
     * @var \Illuminate\Http\Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        \Log::useDailyFiles(storage_path().'/logs/sample-app.log');
    }

    protected function renderSingleView($view, $args = array(), $statusCode = 200) {
        $content = Theme::uses(Setting::get('current_theme', 'default'))
            ->scope($view, $args)
            ->get('content');
        $content = new Response($content, $statusCode);
        return $content;
    }

    public function index($id) {

        $user = Auth::user();

        $application = Application::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if ( ! $application ) {
            return 'Application not found';
        }


        $params = $this->request->all();

        return $this->renderSingleView('applications.container.sample', compact('params', 'application'));
    }


}