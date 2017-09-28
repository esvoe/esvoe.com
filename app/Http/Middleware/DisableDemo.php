<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;

class DisableDemo
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
        if (Config::get('app.env') == 'demo') {
            Flash::error(trans('common.disabled_on_demo'));

            return Redirect::back();
        }

        return $next($request);
    }
}
