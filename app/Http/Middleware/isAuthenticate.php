<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,...$roles)
    {
        for ($i=0; $i < count($roles); $i++) { 
            if(!$request->user() || $request->user()->role == $roles[$i]){
                return $next($request);
            }
        }

        return redirect('/error-404');
}
}                         