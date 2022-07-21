@if (session('error'))
    <p class="alert alert-danger">{{ session('error') }}</p>
@else
    @if ($errors->any())
        <p class="alert alert-danger">{{__('validation.error')}}</p>
    @endif
@endif
