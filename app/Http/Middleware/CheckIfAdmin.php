<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfAdmin
{
    /**
     * Checks if the logged-in user is an administrator based on the role.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable|null $user
     * @return bool
     */
    private function checkIfUserIsAdmin($user)
    {
        return $user->role === 'admin';
    }

    /**
     * Responds to unauthorized access requests.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    private function respondToUnauthorizedRequest($request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        } else {
            return redirect('/dashboard'); // Redirect non-admin users to '/dashboard' or any desired route
        }
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (backpack_auth()->guest()) {
            return $this->respondToUnauthorizedRequest($request);
        }

        if (!$this->checkIfUserIsAdmin(backpack_user())) {
            return $this->respondToUnauthorizedRequest($request);
        }

        return $next($request);
    }
}
