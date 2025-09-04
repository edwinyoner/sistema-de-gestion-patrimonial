<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
    
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        if (auth()->check() && !auth()->user()->status) {
            auth()->logout();
            return redirect('/login')->withErrors(['email' => 'Tu cuenta está inactiva.']);
        }

        return $next($request);
    }

}
