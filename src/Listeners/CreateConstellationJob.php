<?php

namespace Darkmatterfr\ConstellationSdk\Listeners;

use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Log;

class CreateConstellationJob
{

    public function handle(JobProcessing $event): void
    {
        Log::log('info', 'Create job : ' . $event->job->resolveName());
    }

}
