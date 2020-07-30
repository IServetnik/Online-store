@extends('layouts.app')

@section('title') IS @endsection

@section('content')
    <h1>Edit</h1>
    
    <form action="{{ route('product.update', $product->name) }}" method="POST" enctype="multipart/form-data">
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
            <div class="form-check">
                <input type='hidden' value='0' name='withDiscount'>
                @if (old('withDiscount') !== null)
                    <input type="checkbox" class="form-check-input" id="withDiscount" value="1" name="withDiscount"  @if (old('withDiscount')) {{ 'checked' }} @endif>
                @else
                    <input type="checkbox" class="form-check-input" id="withDiscount" value="1" name="withDiscount"  @if ($product->old_price !== null) {{ 'checked' }} @endif>
                @endif
                <label class="form-check-label" for="withDiscount">With discount</label>
            </div>
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
            @if(!empty(old('sizes')))
                @foreach (old('sizes') as $key => $old_size)
                    <div class="form-check form-check-inline">
                        <select class="form-control size_name_select" name="sizes[{{$key}}][id]">
                            @foreach ($sizes as $size)
                                <option @if (strtolower($old_size['id']) == strtolower($size->id)) {{ 'selected' }} @endif value="{{ $size->id }}">{{ ucfirst($size->name) }}</option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control size-input d-inline" value='{{ $old_size['quantity'] }}' placeholder="Quantity" name="sizes[{{$key}}][quantity]">
                        <button class="btn btn-danger btn-sm delete-size" @if(min(array_keys(old('sizes'))) == $key) {{'disabled'}} @endif>delete</button>
                    </div>
                @endforeach
            @else
                @foreach ($product->sizes as $key => $product_size)
                    <div class="form-check form-check-inline">
                            <select class="form-control size_name_select" name="sizes[{{$key}}][id]">
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}" @if($size->id == $product_size->id) {{'selected'}} @endif>{{ ucfirst($size->name) }}</option>
                                @endforeach
                            </select>
                            <input type="text" class="form-control size-input d-inline" placeholder="Quantity" value='{{ $product_size->pivot->quantity }}' name="sizes[{{$key}}][quantity]">
                            <button class="btn btn-danger btn-sm delete-size" @if($product->sizes->keys()->min() == $key) {{'disabled'}} @endif>delete</button>
                    </div>
                @endforeach
            @endif


            <button type="button" class="btn btn-link btn-sm add-size">Add new size</button>
        </div>
        <div class="form-group">
            <label for="color">Image:</label><br>
            <button class="btn btn-sm btn-primary" type="button" data-toggle="collapse" data-target="#imageDiv" aria-expanded="false" aria-controls="imageDiv">
                Update image
            </button>
            <div class="collapse" id="imageDiv">
                <div class="card card-body" style="background-color: rgb(247, 247, 247)">
                    <input type="hidden" name="image" value="0">
                    <input type="file" name="image" accept="image/*" class="form-control-file">
                </div>
            </div>
            @if(!empty(session()->getOldInput()))
                <span class="text-danger">Load the image again</span>
            @endif
        </div>
        

        <input type="submit" class="btn btn-primary" value="Update">
    </form>

    @foreach ($errors->all() as $error)
        <p class="text-danger">{{ $error }}</p>
    @endforeach
@endsection