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
            /** @var Product $product */
            $product = Product::query()->find($request->get('product_id'));

            if (!$product) {
                throw new BadRequestHttpException('Product not found');
            }

            $order = new Order();
            $order->date = Carbon::now();
            $order->status = OrderStatusEnum::Pending;
            $order->save();

            $items = $request->get('items', []);
            foreach ($items as $item) {
                $orderItem = new OrderItem();
                $orderItem->product_id = $item['product_id'];
                $orderItem->quantity = $item['quantity'];
                $orderItem->price = $item['amount'];

                $order->items()->save(new OrderItem($item));
            }
        });

        return new OrderResource($order);
    }

    public function show(Order $order): OrderResource
    {
        return new OrderResource($order);
    }

    public function rate(OrderRateRequest $request, Order $order): OrderResource
    {
        $order->update([
            'rate' => $request->get('rate'),
            'review' => $request->get('review'),
        ]);

        return new OrderResource($order);
    }
}
