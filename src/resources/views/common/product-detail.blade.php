@extends('common.main')

@section('style')
    <style>
        .reply-container {
            max-height: 500px;
            overflow-y: auto;
        }

        .reply-container::-webkit-scrollbar,
        #review-list-container::-webkit-scrollbar {
            display: none;
        }

        #review-list-container {
            max-height: 800px;
            overflow-y: auto;
        }
    </style>
@endsection

@section('middle')
    <div class="container m-t-100">
        @if (session('success'))
            <div class="bread-crumb flex-w p-l-25 p-r-15 m-t-60 p-lr-0-lg alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="bread-crumb flex-w p-l-25 p-r-15 m-t-60 p-lr-0-lg alert alert-danger text-white" role="alert">
                <x-display-error name-input="content" />
            </div>
        @endif
        <!-- breadcrumb -->
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
                {{ __('Home') }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="" class="stext-109 cl8 hov-cl1 trans-04">
                {{ $product->name }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
        </div>
    </div>

    <!-- Product Detail -->
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                <div class="item-slick3" data-thumb="{{ $product->thumb }}">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="{{ $product->thumb }}" alt="IMG-PRODUCT"
                                            style="min-height: 600px; object-fit: cover;">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                            href="{{ $product->thumb }}">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="item-slick3" data-thumb="{{ $product->thumb }}">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="{{ $product->thumb }}" alt="IMG-PRODUCT"
                                            style="min-height: 600px; object-fit: cover;">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="item-slick3" data-thumb="{{ $product->thumb }}">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="{{ $product->thumb }}" alt="IMG-PRODUCT"
                                            style="min-height: 600px; object-fit: cover;">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail">
                            {{ $product->name }}
                        </h4>

                        @if (isset($reviewAverage) && $reviewAverage > 0)
                            <span class="d-inline-block wrap-rating fs-18 cl11 m-b-50">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $reviewAverage)
                                        <i class="zmdi zmdi-star"></i>
                                    @else
                                        <i class="zmdi zmdi-star-outline"></i>
                                    @endif
                                @endfor
                            </span>
                        @endif

                        <div class="mtext-106 cl2">
                            {!! $product->officePrice !!}
                        </div>

                        <p class="stext-102 cl3 p-t-23">
                            {{ $product->description }}
                        </p>

                        <!--  -->
                        <div class="p-t-33">
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6 justify-content-start">
                                    {{ __('Transport') }}
                                </div>

                                @php $user = Illuminate\Support\Facades\Auth::user(); @endphp
                                @if ($user)
                                    <div class="size-204 respon6-next">
                                        <a href="/profile/info" style="color: #6b78d7;">
                                            <u>{{ $user->address }}</u>
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">
                                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input id="product-amount" class="mtext-104 cl3 txt-center num-product"
                                            type="number" name="num-product" value="1">

                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>

                                    <input id="product-id" type="hidden" name="product_id" value="{{ $product->id }}">

                                    <button
                                        class="add-to-cart-btn flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail"
                                        name="add-to-cart-btn">
                                        {{ __('Add to cart') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!--  -->
                        <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                            <div class="flex-m bor9 p-r-10 m-r-11">
                                <a href="#"
                                    class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                                    data-tooltip="Add to Wishlist">
                                    <i class="zmdi zmdi-favorite"></i>
                                </a>
                            </div>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Facebook">
                                <i class="fa fa-facebook"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Twitter">
                                <i class="fa fa-twitter"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Google Plus">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description"
                                role="tab">{{ __('Description') }}</a>
                        </li>

                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#information"
                                role="tab">{{ __('Additional
                                                                                                                                                                information') }}</a>
                        </li>

                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">{{ __('Reviews') }}
                                ({{ $amountOfReviews }})</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    {!! $product->content !!}
                                </p>
                            </div>
                        </div>

                        <!-- - -->
                        <div class="tab-pane fade" id="information" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                </div>
                            </div>
                        </div>

                        <!-- Review container -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <div id="review-list-container" class="p-b-30 m-lr-15-sm">
                                        <!-- Review -->
                                        @foreach ($reviews as $review)
                                            <div class="flex-w flex-t p-b-68">
                                                <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                                    <img src="/template/images/user-profile.png" alt="AVATAR">
                                                </div>

                                                <div class="size-207">
                                                    <div class="flex-w flex-sb-m p-b-17">
                                                        <span class="mtext-107 cl2 p-r-20 text-dark"
                                                            style="font-weight: bold;">
                                                            {{ \Str::ucfirst($review->user->name) }}
                                                        </span>

                                                        <span class="fs-18 cl11">
                                                            @for ($i = 1; $i <= $review->amount_of_stars; $i++)
                                                                <i class="zmdi zmdi-star"></i>
                                                            @endfor

                                                            @for ($i = 0; $i < 5 - $review->amount_of_stars; $i++)
                                                                <i class="zmdi zmdi-star-outline"></i>
                                                            @endfor
                                                        </span>
                                                    </div>

                                                    <p class="stext-102 cl6">
                                                        {{ $review->content }}
                                                    </p>
                                                </div>

                                                @if (isset($review->replies))
                                                    <div class="reply-container p-l-68">
                                                        @foreach ($review->replies as $reply)
                                                            <div class="flex-w flex-t m-t-20">
                                                                <div
                                                                    class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                                                    <img src="/template/images/user-profile.png"
                                                                        alt="AVATAR">
                                                                </div>

                                                                <div class="size-207">
                                                                    <div class="flex-w flex-sb-m p-b-17">
                                                                        <span class="mtext-107 cl2 p-r-20 text-dark"
                                                                            style="font-weight: bold;">
                                                                            {{ \Str::ucfirst($reply->user->name) }}
                                                                        </span>
                                                                    </div>

                                                                    <p class="stext-102 cl6">
                                                                        {{ $reply->content }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach

                                        <!-- Add review -->
                                        <form action="{{ route('reviews.store') }}" method="POST" class="w-full">
                                            <h5 class="mtext-108 cl2 p-b-7 text-dark">
                                                {{ __('Add a review') }}
                                            </h5>

                                            <p class="stext-102 cl6">
                                                {{ __('Your reviews will be seen by shop. Please help us to we are able to improve
                                                                                                                                                                                                                                                the product.') }}
                                            </p>

                                            <div class="flex-w flex-m p-t-50 p-b-23">
                                                <span class="stext-102 cl3 m-r-16">
                                                    {{ __('Your Rating') }}
                                                </span>

                                                <span class="wrap-rating fs-18 cl11 pointer">
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <input class="dis-none" type="number" name="rating">
                                                </span>
                                            </div>

                                            <div class="row p-b-25">
                                                <div class="col-12 p-b-5">
                                                    <label class="stext-102 cl3"
                                                        for="review">{{ __('Your review') }}</label>
                                                    <x-display-error name-input="content" />
                                                    <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10 text-dark" id="review" name="content"></textarea>
                                                </div>
                                            </div>

                                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                                            @csrf
                                            <button
                                                class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                                {{ __('Submit') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
            <span class="stext-107 cl6 p-lr-25">
            </span>

            <span class="stext-107 cl6 p-lr-25">
                {{ __('Categories:') }} <b>{{ $category->name }}</b>
            </span>
        </div>
    </section>


    <!-- Related Products -->
    <section class="sec-relate-product bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="p-b-45">
                <h3 class="ltext-106 cl5 txt-center">
                    {{ __('Related Products') }}
                </h3>
            </div>

            <!-- Slide2 -->
            <div class="wrap-slick2">
                <div class="slick2">
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-pic hov-img0">
                                    <img src="{{ $product->thumb }}" alt="IMG-PRODUCT">

                                    <a class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1"
                                        style="cursor: pointer;" onClick="showModal1(event)"
                                        data-show={{ $relatedProduct->id }}>
                                        {{ __('Quick View') }}
                                    </a>

                                    <a href="/product/detail/{{ $relatedProduct->id }}"
                                        class="block2-btn view-detail-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-06">
                                        {{ __('View Detail') }}
                                    </a>
                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="/product-detail?id={{ $product->id }}"
                                            class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                            {{ $product->name }}
                                        </a>

                                        <span class="stext-105 cl3">
                                            {!! $product->officePrice !!}
                                        </span>
                                    </div>

                                    <div class="block2-txt-child2 flex-r p-t-3">
                                        <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                            <img class="icon-heart1 dis-block trans-04"
                                                src="/template/images/icons/icon-heart-01.png" alt="ICON">
                                            <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                                src="/template/images/icons/icon-heart-02.png" alt="ICON">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
