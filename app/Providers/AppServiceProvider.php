<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade; // ✅ Tambahkan ini

use App\Models\User;

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

        Gate::define('admin', function (User $user) {
            return $user->is_admin == true;
        });

        // 🔧 Ini untuk komponen tanpa class (anonymous component)
        Blade::anonymousComponentPath(resource_path('views/layouts'), 'layouts');
    }

}
