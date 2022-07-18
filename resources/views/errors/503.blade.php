@extends('layout.errors')

@section('title', 'Service Unavailable')

@section('message')
    {{ env('APP_NAME') }} is undergoing a scheduled update.
    <br><br>
    The service will return shortly.
@endsection
