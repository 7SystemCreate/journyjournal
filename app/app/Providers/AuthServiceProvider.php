<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('general', function ($user) {
            return ($user->role == 0 );
        });
        Gate::define('inn', function ($user) {
            return ($user->role == 1 );
        });
        Gate::define('admin', function ($user) {
            return ($user->role == 2 );
        });
    }
}
