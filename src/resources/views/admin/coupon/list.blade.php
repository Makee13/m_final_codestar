@extends('admin.main')

@section('content')
    <x-display-succ message="{{session('success')}}" />
    <table class="table table-bordered" id="coupons-table">
        <thead>
            <tr>
                <th>{{__('Code')}}</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Description')}}</th>
                <th>{{__('Descreased price')}}</th>
                <th>{{__('Expired date')}}</th>
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
            const masterCouponsTable = $('#coupons-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.coupon.showAll') !!}',
                columns: [
                    { data: 'code', name: 'code' },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'decreased_price', name: 'decreased_price' },
                    { data: 'expired_date', name: 'expired_date' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'update', orderable: false, searchable: false},
                    { data: 'destroy', orderable: false, searchable: false},
                ]
            });

        });
    </script>
@endsection