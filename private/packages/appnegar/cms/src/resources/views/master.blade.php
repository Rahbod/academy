<!DOCTYPE html>
<html lang="{{session('lang')}}" dir="{{session('direction')}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>سیستم مدیریت محتوا</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="app_url" content="{{env('APP_URL')}}">

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="{{asset('assets/admin/global_assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/admin/global_assets/css/icons/fontawesome/styles.min.css')}}" rel="stylesheet" type="text/css">

    @if(session('direction') == 'rtl')
    <link href="{{asset('assets/admin/css/rtl/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/admin/css/rtl/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/admin/css/rtl/layout.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/admin/css/rtl/components.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/admin/css/rtl/custom.css')}}" rel="stylesheet" type="text/css">
    @else
    <link href="{{asset('assets/admin/css/ltr/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/admin/css/ltr/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/admin/css/ltr/layout.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/admin/css/ltr/components.min.css')}}" rel="stylesheet" type="text/css">
    @endif

    <link href="{{ asset('assets/admin/global_assets/js/plugins/fonticonpicker/css/jquery.fonticonpicker.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/global_assets/js/plugins/fonticonpicker/themes/grey-theme/jquery.fonticonpicker.grey.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/global_assets/js/plugins/colorbox/colorbox.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('assets/admin/css/colors.min.cs')}}s" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{asset('assets/admin/global_assets/js/main/jquery.min.js')}}"></script>
    <script src="{{asset('assets/admin/global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/admin/global_assets/js/plugins/loaders/blockui.min.js')}}"></script>

    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{asset('assets/admin/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script src="{{asset('assets/admin/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/admin/global_assets/js/plugins/notifications/pnotify.min.js')}}"></script>
    <script src="{{asset('assets/admin/global_assets/js/plugins/nestable2/jquery.nestable.min.js')}}"></script>
    <script src="{{ asset('assets/admin/global_assets/js/plugins/fonticonpicker/jquery.fonticonpicker.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/global_assets/js/plugins/colorbox/jquery.colorbox-min.js')}}"></script>


    <script src="{{asset('assets/admin/js/app.js')}}"></script>
    <!-- /theme JS files -->

</head>

<body>

<div id="app">
    <main_component :user="{{$user}}" :department="'{{$department}}'" :lang_resource="JSON.parse('{{$lang_resource}}')"
                    :lang="'{{$lang}}'" :direction="'{{$direction}}'" :menu="JSON.parse('{{$menu}}')">

    </main_component>

</div>

<script type="text/javascript" src="{{ asset('assets/vue/'.session('department').'.js')}}"></script>
</body>
</html>
