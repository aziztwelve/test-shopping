<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrder;
use App\Jobs\SentOrderNotify;
use App\Order;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Event;

class OrderController extends Controller
{
    public function store(StoreOrder $request)
    {

        $carts = Cart::instance('default')->content();
        $order = Order::create($request->all());
        $product_ids = [];
        foreach ($carts as $cart){
            $order->products()->attach($cart->id, ['quantity' => $cart->qty]);
            array_push($product_ids, $cart->id);
        }
        $products = Product::findMany($product_ids);

        SentOrderNotify::dispatch($order, $products)->delay(now()->addSeconds(30));

        Event::dispatch('cart.destroy');
        return redirect('/')->with('success', 'Order created');
    }
}
