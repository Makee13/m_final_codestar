<section class="bg0 p-t-23 p-b-80">
    <div class="container">
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">
                {{ __('Best Sellings In Month') }}
            </h3>
        </div>

        <div class="slick-container" style="overflow: hidden;">
            <div class="multiple-items">
                @foreach($bestSellingProducts as $product)
                    <div class="block2">
                        <div class="block2-pic hov-img0 slick-img-container">
                            <img src="{{$product->thumb}}" alt="Product Img">
                            <a
                                class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1"
                                style="cursor: pointer;"
                                onClick="showModal1(event)"
                                data-show={{ $product->id }}>
                                {{ __('Quick View') }}
                            </a>
                            <a href="/product/detail/{{$product->id}}"
                                class="block2-btn view-detail-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-06">
                                {{ __('View Detail') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
