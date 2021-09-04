@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))
@section('image')
<img src="{{ asset('/img/undraw_cancel_u1it.svg') }}">
@endsection
