<?php

namespace App\Http\Middleware;

use App\Timeline;
use Closure;
use Illuminate\Support\Facades\Auth;

class EditGroup
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
        $timeline = Timeline::where('username', $request->username)->first();

        $group = $timeline->groups()->first();

        if (!$group->is_admin(Auth::user()->id)) {
            return redirect($request->username);
        }


        return $next($request);
    }
}
