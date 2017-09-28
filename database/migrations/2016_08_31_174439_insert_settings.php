<?php

use App\Setting;
use Illuminate\Database\Migrations\Migration;

class InsertSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $settings = ['noreply_email'                  => 'noreply@socialite.com',
                        'language'                    => 'en',
                        'logo'                        => 'logo.jpg',
                        'favicon'                     => 'favicon.jpg',
                        'enable_browse'               => 'on',
                        'meta_description'            => 'Socialite is the FIRST Social networking script developed on Laravel with all enhanced features, Pixel perfect design and extremely user friendly. User interface and user experience are extra added features to Socialite. Months of research, passion and hard work had made the Socialite more flexible, feature-available and very user friendly!',
                        'meta_keywords'               => 'facebook clone, laravel, live chat, message, news feed, php social network, php social platform, php socialite, post, social, social network, social networking, social platform, social script, socialite',
                            ];

        foreach ($settings as $key => $value) {
            $settings = Setting::firstOrCreate(['key' => $key, 'value' => $value]);
            $settings->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
