@extends('common.main')

@include('profile.style')
@section('middle')
    <div class="bg0 p-t-75 p-b-85 m-t-30">
        <div class="container">
            <div class="row">
                <form class="d-block col-lg-10 col-xl-7 m-lr-auto m-b-50" action="" method="POST">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-container-infor">
                            <div class="container-infor bor10 p-t-18 p-b-15 p-lr-40 p-lr-15-sm" style="min-width: unset;">
                                <h2 class="mtext-109 cl2 p-b-30 text-center text-dark">{{ __('Your information') }}</h2>
                                @if (session('success'))
                                    <span class="d-block text-success text-center">{{ session('success') }}</span>
                                @endif
                                @if ($errors->any())
                                    <span
                                        class="d-block text-danger text-center">{{ __('Please checking your informations again!') }}</span>
                                @endif
                                <div class="form-main">
                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }}</label>
                                        <input id="name" name="name" class="bor10 p-2" style="width: 100%;" type="text"
                                            class="name" value="{{ $user->name }}"
                                            placeholder="Enter your new name">
                                        <x-display-error name-input="name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ __('Email') }}</label>
                                        <input id="email" name="email" class="bor10 p-2" style="width: 100%;"
                                            type="text" class="email" value="{{ $user->email }}"
                                            placeholder="Enter your new email">
                                        <x-display-error name-input="email" />
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">{{ __('Phone') }}</label>
                                        <input id="phone" name="phone" class="bor10 p-2" style="width: 100%;"
                                            type="text" class="phone" value="{{ $user->phone }}"
                                            placeholder="Enter your new phone"
                                        >
                                        <x-display-error name-input="phone" />
                                    </div>
                                    <div class="form-group">
                                        <label for="province">{{ __('Province/City') }}</label>
                                        <input id="province" name="province" class="bor10 p-2" style="width: 100%;"
                                            type="text" class="province" value="{{ $user->province }}"
                                            placeholder="Enter your new province">
                                        <x-display-error name-input="province" />
                                    </div>
                                    <div class="form-group">
                                        <label for="district">{{ __('District') }}</label>
                                        <input id="district" name="district" class="bor10 p-2" style="width: 100%;"
                                            type="text" class="district" value="{{ $user->district }}"
                                            placeholder="Enter your new district">
                                        <x-display-error name-input="district" />
                                    </div>
                                    <div class="form-group">
                                        <label for="commune">{{ __('Ward/Commune') }}</label>
                                        <input id="commune" name="commune" class="bor10 p-2" style="width: 100%;"
                                            type="text" class="commune" value="{{ $user->commune }}"
                                            placeholder="Enter your new commune">
                                        <x-display-error name-input="commune" />
                                    </div>
                                    @csrf
                                </div>
                            </div>
                        </div>

                        <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                            <button
                                class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                {{ __('Update information') }}
                            </button>
                        </div>
                    </div>
                </form>

                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-30 text-center text-dark">
                            {{ __('Profile') }}
                        </h4>

                        <div class="flex-w flex-t bor12 p-b-13 d-flex justify-content-center align-items-center">
                            <img class="profile-image" src="/template/images/profile-img.jpg" alt="Profile image">
                        </div>

                        <div class="flex-w flex-t bor12 p-t-15 p-b-30 d-flex justify-content-center align-items-center">
                            <b>
                                {{ \Str::ucfirst($user->name) }}
                            </b>
                        </div>

                        <a href="/profile/change-password" class="d-block mb-3 mt-3 text-dark">
                            <u>{{ __('Change password') }}</u>
                        </a>

                        <a href="{{route('user.orders.list')}}" class="d-block mb-3 mt-3 text-dark">
                            <u>{{ __('My orders') }}</u>
                        </a>

                        <a href="/profile/more-secure" class="d-block mb-3 mt-3 text-dark">
                            <u>{{ __('More secure') }}</u>
                        </a>

                        @php $urlLogout = "'/sign/sign-out'"; @endphp
                        <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer"
                            onClick="logout({{ $urlLogout }})">
                            {{ __('Logout') }}
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
