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
        type: '',
        category: '',
        search: ''
    });

    function fetch_data(params) {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            responsive: true,
            autoWidth: false,
            dataType: 'json',
            dom: "<'d-flex justify-content-between'<B><l>>trip",
            buttons: [{
                extend: 'collection',
                className: 'exportButton',
                text: 'Exportar',
                buttons: [{
                    extend: 'excel',
                    text: 'Excel',
                    title: 'Reporte de productos ' + new Date().toLocaleDateString(),
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                }, {
                    extend: 'csv',
                    text: 'CSV',
                    title: 'Reporte de productos ' + new Date().toLocaleDateString(),
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                }]
            }],
            language: len,
            order: [
                [0, "desc"]
            ],
            ajax: {
                url: "{{ route('dashboard.inventory.index') }}",
                data: {
                    type: params.type,
                    category: params.category,
                    search: params.search
                }
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'stock',
                    name: 'stock',
                    searchable: false,
                },
                {
                    data: 'unit.name',
                    name: 'unit.name',
                    searchable: false,
                },
                {
                    data: 'amount',
                    name: 'amount',
                    searchable: false,
                },
                {
                    data: 'cost',
                    name: 'cost',
                    searchable: false,
                },
                {
                    data: 'types[].name',
                    name: 'types[].name',
                    orderable: false,
                    render: function(data, type, row, meta) {
                        var small = '';
                        data.forEach(e => {
                            small +=
                                `<span class='badge badge-primary truncate max-w-100px text-left'>${e}</span><br>`;
                        })
                        return small;
                    }
                },
                {
                    data: 'categories[].name',
                    name: 'categories[].name',
                    orderable: false,
                    render: function(data, type, row, meta) {
                        var small = '';
                        data.forEach(e => {
                            small +=
                                `<span class='badge badge-primary truncate max-w-100px text-left'>${e}</span><br>`;
                        })
                        return small;
                    }
                },
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false,
                },

            ]
        });
    }

    $('.filter-input').keyup(function() {
        var type_id = $('#type').val();
        var category_id = $('#category').val();
        var search = $('#search').val();
        $('#table').DataTable().clear().draw();
        $('#table').DataTable().destroy();
        fetch_data({
            search: search,
            category: category_id,
            type: type_id
        })
    });

    $('.filter-select').change(function() {
        var type_id = $('#type').val();
        var category_id = $('#category').val();
        $('#table').DataTable().clear().draw();
        $('#table').DataTable().destroy();
        fetch_data({
            search: '',
            category: category_id,
            type: type_id
        })
    });
</script>