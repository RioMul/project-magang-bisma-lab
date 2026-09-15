@extends('layouts.client')

@section('title', 'Dashboard | Client Area')

@section('content')

@include('client.partials.dashboard_header')

@include('client.partials.dashboard_stats')

@if(!$hasPaidOrder)
    @include('client.partials.dashboard_setup')
@endif

@include('client.partials.dashboard_management')

@include('client.partials.dashboard_activity')

@endsection