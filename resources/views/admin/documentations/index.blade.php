@extends('layouts.admin')

@section ('content')
  
    {{-- <div class="card">
        <form action="{{route('documentations.store')}}" method="POST" enctype="multipart/form-data">  
            @csrf
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h2 class="mb-2 mb-md-0">Documentations</h2>
                    
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                        Add Document
                      </button>
                </div>
            </div>
        </div> --}}

        <div class="card">
            <form action="{{route('documentations.store')}}" method="POST" enctype="multipart/form-data">  
                @csrf
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <h3 class="mb-2 mb-md-0">
                                <i class="fa fa-images"></i> Documentations
                            </h3>
                        </div>
                        <div class="col-md-6 col-12 text-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                                <i class="fa fa-plus"></i> Add Document
                            </button>
                        </div>
                    </div>
                </div>
            </form> 

            <div class="card-body row">
                @if(isset($docs) && $docs->count() > 0)
                    @foreach ($docs as $doc)
                        <div class="col-md-4 col-sm-4 col-12 shadow-sm position-static mt-3">
                            <a href="{{ asset('storage/upload/images/'.$doc->image) }}" data-lightbox="lightbox-img" data-title="{{ $doc->caption }}" data-alt="{{ $doc->caption }}">
                                <img src="{{ asset('storage/upload/images/'.$doc->image) }}" alt="{{ $doc->caption }}" class="img-fluid">
                            </a>
                            <p class="mt-2">{{ $doc->caption }}</p> <!-- Display the caption below the image -->
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-danger border border-danger">Sorry, there are no files or documentations at the moment</div>
                @endif
            </div>

            <div class="card-footer">
                    
            </div>
            

        {{-- @foreach($documentations as $documentation)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ asset('storage/' . $documentation->image) }}" class="card-img-top" alt="Documentation Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $documentation->caption }}</h5>
                    </div>
                </div>
            </div>
            @endforeach --}}
            

    </div>
    @include('admin.documentations.partials._script')
    @include('admin.documentations.partials.modal')
@endsection