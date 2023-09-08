@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <i class="fas fa-solid fa-edit"></i> Edit Diary
        </div>
        <form action="{{ route('diaries.update', $diary->id) }}" method="POST" id="edit-diaries-form">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="todays-plan">Today's Plan</label>
                    <textarea class="form-control" id="todays-plan" name="plantoday" rows="3">{{ old('plantoday', $diary->plan_today) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="eod">End of Day Report</label>
                    <textarea class="form-control" id="eod" name="eod" rows="3">{{ old('eod', $diary->end_day) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="roadblocks">Roadblocks</label>
                    <textarea class="form-control" id="roadblocks" name="roadblocks" rows="3">{{ old('roadblocks', $diary->roadblocks) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="summary">Summary of the Day</label>
                    <textarea class="form-control" id="summary" name="summary" rows="3">{{ old('summary', $diary->summary) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="tomorrows-plan">Tomorrow's Plan</label>
                    <textarea class="form-control" id="tomorrows-plan" name="plantomorrow" rows="3">{{ old('plantomorrow', $diary->plan_tomorrow) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="supervisor">Supervisor</label>
                    <select name="supervisor" id="supervisor" class="custom-select">
                        <option value="" selected disabled>Select Supervisor</option>
                        @foreach ($supervisors as $supervisor)
                            <option value="{{ $supervisor->id }}" {{ $diary->supervisor_id === $supervisor->id ? 'selected' : '' }}>
                                {{ $supervisor->name }}
                            </option>
                        @endforeach
                    </select>
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
                <button type="submit" class="btn btn-success btn-sm">Update</button>
                <a href="{{ route('diaries.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
            </div>
        </form>
    </div>


    <!-- SweetAlert and JavaScript Code -->
   <script>
    document.getElementById('edit-diaries-form').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            // Show the SweetAlert success message
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Diary Updated Successfully', // Modify the message for editing
                showConfirmButton: false,
                timer: 3000
            });

            // Delay the form submission by 3 seconds (3000 milliseconds)
            setTimeout(() => {
                this.submit(); // Submit the form after a delay
            }, 3000);
        });
</script>
@endsection
