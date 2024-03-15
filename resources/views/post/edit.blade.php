@extends('layouts.dashboard')
@section('title', 'ادیت پست')
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
    @if(session()->has('error'))
        <div class="alert alert-danger" id="success-alert" style="font-size: 16px">
            <i class="fa fa-check align-middle"></i>
            {{session()->get('error')}}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">ادیت پست</div>
                <div class="card-body">
{{--                    {!! Form::open(['route' => ['post.update', $post->id], 'method' => 'put', 'files' => true]) !!}--}}
                    <form method="post" action="{{route('post.update',$post->id)}}" enctype="multipart/form-data">

                        <input type="hidden" name="post"
                               value="{{$post->id}}">
                    <div class="mb-3">
                            <label for="postTitle" class="form-label">عنوان مطلب</label>
                            <input type="text" class="form-control text-center" id="postTitle" name="title" placeholder="عنوان جدید" value="{{ $post->title }}">
                            @error('title')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="postSlug" class="form-label">نامک</label>
                            <input type="text" class="form-control text-center" id="postSlug" name="slug" placeholder="عنوان-جدید" value="{{ $post->slug }}">
                            <span class="d-block text-center text-muted mt-2 h6 small" dir="auto" id="showSlug">oilalife.com</span>
                            @error('slug')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-12 col-md-12 col-12 pb-12 mb-3">
                            <div id="dZUpload" class="dropzone">
                                <div class="dz-default dz-message">
                                    <h3>آپلود تصویر شاخص</h3>
                                    <p>برای آپلود فایل کلیک کنید یا فایل را در این قسمت رها کنید !</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="postShortContent" name="shortContent" class="form-label">خلاصه مطلب</label>
                            <textarea id="postShortContent" name="shortContent"
                                      class="form-control"
                                      required autofocus
                                      oninvalid="this.setCustomValidity('وارد کردن خلاصه مطلب اجباری است.')"
                                      oninput="setCustomValidity('')"
                            >{{ $post->shortContent }}</textarea>
                            @error('shortContent')
                            <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="myeditorinstance" class="form-label">محتوا</label>
                            <textarea class="form-control" id="myeditorinstance" name="content">{{ $post->content }}</textarea>
                            @error('content')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">

                            <label for="name">دسته بندی</label>

                            <select class="select2" name="categories[]" multiple>
                                @foreach(\App\Models\Category::all() as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 form-group col-md-6">
                            <label for="time" class="form-label">زمان مطالعه</label>
                            <input type="number" class="form-control text-center" id="time" name="time"
                                   value="{{ $post->time }}"
                                   required autofocus
                                   oninvalid="this.setCustomValidity('وارد کردن زمان مطالعه اجباری است.')"
                                   oninput="setCustomValidity('')"
                            >
                            @error('slug')
                            <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <input type="hidden" id="img" name="img">
                        <input type="hidden" id="id" name="id" value="{{$post->id}}">

                        <div class="mb-3 d-flex justify-content-center align-items-center">
                            <button type="submit" class="btn btn-primary col-md-6 col-12" >ثبت</button>
                        </div>
                        @csrf
                    </form>
{{--                    {!! Form::close() !!}--}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>

        tinymce.init({
            selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists directionality image',
            directionality : "rtl",
            height: '500px',
            toolbar: 'ltr rtl | undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | image',
            image_title: true,
            automatic_uploads: true,
            images_upload_url: '{{route('uploadTinyPhoto')}}',
            file_picker_types: 'image',
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                };
                input.click();
            }
        });
    </script>

    <script>
        $(()=>{
            const postTitle = $('#postTitle')
            const postSlug = $('#postSlug')
            const showSlug = $('#showSlug')
            const postImage = $('#postImage')
            const postImagePreview = $('#postImagePreview')

            if (postSlug.val()) {
                showSlug.text('oilalife.com/post/'+postSlug.val())
            }
            postTitle.on('keyup', (e)=>{
                postSlug.val(slug($(e.target).val()))
                showSlug.text('oilalife.com/post/'+slug($(e.target).val()))
            })
            postSlug.on('keyup', (e)=>{
                showSlug.text('oilalife.com/post/'+slug($(e.target).val()))
            })
            postSlug.on('change', (e)=>{
                postSlug.val(slug($(e.target).val()))
                showSlug.text('oilalife.com/post/'+slug($(e.target).val()))
            })
            postImage.on('change', (e)=>{
                if(postImage.val()){
                    postImagePreview.hide()
                }
                else{
                    postImagePreview.show()
                }
            })
        })

    </script>
    <script src="{{asset('vendors/select2/js/select2.min.js')}}"></script>

    <script>

        $('.select2').select2({});

        const postSlug = $('#postSlug')
        const showSlug = $('#showSlug')


        $( "#postSlug" ).keyup(function() {
            // alert( "Handler for .keyup() called." );
            showSlug.text('oilalife.com/post/' + postSlug.val())
        });

        let filename = "";
        Dropzone.autoDiscover = false;
        $(function () {
            $("#dZUpload").dropzone({
                maxFiles: 1,
                init: function () {
                    var _token = $('meta[name="csrf-token"]').attr('content');
                    this.on("maxfilesexceeded", function (file) {
                        this.removeAllFiles();
                        this.addFile(file);
                    });
                    this.on('sending', function (file, xhr, formData) {
                        formData.append('type', 'post-images');
                        formData.append('_token', _token);
                    });
                    var mockFile = {name: '-', size: 'نامشخص'};
                    @if ($post->image)
                        this.emit("addedfile", mockFile);
                        this.emit("thumbnail", mockFile, '{{env('APP_URL').$post->image}}');
                        this.emit("complete", mockFile);
                    @endif

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
                },
                error: function (file, response) {
                    file.previewElement.classList.add("dz-error");
                }
            });
        });
    </script>

@endsection
