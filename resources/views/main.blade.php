@extends('layouts.app')

@section('title') IS @endsection

@section('content')
    <h1>Main</h1>

    @if(session()->has('success'))
		<p class="text-success">{{ session()->get('success') }}</p>
    @endif
    
    @if(Auth::user() && Auth::user()->is_admin)
        <a href="/create">Create</a>
    @endif

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
                    <td>{{ $product->category_name }}</td>
                    <td>{{ $product->type }}</td>
                    <td>{{ $product->brand }}</td>
                    <td>{{ $product->color }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection