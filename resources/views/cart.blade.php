@extends('layouts.layout')


@section('content')
    <div class="mx-auto" style="width: 200px;">
    <a type="button" href="/" style="margin-bottom: 25px" class="btn btn-info">Main page</a> <br>
    </div>

    @if(count($carts) > 0)
        <div class="row">

            <table class="table table-dark">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($carts as $cart)
                        <tr>
                            <td>{{ $cart->name }}</td>
                            <td>{{ $cart->qty }}</td>
                            <td>
                                <form action="{{ route('cart_delete', $cart->rowId) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <form  action="{{ route('order_create') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" name="email"  class="form-control" id="inputEmail4" placeholder="Email"  value="{{old('email')}}">
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPhone">Phone</label>
                    <input type="text" name="phone" class="form-control" id="inputPhone" placeholder="Phone"  value="{{old('phone')}}">
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword4">Address 1</label>
                <input type="text" name="shipping_address_1" class="form-control" id="inputAddress1" placeholder="Region"  value="{{old('shipping_address_1')}}">
                <span class="text-danger">{{ $errors->first('shipping_address_1') }}</span>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputAddress">Address 2</label>
                    <input type="text" name="shipping_address_2" class="form-control" id="inputAddress2" placeholder="1234 Main St"  value="{{old('shipping_address_2')}}">
                    <span class="text-danger">{{ $errors->first('shipping_address_2') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress2">Address 3</label>
                    <input type="text" name="shipping_address_3" class="form-control" id="inputAddress3" placeholder="Apartment, studio, or floor"  value="{{old('shipping_address_3')}}">
                    <span class="text-danger">{{ $errors->first('shipping_address_3') }}</span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" name="city" class="form-control" id="inputCity" placeholder="City"  value="{{old('city')}}">
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputCode">County code</label>
                    <input type="text" name="country_code" class="form-control" id="inputCode" placeholder="County code"  value="{{old('country_code')}}">
                    <span class="text-danger">{{ $errors->first('country_code') }}</span>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Zip</label>
                    <input type="text" name="zip_postal_code" class="form-control" id="inputZip" placeholder="Zip"  value="{{old('zip_postal_code')}}">
                    <span class="text-danger">{{ $errors->first('zip_postal_code') }}</span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    @else
        <div class="mx-auto" style="width: 200px;">
            <h2>Cart is empty</h2>
        </div>
    @endif
@endsection
