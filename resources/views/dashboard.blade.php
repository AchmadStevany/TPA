@extends('master')
@section('title')
    Dashboard
@endsection
@section('content')
    @component('layouts.breadcrumb')
        @slot('pagetitle')
            Bank Sampah Resik
        @endslot
        @slot('title')
            Dashboard
        @endslot
    @endcomponent
@endsection
