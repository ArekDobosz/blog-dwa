<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::guard('user')->user();

        if (!$user) {
            return redirect('/');
        }
        if ($user->role === 'role_admin') {
            return $next($request);
        }
        return redirect('/');
    }
}
