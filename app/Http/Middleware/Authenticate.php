<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        // Verificar si el usuario está autenticado
        if (auth()->check()) {
            $user = auth()->user();

            // // Verificar si la cuenta está inactiva
            // if (!$user->status) {
            //     auth()->logout();
            //     return redirect('/login')->withErrors(['email' => 'Tu cuenta está inactiva.']);
            // }
        }

        return $next($request);
    }
}