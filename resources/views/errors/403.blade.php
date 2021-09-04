@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
@section('image')
<img src="{{ asset('/img/undraw_access_denied_re_awnf.svg') }}">
@endsection
