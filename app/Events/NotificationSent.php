<?php

namespace App\Events;

use App\DTO\Notification;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public int $userId, public Notification $notification)
    {
        //
    }
}
