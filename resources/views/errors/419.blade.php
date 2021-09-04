@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired'))
@section('image')
<img src="{{ asset('/img/undraw_warning_cyit.svg') }}">
@endsection

