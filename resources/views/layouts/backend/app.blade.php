<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Fresh Startup Project </title>
    <!--favicon-->
    <link rel="icon" href="{{asset('backend/assets/images/favicon.ico')}}" type="image/x-icon"/>
    <!-- Vector CSS -->
    <link href="{{asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
    <!-- simplebar CSS-->
    <link href="{{asset('backend/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet"/>
    <!-- Bootstrap core CSS-->
    <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet"/>

    <!-- animate CSS-->
    <link href="{{asset('backend/assets/css/animate.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Icons CSS-->
    <link href="{{asset('backend/assets/css/icons.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Sidebar CSS-->
    <link href="{{asset('backend/assets/css/sidebar-menu.css')}}" rel="stylesheet"/>
    <!-- Custom Style-->
    <link href="{{asset('backend/assets/css/app-style.css')}}" rel="stylesheet"/>
    <!-- skins CSS-->
    <link href="{{asset('backend/assets/css/skins.css')}}" rel="stylesheet"/>
    <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">
    @stack('css')
</head>

<body>

<!-- start loader -->
<div id="pageloader-overlay" class="visible incoming">
    <div class="loader-wrapper-outer"><div class="loader-wrapper-inner">
            <div class="loader"></div>
        </div>
    </div>
</div>
<!-- end loader -->

<!-- Start wrapper-->
<div id="wrapper">
    <!--Start sidebar-wrapper-->
    @include('backend.common.sidebar')
    <!--End sidebar-wrapper-->

    <!--Start topbar header-->
    @include('backend.common.header')
    <!--End topbar header-->

    <div class="clearfix"></div>

    <div class="content-wrapper">
        <div class="container-fluid">

            @yield('content')
            <!--start overlay-->
            <div class="overlay toggle-menu"></div>
            <!--end overlay-->
        </div>
        <!-- End container-fluid-->

    </div><!--End content-wrapper-->
    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

    <!--Start footer-->
   @include('backend.common.footer')
    <!--End footer-->

    <!--start color switcher-->
    @include('backend.common.settings')
    <!--end color switcher-->

</div><!--End wrapper-->

<!-- Bootstrap core JavaScript-->
<script src="{{asset('backend/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('backend/assets/js/popper.min.js')}}"></script>
<script src="{{asset('backend/assets/js/bootstrap.min.js')}}"></script>

<!-- simplebar js -->
<script src="{{asset('backend/assets/plugins/simplebar/js/simplebar.js')}}"></script>
<!-- sidebar-menu js -->
<script src="{{asset('backend/assets/js/sidebar-menu.js')}}"></script>
<!-- loader scripts -->
<script src="{{asset('backend/assets/js/jquery.loading-indicator.js')}}"></script>
<!-- Custom scripts -->
<script src="{{asset('backend/assets/js/app-script.js')}}"></script>
<!-- Chart js -->

<script src="{{asset('backend/assets/plugins/Chart.js/Chart.min.js')}}"></script>
<!-- Vector map JavaScript -->
<script src="{{asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{asset('backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- Easy Pie Chart JS -->
<script src="{{asset('backend/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
<!-- Sparkline JS -->
<script src="{{asset('backend/assets/plugins/sparkline-charts/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('backend/assets/plugins/jquery-knob/excanvas.js')}}"></script>
<script src="{{asset('backend/assets/plugins/jquery-knob/jquery.knob.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
<script src="{{ asset('js/iziToast.js') }}"></script>
@include('vendor.lara-izitoast.toast')
@stack('js')
<script>
    $(function() {
        $(".knob").knob();
    });
</script>

<!-- Index js -->
<script src="{{asset('backend/assets/js/index.js')}}"></script>

</body>
</html>
