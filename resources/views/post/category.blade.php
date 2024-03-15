@extends('layouts.dashboard')
@section('title', 'دسته بندی مجله')
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
                                افزودن دسته بندی
                            </h6>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-6">
                                <form action="{{route('category.store')}}" method="POST">
                                    <div class="form-group">
                                        <label for="name">عنوان</label>
                                        <input type="text" class="form-control" id="name" name="name" title=""
                                               value="{{old('name')}}" required autofocus
                                               oninvalid="this.setCustomValidity('وارد کردن عنوان ویژگی اجباری است.')"
                                               oninput="setCustomValidity('')">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">توضیح کوتاه</label>
                                        <input type="text" class="form-control" id="description" name="description" title=""
                                               value="{{old('description')}}" required autofocus
                                               oninvalid="this.setCustomValidity('وارد کردن توضیح اجباری است.')"
                                               oninput="setCustomValidity('')">
                                    </div>
                                    @include('shared.errors')
                                    <button type="submit"
                                            class="btn btn-success btn-uppercase pull-left" style="margin-left: 5px;">
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title border-bottom  d-flex justify-content-between"
                             style="margin-bottom: 1.5rem;">
                            <h6 class="card-title mb-3">
                                <i class="fa fa-user text-info align-middle"
                                   style="margin-left: 5px;font-size: 12px;"></i>
                                لیست دسته بندی ها
                            </h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                <tr style="background: aliceblue;">
                                    <th>نام</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($categories as $category)
                                    <tr class="us-row-{{$category->id}}">
                                        <td class="type">{{$category->name}}</td>
                                        <td class="text-center">
                                            <span class="mr-1 "
                                                    data-toggle="tooltip"
                                                    title="حذف ">
                                                <a class="update-user"
                                                    href="{{route('category.destroy',$category->id)}}"
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

