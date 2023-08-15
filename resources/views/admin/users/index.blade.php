@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 col-12">
                    <i class="fas fa-solid fa-users"></i>
                    Users
                </div>
                <div class="col-md-6 col-12 text-right">
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">New User</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="users_table" class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $count++ }}</td>
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
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <button onclick="confirmDelete({{ $user->id }})" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if(session('success'))
                <div class="alert alert-success mb-0">
                    <strong>Success!</strong> {{ session('success') }}
                </div>
            @endif
        </div>
    </div>

    <!-- SweetAlert and JavaScript Code -->
    <script>
        function confirmDelete(userId) {
            // Show the SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                // icon: 'warning',
                showCancelButton: true,
                imageUrl: "{{ asset("assets/icon/dogs.jpg") }}", // Replace this with the actual image URL
                imageHeight: 200,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send the AJAX request to delete the user
                    fetch(`/users/${userId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    }).then(response => response.json())
                    .then(data => {
                        Swal.fire({
                            title: 'Deleted!',
                            text: data.message,
                            icon: 'success',
                            timer: 2500,
                            showConfirmButton: false
                        }).then(() => location.reload()); // Reload the page after successful deletion
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    // Handle cancel action (optional)
                    Swal.fire('Cancelled', 'Your imaginary file is safe :)', 'error');
                }
            });
        }
    </script> 

@include('admin.documentations.partials._script')
@include('admin.users.partials.datatable_script')
@endsection
