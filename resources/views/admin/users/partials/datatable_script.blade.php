<script>
    $(document).ready(function () {
        // Initialize DataTable
        $('#users_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('users.index') }}', // Make sure this route points to your data source
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'index'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'role',
                    name: 'role',
                    render: function (data) {
                        if (data === 1) {
                            return '<span class="badge badge-danger">Administrator</span>';
                        } else if (data === 2) {
                            return '<span class="badge badge-warning">Supervisor</span>';
                        } else if (data === 3) {
                            return '<span class="badge badge-secondary">Trainee</span>';
                        } else {
                            return 'No Role';
                        }
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ],
            "order": [[3, 'asc']]
        });
    });
</script>
