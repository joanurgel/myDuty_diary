@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 col-12">
                    <i class="fas fa-solid fa-book-open"></i>
                    Diaries
                </div>
                <div class="col-md-6 col-12 text-right">
                    <a href="{{ route('diaries.create') }}" class="btn btn-sm btn-primary">New Diary</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Action</th>
                        <th scope="col">Title</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($diaries as $diary)
                        <tr>
                            <td>{{ $diary->id }}</td>
                            <td>
                                <!-- Add any action buttons or links here -->
                                <a href="{{ route('diaries.edit', $diary->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('diaries.destroy', $diary->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this diary entry?')">Delete</button>
                            </form>
                            </td>
                            <td> 
                                EOD REPORT for {{ $diary->created_at->format('F d, Y') }} by {{ $diary->author->name }}
                                
                            </td>
                            <td>
                                @if ($diary->status == 1)
                                    <span class="badge badge-success">Pending</span>
                                @else
                                    <span class="badge badge-success">Approve</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


