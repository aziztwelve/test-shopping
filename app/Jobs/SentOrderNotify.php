<?php

namespace App\Jobs;

use App\Order;
use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;

class SentOrderNotify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Order
     */
    private $order;
    /**
     * @var Product
     */
    private $product;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order, Collection $product)
    {
        //
        $this->order = $order;
        $this->product = $product;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Event::dispatch('notify.order.created', [$this->order, $this->product] );
    }
}
