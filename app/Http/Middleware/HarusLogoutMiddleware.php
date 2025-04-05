<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class HarusLogoutMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // Jika user sudah login, redirect ke halaman dashboard
            return redirect('/')->with('error', 'Anda sudah login ke salah satu akun, Logout terlebih dahulu.');
        }

        return $next($request);
    }
}
