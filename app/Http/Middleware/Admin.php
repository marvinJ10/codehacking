<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //If the user is logged in
        if(Auth::check()){
            //if the user is an admin and is active
            if (Auth::user()->isAdmin()){
                return $next($request);
            }

        }
        // the user is not administrator and is not active
        return redirect('/home');
    }
}
