<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = session('user');

        if (!$user) {

            return redirect('/login')->withErrors('Unauthorized. Please log in.');

//            view('error.401')abort(401, 'Unauthorized. Please log in.')->redirectTo('/login');
        }

        $userRole = $user['role_name'] ?? null;

        if (!$userRole || !in_array($userRole, $roles)) {
//            view('error.403')abort(403, 'Forbidden: You do not have access to this page.');
            return response()->view('error.403', [], 403);
        }

        return $next($request);
    }
}
