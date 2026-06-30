<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // User must be logged in
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();

        // User must have a role assigned
        if (!$user->role) {
            abort(403, 'No role assigned.');
        }

        // Check if user's role is allowed
        if (!in_array($user->role->slug, $roles)) {
            abort(403, 'You are not authorized to access this page.');
        }

        return $next($request);
    }
}