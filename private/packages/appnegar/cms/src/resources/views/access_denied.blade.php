<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AppNegar Content Management</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/admin/global_assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">

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

    <script src="{{asset('assets/admin/js/app.js')}}"></script>
    <!-- /theme JS files -->

</head>

<body>


<!-- Page content -->
<div class="page-content">

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Content area -->
        <div class="content d-flex justify-content-center align-items-center">

            <!-- Container -->
            <div class="flex-fill">

                <!-- Error title -->
                <div class="text-center mb-3">
                    <h1 class="error-title">{{__('main.messages.access_denied')}}</h1>
                    <h5>{{__('main.messages.access_denied_message')}}</h5>
                </div>
                <!-- /error title -->


            </div>
            <!-- /container -->

        </div>
        <!-- /content area -->


        <!-- Footer -->
        <div class="navbar navbar-expand-lg navbar-light">
            <div class="text-center d-lg-none w-100">
                <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
                    <i class="icon-unfold mr-2"></i>
                    Footer
                </button>
            </div>


        </div>
        <!-- /footer -->

    </div>
    <!-- /main content -->

</div>
<!-- /page content -->

</body>
</html>
