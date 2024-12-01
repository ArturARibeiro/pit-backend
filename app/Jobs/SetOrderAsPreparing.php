<?php

namespace App\Jobs;

use App\DTO\Notification;
use App\Enums\OrderStatusEnum;
use App\Events\NotificationSent;
use App\Events\OrderUpdated;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SetOrderAsPreparing implements ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /** @var Order[] $orders */
        $orders = Order::query()
            ->where('status', OrderStatusEnum::Pending->value)
            ->withoutGlobalScopes()
            ->get();

        foreach ($orders as $order) {
            $order->status = OrderStatusEnum::Preparing->value;
            $order->save();

            event(
                new OrderUpdated($order->id, $order),
                new NotificationSent(
                    userId: $order->user_id,
                    notification: Notification::create('Em preparo!', 'Estamos preparando o seu pedido.')
                )
            );
        }
    }
}
