<?php

namespace Darkmatterfr\ConstellationSdk\Listeners;

use Darkmatterfr\ConstellationSdk\Traits\APIHelper;
use Illuminate\Queue\Events\JobExceptionOccurred;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;

class UpdateConstellationJob
{
    use APIHelper;

    public function handle(JobProcessed|JobFailed|JobExceptionOccurred $event): void
    {
        $this->getConstellationAPIRequest()
            ->post('/job', [
                'new' => false,
                'job_id' => $event->job->getJobId(),
                'name' => $event->job->resolveName(),
                'queue' => $event->job->getQueue(),
                'failed' => $event->job->hasFailed(),
                'started_at' => now(),
                'env' => app()->environment(),
                'exception_message' => property_exists($event, 'exception') ?
                    mb_strcut($event->exception->getMessage(), 0, 65535)
                    : null,
                'attempt' => $event->job->attempts(),
                'progress' => 0,
            ]);
    }
}
