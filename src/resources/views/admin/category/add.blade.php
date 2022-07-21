@extends('admin.main')

@section('content')
    {{-- Alert section --}}
    @include('admin.error')
    <x-display-succ message="{{session('success')}}" />
    {{-- Alert section --}}
    
    {{-- Form section --}}
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="name">{{__('Tên danh mục')}}</label>
                <input type="text" class="form-control" id="name" placeholder="Nhập tên danh mục" name="name"
                    @if ($errors->any()) value="{{ old('name') }} @endif" />
                <x-display-error name-input='name' />
            </div>

            <div class="form-group">
                <label for="parent">{{__('Danh mục cha')}}</label>
                <select class="form-control" name="parent_id" id="parent">
                    <option value="0">{{__('Danh mục cha')}}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description">{{__('Mô tả ngắn')}}</label>
                <textarea class="form-control" name="description" id="description" placeholder="Nhập mô tả">@if ($errors->any()) {{ old('description') }} @endif</textarea>
                <x-display-error name-input='description' />
            </div>

            <div class="form-group">
                <label for="content">{{__('Mô tả chi tiết')}}</label>
                <textarea class="form-control" name="content" id="content" placeholder="Nhập mô tả">@if ($errors->any()) {{ old('content') }} @endif</textarea>
                <x-display-error name-input='content' />
            </div>

            <div class="form-group">
                <label for="image" class="form-label">{{__('Ảnh danh mục')}}</label>
                <input name="image" class="form-control" style="height: auto!important;" type="file" id="image-product" />
                <div id="image-show" class="mt-3">
                    {{-- Showed image --}}
                </div>
                <input type="hidden" name="thumb" id="file"/>
                <x-display-error name-input='image' />
                <x-display-error name-input='thumb' />
            </div>

            <div class="form-check">
                <input name="active" type="checkbox" class="form-check-input" id="active"
                    @if ($errors->any() && old('active') == 'on') checked @endif>
                <label class="form-check-label" for="active">{{__('Kích hoạt')}}</label>
            </div>
        </div>
        {{-- CSRF --}}
        @csrf
        <div class="card-footer">
            <button name="submit" type="submit" class="btn btn-primary">{{__('Thêm danh mục sản phẩm')}}</button>
        </div>
    </form>
    {{-- Form section --}}
@endsection

{{-- Script section --}}
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
{{-- Script section --}}
