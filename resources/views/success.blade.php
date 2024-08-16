@extends('layout')

@section('title', 'Dashboard')

@section('content')

<div class="container">
    <h1>Welcome,
        {{ Auth::user()->name }}
        {{ Auth::user()->email }}
        !
    </h1>
</div>


@endsection
