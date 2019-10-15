<?php

namespace App\Providers;

use App\Contracts\JobContract;
use App\Contracts\PermissionContract;
use App\Contracts\RaceContract;
use App\Contracts\UserContract;
use App\Repositories\Eloquent\JobRepository;
use App\Repositories\Eloquent\PermissionRepository;
use App\Repositories\Eloquent\RaceRepository;
use App\Repositories\Eloquent\UserRepository;
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
        $this->app->bind(JobContract::class, JobRepository::class);
        $this->app->bind(RaceContract::class, RaceRepository::class);
        $this->app->bind(UserContract::class, UserRepository::class);
    }
}
