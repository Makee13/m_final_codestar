@extends('common.main')

@section('style')
    <style type="text/css">
        .cl2,
        .main-menu>li>a {
            color: #000;
        }
    </style>
@endsection

@section('middle')
    <div class="bg0 m-t-150 p-b-140">
        <div class="container">
			<div class="flex-w flex-l-m filter-tope-group m-tb-10">
				<h3 style="font-weight: bolder;">{{ $cate->name }}</h3>
			</div>
            <div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					@if (request()->input('search'))
						<div>
							<strong>{{__('Search for')}}: <span
									style="color: #6c7ae0;">{{ request()->input('search') }}</span></strong>
							<a class="d-block text-dark" style="text-decoration: underline;"
								href="{{ url()->current() }}"><strong>{{ __('Back to products of') }} {{ $cate->name }}</strong></a>
						</div>
					@else
						<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
							{{ __('All Products') }}
						</button>
					@endif
				</div>
				<div class="flex-w flex-c-m m-tb-10">
					<div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
						<i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
						<i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						 {{__('Filter')}}
					</div>

					<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
						<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						{{__('Search')}}
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
							<div class="mtext-102 cl2 p-b-15">
								{{__('Sort By')}}
							</div>

							<ul>
								<li class="p-b-6">
									<a href="{{request()->url()}}" class="filter-link stext-106 trans-04">
										{{__('Default')}}
									</a>
								</li>

								<li class="p-b-6">
									<a href="{{request()->fullUrlWithQuery(['sortPrice' => 'asc'])}}" class="filter-link stext-106 trans-04">
										{{__('Low to high')}}
									</a>
								</li>

								<li class="p-b-6">
									<a href="{{request()->fullUrlWithQuery(['sortPrice' => 'desc'])}}" class="filter-link stext-106 trans-04">
										{{__('Hight to low')}}
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>

            </div>

            <div id="product-list" class="row isotope-grid">
                @include('common.product-list')
            </div>

            <div class="cart-footer clear-fix">
                {!! $products->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
@endsection
