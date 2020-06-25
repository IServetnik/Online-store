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
                <tr>
                    <td data-product-name="{{ $item['product']->name }}"><a href="{{ route('product.show', $item['product']->name) }}">{{ $item['product']->name }}</a></td>
                    <td data-product-name="{{ $item['product']->name }}">{{ $item['product']->price }}</td>
                    <td data-product-name="{{ $item['product']->name }}">{{ $item['product']->old_price }}</td>
                    <td data-product-name="{{ $item['product']->name }}">{{ $item['product']->category_name }}</td>
                    <td data-product-name="{{ $item['product']->name }}">{{ $item['product']->type_name }}</td>
                    <td data-product-name="{{ $item['product']->name }}">{{ $item['quantity'] }}</td>
                    <td data-product-name="{{ $item['product']->name }}"><a href="" data-route="{{ route('cart.delete') }}" class="btn btn-danger delete-from-cart" data-product-name="{{ $item['product']->name }}">Delete from cart</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection