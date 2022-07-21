@extends('admin.main')

@section('content')
    @include('admin.error')
    @if (session('success'))
        <x-display-succ message="{{ session('success') }}" />
    @endif
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="card-body">

            <div class="form-group">
                <label for="title">{{ __('Tiêu đề thông báo') }}</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title') }}" />
                <x-display-error name-input='title' />
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="content">{{ __('Nội dung thông báo') }}</label>
                    <textarea class="form-control" name="content" id="content"
                        placeholder="Nhập nội dung thông báo">{{ old('content') }}</textarea>
                    <x-display-error name-input='content' />
                </div>
            </div>

            <div class="form-group">
                <label for="content">{{ __('Loại thông báo') }}</label>
                <select class="form-control" name="notice_types" id="noticeTypes">
                    <option class="text-warning" value="warn">{{ __('Cảnh báo') }}</option>
                    <option class="text-success" value="confirmed">{{ __('Xác nhận') }}</option>
                    <option class="text-info" value="ads">{{ __('Quảng cáo') }}</option>
                </select>
                <x-display-error name-input='notice_types' />
            </div>

            <div class="form-group">
                <label for="users" class="d-block">{{ __('Áp dụng cho người dùng') }}</label>
                <span
                    class="text text-muted d-block mt-0 mb-4">{{ __('Giữ Ctrl(window) + click hoặc Cmd (mac) + click để áp dụng cho nhiều sản phẩm') }}</span>
                <span class="text-muted"></span>
                <select class="form-control"name="users[]" id="users" multiple>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">
                            {{__('Name')}}:| {{ $user->name }}
                            {{__('Email')}}:| {{ $user->email }}
                        </option>
                    @endforeach
                </select>
                <x-display-error name-input='users' />

                <div class="form-check">
                    <input name="send_all" type="checkbox" class="form-check-input" id="sendAll"
                        {{ old('send_all') === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="sendAll">{{ __('Gửi cho tất cả người dùng') }}</label>
                </div>
            </div>

            <div class="form-group">
                <label for="image" class="form-label">{{ __('Ảnh thông báo') }}</label>
                <input disabled class="form-control" style="height: auto!important;" type="file" id="image-product" />
                <div id="image-show" class="mt-3">
                    {{-- Image show --}}
                </div>
                <input disabled type="hidden" name="thumb" id="file" />
                <x-display-error name-input='thumb' />
            </div>
        </div>
        @csrf

        <div class="card-footer">
            <button name="submit" type="submit" class="btn btn-primary">{{ __('Thêm thông báo') }}</button>
        </div>
        <!-- /.card-body -->
    </form>
@endsection

@section('js')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('scripts')
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace('content');
    </script>
@endsection
