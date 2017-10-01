<?php

use Cmgmyr\Messenger\Models\Message;
use Intervention\Image\Facades\Image;

//font
Route::get('/font-base', 'PageController@font');


/*
|--------------------------------------------------------------------------
| API routes
|--------------------------------------------------------------------------
*/

Route::get('/contact', 'PageController@contact');
Route::post('/contact', 'PageController@saveContact');
Route::get('/share-post/{id}', 'PageController@sharePost');
Route::get('/get-location/{location}', 'HomeController@getLocation');

Route::post('/wallet/create/{type}/{id}', 'WalletController@walletCreate');
Route::post('/wallet/update/{type}/{id}', 'WalletController@walletUpdate');

Route::get('sitemap', 'SitemapsController@index');

Route::get('games/browse', 'GameController@getBrowse');

/*
Route::group(['prefix' => 'api', 'middleware' => ['auth', 'cors'], 'namespace' => 'API'], function () {
    Route::group(['prefix' => 'v1'], function () {
        require config('infyom.laravel_generator.path.api_routes');
    });
});
*/

Route::post('pusher/auth', function (Illuminate\Http\Request $request, Pusher $pusher) {
    return $pusher->presence_auth(
        $request->input('channel_name'),
        $request->input('socket_id'),
        uniqid(),
        ['username' => $request->input('username')]
    );
});

Route::post('/exchange', 'ExchangeController@index');
Route::post('/payment/index', 'PaymentController@index');
Route::get('/payment/fillingfields', 'PaymentController@fillingFields');
Route::post('/payment/result', 'PaymentController@result');
Route::get('/payment/result', 'PaymentController@resultGet');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {
    Auth::routes();
});


// Redirect to facebook to authenticate
Route::get('facebook', 'Auth\RegisterController@facebookRedirect');
// Get back to redirect url
Route::get('account/facebook', 'Auth\RegisterController@facebook');

// Redirect to google to authenticate
Route::get('google', 'Auth\RegisterController@googleRedirect');
// Get back to redirect url
Route::get('account/google', 'Auth\RegisterController@google');

// Redirect to twitter to authenticate
Route::get('twitter', 'Auth\RegisterController@twitterRedirect');
// Get back to redirect url
Route::get('account/twitter', 'Auth\RegisterController@twitter');

// Redirect to linkedin to authenticate
Route::get('linkedin', 'Auth\RegisterController@linkedinRedirect');
// Get back to redirect url
Route::get('account/linkedin', 'Auth\RegisterController@linkedin');


//sign in esvoe
Route::get('/login_svoe', 'PageController@login_svoe');

//page photo
Route::get('/photo', 'PageController@pagePhoto');

//faq
Route::get('/faq', 'PageController@faq');

// Login
Route::get('/login', 'Auth\LoginController@getLogin');
Route::post('/login', 'Auth\LoginController@login');

// Register
Route::get('/register', 'Auth\RegisterController@register');

Route::post('/register-ajaxValidate', 'Auth\RegisterController@ajaxValidate');
Route::post('/register', 'Auth\RegisterController@registerUser');

Route::get('email/verify', 'Auth\RegisterController@verifyEmail');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'TimelineController@showFeed');
    Route::get('/browse', 'TimelineController@showGlobalFeed');
});


Route::get('/home', 'HomeController@index');

Route::post('/member/update-role', 'TimelineController@assignMemberRole');
Route::post('/member/updatepage-role', 'TimelineController@assignPageMemberRole');
Route::get('/post/{post_id}', 'TimelineController@singlePost');

Route::get('allnotifications', 'TimelineController@allNotifications');

/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
*/


Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/', 'AdminController@dashboard');
    Route::get('/general-settings', 'AdminController@generalSettings');
    Route::post('/general-settings', 'AdminController@updateGeneralSettings');

    Route::get('/user-settings', 'AdminController@userSettings');
    Route::post('/user-settings', 'AdminController@updateUserSettings');

    Route::get('/page-settings', 'AdminController@pageSettings');
    Route::post('/page-settings', 'AdminController@updatePageSettings');

    Route::get('/group-settings', 'AdminController@groupSettings');
    Route::post('/group-settings', 'AdminController@updateGroupSettings');

    Route::get('/custom-pages', 'AdminController@listCustomPages');
    Route::get('/custom-pages/create', 'AdminController@createCustomPage');
    Route::post('/custom-pages', 'AdminController@storeCustomPage');
    Route::get('/custom-pages/{id}/edit', 'AdminController@editCustomPage');
    Route::post('/custom-pages/{id}/update', 'AdminController@updateCustomPage');

    Route::get('/announcements', 'AdminController@getAnnouncements');
    Route::get('/announcements/create', 'AdminController@createAnnouncement');
    Route::get('/announcements/{id}/edit', 'AdminController@editAnnouncement');
    Route::post('/announcements/{id}/update', 'AdminController@updateAnnouncement');
    Route::post('/announcements', 'AdminController@addAnnouncements');
    Route::get('/activate/{announcement_id}', 'AdminController@activeAnnouncement');

    Route::get('/themes', 'AdminController@themes');
    Route::get('/change-theme/{name}', 'AdminController@changeTheme');

    Route::get('/users', 'AdminController@showUsers');
    Route::get('/users/{username}/edit', 'AdminController@editUser');
    Route::post('/users/{username}/edit', 'AdminController@updateUser');
    //Route::get('/users/{user_id}/delete', 'AdminController@deleteUser');

    Route::get('/users/{username}/delete', 'UserController@deleteMe');
    Route::post('/users/{username}/newpassword', 'AdminController@updatePassword');

    Route::get('/pages', 'AdminController@showPages');
    Route::get('/pages/{username}/edit', 'AdminController@editPage');
    Route::post('/pages/{username}/edit', 'AdminController@updatePage');
    Route::get('/pages/{page_id}/delete', 'AdminController@deletePage');


    Route::get('/groups', 'AdminController@showGroups');
    Route::get('/groups/{username}/edit', 'AdminController@editGroup');
    Route::post('/groups/{username}/edit', 'AdminController@updateGroup');
    Route::get('/groups/{group_id}/delete', 'AdminController@deleteGroup');


    Route::get('/manage-reports', 'AdminController@manageReports');
    Route::post('/manage-reports', 'AdminController@updateManageReports');
    Route::get('/mark-safe/{report_id}', 'AdminController@markSafeReports');
    Route::get('/delete-post/{report_id}/{post_id}', 'AdminController@deletePostReports');

    Route::get('/manage-ads', 'AdminController@manageAds');
    Route::get('/update-database', 'AdminController@getUpdateDatabase');
    Route::post('/update-database', 'AdminController@postUpdateDatabase');
    Route::get('/get-env', 'AdminController@getEnv');
    Route::post('/save-env', 'AdminController@saveEnv');
    Route::post('/manage-ads', 'AdminController@updateManageAds');
    Route::get('/settings', 'AdminController@settings');
    Route::get('/markpage-safe/{report_id}', 'AdminController@markPageSafeReports');
    Route::get('/deletepage/{page_id}/{status}', 'AdminController@deletePage');
    Route::get('/deleteuser/{username}', 'UserController@deleteMe');
    Route::get('/deletegroup/{group_id}', 'AdminController@deleteGroup');

    Route::get('/category/create', 'AdminController@addCategory');
    Route::post('/category/create', 'AdminController@storeCategory');
    Route::get('/category/{id}/edit', 'AdminController@editCategory');
    Route::post('/category/{id}/update', 'AdminController@updateCategory');

    Route::get('/events', 'AdminController@getEvents');
    Route::get('/events/{username}/edit', 'AdminController@editEvent');
    Route::post('/events/{username}/edit', 'AdminController@updateEvent');
    Route::get('/events/{event_id}/delete', 'AdminController@removeEvent');

    Route::get('/event-settings', 'AdminController@eventSettings');
    Route::post('/event-settings', 'AdminController@updateEventSettings');

    Route::get('/wallpapers', 'AdminController@wallpapers');
    Route::post('/wallpapers', 'AdminController@addWallpapers');
    Route::get('/wallpaper/{wallpaper}/delete', 'AdminController@deleteWallpaper');
    Route::get('/translations', '\Barryvdh\TranslationManager\Controller@getIndex');

});


/*
|--------------------------------------------------------------------------
| Games routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix'=>'api/v1/apps', 'middleware'=>['cors'], 'namespace'=>'Applications', 'as'=>'applications.api'], function() {
    Route::match(['get', 'post'], 'call.me', array('uses'=>'ApplicationAPIController@simple', 'as'=>'.simple'));
    Route::match(['get', 'post'], '{group}/{method}', array('uses'=>'ApplicationAPIController@router', 'as'=>'.router'));
});

Route::group(['prefix'=>'apps', 'middleware'=>['auth'], 'namespace'=>'Applications', 'as'=>'applications.'], function() {
    Route::get('', array('uses'=>'CatalogController@globalCatalog', 'as'=>'catalog.index'));
    Route::get('games', array('uses'=>'CatalogController@index', 'as'=>'catalog.category.games'));
    Route::get('global', array('uses'=>'CatalogController@globalCatalog', 'as'=>'catalog.global'));
    Route::get('section/{id}', array('uses'=>'CatalogController@section', 'as'=>'catalog.section'));
    Route::get('category/{id}', array('uses'=>'CatalogController@category', 'as'=>'catalog.category'));
    Route::get('section/games', array('uses'=>'CatalogController@sectionGames', 'as'=>'catalog.section.games'));

    Route::get('linked', array('uses'=>'ApplicationController@userApplications', 'as'=>'linked'));

});

Route::group(['prefix' => 'app', 'middleware' => ['auth'], 'namespace'=>'Applications','as'=>'applications.'], function () {

    Route::get('{gamename}', array('uses'=>'ApplicationController@index', 'as'=>'container'));
    Route::post('{gamename}', array('uses'=>'ApplicationController@linkApplication', 'as'=>'grant_permissions'));

    Route::get('{id}/preview', array('uses'=>'ApplicationController@preview', 'as'=>'container.preview'));
    Route::post('{id}/preview', array('uses'=>'ApplicationController@previewPost', 'as'=>'container.preview'));
    Route::get('{id}/preview/data', array('uses'=>'ApplicationController@previewData', 'as'=>'container.preview.data'));
    Route::post('{id}/authorize', array('uses'=>'ApplicationController@authorizeApplication', 'as'=>'container.authorize'));

    Route::group(['prefix'=>'{gamename}/ajax', 'as'=>'ajax.'], function() {

        Route::post('app_payment_prepare', array('uses'=>'AjaxController@ajaxAppPaymentPrepare', 'as'=>'payment_prepare'));
        Route::post('app_payment_submit', array('uses'=>'AjaxController@ajaxAppPaymentSubmit', 'as'=>'payment_submit'));
        Route::post('app_payment_confirm', array('uses'=>'AjaxController@ajaxAppPaymentConfirm', 'as'=>'payment_confirm'));
    });
});

Route::group(['prefix'=>'application', 'namespace'=>'Applications', 'as'=>'application.'], function(){
    Route::group(['as'=>'action.'], function(){
        Route::post('unlink', array('uses' => 'ActionController@unlinkApplication', 'as'=>'unlink'));
    });
    Route::group(['prefix'=>'ajax', 'as'=>'ajax.'], function() {
        Route::post('rate', array('uses' => 'AjaxController@rateApplication', 'as'=>'rate'));
    });
});

Route::group(['prefix' => 'application/auth', 'namespace' => 'Applications'], function () {
    Route::get('', array('uses' => 'AuthController@index', 'as' => 'developer.oauth'));
    Route::get('error', array('uses' => 'AuthController@error', 'as' => 'developer.oauth.error'));
    Route::get('login', array('uses' => 'AuthController@login', 'as' => 'developer.oauth.login'));
    Route::post('login', array('uses' => 'AuthController@loginPost', 'as' => 'developer.oauth.login')); //loginSubmit
    Route::get('select', array('uses' => 'AuthController@select', 'as' => 'developer.oauth.select'));
    Route::post('select', array('uses' => 'AuthController@selectPost', 'as' => 'developer.oauth.select')); //selectUserSubmit
    Route::get('connect', array('uses' => 'AuthController@connect', 'as' => 'developer.oauth.connect'));
    Route::post('connect', array('uses' => 'AuthController@connectPost', 'as' => 'developer.oauth.connect')); //connectSubmit
    Route::get('result', array('uses' => 'AuthController@result', 'as' => 'developer.oauth.result'));
    Route::post('abort', array('uses' => 'AuthController@abortPost', 'as' => 'developer.oauth.abort'));
    Route::get('redirect', array('uses' => 'AuthController@result', 'as' => 'developer.oauth.redirect'));
});

Route::group(['prefix' => 'developer', 'middleware' => ['auth'], 'namespace' => 'Developer', 'as' => 'developer.'], function () {
    //
    Route::get('', array('uses' => 'DeveloperController@index', 'as' => 'index'));
    Route::group(['prefix' => 'application', 'namespace' => 'Application', 'as' => 'applications.'], function () {
        //
        Route::get('list', array('uses' => 'ApplicationController@index', 'as' => 'index'));

        Route::get('create', array('uses' => 'ApplicationController@create', 'as' => 'create'));
        Route::post('create', array('uses' => 'ApplicationController@createPost', 'as' => 'create'));
        Route::get('vue', array('uses' => 'ApplicationController@indexVue'));
        Route::get('{id}/details', array('uses' => 'ApplicationController@editDetails', 'as' => 'edit.details'));
        Route::post('{id}/details', array('uses' => 'ApplicationController@editDetailsPost', 'as' => 'edit.details'));
        Route::get('{id}/container', array('uses' => 'ApplicationController@editContainer', 'as' => 'edit.container'));
        Route::post('{id}/container', array('uses' => 'ApplicationController@editContainerPost', 'as' => 'edit.container'));
        Route::get('{id}/external', array('uses' => 'ApplicationController@editExternal', 'as' => 'edit.external'));
        Route::post('{id}/external', array('uses' => 'ApplicationController@editExternalPost', 'as' => 'edit.external'));
        Route::get('{id}/permissions', array('uses' => 'ApplicationController@editPermissions', 'as' => 'edit.permissions'));
        Route::post('{id}/permissions', array('uses' => 'ApplicationController@editPermissionsPost', 'as' => 'edit.permissions'));
        Route::get('{id}/images', array('uses' => 'ApplicationController@editImages', 'as' => 'edit.images'));
        Route::post('{id}/images', array('uses' => 'ApplicationController@editImagesPost', 'as' => 'edit.images'));

        Route::post('{id}/create_endpoint', array('uses'=>'ApplicationController@endpointCreate', 'as'=>'edit.endpoint.create'));
        Route::post('{id}/delete_endpoint', array('uses'=>'ApplicationController@endpointDelete', 'as'=>'edit.endpoint.delete'));
        Route::post('{id}/update_endpoint', array('uses'=>'ApplicationController@endpointUpdate', 'as'=>'edit.endpoint.update'));
        Route::post('{id}/upload_screenshot', array('uses'=>'ApplicationController@screenshotUpload', 'as'=>'edit.images.screenshot_upload'));

        Route::get('{id}/delete', array('uses' => 'ApplicationController@delete', 'as' => 'delete'));
        Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function () {
            //
            Route::post('update_pay_key/{id}', array('uses' => 'ApplicationController@ajaxUpdatePayKey', 'as' => 'update_pay_key'));
            Route::post('update_api_key/{id}', array('uses' => 'ApplicationController@ajaxUpdateApiKey', 'as' => 'update_api_key'));
        });
    });
    Route::group(['prefix' => 'documents', 'as' => 'documents.'], function () {
        //
        Route::get('', array('uses' => 'DocumentsController@index', 'as' => 'index'));
        Route::get('api', array('uses' => 'DocumentsController@docsApi', 'as' => 'api'));
        Route::get('api/js', array('uses' => 'DocumentsController@docsApiJs', 'as' => 'api.js'));
        Route::get('api/rest', array('uses' => 'DocumentsController@docsApiRest', 'as' => 'api.rest'));
    });
    Route::group(['prefix' => 'manage', 'namespace' => 'Manage', 'as' => 'manage.'], function () {
        //
        Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
            //
            Route::get('', array('uses' => 'CategoriesController@index', 'as' => 'index'));
            Route::get('create', array('uses' => 'CategoriesController@create', 'as' => 'create'));
            Route::post('create', array('uses' => 'CategoriesController@createPost', 'as' => 'create'));
            Route::get('{id}/edit', array('uses' => 'CategoriesController@edit', 'as' => 'edit'));
            Route::post('{id}/edit', array('uses' => 'CategoriesController@editPost', 'as' => 'edit'));
            Route::get('{id}/delete', array('uses' => 'CategoriesController@delete', 'as' => 'delete'));
        });
    });
});


/*
|--------------------------------------------------------------------------
| Friend routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => '/friend', 'middleware' => ['auth']], function () {
    Route::get('/showInviteFriends', array('uses' => 'FriendController@showInviteFriends', 'as' => 'friend.list.of.invite'));

    Route::get('/tempShowInvite', array('uses' => 'FriendController@tempShowInviteFriends', 'as' => 'tmp.friend.list.of.invite'));

    // Ajax
    Route::post('/ajax/listInvites', array('uses' => 'FriendController@listInviteFriends', 'as' => 'friend.listInvites'));
    Route::post('/ajax/find/people', array('uses' => 'FriendController@findPeople', 'as' => 'friend.findPeople'));

    Route::post('/ajax/add', array('uses' => 'FriendController@addFriend', 'as' => 'friend.add'));
    Route::post('/ajax/delete', array('uses' => 'FriendController@deleteFriend', 'as' => 'friend.delete'));
    Route::post('/ajax/invite/cancel', array('uses' => 'FriendController@inviteCancel', 'as' => 'friend.cancel'));
    Route::post('/ajax/invite/accept', array('uses' => 'FriendController@inviteAccept', 'as' => 'friend.accept'));
    Route::post('/ajax/invite/reject', array('uses' => 'FriendController@inviteReject', 'as' => 'friend.reject'));
    Route::post('/ajax/follower/add', array('uses' => 'FriendController@followerAdd', 'as' => 'friend.follower.add'));
    Route::post('/ajax/follower/remove', array('uses' => 'FriendController@followerRemove', 'as' => 'friend.follower.remove'));
    Route::post('/ajax/complain', array('uses' => 'FriendController@complain', 'as' => 'friend.complain'));
    Route::post('/ajax/block', array('uses' => 'FriendController@block', 'as' => 'friend.block'));
    Route::post('/ajax/set/status', array('uses' => 'FriendController@setStatus', 'as' => 'friend.setStatus'));
    Route::post('/ajax/set/relative', array('uses' => 'FriendController@setRelative', 'as' => 'friend.setRelative'));

});


/*
|--------------------------------------------------------------------------
| Messages routes
|--------------------------------------------------------------------------
*/

Route::get('messages/{username?}', 'MessageController@index');


/*
|--------------------------------------------------------------------------
| User routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => '/{username}', 'middleware' => 'auth'], function ($username) {
    Route::get('header', 'UserController@headerProf');

    Route::get('/', array('uses' => 'TimelineController@showTimeline', 'as' => 'user.showTimeline'));

    Route::get('/followers', 'UserController@followers');//todo switch to new implement
    Route::get('/following', 'UserController@following');//todo switch to new implement

    Route::get('/event-guests', 'UserController@getGuestEvents');

    Route::get('/posts', 'TimelineController@posts');

    Route::get('/liked-pages', 'UserController@likedPages');
    Route::get('/joined-groups', 'UserController@joinedGroups');

    Route::get('/members/{group_id}', 'TimelineController@getGroupMember');

    Route::get('/groupadmin/{group_id}', 'TimelineController@getAdminMember');
    Route::get('/groupposts/{group_id}', 'TimelineController@getGroupPosts');
    Route::get('/page-posts', 'TimelineController@getPagePosts');
    Route::get('/page-likes', 'TimelineController@getPageLikes');
    Route::get('/pagemembers', 'TimelineController@getPageMember');
    Route::get('/pageadmin', 'TimelineController@getPageAdmins');
    Route::get('/add-members', 'UserController@membersList');
    Route::get('/add-pagemembers', 'UserController@pageMembersList');

    Route::get('/groupevent/{group_id}', 'TimelineController@addEvent');

    Route::get('/notification/{id}', 'NotificationController@redirectNotification');

    Route::get('/events', 'TimelineController@eventsList');

    Route::get('/event-posts', 'TimelineController@getEventPosts');
    Route::get('/invite-guests', 'UserController@guestList');
    Route::get('/eventguests', 'TimelineController@displayGuests');
    Route::post('/album/upload', 'TimelineController@saveImage')->name('user.album.upload');
    Route::get('/add-eventmembers', 'UserController@getEventGuests');

    Route::get('/audio-recordings', 'MusicController@audioRecording');
    Route::get('/people', 'PeopleController@peoples');
    Route::get('/news', 'NewsController@news');
    Route::get('/apps', 'Applications\CatalogController@showUserApps');
    Route::get('/docs', 'DocsController@docs');
    Route::get('/products', 'ProductController@products');
    Route::get('/cars', 'CarController@cars');
    Route::get('/friends', 'FriendController@index');

    Route::get('/albums', 'TimelineController@allAlbums');
    Route::get('/photos', 'TimelineController@allPhotos');
    Route::get('/videos', 'TimelineController@allVideos');
    Route::get('/album/show/{id}', 'TimelineController@viewAlbum');

    Route::get('/create-event', 'TimelineController@addEvent');
    Route::post('/create-event', 'TimelineController@createEvent');

    Route::get('/create-group', 'TimelineController@addGroup');
    Route::post('/create-group', 'TimelineController@createGroupPage');

    Route::get('/create-page', 'TimelineController@addPage');
    Route::post('/create-page', 'TimelineController@createPage');
});

Route::group(['prefix' => '/{username}', 'middleware' => ['auth', 'editown']], function ($username) {

    Route::get('/messages', 'UserController@messages');
    Route::get('/follow-requests', 'UserController@followRequests');//todo move to friend

    Route::get('/pages-groups', 'TimelineController@pagesGroups');

    Route::get('/album/create', 'TimelineController@createAlbum');
    Route::post('/album/create', 'TimelineController@saveAlbum');

    Route::get('/album/{id}/edit', 'TimelineController@editAlbum');
    Route::post('/album/{id}/edit', 'TimelineController@updateAlbum');
    Route::get('/album/{album}/delete', 'TimelineController@deleteAlbum');

    Route::get('/album-preview/{id}/{photo_id}', 'TimelineController@addPreview');
    Route::get('/delete-media/{media}', 'TimelineController@deleteMedia');

    Route::post('/move-photos', 'UserController@movePhotos');
    Route::post('/delete-photos', 'UserController@deletePhotos');

    Route::get('/pages', 'UserController@pages');
    Route::get('/groups', 'UserController@groups');

    Route::get('/wallet', 'WalletController@getBalance');
    Route::get('/wallet/sell', 'WalletController@sell');
    Route::get('/wallet/buy', 'WalletController@buy');
    Route::get('/wallet/mailing', 'WalletController@refillTomail');
    Route::get('/wallet/withdrawal', 'WalletController@withdrawal');
    Route::get('/wallet/refill', 'WalletController@refill');
    Route::get('/wallet/transaction', 'TransactionController@getAllTransaction');
});

/*
|--------------------------------------------------------------------------
| User settings routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => '/{username}/settings', 'middleware' => ['auth', 'editown']], function ($username) {
    Route::get('/general', 'UserController@userGeneralSettings');
    Route::post('/general', 'UserController@saveUserGeneralSettings');

    Route::get('/privacy', 'UserController@userPrivacySettings');
    Route::post('/privacy', 'UserController@SaveUserPrivacySettings');

    Route::get('/wallpaper', 'UserController@wallpaperSettings');
    Route::post('/wallpaper', 'TimelineController@saveWallpaperSettings');
    Route::get('/toggle-wallpaper/{action}/{media}', 'TimelineController@toggleWallpaper');

    Route::get('/password', 'UserController@userPasswordSettings');
    Route::post('/password', 'UserController@saveNewPassword');

    Route::get('/affliates', 'UserController@affliates');

    Route::get('/deactivate', 'UserController@deactivate');
    Route::get('/deleteme', 'UserController@deleteMe');

    Route::get('/notifications', 'UserController@emailNotifications');
    Route::post('/notifications', 'UserController@updateEmailNotifications');
});


/*
|--------------------------------------------------------------------------
| Page settings routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => '/{username}/page-settings', 'middleware' => ['auth', 'editpage']], function ($username) {
    Route::get('/general', 'TimelineController@generalPageSettings');
    Route::post('/general', 'TimelineController@updateGeneralPageSettings');
    Route::get('/privacy', 'TimelineController@privacyPageSettings');
    Route::post('/privacy', 'TimelineController@updatePrivacyPageSettings');
    Route::get('/wallpaper', 'TimelineController@pageWallpaperSettings');
    Route::post('/wallpaper', 'TimelineController@saveWallpaperSettings');
    Route::get('/toggle-wallpaper/{action}/{media}', 'TimelineController@toggleWallpaper');
    Route::get('/roles', 'TimelineController@rolesPageSettings');
    Route::get('/likes', 'TimelineController@likesPageSettings');
});

/*
|--------------------------------------------------------------------------
| Group settings routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => '/{username}/group-settings', 'middleware' => ['auth', 'editgroup']], function ($username) {
    Route::get('/general', 'TimelineController@groupGeneralSettings');
    Route::post('/general', 'TimelineController@updateUserGroupSettings');
    Route::get('/closegroup', 'TimelineController@userGroupSettings');
    Route::get('/join-requests/{group_id}', 'TimelineController@getJoinRequests');
    Route::get('/wallpaper', 'TimelineController@groupWallpaperSettings');
    Route::post('/wallpaper', 'TimelineController@saveWallpaperSettings');
    Route::get('/toggle-wallpaper/{action}/{media}', 'TimelineController@toggleWallpaper');
});

/*
|--------------------------------------------------------------------------
| Event settings routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => '/{username}/event-settings', 'middleware' => ['auth', 'editevent']], function ($username) {
    Route::get('/general', 'TimelineController@generalEventSettings');
    Route::post('/general', 'TimelineController@updateUserEventSettings');
});

/*
|--------------------------------------------------------------------------
| Ajax Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for ajax.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix' => 'ajax', 'middleware' => ['auth']], function () {
    Route::post('create-post', 'TimelineController@createPost');
    Route::post('get-youtube-video', 'TimelineController@getYoutubeVideo');
    Route::post('like-post', 'TimelineController@likePost');
    Route::post('follow-post', 'TimelineController@follow');
    Route::post('notify-user', 'TimelineController@getNotifications');
    Route::post('post-comment', 'TimelineController@postComment');
    Route::post('page-like', 'TimelineController@pageLike');
    Route::post('change-avatar', 'TimelineController@changeAvatar');
    Route::post('change-cover', 'TimelineController@changeCover');
    Route::post('comment-like', 'TimelineController@likeComment');
    Route::post('comment-delete', 'TimelineController@deleteComment');
    Route::post('edit-comment', 'TimelineController@editComment');
    Route::post('save-edit-comment', 'TimelineController@saveEditComment');
    Route::post('post-delete', 'TimelineController@deletePost');
    Route::post('page-delete', 'TimelineController@deletePage');
    Route::post('share-post', 'TimelineController@sharePost');
    Route::post('page-liked', 'TimelineController@pageLiked');
    Route::post('get-soundcloud-results', 'TimelineController@getSoundCloudResults');
    Route::post('join-group', 'TimelineController@joiningGroup');
    Route::post('join-close-group', 'TimelineController@joiningClosedGroup');
    Route::post('join-accept', 'TimelineController@acceptJoinRequest');
    Route::post('join-reject', 'TimelineController@rejectJoinRequest');
//    Route::post('follow-accept', 'UserController@acceptFollowRequest');//todo @deprecated
//    Route::post('follow-reject', 'UserController@rejectFollowRequest');//todo @deprecated
    Route::get('get-more-posts', 'TimelineController@getMorePosts');
    Route::get('get-more-feed', 'TimelineController@showFeed');
    Route::get('get-global-feed', 'TimelineController@showGlobalFeed');
    Route::post('add-memberGroup', 'UserController@addingMembersGroup');
    Route::post('get-users', 'UserController@getUsersJoin');
    Route::get('get-users-mentions', 'UserController@getUsersMentions');
    Route::post('groupmember-remove', 'TimelineController@removeGroupMember');
    Route::post('group-join', 'TimelineController@timelineGroups');
    Route::post('report-post', 'TimelineController@reportPost');
//    Route::post('follow-user-confirm', 'TimelineController@userFollowRequest');//todo @deprecated
    Route::post('page-report', 'TimelineController@pageReport');
    Route::post('get-notifications', 'UserController@getNotifications');
    Route::post('get-unread-notifications', 'UserController@getUnreadNotifications');
    Route::post('get-unread-message', 'UserController@getUnreadMessage');
    Route::post('pagemember-remove', 'TimelineController@removePageMember');
    Route::post('get-users-modal', 'UserController@getUsersModal');
    Route::post('edit-post', 'TimelineController@editPost');
    Route::get('load-emoji', 'TimelineController@loadEmoji');
    Route::get('load-emoji-comment', 'TimelineController@loadEmojiComment');
    Route::post('update-post', 'TimelineController@updatePost');
    Route::post('/mark-all-notifications', 'NotificationController@markAllRead');
    Route::post('add-page-members', 'UserController@addingMembersPage');
    Route::post('get-members-join', 'UserController@getMembersJoin');
    Route::post('announce-delete', 'AdminController@removeAnnouncement');
    Route::post('category-delete', 'AdminController@removeCategory');
    Route::post('get-members-invite', 'UserController@getMembersInvite');
    Route::post('add-event-members', 'UserController@addingEventMembers');
    Route::post('join-event', 'TimelineController@joiningEvent');
    Route::post('event-delete', 'TimelineController@deleteEvent');
    Route::post('notification-delete', 'TimelineController@deleteNotification');
    Route::post('allnotifications-delete', 'TimelineController@deleteAllNotifications');
    Route::post('post-hide', 'TimelineController@hidePost');
    Route::post('comment-hide', 'TimelineController@hideComment');
    Route::post('group-delete', 'TimelineController@deleteGroup');
    Route::post('media-edit', 'TimelineController@albumPhotoEdit');
    Route::post('unjoinPage', 'TimelineController@unjoinPage');
    Route::post('save-set-left-sidebar', 'UserController@saveSetLeftSidebar');
    Route::post('get-next-post-comments', 'TimelineController@getNextPostComments');
    Route::post('get-currency-transactions', 'WalletController@currencyTransactions');

    // Messenger: MessageController

    Route::post('post-message/{id}', 'MessageController@update');
    Route::post('delete-message/{id}', 'MessageController@deleteMessage');
    Route::post('get-conversation/{id}', 'MessageController@show');
    Route::post('get-foo', function () {                              //just for develop
        return response()->json(['status' => '200', 'unread_conversations' => Auth::user()->newThreadsCount()]);
    });
    Route::get('get-threads', 'MessageController@getThreads');
    Route::get('messenger/filter', 'MessageController@filter');
    Route::post('messenger/read-status/{id}', 'MessageController@readStatusMessage');
    Route::post('mark-readed-message', 'MessageController@markReadMessage');
    Route::post('thread/create-dialog', 'MessageController@createDialog');
    Route::post('thread/create-group', 'MessageController@createGroup');
    Route::post('thread/edit-group/{id}', 'MessageController@editGroup');
    Route::post('thread/add-participant/{id}', 'MessageController@addParticipant');
    Route::post('thread/rename-group/{id}', 'MessageController@renameGroup');
    Route::get('get-unread-threads', 'MessageController@getUnreadThreads');
    Route::get('get-contacts', 'MessageController@getContacts');

    Route::post('payment/transfer-to-another-user-by-id', 'PaymentController@transferToAnotherUserById');
    Route::post('payment/confirm-transfer-to-another-user-by-id', 'PaymentController@confirmTransferToAnotherUserById');
    Route::post('get-banners', 'AdvertisingController@getBanners');
});


/*
|--------------------------------------------------------------------------
| Image routes
|--------------------------------------------------------------------------
*/

Route::get('user/avatar/{filename}', function ($filename) {
    return Image::make(storage_path() . '/uploads/users/avatars/' . $filename)->response();
});

Route::get('user/cover/{filename}', function ($filename) {
    return Image::make(storage_path() . '/uploads/users/covers/' . $filename)->response();
});

Route::get('user/gallery/video/{filename}', function ($filename) {
    $fileContents = Storage::disk('uploads')->get("users/gallery/{$filename}");
    $response = Response::make($fileContents, 200);
    $response->header('Content-Type', 'video/mp4');

    return $response;
});

Route::get('user/gallery/{filename}', function ($filename) {
    return Image::make(storage_path() . '/uploads/users/gallery/' . $filename)->response();
});


Route::get('page/avatar/{filename}', function ($filename) {
    return Image::make(storage_path() . '/uploads/pages/avatars/' . $filename)->response();
});

Route::get('page/cover/{filename}', function ($filename) {
    return Image::make(storage_path() . '/uploads/pages/covers/' . $filename)->response();
});

Route::get('group/avatar/{filename}', function ($filename) {
    return Image::make(storage_path() . '/uploads/groups/avatars/' . $filename)->response();
});

Route::get('group/cover/{filename}', function ($filename) {
    return Image::make(storage_path() . '/uploads/groups/covers/' . $filename)->response();
});

Route::get('setting/{filename}', function ($filename) {
    return Image::make(storage_path() . '/uploads/settings/' . $filename)->response();
});

Route::get('event/cover/{filename}', function ($filename) {
    return Image::make(storage_path() . '/uploads/events/covers/' . $filename)->response();
});

Route::get('event/avatar/{filename}', function ($filename) {
    return Image::make(storage_path() . '/uploads/events/avatars/' . $filename)->response();
});

Route::get('/page/{pagename}', 'PageController@page');

Route::get('album/{username}/{y}/{m}/{d}/{h}/{min}/{filename}', function ($username, $y, $m, $d, $h, $min, $filename) {
    $path = implode('/', [$username, $y, $m, $d, $h, $min, $filename]);
    return Image::make(\Storage::disk('albums')->path($path))->response();
});

Route::get('wallpaper/{filename}', function ($filename) {
    return Image::make(storage_path() . '/uploads/wallpapers/' . $filename)->response();
});

Route::get('setlocale/{locale}', function ($locale) {
    if (array_key_exists($locale, \Config::get('app.locales'))) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
});
