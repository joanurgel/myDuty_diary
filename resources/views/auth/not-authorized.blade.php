@extends('layouts.auth-partials.auth-pages')

@section('content')
<div class="row mt-5">
    <div class="col-12 col-md-8 offset-md-2 text-center">
        <div class="alert alert-danger">
            <strong>Dili ka pwede</strong>
            
        </div>
    </div>
    <div class="col-12 col-md-4 offset-md-4 mb-3 text-center">
        @auth
            <a href="{{ URL::previous() }}" class="btn btn-secondary btn-block btn-sm">Back</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-warning btn-block btn-sm">Login</a>
        @endauth
    </div>
    <div class="col-12 col-md-4 offset-md-4 text-center">
        <img src="{{ asset('/img/gip.gif') }}" alt="Not Authorized" class="img-fluid">
    </div>
</div>
@endsection
