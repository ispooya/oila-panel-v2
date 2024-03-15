@extends('layouts.dashboard')
@section('title', 'لیست کاربران')
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
                                کاربران
                            </h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr style="background: aliceblue;">
                                    <th>نام و نام خانوادگی</th>
                                    <th>ایمیل</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr class="us-row-{{$user->id}}">
                                        <td class="name font-weight-bold">{{$user->name}}</td>
                                        <td class="phone">{{$user->email}}</td>
                                        <td class="text-center">
                                            <span class="mr-1" data-toggle="tooltip" title="ویرایش">
                                                <a class="update-user"
                                                   href="/user/{{$user->id}}"
                                                   data-userId="{{$user->id}}" style="cursor: pointer;">
                                                    <i class="fa fa-edit align-middle"
                                                       style="margin-top: 3px;font-size: 16px;"></i>
                                                </a>
                                            </span>
                                            <div class="custom-control custom-switch d-inline-block align-middle">
                                                <input type="checkbox" class="custom-control-input" id="disable-switch-{{$user->id}}" data-userId="{{$user->id}}" {{$user->active == 1 ? 'checked' : ''}}>
                                                <label for="disable-switch-{{$user->id}}" class="custom-control-label" id="d-switch-{{$user->id}}" style="cursor: pointer;" onclick="disableUser({{$user->id}})">{{$user->active == 1 ? 'فعال' : 'غیرفعال'}}</label>
                                            </div>
                                            {{--                                            <span data-toggle="tooltip" title="حذف">--}}
                                            {{--                                                <a data-toggle="modal" data-target="#modal-danger-{{$user->id}}"--}}
                                            {{--                                                   style="cursor: pointer;">--}}
                                            {{--                                                    <i class="fa fa-times text-danger align-middle"--}}
                                            {{--                                                       style="font-size: 19px;"></i>--}}
                                            {{--                                                </a>--}}
                                            {{--                                            </span>--}}
                                        </td>
                                    </tr>
                                    <div class="modal modal-danger fade" id="modal-danger-{{$user->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">حذف کاربر</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p style="font-size: 16px;">
                                                        آیا از حذف
                                                        <span class="userName font-weight-bold">{{$user->name}}</span>
                                                        مطمئن اید؟ در این صورت تمامی سابقه این کاربر حذف خواهد شد.
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-danger"
                                                            onclick="location.href='/user/destroy/{{$user->id}}'">
                                                        <i class="ti ti-trash" style="margin-left: 5px;"></i>
                                                        حذف شود
                                                    </button>
                                                    <button type="button" class="btn btn-outline"
                                                            data-dismiss="modal">لغو
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
{{--                            {{$users->links()}}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#success-alert').delay(3000).fadeOut();
        });
    </script>
    <script>
        disableUser = function (id) {
            var active;
            if ($('input[data-userId='+id+']').is(':checked')) {
                active = 0;
            } else {
                active = 1;
            }
            var _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{route('user.disable')}}",
                type: "POST",
                data: {
                    userId: id,
                    active: active,
                    _token: _token,
                },
                success: function (response) {
                    if (response['active'] == 1) {
                        swal("توجه!", "کاربر مورد نظر با موفقیت فعال شد.", "success");
                        $('label[id="d-switch-'+id+'"]').html('فعال');
                    } else {
                        swal("توجه!", "کاربر مورد نظر با موفقیت غیرفعال شد.", "success");
                        $('label[id="d-switch-'+id+'"]').html('غیرفعال');
                    }
                }
            });
        }
    </script>
@endsection
