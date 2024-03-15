@extends('layouts.dashboard')
@section('title', 'مراکز فروش')
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
                                افزودن مرکز فروش
                            </h6>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-6">
                                <form action="{{route('seller.store')}}" method="POST" id="form">
                                    <div class="form-group">
                                        <label for="name">عنوان</label>
                                        <input type="text" class="form-control" id="name" name="name" title=""
                                               value="{{old('name')}}" required autofocus
                                               oninvalid="this.setCustomValidity('وارد کردن عنوان ویژگی اجباری است.')"
                                               oninput="setCustomValidity('')">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">توضیحات</label>
                                        <textarea  class="form-control" id="description" name="description" title="">{{old('description')}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">آدرس</label>
                                        <textarea  class="form-control" id="address" name="address" title="">{{old('address')}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="site">آدرس سایت</label>
                                        <input type="text" class="form-control" id="site" name="site" title=""
                                               value="{{old('site')}}" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">شماره تماس</label>
                                        <input type="number" class="form-control" id="phone" name="phone" title=""
                                               value="{{old('phone')}}">
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
                                    <th>نام</th>
                                    <th>توضیح</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($sellers as $seller)
                                    <tr class="us-row-{{$seller->id}}">
                                        <td class="type">{{$seller->name }}</td>
                                        <td class="type">{{$seller->description}}</td>
                                        <td class="text-center">
                                           <span class="mr-1 "
                                                 data-toggle="tooltip"
                                                 title="حذف">
                                               <a class="update-user"
                                                  href="/seller/destroy/{{$seller->id}}"
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
        let filename = "";
        Dropzone.autoDiscover = false;
        $(document).ready(function () {
            $("#dZUpload").dropzone({
                maxFiles: 4,
                init: function () {
                    var _token = $('meta[name="csrf-token"]').attr('content');
                    this.on("maxfilesexceeded", function (file) {
                        this.removeAllFiles();
                        this.addFile(file);
                    });
                    this.on('sending', function (file, xhr, formData) {
                        formData.append('type', 'sellers');
                        formData.append('_token', _token);
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
                    $('form').append('<input type="hidden" name="images[]" value="' + response['success'] + '">');

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
