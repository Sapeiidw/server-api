@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('Service Unavailable'))
@section('image')
<img src="{{ asset('/img/undraw_bug_fixing_oc7a.svg') }}">
@endsection

