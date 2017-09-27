<?php

namespace App\Http\Middleware;

use App;
use Config;
use Session;
use Closure;

class Locale
{    
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {         
        if ($request->session()->has('locale')) {
            $raw_locale = Session::get('locale');
            
            if (array_key_exists($raw_locale, Config::get('app.locales'))) {
                $locale = $raw_locale;
            }
            else $locale = Config::get('app.locale_default');
        }
        else $locale = Config::get('app.locale_default');               

        App::setLocale($locale);
        Session::put('locale', $locale);

        return $next($request);                                     
    }
    
}    