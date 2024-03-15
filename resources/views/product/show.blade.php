@extends('layouts.dashboard')
@section('title', 'افزودن محصول')
@section('head')
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title border-bottom" style="margin-bottom: 1.5rem;">
                            <h6 class="card-title mb-3">
                                <i class="fa fa-plus text-success align-middle"
                                   style="margin-left: 5px;font-size: 12px;"></i>
                                محصول جدید
                            </h6>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-6 pb-3">
                                <div id="dZUpload" class="dropzone">
                                    <div class="dz-default dz-message">
                                        <h3>آپلود عکس</h3>
                                        <p>برای آپلود فایل کلیک کنید یا فایل را در این قسمت رها کنید !</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <form action="{{route('product.update',['id' =>$product->id ])}}" method="POST">
                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <label for="name">نام محصول</label>
                                            <input type="text" class="form-control" id="name" name="name" title=""
                                                   value="{{$product->name}}" required autofocus
                                                   oninvalid="this.setCustomValidity('وارد کردن نام محصول اجباری است.')"
                                                   oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">ترکیبات اصلی</label>
                                            <input type="text" class="form-control" id="ingredients" name="ingredients"
                                                   title=""
                                                   value="{{$product->ingredients}}" required autofocus
                                                   oninvalid="this.setCustomValidity('وارد کردن ترکیبات اصلی محصول اجباری است.')"
                                                   oninput="setCustomValidity('')">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">

                                            <label for="name">ویژگی های تولید محصول</label>

                                            <select class="select2" name="fpp[]" multiple>
                                                @foreach(\App\Models\Fpp::all() as $fpp)
                                                    <option @if($product->fpps->where('id',$fpp->id)->first()) selected @endif value="{{$fpp->id}}">{{$fpp->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">

                                            <label for="name">موارد استفاده</label>

                                            <select class="select2" name="use[]" multiple >
                                                @foreach(\App\Models\ProductUses::all() as $use)
                                                    <option  @if($product->uses->where('id',$use->id)->first()) selected @endif value="{{$use->id}}">{{$use->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">

                                            <label for="name">دستپخت های مرتبط</label>

                                            <select class="select2" name="post[]" multiple>
                                                @foreach(\App\Models\Post::all() as $post)
                                                    <option @if($product->posts->where('id',$post->id)->first()) selected @endif value="{{$post->id}}" >{{$post->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">

                                            <label for="name">دسته بندی محصول</label>

                                            <select class="select2" name="category">
                                                @foreach(\App\Models\ProductCategory::all() as $cat)
                                                    <option value="{{$cat->id}}" {{$product->category_id == $cat->id ? 'selected' : ''}} >{{$cat->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">محتوا</label>
                                        <textarea class="form-control" id="myeditorinstance"
                                                  name="description"
                                                  oninvalid="this.setCustomValidity('وارد کردن محتوا اجباری است.')"
                                                  oninput="setCustomValidity('')"
                                        >{{ $product->description }}</textarea>
                                        @error('content')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <input type="hidden" id="img" name="img" value="">
                                    @include('shared.errors')
                                    <button type="submit"
                                            class="btn btn-success btn-uppercase pull-left"
                                            style="margin-left: 5px;">
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
    <!-- Javascript -->
    <script src="{{asset('vendors/select2/js/select2.min.js')}}"></script>
    <script>
        $('.select2').select2({});
    </script>
    <script>
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
                        formData.append('type', 'product');
                        formData.append('_token', _token);
                    });
                    var mockFile = {name: '-', size: 'نامشخص'};
                    this.emit("addedfile", mockFile);
                    this.emit("thumbnail", mockFile, '{{env('APP_URL').$product->img}}');
                    this.emit("complete", mockFile);
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
    <script>
        tinymce.init({
            selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists directionality image',
            directionality: "rtl",
            height: '500px',
            toolbar: 'ltr rtl | undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | image',
            image_title: true,
            automatic_uploads: true,
            images_upload_url: '{{route('uploadTinyPhoto')}}',
            file_picker_types: 'image',
            file_picker_callback: function (cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function () {
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), {title: file.name});
                    };
                };
                input.click();
            }
        });
    </script>

@endsection

