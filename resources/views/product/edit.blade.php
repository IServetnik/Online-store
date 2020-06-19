@extends('layouts.app')

@section('title') IS @endsection

@section('content')
    <h1>Edit</h1>
    
    <form action="{{ route('product.update', $product->name) }}" method="POST">
        @csrf
        @method('PATCH')
        
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Name" 
                                                value="{{ old('name') ? old('name') : $product->name }}" name="name">
        </div>
        <div class="form-group">
          <label for="price">Price</label>
          <input type="text" class="form-control" id="price" placeholder="Price" 
                                            value="{{ old('price') ? old('price') : $product->price }}" name="price">
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select class="form-control" id="category_name" name="category_name">
                <option @if (strtolower(old('category_name')) == "men" || strtolower($product->category_name) == "men") {{ 'selected' }} @endif>Men</option>
                <option @if (strtolower(old('category_name')) == "women" || strtolower($product->category_name) == "women") {{ 'selected' }} @endif>Women</option>
                <option @if (strtolower(old('category_name')) == "kids" || strtolower($product->category_name) == "kids") {{ 'selected' }} @endif>Kids</option>
            </select>
        </div>
        <div class="form-group">
            <label for="type_name">Type:</label>
            <select class="form-control" id="type_name" name="type_name">
                <option @if (strtolower(old('type_name')) == "shoes" || strtolower($product->type_name) == "shoes") {{ 'selected' }} @endif>Shoes</option>
                <option @if (strtolower(old('type_name')) == "shirts" || strtolower($product->type_name) == "shirts") {{ 'selected' }} @endif>Shirts</option>
                <option @if (strtolower(old('type_name')) == "trousers" || strtolower($product->type_name) == "trousers") {{ 'selected' }} @endif>Trousers</option>
                <option @if (strtolower(old('type_name')) == "hats" || strtolower($product->type_name) == "hats") {{ 'selected' }} @endif>Hats</option>
                <option @if (strtolower(old('type_name')) == "socks" || strtolower($product->type_name) == "socks") {{ 'selected' }} @endif>Socks</option>
                <option @if (strtolower(old('type_name')) == "dress" || strtolower($product->type_name) == "dress") {{ 'selected' }} @endif>Dress</option>
            </select>
        </div>
        <div class="form-group">
            <label for="brand">Brand</label>
            <input type="text" class="form-control" id="brand" placeholder="Brand" 
                                        value="{{ old('brand') ? old('brand') : $product->brand }}" name="brand">
        </div>
        <div class="form-group">
            <label for="color">Color</label>
            <input type="text" class="form-control" id="color" placeholder="Color" 
                                        value="{{ old('color') ? old('color') : $product->color }}" name="color">
        </div>
        <input type="submit" class="btn btn-primary" value="Update">
    </form>

    @foreach ($errors->all() as $error)
        <p class="text-danger">{{ $error }}</p>
    @endforeach
@endsection