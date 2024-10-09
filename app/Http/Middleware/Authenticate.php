<?php

namespace App\Http\Middleware;
use App\Http\Controllers\LogsController;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {


        }
        // View::share('role_set', $role_set);
        return $request->expectsJson() ? null : route('backendLogin');
    }
}
