<?php

namespace App\Services;

use App\Http\Resources\Orders\CreateResource;
use App\Models\Order;
use App\Models\Product;

class OrderService
{
    private $order;
    private $totalPrice;

    public function save($data): CreateResource
    {
        $this->storeOrder();

        foreach ($data['products'] as $productData) {
            $product = Product::find($productData['id']);
            if ($product->stock >= $productData['quantity']) {
                $this->totalPrice += $product->price;
                $this->order->products()->attach($product->id, ['quantity' => $productData['quantity']]);
                $product->decrement('stock', $productData['quantity']);
            }
        }

        $this->triggerSendMailEvent();

        return $this->order;
    }

    private function storeOrder(): void
    {
        $this->order = Order::create(['user_id' => auth()->id()]);
    }

    private function updateOrderTotalPrice(): void
    {
        $this->order->update(['total_price' => $this->totalPrice]);
    }

    private function triggerSendMailEvent(): void
    {
        /**
         * Here trigger an event for sending an email to the user who created the order
         * This mail will contain order details and products and total price
         * And provide a link to be able to download it
         */
    }
}
