<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Jika belum login atau role tidak sesuai, lempar ke dashboard user atau 403
        if (!$request->user() || $request->user()->role !== $role) {
            return redirect('/dashboard')->with('error', 'Akses ditolak.');
        }

        return $next($request);
    }
}
