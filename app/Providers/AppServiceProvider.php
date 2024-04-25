<?php

namespace App\Providers;

use App\Enums\RoleEnum;
use App\Policies\RolePolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;

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
        Model::unguard();

        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole(RoleEnum::admin->value) ? true : null;
        });

        Gate::policy(Role::class, RolePolicy::class);

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
