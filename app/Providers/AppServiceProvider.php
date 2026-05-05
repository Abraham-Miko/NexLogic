<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
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
        | GATES — Otorisasi berdasarkan role
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

        // Gate: Guru atau Super Admin
        Gate::define('guru_or_admin', function (User $user) {
            return in_array($user->role, ['guru', 'super_admin']);
        });

        /*
        |------------------------------------------------------------------
        | MIDDLEWARE ALIAS — Daftarkan alias 'role' di bootstrap/app.php
        |------------------------------------------------------------------
        | Di Laravel 13, middleware alias didaftarkan di bootstrap/app.php.
        | Lihat file bootstrap/app.php di bawah untuk kode lengkapnya.
        */

        /*
        |------------------------------------------------------------------
        | RATE LIMITER
        |------------------------------------------------------------------
        */
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
