<?php

namespace App\Listeners;

use App\Events\OrderUpdated;
use Illuminate\Support\Facades\Cache;

class OrderUpdatedListener
{
    /**
     * Handle the event.
     */
    public function handle(OrderUpdated $event): void
    {
        $cacheKey = "sse:$event->userId";
        $data = Cache::get($cacheKey, []);
        $data[] = [
            'event' => 'order:updated',
            'data' => $event->order
        ];

        Cache::put($cacheKey, $data, now()->addMinutes(5));
    }
}
