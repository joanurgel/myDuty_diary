@extends('layouts.admin')

@section('content')

{{-- <div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-8 col-12">
                <h4 class="m-0">
                    <i class="fas fa-solid fa-book-open"></i>
                    {{ $diary['title']}}
                </h4>
            </div>
            <div class="col-md-4 col-12 text-right">
                <a href="{{ back()->getTargetUrl() }}" class="btn btn-sm btn-secondary">
                    <i class="fas fa-solid fa-chevron-left"></i>
                    Back
                </a>
            </div>
        </div>
    </div>
        <div class="card-body">
            <div class="header-box py-3 border-bottom mb-3">
                <h3 class="text-uppercase bg-primary p-2 text-light">Practicum Duty Diary</h3>
        <div class="row pl-2">
            <div class="col-3">Name of Trainee: </div>
            <div class="col-9 font-weight-bold">{{ $diary->author->name }}</div>
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
        <p class="card-text"><strong>Supervisor:</strong> {{ $diary->supervisor->name }}</p>
        <hr>
        @foreach ([
            'Plan for Today' => $diary->plan_today,
            'End of Day Summary' => $diary->end_day,
            'Roadblocks' => $diary->roadblocks,
            'Plan for Tomorrow' => $diary->plan_tomorrow,
            'Summary' => $diary->summary,
        ] as $title => $content)
            <h6 class="card-subtitle mb-2 text-muted"><strong>{{ $title }}</strong></h6>
            <ul class="list-unstyled">
                @foreach (explode("\n", $content) as $item)
                    <li>{!! $item !!}</li>
                @endforeach
            </ul>
            <hr>
        @endforeach
    </div>
    
    <div class="card-footer text-muted">
        Status: <span class="badge {{ $diary->status == 0 ? 'badge-warning' : 'badge-success' }}">
            {{ $diary->status == 0 ? 'Pending' : 'Approved' }}
        </span>
    </div>
    </div> --}}
    
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8 col-12">
                    <h4 class="m-0">
                        <i class="fas fa-solid fa-book-open"></i>
                        {{ $diary['title']}}
                    </h4>
                </div>
                <div class="col-md-4 col-12 text-right">
                    <a href="{{ back()->getTargetUrl() }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-solid fa-chevron-left"></i>
                        Back
                    </a>
                    @if ($diary['diary']->status == 1)
                        <a href="{{ route('diaries.print', $diary['diary']->id) }}" class="btn btn-sm btn-warning" target="_blank">
                            <i class="fas fa-solid fa-print"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="header-box py-3 border-bottom mb-3">
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
                    <div class="col-9 font-weight-bold">{{ $diary['diary']->created_at->format('m/d/y') }}</div>
                </div>
            </div>
            
            <h5 class="text-uppercase">Plan Today</h5>
            <ul>
                @foreach (explode("\n", $diary['diary']->plan_today) as $item)
                    <li>{!! trim($item, "• ") !!}</li>
                @endforeach
            </ul>
            <hr>

            <h5 class="text-uppercase">End-of-Day Report</h5>
            <ul>
                @foreach (explode("\n", $diary['diary']->end_day) as $item)
                    <li>{!! trim($item, "• ") !!}</li>
                @endforeach
            </ul>
            <hr>

            <h5 class="text-uppercase">Plan Tomorrow</h5>
            <ul>
                @foreach (explode("\n", $diary['diary']->plan_tomorrow) as $item)
                    <li>{!! trim($item, "• ") !!}</li>
                @endforeach
            </ul>
            <hr>

            <h5 class="text-uppercase">Roadblocks</h5>
            <ul>
                @foreach (explode("\n", $diary['diary']->roadblocks) as $item)
                    <li>{!! trim($item, "• ") !!}</li>
                @endforeach
            </ul>
            <hr>

            <h5 class="text-uppercase">Summary</h5>
            {!! $diary['diary']->summary !!}
            
            <hr>

            
            <p class="mt-5">Checked by:</p>       
            <img src="{{ asset('storage/'.$diary['signature']) }}" alt="Supervisor's Signature" width="15%" class="position-relative top-1 mt-5">
            <h5 class="text-uppercase mb-0">{{$diary['supervisor'] }}</h5>
            <p class="m-0">HTE Supervising Officer</p>
            <p class="m-0">Date: {{ now()->format('m/d/y') }}</p>
        </div>
    </div>
    
@endsection
