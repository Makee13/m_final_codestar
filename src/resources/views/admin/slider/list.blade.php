@extends('admin.main')

@section('content')
    @if (session('success'))
        <x-display-succ message="{{session('success')}}" />
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>{{__('ID')}}</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Url')}}</th>
                <th>{{__('Image')}}</th>
                <th>{{__('Active')}}</th>
                <th>{{__('Updated_at')}}</th>
                <th>{{__('Update')}}</th>
                <th>{{__('Remove')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sliders as $slider)
                @php
                    $delFunction = 'removeRow(' . $slider->id . ',\'/admin/slider/destroy\')';
                @endphp
                <tr>
                    <td style='width: 50px'>{{ $slider->id }}</td>
                    <td style='width: 50px'>{{ $slider->name }}</td>
                    <td style='width: 50px'>{{ $slider->url }}</td>
                    <td style='width: 50px'><a href="{{ $slider->thumb }}" target="_blank"><img
                                src="{{ $slider->thumb }}" alt="Slider Image" width="50px"></a></td>
                    <td style='width: 50px'>{!! App\Helpers\Helper::active($slider->active) !!}</td>
                    <th style='width: 50px'>{{ $slider->updated_at }}</th>
                    <td style='width: 50px'>
                        <a class='btn btn-primary btn-sm' href='/admin/slider/edit/{{ $slider->id }}'><i
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
        {!! $sliders->links('pagination::bootstrap-4') !!}
    </div>
@endsection
