@extends('layouts.app')

@section('title') IS @endsection

@section('content')
    <div class="container">
        <h1>{{ $product->name }}</h1>

        <p><b>Price: </b>{{ $product->price }} <strike class="text-danger">{{ $product->old_price }}</strike></p>
        <p><b>Category: </b>{{ ucfirst($product->category_name) }}</p>
        <p><b>Type: </b>{{ ucfirst($product->type) }}</p>
        <p><b>Brand: </b>{{ ucfirst($product->brand) }}</p>
        <p><b>Color: </b>{{ ucfirst($product->color) }}</p>

        @if (Auth::user() && Auth::user()->is_admin)
            <a href="{{ route('product.edit', $product->name) }}" class="btn btn-warning d-inline">Edit</a>

            <form action="{{ route('product.destroy', $product->name) }}" method="POST" class="d-inline">
                @method('DELETE')
                @csrf
                <input type="submit" class="btn btn-danger" value="Delete">
            </form>
        @endif

        @foreach ($errors->all() as $error)
            <p class="text-danger">{{ $error }}</p>
        @endforeach
    </div>
@endsection