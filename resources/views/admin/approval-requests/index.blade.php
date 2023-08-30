@extends('layouts.admin')

@section('content')
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
            <table class="table table-sm table-hover" id="approval-requests-table">
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
                    @foreach ($approvalRequests as $diary)
                    <tr>
                        <td>{{ $diary->id }}</td>
                        <td>
                            <form method="POST" action="{{ route('approval-requests.approve', $diary->id) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Approve</button>
                            </form>

                            <form method="POST" action="{{ route('approval-requests.reject', $diary->id) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                            </form>
                        </td>
                        <td>
                            EOD REPORT for {{ $diary->created_at->format('F d, Y') }} by {{ $diary->author->name }}
                        </td>
                        <td>{{ $diary->author->name }}</td>
                        <td>
                            @if ($diary->status == 0)
                                <span class="badge badge-warning">Pending</span>
                            @else
                                <span class="badge badge-success">Approved</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
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
@endsection
