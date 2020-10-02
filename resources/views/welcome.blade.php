@extends('layouts.layout')


@section('content')
    <a type="button" href="{{ route('cart') }}" style="margin-bottom: 25px" class="btn btn-outline-secondary">Cart</a> <br>

    <div class="row">
        @foreach($products as $product)
            <div class="col-4">
                <div class="card" style="width: 18rem; margin-bottom: 25px;">
                    <img class="card-img-top" src="{{ $product->image_url }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <a href="{{ route('store_cart', $product->id ) }}" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
