@section('content')
    <!-- Header -->
    @include('common.header')

    <!-- Cart -->
    @section('cart')
        <div class="wrap-header-cart js-panel-cart">
            @include('modal.cart')
        </div>
    @show

    @yield('middle')

    <!-- Footer -->
    @include('common.footer')

    <!-- Back to top -->
    @include('common.back-to-top')

    <!-- Modal1 -->
    @include('modal.modal1')
@show
