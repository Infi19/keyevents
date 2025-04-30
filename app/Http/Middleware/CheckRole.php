<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string|array  $roles  The role(s) that can access the route
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if the user is logged in
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // If no roles are specified, continue
        if (empty($roles)) {
            return $next($request);
        }

        // Check if the user has one of the required roles
        foreach ($roles as $role) {
            if ($request->user()->role === $role) {
                return $next($request);
            }
        }

        // Redirect based on the user's role instead of a 403 error
        $userRole = $request->user()->role;
        
        if ($userRole === 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('error', 'You do not have permission to access that page.');
        } else if ($userRole === 'organizer') {
            return redirect()->route('dashboard')
                ->with('error', 'You do not have permission to access that page.');
        } else {
            return redirect()->route('stud.dashboard')
                ->with('error', 'You do not have permission to access that page.');
        }
    }
}
