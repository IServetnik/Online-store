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
                <option @if (old('category_name') == "Mne") {{ 'selected' }} @endif>Men</option>
                <option @if (old('category_name') == "Women") {{ 'selected' }} @endif>Women</option>
                <option @if (old('category_name') == "Kids") {{ 'selected' }} @endif>Kids</option>
            </select>
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
            <select class="form-control" id="type" name="type">
                <option @if (old('type') == "Shoes") {{ 'selected' }} @endif>Shoes</option>
                <option @if (old('type') == "Shirts") {{ 'selected' }} @endif>Shirts</option>
                <option @if (old('type') == "Trousers") {{ 'selected' }} @endif>Trousers</option>
                <option @if (old('type') == "Hats") {{ 'selected' }} @endif>Hats</option>
                <option @if (old('type') == "Socks") {{ 'selected' }} @endif>Socks</option>
                <option @if (old('type') == "Dress") {{ 'selected' }} @endif>Dress</option>
            </select>
        </div>
        <div class="form-group">
            <label for="brand">Brand</label>
            <input type="text" class="form-control" id="brand" placeholder="Brand" value="{{ old('brand') }}" name="brand">
        </div>
        <div class="form-group">
            <label for="color">Color</label>
            <input type="text" class="form-control" id="color" placeholder="Color" value="{{ old('color') }}" name="color">
        </div>
        <input type="submit" class="btn btn-primary" value="Create">
    </form>

    @foreach ($errors->all() as $error)
        <p class="text-danger">{{ $error }}</p>
    @endforeach
@endsection