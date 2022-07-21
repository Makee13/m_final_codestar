<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin') }}" class="brand-link">
        <img src="/template/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: 0.8" />
        <span class="brand-text font-weight-light">{{ __('Admin') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/template/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" />
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ \Auth::user()->email }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search" />
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                {{-- Category side --}}
                <li class="nav-item">
                    <a href="{{ route('admin') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-house-user"></i>
                        <p class="ms-20">{{ __('Home') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.community') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-house-user"></i>
                        <p class="ms-20">{{ __('Community chat') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Category') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.category.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add category') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.category.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('List category') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Product side --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-store"></i>
                        <p>
                            {{ __('Product') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.product.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add product') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.product.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('List products') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Slider side --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fab fa-accusoft"></i>
                        <p>
                            {{ __('Slider') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.slider.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add slider') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.slider.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('List sliders') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Coupon side --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-arrow-down"></i>
                        <p>
                            {{ __('Coupon') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.coupon.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add coupon') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.coupon.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('List coupons') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Notificaton side --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-bell" aria-hidden="true"></i>
                        <p>
                            {{ __('Notification') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.notifications.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add notification') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.notifications.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('List notifications') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Reviews side --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-quote-left" aria-hidden="true"></i>
                        <p>
                            {{ __('Reviews') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.reviews.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('List reviews') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Users side --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                        <p>
                            {{ __('User') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.users.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('List users') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Orders side --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                        <p>
                            {{ __('Order') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.orders.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('List orders') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>


                {{-- Logout --}}
                <li class="nav-item mt-20">
                    <button id="logout-button" onClick="logout('{{ route('admin.logout.invoke') }}')"
                        class="btn btn-info w-100">{{ __('Logout') }}</button>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
