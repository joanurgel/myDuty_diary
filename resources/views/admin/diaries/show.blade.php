@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="text-uppercase bg-primary p-2 text-light">Practicum Duty Diary</h3>
        <div class="row pl-2">
            <div class="col-3">Name of Trainee: </div>
            <div class="col-9 font-weight-bold">{{ $diary['name'] }}</div>
        </div>
        <div class="row pl-2">
            <div class="col-3">Company Name: </div>
            <div class="col-9 font-weight-bold">CREATIVEDEVLABS (CDL INNOVATIVE IT SOLUTIONS)</div>
        </div>
        <div class="row pl-2">
            <div class="col-3">Diary Date: </div>
            <div class="card-title col-9 font-weight-bold"> {{ $diary->created_at->format('F d, Y') }}</div>
        </div>
    </div>

    <div class="card-body">
        <p class="card-text"><strong>Author:</strong> {{ $diary->author->name }}</p>
        <p class="card-text"><strong>Supervisor:</strong> {{ $diary->supervisor->name }}</p>
        <hr>
        <h6 class="card-subtitle mb-2 text-muted"><strong>Plan for Today</strong></h6>
        <p class="card-text">{!! $diary->plan_today !!}</p><hr>
        <h6 class="card-subtitle mb-2 text-muted"><strong>End of Day Summary</strong></h6>
        <p class="card-text">{!! $diary->end_day !!}</p><hr>
        <h6 class="card-subtitle mb-2 text-muted"><strong>Plan for Tomorrow</strong></h6>
        <p class="card-text">{!! $diary->plan_tomorrow !!}</p><hr>
        <h6 class="card-subtitle mb-2 text-muted"><strong>Roadblocks</strong></h6>
        <p class="card-text">{!! $diary->roadblocks !!}</p>
    </div>
    
    <div class="card-footer text-muted">
        Status: @if ($diary->status == 0)
            <span class="badge badge-warning">Pending</span>
        @else
            <span class="badge badge-success">Approved</span>
        @endif
    </div>
</div>
@endsection
