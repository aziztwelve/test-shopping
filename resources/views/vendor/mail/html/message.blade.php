@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

{{-- Body --}}

<div class="container">
<div class="row">
    <p>Email: {{ $order->email }}</p>
    <p>Phone: {{ $order->phone }}</p>
    <p>Address: {{ $order->shipping_address_1 }}</p>
    <p>City: {{ $order->city }}</p>
<table class="table table-dark">
    <thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Image</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td><img style="width: 200px;" src="{{ $product->image_url }}" alt=""></td>
            <td>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
</div>

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent
