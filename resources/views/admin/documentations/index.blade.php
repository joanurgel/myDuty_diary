@extends('layouts.admin')

@section ('content')
<style>
    /* Define the initial state of the button */
    .btn {
      padding: 5px 10px;   
      color: #fff;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55);
      /* background-color: #3c34db; */
      border-radius: 10px;
      position: relative;
      overflow: hidden;
    }
    
    /* Define the hover state */
    .btn:hover {
      transform: translateY(-5px);
      /* background-color: #5247cc; */
      box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
    }

    /* Define the active state */
    .btn:active {
      transform: scale(0.95) translateY(2px);
    }
    
    /* Add a pseudo-element for the playful animation */
    .btn::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(45deg, #126994, #075395);
      opacity: 0;
      transform: scaleX(0);
      transform-origin: bottom left;
      transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55), opacity 0.3s ease;
      z-index: -1;
    }
    
    /* Define the hover state for the pseudo-element */
    .btn:hover::before {
      transform: scaleX(1);
      opacity: 1;
    }
</style>


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
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <i class="fas fa-images"></i>
                                New Documentations
                            </div>
                        <div class="col-md-6 col-12 text-md-right mt-3 mt-md-0">
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