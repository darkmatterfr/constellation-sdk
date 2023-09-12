<?php

namespace Darkmatterfr\ConstellationSdk\Listeners;

use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CreateConstellationJob
{

    public function handle(JobProcessing $event): void
    {
        Http::withHeaders([
            'project-key' => config('constellation.project-key')
        ])
        ->post('http://constellation.test/api/job', [
            'new' => true,
            'job_id' => $event->job->getJobId(),
            'name' => $event->job->getName(),
            'queue' => $event->job->getQueue(),
            'started_at' => now(),
            'attempt' => $event->job->attempts(),
            'progress' => 0,
        ]);
    }

}
