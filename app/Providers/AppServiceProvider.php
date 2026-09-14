<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();

        /*
        |------------------------------------------------------------------
        | BLADE DIRECTIVES — Untuk UI/Tampilan
        |------------------------------------------------------------------
        */

        // Directive khusus untuk Super Admin saja
        Blade::if('superadmin', function () {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            // Menggunakan pengecekan role string agar konsisten dengan Gate di bawah
            return Auth::check() && $user->role === 'super_admin';
        });

        // Directive fleksibel untuk berbagai role (misal: @role('guru'))
        Blade::if('role', function ($role) {
            return Auth::check() && Auth::user()->role === $role;
        });

        /*
        |------------------------------------------------------------------
        | GATES — Otorisasi Logic (Controller & Middleware)
        |------------------------------------------------------------------
        */

        // Gate: Hanya super_admin
        Gate::define('super_admin', function (User $user) {
            return $user->role === 'super_admin';
        });

        // Gate: Hanya guru
        Gate::define('guru', function (User $user) {
            return $user->role === 'guru';
        });

        // Gate: Hanya siswa
        Gate::define('siswa', function (User $user) {
            return $user->role === 'siswa';
        });

        // Gate: Guru atau Super Admin (Akses Dashboard Manajemen)
        Gate::define('guru_or_admin', function (User $user) {
            return in_array($user->role, ['guru', 'super_admin']);
        });

        /*
        |------------------------------------------------------------------
        | RATE LIMITER — Keamanan API
        |------------------------------------------------------------------
        */
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
