@extends('common.main')

@section('style')
    <style>
        .slick-list {
            margin: 0 -10px;
        }
        
        .slick-container .slick-slide {
            padding: 0 10px;
            height: unset;
        }

        .slick-img-container img {
            height: 300px; 
            width: 100%; 
            object-fit: cover;
        }

        .slick-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .seller-slick-button {
            opacity: 1;
        }

        .col-sm-6.col-md-4.col-lg-3.p-b-35.isotope-item.women {
            position: static!important;
        }

        #product-list {
            height: unset!important;
        }
    </style>
@endsection

@section('middle')
    <!-- Slider -->
    @include('common.slider')

    <!-- Banner -->
    @include('common.banner')

    <!-- Best sellers -->
    @include('common.best-seller-products')

    <!-- Product -->
    @include('common.product')
@endsection

@push('scripts')
    <script type="text/javascript">
        $('.multiple-items').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1500,
            prevArrow: "<button class='seller-slick-button arrow-slick1 prev-slick1 slick-arrow'><i class='zmdi zmdi-caret-left'></i></button>",
            nextArrow: "<button class='seller-slick-button arrow-slick1 next-slick1 slick-arrow'><i class='zmdi zmdi-caret-right'></i></button>",
        });
    </script>
@endpush
