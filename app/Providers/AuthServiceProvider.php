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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('administrator-access', function ($user) {
            return count(array_intersect(['ADMIN'], json_decode($user->roles)));
        });

        Gate::define('staff-access', function ($user) {
            return count(array_intersect(['ADMIN', 'STAFF'], json_decode($user->roles)));
        });

        Gate::define('login-access', function ($user) {
            return count(array_intersect(['ADMIN', 'STAFF'], json_decode($user->roles)));
        });
    }
}
