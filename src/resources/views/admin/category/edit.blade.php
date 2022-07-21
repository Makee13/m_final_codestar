@extends('admin.main')

@section('content')
    @include('admin.error')
    <x-display-succ message="{{session('success')}}" />

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="name">{{__('Tên danh mục')}}</label>
                <input type="text" class="form-control" id="name" placeholder="Nhập tên danh mục" name="name"
                    @if ($errors->any()) value="{{ old('name') }}" @else value="{{ $category->name }}" @endif />
                <x-display-error name-input='name' />
            </div>

            <div class="form-group">
                <label for="parent">{{__('Danh mục cha')}}</label>
                <select class="form-control" name="parent_id" id="parent">
                    <option value="0" {{ $category->parent_id == 0 ? 'selected' : '' }}>{{__('Danh mục cha')}}</option>
                    @foreach ($categories as $cateItem)
                        @php
                            if ($cateItem->parent_id == 0) {
                                continue;
                            }
                        @endphp
                        <option value="{{ $cateItem->id }}"
                            {{ $category->parent_id == $cateItem->id ? 'selected' : '' }}>{{ $cateItem->name }}</option>
                    @endforeach
                </select>
                <x-display-error name-input='parent_id' />
            </div>

            <div class="form-group">
                <label for="description">{{__('Mô tả ngắn')}}</label>
                <textarea class="form-control" name="description" id="description" placeholder="Nhập mô tả">@if ($errors->any()){{ old('description') }}@else{{ $category->description }}@endif</textarea>
                <x-display-error name-input='description' />
            </div>

            <div class="form-group">
                <label for="content">{{__('Mô tả chi tiết')}}</label>
                <textarea class="form-control" name="content" id="content" placeholder="Nhập mô tả">@if ($errors->any()){{ old('content') }}@else{{ $category->content }}@endif</textarea>
                <x-display-error name-input='content' />
            </div>

            <div class="form-group">
                <label for="image" class="form-label">{{__('Ảnh danh mục')}}</label>
                <input name="image" class="form-control" style="height: auto!important;" type="file" id="image-product" value="{{$category->image}}" />
                <div id="image-show" class="mt-3">
                    <a href="{{$category->image}}" target="_blank">
                        <img src="{{$category->image}}" alt="Category image" width="100px">
                    </a>
                </div>
                <input type="hidden" name="thumb" id="file" value="{{$category->image}}"/>
                <x-display-error name-input='image' />
                <x-display-error name-input='thumb' />
            </div>

            <div class="form-check">
                <input name="active" type="checkbox" class="form-check-input" id="active"
                    @if ($errors->any()) {{ old('active') }} @else {{ $category->active ? 'checked' : '' }} @endif>
                <label class="form-check-label" for="active">{{__('Kích hoạt')}}</label>
            </div>
        </div>
        <!-- /.card-body -->
        @csrf

        <div class="card-footer">
            <button name="submit" type="submit" class="btn btn-primary">{{__('Chỉnh sửa danh mục sản phẩm')}}</button>
        </div>
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
