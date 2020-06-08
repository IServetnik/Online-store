@extends('layouts.app')

@section('title') IS @endsection

@section('content')
    <h1><a href="/kids">Kids</a></h1>

    <a href="/kids/shoes">Shoes</a>
    <a href="/kids/shirts">Shirts</a>
    <a href="/kids/trousers">Trousers</a>
    <a href="/kids/hats">Hats</a>
    <a href="/kids/socks">Socks</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Old Price</th>
                <th scope="col">Category</th>
                <th scope="col">Type</th>
                <th scope="col">Brand</th>
                <th scope="col">Color</th>
            </tr>
        </thead>

        <tbody>
            @foreach($products as $product)
                <tr>
                    <th scope="row">{{ $product->id }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->old_price }}</td>
                    <td>{{ $product->category }}</td>
                    <td>{{ $product->type }}</td>
                    <td>{{ $product->brand }}</td>
                    <td>{{ $product->color }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection