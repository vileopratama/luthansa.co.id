<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Redirect;
use Request;

class Permission {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if(!Auth::check()) {
            return Redirect::intended ( '/session/login');
        }
        return $next($request);
    }
}
