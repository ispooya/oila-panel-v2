@extends('layouts.dashboard')
@section('title', 'ارتباط با ما')
@section('page-content')
    <div class="container-fluid">
        @if(session()->has('success'))
            <div class="alert alert-success" id="success-alert" style="font-size: 16px">
                <i class="fa fa-check align-middle"></i>
                {{session()->get('success')}}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">ویرایش محتوا</div>
                    <div class="card-body">
{{--                        {!! Form::open(['route' => 'post.store', 'method' => 'post', 'files' => true]) !!}--}}
                        <form method="post" action="{{route('contactUs.store')}}" enctype="multipart/form-data">
                            <div class="form-group col-lg-6 col-md-6 col-6">
                                <label for="phone">تماس با مدیریت</label>
                                <input type="text" class="form-control" id="managementPhone" name="managementphone" title=""
                                       value="{{$managementPhone}}" required autofocus
                                       oninvalid="this.setCustomValidity('وارد کردن شماره مدیریت اجباری است.')"
                                       oninput="setCustomValidity('')">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-6">
                                <label for="fax">واحد فروش</label>
                                <input type="text" class="form-control" id="salesPhone" name="salesphone" title=""
                                       value="{{$salesPhone}}" required autofocus
                                       oninvalid="this.setCustomValidity('وارد کردن شماره واحد فروش اجباری است.')"
                                       oninput="setCustomValidity('')">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-6">
                                <label for="address">آدرس</label>
                                <input type="text" class="form-control" id="address" name="address" title=""
                                       value="{{$address}}" required autofocus
                                       oninvalid="this.setCustomValidity('وارد کردن آدرس اجباری است.')"
                                       oninput="setCustomValidity('')">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-6">
                                <label for="address">کد آیفریم نقشه</label>
                                <input type="text" class="form-control" id="map" name="map" title=""
                                       value="{{$map}}" required autofocus
                                       oninvalid="this.setCustomValidity('وارد کردن کد ایفریم اجباری است.')"
                                       oninput="setCustomValidity('')">
                            </div>

                            <div class="mb-3 d-flex justify-content-center align-items-center">
                                <button type="submit" class="btn btn-primary col-md-6 col-12">ثبت</button>
                            </div>
                            @csrf
                            {{--                    {!! Form::close() !!}--}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
