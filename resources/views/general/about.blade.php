@extends('layouts.dashboard')
@section('title', 'درباره ما')
@section('page-content')
    <div class="container-fluid">
        @if(session()->has('success'))
            <div class="alert alert-success" id="success-alert" style="font-size: 16px">
                <i class="fa fa-check align-middle"></i>
                {{session()->get('success')}}
            </div>
        @endif
        <div class="row justify-content-center">
            {{--            slider--}}
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">ویرایش هدر</div>
                    <div class="card-body">
                        {{--                        {!! Form::open(['route' => 'post.store', 'method' => 'post', 'files' => true]) !!}--}}
                        <form method="post" action="{{route('general.update')}}" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="home.slider.video">ایفریم ویدیو</label>
                                    <input value="{{$video}}" type="text" class="form-control"
                                           id="about.video" name="about.video" placeholder="عنوان ">
                                </div>
                                <div class="form-group col-md-6 rounded-sm border-gray-600 border p-2 d-flex flex-row justify-between">
                                    <div>
                                        <label for="about_img">تصویر بک گراند</label>
                                        <input type="file" class="form-control" id="about_img"
                                        name="about.img" placeholder="عنوان ">
                                    </div>
                                    <img id="about_img_image" src="{{$img}}" class="w-25 rounded-sm">

                                </div>
                            </div>

                            <div class="mb-3 d-flex justify-content-center align-items-center">
                                <button type="submit" class="btn btn-primary col-md-6 col-12">ویرایش</button>
                            </div>
                            @csrf
                            {{--                    {!! Form::close() !!}--}}
                        </form>
                    </div>
                </div>
            </div>
            {{--            section1--}}
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">ویرایش محتوای متنی</div>
                    <div class="card-body">
                        <form method="post" action="{{route('general.update')}}" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="title">عنوان</label>
                                    <input value="{{$title}}" type="text" class="form-control"
                                           id="about.title" name="about.title" placeholder="عنوان ">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="subtitle">عنوان</label>
                                    <input value="{{$subtitle}}" type="text" class="form-control"
                                           id="about.subtitle" name="about.subtitle" placeholder="عنوان ">
                                </div>
                            </div>
                            <hr class="solid">
                            <h5>سکشن ۱</h5>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="title">عنوان</label>
                                    <input value="{{$s1title}}" type="text" class="form-control" id="about.s1.title"
                                           name="about.s1.title" placeholder="عنوان ">
                                </div>
                                <div class="form-group col-md-6 rounded-sm border-gray-600 border p-2 d-flex flex-row justify-between">
                                    <div>
                                        <label for="about_s1_img">تصویر بک گراند</label>
                                        <input type="file" class="form-control" id="about_s1_img"
                                        name="about.s1.img" placeholder="عنوان ">
                                    </div>
                                    <img id="about_s1_img_image" src="{{$s1img}}" class="w-25 rounded-sm">

                                </div>
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <label for="title">توضیح</label>
                                    <textarea type="text" class="form-control"
                                              id="about.s1.description" name="about.s1.description" placeholder="توضیح ">{{$s1description}}</textarea>
                                </div>
                            </div>
                            <hr class="solid">
                            <h5>سکشن ۲</h5>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="title">عنوان</label>
                                    <input value="{{$s2title}}" type="text" class="form-control" id="about.s2.title"
                                           name="about.s2.title" placeholder="عنوان ">
                                </div>
                                <div class="form-group col-md-6 rounded-sm border-gray-600 border p-2 d-flex flex-row justify-between">
                                    <div>
                                        <label for="about_s2_img">تصویر</label>
                                        <input type="file" class="form-control" id="about_s2_img"
                                        name="about.s2.img" placeholder="عنوان ">
                                    </div>
                                    <img id="about_s2_img_image" src="{{ $s2img }}" class="w-25 rounded-sm">

                                </div>
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <label for="title">توضیح</label>
                                    <textarea type="text" class="form-control"
                                              id="about.s2.description" name="about.s2.description" placeholder="توضیح ">{{$s2description}}</textarea>
                                </div>
                            </div>
                            <hr class="solid">
                            <h5>سکشن ۳</h5>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="title">عنوان</label>
                                    <input value="{{$s3title}}" type="text" class="form-control" id="about.s3.title"
                                           name="about.s3.title" placeholder="عنوان ">
                                </div>
                                <div class="form-group col-md-6 rounded-sm border-gray-600 border p-2 d-flex flex-row justify-between">
                                    <div>
                                        <label for="title">تصویر</label>
                                        <input type="file" class="form-control" id="about_s3_img"
                                               name="about.s3.img" placeholder="عنوان ">
                                    </div>
                                    <img id="about_s3_img_image" src="{{ $s3img }}" class="w-25 rounded-sm">

                                </div>
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <label for="title">توضیح</label>
                                    <textarea type="text" class="form-control"
                                              id="about.s3.description" name="about.s3.description" placeholder="توضیح ">{{$s3description}}</textarea>
                                </div>
                            </div>
                            <hr class="solid">
                            <h5>سکشن ۴</h5>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="title">عنوان</label>
                                    <input value="{{$s4title}}" type="text" class="form-control" id="about.s4.title"
                                           name="about.s4.title" placeholder="عنوان ">
                                </div>
                                <div class="form-group col-md-6 rounded-sm border-gray-600 border p-2 d-flex flex-row justify-between">
                                    <div>
                                        <label for="title">تصویر</label>
                                        <input type="file" class="form-control" id="about_s4_img"
                                               name="about.s4.img" placeholder="عنوان ">
                                    </div>
                                    <img id="about_s4_img_image" src="{{ $s4img }}" class="w-25 rounded-sm">

                                </div>
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <label for="title">توضیح</label>
                                    <textarea type="text" class="form-control"
                                              id="about.s4.description" name="about.s4.description" placeholder="توضیح ">{{$s4description}}</textarea>
                                </div>
                            </div>

                            <div class="mb-3 d-flex justify-content-center align-items-center">
                                <button type="submit" class="btn btn-primary col-md-6 col-12">ویرایش</button>
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
@section('script')
    <script src="{{asset('vendors/select2/js/select2.min.js')}}"></script>
    <script>
        $('.select2').select2({});
        $(document).ready(function() {
            $("input[type=file]").change(function(event) {
                var input = event.target;
                var file = input.files[0];
                var type = file.type;

                var output = $('#'+event.target.id+'_image');

                // console.log('#'+event.target.id+'.image');

                output.attr("src", URL.createObjectURL(event.target.files[0]));

                output.on("load", function() {
                    URL.revokeObjectURL(output.attr("src"));
                });
            });
        });
    </script>
@endsection
