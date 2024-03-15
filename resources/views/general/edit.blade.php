@extends('layouts.dashboard')
@section('title', 'ادیت پست')
@section('script')
    <script>
        $(()=>{
            const postTitle = $('#postTitle')
            const postSlug = $('#postSlug')
            const showSlug = $('#showSlug')
            const postImage = $('#postImage')
            const postImagePreview = $('#postImagePreview')

            if (postSlug.val()) {
                showSlug.text('golrangsystem.com/post/'+postSlug.val())
            }
            postTitle.on('keyup', (e)=>{
                postSlug.val(slug($(e.target).val()))
                showSlug.text('golrangsystem.com/post/'+slug($(e.target).val()))
            })
            postSlug.on('keyup', (e)=>{
                showSlug.text('golrangsystem.com/post/'+slug($(e.target).val()))
            })
            postSlug.on('change', (e)=>{
                postSlug.val(slug($(e.target).val()))
                showSlug.text('golrangsystem.com/post/'+slug($(e.target).val()))
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
@endsection

@section('page-content')
<div class="container-fluid">
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
                            <span class="d-block text-center text-muted mt-2 h6 small" dir="auto" id="showSlug">golrangsystem.com</span>
                            @error('slug')
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

                        <div class="mb-3">
                            <label for="postShortContent" name="shortContent" class="form-label">خلاصه مطلب</label>
                            <textarea id="postShortContent" name="shortContent" class="form-control" style="height: 100px" >{{ $post->shortContent }}</textarea>
                            @error('shortContent')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex">
                            <div class="mb-3 col-md-6 px-3">
                                <label for="postImage" name="shortContent" class="form-label">
                                    <img src="{{ $post->image }}" id="postImagePreview" class="img-thumbnail" style="cursor: pointer" >
                                </label>
                                <input type="file" class="form-control text-center" id="postImage" name="image" >
                                @error('image')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6 px-3">
                                <label for="postImage" name="shortContent" class="form-label">نوع مطلب</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="contentType" value="special-news" id="special-news" {{ $post->contentType == 'special-news' ? 'checked' : ''}} />
                                    <label class="form-check-label" for="special-news">اخبار تخصصی</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="contentType" value="general-news" id="general-news"  value="{{ $post->contentType }}" {{ $post->contentType == 'general-news' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="general-news">اخبار عمومی</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="contentType" value="event" id="event" value="{{ $post->contentType }}" {{ $post->contentType == 'event' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="event">رویداد</label>
                                </div>
                                @error('contentType')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

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
