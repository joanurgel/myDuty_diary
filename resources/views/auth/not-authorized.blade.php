@extends('layouts.auth-partials.auth-pages')

@section('content')
<div class="row mt-5">
    <div class="col-12 col-md-6 offset-md-3 text-center">
        <div class="alert alert-danger">
            <strong>You do not have permission to access this page.</strong>
        </div>
    </div>
    
    <div class="col-12 col-md-4 offset-md-4 text-center mb-3">
        @auth
            <a href="{{ URL::previous() }}" class="btn btn-secondary btn-block">Go Back</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-warning btn-block">Login</a>
        @endauth
    </div>
    
    <div class="col-12 col-md-6 offset-md-3 text-center">
        <div class="mb-3">
            <img src="{{ asset('/img/gip.gif') }}" alt="Not Authorized" class="img-fluid">
        </div>
    </div>
</div>
@endsection
