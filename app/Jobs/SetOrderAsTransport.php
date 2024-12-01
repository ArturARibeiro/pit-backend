<?php

namespace App\Jobs;

use App\DTO\Notification;
use App\Enums\OrderStatusEnum;
use App\Events\NotificationSent;
use App\Events\OrderUpdated;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SetOrderAsTransport implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /** @var Order[] $orders */
        $orders = Order::query()
            ->where('status', OrderStatusEnum::Preparing->value)
            ->withoutGlobalScopes()
            ->get();

        foreach ($orders as $order) {
            $order->status = OrderStatusEnum::Transport->value;
            $order->save();

            event(new OrderUpdated($order->user_id, $order));
            event(new NotificationSent(
                userId: $order->user_id,
                notification: Notification::create('Em transporte!', 'Seu pedido está a caminho.')
            ));
        }
    }
}
