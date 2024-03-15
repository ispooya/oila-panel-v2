@extends('layouts.dashboard')
@section('title', 'داشبورد')
@section('head')


    <!-- App styles -->
    <link rel="stylesheet" href="/assets/css/style.css" type="text/css">

@endsection
@section('page-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card-group">
{{--                    <div class="card-columns">--}}
{{--                        @foreach ($posts as $post)--}}

{{--                            <div class="card">--}}
{{--                                <div class=" card-img-top w-100 overflow-hidden position-relative"--}}
{{--                                     style="height: 150px;">--}}
{{--                                    <img src="{{$post->image}}" class="card-img-top position-absolute"--}}
{{--                                         style="left: 0; right: 0; margin: auto" alt="{{ $post->title }}">--}}
{{--                                </div>--}}
{{--                                <div class="card-body">--}}
{{--                                    <h6 class="card-title d-block" style="height: 40px"><b>{{ $post->title }}</b>--}}
{{--                                    </h6>--}}
{{--                                    <p class="card-text p-truncate">{{ $post->shortContent }}</p>--}}
{{--                                    <div class="d-flex">--}}

{{--                                        <a href="{{ 'https://wana.iran.liara.run/news-and-events/'.$post->slug }}"--}}
{{--                                           target="_blank" class=" btn btn-success small">--}}
{{--                                          <small>--}}
{{--                                            <i class="fa fa-eye" aria-hidden="true"></i>--}}
{{--                                          </small>--}}
{{--                                        </a>--}}
{{--                                        <a href="{{ '/post/'.$post->id.'/edit' }}"--}}
{{--                                           class=" btn btn-primary small mx-1">--}}
{{--                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>--}}
{{--                                        </a>--}}
{{--                                        --}}{{--                                                                                                                                {!! Form::open(['route' => ['post.destroy', $post->id], 'method' => 'delete', 'id' => "delete-form-$post->id"]) !!}--}}
{{--                                        --}}{{--                                                                                                                                {!! Form::close() !!}--}}
{{--                                        <form method="get" action="{{route('post.destroy',$post->id)}}"--}}
{{--                                              enctype="multipart/form-data" id="delete-form-{{$post->id}}">--}}
{{--                                        </form>--}}

{{--                                        <button href="{{ env('APP_URL').'/posts/'.$post->slug }}"--}}
{{--                                                class=" btn btn-danger small" onclick="deletePost({{ $post }})">--}}
{{--                                            <small>--}}
{{--                                                <i class="fa fa-trash-o" aria-hidden="true"></i>--}}
{{--                                            </small>--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                    <hr>--}}
{{--                                    <div>--}}
{{--                                        <span class="text-muted">--}}
{{--                                            <small>--}}
{{--                                                <i class="bi bi-person"></i>--}}
{{--                                                <mark>{{ $post->user->name }}</mark>--}}
{{--                                            </small>--}}
{{--                                        </span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>



    {{--    <div class="container-fluid">--}}
    {{--        <div class="row justify-content-center">--}}
    {{--            <div class="col-md-12">--}}
    {{--                <div class="card">--}}
    {{--                    <div class="card-header">پست های شما</div>--}}
    {{--                    <div class="card-body d-flex flex-md-row flex-sm-column flex-wrap">--}}

    {{--                        @foreach ($posts as $post)--}}
    {{--                            <div class="col-xl-4 col-lg-6 col- col-md-6 col-sm-12 p-1">--}}
    {{--                                <div class="card">--}}
    {{--                                    <div class="w-100 overflow-hidden position-relative" style="height: 150px;">--}}
    {{--                                        <img src="{{ '/images/user/'.$post->image}}" class="card-img-top position-absolute"--}}
    {{--                                             style="left: 0; right: 0; margin: auto" alt="{{ $post->title }}">--}}
    {{--                                    </div>--}}
    {{--                                    <div class="card-body">--}}
    {{--                                        <h6 class="card-title d-block" style="height: 40px"><b>{{ $post->title }}</b>--}}
    {{--                                        </h6>--}}
    {{--                                        <p class="card-text p-truncate">{{ $post->shortContent }}</p>--}}
    {{--                                        <div class="d-flex">--}}

    {{--                                            <a href="{{ 'https://golrangsystem.com/posts/'.$post->slug }}"--}}
    {{--                                               target="_blank" class=" btn btn-primary small">--}}
    {{--                                                --}}{{--                                                <small><i--}}
    {{--                                                --}}{{--                                                        class="bi bi-eye"></i></small></a>--}}
    {{--                                                <small>--}}
    {{--                                                    <i class="fa fa-eye" aria-hidden="true"></i>--}}
    {{--                                                </small>--}}
    {{--                                            </a>--}}
    {{--                                            <a href="{{ '/post/'.$post->id.'/edit' }}"--}}
    {{--                                               class=" btn btn-primary small mx-1">--}}
    {{--                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>--}}
    {{--                                            </a>--}}
    {{--                                            --}}{{--                                                            {!! Form::open(['route' => ['post.destroy', $post->id], 'method' => 'delete', 'id' => "delete-form-$post->id"]) !!}--}}
    {{--                                            --}}{{--                                                            {!! Form::close() !!}--}}
    {{--                                            <form method="get" action="{{route('post.destroy',$post->id)}}"--}}
    {{--                                                  enctype="multipart/form-data" id="delete-form-{{$post->id}}">--}}
    {{--                                            </form>--}}

    {{--                                            <button href="{{ env('APP_URL').'/posts/'.$post->slug }}"--}}
    {{--                                                    class=" btn btn-danger small" onclick="deletePost({{ $post }})">--}}
    {{--                                                <small>--}}
    {{--                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>--}}
    {{--                                                </small>--}}
    {{--                                            </button>--}}
    {{--                                        </div>--}}
    {{--                                        <hr>--}}
    {{--                                        <div>--}}
    {{--                                              <span class="text-muted">--}}
    {{--                                                  <small>--}}
    {{--                                                   <i class="bi bi-person"></i>--}}
    {{--                                                   <mark>{{ $post->user->name }}</mark>--}}
    {{--                                                 </small>--}}
    {{--                                              </span>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        @endforeach--}}

    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection
@section('script')
    <script>
        function deletePost(post) {
            const deleteConfirm = confirm("آیا قصد حذف پست (" + post.title + ") را دارید؟")
            if (deleteConfirm) {
                $('#delete-form-' + post.id).submit()
            }
        }
    </script>
@endsection
