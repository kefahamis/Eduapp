<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        //
        Gate::define('is_admin', 'App\Policies\UsersPolicy@isAdmin');
        Gate::define('is_writer', 'App\Policies\UsersPolicy@isWriter');
        Gate::define('is_customer', 'App\Policies\UsersPolicy@isCustomer');
    }
}
