<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // 1. Cek apakah user sudah login
        if (!$request->user()) {
            // Jika fitur puzzle diakses via API/AJAX
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }

            // Jika belum login, lempar ke halaman login
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // 2. Cek apakah role user ada di dalam daftar role yang diizinkan
        if (!in_array($request->user()->role, $roles)) {
            // Jika fitur puzzle diakses via API/AJAX
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Akses Ditolak.'], 403);
            }

            // Jika gagal akses Dashboard ATAU gagal akses Puzzle (Web biasa)
            return redirect('/dashboard')->with('error', 'Akses ditolak. Anda tidak memiliki izin untuk halaman atau fitur ini.');
        }

        return $next($request);
    }
}
