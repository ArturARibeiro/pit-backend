<?php

namespace App\Listeners;

use App\Events\NotificationSent;
use Illuminate\Support\Facades\Cache;

class NotificationSentListener
{
    /**
     * Handle the event.
     */
    public function handle(NotificationSent $event): void
    {
        $cacheKey = "sse:$event->userId";
        $data = Cache::get($cacheKey, []);
        $data[] = [
            'event' => 'notification',
            'data' => $event->notification,
        ];

        Cache::put($cacheKey, $data, now()->addMinutes(5));
    }
}
