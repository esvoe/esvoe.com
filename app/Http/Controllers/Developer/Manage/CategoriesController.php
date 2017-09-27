<?php

namespace App\Http\Controllers\Developer\Manage;

use App\Application;
use App\ApplicationCategory;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;
use Teepluss\Theme\Facades\Theme;

class CategoriesController extends Controller
{
    /**
     * @var \Illuminate\Http\Request
     */
    private $request;

    public function __construct(Request $request)
    {

        // TODO: check permissions to manage categories

        $this->request = $request;
        Log::useDailyFiles(storage_path().'/logs/developer_manage.log');
    }


    private function renderView($view, $args = array(), $layout = 'default') {
        return Theme::uses(Setting::get('current_theme', 'default'))->layout($layout)
            ->scope($view, $args)->render();
    }

    public function index() {

        // Show categories list

        $categories = ApplicationCategory::getTree();

        return $this->renderView('developer/manage/categories/index', compact('categories'));
    }

    // post
    public function create() {

        $category = new ApplicationCategory();

        $categories = ApplicationCategory::makeSelectList('--- Select ---');

        return $this->renderView('developer/manage/categories/create', compact('category', 'categories'));
    }

    public function createPost() {
        $validation = Validator::make($this->request->all(), [
            'title' => 'required|min:2|max:255',
            'description' => 'required|min:1|max:1023',
            'parent_id' => 'exists:app_categories,id',
            'image_small' => 'image|mimes:jpeg,jpg,png',
            'image_large' => 'image|mimes:jpeg,jpg,png',
        ]);
        $niceNames = array(
            'name' => '`Application name`'
        );
        $validation->setAttributeNames($niceNames);

        if ($validation->fails()) {
            return redirect()->back()
                ->withInput($this->request->all())
                ->withErrors($validation->errors());
        }

        // self check unique name ?

        $category = new ApplicationCategory();
        $category->title = $this->request->get('title');
        $category->type = 1;

        $category->parent_id = $this->request->get('parent_id') ? $this->request->get('parent_id') : null;

        $category->description = $this->request->get('description');
        if ($image = $this->request->file('image_small')) {
            $category->uploadImageSmall($image);
        }
        if ($image = $this->request->file('image_large')) {
            $category->uploadImageLarge($image);
        }
        $category->is_active = $this->request->get('is_active') == 1;
        $category->is_visible = $this->request->get('is_visible') == 1;

        $result = $category->save();

        if ( $result ) {

            Flash::success('Category '.$category->title.' created!');
            return redirect()->route('developer.manage.categories.index');
        }
        return redirect()->back()
            ->withInput($this->request->all());
    }

    public function edit($id) {
        $category = ApplicationCategory::find($id);

        if ( ! $category) {
            // Category not found
            return redirect()->back();
        }

        $categories = ApplicationCategory::makeSelectList('--- Select ---', $category->id);

        return $this->renderView('developer/manage/categories/edit', compact('category', 'categories'));
    }

    public function editPost($id) {

        //todo: make it post with fields

        $category = ApplicationCategory::find($id)->first();

        if ( ! $category) {
            // Category not found

            return redirect()->back();
        }
        // Validate

        $validation = Validator::make($this->request->all(), [
            'parent_id' => 'exists:app_categories,id',
            'title' => 'required|min:1|max:255',
            'description' => 'required|min:1|max:1023',
            'image_small' => 'image|mimes:jpeg,jpg,png',
            'image_large' => 'image|mimes:jpeg,jpg,png',
            'is_active'     => 'numeric',
            'is_visible'     => 'numeric',
        ]);
        $niceNames = array(
            'name' => '`Application name`'
        );
        $validation->setAttributeNames($niceNames);

        if ($validation->fails()) {
            return redirect()->back()
                ->withInput($this->request->all())
                ->withErrors($validation->errors());
        }

        $category->parent_id = $this->request->get('parent_id') ? $this->request->get('parent_id') : null;
        $category->name = $this->request->get('name');
        $category->title = $this->request->get('title');
        $category->description = $this->request->get('description');
        if ($image = $this->request->file('image_small')) {
            $category->uploadImageSmall($image);
        }
        if ($image = $this->request->file('image_large')) {
            $category->uploadImageLarge($image);
        }
        $category->is_active = $this->request->get('is_active') == 1;
        $category->is_visible = $this->request->get('is_visible') == 1;

        $category->save();

        return redirect()->back();
    }

    public function delete($id) {
        // Check if category has apps related on
        // If apps exists -> offer group change category before delete

        $category = ApplicationCategory::where('id', $id)->first();

        if ( ! $category) {
            // Category not found
            return redirect()->back();
        }

        $category->delete();

        return redirect()->route('developer.manage.categories.index');
    }

    public function deleteClean() {
        // this is post route

        $id = $this->request->get('category_id');

        // check category valid
        $category = ApplicationCategory::find($id)->first();

        $next_id = $this->request->get('next_category_id');


        $category_next = ApplicationCategory::find($next_id)->first();

        // check if exists.

        DB::table('apps')
            ->where('category_id', $id)
            ->update(['category_id' => $next_id]);

        $category->delete();

        return redirect('/develop/categories');


    }

}