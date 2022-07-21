@if(session('error'))
    <p class="text-danger">{{__(session('error'))}}</p>
@endif
