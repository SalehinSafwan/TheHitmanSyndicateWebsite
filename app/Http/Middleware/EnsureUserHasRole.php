<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * This middleware verifies that the user resolved from the session context (by the 'auth' middleware)
     * possesses at least one of the specified roles. If no user is authenticated or they lack roles, 
     * a 403 Forbidden response is thrown.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Retrieves the currently authenticated user from the active session guard (web).
        $user = $request->user();

        if (! $user || ! $user->hasAnyRole($roles)) {
            abort(403);
        }

        return $next($request);
    }
}