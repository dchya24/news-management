<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomScopeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, $next, ...$scopes)
    {
        if (! $request->user() || ! $request->user()->token()) {
            return response()->json([
                'message' => "Unauthorized",
            ], 401);
        }

        foreach ($scopes as $scope) {
            if ($request->user()->tokenCan($scope)) {
                return $next($request);
            }
        }

        return response()->json([
            'message' => "Access Forbidden",
        ], 403);;
    }
}
