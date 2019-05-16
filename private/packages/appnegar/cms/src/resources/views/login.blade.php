<!DOCTYPE html>
<html  lang="{{session('lang')}}" dir="{{session('direction')}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>پنل مدیریت محتوا</title>

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

    <style>  #rc-imageselect, .g-recaptcha {
            -webkit-transform: scale(0.92);
            -moz-transform: scale(0.92);
            -ms-transform: scale(0.92);
            -o-transform: scale(0.92);
            transform: scale(0.92);
            transform-origin:95% 0
        }
    </style>

</head>

<body>

<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-dark">
    <div class="navbar-brand">
        <a href="index.html" class="d-inline-block">
            <img src="{{asset('assets/admin/global_assets/images/logo_light.png')}}" alt="">
        </a>
    </div>
</div>
<!-- /main navbar -->


<!-- Page content -->
<div class="page-content">

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Content area -->
        <div class="content d-flex justify-content-center align-items-center">

            <!-- Login form -->
            <form class="login-form" action="{{ route($route,['department'=>session('department'),'lang'=>session('lang')]) }}"  method="POST">
                {{ csrf_field() }}
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h5 class="mb-0">ورود به پنل مدیریت</h5>
                            <span class="d-block text-muted">ایمیل و رمز عبور خود را وارد کنید</span>
                        </div>

                        <div class="form-group form-group-feedback form-group-feedback-left @if ($errors->has('email')) has-error @endif">
                            <input type="text" class="form-control" placeholder="ایمیل" name="email" value="{{ old('email') }}">
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group form-group-feedback form-group-feedback-left @if ($errors->has('password')) has-error @endif">
                            <input type="password" class="form-control" name="password" placeholder="رمز عبور">
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <div class="form-group has-feedback @if ($errors->has('g-recaptcha-response')) has-error @endif ">
                            {{--{!! NoCaptcha::renderJs('fa') !!}--}}

                            {{--{!! NoCaptcha::display() !!}--}}


                            @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('g-recaptcha-response') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">ورود <i class="icon-circle-left2 ml-2"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /login form -->

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

            <div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy; 2015 - 2019. <a href="#">Rahbod Content Management</a></a>
					</span>
            </div>
        </div>
        <!-- /footer -->

    </div>
    <!-- /main content -->

</div>
<!-- /page content -->

</body>
</html>
