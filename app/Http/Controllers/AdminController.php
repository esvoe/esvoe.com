<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Category;
use App\Comment;
use App\Event;
use App\Group;
use App\Media;
use App\Notification;
use App\Page;
use App\Post;
use App\Setting;
use App\StaticPage;
use App\Timeline;
use App\User;
use App\Wallpaper;
use Auth;
use Carbon\Carbon;
use DB;
use Exception;
use File;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Session;
use Teepluss\Theme\Facades\Theme;
use Validator;

class AdminController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->checkCensored();

        $this->middleware('disabledemo', ['only' => [
                        'storeCustomPage',
                        'updateCustomPage',
                        'updateGeneralSettings',
                        'updateUserSettings',
                        'updatePageSettings',
                        'updateGroupSettings',
                        'updateAnnouncement',
                        'addAnnouncements',
                        'removeAnnouncement',
                        'activeAnnouncement',
                        'updateUser',
                        'updatePassword',
                        'deleteUser',
                        'updatePage',
                        'deletePage',
                        'updateGroup',
                        'deleteGroup',
                        'markSafeReports',
                        'deletePostReports',
                        'updateManageAds',
                        'markPageSafeReports',
                        'deletePageReports',
                        'deleteGroupReports',
                        'deleteUserReports',
                        'saveEnv',
                        'updateCategory',
                        'removeCategory',
                        'storeCategory',
                        'postUpdateDatabase',
                        'addWallpapers',
                        'deleteWallpaper'
                    ],
            ]);
    }

    protected function checkCensored()
    {
        $messages['not_contains'] = 'The :attribute must not contain banned words';
        if($this->request->method() == 'POST') {
            // Adjust the rules as needed
            $this->validate($this->request, 
                [
                  'name'          => 'not_contains',
                  'about'         => 'not_contains',
                  'title'         => 'not_contains',
                  'description'   => 'not_contains',
                  'tag'           => 'not_contains',
                  'email'         => 'not_contains',
                  'body'          => 'not_contains',
                  'link'          => 'not_contains',
                  'address'       => 'not_contains',
                  'website'       => 'not_contains',
                  'display_name'  => 'not_contains',
                  'key'           => 'not_contains',
                  'value'         => 'not_contains',
                  'subject'       => 'not_contains',
                  'username'      => 'not_contains',
                  'email'         => 'email',
                ],$messages);
        }
    }

    public function dashboard()
    {
        //User registered
        $users = Auth::user()->get();
        $dashboard_user_results = $this->getDashboard($users);
        $result = explode('-', $dashboard_user_results);
        $today_user_count = $result[0];
        $month_user_count = $result[1];
        $year_user_count = $result[2];
        $total_user_count = count($users);

        //Pages Created
        $pages = Page::get();
        $dashboard_page_results = $this->getDashboard($pages);
        $result = explode('-', $dashboard_page_results);
        $today_page_count = $result[0];
        $month_page_count = $result[1];
        $year_page_count = $result[2];
        $total_page_count = count($pages);

        //Groups Created
        $groups = Group::get();
        $dashboard_group_results = $this->getDashboard($groups);
        $result = explode('-', $dashboard_group_results);
        $today_group_count = $result[0];
        $month_group_count = $result[1];
        $year_group_count = $result[2];
        $total_group_count = count($groups);

        //Comments Posted
        $comments = Comment::get();
        $dashboard_comment_results = $this->getDashboard($comments);
        $result = explode('-', $dashboard_comment_results);
        $today_comment_count = $result[0];
        $month_comment_count = $result[1];
        $year_comment_count = $result[2];
        $total_comment_count = count($comments);

        //Stories posted
        $posts = Post::get();
        $dashboard_post_results = $this->getDashboard($posts);
        $result = explode('-', $dashboard_post_results);
        $today_post_count = $result[0];
        $month_post_count = $result[1];
        $year_post_count = $result[2];
        $total_post_count = count($posts);

        //Posts Liked
        $post = new Post();
        $postLikes = $post->postsLiked();
        $dashboard_like_results = $this->getDashboard($postLikes);
        $result = explode('-', $dashboard_like_results);
        $today_like_count = $result[0];
        $month_like_count = $result[1];
        $year_like_count = $result[2];
        $total_like_count = count($postLikes);

        //Posts Reported
        $postReports = $post->postsReported();
        $dashboard_report_results = $this->getDashboard($postReports);
        $result = explode('-', $dashboard_report_results);
        $today_report_count = $result[0];
        $month_report_count = $result[1];
        $year_report_count = $result[2];
        $total_report_count = count($postReports);

        //Stories Shared
        $postShared = $post->postShared();
        $dashboard_shared_results = $this->getDashboard($postShared);
        $result = explode('-', $dashboard_shared_results);
        $today_shared_count = $result[0];
        $month_shared_count = $result[1];
        $year_shared_count = $result[2];
        $total_shared_count = count($postShared);

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.dashboard').' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('admin/dashboard', compact(
            'today_user_count',
            'month_user_count',
            'year_user_count',
            'total_user_count',
            'today_page_count',
            'month_page_count',
            'year_page_count',
            'total_page_count',
            'today_group_count',
            'month_group_count',
            'year_group_count',
            'total_group_count',
            'today_comment_count',
            'month_comment_count',
            'year_comment_count',
            'total_comment_count',
            'today_like_count',
            'month_like_count',
            'year_like_count',
            'total_like_count',
            'today_report_count',
            'month_report_count',
            'year_report_count',
            'total_report_count',
            'today_post_count',
            'month_post_count',
            'year_post_count',
            'total_post_count',
            'today_shared_count',
            'month_shared_count',
            'year_shared_count',
            'total_shared_count'
        ))->render();
    }

    public function getDashboard($data_args)
    {
        $current_date = date('Y-m-d', strtotime(Carbon::now()));
        $current_month = date('Y-m', strtotime(Carbon::now()));
        $current_year = date('Y', strtotime(Carbon::now()));
        $today_user_count = 0;
        $month_user_count = 0;
        $year_user_count = 0;

        foreach ($data_args as $data_arg) {
            if ($current_date == date('Y-m-d', strtotime($data_arg->created_at))) {
                $today_user_count++;
            }

            if ($current_month == date('Y-m', strtotime($data_arg->created_at))) {
                $month_user_count++;
            }

            if ($current_year == date('Y', strtotime($data_arg->created_at))) {
                $year_user_count++;
            }
        }

        return $today_user_count.'-'.$month_user_count.'-'.$year_user_count;
    }

    public function generalSettings()
    {
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.general_settings').' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('admin/general-settings')->render();
    }

    public function listCustomPages()
    {
        $staticpages = StaticPage::all();
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.custom_pages').' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('admin/custompageindex', compact('staticpages'))->render();
    }

    public function createCustomPage()
    {
        $mode = 'create';
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('admin.create_custom_page').' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('admin/custom-pages', compact('mode'))->render();
    }

    public function editCustomPage($id)
    {
        $mode = 'edit';
        $staticPage = StaticPage::find($id);
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.edit').' '.$staticPage->title.' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('admin/custom-pages', compact('mode', 'staticPage'))->render();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function customPageValidator(array $data)
    {
        return Validator::make($data, [
            'title'       => 'required|max:30|min:5',
            'description' => 'required',
        ]);
    }

    public function storeCustomPage(Request $request)
    {
        $mode = 'create';
        $staticPage = new StaticPage();
        $validation = Validator::make(
            $request->only('title', 'description'),
            [
                'title'       => ['required'],
                'description' => ['required'],
            ]
        );

        if ($validation->passes()) {
            $page = StaticPage::create($request->all());
            Flash::success(trans('messages.page_created_success'));
            // $staticpages = StaticPage::all();
            $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');

            return $theme->scope('admin/custom-pages', compact('mode'))->render();
        } else {
            $errors = $validation->messages();

            return redirect()->back()
            ->withInput($request->all())
            ->withErrors($errors);
        }
    }

    public function updateCustomPage(Request $request, $id)
    {
        $validator = $this->customPageValidator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
            ->withInput($request->all())
            ->withErrors($validator->errors());
        }

        $staticPage = StaticPage::find($id);
        $staticPage->title = $request->title;
        $staticPage->description = $request->description;
        $staticPage->active = $request->active;
        $staticPage->save();

        Flash::success(trans('messages.page_updated_success'));

        return redirect()->back();
    }

    public function updateGeneralSettings(Request $request)
    {
        $settings = $request->except('_token');

        if ($request->mail_verification == 'on') {
            if ((env('MAIL_DRIVER') == "" || (env('MAIL_DRIVER') == null)) ||
              ((env('MAIL_HOST') == "" || env('MAIL_HOST') == null)) ||
              ((env('MAIL_PORT') == "" || env('MAIL_PORT') == null)) ||
              ((env('MAIL_USERNAME') == "" || env('MAIL_USERNAME') == null)) ||
              ((env('MAIL_PASSWORD') == "" || env('MAIL_PASSWORD') == null)) ||
              ((env('MAIL_ENCRYPTION') == "" || env('MAIL_ENCRYPTION') == null))) {
                $messages = trans('admin.email_not_configured');
                return redirect()->back()->with('messages', $messages);
            }
        }

        if ($request->captcha == 'on') {
            if (env('NOCAPTCHA_SECRET') == "" || (env('NOCAPTCHA_SECRET') == null) && (env('NOCAPTCHA_SITEKEY') == "") ||
                env('NOCAPTCHA_SITEKEY') == null) {
                $messages = trans('admin.captcha_not_configured');
                return redirect()->back()->with('messages', $messages);
            }
        }

        $change_logo = $request->file('logo');
        if ($change_logo) {
            $photoName = 'logo.jpg';
            $logo = Image::make($change_logo->getRealPath());

            $logo->save(storage_path().'/uploads/settings/'.$photoName, 60);
            $settings['logo'] = $photoName;
        }
        $change_favicon = $request->file('favicon');
        if ($change_favicon) {
            $photoName = 'favicon.jpg';
            $favicon = Image::make($change_favicon->getRealPath());

            $favicon->save(storage_path().'/uploads/settings/'.$photoName, 60);
            $settings['favicon'] = $photoName;
        }
        Setting::set($settings);

        $language_options = ['' => 'Select Language'] + Config::get('app.locales');

        Flash::success(trans('messages.settings_updated_success'));
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');

        return $theme->scope('admin/general-settings', compact('language_options', 'settings'))->render();
    }

    public function userSettings()
    {
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.user_settings').' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('admin/user-settings')->render();
    }

    public function updateUserSettings(Request $request)
    {
        $settings = $request->except('_token');

        $categories = Category::paginate(10);
        Setting::set($settings);
        Flash::success(trans('messages.user_settings_updated_success'));
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');

        return $theme->scope('admin/user-settings', compact('categories'))->render();
    }

    public function pageSettings()
    {
        $categories = Category::paginate(10);

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.page_settings').' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('admin/page-settings', compact('categories'))->render();
    }

    public function updatePageSettings(Request $request)
    {
        $settings = $request->except('_token');
        Setting::set($settings);
        
        $categories = Category::paginate(10);
        Flash::success(trans('messages.page_settings_updated_success'));
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');

        return $theme->scope('admin/page-settings', compact('categories'))->render();
    }

    public function groupSettings()
    {
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.group_settings').' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('admin/group-settings')->render();
    }

    public function updateGroupSettings(Request $request)
    {
        $settings = $request->except('_token');

        Setting::set($settings);
        Flash::success(trans('messages.group_settings_updated_success'));
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');

        return $theme->scope('admin/group-settings')->render();
    }

    public function eventSettings()
    {
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.event_settings').' | '.Setting::get('site_title').' | '.Setting::get('site_tagline'));

        return $theme->scope('admin/event-settings')->render();
    }

    public function updateEventSettings(Request $request)
    {
        $settings = $request->except('_token');

        Setting::set($settings);
        Flash::success(trans('messages.event_settings_updated_success'));
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');

        return $theme->scope('admin/event-settings')->render();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function announcementValidator(array $data)
    {
        return Validator::make($data, [
            'title'       => 'required|max:30|min:5',
            'description' => 'required',
            'start_date'  => 'required',
            'end_date'    => 'required',
        ]);
    }

    public function getAnnouncements()
    {
        $total_days = '';
        $announcements = Announcement::paginate(10);
        $current_anouncement = Announcement::find(Setting::get('announcement'));
        if ($current_anouncement && date('Y-m-d', strtotime($current_anouncement->end_date)) > date('Y-m-d', strtotime(Carbon::now()))) {
            $total_days = date('d-m-Y', strtotime($current_anouncement->end_date)) -  date('d-m-Y', strtotime(Carbon::now()));
        }


        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.announcements').' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('admin/announcementslist', compact('announcements', 'current_anouncement', 'total_days'))->render();
    }

    public function createAnnouncement()
    {
        $mode = 'create';
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('admin.create_announcement').' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('admin/announcement-form', compact('mode'))->render();
    }

    public function editAnnouncement($id)
    {
        $mode = 'update';
        $announcement = Announcement::find($id);

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.edit').' '.$announcement->title.' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('admin/announcement-form', compact('announcement', 'mode'))->render();
    }

    public function updateAnnouncement(Request $request, $id)
    {
        $validator = $this->announcementValidator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
            ->withInput($request->all())
            ->withErrors($validator->errors());
        }

        $announcement = Announcement::find($id);
        $announcement->title = $request->title;
        $announcement->description = $request->description;
        $announcement->start_date = date('Y-m-d', strtotime($request->start_date));
        $announcement->end_date = date('Y-m-d', strtotime($request->end_date));
        $announcement->save();
        $mode = 'update';
        Flash::success(trans('messages.announcement_updated_success'));
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');

        return $theme->scope('admin/announcement-form', compact('announcement', 'mode'))->render();
    }

    public function addCategory()
    {
        $mode = 'create';
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('admin.create_category').' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('admin/category-form', compact('mode'))->render();
    }

    public function editCategory($id)
    {
        $mode = 'update';
        $category = Category::find($id);

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.edit').' '.$category->name.' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('admin/category-form', compact('category', 'mode'))->render();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function categoryValidator(array $data)
    {
        return Validator::make($data, [
            'name'        => 'required|max:30|min:3',
            'description' => 'required',
            'active'      => 'required',
        ]);
    }

    public function storeCategory(Request $request)
    {
        $validator = $this->categoryValidator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
            ->withInput($request->all())
            ->withErrors($validator->errors());
        }

        $category = Category::create($request->all());
        $category_parent = Category::find($category->id);
        $category_parent->parent_id = $category->id;
        $category_parent->save();

        $categories = Category::paginate(10);

        Flash::success(trans('messages.new_category_added'));

        return redirect('admin/page-settings');
    }

    public function updateCategory(Request $request, $id)
    {
        $validator = $this->categoryValidator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
            ->withInput($request->all())
            ->withErrors($validator->errors());
        }

        $category = Category::find($id);
        $category_values = $request->only('name', 'description', 'active');
        $category->update($category_values);
        $categories = Category::paginate(10);

        Flash::success(trans('messages.category_updated_success'));

        return redirect('admin/page-settings');
    }

    public function removeCategory(Request $request)
    {
        $category = Category::find($request->category_id);
        if ($category->delete()) {
            Flash::success(trans('messages.category_deleted_success'));

            return response()->json(['status' => '200', 'category' => true, 'message' => 'Category deleted successfully']);
        }
    }

    public function addAnnouncements(Request $request)
    {
        $validator = $this->announcementValidator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
            ->withInput($request->all())
            ->withErrors($validator->errors());
        }

        $announcements = new Announcement();
        $announcements->title = $request->title;
        $announcements->description = $request->description;
        $announcements->start_date = date('Y-m-d', strtotime($request->start_date));
        $announcements->end_date = date('Y-m-d', strtotime($request->end_date));
        $announcements->save();

        $total_days = '';
        $announcements = Announcement::paginate(10);
        $current_anouncement = Announcement::find(Setting::get('announcement'));
        if ($current_anouncement && date('Y-m-d', strtotime($current_anouncement->end_date)) > date('Y-m-d', strtotime(Carbon::now()))) {
            $total_days = date('d-m-Y', strtotime($current_anouncement->end_date)) -  date('d-m-Y', strtotime(Carbon::now()));
        }
        Flash::success(trans('messages.new_announcement_added'));
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');

        return $theme->scope('admin/announcementslist', compact('announcements', 'current_anouncement', 'total_days'))->render();
    }

    public function removeAnnouncement(Request $request)
    {
        $announcements = Announcement::find($request->announcement_id);
        if ($announcements->delete()) {
            Flash::success(trans('messages.announcement_deleted_success'));

            return response()->json(['status' => '200', 'announce' => true, 'message' => 'Announcement deleted successfully']);
        }
    }

    public function activeAnnouncement($announcement_id)
    {
        if (Setting::get('announcement') != null) {
            Setting::set('announcement', $announcement_id);
        } else {
            Setting::set('announcement', $announcement_id);
        }

        Flash::success(trans('messages.announcement_activated_success'));

        return redirect()->back();
    }

    public function themes()
    {
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.themes').' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        $themes = File::directories(base_path('public/themes'));

        $themesInfo = [];

        //  Setting::get('current_theme')


        foreach ($themes as $key => $value) {
            $themeInfo = json_decode(file_get_contents($value.'/theme.json'));
            $themeInfo->thumbnail = str_replace(base_path('public'), '', $value).'/'.$themeInfo->thumbnail;
            $themeInfo->directory = str_replace(base_path('public/themes/'), '', $value);
            $themesInfo[] = $themeInfo;
        }

        return $theme->scope('admin/themes', compact('themesInfo'))->render();
    }

    public function changeTheme($name)
    {
        Setting::set('current_theme', $name);

        return redirect('admin/themes');
    }

    public function showUsers(Request $request)
    {
        $timelines = '';

        if ($request->all()) {
            if ($request->sort) {
                $timelines = $this->manageSortings($request->sort, $type = 'user');
            } elseif ($request->page) {
                $timelines = $this->manageSortings($request->page, $type = 'user');
            }
        } else {
            $timelines = Timeline::where('type', 'user')->paginate(Setting::get('items_page', 10));
        }

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.manage_users').' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('admin/users/show', compact('timelines'))->render();
    }

    public function editUser($username)
    {
        $timeline = Timeline::where('username', $username)->first();

        if (!$timeline) {
            return redirect('admin/users');
        }

        $user = $timeline->user()->first();

        $user_settings = $user->getUserSettings($user->id);

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.edit').' '.$user->name.' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('admin/users/edit', compact('timeline', 'user', 'username', 'user_settings'))->render();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateUser(array $data, $timeline_id, $user_id)
    {
        return Validator::make($data, [
            'username' => 'required|max:16|min:5|alpha_num|unique:timelines,username,'.$timeline_id,
            'name'     => 'required',
            'email'    => 'required|unique:users,email,'.$user_id,
        ]);
    }

    public function updateUser($oldUsername, Request $request)
    {
        $data = $request->all();
        $timeline = Timeline::where('username', $oldUsername)->first();
        $user = $timeline->user;

        $validator = $this->validateUser($data, $timeline->id, $user->id);
        if ($validator->fails()) {
            return redirect()->back()
            ->withInput($request->all())
            ->withErrors($validator->errors());
        }

        $timeline_input = $request->only('username', 'name', 'about');
        $timeline->update($timeline_input);

        $user_input = $request->only('verified', 'email', 'city', 'country', 'gender', 'birthday', 'designation', 'hobbies', 'interests');
        
        $user_input['birthday'] = date('Y-m-d', strtotime($request->birthday));
        $user->update($user_input);

        $user_settings = $request->only('confirm_follow', 'comment_privacy', 'follow_privacy', 'post_privacy', 'timeline_post_privacy');
         
        $users = DB::table('user_settings')->where('user_id', $user->id)
        ->update($user_settings);

        $username = $timeline->username;

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');

        Flash::success(trans('messages.user_updated_success'));

        return redirect('admin/users/'.$username.'/edit');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatePassword(array $data)
    {
        return Validator::make($data, [
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);
    }

    public function updatePassword(Request $request, $username)
    {
        $validator = $this->validatePassword($request->all());
        if ($validator->fails()) {
            return redirect()->back()
            ->withInput($request->all())
            ->withErrors($validator->errors());
        }

        $timeline = Timeline::where('username', $username)->first();
        $user = User::where('timeline_id', $timeline->id)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        $user_settings = $user->getUserSettings($user->id);

        Flash::success(trans('messages.password_updated_success'));
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');

        return $theme->scope('admin/users/edit', compact('timeline', 'user', 'username', 'user_settings'))->render();
    }

    public function showPages(Request $request)
    {
        $timelines = '';
        $likesarr = [];

        if ($request->all()) {
            $sort_type = $request->sort;
            if ($sort_type) {
                $timelines = $this->manageSortings($sort_type, $type = 'page');
            } elseif ($request->page) {
                $timelines = $this->manageSortings($request->page, $type = 'page');
            }

            if ($sort_type == 'likes_asc' || $sort_type == 'likes_desc') {
                $timelines = Timeline::where('type', 'page')->get();
                $total_pages = [];
                $timeline_arr = [];

                foreach ($timelines as $timeline) {
                    $page = $timeline->page;
                    if ($page) {
                        $users = $page->getPageCount($page->id);
                        if ($users) {
                            array_push($total_pages, $users);
                        }
                    }
                }
                
                if ($sort_type == 'likes_asc') {
                    $final_array = array_values(array_sort($total_pages, function ($value) {
                        return $value->user_count;
                    }));
                } else {
                    $final_array = array_reverse(array_sort($total_pages, function ($value) {
                        return $value->user_count;
                    }));
                }
                
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
                foreach ($final_array as $f_array) {
                    $page = Page::find($f_array->page_id);
                    array_push($timeline_arr, $page->timeline);
                }

                $collection = new Collection($timeline_arr);
                $perPage = Setting::get('items_page', 10);
                $currentPageSearchResults = $collection->slice(($currentPage - 1) * $perPage, $perPage)->all();
                $timelines= new LengthAwarePaginator(
                    $currentPageSearchResults,
                    count($collection),
                    $perPage,
                    Paginator::resolveCurrentPage(),
                    ['path' => Paginator::resolveCurrentPath()]
                );
            }
        } else {
            $timelines = Timeline::where('type', 'page')->paginate(Setting::get('items_page', 10));
        }

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.manage_pages').' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('admin/pages/show', compact('timelines'))->render();
    }

    public function editPage($username)
    {
        $timeline = Timeline::where('username', $username)->first();
        $page = $timeline->page()->first();
        $category_options = ['' => 'Select Category'] + Category::pluck('name', 'id')->all();


        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.edit').' '.$timeline->name.' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('admin/pages/edit', compact('category_options', 'username', 'page', 'timeline'))->render();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function adminPageValidation(array $data)
    {
        return Validator::make($data, [
            'name'        => 'required|max:30|min:5',
            'category_id' => 'required',
        ]);
    }

    public function updatePage(Request $request, $username)
    {
        $validator = $this->adminPageValidation($request->all());
        if ($validator->fails()) {
            return redirect()->back()
            ->withInput($request->all())
            ->withErrors($validator->errors());
        }

        $timeline = Timeline::where('username', $username)->first();
        $page = Page::where('timeline_id', $timeline->id)->first();

        $timeline->name = $request->name;
        $timeline->about = $request->about;
        $timeline->save();

        $page_details = $request->except('name', 'about', 'username');
        $page->update($page_details);

        $category_options = ['' => 'Select Category'] + Category::pluck('name', 'id')->all();
        Flash::success(trans('messages.page_updated_success'));
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');

        return $theme->scope('admin/pages/edit', compact('category_options', 'username', 'page', 'timeline'))->render();
    }

    public function deletePage($page_id)
    {
        $page = Page::find($page_id);

        $page->timeline->reports()->detach();
        
        $page->users()->detach();
        $page->likes()->detach();
        
        //Deleting page notifications
        $timeline_alerts = $page->timeline()->with('notifications')->first();
        if (count($timeline_alerts->notifications) != 0) {
            foreach ($timeline_alerts->notifications as $notification) {
                $notification->delete();
            }
        }
        
        //Deleting page posts
        $timeline_posts = $page->timeline()->with('posts')->first();
        if (count($timeline_posts->posts) != 0) {
            foreach ($timeline_posts->posts as $post) {
                $post->deleteMe();
            }
        }
        
        $page_timeline = $page->timeline();

        //Deleting page albums
        foreach ($page->timeline->albums()->get() as $album) {
            foreach ($album->photos()->get() as $media) {
                $saveMedia = $media;
                $album->photos()->detach($media->id);
            }
            $album->delete();
        }
        $page->delete();
        $page_timeline->delete();
        
        Flash::success(trans('messages.page_deleted_success'));

        return redirect()->back();
    }

    public function manageSortings($sort_by, $timeline_type)
    {
        $timelines = '';
        if ($sort_by == 'name_asc') {
            $timelines = Timeline::orderBy('name', 'ASC')->where('type', $timeline_type)->paginate(Setting::get('items_page', 10));
        } elseif ($sort_by == 'name_desc') {
            $timelines = Timeline::orderBy('name', 'DESC')->where('type', $timeline_type)->paginate(Setting::get('items_page', 10));
        } elseif ($sort_by == 'created_asc') {
            $timelines = Timeline::orderBy('created_at', 'ASC')->where('type', $timeline_type)->paginate(Setting::get('items_page', 10));
        } elseif ($sort_by == 'created_desc') {
            $timelines = Timeline::orderBy('created_at', 'DESC')->where('type', $timeline_type)->paginate(Setting::get('items_page', 10));
        } elseif ($sort_by) {
            $timelines = Timeline::where('type', $timeline_type)->paginate(Setting::get('items_page', 10));
        }
        
        return $timelines;
    }

    public function showGroups(Request $request)
    {
        $timelines = '';
        
        if ($request->all()) {
            $sort_type = $request->sort;

            if ($sort_type && ($sort_type != 'open_group' || $sort_type != 'closed_group'|| $sort_type != 'secret_group')) {
                $timelines = $this->manageSortings($request->sort, $type = 'group');
            } elseif ($request->page && ($sort_type == null || $sort_type != 'open_group' || $sort_type != 'closed_group'|| $sort_type != 'secret_group')) {
                $timelines = $this->manageSortings($request->page, $type = 'group');
            }

            if ($sort_type == 'open_group' || $sort_type == 'closed_group' || $sort_type == 'secret_group') {
                $grouptype = '';
                if ($sort_type == 'open_group') {
                    $grouptype = 'open';
                } elseif ($sort_type == 'closed_group') {
                    $grouptype = 'closed';
                } elseif ($sort_type == 'secret_group') {
                    $grouptype = 'secret';
                }
               
                $timelines = Timeline::where('type', 'group')->with('groups')->whereHas('groups', function ($query) use ($grouptype) {
                    $query->where('type', $grouptype);
                })->paginate(Setting::get('items_page', 10));
            }

            if ($sort_type == 'member_asc' || $sort_type == 'member_desc') {
                $timelines = Timeline::where('type', 'group')->get();
                $total_groups = [];
                $timeline_arr = [];

                foreach ($timelines as $timeline) {
                    $group = $timeline->groups;
                    if ($group) {
                        $users = $group->getGroupCount($group->id);
                        if ($users) {
                            array_push($total_groups, $users);
                        }
                    }
                }

                if ($sort_type == 'member_asc') {
                    $final_array = array_values(array_sort($total_groups, function ($value) {
                        return $value->user_count;
                    }));
                } else {
                    $final_array = array_reverse(array_sort($total_groups, function ($value) {
                        return $value->user_count;
                    }));
                }

                $currentPage = LengthAwarePaginator::resolveCurrentPage();
                foreach ($final_array as $f_array) {
                    $group = Group::find($f_array->group_id);
                    array_push($timeline_arr, $group->timeline);
                }

                $collection = new Collection($timeline_arr);
                $perPage = Setting::get('items_page', 10);
                $currentPageSearchResults = $collection->slice(($currentPage - 1) * $perPage, $perPage)->all();
                $timelines= new LengthAwarePaginator(
                    $currentPageSearchResults,
                    count($collection),
                    $perPage,
                    Paginator::resolveCurrentPage(),
                    ['path' => Paginator::resolveCurrentPath()]
                );
            }
        } else {
            $timelines = Timeline::where('type', 'group')->paginate(Setting::get('items_page', 10));
        }

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.manage_groups').' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('admin/groups/show', compact('timelines'))->render();
    }

    public function editGroup($username)
    {
        $timeline = Timeline::where('username', $username)->first();
        $groups = $timeline->groups()->first();

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.edit').' '.$timeline->name.' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));


        return $theme->scope('admin/groups/edit', compact('timeline', 'groups', 'username'))->render();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function adminGroupValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'type' => 'required',
        ]);
    }

    public function updateGroup(Request $request, $username)
    {
        $validator = $this->adminGroupValidator($request->all());
        if ($validator->fails()) {
            return redirect()->back()
            ->withInput($request->all())
            ->withErrors($validator->errors());
        }

        $timeline = Timeline::where('username', $username)->first();
        $groups = Group::where('timeline_id', $timeline->id)->first();

        $group_input = $request->only('type', 'member_privacy', 'post_privacy', 'event_privacy');
        $groups->update($group_input);

        $timeline_input = $request->only('name', 'about');
        $timeline->update($timeline_input);

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');

        Flash::success(trans('messages.group_updated_success'));

        return $theme->scope('admin/groups/edit', compact('timeline', 'groups', 'username'))->render();
    }

    public function deleteGroup($group_id)
    {
        $group = Group::find($group_id);

        $group->timeline->reports()->detach();
        
        //Deleting events in a group
        if (count($group->getEvents()) != 0) {
            foreach ($group->getEvents() as $event) {
                $event->users()->detach();

                // Deleting event posts
                $event_posts = $event->timeline()->with('posts')->first();

                if (count($event_posts->posts) != 0) {
                    foreach ($event_posts->posts as $post) {
                        $post->deleteMe();
                    }
                }

                //Deleting event notifications
                $timeline_alerts = $event->timeline()->with('notifications')->first();

                if (count($timeline_alerts->notifications) != 0) {
                    foreach ($timeline_alerts->notifications as $notification) {
                        $notification->delete();
                    }
                }

                $event_timeline = $event->timeline();

                //Deleting group albums
                foreach ($group->timeline->albums()->get() as $album) {
                    foreach ($album->photos()->get() as $media) {
                        $saveMedia = $media;
                        $album->photos()->detach($media->id);
                    }
                    $album->delete();
                }
                $event->delete();
                $event_timeline->delete();
            }
        }
        $group->users()->detach();
        
        $timeline_alerts = $group->timeline()->with('notifications')->first();

        if (count($timeline_alerts->notifications) != 0) {
            foreach ($timeline_alerts->notifications as $notification) {
                $notification->delete();
            }
        }
        $timeline_posts = $group->timeline()->with('posts')->first();
        
        if (count($timeline_posts->posts) != 0) {
            foreach ($timeline_posts->posts as $post) {
                $post->deleteMe();
            }
        }
        $group_timeline = $group->timeline();
        $group->delete();
        $group_timeline->delete();
        Flash::success(trans('messages.group_deleted_success'));

        return redirect()->back();
    }

    public function manageReports()
    {
        $user = User::all();
        $post = new Post();
        $page_reports = [];
        $group_reports = [];
        $user_reports = [];

        $post_reports = DB::table('post_reports')->get();
        $timeline_reports = DB::table('timeline_reports')->get();

        foreach ($timeline_reports as $timeline_report) {
            $timeline = Timeline::find($timeline_report->timeline_id);
            if ($timeline != null) {
                if ($timeline->type == 'page') {
                    array_push($page_reports, $timeline_report);
                } elseif ($timeline->type == 'group') {
                    array_push($group_reports, $timeline_report);
                } elseif ($timeline->type == 'user') {
                    array_push($user_reports, $timeline_report);
                }
            }
        }

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.manage_reports').' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));


        return $theme->scope('admin/manage-reports', compact('user', 'post_reports', 'post', 'page_reports', 'group_reports', 'user_reports', 'timeline'))->render();
    }

    public function markSafeReports($report_id)
    {
        $post = new Post();
        $check_report = $post->deleteManageReport($report_id);
        if ($check_report) {
            Flash::success(trans('messages.report_mark_safe'));

            return redirect()->back();
        }
    }

    public function deletePostReports($report_id, $post_id)
    {
        $post = Post::find($post_id);
        $notifications = Notification::where('post_id', $post_id)->get();
        //$comments = Comment::where('post_id',$post_id)->get();

        $check_report = $post->deleteManageReport($report_id);
        if ($check_report) {
            if ($notifications != null) {
                foreach ($notifications as $notification) {
                    $notification->delete();
                }
            }


            if ($post->delete()) {
                Flash::success(trans('messages.report_deleted_success'));

                return redirect()->back();
            }
        }
    }

    public function manageAds()
    {
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.manage_ads').' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('admin/manage-ads')->render();
    }

    public function updateManageAds(Request $request)
    {
        $settings = $request->except('_token');
        Setting::set($settings);
        Flash::success(trans('messages.ads_updated_success'));

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');

        return $theme->scope('admin/manage-ads')->render();
    }

    public function settings()
    {
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.settings').' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('admin/settings')->render();
    }

    public function markPageSafeReports($report_id)
    {
        $post = new Post();
        $check_report = $post->deletePageReport($report_id);
        if ($check_report) {
            Flash::success(trans('messages.report_mark_safe'));

            return redirect()->back();
        }
    }

    // public function deletePageReports($report_id, $timeline_id)
    // {
    //     $post = new Post();
    //     $chk_report = $post->deletePageReport($report_id);
    //     if ($chk_report) {
    //         $page = Page::where('timeline_id', $timeline_id)->first();
    //         if ($page) {
    //             $page->delete();
    //         }

    //         $timeline = Timeline::where('id', $timeline_id)->first();
    //         if ($timeline) {
    //             $timeline->delete();
    //         }

    //         Flash::success(trans('messages.page_deleted_success'));

    //         return redirect()->back();
    //     }
    // }

    // public function deleteUserReports($report_id, $timeline_id)
    // {

    //     $timeline = Timeline::find($timeline_id);
    //     $user = $timeline->user;

    //     if($user->deleteUserSettings($user->id) && $user->delete())
    //     {
    //         $page_users = $user->own_pages();
            
    //         if($page_users)
    //         {
    //             foreach ($page_users as $page_user) {
    //                 $page_timeline = Timeline::where('id', $page_user->timeline_id)->first();
    //                 $page_timeline->delete();
    //                 $page_user->delete();
    //             }
    //         }

    //         // $page_likes = $user->pageLikes()->get();
    //         // if($page_likes)
    //         // {
    //         //     foreach ($page_likes as $page_like) {
    //         //         $page_like->delete();
    //         //     }
    //         // }
            
    //         $group_users = $user->own_groups();;
    //         if($group_users)
    //         {
    //             foreach ($group_users as $group_user) {
    //                 $group_timeline = Timeline::where('id', $group_user->timeline_id)->first();
    //                 $group_timeline->delete();
    //                 $group_user->delete();
    //             }
    //         }
            
    //         //posts
    //         $posts =$user->posts()->get();
    //         if($posts)
    //         {
    //             foreach ($posts as $post) {
    //                 // $post_likes = $post->users_liked()->get();
    //                 // if($post_likes)
    //                 // {
    //                 //     foreach ($post_likes as $post_like) {
    //                 //         $post_like->delete();
    //                 //     }
    //                 // }

    //                 // post follow delete
    //                 // $post_follows = $post->notifications_user()->get();
    //                 // if($post_follows)
    //                 // {
    //                 //     foreach ($post_follows as $post_follow) {
    //                 //         $post_follow->delete();
    //                 //     }
    //                 // }
    //                 // post share deleting
    //                 // $post_shares = $post->shares()->get();
    //                 // if($post_shares)
    //                 // {
    //                 //     foreach ($post_shares as $post_share) {
    //                 //         $post_share->delete();
    //                 //     }
    //                 // }

    //                 //post media
    //                 // $post_medias = $post->images()->get();
    //                 // if($post_medias)
    //                 // {
    //                 //     foreach ($post_medias as $post_media) {
    //                 //         $post_media->delete();
    //                 //     }
    //                 // }

    //                 //post tags
    //                 // $users_taggeds = $post->users_tagged()->get();
    //                 // foreach ($users_taggeds as $users_tagged) {
    //                 //     $users_tagged->delete();
    //                 // }

    //                 $post->delete();
    //             }
    //         }

    //         // Notification delete

    //         $notifications = $user->notifications()->get();
    //         if($notifications)
    //         {
    //             foreach ($notifications as $notification) {
    //                 $notification->delete();
    //             }
    //         }

    //         // Announcements delete
    //         $announcements = $user->announcements()->get();
    //         if($announcements)
    //         {
    //             foreach ($announcements as $announcement) {
    //                 $announcement->delete();
    //             }
    //         }

    //         // comments deleting
    //         $comments = DB::table('comments')->where('user_id', $user->id)->get();

    //         if($comments)
    //         {
    //             foreach ($comments as $comment) {
    //                 $comment_likes = DB::table('comment_likes')->where('comment_id', $comment->id)->get();
                    
    //                 if($comment_likes)
    //                 {
    //                     foreach ($comment_likes as $comment_like) {
    //                         //$comment_like->delete();
    //                         DB::table('comment_likes')->where('comment_id', $comment->id)->delete();
    //                     }
    //                 }
    //                 //$comment->delete();
    //                 DB::table('comments')->where('user_id', $comment->user_id)->delete();
    //             }
    //         }

    //         //events delete
    //         $events = Event::where('user_id', $user->id)->get();
    //         if($events)
    //         {
    //             foreach ($events as $event) {
    //                 $event->timeline()->delete();
    //                 $event->delete();
    //             }
    //         }

    //         //followers delete
    //         // $followers = $user->followers()->get();
    //         // if($followers)
    //         // {
    //         //     foreach ($followers as $follower) {
    //         //         $follower->delete();
    //         //     }
    //         // }

    //         // messages delete
    //         $messages = DB::table('messages')->where('user_id', $user->id)->get();
    //         if($messages)
    //         {
    //             foreach ($messages as $message) {
    //                 //$message->delete();
    //                 DB::table('messages')->where('user_id', $message->user_id)->delete();
    //             }
    //         }

    //          // participants delete
    //         $participants = DB::table('participants')->where('user_id', $user->id)->get();
    //         if($participants)
    //         {
    //             foreach ($participants as $participant) {
    //                 //$participant->delete();
    //                 DB::table('participants')->where('user_id', $participant->user_id)->delete();
    //             }
    //         }

    //         // Roles delete
    //         $roles = DB::table('role_user')->where('user_id', $user->id)->get();
    //         if($roles)
    //         {
    //             foreach ($roles as $role) {
    //                 //$role->delete();
    //                 DB::table('role_user')->where('user_id', $role->user_id)->delete();
    //             }
    //         }
            
    //         $post_obj = new Post();
    //         $chk_report = $post_obj->deletePageReport($report_id);
    //         if ($chk_report && $timeline->delete()) {
    //             Flash::success(trans('messages.user_deleted_success'));
    //             return redirect()->back();
    //         }
    //     }
    // }

    public function getEnv()
    {
        if (Config::get('app.env') == 'demo') {
            $env = File::get(base_path('env.example'));
        } else {
            $env = File::get(base_path('.env'));
        }

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.environment_settings').' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('admin/env', compact('env'))->render();
    }

    public function saveEnv(Request $request)
    {
        Flash::success(trans('common.saved_changes'));

        $env = $request->env;
        file_put_contents(base_path('.env'), $env);

        return redirect('admin/get-env');
    }

    public function getUpdateDatabase(Request $request)
    {
        $migrations = DB::table('migrations')->select('migration')->get();


        $files = array_map('basename', File::allFiles(base_path('database/migrations')));
        $count = 0;
        if (count($migrations) < count($files)) {
            $count = count($files) - count($migrations);
        }


        Artisan::call('migrate:status');
        $output = Artisan::output();

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');

        return $theme->scope('admin/update-database', compact('output', 'count'))->render();
    }

    public function postUpdateDatabase(Request $request)
    {
        try {
            Artisan::call('migrate', [
                    '--force' => true,
                ]);
            Artisan::call('view:clear');
        } catch (Exception $e) {
        }

        $output = Artisan::output();
        Flash::success('Update has been done successfully');

        return redirect('admin/update-database');
    }

    public function getEvents(Request $request)
    {
        if ($request->sort) {
            $sort_type = $request->sort;
            if ($sort_type && ($sort_type != 'guest_asc' || $sort_type != 'guest_desc'|| $sort_type != 'private'|| $sort_type != 'public')) {
                $sortType = '';
                if ($sort_type =='name_asc') {
                    $sortType = 'ASC';
                } elseif ($sort_type =='name_desc') {
                    $sortType = 'DESC';
                } elseif ($sort_type =='private') {
                    $sortType = 'private';
                } elseif ($sort_type =='public') {
                    $sortType = 'public';
                }

                if ($sortType == 'ASC' || $sortType == 'DESC') {
                    $ongoning_events = Timeline::orderBy('name', $sortType)->where('type', 'event')->with('event')->whereHas('event', function ($query) {
                        $query->whereDate('start_date', '<=', date('Y-m-d', strtotime(Carbon::now())))
                        ->whereDate('end_date', '>=', date('Y-m-d', strtotime(Carbon::now())));
                    })->paginate(Setting::get('items_page', 10));

                    $upcoming_events = Timeline::orderBy('name', $sortType)->where('type', 'event')->with('event')->whereHas('event', function ($query) {
                        $query->whereDate('start_date', '>', date('Y-m-d', strtotime(Carbon::now())));
                    })->paginate(Setting::get('items_page', 10));

                    $expired_events = Timeline::orderBy('name', $sortType)->where('type', 'event')->with('event')->whereHas('event', function ($query) {
                        $query->whereDate('end_date', '<', date('Y-m-d', strtotime(Carbon::now())));
                    })->paginate(Setting::get('items_page', 10));
                }

                if ($sortType == 'private' || $sortType == 'public') {
                    $ongoning_events = Timeline::where('type', 'event')->with('event')->whereHas('event', function ($query) use ($sortType) {
                        $query->where('type', $sortType)->whereDate('start_date', '<=', date('Y-m-d', strtotime(Carbon::now())))
                        ->whereDate('end_date', '>=', date('Y-m-d', strtotime(Carbon::now())));
                    })->paginate(Setting::get('items_page', 10));

                    $upcoming_events = Timeline::where('type', 'event')->with('event')->whereHas('event', function ($query) use ($sortType) {
                        $query->where('type', $sortType)->whereDate('start_date', '>', date('Y-m-d', strtotime(Carbon::now())));
                    })->paginate(Setting::get('items_page', 10));

                    $expired_events = Timeline::where('type', 'event')->with('event')->whereHas('event', function ($query) use ($sortType) {
                        $query->where('type', $sortType)->whereDate('end_date', '<', date('Y-m-d', strtotime(Carbon::now())));
                    })->paginate(Setting::get('items_page', 10));
                }
            }
        } else {
            $ongoning_events = Timeline::where('type', 'event')->with('event')->whereHas('event', function ($query) {
                $query->whereDate('start_date', '<=', date('Y-m-d', strtotime(Carbon::now())))
                ->whereDate('end_date', '>=', date('Y-m-d', strtotime(Carbon::now())));
            })->paginate(Setting::get('items_page', 10));

            $upcoming_events = Timeline::where('type', 'event')->with('event')->whereHas('event', function ($query) {
                $query->whereDate('start_date', '>', date('Y-m-d', strtotime(Carbon::now())));
            })->paginate(Setting::get('items_page', 10));

            $expired_events = Timeline::where('type', 'event')->with('event')->whereHas('event', function ($query) {
                $query->whereDate('end_date', '<', date('Y-m-d', strtotime(Carbon::now())));
            })->paginate(Setting::get('items_page', 10));
        }

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.manage_events').' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('admin/events/show', compact('ongoning_events', 'upcoming_events', 'expired_events'))->render();
    }

    public function editEvent($username)
    {
        $timeline = Timeline::where('username', $username)->first();
        $event = $timeline->event()->first();

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.edit').' '.$timeline->name.' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('admin/events/edit', compact('timeline', 'event', 'username'))->render();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateEventPage(array $data)
    {
        return Validator::make($data, [
            'name'        => 'required|max:30|min:5',
            'start_date'  => 'required',
            'end_date'    => 'required',
            'location'    => 'required',
            'type'        => 'required',
        ]);
    }

    public function updateEvent(Request $request, $username)
    {
        $validator = $this->validateEventPage($request->all());
        if ($validator->fails()) {
            return redirect()->back()
            ->withInput($request->all())
            ->withErrors($validator->errors());
        }

        $timeline = Timeline::where('username', $username)->first();
        $timeline_values = $request->only('name', 'about');
        $update_timeline = $timeline->update($timeline_values);

        $event = $timeline->event()->first();
        $event_values = $request->only('type', 'location', 'invite_privacy', 'timeline_post_privacy');
        $event_values['start_date'] = date('Y-m-d H:i', strtotime($request->start_date));
        $event_values['end_date'] = date('Y-m-d H:i', strtotime($request->end_date));
        $update_values = $event->update($event_values);

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');

        Flash::success(trans('messages.event_updated_success'));

        return $theme->scope('admin/events/edit', compact('timeline', 'event', 'username'))->render();
    }

    public function removeEvent($event_id)
    {
        $event = Event::find($event_id);
        
        //Deleting Events
        $event->users()->detach();

            // Deleting event posts
        $event_posts = $event->timeline()->with('posts')->first();
        
        if (count($event_posts->posts) != 0) {
            foreach ($event_posts->posts as $post) {
                $post->deleteMe();
            }
        }

                //Deleting event notifications
        $timeline_alerts = $event->timeline()->with('notifications')->first();

        if (count($timeline_alerts->notifications) != 0) {
            foreach ($timeline_alerts->notifications as $notification) {
                $notification->delete();
            }
        }

        $event_timeline = $event->timeline();
        $event->delete();
        $event_timeline->delete();

        Flash::success(trans('messages.event_deleted_success'));
        return redirect()->back();
    }

    public function wallpapers()
    {
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');
        $theme->setTitle(trans('common.wallpapers').' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));
        return $theme->scope('admin/wallpapers')->render();
    }

    public function addWallpapers(Request $request)
    {
        if($request->wallpapers[0] == NULL)
        {
            Flash::error(trans('messages.no_file_added'));
            return redirect()->back();
        }
        foreach ($request->wallpapers as $wallpaper) {

            $strippedName = str_replace(' ', '', $wallpaper->getClientOriginalName());
            $photoName = date('Y-m-d-H-i-s').$strippedName;
            $photo = Image::make($wallpaper->getRealPath());
            $photo->save(storage_path().'/uploads/wallpapers/'.$photoName, 60);

            $media = Media::create([
              'title'  => $wallpaper->getClientOriginalName(),
              'type'   => 'image',
              'source' => $photoName,
            ]);
            
            $input['title'] = $wallpaper->getClientOriginalName();
            $input['media_id'] = $media->id;
            Wallpaper::create($input);
        }
        Flash::success(trans('messages.create_wallpapers_success'));
        return redirect()->back();
    }

    public function deleteWallpaper(Wallpaper $wallpaper)
    {
        $media_id = $wallpaper->media()->first()->id;
        Timeline::where('background_id', $media_id)->update(['background_id' => null]);
        $wallpaper->delete();
        Media::find($media_id)->delete();
        
        Flash::success(trans('messages.wallpaper_delete_success'));
        return redirect()->back();
    }

    public function test()
    {
       // Flash::success(trans('messages.event_settings_updated_success'));
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('admin');

        return $theme->scope('admin/test')->render();
    }
}
