<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        //Check if the user is authenticated
        if(Auth()->check())
        {
            return $next($request); 
        }else{
            return redirect(route('login'));
        }


        //Check if the user is admin
        if(Auth()->user()->admin == 1){
            return $next($request);
        }else{
            abort(403);
        }
    }
}
