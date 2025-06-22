<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
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
        Gate::define('create-todo', function (User $user) {
            return $user->role_id === 2;
        });

        Gate::define('update-todo', function (User $user) {
            return $user->role_id === 3;
        });

        Gate::define('delete-todo', function (User $user) {
            return $user->role_id === 1;
        });
    }
}
