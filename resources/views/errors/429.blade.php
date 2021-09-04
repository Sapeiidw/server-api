@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))
@section('image')
<img src="{{ asset('/img/undraw_contact_us_15o2.svg') }}">
@endsection
