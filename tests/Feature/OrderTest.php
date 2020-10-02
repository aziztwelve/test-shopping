<?php

namespace Tests\Feature;

use App\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /** @test  */
    public function an_order_can_give_all_data()
    {
        $order = Order::all();
        $this->assertInstanceOf(Collection::class, $order);
    }

    /** @test  */
    public function an_order_can_be_created()
    {

        $response = $this->post('/order',[
            'email' => 'new email',
            'phone' => 'new phone',
            'shipping_address_1' => 'new shipping_address_1',
            'city' => 'new city',
        ]);
        $response->assertStatus(302);
        $this->assertCount(1, Order::all());

    }

    /** @test */
    public function an_email_is_required(){
        $response = $this->post('/order',[
            'email' => 'sdfrg',
            'phone' => 'new phone',
            'shipping_address_1' => 'new shipping_address_1',
            'city' => 'new city',
        ]);
        $response->assertSessionHasErrors('email');
    }
}
