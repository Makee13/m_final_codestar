@extends('admin.main')

@section('content')
    @include('admin.error')
    <x-display-succ message="{{session('success')}}" />
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="name">{{__('Tiêu đề')}}</label>
                    <input type="text" class="form-control" id="name" placeholder="Nhập tên slider" name="name"
                        value="{{ old('name') }}" />
                    <x-display-error name-input='name' />
                </div>

                <div class="form-group col-md-6">
                    <label for="url">{{__('Đường dẫn')}}</label>
                    <input type="text" class="form-control" id="url" placeholder="Nhập đường dẫn slider" name="url"
                        value="{{ old('url') }}" />
                    <x-display-error name-input='url' />
                </div>
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Ảnh</label>
                <input class="form-control" name="image" style="height: auto!important;" type="file" id="image-product" />
                <div id="image-show" class="mt-3">
                    {{-- Image show --}}
                </div>
                <input type="hidden" name="thumb" id="file" />
                <x-display-error name-input='file' />
            </div>

            <div class="form-group">
                <label for="sort_by">{{__('Thứ tự chạy')}}</label>
                <input type="number" class="form-control" id="sort_by" placeholder="Thứ tự sắp xếp" name="sort_by"
                    value="{{ old('sort_by') }}" min="0" />
                <x-display-error name-input='sort_by' />
            </div>

            <div class="form-check col-md-6">
                <input name="active" type="checkbox" class="form-check-input" id="active"
                    {{ old('active') === 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="active">{{__('Kích hoạt')}}</label>
            </div>

        </div>
        @csrf

        <div class="card-footer">
            <button name="submit" type="submit" class="btn btn-primary">{{__('Thêm slider')}}</button>
        </div>
        <!-- /.card-body -->
    </form>
@endsection
