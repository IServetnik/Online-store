@extends('layouts.app')

@section('title') IS @endsection

@section('content')
    <h1>Create</h1>

    <form action="{{ route('product.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Name" value="{{ old('name') }}" name="name">
        </div>
        <div class="form-group">
          <label for="price">Price</label>
          <input type="text" class="form-control" id="price" placeholder="Price" value="{{ old('price') }}" name="price">
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select class="form-control" id="category_name" name="category_name">
                @foreach ($categories as $category)
                    <option @if (strtolower(old('category_name')) == strtolower($category->name)) {{ 'selected' }} @endif>{{ ucfirst($category->name) }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="type_name">Type:</label>
            <select class="form-control" id="type_name" name="type_name">
                <option @if (strtolower(old('type_name')) == "shoes") {{ 'selected' }} @endif>Shoes</option>
                <option @if (strtolower(old('type_name')) == "shirts") {{ 'selected' }} @endif>Shirts</option>
                <option @if (strtolower(old('type_name')) == "trousers") {{ 'selected' }} @endif>Trousers</option>
                <option @if (strtolower(old('type_name')) == "hats") {{ 'selected' }} @endif>Hats</option>
                <option @if (strtolower(old('type_name')) == "socks") {{ 'selected' }} @endif>Socks</option>
                <option @if (strtolower(old('type_name')) == "dress") {{ 'selected' }} @endif>Dress</option>
            </select>
        </div>
        <div class="form-group">
            <label for="brand">Brand:</label>
            <input type="text" class="form-control" id="brand" placeholder="Brand" value="{{ old('brand') }}" name="brand">
        </div>
        <div class="form-group">
            <label for="color">Color:</label>
            <input type="text" class="form-control" id="color" placeholder="Color" value="{{ old('color') }}" name="color">
        </div>
        <input type="submit" class="btn btn-primary" value="Create">
    </form>

    @foreach ($errors->all() as $error)
        <p class="text-danger">{{ $error }}</p>
    @endforeach
@endsection