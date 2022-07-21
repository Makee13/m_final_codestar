    @foreach ($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
            <!-- Block2 -->
            <div class="block2">
                <div class="block2-pic hov-img0">
                    <img src="{{ $product->thumb }}" alt="IMG-PRODUCT" height="380px" style="object-fit: cover;">

                    <a class="block2-btn view-quick-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1"
                        style="cursor: pointer;" onClick="showModal1(event)" data-show={{ $product->id }}>
                        {{ __('Quick View') }}
                    </a>
                    <a href="/product/detail/{{ $product->id }}"
                        class="block2-btn view-detail-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-06">
                        {{ __('View Detail') }}
                    </a>
                </div>

                <div class="block2-txt flex-w flex-t p-t-14">
                    <div class="block2-txt-child1 flex-col-l ">
                        <a href="/product/detail/{{ $product->id }}"
                            class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                            {{ __($product->name) }}
                        </a>
                        @php
                            $amountOfStars = $product->getAvgStarOfProduct();
                            $amountOfSoldProduct = $product->getAmountOfSoldProduct();
                        @endphp
                        <span class="stext-105 cl3">
                            {!! \App\Helpers\Helper::getOfficePrice($product->price, $product->price_sale) !!}
                        </span>
                        @if ($amountOfStars > 0)
                            <div class="d-flex justify-content-center align-items-center">
                                <span class="d-inline-block wrap-rating fs-18 cl11">
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < $amountOfStars)
                                            <i class="zmdi zmdi-star"></i>
                                        @else
                                            <i class="zmdi zmdi-star-outline"></i>
                                        @endif
                                    @endfor
                                </span>
                                <span class="text-muted m-l-10" style="font-size: 14px;">{{ __('Sold:') }}
                                    {{ $amountOfSoldProduct }}</span>

                            </div>
                        @endif
                    </div>

                    <div class="block2-txt-child2 flex-r p-t-3">
                        @if (!auth()->user())
                            <a href="{{ route('user.sign') }}" class="btn-addwish-b2 dis-block pos-relative pointer">
                                <img class="icon-heart1 dis-block trans-04"
                                    src="/template/images/icons/icon-heart-01.png" alt="ICON">
                                <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                    src="/template/images/icons/icon-heart-02.png" alt="ICON">
                            </a>
                        @else
                            <a class="btn-addwish-b2 dis-block pos-relative js-addwish-b2 js-add-wish pointer"
                                onClick="addToWishsList(event)" data-show={{ $product->id }}>
                                <img class="icon-heart1 dis-block trans-04"
                                    src="/template/images/icons/icon-heart-01.png" alt="ICON">
                                <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                    src="/template/images/icons/icon-heart-02.png" alt="ICON">
                                {{-- <img class="icon-heart{{\Illuminate\Support\Facades\Auth::user()->wishsList->id == $product->wishsListProducts->wishs_list_id ? '2' : ''}} dis-block trans-04 ab-t-l"
                                    src="/template/images/icons/icon-heart-02.png" alt="ICON"> --}}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
