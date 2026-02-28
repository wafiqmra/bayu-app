<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        dd(config('services.google.client_id'));
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            
            // Cek apakah user sudah ada di database berdasarkan email
            $finduser = User::where('email', $user->email)->first();

            if($finduser){
                Auth::login($finduser);
            } else {
                // Kalau belum ada, buat user baru
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => Hash::make(Str::random(16)), // Password random biar aman
                ]);

                Auth::login($newUser);
            }

            return redirect()->intended('dashboard');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Waduh, gagal login pake Google nih!');
        }
    }
}