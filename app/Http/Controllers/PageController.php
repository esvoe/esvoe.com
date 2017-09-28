<?php

namespace App\Http\Controllers;

use App\Post;
use App\Setting;
use App\StaticPage;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Teepluss\Theme\Facades\Theme;
use Validator;

class PageController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->checkCensored();
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
    
    public function page($pagename)
    {
        $page = StaticPage::where('slug', $pagename)->first();

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('guest');
        $theme->setTitle($pagename.' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('pages/page', compact('page'))->render();
    }

    public function contact()
    {
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('guest');
        $theme->setTitle(trans('common.contact').' '.Setting::get('title_seperator').' '.Setting::get('site_title').' '.Setting::get('title_seperator').' '.Setting::get('site_tagline'));

        return $theme->scope('pages/contact')->render();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateContactPage(array $data)
    {
        return Validator::make($data, [
            'name'    => 'required',
            'email'   => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
    }

    public function saveContact(Request $request)
    {
        $validator = $this->validateContactPage($request->all());

        if ($validator->fails()) {
            return redirect()->back()
            ->withInput($request->all())
            ->withErrors($validator->errors());
        }

        $mail = $request->all();

        $emailStatus = Mail::send('emails.usermail', ['mail' => $mail], function ($m) use ($mail) {
            $m->from($mail['email'], Setting::get('site_name').' contact form');
            $m->to(Setting::get('support_email'))->subject(Setting::get('site_name').' support: '.$mail['subject']);
        });

        if ($emailStatus) {
            Flash::success('Thanks for contacting us! We will get back to you soon.');
        }

        return redirect()->back();
    }

    public function sharePost($post_id)
    {
        $post = Post::where('id', '=', $post_id)->first();

        //Redirect to home page if post doesn't exist
        if ($post == null) {
            return redirect('/');
        }
        $theme = Theme::uses('default')->layout('share');

        return $theme->scope('share-post', compact('post'))->render();
    }


    public function login_svoe()
    {
        return Theme::uses(Setting::get('current_theme', 'default'))->partial('login_svoe');
    }

    public function font()
    {

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');

        return $theme->scope('/font/index')->render();
    }


}
