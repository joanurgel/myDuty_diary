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

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 col-12">
                <i class="fas fa-solid fa-book-open"></i>
                Diaries
            </div>
            <div class="col-md-6 col-12 text-md-right mt-3 mt-md-0">
                <a href="{{ route('diaries.create') }}" class="btn btn-sm btn-primary">New Diary</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="diaries-table" class="table table-sm table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Action</th>
                    <th scope="col">Title</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $counter = 1; // Initialize the counter
                @endphp
                @foreach ($diaries as $diary)
                    <tr>
                        <td>{{ $counter }}</td>
                        <td>
                            <!-- Add any action buttons or links here -->
                            <a href="{{ route('diaries.show', $diary->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('diaries.edit', $diary->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('diaries.destroy', $diary->id) }}" method="POST" class="d-inline diary-delete-form">
                                @csrf
                                @method('DELETE')
                                <button onclick="confirmDelete({{ $diary->id }})" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                        <td> 
                            EOD REPORT for {{ now()->format('F d, Y') }} by {{ $diary->author->name }}
                        </td>                                                      
                        {{-- <td>
                            @if ($diary->status == 1)
                                <span class="badge badge-success">Pending</span>
                            @else
                                <span class="badge badge-success">Approved</span>
                            @endif
                        </td> --}}
                        <td>
                            @if ($diary->status == 0)
                                <span class="badge badge-warning">Pending</span>
                            @else
                                <span class="badge badge-success">Approved</span>
                            @endif
                        </td>
                    </tr>
                    @php
                        $counter++; // Increment the counter for the next row
                    @endphp
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
                { "orderable": true } // Disable sorting for columns 0 and 1 (Action and Title)
            ]
        });
    });
</script>
@endsection
