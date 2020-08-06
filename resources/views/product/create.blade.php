@extends('layouts.app')

@section('title') IS @endsection

@section('content')
    <h1>Create</h1>

    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Name" value="{{ old('name') }}" name="name">
        </div>
        <div class="form-group">
            <label for="name">Description:</label>
            <textarea class="form-control" name="description" id="description" placeholder="Description" rows="3">{{ old('description') }}</textarea>
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
                @foreach ($types as $type)
                    <option @if (strtolower(old('type_name')) == strtolower($type->name)) {{ 'selected' }} @endif>{{ ucfirst($type->name) }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="brand">Brand:</label>
            <input type="text" class="form-control" id="brand" placeholder="Brand" value="{{ old('brand') }}" name="brand">
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
                                    <div class="col-md-4 col-xl-3 col-sm-6 mb-3 color-div" data-id="{{$oldSizeKey}}" data-color-id="{{$colorKey}}">
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
                <div class="form-group size-div" data-id="0">
                    <div class="form-inline">
                        <input type="text" class="form-control col-10" name="sizes[0][name]" placeholder="Size name">
                        <button class="btn btn-danger delete-size col-2" disabled data-id="0">delete</button>
                    </div>

                    <div class="form-row container-fluid mt-3 form-inline">
                        <div class="col-md-4 col-xl-3 col-sm-6 mb-3 color-div" data-id="0" data-color-id="0">
                            <input type="text" class="form-control form-control-sm" id="color" placeholder="Color name" name="sizes[0][colors][0][name]">
                            <input type="text" class="form-control form-control-sm" placeholder="Quantity" name="sizes[0][colors][0][quantity]">
                            <button class="btn btn-danger btn-sm delete-color" disabled data-id="0">delete</button>
                        </div>
                        <button type="button" class="btn btn-link btn-sm add-color">Add new color</button>
                    </div>
                </div>
            @endif

            <button type="button" class="btn btn-primary btn-sm add-size">Add new size</button>
        </div>
        <div class="form-group">
            <label for="color">Image:</label>
            <input type="file" name="image" accept="image/*" class="form-control-file">
            @if(!empty(session()->getOldInput()))
                <span class="text-danger">Load the image again</span>
            @endif
        </div>
        
        <input type="submit" class="btn btn-success block" value="Create">
    </form>

    @foreach ($errors->all() as $error)
        <p class="text-danger">{{ $error }}</p>
    @endforeach
@endsection