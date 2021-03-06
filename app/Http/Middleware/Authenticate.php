<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if(strpos($request->path(),'admin') === 0){
            $loginRoute = route('a.login');
        }else{
            $loginRoute = route('login');
        }
        if (! $request->expectsJson()) {
            return $loginRoute;
        }
    }
}
