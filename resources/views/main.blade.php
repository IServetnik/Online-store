@extends('layouts.app')

@section('title') IS @endsection

@section('content')
    <h1>Main</h1>

    @if(session()->has('success'))
		<p class="text-success">{{ session()->get('success') }}</p>
    @endif
    
    @if(Auth::user() && Auth::user()->is_admin)
        <a href={{ route('product.create') }}>Create</a>
    @endif

    @include('inc.table', compact('products'))

@endsection