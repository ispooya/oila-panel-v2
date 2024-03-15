@extends('layouts.dashboard')
@section('title', 'محصولات')
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
                        <div class="card-title border-bottom  d-flex justify-content-between"
                             style="margin-bottom: 1.5rem;">
                            <h6 class="card-title mb-3">
                                <i class="fa fa-user text-info align-middle"
                                   style="margin-left: 5px;font-size: 12px;"></i>
                                محصولات
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

                                @foreach($products as $product)
                                    <tr class="us-row-{{$product->id}}">
                                        <td class="type"><img src="{{$product->img }}" alt="" width="90"></td>
                                        <td class="type">{{$product->name}}</td>
                                        <td class="text-center">
                                                <span class="mr-1" data-toggle="tooltip"
                                                      title="ویرایش"
                                                >
                                                <a class="update-user"
                                                   href="/product/{{$product->id}}"
                                                   style="cursor: pointer;"
                                                >
  <i class="fa fa-pencil-square-o success align-middle"
     style="margin-top: 3px;font-size: 16px; color:forestgreen;"></i>
                                                </a>
                                            </span>
                                            <span class="mr-1 "
                                                  data-toggle="tooltip"
                                                  title="حذف">
                                                <a class="update-user"
                                                   href="/product/destroy/{{$product->id}}"
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
                            {{$products->links()}}
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
    <script>
        let filename = "";
        Dropzone.autoDiscover = false;
        $(document).ready(function () {
            $("#dZUpload").dropzone({
                maxFiles: 1,
                init: function () {
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
                    $('#logo').val(response['success']);
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
