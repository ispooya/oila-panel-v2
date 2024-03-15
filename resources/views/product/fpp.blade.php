@extends('layouts.dashboard')
@section('title', 'ویژگی های تولید محصول')
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
                                افزودن ویژگی های تولید محصول
                            </h6>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-6">
                                <form action="{{route('product.fpp.store')}}" method="POST">
                                    <div class="form-group">
                                        <label for="name">عنوان</label>
                                        <input type="text" class="form-control" id="name" name="name" title=""
                                               value="{{old('name')}}" required autofocus
                                               oninvalid="this.setCustomValidity('وارد کردن عنوان ویژگی اجباری است.')"
                                               oninput="setCustomValidity('')">
                                    </div>
                                    <input type="hidden" id="img" name="img" value="">
                                    @include('shared.errors')
                                    <button type="submit"
                                            class="btn btn-success btn-uppercase pull-left" style="margin-left: 5px;">
                                        <i class="ti ti-check-box align-middle" style="margin-left: 5px;"></i>
                                        ثبت
                                    </button>
                                    @csrf
                                </form>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6 pb-3">
                                <div id="dZUpload" class="dropzone">
                                    <div class="dz-default dz-message">
                                        <h3>آپلود عکس</h3>
                                        <p>برای آپلود فایل کلیک کنید یا فایل را در این قسمت رها کنید !</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title border-bottom  d-flex justify-content-between"
                             style="margin-bottom: 1.5rem;">
                            <h6 class="card-title mb-3">
                                <i class="fa fa-user text-info align-middle"
                                   style="margin-left: 5px;font-size: 12px;"></i>
                                لیست ویژگی ها
                            </h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                <tr style="background: aliceblue;">
                                    <th>تصویر</th>
                                    <th>نام</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($fpps as $fpp)
                                    <tr class="us-row-{{$fpp->id}}">
                                        <td class="type"><img src="{{$fpp->icon }}" alt="" width="90"></td>
                                        <td class="type">{{$fpp->name}}</td>
                                        <td class="text-center">
                                            <span class="mr-1 "
                                                  data-toggle="tooltip"
                                                  title="حذف">
                                                <a class="update-user"
                                                   href="/product/fpp/destroy/{{$fpp->id}}"
                                                   style="cursor: pointer;"
                                                >
                                                    <i class="fa fa-times align-middle"
                                                       style="margin-top: 3px;font-size: 16px; color: crimson;">
                                                    </i>
                                                </a>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <br>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
@section('script')

    <script>
        $(document)
            // .on('click', 'form button[type=submit]', function(e) {
            //     if(!$('#img').val()) {
            //         window.alert("لطفا تصویر ویژگی تولید محصول را وارد کنید.")
            //         e.preventDefault(); //prevent the default action
            //     }
            // });
        let filename = "";
        Dropzone.autoDiscover = false;
        $(document).ready(function () {
            $("#dZUpload").dropzone({
                maxFiles: 1,
                init: function () {
                    var _token = $('meta[name="csrf-token"]').attr('content');
                    this.on("maxfilesexceeded", function (file) {
                        this.removeAllFiles();
                        this.addFile(file);
                    });
                    this.on('sending', function (file, xhr, formData) {
                        formData.append('type', 'fpp');
                        formData.append('_token', _token);
                    });
                    this.on('removedfile', function (file, xhr, formData) {
                        $('#img').val('')
                    });
                },
                maxFilesize: 10,
                chunkSize: true,
                timeout: 60000,
                dictDefaultMessage: "فایل مورد نظر را بکشید و اینجا رها کنید",
                dictCancelUpload: "لغو بارگذاری",
                dictCancelUploadConfirmation: "آیا از لغو بارگذاری مطمعن اید؟",
                dictRemoveFile: "حذف فایل",
                dictRemoveFileConfirmation: "آیا از حذف این فایل مطمعن اید؟",
                url: '{{route('uploadPhoto')}}',
                addRemoveLinks: true,
                success: function (file, response) {
                    $('#img').val(response['success']);
                    var imgName = response;
                    filename = response['success']
                    file.previewElement.classList.add("dz-success");
                    console.log("Successfully uploaded :" + imgName);
                    console.log(filename);
                    console.log(response);
                },
                error: function (file, response) {
                    file.previewElement.classList.add("dz-error");
                }
            });
        });
    </script>
@endsection
