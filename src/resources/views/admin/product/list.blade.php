@extends('admin.main')

@section('styles')  
    <style>

    </style>
@endsection

@section('content')
    @if (session('success'))
        <x-display-succ message="{{session('success')}}" />
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>{{__('ID')}}</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Description')}}</th>
                <th>{{__('Content')}}</th>
                <th>{{__('Image')}}</th>
                <th>{{__('Belong to Category')}}</th>
                <th>{{__('Price')}}</th>
                <th>{{__('Price Sale')}}</th>
                <th>{{__('Active')}}</th>
                <th>{{__('Update')}}</th>
                <th>{{__('Remove')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                @php
                    $delFunction = 'removeRow(' . $product->id . ',\'/admin/product/destroy\')';
                @endphp
                <tr>
                    <td style='width: 50px'>{{ $product->id }}</td>
                    <td style='width: 50px'>{{ $product->name }}</td>
                    <td style='width: 50px'>{{ $product->description }}</td>
                    <td style='width: 50px;'><span class='d-inline-block' style='max-height: 200px;overflow-y: scroll;'>{{ $product->content }}<span></td>
                    <td style='width: 50px'><a href="{{ $product->thumb }}" target="_blank"><img
                                src="{{ $product->thumb }}" alt="Product Image" width="50px"></a></td>
                    <td style='width: 50px'>{{ $product->category->name }}</td>
                    <td style='width: 50px'>{{ $product->price }}</td>
                    <td style='width: 50px'>{{ $product->price_sale }}</td>
                    <td style='width: 50px'>{!! App\Helpers\Helper::active($product->active) !!}</td>
                    <td style='width: 50px'>
                        <a class='btn btn-primary btn-sm' href='/admin/product/edit/{{ $product->id }}'><i
                                class='fas fa-edit'></i></a>
                    </td>
                    <td style='width: 50px'>
                        <button class='btn btn-danger btn-sm' onClick={{ $delFunction }}><i
                                class='fas fa-trash'></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="cart-footer clear-fix">
        {!! $products->links('pagination::bootstrap-4') !!}
    </div>
@endsection
