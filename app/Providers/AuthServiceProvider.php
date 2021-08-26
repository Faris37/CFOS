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

        Gate::define('manage.users',function($user){
            return $user->hasRoles('admin');
        });

        Gate::define('parent.users',function($user){
            return $user->hasRoles('parent');
        });

        Gate::define('edit.users',function($user){
            return $user->hasRoles('admin');
        });

        Gate::define('delete.users',function($user){
            return $user->hasRoles('admin');
        });

        Gate::define('edit.canteen' , function($user)
        {
            return $user->hasRoles('Canteen Admin');
        });

        Gate::define('teacher.users' , function($user)
        {
            return $user->hasRoles('teacher');
        });

        Gate::define('School.Admin', function($user)
        {
            return $user->hasRoles('School Admin');
        });
    }
}
