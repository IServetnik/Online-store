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
                <p id="type"><b>Type: </b>{{ ucfirst($product->type->name) }}</p>
                @if ($product->rating !== null)
                    <p><b>Rating: </b> <span id="rating">{{ $product->rating }}</span><p>
                @endif
                <p><b>Brand: </b>{{ ucfirst($product->brand) }}</p>
                <p><b>Color: </b>{{ ucfirst($product->color) }}</p>
                
                @if (Auth::user())
                    <button type="button" class="btn btn-secondary d-inline" data-toggle="modal" data-target="#modal-review">Write a review</button>
                @endif
                @if (Auth::user() && Auth::user()->is_admin)
                    <a href="{{ route('product.edit', $product->name) }}" class="btn btn-warning d-inline">Edit</a>
    
                    <form action="{{ route('product.destroy', $product->name) }}" method="POST" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </form>
                @endif
            </div>
            
            <div class="col-md-6">
                @include('inc.review')
                <div class="reviews">
                    @foreach ($product->reviews as $review)
                        <h4>{{ $review->text }}</h4>
                        <b><i>Rating: {{ $review->rating }}</i></b><br>
                        <small>created: {{ $review->created_at }}</small>
                        @if ($review->created_at != $review->updated_at)
                            <small>updated: {{ $review->updated_at }}</small>
                        @endif 
                        <br>
                        <br><br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @foreach ($errors->all() as $error)
        <p class="text-danger">{{ $error }}</p>
    @endforeach
@endsection