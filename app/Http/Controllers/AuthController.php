<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Pastikan import model User yang benar
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect('/')->with('success', 'Login berhasil!');
        } else {
            return redirect()->back()->with('error', 'Username atau password salah');
        }
    }

    public function register(Request $request)
    {
        try{
            $request->validate([
                'email' => 'required|email|unique:users,email',
                'username' => 'required|unique:users,username',
                'password' => 'required|min:6', // Tambah confirmed
            ]);
        
            User::create([
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => 'karyawan' // Set default role
            ]);

            return redirect()->back()->with('success', 'Registration successful! You can now log in.');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Registration failed: '.$e->getMessage());
        }
    }
}
