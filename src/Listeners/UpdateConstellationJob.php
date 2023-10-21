<?php

namespace Darkmatterfr\ConstellationSdk\Listeners;

use Darkmatterfr\ConstellationSdk\Traits\APIHelper;
use Illuminate\Queue\Events\JobExceptionOccurred;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\Str;

class UpdateConstellationJob
{
    use APIHelper;

    public function handle(JobProcessed|JobFailed|JobExceptionOccurred $event): void
    {
        $message = null;
        if (property_exists($event, 'exception')) {
            $message = $event->exception->getMessage().' in '.$event->exception->getFile().':'.$event->exception->getLine();
        }

        $this->getConstellationAPIRequest()
            ->post('/job', [
                'new' => false,
                'job_id' => $event->job->getJobId(),
                'name' => $event->job->resolveName(),
                'queue' => $event->job->getQueue(),
                'failed' => $event->job->hasFailed(),
                'started_at' => now(),
                'env' => app()->environment(),
                'exception_message' => $message,
                'exception_trace' => property_exists($event, 'exception') ?
                    Str::substr($event->exception->getTraceAsString(), 0, 65535)
                    : null,
                'exception_type' => property_exists($event, 'exception') ?
                    get_class($event->exception)
                    : null,
                'attempt' => $event->job->attempts(),
                'progress' => 0,
            ]);
    }
}
