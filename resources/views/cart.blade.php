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
                <th scope="col">Size</th>
                <th scope="col">Color</th>
                <th scope="col">Quantity</th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>

            @foreach($items as $item)
                <tr data-product-name="{{ $item->product->name }}" data-size-name="{{ $item->size_name }}" data-color-name="{{ $item->color_name }}">
                    <td><a href="{{ route('product.show', $item->product->name) }}">{{ $item->product->name }}</a></td>
                    <td>{{ $item->product->price }}</td>
                    <td>{{ $item->product->old_price }}</td>
                    <td>{{ $item->product->category_name }}</td>
                    <td>{{ $item->product->type_name }}</td>
                    <td>{{ $item->size_name }}</td>
                    <td>{{ $item->color_name }}</td>
                    <td><a href="" data-route="{{ route('cart.increaseQuantity', $item->product->name) }}" class="increase-quantity">+</a><span class="product-quantity">{{ $item->quantity }}</span><a href="" data-route="{{ route('cart.decreaseQuantity', $item->product->name) }}" class="decrease-quantity">-</a></td>
                    <td><a href="" data-route="{{ route('cart.delete', $item->product->name) }}" class="btn btn-danger delete-from-cart">Delete from cart</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
<h3>Total price: <span id="total-price">{{ $totalPrice }}</span></h3>
@endsection