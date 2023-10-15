<?php

namespace Darkmatterfr\ConstellationSdk\Listeners;

use Darkmatterfr\ConstellationSdk\Traits\APIHelper;
use Illuminate\Queue\Events\JobProcessing;

class CreateConstellationJob
{
    use APIHelper;

    public function handle(JobProcessing $event): void
    {
        $this->getConstellationAPIRequest()
            ->post('/job', [
                'new' => true,
                'job_id' => $event->job->getJobId(),
                'name' => $event->job->resolveName(),
                'queue' => $event->job->getQueue(),
                'failed' => $event->job->hasFailed(),
                'env' => app()->environment(),
                'exception_message' => null,
                'started_at' => now(),
                'attempt' => $event->job->attempts(),
                'progress' => 0,
            ]);
    }
}
