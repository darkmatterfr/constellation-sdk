<?php

namespace Darkmatterfr\ConstellationSdk\Listeners;

use Illuminate\Queue\Events\JobExceptionOccurred;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\Facades\Log;

class UpdateConstellationJob
{

    public function handle(JobProcessed|JobFailed|JobExceptionOccurred $event): void
    {
        Log::log('info', 'Update job : ' . $event->job->resolveName());
    }
}
