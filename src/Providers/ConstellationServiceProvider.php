<?php
namespace Darkmatterfr\ConstellationSdk\Providers;

use Illuminate\Support\ServiceProvider;

class ConstellationServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/constellation.php', 'constellation'
        );

        $this->app->register(EventServiceProvider::class);
    }
}
