@extends('admin.main')

@section('content')
    <x-display-succ message="{{ session('message') }}" />
    <x-display-error name-input="reply-content" />
    <table class="table table-bordered" id="reviews-table">
        <thead>
            <tr>
                <th>{{ __('Product Id') }}</th>
                <th>{{ __('Product Image') }}</th>
                <th>{{ __('Description') }}</th>
                <th>{{ __('Reviews') }}</th>
            </tr>
        </thead>
    </table>
@endsection
{{-- Show Reviews --}}
<script id="details-template" type="text/x-handlebars-template"><table class="table details-table text-dark replies-table" id="reviews-@{{ id }}">
        <thead>
            <tr>
                <th>{{ __('Created at') }}</th>
                <th>{{ __('User id') }}</th>
                <th>{{ __('Content') }}</th>
                <th>{{ __('Reply') }}</th>
                <th>{{ __('Replies') }}</th>
            </tr>
        </thead>
    </table></script>
{{-- Show replies --}}
<script id="reviews-template" type="text/x-handlebars-template"><table class="table details-table text-dark" id="replies-@{{ id }}">
        <thead>
            <tr>
                <th>{{ __('Created at') }}</th>
                <th>{{ __('Content') }}</th>
                <th>{{ __('Delete') }}</th>
            </tr>
        </thead>
    </table></script>

@section('scripts')
    <script>
        $(function() {
            //Render handles bar to html
            var template = Handlebars.compile($("#details-template").html());
            var repliesTemplate = Handlebars.compile($("#reviews-template").html());

            const table = $('#reviews-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.reviews.showAll') !!}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        "className": 'details-control',
                        "orderable": false,
                        "searchable": false,
                        "data": null,
                        "defaultContent": ''
                    },
                ]
            });

            // Add event listener for opening and closing details
            $('#reviews-table tbody').on('click', 'td.details-control', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var tableId = 'reviews-' + row.data().id;

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
                            {
                                data: 'created_at',
                                name: 'created_at'
                            },
                            {
                                data: 'user_id'
                            },
                            {
                                data: 'content',
                                name: 'content'
                            },
                            {
                                data: 'reply'
                            },
                            {
                                data: 'replies-control'
                            }
                        ],
                    });

                    // Add event listener for opening and closing replies details
                    $('.replies-table tbody').on('click', 'button.replies-control', function() {
                        var tr = $(this).closest('tr');
                        var row = tableDetails.row(tr);
                        var tableId = 'replies-' + row.data().id;

                        if (row.child.isShown()) {
                            // This row is already open - close it
                            row.child.hide();
                            tr.removeClass('shown');
                        } else {
                            // Open this row
                            row.child(repliesTemplate(row.data())).show();
                            initTableReplies(tableId, row.data());
                            tr.addClass('shown');
                            tr.next().find('td').addClass('no-padding bg-gray');
                        }

                        function initTableReplies(tableId, data) {
                            tableReplies = $('#' + tableId).DataTable({
                                processing: true,
                                serverSide: true,
                                ajax: data.replies_url,
                                columns: [
                                    // data for display and name for search (filter)
                                    {
                                        data: 'created_at',
                                        name: 'created_at'
                                    },
                                    {
                                        data: 'content'
                                    },
                                    {
                                        data: 'destroy'
                                    }
                                ],
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
