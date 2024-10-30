<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isGuest
{
    public function handle(Request $request, Closure $next): Response
    {
        // Memeriksa apakah pengguna sudah login
        if (auth()->check()) {
            // Jika sudah login, redirect ke halaman yang sesuai
            if (auth()->user()->role === 'admin') {
                return redirect()->route('landing_page_admin')->with('failed', 'Anda sudah login, anda tidak bisa masuk ke halaman login lagi!');
            }
            if (auth()->user()->role === 'siswa') {
                return redirect()->route('landing_page_siswa')->with('failed', 'Anda sudah login, anda tidak bisa masuk ke halaman login lagi!');
            }
        }

        // Jika belum login, teruskan permintaan
        return $next($request);
    }
}

