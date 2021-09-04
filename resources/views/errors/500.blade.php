@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))
@section('image')
<img src="{{ asset('/img/undraw_server_down_s4lk.svg') }}">
@endsection
