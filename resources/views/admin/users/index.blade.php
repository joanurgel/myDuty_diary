@extends('layouts.admin')

@section('content')
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
      background: linear-gradient(45deg, #126994, #073b95);
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

    {{-- <div class="card"> --}}
            {{-- <div class="row">
                <div class="col-md-6 col-12">
                    <h3 class="mb-2 mb-md-0">
                        <i class="fas fa-solid fa-users"></i> Users
                    </h3>
                </div> --}}
                {{-- <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <i class="fas fa-solid fa-users"></i>
                            Users
                        </div>
                <div class="col-md-6 col-12 text-md-right mt-3 mt-md-0">
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">New User</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="users-table" class="table table-sm table-hover">
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
                                    <span class="badge badge-primary">Administrator</span>
                                @elseif ($user->role == 2)
                                    <span class="badge badge-warning">Supervisor</span>
                                @elseif ($user->role == 3)
                                    <span class="badge badge-secondary">Trainee</span>
                                @else
                                    No Role
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="confirmDelete({{ $user->id }})" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
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
    </div> --}}
    @section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 col-12">
                    <i class="fas fa-solid fa-users"></i>
                    Users
                </div>
                {{-- <div class="col-md-6 col-12 text-right">
                    
                </div> --}}
            </div>
        </div>
        <div class="card-body p-1">
            <table class="table table-sm table-hover mb-0" id="users-table">
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
              </tbody>
            </table>
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
                reverseButtons: false
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

{{-- <script>
    $(document).ready(function () {
        $('#users-table').DataTable({
            "columnDefs": [
                { "orderable": true } // Disable sorting for columns 0 and 1 (Action and Title)
            ]
        });
    });
</script> --}}

@include('admin.users.partials.datatable_script')
@endsection
