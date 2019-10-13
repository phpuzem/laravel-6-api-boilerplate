<?php

namespace App\Providers;

use App\Contracts\{PermissionContract, RoleContract};
use App\Repositories\Eloquent\{PermissionRepository, RoleRepository};
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(PermissionContract::class, PermissionRepository::class);
        $this->app->bind(RoleContract::class, RoleRepository::class);

    }
}
