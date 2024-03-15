<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('title') - گلرنگ سیستم</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}">
    <!-- Plugin styles -->
    <link rel="stylesheet" href="{{asset('vendors/bundle.css')}}">
    <!-- Dropzone -->
    <link rel="stylesheet" href="{{asset('vendors/dropzone/dropzone.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('dist/css/datatables.css')}}">
    <!-- Datepicker -->
    <link rel="stylesheet" href="{{asset('vendors/datepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/persianDatepicker-default.css')}}">
    <!-- Fullcalendar -->
    <link rel="stylesheet" href="{{asset('vendors/fullcalendar/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/Cal/fullcalendar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/Cal/fullcalendar.print.css')}}" media='print'>
    <!-- Vmap -->
    <link rel="stylesheet" href="{{asset('vendors/vmap/jqvmap.min.css')}}">
    <!-- App styles -->
    <link rel="stylesheet" href="{{asset('assets/css/app.min.css')}}">
    <!-- Dropzone -->
    <link rel="stylesheet" href="{{asset('dist/dropzone/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/dataTable/dataTables.min.css')}}" type="text/css">
    <script src="{{ asset('dist/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>

    @yield('head')

</head>
<body>
<div class="preloader">
    <div class="preloader-icon"></div>
</div>
<div class="header bg-primary-bright">
    <div>
        <ul class="navbar-nav">
            <li class="nav-item navigation-toggler">
                <a class="nav-link" data-toggle="tooltip" data-placement="left" title="مخفی کردن منو"
                   style="cursor: pointer;">
                    <i data-feather="arrow-left"></i>
                </a>
            </li>
            <li class="nav-item navigation-toggler mobile-toggler">
                <a class="nav-link" data-toggle="tooltip" data-placement="left" title="نمایش منو"
                   style="cursor: pointer;">
                    <i class="fa fa-bars" style="font-size: 19px;"></i>
                </a>
            </li>
        </ul>
    </div>
{{--    <div class="page-header">--}}
{{--        <nav aria-label="breadcrumb" style="padding: 5px 5px 0 0">--}}
{{--            <ul class="breadcrumb">--}}
{{--                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">داشبورد</a></li>--}}
{{--                <li class="breadcrumb-item active" aria-current="page">{{trans('segments.'.request()->path())}}</li>--}}
{{--            </ul>--}}
{{--        </nav>--}}
{{--    </div>--}}
</div>
<div id="main">
    @include('layouts.menu')
    <div class="main-content pb-0">
        @yield('page-content')
        <hr class="m-0">
        <footer class="text-center">
            <div>© 2021، کلیه حقوق این وب‌سایت متعلق به مجموعه گلرنگ سیستم است.</div>
        </footer>
    </div>
</div>

@yield('other-content')

<!-- Plugin scripts -->
<script src="{{asset('vendors/bundle.js')}}"></script>
<script>
    $('[data-toggle="tooltip"]').on('click', function () {
        $(this).tooltip('hide');
    });
</script>
<!-- jQuery Validator -->
<script src="{{asset('dist/js/jquery.validate.js')}}"></script>
<!-- Dropzone -->
<script src="{{asset('vendors/dropzone/dropzone.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('dist/js/datatables.js')}}"></script>
<script src="{{asset('assets/js/examples/datatable.js')}}"></script>
<!-- bootstrap-number-input -->
<script src="{{asset('dist/js/bootstrap-number-input.js')}}"></script>
<!-- number-divider -->
<script src="{{asset('dist/js/number-divider.js')}}"></script>
<script>
    $('.divide').divide();
</script>
<!-- Chartjs -->
<script src="{{asset('vendors/charts/chartjs/chart.min.js')}}"></script>
<!-- Apex chart -->
<script src="{{asset('vendors/charts/apex/apexcharts.min.js')}}"></script>
<!-- Circle progress -->
<script src="{{asset('vendors/circle-progress/circle-progress.min.js')}}"></script>
<!-- Peity -->
<script src="{{asset('vendors/charts/peity/jquery.peity.min.js')}}"></script>
<script src="{{asset('assets/js/examples/charts/peity.js')}}"></script>
<!-- Datepicker -->
<script src="{{asset('vendors/datepicker/daterangepicker.js')}}"></script>
<script src="{{asset('dist/js/persianDatepicker.js')}}"></script>
<script src="{{asset('vendors/datepicker/bootstrap-datepicker.fa.min.js')}}"></script>
<!-- Slick -->
<script src="{{asset('vendors/slick/slick.min.js')}}"></script>
<!-- Vamp -->
<script src="{{asset('vendors/vmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('vendors/vmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{asset('assets/js/examples/vmap.js')}}"></script>
<!-- a -->
<script src="{{asset('assets/Cal/moment.js')}}"></script>
<script src="{{asset('assets/Cal/moment-jalaali.js')}}"></script>
<script src="{{asset('assets/Cal/fullcalendar.js')}}"></script>
<script src="{{asset('assets/Cal/fa.js')}}"></script>
<!-- Dashboard scripts -->
<script src="{{asset('assets/js/examples/dashboard.js')}}"></script>
<!-- To use theme colors with Javascript -->
<div class="colors">
    <div class="bg-primary"></div>
    <div class="bg-primary-bright"></div>
    <div class="bg-secondary"></div>
    <div class="bg-secondary-bright"></div>
    <div class="bg-info"></div>
    <div class="bg-info-bright"></div>
    <div class="bg-success"></div>
    <div class="bg-success-bright"></div>
    <div class="bg-danger"></div>
    <div class="bg-danger-bright"></div>
    <div class="bg-warning"></div>
    <div class="bg-warning-bright"></div>
</div>
<!-- App scripts -->
<script src="{{asset('assets/js/app.min.js')}}"></script>

{{--<script src="{{asset('assets/js/jquery.tinymce.min.js')}}"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.2.0/tinymce.min.js"></script>--}}
<!-- Dropzone -->
<script src="{{asset('dist/dropzone/dropzone.js')}}"></script>
<!-- Javascript -->
<script src="{{asset('vendors/dataTable/jquery.dataTables.min.js')}}"></script>

<!-- Bootstrap 4 and responsive compatibility -->
<script src="{{asset('vendors/dataTable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/dataTable/dataTables.responsive.min.js')}}"></script>

@yield('script')
</body>
</html>
