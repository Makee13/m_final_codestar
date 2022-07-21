@if (session('success'))
    <p class="alert alert-success">
        {{__($message)}}
    </p>
@endif
