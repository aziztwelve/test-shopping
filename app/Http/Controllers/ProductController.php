<?php

namespace App\Http\Controllers;

use App\Product;
use App\Repository\ProductRepositoryInterface;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Event;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {

        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->getLimit();

        return view('welcome', [
            'products' => $products
        ]);

    }

    public function storeCart($id)
    {
        $geo_ip = Event::dispatch('before.add.cart');
        if ($geo_ip[0]->country_name === 'Australia'){
            return redirect()->back()->with('error', "You can't order from this counrty");
        }

        $product = $this->productRepository->find($id);

        //From task:  They can submit an order on only one product at a time
        Event::dispatch('cart.delete.match.id', $id );

        Event::dispatch('cart.add', [$product->id, $product->name] );

        return redirect()->back()->with('success', 'Product added');
    }

    public function cart()
    {
        $carts = Cart::instance('default')->content();
        return view('cart', [
            'carts' => $carts
        ]);
    }

    public function deleteCart($id)
    {
        Event::dispatch('cart.delete.id', $id );
        return redirect()->back()->with('success', 'Product deleted');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
           'name'=> 'required',
           'image_url'=> 'required',
        ]);
        Product::create([
           'name' => $request->name,
           'image_url' => $request->image_url,
        ]);
    }

    public function destroy($id)
    {
        Product::find($id)->delete();
    }


}
