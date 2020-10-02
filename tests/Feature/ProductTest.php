<?php

namespace Tests\Feature;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /** @test */
    public function a_produst_can_be_added()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/product', [
           'name'=>"Banan",
           'image_url'=>"image path"
        ]);
        $response->assertOk();
        $this->assertCount(27, Product::all());
    }

    /** @test */
    public function a_name_is_required()
    {
        $response = $this->post('/product', [
            'name'=>"",
            'image_url'=>"image path"
        ]);
        $response->assertSessionHasErrors('name');

    }

    /** @test */
    public function a_product_can_be_deleted() {

        $this->withoutExceptionHandling();

        $product = Product::first();
        $this->assertCount(32, Product::all());
        $response = $this->delete('/product/'.$product->id);
        $this->assertCount(31, Product::all());

    }

}
