@extends('layouts.app')

@section('title') IS @endsection

@section('content')
    <p id="response"></p>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>{{ $product->name }}</h1>
                <h4>{{ $product->description }}</h4>
                <p><b>Price: </b>{{ $product->price }} <strike class="text-danger">{{ $product->old_price }}</strike></p>
                <p><b>Category: </b>{{ ucfirst($product->category_name) }}</p>
                <p id="type"><b>Type: </b>{{ ucfirst($product->type_name) }}</p>
                @if ($product->rating != 0)
                    <p id="rating"><b>Rating: </b> <span>{{ $product->rating }}</span><p>
                @endif
                <p><b>Brand: </b>{{ ucfirst($product->brand) }}</p>
                <p><b>Color: </b>{{ ucfirst($product->color) }}</p>
                
                @if (Auth::check() && !$product->reviews->contains('user_id',Auth::user()->id))
                    <button type="button" class="btn btn-secondary d-inline" data-toggle="modal" data-target="#modal-review" id="write-review">Write a review</button>
                @endif
                @if (Auth::check() && Auth::user()->is_admin)
                    <a href="{{ route('product.edit', $product->name) }}" class="btn btn-warning d-inline">Edit</a>
    
                    <form action="{{ route('product.destroy', $product->name) }}" method="POST" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </form>
                @endif
            </div>
            
            <div class="col-md-6">
                @include('review.create', compact('product'))
                @include('review.show', ['reviews' => $product->reviews])
            </div>
        </div>
    </div>
    @foreach ($errors->all() as $error)
        <p class="text-danger">{{ $error }}</p>
    @endforeach
@endsection