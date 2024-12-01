<?php

use App\Jobs\SetOrderAsPreparing;
use App\Jobs\SetOrderAsTransport;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new SetOrderAsTransport())->everyMinute();
Schedule::job(new SetOrderAsPreparing())->everyMinute();

Schedule::command('queue:work --stop-when-empty')
    ->everyMinute()
    ->withoutOverlapping();

Schedule::call(function () {
    event(new \App\Events\NotificationSent(2, \App\DTO\Notification::create('Ping', 'Pong')));
});
