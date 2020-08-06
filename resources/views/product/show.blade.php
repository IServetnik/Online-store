@extends('layouts.app')

@section('title') IS @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @if(session()->has('success'))
                    <p class="text-success">{{ session()->get('success') }}</p>
                @endif
                <p id="response"></p>
                
                <h1>{{ $product->name }}</h1>
                <h4>{{ $product->description }}</h4>
                <p><b>Price: </b>{{ $product->price }} <strike class="text-danger">{{ $product->old_price }}</strike></p>
                <p><b>Category: </b>{{ ucfirst($product->category_name) }}</p>
                <p id="type"><b>Type: </b>{{ ucfirst($product->type_name) }}</p>
                @if ($product->rating != 0)
                    <p id="rating"><b>Rating: </b> <span>{{ $product->rating }}</span><p>
                @endif
                <p><b>Brand: </b>{{ ucfirst($product->brand) }}</p>
                <b>Sizes: </b>{{ strtoupper($product->sizes->implode('name', ', ')) }} <br>

                <div><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-{{$product->name}}">Add to cart</button></div>
                <div class="modal fade" id="modal-{{$product->name}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Choose size</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @foreach ($product->sizes as $size)
                                <form>
                                    <div class="form-group">
                                        <h4 class="form-check-label" > {{ strtoupper($size->name) }}</h4>
                                        <div class="form-group ml-2">
                                            @foreach ($size->colors as $color)
                                                <input type="checkbox" value="{{$color->name}}" id="color-{{$product->name}}-{{$size->name}}-{{$color->name}}" class="color_name color_name_{{$size->name}}" name="color_name" class="color-{{$product->name}}" data-size-name="{{$size->name}}" @if($color->quantity == 0){{'disabled'}}@endif>
                                                <label class="form-check-label" for="color-{{$product->name}}-{{$size->name}}-{{$color->name}}"> {{ ucfirst($color->name) }}</label>
                                            @endforeach
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                        <div data-product-name="{{ $product->name }}">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary add-to-cart" data-product-name="{{ $product->name }}" data-dismiss="modal" data-route="{{ route('cart.add') }}">Add to cart</button>
                            </div>
                        </div>
                        @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                        @endforeach
                    </div>
                    </div>
                </div><br>
                
                @if (Auth::check() && !$product->reviews->contains('user_id',Auth::user()->id))
                    <button type="button" class="btn btn-secondary d-inline" data-toggle="modal" data-target="#create-review">Write a review</button>
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