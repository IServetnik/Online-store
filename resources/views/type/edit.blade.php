@extends('layouts.app')

@section('title') IS @endsection

@section('content')
    <h1>Edit</h1>

    <form action="{{ route('type.update', $type->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Name" 
                                    value="{{ old('name') ? old('name') : $type->name }}" name="name">
        </div>
        <div class="form-group">
            <label for="category_name">Category:</label>
            <select class="form-control" id="category_name" name="category_name">
                @foreach ($categories as $category)
                    @if (old('category_name') !== null)
                        <option @if (strtolower(old('category_name')) == strtolower($category->name)) {{ 'selected' }} @endif>{{ ucfirst($category->name) }}</option>
                    @else
                        <option @if (strtolower($type->category_name) == strtolower($category->name)) {{ 'selected' }} @endif>{{ ucfirst($category->name) }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <input type="submit" class="btn btn-success" value="Create">
    </form>

    @foreach ($errors->all() as $error)
        <p class="text-danger">{{ $error }}</p>
    @endforeach
@endsection