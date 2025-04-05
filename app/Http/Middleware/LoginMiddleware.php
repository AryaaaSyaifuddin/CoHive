<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LoginMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            // Jika pengguna belum login, arahkan ke halaman beranda dengan notifikasi
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        return $next($request);
    }
}
