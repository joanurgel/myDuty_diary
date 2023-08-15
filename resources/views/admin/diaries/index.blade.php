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
            <table id="diaries-table" class="table table-sm table-striped">
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
                                <form action="{{ route('diaries.destroy', $diary->id) }}" method="POST" class="d-inline diary-delete-form"> <!-- Add the class "diary-delete-form" here -->
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button> <!-- Remove the onclick attribute here -->
                                </form>
                            </td>
                            <td> 
                                EOD REPORT for {{ $diary->created_at->format('F d, Y') }} by {{ $diary->author->name }}
                                
                            </td>
                            <td>
                                @if ($diary->status == 1)
                                    <span class="badge badge-success">Pending</span>
                                @else
                                    <span class="badge badge-success">Approve</span> <!-- Change badge color to danger for "Approve" status -->
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if (session('success'))
                <div class="alert alert-success mt-4">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>

    <!-- SweetAlert and JavaScript Code -->
    <script>
        document.querySelectorAll('.diary-delete-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the form from submitting

                const formElement = this;

                // Show the SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    imageUrl: "{{ asset("assets/icon/dogs.jpg") }}", // Replace this with the actual image URL
                    imageHeight: 200,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form after SweetAlert confirmation
                        formElement.submit();
                    }
                });
            });
        });
    </script>

<script>
    $(document).ready(function () {
        $('#diaries-table').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": [0, 1] } // Disable sorting for columns 0 and 1 (Action and Title)
            ]
        });
    });
</script>
@endsection
