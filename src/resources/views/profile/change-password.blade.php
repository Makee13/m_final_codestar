@extends('common.main')

@include('profile.style')
@section('middle')
    <div class="bg0 p-t-75 p-b-85 m-t-100">
        <div class="container">
            <div class="row">
                <form class="d-block col-lg-10 col-xl-7 m-lr-auto m-b-50" action="" method="POST">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-container-infor">
                            <div class="container-infor bor10 p-t-18 p-b-15 p-lr-40 p-lr-15-sm" style="min-width: unset;">
                                <h2 class="mtext-109 cl2 p-b-30 text-center text-dark">{{__('Change password')}}</h2>
                                @if(session('success'))
                                <span class="d-block text-success text-center">{{session('success')}}</span>
                                @endif
                                @if($errors->any())
                                <span class="d-block text-danger text-center">{{__('Please checking your informations again!')}}</span>
                                @endif
                                <div class="form-main">
                                    <div class="form-group">
                                        <label for="new-password">{{__('New password')}}</label>
                                            
                                            <input id="new-password" name="new-password" class="bor10 p-2" style="width: 100%;" type="password" class="new-password" placeholder="Enter your new password" @if($errors->any()) value="{{old('new-password')}}" @endif>
                                        <x-display-error name-input="new-password" />
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm-password">{{__('Confirm password')}}</label>
                                        <input id="confirm-password" name="confirm-password" class="bor10 p-2" style="width: 100%;" type="password" class="confirm-password" placeholder="Enter your confirm password" @if($errors->any()) value="{{old('confirm-password')}}" @endif>
                                        <x-display-error name-input="confirm-password" />
                                    </div>
                                    @csrf
                                </div>
                            </div>
                        </div>

                        <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                            <button
                                class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                {{__('Update password')}}
                            </button>
                        </div>
                    </div>
                </form>

                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-30 text-center text-dark">
                            {{__('Profile')}}
                        </h4>

                        <div class="flex-w flex-t bor12 p-b-13 d-flex justify-content-center align-items-center">
                            <img class="profile-image" src="/template/images/profile-img.jpg" alt="Profile image">
                        </div>  

                        <div class="flex-w flex-t bor12 p-t-15 p-b-30 d-flex justify-content-center align-items-center">
                            <b>
                                {{\Str::ucfirst($user->name)}}
                            </b>
                        </div>

                        <a href="/profile/info" class="d-block mb-3 mt-3 text-dark">
                            <u>{{__('Profile')}}</u>
                        </a>

                        <a href="{{route('user.orders.list')}}" class="d-block mb-3 mt-3 text-dark">
                            <u>{{ __('My orders') }}</u>
                        </a>

                        <a href="/profile/more-secure" class="d-block mb-3 mt-3 text-dark">
                            <u>{{__('More secure')}}</u>
                        </a>

                        @php $urlLogout = "'/sign/sign-out'"; @endphp
						<button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer"
                                onClick="logout({{$urlLogout}})"
                        >
							{{__('Logout')}}
						</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
