@extends('layouts.app')

@section('title') IS @endsection

@section('content')
    <h1><a href="{{ route("$category.all") }}">{{ ucfirst($category) }}</a>/{{ ucfirst($type) }}</h1>

    <div class="row" style="margin-top: 30px; margin-right: 0px;">
        <div class="col-md-3 col-sm-12">
            @include('inc.filter', compact('category', 'type'))
        </div>
        <div class="table table-striped col-md-9  col-sm-12">
            @include('inc.table', compact('products'))
        </div>
    </div>

@endsection