<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si hay una sesión activa
        $userId = $request->session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        
        if ($userId) {
            // Obtener el usuario directamente desde la base de datos
            $user = User::find($userId);
            
            // Verificar si el usuario existe y está inactivo
            if (!$user || !$user->status) {
                // Limpiar completamente la sesión
                $this->destroySession($request);
                
                // Redirigir con mensaje de error
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Tu cuenta está inactiva. Contacta al administrador.',
                        'error' => 'account_inactive'
                    ], 401);
                }
                
                return redirect()->route('login')
                    ->withErrors(['email' => 'Tu cuenta está inactiva. Contacta al administrador del sistema.'])
                    ->with('status', 'Tu cuenta ha sido desactivada por un administrador.');
            }
        }

        return $next($request);
    }

    /**
     * Destruir completamente la sesión del usuario
     */
    private function destroySession(Request $request)
    {
        // Limpiar datos específicos de Laravel Auth
        $request->session()->forget('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        $request->session()->forget('password_hash_sanctum');
        $request->session()->forget('password_hash_web');
        
        // Limpiar toda la sesión
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Limpiar cookie de remember me
        $recallerName = 'remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d';
        Cookie::queue(Cookie::forget($recallerName));
        
        // También limpiar cualquier cookie de remember me que pueda existir
        if ($request->cookies->has($recallerName)) {
            setcookie($recallerName, '', time() - 3600, '/', '', false, true);
        }
    }
}