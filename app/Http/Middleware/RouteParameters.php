<?php

namespace App\Http\Middleware;

use Closure;

class RouteParameters
{
    public function handle($request, Closure $next)
    {
        // Retrieve all route parameters
        $routeParams = $request->route()->parameters();

        // Add route parameters to the request
        foreach ($routeParams as $key => $value) {
            $request->merge([$key => $value]);
        }

        // Proceed with the request
        return $next($request);
    }
}
