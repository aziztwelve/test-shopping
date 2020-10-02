<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class OrderTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testOrder()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->click('a[href="http://repo-dusk.com/cart/2"]')
                ->assertUrlIs('http://repo-dusk.com/');

            $browser->visit('http://repo-dusk.com/cart')
                ->type('email', 'user@gmail.com')
                ->type('phone', '8952222222')
                ->type('shipping_address_1', 'new shipping_address_1')
                ->type('city', 'city')
                ->press('Send')
                ->assertUrlIs('http://repo-dusk.com/');
        });
    }

}
