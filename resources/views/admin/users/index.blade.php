@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 col-12">
                    <i class=""></i>
                    Users
                </div>
                <div class="col-md-6 col-12 text-right">
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">New User</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Action</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                </form>
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->role == 1)
                                <span class="badge badge-danger">Administrator</span>
                                @elseif ($user->role == 2)
                                <span class="badge badge-warning">Supervisor</span>
                                @elseif ($user->role == 3)
                                <span class="badge badge-secondary">Trainee</span>
                                @else
                                    No Role
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection