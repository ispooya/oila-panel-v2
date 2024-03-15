@extends('layouts.dashboard')
@section('title', 'ویرایش مدیر')
@section('page-content')
    <div class="container-fluid">
        @if(session()->has('success'))
            <div class="alert alert-success" id="success-alert" style="font-size: 16px">
                <i class="fa fa-check align-middle"></i>
                {{session()->get('success')}}
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title border-bottom" style="margin-bottom: 1.5rem;">
                            <h6 class="card-title mb-3">
                                <i class="fa fa-plus text-success align-middle"
                                   style="margin-left: 5px;font-size: 12px;"></i>
                                ویرایش مدیر
                            </h6>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12">
                                <form action="{{route('user.update')}}" method="POST">
                                    <div class="form-group">
                                        <label for="name">نام و نام خانوادگی</label>
                                        <input type="text" class="form-control" id="name" name="name" title=""
                                               value="{{$user->name}}" required autofocus
                                               oninvalid="this.setCustomValidity('وارد کردن نام و نام خانوادگی کاربر اجباری است.')"
                                               oninput="setCustomValidity('')">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">ایمیل</label>
                                        <input type="email" class="form-control" id="email" name="email" title=""
                                               value="{{$user->email}}" required
                                               oninvalid="this.setCustomValidity('وارد کردن ایمیل اجباری است.')"
                                               oninput="setCustomValidity('')">
                                    </div>
                                    <div class="form-group" style="position: relative;">
                                        <label for="password">رمز عبور</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                               title=""
                                               pattern="^([0-9]+([\.][0-9]+)?)|([\u0660-\u0669]+([\.][\u0660-\u0669]+)?)$"
                                               oninvalid="this.setCustomValidity('زبان صفحه کلید را انگلیسی کرده و رمز عبور را وارد نمایید.')"
                                               oninput="setCustomValidity('')">
                                        <i class="fa fa-eye" id="show-password" data-toggle="tooltip"
                                           title="نمایش رمز عبور"
                                           style="position: absolute;top: 39px;left: 20px;cursor: pointer;"></i>
                                    </div>
                                    <input type="hidden" id="id" name="id" value="{{$user->id}}">
                                    @include('shared.errors')
                                    <button type="submit"
                                            class="btn btn-success btn-uppercase pull-left" style="margin-left: 5px;">
                                        <i class="ti ti-check-box align-middle" style="margin-left: 5px;"></i>
                                        ثبت
                                    </button>
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
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

@endsection
