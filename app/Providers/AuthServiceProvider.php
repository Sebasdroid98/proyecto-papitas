<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('ver-empleados', function () {
            $rolUser = Auth::user()->rol;
            return $rolUser == '1';
        });

        Gate::define('crear-tarea', function () {
            $rolUser = Auth::user()->rol;
            return $rolUser == '1';
        });
    }
}
