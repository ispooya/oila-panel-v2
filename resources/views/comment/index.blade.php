@extends('layouts.dashboard')
@section('title', 'لیست کامنت ها')
@section('page-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title border-bottom  d-flex justify-content-between"
                             style="margin-bottom: 1.5rem;">
                            <h6 class="card-title mb-3">
                                <i class="fa fa-user text-info align-middle"
                                   style="margin-left: 5px;font-size: 12px;"></i>
                                لیست کامنت ها
                            </h6>
                        </div>
                        <div>
                            <div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="mr-4" aria-current="page">دسته بندی :</li>
                                        <li class="breadcrumb-item active">
                                            <a href="{{route('comment.index',['status' => 'status_waiting'])}}"
                                               style="{{(request()->segment(6) == 'status_waiting' ) ?  'color: #1565c0 !important; font-weight: 800 !important;' : ''}} cursor: pointer;">منتظر تایید</a>
                                        </li>
                                        <li class="breadcrumb-item ">
                                            <a href="{{route('comment.index',['status' => 'all'])}}" class="mx-3"
                                               style="{{(request()->segment(6) == 'all' ) ?  'color: #1565c0 !important; font-weight: 800 !important;' : ''}} cursor: pointer;"> کامنت ها </a>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                <tr style="background: aliceblue;">
                                    <th>نامک پست</th>
                                    <th>ایمیل</th>
                                    <th>نام</th>
                                    <th>کامنت</th>
                                    <th>وضعیت</th>
                                    <th>تاریخ ثبت</th>
                                    <th>زمان تغییر وضعیت</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($comments as $comment)
                                    <tr class="us-row-{{$comment->id}}">
                                        <td class="type">{{$comment->post->slug}}</td>
                                        <td class="type">{{$comment->email }}</td>
                                        <td class="type">{{$comment->name }}</td>
                                        <td class="type">
                                             <span class="mr-1" data-toggle="tooltip"
                                                   title="متن کامنت">
                                                <a class="update-user"
                                                   data-userId="{{$comment->id}}"
                                                   onclick="getText({{$comment->id}},{{$comment}})"
                                                   style="cursor: pointer;">
                                                    <i class="fa fa-file-text-o"
                                                       style="margin-top: 3px;font-size: 16px; color: black;"></i>
                                                </a>
                                            </span>
                                        </td>
                                        <td class="name ">{{$comment->getStatus()}}</td>
                                        <td class="phone">{{$comment->Created_at()}}</td>
                                        <td class="phone">{{$comment->Updated_at()}}</td>
                                        <td class="text-center">
                                                <span class="mr-1" data-toggle="tooltip"
                                                      title="  تایید کامنت"
                                                >
                                                <a class="update-user"
                                                   data-userId="{{$comment->id}}"
                                                   onclick="acceptComment({{$comment->id}})"
                                                   style="cursor: pointer;"
                                                >
                                                    <i class="fa fa-check success align-middle"
                                                       style="margin-top: 3px;font-size: 16px; color:forestgreen;"></i>
                                                </a>
                                            </span>

                                                <span class="mr-1 "
                                                      data-toggle="tooltip"
                                                      title="رد کامنت">
                                                <a class="update-user"
                                                   data-userId="{{$comment->id}}"
                                                   onclick="rejectComment({{$comment->id}})"
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
                            {{$comments->links()}}
                            <br>
                        </div>
                        @if($comments->count() > 0)
                            <div class="modal check-user-modal fade" id="modal-{{$comment->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"> تایید کامنت</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="close">
                                                <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="accept-form" method="POST"
                                                  action="{{route('comment.accept')}}">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <span> از تایید کامنت مطمئن هستید؟</span>
                                                </div>
                                                <input type="hidden" name="id" class="idget"
                                                       value="">
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <a id="hrefcheck">
                                                <button type="button"
                                                        class="btn btn-outline-success btn-uppercase pull-left"
                                                        id="update-user" onclick="submitAcceptForm()">
                                                    <i class="ti ti-reload mr-2"></i>
                                                    بله
                                                </button>
                                            </a>
                                            <button type="button" class="btn btn-default pull-left"
                                                    data-dismiss="modal">
                                                خیر
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal failed-user-modal fade" id="modal-{{$comment->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"> رد کامنت</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="close">
                                                <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="reject-form" method="POST"
                                                  action="{{route('comment.reject')}}">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <span> از رد کامنت مطمئن هستید؟</span>
                                                </div>
                                                <input type="hidden" name="id" class="idget"
                                                       value="">
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <a id="hreffailed">
                                                <button type="button"
                                                        class="btn btn-outline-success btn-uppercase pull-left"
                                                        id="update-user" onclick="submitRejectForm()">
                                                    <i class="ti ti-reload mr-2"></i>
                                                    بله
                                                </button>
                                            </a>
                                            <button type="button" class="btn btn-default pull-left"
                                                    data-dismiss="modal">
                                                خیر
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal text-modal fade" id="modal-{{$comment->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">متن کامنت</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="close">
                                                <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="user-form">
                                                <div class="form-group" id="textNews">
                                    <textarea
                                        style="width: 100% !important; height: 100px !important; border: #fff !important; resize: none !important;"></textarea>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left"
                                                    data-dismiss="modal">
                                                باشه
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        acceptComment = function (id) {

            $('.check-user-modal').modal('show');
            $('.idget').val(id);
        }

        rejectComment = function (id) {
            $('.failed-user-modal').modal('show');
            $('.idget').val(id)
            console.log()
        }

        submitAcceptForm = function () {
            $('#accept-form').submit()
        }
        submitRejectForm = function () {
            $('#reject-form').submit()
        }


    </script>
    <script>
        getText = function (id, text) {
            console.log(text)
            $('.text-modal').modal('show');
            $('#textNews textarea').val(text['comment']);
        }
    </script>
@endsection
