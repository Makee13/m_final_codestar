<header>
    <style>
        #user-link,
        .sign-link {
            color: #6b78d7;
            padding: 10px 10px;
            border: 1px solid;
            font-family: Poppins-Medium;
        }
    </style>
    @php
        $loadedCates = App\Helpers\Helper::getCates($categories);
        $user = auth()->user();
    @endphp
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">
                    {{__('Free shipping for standard order over $100 (Expected)')}}
                </div>

                <div class="right-top-bar flex-w h-full">
                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        {{__('Help')}} &amp; FAQs
                    </a>

                    @if (isset($user))
                        <a class="flex-c-m trans-04 p-lr-25" href="{{ route('user.profile.info.create') }}">
                            {{ __('My Account') }}
                        </a>
                    @else
                        <a class="flex-c-m trans-04 p-lr-25" href="{{ route('user.sign') }}">
                            {{ __('Login or Sign-up') }}
                        </a>
                    @endif

                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        EN
                    </a>

                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        USD
                    </a>
                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="/" class="logo">
                    <img src="/template/images/icons/logo-01.png" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="{{ Request::is('/') ? 'active-menu' : '' }}"><a href="/">{{ __('Home') }}</a>
                        </li>
                        <li class="label1 {{ Request::is('category/*') ? 'active-menu' : '' }}" data-label1="hot">
                            <a href="#">{{ __('Category') }}</a>
                            <ul class="sub-menu">
                                {!! $loadedCates !!}
                            </ul>
                        </li>
                        @if (isset($user))
                            <li class="{{ Request::is('cart/*') ? 'active-menu' : '' }}">
                                <a href="{{ route('user.cart.products.list') }}">{{ __('Cart') }}</a>
                            </li>

                            <li class="{{ Request::is('orders/*') ? 'active-menu' : '' }}">
                                <a href="{{ route('user.orders.list') }}">{{ __('Orders') }}</a>
                            </li>

                            <li class="{{ Request::is('messages/*') ? 'active-menu' : '' }} label1"
                                data-label1="hot">
                                <a href="{{ route('messages.list') }}">{{ __('Comunity') }}</a>
                            </li>
                        @endif

                        <li class="{{ Request::is('blog/*') ? 'active-menu' : '' }}">
                            <a class="text-muted">{{ __('Blog') }}</a>
                        </li>

                        <li class="{{ Request::is('about') ? 'active-menu' : '' }}">
                            <a href="{{ route('about.invoke') }}"> {{ __('About us') }}</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>

                    @if (isset($user))
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart js-show-amount-prod"
                            data-notify="{{ $user->cart->amount_product }}" data-cart-id="{{ $user->cart->id }}">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>

                        <a href="{{ route('wishs-list.list') }}"
                            class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-amount-wishs-prod"
                            data-notify="{{ $amountWishsList }}">
                            <i class="zmdi zmdi-favorite-outline"></i>
                        </a>

                        <a href="{{ route('notifications.list') }}"
                            class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-amount-notifications"
                            data-notify="{{ $amountNotification }}">
                            <i class="fa fas-solid fa-bell"></i>
                        </a>
                    @endif
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="index.html"><img src="/template/images/icons/logo-01.png" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            @if (isset($user))
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                    data-notify="{{ $user->cart->amount_product }}" data-cart-id="{{ $user->cart->id }}">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>
            @endif
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="main-menu-m">
            <li class="active-menu"><a href="/">{{ __('Home') }}</a></li>
            <li>
                <a href="#">{{ __('Categories') }}</a>
                <ul class="sub-menu-m">
                    {!! $loadedCates !!}
                </ul>
                <span class="arrow-main-menu-m">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
            </li>

            <li>
                <a href="product.html">{{ __('Products') }}</a>
            </li>

            <li class="label1" data-label1="hot">
                <a href="{{ route('user.cart.products.list') }}">{{ __('Cart') }}</a>
            </li>

            <li>
                <a href="blog.html">{{ __('Blog') }}</a>
            </li>

            <li>
                <a href="about.html">{{ __('About us') }}</a>
            </li>

            <li>
                <a href="contact.html">{{ __('Contact') }}</a>
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="/template/images/icons/icon-close2.png" alt="CLOSE">
            </button>

            <div class="wrap-search-header flex-w p-l-15">
                <button>
                    <a class="flex-c-m trans-04 js-search" style="color: #000;">
                        <i class="zmdi zmdi-search"></i>
                    </a>
                </button>
                <input oninput="searchProduct(event)" class="plh3 search-input" type="text" name="search"
                    placeholder="Search...">
            </div>
        </div>
    </div>
</header>
