<?php

namespace App\Providers;

use App\Contracts\CharacterContract;
use App\Observers\CharacterObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
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
        $repo     = app(CharacterContract::class);
        $observer = CharacterObserver::class;
        $repo->observe($observer);
    }
}
