@extends('layouts.app')

@section('title') IS @endsection

@section('content')
    <h1>Cart</h1>

    @if(session()->has('success'))
		  <p class="text-success">{{ session()->get('success') }}</p>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Old Price</th>
                <th scope="col">Category</th>
                <th scope="col">Type</th>
                <th scope="col">Quantity</th>
            </tr>
        </thead>

        <tbody>
            @foreach($items as $item)
                <tr>
                    <td><a href="{{ route('product.show', $item['product']->name) }}">{{ $item['product']->name }}</a></td>
                    <td>{{ $item['product']->price }}</td>
                    <td>{{ $item['product']->old_price }}</td>
                    <td>{{ $item['product']->category_name }}</td>
                    <td>{{ $item['product']->type_name }}</td>
                    <td>{{ $item['quantity'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection