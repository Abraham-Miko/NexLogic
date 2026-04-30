<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Cek apakah role user ada di dalam daftar parameter yang diperbolehkan
        // Kita menggunakan Auth::user()->roles sesuai dengan struktur database kamu
        if (in_array(Auth::user()->roles, $roles)) {
            return $next($request);
        }

        // 3. Jika tidak punya akses, lempar ke 403
        abort(403, 'Maaf, role ' . Auth::user()->roles . ' tidak diizinkan mengakses halaman ini.');
    }
}
