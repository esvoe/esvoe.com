<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EditOwn
{
    /**
      * Handle an incoming request.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  \Closure  $next
      *
      * @return mixed
      */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->username != $request->username) {
            return redirect($request->username);
        }

        return $next($request);
    }
}
