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
            <label>Sizes:</label><br>

            @if(!empty(old('sizes')))
                @foreach (old('sizes') as $oldSizeKey => $old_size)
                    <div class="form-group size-div" data-id="{{$oldSizeKey}}">
                        <div class="form-inline">
                            <input type="text" class="form-control col-10" name="sizes[{{$oldSizeKey}}][name]" value="{{ $old_size['name'] }}" placeholder="Size name">
                            <button class="btn btn-danger delete-size col-2" @if($oldSizeKey == 0){{'disabled'}}@endif>delete</button>
                        </div>
                        <div class="form-row container-fluid mt-3 form-inline">
                                @foreach ($old_size['colors'] as $colorKey => $color)
                                    <div class="col-md-4 col-xl-3 col-sm-6 mb-3 color-div" data-id="0" data-color-id="0">
                                        <input type="text" class="form-control form-control-sm" placeholder="Color name" value="{{ $color['name'] }}" name="sizes[{{$oldSizeKey}}][colors][{{$colorKey}}][name]">
                                        <input type="text" class="form-control form-control-sm" placeholder="Quantity" value="{{ $color['quantity'] }}" name="sizes[{{$oldSizeKey}}][colors][{{$colorKey}}][quantity]">
                                        <button class="btn btn-danger btn-sm delete-color" data-id="{{$colorKey}}" @if($colorKey == 0){{'disabled'}}@endif>delete</button>
                                    </div>
                                @endforeach
                            <button type="button" class="btn btn-link btn-sm add-color" data-id="{{$oldSizeKey}}">Add new color</button>
                        </div>
                    </div>
                @endforeach
            @else
                @foreach ($product->sizes as $sizeKey => $size)
                    <div class="form-group size-div" data-id="{{ $sizeKey }}">
                        <div class="form-inline">
                            <input type="text" class="form-control col-10" name="sizes[{{ $sizeKey }}][name]" placeholder="Size name" value='{{ $size->name }}'>
                            <button class="btn btn-danger delete-size col-2" data-id="{{ $sizeKey }}" @if($sizeKey == 0){{'disabled'}}@endif>delete</button>
                        </div>

                        <div class="form-row container-fluid mt-3 form-inline">
                            @foreach ($size->colors as $colorKey => $color)
                                <div class="col-md-4 col-xl-3 col-sm-6 mb-3 color-div" data-id="{{ $sizeKey }}" data-color-id="{{ $colorKey }}">
                                    <input type="text" class="form-control form-control-sm" placeholder="Color name" name="sizes[{{ $sizeKey }}][colors][{{ $colorKey }}][name]" value="{{ $color->name }}">
                                    <input type="text" class="form-control form-control-sm" placeholder="Quantity" name="sizes[{{ $sizeKey }}][colors][{{ $colorKey }}][quantity]" value="{{ $color->quantity }}">
                                    <button class="btn btn-danger btn-sm delete-color" data-id="{{ $sizeKey }}" @if($colorKey == 0){{'disabled'}}@endif>delete</button>
                                </div>
                            @endforeach
                            <button type="button" class="btn btn-link btn-sm add-color">Add new color</button>
                        </div>
                    </div>
                @endforeach
            @endif

            <button type="button" class="btn btn-primary btn-sm add-size">Add new size</button>
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
        

        <input type="submit" class="btn btn-success" value="Update">
    </form>

    @foreach ($errors->all() as $error)
        <p class="text-danger">{{ $error }}</p>
    @endforeach
@endsection