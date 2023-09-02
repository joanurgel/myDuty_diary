@extends('layouts.admin')

@section('content')
{{-- <style>  
    .btn,
    .card-body img {
        max-width: 100%;
        height: auto;
        transition: transform 0.3s ease;
        margin: 10px;
    }

    .btn {
        padding: 5px 10px;
        color: #fff;
        border: none;
        cursor: pointer;
        border-radius: 10px;
        position: relative;
        overflow: hidden;
    }

        .btn:hover,
        .card-body img:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
        }

        .btn:active {
            transform: scale(0.95) translateY(2px);
        }
        

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

        .btn:hover::before {
            transform: scaleX(1);
            opacity: 1;
        }

        .card-body p {
            position: relative;
            top: 0;
            transition: top 0.3s ease, background-color 0.3s ease;
        }

        .card-body img:hover + p {
            top: -30px;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 5px;
        }
</style> --}}

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 col-12">
                    <i class="fas fa-solid fa-book-open"></i>
                    Approval Requests
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm table-hover" id="approval-requests-DataTable">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                        <th scope="col">Action</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            @if(isset($diaryApproved))
                <div class="alert alert-success">
                    {{ $diaryApproved }}
                </div>
            @elseif(isset($diaryRejected))
                <div class="alert alert-danger">
                    {{ $diaryRejected }}
                </div>
            @endif
        </div>
    </div>
    @include('admin.approval-requests.partials.datatable_script')
    @include('admin.approval-requests.partials.approval_script')


@endsection