<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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

        // 1. Directive khusus untuk Super Admin saja
        Blade::if('superadmin', function () {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            return Auth::check() && $user->isSuperAdmin();
        });

        // 2. Directive fleksibel untuk berbagai role
        Blade::if('role', function ($role) {
            return Auth::check() && Auth::user()->role === $role;
        });
    }
}
