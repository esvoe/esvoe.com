<?php

use App\Setting;
use App\Timeline;
use App\User;
use Illuminate\Database\Seeder;

class InstallerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Create admin account
        $account = Timeline::firstOrNew(['username' => 'bootstrapguru']);
        $account->username = 'bootstrapguru';
        $account->name = 'Admin';
        $account->about = 'Some text about me';
        $account->type = 'user';
        $account->save();

        $user = User::create([
            'timeline_id'       => 1,
            'email'             => 'admin@socialite.com',
            'verification_code' => str_random(18),
            'remember_token'    => str_random(10),
            'password'          => Hash::make('socialite'),
            'city'              => 'Hyderabad',
            'country'           => 'India',
            'gender'            => 'male',
            'email_verified'    => 1,
        ]);

        $user_settings = [
            'user_id'               => $user->id,
            'confirm_follow'        => 'no',
            'follow_privacy'        => 'everyone',
            'comment_privacy'       => 'everyone',
            'timeline_post_privacy' => 'everyone',
            'message_privacy'       => 'everyone',
            'post_privacy'          => 'everyone', ];

        $userSettings = DB::table('user_settings')->insert($user_settings);

        $user->roles()->attach(1);

        //Create default website settings

        $settings = ['comment_privacy'                => 'everyone',
                        'confirm_follow'              => 'no',
                        'follow_privacy'              => 'everyone',
                        'user_timeline_post_privacy'  => 'everyone',
                        'post_privacy'                => 'everyone',
                        'page_message_privacy'        => 'everyone',
                        'page_timeline_post_privacy'  => 'everyone',
                        'page_member_privacy'         => 'only_admins',
                        'member_privacy'              => 'only_admins',
                        'group_timeline_post_privacy' => 'members',
                        'group_member_privacy'        => 'only_admins',
                        'site_name'                   => 'Socialite',
                        'site_title'                  => 'Socialite',
                        'site_url'                    => 'socialite.dev',
                        'twitter_link'                => 'http://twitter.com/',
                        'facebook_link'               => 'http://facebook.com/',
                        'youtube_link'                => 'http://youtube.com/',
                        'support_email'               => 'admin@socialite.com',
                        'mail_verification'           => 'off',
                        'captcha'                     => 'off',
                        'censored_words'              => '',
                        'birthday'                    => 'off',
                        'city'                        => 'off',
                        'about'                       => 'Socialite is the FIRST Social networking script developed on Laravel with all enhanced features, Pixel perfect design and extremely user friendly. User interface and user experience are extra added features to Socialite. Months of research, passion and hard work had made the Socialite more flexible, feature-available and very user friendly!',
                        'contact_text'                => 'Contact page description can be here',
                        'address_on_mail'             => 'Socialite,<br> Socialite street,<br> India',
                        'items_page'                  => '10',
                        'min_items_page'              => '5',
                        'user_message_privacy'        => 'everyone',
                        'group_event_privacy'         => 'only_admins',
                        'footer_languages'            => 'on',
                        'linkedin_link'               => 'http://linkedin.com/',
                        'instagram_link'              => 'http://instagram.com/',
                        'dribbble_link'               => 'http://dribbble.com/',
                        ];

        foreach ($settings as $key => $value) {
            $settings = Setting::firstOrNew(['key' => $key, 'value' => $value]);
            $settings->save();
        }
    }
}
