<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserCredentials; // Añadir cuando lo creemos
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:gestionar usuarios')->except('index');
    // }

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
        $password = $request->input('password');
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'force_password_change' => true,
            'status' => $request->status ?? true, // Tomado del request, por defecto true
        ]);

        if ($request->has('role')) {
            $user->assignRole($request->role);
        }

        // Enviar correo con credenciales
        Mail::to($user->email)->send(new NewUserCredentials($user, $password, url('/login')));

        return response()->json(['success' => true, 'message' => 'Usuario creado. Credenciales enviadas.']);
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
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status, // Actualiza el estado
        ]);

        if ($request->has('role')) {
            $user->syncRoles([$request->role]);
        }

        return redirect()->route('users.index')->with('success', 'Usuario actualizado');
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
            Mail::to($user->email)->send(new NewUserCredentials($user, $request->password, $request->login_url));
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'error' => 'Usuario no encontrado.'], 404);
    }
}