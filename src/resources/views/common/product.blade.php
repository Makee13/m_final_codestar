<section class="bg0 p-t-23 p-b-140" id="list-product-anchor">
    <div class="container">
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">
                {{ __('Product Overview') }}
            </h3>
        </div>

        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                @if (request()->input('search'))
                    <div>
                        <strong>{{ __('Search for') }}: <span
                                style="color: #6c7ae0;">{{ request()->input('search') }}</span></strong>
                        <a class="d-block text-dark" style="text-decoration: underline;"
                            href="{{ route('home') }}"><strong>{{ __('All Products') }}</strong></a>
                    </div>
                @else
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                        {{ __('All products') }}
                    </button>
                @endif
            </div>

            <div class="flex-w flex-c-m m-tb-10">
                <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                    <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                    <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    {{ __('Filter') }}
                </div>

                <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                    <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                    <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    {{ __('Search') }}
                </div>
            </div>

            <!-- Search product -->
            <div class="dis-none panel-search w-full p-t-10 p-b-15">
                <div class="bor8 dis-flex p-l-15">
                    <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                        <a class="js-search" style="color: #000;">
                            <i class="zmdi zmdi-search"></i>
                        </a>
                    </button>

                    <input oninput="searchProduct(event)"
                        class="search-input mtext-107 cl2 size-114 plh2 p-r-15 text-dark css-search" type="text"
                        name="search-product" placeholder="Search...">
                </div>
            </div>

            <!-- Filter -->
            <div class="dis-none panel-filter w-full p-t-10">
                <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                    <div class="filter-col1 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15 text-dark">
                            {{ __('Sort By') }}
                        </div>

                        <ul>
                            <li class="p-b-6">
                                <a href="{{ request()->url() }}" class="filter-link stext-106 trans-04">
                                    {{ __('Default') }}
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="{{ request()->fullUrlWithQuery(['sortPrice' => 'asc']) }}"
                                    class="filter-link stext-106 trans-04">
                                    {{ __('Low to high') }}
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="{{ request()->fullUrlWithQuery(['sortPrice' => 'desc']) }}"
                                    class="filter-link stext-106 trans-04">
                                    {{ __('Hight to low') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product List -->
        <div id="product-list-container">
            <div id="product-list" class="row isotope-grid">
                @include('common.product-list')
            </div>
        </div>

        <!-- Loading -->
        <div class="flex-c-m flex-w w-full">
            <x-loading />
        </div>
        <!-- Load more -->
        <div class="flex-c-m flex-w w-full p-t-45">
            <input type="hidden" value="1" id="page">
            <button id="loader" onClick="loadMore()"
                class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                {{ __('Load More') }}
            </button>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        @if (request()->input('search') || request()->input('sortPrice'))
            $([document.documentElement, document.body]).animate({
                scrollTop: $('#list-product-anchor').offset().top
            }, 500);
        @endif
    </script>
@endpush
