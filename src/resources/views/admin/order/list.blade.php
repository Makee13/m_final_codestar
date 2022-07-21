@extends('admin.main')

@section('header')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
@endsection

@section('content')
    <x-display-succ message="{{session('message')}}" />
    <table class="table table-bordered" id="orders-table">
        <thead>
            <tr>
                <th>{{__('Order Id')}}</th>
                <th>{{__('Total order')}}</th>
                <th>{{__('Phone number')}}</th>
                <th>{{__('Email')}}</th>
                <th>{{__('Province/City')}}</th>
                <th>{{__('District')}}</th>
                <th>{{__('Ward/Commune')}}</th>
                <th>{{__('Created At')}}</th>
                <th>{{__('Updated At')}}</th>
                <th>{{__('Status')}}</th>
                <th>{{__('Payment Status')}}</th>
                <th style="width: 50px;">{{__('Confirm order')}}</th>
                <th style="width: 20px;">{{__('Confirm delivered order')}}</th>
                <th>{{__('Details')}}</th>
            </tr>
        </thead>
    </table>
@endsection

<script id="details-template" type="text/x-handlebars-template">
    <table class="table details-table text-dark" id="orders-@{{id}}">
        <thead>
            <tr>
                <th>{{__('Image')}}</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Description')}}</th>
                <th>{{__('Amount')}}</th>
            </tr>
        </thead>
    </table>
</script>

@section('scripts')

    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>

    <script>
        $(function() {
            //Render handles bar to html
            var template = Handlebars.compile($("#details-template").html());

            const orderIdIndex      = 0;
            const totalIndex        = 1;
            const phoneIndex        = 2;
            const emailIndex        = 3;
            const provinceIndex     = 4;
            const districtIndex     = 5;
            const communeIndex      = 6;
            const statusOrderIndex  = 9;

            const masterOrdersTable = $('#orders-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.orders') !!}',
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ orderIdIndex, totalIndex, phoneIndex, emailIndex, provinceIndex, districtIndex, communeIndex, statusOrderIndex ]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [ orderIdIndex, totalIndex, phoneIndex, emailIndex, provinceIndex, districtIndex, communeIndex, statusOrderIndex ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ orderIdIndex, totalIndex, phoneIndex, emailIndex, provinceIndex, districtIndex, communeIndex, statusOrderIndex ]
                        }
                    },
                    'copyHtml5',
                ],
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'total', name: 'total_price' },
                    { data: 'phone', searchable: false},
                    { data: 'email', searchable: false},
                    { data: 'province', searchable: false},
                    { data: 'district', searchable: false},
                    { data: 'commune', searchable: false},
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'status-confirm', name: 'status' },
                    { data: 'payment-status', name: 'payment_status' },
                    { data: 'confirm', orderable: false, searchable: false},
                    { data: 'status-delivered', orderable: false, searchable: false},
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "searchable":      false,
                        "data":           null,
                        "defaultContent": ''
                    },
                ],
            });

            // Add event listener for opening and closing details
            $('#orders-table tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = masterOrdersTable.row(tr);
                var tableId = 'orders-' + row.data().id;

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(template(row.data())).show();
                    initTable(tableId, row.data());
                    tr.addClass('shown');
                    tr.next().find('td').addClass('no-padding bg-gray');
                }

                function initTable(tableId, data) {
                    tableDetails = $('#' + tableId).DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: data.details_url,
                        columns: [
                            // data for display and name for search (filter)
                            { data: 'image'},
                            { data: 'name', name: 'name' },
                            { data: 'description', 'name': 'description' },
                            { data: 'amount_order_product', name: 'amount_order_product' },
                        ],
                        searching: false,
                    });
                }
            });
        });
    </script>
@endsection
