<?php

namespace App\Providers;

use App\Setting;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Guard $auth)
    {
        Validator::extend('not_contains', function($attribute, $value, $parameters)
        {
            // Banned words
            $words = explode(",",Setting::get('censored_words'));
            foreach ($words as $word)
            {
                if (stripos($value, $word) !== false) return false;
            }
            return true;
        });

        Validator::extend('not_std_route', function($attribute, $value, $parameters)
        {
            return !in_array(strtolower($value),config('std_routers'));
        });
        

        if (env('APP_ENV', 'local') !== 'local') {
            DB::connection()->disableQueryLog();
        }

        if(Schema::hasTable('settings')) {
            App::setLocale(Setting::get('language', 'en'));    
        }
        else {
            App::setLocale('en');
        }
                
        if (Schema::hasTable('settings')) {
            Config::set('app.timezone', Setting::get('timezone', 'Europe/Kiev'));
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
    }
}
