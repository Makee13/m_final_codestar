@extends('admin.main')

@section('content')
    @if (session('success'))
        <x-display-succ message="Cập nhật thông tin danh mục thành công" />
    @endif
    <div class="mb-3">
        <form action="{{route('admin.category.product.import')}}" method="POST" enctype="multipart/form-data">
            <label class="d-block" for="formFile" class="form-label">{{__('Import category and products (Excel)')}}</label>
            <input class="d-block" style="margin-bottom: 20px;" style="cursor: pointer;" type="file" name="products_and_categories">
            <x-display-error name-input="products_and_categories" />
            @csrf
            @if (session('failures'))
                <div class="alert alert-danger" role="alert">
                    <strong>{{__('Errors:')}}</strong>
                    <ul>
                        @foreach (session('failures') as $failure)
                            @foreach ($failure->errors() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        @endforeach
                    </ul>
                </div>
            @endif
            @if($errors->any())
                <p class="text-danger">{{$errors->first()}}</p>
            @endif
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>{{__('ID')}}</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Image')}}</th>
                <th>{{__('Active')}}</th>
                <th>{{__('Updated')}}</th>
                <th>{{__('Update')}}</th>
                <th>{{__('Remove')}}</th>
            </tr>
        </thead>
        <tbody>
            {!! App\Helpers\Helper::menu($categories) !!}
        </tbody>
    </table>
    <div class="cart-footer clear-fix">
        {!! $categories->links('pagination::bootstrap-4') !!}
    </div>
@endsection
