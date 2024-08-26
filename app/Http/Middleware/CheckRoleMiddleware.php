<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Ensure the user is logged in
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Check if the user's role matches any of the allowed roles
        foreach ($roles as $role) {
            if (Auth::user()->hasRole($role)) {
                return $next($request);
            }
        }
        
         // Flash a session message to alert the user they don't have access
        session()->flash('error', 'You do not have permission to access this page.');
        // Redirect users based on their role to specific dashboards
        return $this->redirectUserBasedOnRole();
    }

    protected function redirectUserBasedOnRole()
    {
        $role = Auth::user()->role;  // Get the current user role
        if ($role === 'owner') {
            return redirect('/admin/owner-dashboard');
        } elseif ($role === 'dapur') {
            return redirect('/admin/dashboard');
        } elseif ($role === 'kasir') {
            return redirect('/admin/kasir-dashboard');
        }

        // Default redirect if no specific role dashboard exists
        return redirect('/login');
    }
}
