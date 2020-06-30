@extends('layouts.app')

@section('title') IS @endsection

@section('content')

    <h1>Cart</h1>

    @if(session()->has('success'))
		  <p class="text-success">{{ session()->get('success') }}</p>
    @endif
    <p id="response"></p>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Old Price</th>
                <th scope="col">Category</th>
                <th scope="col">Type</th>
                <th scope="col">Quantity</th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>

            @foreach($items as $item)
                <tr data-product-name="{{ $item->product->name }}">
                    <td><a href="{{ route('product.show', $item->product->name) }}">{{ $item->product->name }}</a></td>
                    <td>{{ $item->product->price }}</td>
                    <td>{{ $item->product->old_price }}</td>
                    <td>{{ $item->product->category_name }}</td>
                    <td>{{ $item->product->type_name }}</td>
                    <td><a href="" data-route="{{ route('ajax.cart.increaseQuantity') }}" class="increase-quantity">+</a><span class="product-quantity">{{ $item->quantity }}</span><a href="" data-route="{{ route('ajax.cart.decreaseQuantity') }}" class="decrease-quantity">-</a></td>
                    <td><a href="" data-route="{{ route('ajax.cart.delete') }}" class="btn btn-danger delete-from-cart">Delete from cart</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
<h3>Total price: <span id="total-price">{{ $totalPrice }}</span></h3>
@endsection