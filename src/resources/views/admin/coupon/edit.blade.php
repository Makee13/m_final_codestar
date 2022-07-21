@extends('admin.main')

@section('content')
    @include('admin.error')
    <x-display-succ message="{{session('success')}}" />
    <x-alert />
    
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="card-body">

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="code">{{ __('Mã coupon') }}</label>
                    <input type="text" class="form-control" id="code" placeholder="Nhập mã coupon" name="code"
                        value="{{ $coupon->code }}" />
                    <x-display-error name-input='code' />
                </div>
                <div class="form-group col-md-4">
                    <label for="name">{{ __('Tên coupon') }}</label>
                    <input type="text" class="form-control" id="name" placeholder="Nhập tên coupon" name="name"
                        value="{{ $coupon->name }}" />
                    <x-display-error name-input='name' />
                </div>
                <div class="form-group col-md-4">
                    <label for="description">{{ __('Mô tả') }}</label>
                    <input type="text" class="form-control" id="description" placeholder="Nhập mô tả coupon"
                        name="description" value="{{ $coupon->description }}" />
                    <x-display-error name-input='description' />
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="decreased_price">{{ __('Giá giảm') }}</label>
                    <input type="text" class="form-control" id="decreased_price" placeholder="Nhập giá giảm"
                        name="decreased_price" value="{{ $coupon->decreased_price }}" />
                    <x-display-error name-input='decreased_price' />
                </div>
                <div class="form-group col-md-6">
                    <label for="expired_date">{{ __('Ngày hết hạn') }}</label>
                    <input type="date" class="form-control" id="expired_date" placeholder="Nhập ngày hết hạn"
                        name="expired_date" value="{{ $coupon->expired_date->format('Y-m-d') }}" />
                    <x-display-error name-input='expired_date' />
                </div>
            </div>

        </div>
        @csrf

        <div class="card-footer">
            <button name="submit" type="submit" class="btn btn-primary">{{ __('Cập nhật coupon') }}</button>
        </div>
        <!-- /.card-body -->
    </form>
@endsection

