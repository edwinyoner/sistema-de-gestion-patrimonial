<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserCredentials;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $email = 'edwinyoner@winner-systems.com';
        $password = Str::random(12);
        $hashedPassword = Hash::make($password);

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => 'Administrador',
                'email' => $email,
                'password' => $hashedPassword,
                //'force_password_change' => true,
                'status' => true,
            ]
        );

        $user->assignRole('Admin'); // Asigna el rol Admin

        Mail::to($user->email)->send(new NewUserCredentials($user, $password, url('/login')));
        $user->sendEmailVerificationNotification();
    }
}
