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
            <label for="name">Description:</label>
            <textarea class="form-control" name="description" id="description" placeholder="Description" rows="3">{{ old('description') ? old('description') : $product->description }}</textarea>
        </div>
        <div class="form-group">
          <label for="price">Price</label>
          <input type="text" class="form-control" id="price" placeholder="Price" 
                                            value="{{ old('price') ? old('price') : $product->price }}" name="price">
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select class="form-control" id="category_name" name="category_name">
                @foreach ($categories as $category)
                    @if (old('category_name') !== null)
                        <option @if (strtolower(old('category_name')) == strtolower($category->name)) {{ 'selected' }} @endif>{{ ucfirst($category->name) }}</option>
                    @else
                        <option @if (strtolower($product->category_name) == strtolower($category->name)) {{ 'selected' }} @endif>{{ ucfirst($category->name) }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="type_name">Type:</label>
            <select class="form-control" id="type_name" name="type_name">
                @foreach ($types as $type)
                    @if (old('category_name') !== null)
                        <option @if (strtolower(old('type_name')) == strtolower($type->name)) {{ 'selected' }} @endif>{{ ucfirst($type->name) }}</option>
                    @else
                        <option @if (strtolower($product->type_name) == strtolower($type->name)) {{ 'selected' }} @endif>{{ ucfirst($type->name) }}</option>
                    @endif
                @endforeach
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
        <div class="form-group">
            <label for="color">Sizes:</label><br>
            @if(!empty(old('sizes_name')))
                @foreach (old('sizes_name') as $key => $size_name)
                    <div class="form-check form-check-inline">
                        <input type="text" class="form-control size-input d-inline" value='{{ $size_name }}' placeholder="Size" name="sizes_name[]">
                        <input type="text" class="form-control size-input d-inline" value='{{ old('quantity')[$key] }}' placeholder="Quantity" name="quantity[]">
                        <button class="btn btn-danger btn-sm delete-size">delete</button>
                    </div>
                @endforeach
            @else
                @foreach ($product->sizes as $size)
                    <div class="form-check form-check-inline">
                        <input type="text" class="form-control size-input d-inline" value='{{ $size->name }}' placeholder="Size" name="sizes_name[]">
                        <input type="text" class="form-control size-input d-inline" value='{{ $size->quantity }}' placeholder="Quantity" name="quantity[]">
                        <button class="btn btn-danger btn-sm delete-size">delete</button>
                    </div>
                @endforeach
            @endif
            <button type="button" class="btn btn-link btn-sm add-size">Add new size</button>
        </div>

        <input type="submit" class="btn btn-primary" value="Update">
    </form>

    @foreach ($errors->all() as $error)
        <p class="text-danger">{{ $error }}</p>
    @endforeach
@endsection