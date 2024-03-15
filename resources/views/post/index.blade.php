@extends('layouts.dashboard')
@section('title', 'اخبار')
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title border-bottom  d-flex justify-content-between"
                             style="margin-bottom: 1.5rem;">
                            <h6 class="card-title mb-3">
                                <i class="fa fa-user text-info align-middle"
                                   style="margin-left: 5px;font-size: 12px;"></i>
                                اخبار
                            </h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                <tr style="background: aliceblue;">
                                    <th>عنوان</th>
                                    <th>خلاصه</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($posts as $post)
                                    <tr class="us-row-{{$post->id}}">
                                        <td class="type">{{$post->title }}</td>
                                        <td class="type">{{$post->shortContent}}</td>
                                        <td class="text-center">
                                                <span class="mr-1" data-toggle="tooltip"
                                                      title="ویرایش"
                                                >
                                                <a class="update-user"
                                                   href="/post/{{$post->id}}"
                                                   style="cursor: pointer;"
                                                >
  <i class="fa fa-pencil-square-o success align-middle"
     style="margin-top: 3px;font-size: 16px; color:forestgreen;"></i>
                                                </a>
                                            </span>
                                            <span class="mr-1 "
                                                  data-toggle="tooltip"
                                                  title="حذف خبر">
                                                <a class="update-user"
                                                   href="/post/destroy/{{$post->id}}"
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
                            {{$posts->links()}}
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
        showRemoveModal = function (id) {

            $('.remove-modal').modal('show');
            $('.idget').val(id);
        }

        removeCustomer = function (id) {
            window.location.href = "/customer/destroy/" + id;

        }

    </script>
@endsection
