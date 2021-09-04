@extends('errors::minimal')

@section('title', __('Page Not Found'))
@section('code', ' 404')
@section('message', __('Page Not Found'))
@section('image')
<img src="{{ asset('/img/undraw_Faq_re_31cw.svg') }}">
@endsection
