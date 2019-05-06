<!doctype html>
<html lang="en">

<head>
    <!-- ===== meta tags : start =====-->

    {{--<meta name="googlebot" content="index,follow">--}}
    {{--    <meta name="keywords" content="{{$config['main']['meta_keywords']}}">--}}
    {{--    <meta name="description" content="{{$config['main']['meta_description']}}">--}}

    <meta name="title" content="language academy">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="theme-color" content="#0e1d29">

    @stack('meta_tags')

<!-- ===== styles : start =====-->

    {{--<link rel="icon" type="image/png" sizes="300x300" href="{{asset('')}}">--}}
    <link rel="stylesheet" type="text/css" href="{{asset('./assets/site/css/bootstrap.min.css')}}">
    {{--<link rel="stylesheet" type="text/css" href="{{asset('./assets/site/css/global.css')}}">--}}
    <link rel="stylesheet" type="text/css" href="{{asset('./assets/site/js/vendors/toastr/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('./assets/site/fonts/fontawesome-5-pro/css/all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('./assets/site/css/global.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('./assets/site/css/sidebar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('./assets/site/css/responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('./assets/site/js/vendors/slick/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('./assets/site/js/vendors/slick/slick-theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('./assets/site/css/iran-sans.css')}}">
    {{--<link rel="stylesheet" type="text/css" href="{{asset('./assets/site/css/iran-sans-fa-num.css')}}">--}}

    @stack('styles')

    <style>
        .g-recaptcha {
            -webkit-transform: scale(0.7);
            -moz-transform: scale(0.7);
            -ms-transform: scale(0.7);
            -o-transform: scale(0.7);
            transform: scale(0.7);
        }
    </style>
</head>
<body>

{{--@yield('header')--}}
@include('main_template.modules.header')

<main id="app" class="main">
    @yield('content')
</main>

@include('main_template.modules.footer')
<div class="overlay"></div>

<script type="text/javascript" src="{{asset('assets/site/js/jquery.min.js')}}"></script>
{{--<script type="text/javascript" src="{{asset('assets/site/js/vendors/popper/popper.min.js')}}"></script>--}}
<script type="text/javascript" src="{{asset('./assets/site/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('./assets/site/js/vendors/toastr/toastr.min.js')}}"></script>
<script type="text/javascript" src="{{asset('./assets/site/js/vendors/html5lightbox/html5lightbox.js')}}"></script>
<script type="text/javascript" src="{{asset('./assets/site/js/vendors/slick/slick.min.js')}}"></script>
<script type="text/javascript" src="{{asset('./assets/site/js/global.js')}}"></script>

@stack('scripts')


</body>
</html>