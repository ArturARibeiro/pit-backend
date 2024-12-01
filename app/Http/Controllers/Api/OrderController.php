<?php

namespace App\Http\Controllers\Api;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRateRequest;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class OrderController extends Controller
{
    public function index(): OrderCollection
    {
        return new OrderCollection(Order::all());
    }

    public function store(OrderStoreRequest $request): OrderResource
    {
        $order = DB::transaction(function () use ($request) {
            $order = new Order();
            $order->date = Carbon::now();
            $order->status = OrderStatusEnum::Pending;
            $order->user_id = $request->user()->id;
            $order->address_id = $request->input('address_id');
            $order->card_id = $request->input('card_id');
            $order->save();

            $items = $request->get('items', []);
            foreach ($items as $item) {
                /** @var Product $product */
                $product = Product::query()->find($item['product_id']);

                if (!$product) {
                    throw new BadRequestHttpException('Product not found');
                }

                $orderItem = new OrderItem();
                $orderItem->product_id = $item['product_id'];
                $orderItem->quantity = $item['quantity'];
                $orderItem->amount = $item['amount'];

                $order->items()->save(new OrderItem($item));
            }

            return $order;
        });

        return new OrderResource($order);
    }

    public function show(Order $order): OrderResource
    {
        return new OrderResource($order);
    }

    public function rate(OrderRateRequest $request, Order $order): OrderResource
    {
        $order->rate = $request->input('rate');
        $order->review = $request->input('review');
        $order->save();

        return new OrderResource($order);
    }

    public function finish(Order $order): OrderResource
    {
        $order->status = OrderStatusEnum::Concluded->value;
        $order->save();

        return new OrderResource($order);
    }

    public function cancel(Order $order): OrderResource
    {
        $order->status = OrderStatusEnum::Cancelled->value;
        $order->save();

        return new OrderResource($order);
    }
}
