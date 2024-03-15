<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>سیستم گلرنگ - ورود</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}">
    <!-- Plugin styles -->
    <link rel="stylesheet" href="{{asset('vendors/bundle.css')}}">
    <!-- App styles -->
    <link rel="stylesheet" href="{{asset('assets/css/app.min.css')}}">
</head>
<body class="form-membership p-0">
<div class="preloader">
    <div class="preloader-icon"></div>
</div>
<div class="form-wrapper" style="padding: 3rem 3rem 6rem;">
    <div id="logo">
        <img src="{{asset('images/golrang-system-logo.png')}}" class="logo img-fluid" alt="">
    </div>
    <h5 style="line-height: 1.5;">برای ورود فرم زیر را تکمیل کنید</h5>
    <form action="{{route('login')}}" method="POST">
        <div class="form-group">
            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}"
                   placeholder="ایمیل" title="" required autofocus
                   oninvalid="this.setCustomValidity('وارد کردن ایمیل اجباری است.')"
                   oninput="setCustomValidity('')">
        </div>
        <div class="form-group" style="position: relative;">
            <input type="password" class="form-control" id="password" name="password" placeholder="رمز عبور" title=""
                   required pattern="^([0-9]+([\.][0-9]+)?)|([\u0660-\u0669]+([\.][\u0660-\u0669]+)?)$"
                   oninvalid="this.setCustomValidity('زبان صفحه کلید را انگلیسی کرده و رمز عبور را وارد نمایید.')"
                   oninput="setCustomValidity('')">
            <i class="fa fa-eye" id="show-password" data-toggle="tooltip" title="نمایش رمز عبور"
               style="position: absolute;top: 11px;left: 20px;cursor: pointer;"></i>
        </div>
{{--        <div class="form-group text-right">--}}
{{--            <div class="custom-control custom-checkbox" style="cursor: pointer;">--}}
{{--                <input type="checkbox" class="custom-control-input" id="remember_me" name="remember_me">--}}
{{--                <label for="remember_me" class="custom-control-label" style="cursor: pointer;">--}}
{{--                    مرا به خاطر بسپار--}}
{{--                </label>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="form-group mt-4 mb-4">
            <div class="captcha">
                <span>{!! captcha_img() !!}</span>
{{--                <button type="button" class="btn btn-danger" class="reload" id="reload">--}}
{{--                    &#x21bb;--}}
{{--                </button>--}}
            </div>
        </div>

        <div class="form-group mb-4">
            <input id="captcha" type="text" class="form-control" placeholder="کد امنیتی" name="captcha"
                   required
                   oninvalid="this.setCustomValidity('وارد کردن کد امنیتی اجباری است')"
                   oninput="setCustomValidity('')">
        </div>
        @include('shared.errors')
        <button class="btn btn-primary pull-left" style="margin-left: 5px;">ورود</button>
        @csrf
    </form>
</div>

<!-- Plugin scripts -->
<script src="{{asset('vendors/bundle.js')}}"></script>
<script>
    function isPersian(str) {
        var p = /^[\u0600-\u06FF\s]+$/;
        return p.test(str);
    }

    $('#password').on('keypress', function (e) {
        if (isPersian(e.key)) {
            swal("هشدار!", "زبان صفحه کلید را انگلیسی کنید.", "warning");
            e.preventDefault();
        }
    });
</script>
<script>
    $('#show-password').on('click', function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#password");
        input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password');
        $("#password").focus();
    });
</script>
<script>
    $('[data-toggle="tooltip"]').on('click', function () {
        $(this).tooltip('hide');
    });
</script>
<!-- App scripts -->
<script src="{{asset('assets/js/app.min.js')}}"></script>
<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });

</script>
</body>
</html>






{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Login') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-3">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Remember Me') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}
