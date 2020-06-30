@extends('layouts.app')

@section('title') IS @endsection

@section('content')
    <h1>{{ ucfirst($category) }}</h1>
    <p id="response"></p>
    
    @include('inc.types', compact('category', 'types'))

    @include('inc.table', compact('products'))

@endsection