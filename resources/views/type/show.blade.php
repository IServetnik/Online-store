@extends('layouts.app')

@section('title') IS @endsection

@section('content')
    <div class="container">
        <h1>{{ $type->name }}</h1>

        <p><b>Category: </b>{{ ucfirst($type->category_name) }}</p>

        @if (Auth::user() && Auth::user()->is_admin)
            <a href="{{ route('type.edit', $type->id) }}" class="btn btn-warning d-inline">Edit</a>

            <form action="{{ route('type.destroy', $type->id) }}" method="POST" class="d-inline">
                @method('DELETE')
                @csrf
                <input type="submit" class="btn btn-danger" value="Delete">
            </form>
        @endif

        @foreach ($errors->all() as $error)
            <p class="text-danger">{{ $error }}</p>
        @endforeach
    </div>
@endsection