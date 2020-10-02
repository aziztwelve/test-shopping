<?php

namespace App\Providers;

use App\Notifications\OrderCreated;
use App\Notifications\OrderCreatedNotifyClient;
use App\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Event::listen('cart.delete.match.id', function ($id) {
            $cart = Cart::instance('default')->content();
            $cart->search(function ($cartItem, $rowId) use ($id) {
                if ($cartItem->id === (int)$id){
                    Cart::remove($rowId);
                }
            });
        });
        Event::listen('cart.delete.id', function ($id) {
            Cart::remove($id);
        });
        Event::listen('cart.destroy', function () {
            Cart::destroy();
        });
        Event::listen('cart.add', function ($id, $name) {
            Cart::add($id, $name, 1, 0);
        });


        Event::listen('notify.order.created', function (Order $order, Collection $product) {
            Notification::route('mail' , $order->email)->notify(new OrderCreatedNotifyClient($order, $product));
            Notification::route('mail' , 'warehouse@example.com')->notify(new OrderCreated($order, $product));
        });


        Event::listen('before.add.cart', function () {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://freegeoip.app/json/",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "accept: application/json",
                    "content-type: application/json"
                ),
            ));

            $response = curl_exec($curl);
            $encode_json = json_decode($response);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return  $err;
            }
            return $encode_json;

        });
    }
}
