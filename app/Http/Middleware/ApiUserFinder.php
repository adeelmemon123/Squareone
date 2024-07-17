<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Http\Request;
use Closure;
use Config;

class ApiUserFinder
{
    public static function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        Config::set('user_id', $user->id);

        return $next($request);
    }
}