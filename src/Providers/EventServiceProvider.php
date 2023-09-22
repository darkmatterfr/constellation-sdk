<?php

namespace Darkmatterfr\ConstellationSdk\Providers;

use Darkmatterfr\ConstellationSdk\Listeners\CreateConstellationJob;
use Darkmatterfr\ConstellationSdk\Listeners\UpdateConstellationJob;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Queue\Events\JobExceptionOccurred;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        JobProcessing::class => [
            CreateConstellationJob::class,
        ],
        JobProcessed::class => [
            UpdateConstellationJob::class,
        ],
        JobFailed::class => [
            UpdateConstellationJob::class,
        ],
        JobExceptionOccurred::class => [
            UpdateConstellationJob::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        parent::boot();
    }
}
