<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:ver usuarios')->only('index', 'show');
        $this->middleware('can:crear usuarios')->only('create', 'store');
        $this->middleware('can:actualizar usuarios')->only('edit', 'update');
        $this->middleware('can:eliminar usuarios')->only('destroy');
    }

    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        try {
            $password = $request->input('password');
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($password),
                'status' => $request->status ?? true,
                'email_verified_at' => null, // Importante: no verificado inicialmente
            ]);

            if ($request->has('role')) {
                $user->assignRole($request->role);
            }

            return response()->json(['success' => true, 'message' => 'Usuario creado correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al crear el usuario.'], 500);
        }
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(UserRequest $request, User $user)
    {
        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'status' => $request->status,
            ]);

            if ($request->has('role')) {
                $user->syncRoles([$request->role]);
            }

            // Si es una petición AJAX, devolver JSON
            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Usuario actualizado correctamente']);
            }

            return redirect()->route('users.index')->with('success', 'Usuario actualizado');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Error al actualizar el usuario'], 500);
            }
            
            return redirect()->back()->with('error', 'Error al actualizar el usuario');
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado');
    }

    public function sendCredentials(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'login_url' => 'required|url',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            // Generar URL de verificación de email
            $verificationUrl = $this->generateVerificationUrl($user);
            
            // Enviar el correo unificado (credenciales + verificación)
            \Illuminate\Support\Facades\Mail::to($user->email)->send(
                new \App\Mail\NewUserCredentials($user, $request->password, $request->login_url, $verificationUrl)
            );

            return response()->json(['success' => true, 'message' => 'Credenciales enviadas con éxito']);
        }

        return response()->json(['success' => false, 'error' => 'Usuario no encontrado.'], 404);
    }

    public function updatePasswordAndSend(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'login_url' => 'required|url',
        ]);

        try {
            $user = User::findOrFail($request->user_id);
            
            // Actualizar la contraseña del usuario
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            // Generar URL de verificación de email
            $verificationUrl = $this->generateVerificationUrl($user);

            // Enviar el correo unificado (credenciales + verificación)
            \Illuminate\Support\Facades\Mail::to($user->email)->send(
                new \App\Mail\NewUserCredentials($user, $request->password, $request->login_url, $verificationUrl)
            );

            return response()->json([
                'success' => true, 
                'message' => 'Contraseña actualizada y credenciales enviadas con éxito'
            ]);
        } catch (\Exception $e) {
            Log::error('Error en updatePasswordAndSend: ' . $e->getMessage());
            return response()->json([
                'success' => false, 
                'error' => 'Error al actualizar contraseña y enviar credenciales: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generar URL de verificación de email para el usuario
     */
    private function generateVerificationUrl(User $user)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60), // Expira en 60 minutos
            [
                'id' => $user->getKey(),
                'hash' => sha1($user->getEmailForVerification()),
            ]
        );
    }
}