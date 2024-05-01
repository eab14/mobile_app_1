<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) return route('login');
        return response()->json(['message' => 'Unauthenticated. Please log in.'], 401);
    }
}