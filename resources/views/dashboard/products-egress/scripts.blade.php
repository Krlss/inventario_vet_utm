<script src="{{ asset('plugins/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/buttons.html5.min.js') }}"></script>

<script src="{{ asset('json/table.json') }}"></script>
<script type="text/javascript">
    fetch_data({
        search: '',
        date: null
    });

    function fetch_data(params) {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            responsive: true,
            autoWidth: false,
            order: [
                [0, "desc"]
            ],
            dom: "<'d-flex justify-content-between'<B><l>>trip",
            buttons: [{
                extend: 'collection',
                className: 'exportButton',
                text: 'Exportar',
                buttons: [{
                    extend: 'excel',
                    text: 'Excel',
                    title: 'Reporte de egresos de productos ' + new Date().toLocaleDateString(),
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }, {
                    extend: 'csv',
                    text: 'CSV',
                    title: 'Reporte de egresos de productos ' + new Date().toLocaleDateString(),
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }]
            }],
            dataType: 'json',
            language: len,
            ajax: {
                url: "{{ route('dashboard.products-egress.index') }}",
                data: {
                    search: params.search,
                    date: params.date
                },
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'detail',
                    name: 'detail'
                },
                {
                    data: 'products[]',
                    render: function(data, type, row, meta) {
                        return data.length
                    }
                },
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    }

    $('.filter-input').keyup(function() {
        var search = $('#search').val();
        var date = $('#date').val();
        $('#table').DataTable().clear().draw();
        $('#table').DataTable().destroy();
        fetch_data({
            search,
            date
        })
    });


    $('.filter-select').change(function() {
        var search = $('#search').val();
        var date = $('#date').val();
        console.log(date)
        $('#table').DataTable().clear().draw();
        $('#table').DataTable().destroy();
        fetch_data({
            search,
            date
        })
    });
</script>