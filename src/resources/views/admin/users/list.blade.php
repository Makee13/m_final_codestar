@extends('admin.main')

@section('content')
    <x-display-succ message="{{session('message')}}" />
    <x-display-error name-input="block_message" />
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>{{__('Id')}}</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Phone number')}}</th>
                <th>{{__('Email')}}</th>
                <th>{{__('Created At')}}</th>
                <th>{{__('Updated At')}}</th>
                <th>{{__('Account status')}}</th>
                <th>{{__('Block')}}</th>
                <th>{{__('UnBlock')}}</th>
            </tr>
        </thead>
    </table>
@endsection

@section('scripts')

    <script>
        $(function() {
            //Render handles bar to html

            const masterUsersTable = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.users.showAllUsers') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'phone'},
                    { data: 'email'},
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'block-status'},
                    { data: 'block-control'},
                    { data: 'unblock-control'},
                ]
            });
        });
    </script>
@endsection