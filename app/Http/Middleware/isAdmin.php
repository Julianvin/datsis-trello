<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);
        }
        // Redirect ke halaman error jika bukan admin
        return redirect()->route('error')->with('message', 'Anda tidak memiliki akses ke halaman ini!');
    }
}
