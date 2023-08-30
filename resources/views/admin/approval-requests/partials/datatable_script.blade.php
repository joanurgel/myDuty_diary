<script>
    $(document).ready(function () {
        $('#approval-requests-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('approval-requests.index') }}', // Check this URL
            columns: [
                {
                    data: 'DT_RowIndex', // Ensure this matches your JSON structure
                    name: 'index'
                },
                {
                    data: 'action', // Ensure this matches your JSON structure
                    name: 'action',
                    orderable: false
                },
                {
                    data: 'title', // Ensure this matches your JSON structure
                    name: 'title'
                },
                {
                    data: 'author', // Ensure this matches your JSON structure
                    name: 'author'
                },
                {
                    data: 'status', // Ensure this matches your JSON structure
                    name: 'status'
                },
            ],
            order: [[4, 'asc']] // Check this column index
        });
    });
</script>
