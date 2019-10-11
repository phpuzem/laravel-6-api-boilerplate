<?php

namespace App\Providers;

use App\Contracts\PermissionContract;
use App\Repositories\Eloquent\PermissionRepository;
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
    }
}
