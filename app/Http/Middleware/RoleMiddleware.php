<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek apakah user sudah login dan rolenya sesuai dengan yang diizinkan di route
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // Jika tidak sesuai, tendang balik ke halaman utama atau tampilkan 403
        abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}