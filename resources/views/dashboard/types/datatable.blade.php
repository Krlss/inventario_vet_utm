<script src="{{ asset('plugins/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/table.js') }}"></script>
<script type="text/javascript">
    $('#table').DataTable({
        responsive: true,
        autoWidth: false,
        order: [
            [3, "desc"]
        ],
        language: len,
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('types.index') }}",
        "columns": [{
                data: 'id',
            },
            {
                data: 'name'
            },
            {
                data: 'created_at'
            },
            {
                data: 'updated_at'
            },
            {
                data: 'actions',
                orderable: false,
                searchable: false
            }
        ]
    });
</script>