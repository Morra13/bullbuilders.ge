<?php

namespace App\Http\Middleware;

use App\Http\Controllers\DefaultController;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

/**
 * Class Authenticate
 * @package App\Http\Middleware
 */
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
        if (! $request->expectsJson()) {
            return route(DefaultController::ROUTE_LOGIN);
        }
    }
}
