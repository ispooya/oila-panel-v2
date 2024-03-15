@extends('layouts.dashboard')
@section('title', 'سوالات متداول')
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
                        <div class="card-title border-bottom" style="margin-bottom: 1.5rem;">
                            <h6 class="card-title mb-3">
                                <i class="fa fa-plus text-success align-middle"
                                   style="margin-left: 5px;font-size: 12px;"></i>
                                افزودن
                            </h6>
                        </div>
                        <div class="row">

                            <div class="col-lg-12 col-md-12 col-12">
                                <form action="{{route('faq.update', $faq->id)}}" method="POST">
                                    <div class="form-group">
                                        <label for="name">سوال</label>
                                        <input type="text" class="form-control" id="question" name="question" title=""
                                               value="{{$faq->question}}" required autofocus
                                               oninvalid="this.setCustomValidity('وارد کردن سوال اجباری است.')"
                                               oninput="setCustomValidity('')">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">پاسخ</label>
                                        <textarea type="text" class="form-control" id="answer" name="answer"
                                                  title=""
                                                  value="" required
                                                  oninvalid="this.setCustomValidity('وارد کردن پاسخ اجباری است.')"
                                                  oninput="setCustomValidity('')">{{$faq->answer}}</textarea>
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
        </div>
    </div>
@endsection
@section('script')
@endsection
