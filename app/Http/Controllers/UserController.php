<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserCredentials; // Añadir cuando lo creemos
use Illuminate\Support\Str;

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
        $password = Str::random(12); // Genera contraseña inicial
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'force_password_change' => true,
            'status' => $request->status, // Tomado del request, por defecto true
        ]);

        if ($request->has('role')) {
            $user->assignRole($request->role);
        }

        // Preparar envío de correo (completar cuando creemos el Mailable)
        // Mail::to($user->email)->send(new NewUserCredentials($user, $password));

        return redirect()->route('users.index')->with('success', 'Usuario creado. Contraseña inicial: ' . $password);
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
}