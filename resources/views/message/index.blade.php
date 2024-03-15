@extends('layouts.dashboard')
@section('title', 'لیست تماس ها')
@section('head')
    {{--    <link rel="stylesheet" href="{{asset('/assets/css/bootstrap/bootstrap.min.css')}}">--}}
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
                                <i class="fa fa-user text-info align-middle"
                                   style="margin-left: 5px;font-size: 12px;"></i>
                                لیست تماس ها
                            </h6>
                        </div>
                        <div class="table-responsive">
                            <table id="messages-table" class="table table-bordered text-center table-striped">
                                <thead>
                                <tr style="background: aliceblue;">
                                    <th>نام</th>
                                    <th>آدرس ایمیل</th>
                                    <th>شماره تماس</th>
                                    <th>وضعیت</th>
                                    <th> متن پیام</th>
                                    <th>زمان ثبت پیام</th>
                                    {{--                                    <th class="text-center">عملیات</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($messages as $message)
                                    <tr>
                                        <td>
                                            {{$message->name}}
                                        </td>
                                        <td>
                                            {{$message->email}}
                                        </td>
                                        <td>
                                            {{$message->phone}}
                                        </td>
                                        <td id="{{$message->id}}"
                                            class="message-status {{$message->status ? "text-success" : "text-danger"}} "
                                            onclick="changeStaus({{$message->id}})" data-messageId="{{$message->id}}">
                                            {{$message->status ? "خوانده شده" : "خوانده نشده"}}
                                        </td>
                                        <td>
                                            <span class="mr-1" data-toggle="tooltip"
                                                  title="متن تماس">
                                                <a class="update-user"
                                                   data-userId="{{$message->id}}"
                                                   onclick="getText({{$message->id}},{{$message}})"
                                                   style="cursor: pointer;">
                                                    <i class="fa fa-file-text-o"
                                                       style="margin-top: 3px;font-size: 16px; color: black;"></i>
                                                </a>
                                            </span>
                                        </td>
                                        <td>
                                            {{$message->Created_at()}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$messages->links()}}
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal text-modal fade" id="modal-{{$message->id}}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">متن تماس</h4>
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
    </div>
@endsection

@section('script')
    <script>
        getText = function (id, text) {
            console.log(text)
            $('.text-modal').modal('show');
            $('#textNews textarea').val(text['message']);
        }
        changeStaus = function (id) {
            console.log('hi!');
            console.log(id);
            obj = $('td#' + id);
            // console.log($('td[date-messageId=2]').html());
            // console.log($("td[date-messageId=2]").html());

            var _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{route('changeMassageStatus')}}",
                type: "POST",
                data: {
                    id: id,
                    _token: _token,
                },
                success: function (response) {
                    console.log("response :")
                    console.log(response)
                    if(response == "true"){
                        obj.removeClass('text-danger');
                        obj.html('خوانده شده');
                        obj.addClass('text-success');
                    }else{
                        obj.addClass('text-danger');
                        obj.html('خوانده نشده');
                        obj.removeClass('text-success');

                    }
                }
            });
        }
{{--        {{$message->status ? "text-success" : "text-danger"}} "--}}
{{--        onclick="changeStaus({{$message->id}})" data-messageId="{{$message->id}}">--}}
{{--            {{$message->status ? "خوانده شده" : "خوانده نشده"}}--}}
        // $('.message-status').on('click',function () {
        //     messageId = $(this).attr("date-messageid");
        //     console.log('hi!');
        //     console.log($(this).html());
        //     console.log(messageId);
        // })
    </script>
@endsection

