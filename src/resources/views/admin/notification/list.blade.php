 @extends('admin.main')

@section('content')
    <x-display-succ message="{{session('success')}}" />
    <table class="table table-bordered" id="notifications-table">
        <thead>
            <tr>
                <th>{{__('Id')}}</th>
                <th>{{__('Content')}}</th>
                <th>{{__('Notice Type')}}</th>
                <th>{{__('Created at')}}</th>
                <th>{{__('Updated at')}}</th>
                <th style="width: 50px;">{{__('Update')}}</th>
                <th style="width: 50px;">{{__('Destroy')}}</th>
            </tr>
        </thead>
    </table>
@endsection

@section('scripts')
    <script>
        $(function() {
            const masterNotificationsTable = $('#notifications-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.notifications.showAll') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'content', name: 'content' },
                    { data: 'notice_types', name: 'notice_types' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'update', orderable: false, searchable: false},
                    { data: 'destroy', orderable: false, searchable: false},
                ]
            });

        });
    </script>
@endsection
