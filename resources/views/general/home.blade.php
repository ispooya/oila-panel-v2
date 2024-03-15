@extends('layouts.dashboard')
@section('title', 'صفحه اول')
@section('head')
    <!-- Style -->
    <link rel="stylesheet" href="{{asset('vendors/select2/css/select2.min.css')}}" type="text/css">
@endsection
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
                                    <label for="title">عنوان</label>
                                    <input value="{{$slider['title']}}" type="text" class="form-control"
                                           id="home.slider.title" name="home.slider.title" placeholder="عنوان ">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">زیرعنوان</label>
                                    <input value="{{$slider['subtitle']}}" type="text" class="form-control"
                                           name="home.slider.subtitle" id="home.slider.subtitle"
                                           placeholder="زیر عنوان">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="btn1text">عنوان دکمه</label>
                                    <input value="{{$slider['btntext']}}" type="text" class="form-control"
                                           id="home.slider.btntext" name="home.slider.btntext" placeholder="عنوان ">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="btn1url">لینک دکمه</label>
                                    <input value="{{$slider['btnurl']}}" type="text" class="form-control"
                                           name="home.slider.btnurl" id="home.slider.btnurl" placeholder="لینک">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="home.slider.video">ایفریم ویدیو</label>
                                    <input value="{{$slider['video']}}" type="text" class="form-control"
                                           id="home.slider.video" name="home.slider.video" placeholder="عنوان ">
                                </div>
                                <div class="form-group col-md-6 rounded-sm border-gray-600 border p-2 d-flex flex-row">
                                    <div>
                                        <label for="title">تصویر بک گراند</label>
                                        <input type="file" class="form-control" id="home_slider_img"
                                               name="home.slider.img" placeholder="عنوان ">
                                    </div>
                                    <img id="home_slider_img_image" src="{{$slider['img']}}" class="w-25 rounded-sm">
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
                                    <label for="title">عنوان معرفی محصولات</label>
                                    <input value="{{$s1['title']}}" type="text" class="form-control"
                                           id="home.product.title" name="home.product.title" placeholder="عنوان ">
                                </div>
                            </div>
                            <hr class="solid">
                            <h5>سکشن ۲</h5>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="title">عنوان</label>
                                    <input value="{{$s3['title']}}" type="text" class="form-control" id="home.s3.title"
                                           name="home_s3_title" placeholder="عنوان ">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="title">متن دکمه</label>
                                    <input value="{{$s3['btnText']}}" type="text" class="form-control"
                                           id="home.s3.btntext" name="home_s3_btntext" placeholder="عنوان ">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="title">لینک دکمه</label>
                                    <input value="{{$s3['btnUrl']}}" type="text" class="form-control"
                                           id="home.s3.btnUrl" name="home_s3_btnUrl" placeholder="عنوان ">
                                </div>
                            </div>
                            <hr class="solid">
                            <h5>سکشن ۳</h5>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="title">عنوان</label>
                                    <input value="{{$s4['title']}}" type="text" class="form-control" id="home.s3.title"
                                           name="home_s4_title" placeholder="عنوان ">
                                </div>
                                <div class="form-group col-md-6 rounded-sm border-gray-600 border p-2 d-flex flex-row">
                                    <div>
                                        <label for="title">تصویر سمت چپ</label>
                                        <input type="file" id="home_s4_img"
                                               name="home_s4_img" placeholder="عنوان ">
                                    </div>
                                    <img id="home_s4_img_image" src="{{$s4['img']}}" class="w-25 rounded-sm">

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="title">متن دکمه معرفی محصول</label>
                                    <input value="{{$s4['prBtn']}}" type="text" class="form-control"
                                           id="home_s4_btntext" name="home_s4_prBtnText" placeholder="عنوان ">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="title">متن دکمه دستور پخت</label>
                                    <input value="{{$s4['recBtn']}}" type="text" class="form-control"
                                           id="home_s4_btnUrl" name="home_s4_recBtnText" placeholder="عنوان ">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="title">محصول مرتبط</label>
                                    <select class="select2" name="home.s4.productId">
                                        <option>Select</option>

                                        @foreach($products as $product)
                                            <option
                                                value="{{$product->id}}" {{!empty($s4['product']) ? $s4['product']['id'] == $product->id ? 'selected' : '' : ''}}>{{$product->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="title">دستور پخت</label>
                                    <select class="select2" name="home.s4.postId">
                                        <option>Select</option>

                                        @foreach(\App\Models\Post::all() as $post)
                                            <option value="{{$post->id}}" {{!empty($s4['post']) ? $s4['post']['id'] == $post->id ? 'selected' : '' : ''}}>{{$post->title}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <hr class=" solid">
                                            <hr class="solid">

                                            <div class="mb-3 d-flex justify-content-center align-items-center">
                                                <button type="submit" class="btn btn-primary col-md-6 col-12">ویرایش
                                                </button>
                                            </div>
                            @csrf
                            {{--                    {!! Form::close() !!}--}}
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">ویرایش سکشن ۵</div>
                    <div class="card-body">
                        <form method="post" action="{{route('general.update')}}" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-6 rounded-sm border-gray-600 border p-2 d-flex flex-row">
                                    <div>
                                        <label for="title">تصویر سمت راست</label>
                                        <input type="file" class="form-control" id="home_s6_img"
                                               name="home.s6.img" placeholder="عنوان ">
                                    </div>
                                    <img id="home_s6_img_image" src="{{$s6['img']}}" class="w-25 rounded-sm">

                                </div>
                                <div class="form-group col-md-6 rounded-sm border-gray-600 border p-2 d-flex flex-row">
                                    <div>
                                        <label for="home_s6_typo_image"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            <span>تصویر تایپوگرافی</span>
                                        </label>
                                        <input type="file"
                                                class="block w-ful"
                                                aria-describedby="file_input_help" id="home_s6_typo"
                                                name="home.s6.typo" placeholder="عنوان ">
                                    </div>
                                    <img id="home_s6_typo_image" src="{{$s6['typo']}}" class="w-25 rounded-sm">
                                </div>
                            </div>
                            <div class="form-row ">
                                <div class="form-group col-md-6">
                                    <label for="title">متن آیکون اول</label>
                                    <input value="{{$s6['v1t']}}" type="text" class="form-control" id="home.s6.val1text"
                                           name="home.s6.val1text" placeholder="عنوان ">
                                </div>
                                <div class="form-group col-md-6 rounded-sm border-gray-600 border p-2 d-flex flex-row">
                                    <div>
                                        <label for="title">آیکون اول</label>
                                        <input type="file" id="home_s6_val1img"
                                               name="home.s6.val1img" placeholder="عنوان ">
                                    </div>
                                    <img id="home_s6_val1img_image" src="{{$s6['v1i']}}" class="w-25 rounded-sm">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="title">متن آیکون دوم</label>
                                    <input value="{{$s6['v2t']}}" type="text" class="form-control" id="home.s6.val2text"
                                           name="home.s6.val2text" placeholder="عنوان ">
                                </div>
                                <div class="form-group col-md-6 rounded-sm border-gray-600 border p-2 d-flex flex-row">
                                    <div>
                                        <label for="title">آیکون دوم</label>
                                        <input type="file" id="home_s6_val2img"
                                               name="home.s6.val2img" placeholder="عنوان ">
                                    </div>
                                    <img id="home_s6_val2img_image" src="{{$s6['v2i']}}" class="w-25 rounded-sm">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="title">متن آیکون سوم</label>
                                    <input value="{{$s6['v3t']}}" type="text" class="form-control" id="home.s6.val3text"
                                           name="home.s6.val3text" placeholder="عنوان ">
                                </div>
                                <div class="form-group col-md-6 rounded-sm border-gray-600 border p-2 d-flex flex-row">
                                    <div>
                                        <label for="title">آیکون سوم</label>
                                        <input type="file" id="home_s6_val3img"
                                               name="home.s6.val3img" placeholder="عنوان ">
                                    </div>
                                    <img id="home_s6_val3img_image" src="{{$s6['v3i']}}" class="w-25 rounded-sm">

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="title">متن آیکون چهارم</label>
                                    <input value="{{$s6['v4t']}}" type="text" class="form-control" id="home.s6.val4text"
                                           name="home.s6.val4text" placeholder="عنوان ">
                                </div>
                                <div class="form-group col-md-6 rounded-sm border-gray-600 border p-2 d-flex flex-row">
                                    <div>
                                        <label for="title">آیکون چهارم</label>
                                        <input type="file" id="home_s6_val4img"
                                               name="home.s6.val4img" placeholder="عنوان ">
                                    </div>
                                    <img id="home_s6_val4img_image" src="{{$s6['v4i']}}" class="w-25 rounded-sm">
                                </div>
                            </div>
                            <hr class="solid">


                            <div class="mb-3 d-flex justify-content-center align-items-center">
                                <button type="submit" class="btn btn-primary col-md-6 col-12">ویرایش</button>
                            </div>
                            @csrf
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
