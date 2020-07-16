@extends('layouts.app')

@section('title') IS @endsection

@section('content')
    <h1><a href="{{ route("$category.all") }}">{{ ucfirst($category) }}</a>/
        @if(Auth::user() && Auth::user()->is_admin) 
            <a href="{{ route('type.show', $type->id) }}">{{ ucfirst($type->name) }}</a>
        @else 
            {{ ucfirst($type->name) }}
        @endif
    </h1>

    <p id="response"></p>

    <div class="row" style="margin-top: 30px; margin-right: 0px;">
        <div class="col-md-3 col-sm-12">
            @include('inc.filter', compact('category', 'type'))
        </div>
        <div class="table table-striped col-md-9  col-sm-12">
            @include('inc.table', compact('products'))
        </div>
    </div>

@endsection