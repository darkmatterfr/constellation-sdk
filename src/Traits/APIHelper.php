<?php

namespace Darkmatterfr\ConstellationSdk\Traits;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

trait APIHelper
{
    public function getConstellationAPIRequest(): PendingRequest
    {
        return Http::withHeaders([
            'project-key' => config('constellation.project-key'),
        ])
            ->baseUrl(config('constellation.api-url'));
    }
}
