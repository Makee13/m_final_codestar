@extends('common.main')

@section('style')
    <style>
        table thead tr {
            border-bottom: none!important;
        }
        tfoot tr {
            border-top: none!important;
        }

        .notification-container {
            display: block;
            max-height: 500px;
            overflow-y: auto;
        }
        .notification-container > tr {
            display: flex;
        }
        .notification-container::-webkit-scrollbar {
            width: 3px;
        }
    </style>
@endsection
@section('middle')
    <!-- breadcrumb -->
    <div class="container m-t-100">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('home') }}" class="stext-109 cl8 hov-cl1 trans-04">
                {{ __('Home') }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                {{ __('Notifications') }}
            </span>
        </div>
    </div>

    @if (count($notifications) > 0)
        <!-- Shoping Cart -->
        <form class="bg0 p-t-75 p-b-85">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-xl-12 m-lr-auto m-b-50">
                        <div class="m-l-25 m-r--38 m-lr-0-xl">
                            <div class="wrap-table-shopping-cart">
                                <table class="table-shopping-cart">
                                    <thead>
                                        <tr class="table_head">
                                            <th class="column-1">{{ __('Notification') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="notification-container">
                                        @foreach ($notifications as $notification)
                                            <tr class="table_row" style="height:unset;">
                                                <td class="column-1" style="display: flex;margin-top: 20px;width: 100%;position: relative;">
                                                    @if ($notification->image)
                                                    <a class="how-itemcart1 mr-20">
                                                        <img src="{{ $notification->image }}" alt="IMG">
                                                    </a>
                                                    @endif
                                                    <div>
                                                        <strong class="d-block @if($notification->notice_types == 'warn') text-danger @elseif($notification->notice_types == 'confirmed') text-primary @else text-success @endif ">
                                                            {{ \Str::upper($notification->title) }}
                                                        </strong>
                                                        {!! $notification->content !!}
                                                    </div>
                                                    @if($notification->userNotifications->firstWhere('is_read', 'unread'))
                                                        <span style="position: absolute; top: -10px; right: 10px; color: #6c7ae0; font-size: 10px;">
                                                            <i class="fa fa-solid fa-circle"></i>       
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr><td class="column-5 p-t-10 p-b-10"><a href="{{route('notifications.update')}}" class="text-info" style="text-decoration: underline;" href="">{{ __('Mark messages as read') }}</a></td></tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif
@endsection
