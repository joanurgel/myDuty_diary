@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            Edit User
        </div>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="inputEmail4">Name</label>
                        <input type="text" class="form-control" id="inputEmail4" placeholder="Name" name="name" required value="{{ $user->name }}">
                    </div>                        
                    <div class="form-group col-md-4">
                        <label for="inputRole">Role</label>
                        <select name="role" id="inputRole" class="form-control" required>
                            <option value="" enabled>Select a Role</option>
                            <option value="1" @if($user->role === 1) selected @endif>Administrator</option>
                            <option value="2" @if($user->role === 2) selected @endif>Supervisor</option>
                            <option value="3" @if($user->role === 3) selected @endif>Trainee</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email" required value="{{ $user->email }}">
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="p-0 m-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="card-footer">
                <!-- Add the SweetAlert confirmation on click of the Update button -->
                <button type="button" onclick="confirmUpdate()" class="btn btn-success btn-sm">Update</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
            </div>
        </form>
    </div>

    <!-- SweetAlert and JavaScript Code -->
    <script>
        function confirmUpdate() {
            // Show the SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure you want to update?',
                // text: "You won't be able to revert this!",
                // icon: 'warning',
                imageUrl: "{{ asset("assets/icon/dog.jpg") }}",
                imageHeight: 200,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user confirms the update, submit the form
                    document.querySelector('form').submit();
                    // You can also use jQuery to submit the form, if jQuery is included in your project
                    // $('form').submit();
                }
            });
        }
    </script>
@endsection
