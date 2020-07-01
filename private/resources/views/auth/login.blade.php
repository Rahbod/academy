@extends('main_template.master_page.master')

@push('styles')
    <style>
        .captchaImageContainer img {
            height: 100%;
        }

        .site-button.outline:hover {
            border-color: #1a7f4b;
            background-color: #21ab64;
            color: #fff;
        }

        .tab-content.nav {
            flex: 1 1 auto;
        }

        @media (max-width: 575.98px) {
            .tab-content.nav:first-child {
                border-bottom: 1px solid #ccc;
                padding-bottom: 2rem;
                margin-bottom: 2rem;
            }
        }

        @media (min-width: 576px) {
            .reg {
                border-right: 1px solid #ccc;
                padding-right: 1rem;
            }

            .tab-content.nav {
                flex: 1 1 0%;
            }
        }
    </style>
@endpush

@section('content')
    <section class="registerPage">
        <div class="section-full content-inner shop-account">
            <!-- Product -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="font-weight-700 m-t0 m-b20">
                            @lang('messages.global.login')
                        </h3>
                    </div>
                </div>
                <div>
                    <div style="max-width: 800px;" class="m-auto m-b30 bg-white">
                        <div class="p-a30 border-1 seth d-flex flex-wrap flex-md-nowrap">
                            <div class="tab-content nav">
                                <form method="post" id="login" enctype="multipart/form-data"
                                      action="{{ route('login',['lang'=>session('lang')]) }}"
                                      class="tab-pane col-12 p-a0 active">
                                    @csrf
                                    <h4 class="font-weight-700">@lang('messages.global.login-description')</h4>
                                    {{--                                    <p class="font-weight-600">اگر هنوز عضو نشده اید، میتوانید از--}}
                                    {{--                                        <a style="text-decoration: underline;color:#000;font-weight: bold;" title="@lang('messages.global.register')" href="{{route('register',['lang'=>session('lang')])}}">اینجا</a>--}}
                                    {{--                                        ثبت نام نمایید.--}}
                                    {{--                                    </p>--}}
                                    <div class="form-group">
                                        <label class="font-weight-700">@lang('messages.global.email') *</label>
                                        <input id="email" name="email" required="" autocomplete="false"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               value="{{ old('email') }}" autofocus
                                               placeholder="ایمیل را وارد نمایید." type="email">
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-700">@lang('messages.global.password') *</label>
                                        <input name="password" required="" autocomplete="false"
                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               placeholder="@lang('messages.global.fill_password')" type="password">
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-12">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"
                                                           name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('messages.global.remember-me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="">
                                        <button type="submit" class="site-button ml-5 button-lg radius-no">
                                            @lang('messages.global.login')
                                        </button>
                                        <a class="m-l5" href="{{url(session('lang').'/password/reset')}}">
                                            <i class="fa fa-unlock-alt"></i> @lang('messages.global.forgot-password')
                                        </a>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-content nav reg">
                                <form enctype="multipart/form-data" id="register" method="post"
                                      action="{{ route('register',['lang'=>session('lang')]) }}"
                                      class="tab-pane active">
                                    @csrf
                                    <h4 class="font-weight-700">@lang('messages.global.register')</h4>

                                    {{--                                    <p class="font-weight-600">اگر قبلا ثبت نام کرده اید، میتوانید از--}}
                                    {{--                                        <a style="text-decoration: underline;color:#000;font-weight: bold;"--}}
                                    {{--                                           title="@lang('messages.global.login')"--}}
                                    {{--                                           href="{{route('login',['lang'=>session('lang')])}}">اینجا</a>--}}
                                    {{--                                        وارد شوید.--}}
                                    {{--                                    </p>//--}}
                                    <div class="form-group">
                                        <label for="first_name" class="font-weight-700">نام</label>
                                        <input tabindex="1" name="first_name" id="first_name" required
                                               class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                               placeholder="نام را وارد نمایید" value="{{ old('first_name') }}"
                                               type="text">
                                        @if ($errors->has('first_name'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name" class="font-weight-700">نام خانوادگی</label>
                                        <input tabindex="2" name="last_name" id="last_name"
                                               placeholder="نام خانوادگی را وارد نمایید."
                                               class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                               value="{{ old('last_name') }}" required
                                               type="text">
                                        @if ($errors->has('last_name'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="font-weight-700">ایمیل *</label>
                                        <input tabindex="3" name="email" required id="email"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               placeholder="ایمیل را وارد نمایید." value="{{ old('email') }}"
                                               type="email">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-700">شماره تلفن همراه *</label>
                                        <input tabindex="4" name="mobile_number" required
                                               class="form-control{{ $errors->has('mobile_number') ? ' is-invalid' : '' }}"
                                               placeholder="شماره تلفن همراه را وارد نمایید." type="tel"
                                               value="{{ old('mobile_number') }}">
                                        @if ($errors->has('mobile_number'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('mobile_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="font-weight-700">رمز عبور *</label>
                                        <input tabindex="5" name="password" required id="password"
                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               placeholder="رمزعبور را وارد نمایید." type="password"
                                               value="{{ old('password') }}">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <label for="password_confirmation" class="font-weight-700">تایید رمز عبور
                                            *</label>
                                        <input tabindex="6" name="password_confirmation" required
                                               class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                               placeholder="رمزعبور را دوباره وارد نمایید." type="password"
                                               value="{{ old('password_confirmation') }}">
                                        @if ($errors->has('password_confirmation'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <div class="d-flex justify-content-between" id="captcha_image">
                                            <div class="captchaImageContainer">
                                                {!! captcha_img('flat'); !!}
                                            </div>

                                            <input type="text"
                                                   class="form-control ml-2 {{ $errors->has('captcha') ? ' is-invalid' : '' }}"
                                                   autocomplete="captcha"
                                                   spellcheck="false"
                                                   tabindex="7"
                                                   name="captcha" required
                                                   id="captcha">

                                            <a style="padding: 16px 17px 6px;" data-lang="{{session('lang')}}"
                                               href="void:;"
                                               class="renewCaptchaImage btn border">
                                                <i class="far fa-redo"></i>
                                            </a>
                                        </div>
                                        @if ($errors->has('captcha'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('captcha') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="">
                                        <button tabindex="8" type="submit" class="site-button button-lg radius-no">
                                            @lang('messages.global.register')
                                        </button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product END -->
        </div>
    </section>
@endsection

@push('scripts')
    {{--    login--}}
    <script>
        //        $('form').on('submit', (e) => {
        //            e.preventDefault(); // avoid to execute the actual submit of the form.
        //
        //            var form = $(e.target);
        //            var url = form.attr('action');
        //            var type = form.attr('method');
        //            console.log(form);
        //            var formData = new FormData(form[0]);
        //
        //            $.ajax({
        //                type: type,
        //                url: url,
        //                processData: false,
        //                contentType: false,
        //                data: formData, // serializes the form's elements.
        //                success: function (response) {
        //                    console.log(response);
        //                    toaster('success', response.title, response.message);
        //                    window.location.href = '/';
        //                },
        //                error: function (data) {
        //                    $.each(data.responseJSON.errors, function (key, value) {
        //                        $('#' + key).parents('.form-group').find('span.invalid-feedback').show().html(value[0]);
        //                        toaster('error', key, value);
        //                    });
        //                },
        //                fail: function (data) {
        //                    toaster('error', data.title, data.message);
        //                }
        //            });
        //        })
        //         ;
    </script>

    {{--    register--}}
    <script>
        $('#registerdsassadasd').on('submit', (e) => {
            e.preventDefault();

            var form = $(e.target);
            var url = form.attr('action');
            var type = form.attr('method');
            var formData = new FormData(form[0]);

            $.ajax({
                type: type,
                url: url,
                processData: false,
                contentType: false,
                data: formData, // serializes the form's elements.
                success: function (response) {
                    console.log(response);
                    toaster('success', response.title, response.message);
                    window.location.href = '/';
                },
                error: function (data) {
                    $.each(data.responseJSON.errors, function (key, value) {
                        $('#' + key).parents('.form-group').find('.invalid-feedback span').show().html(value[0]);
                        toaster('error', key, value);
                    });
                },
                fail: function (data) {
                    toaster('error', data.title, data.message);
                }
            });
        });

        $('.renewCaptchaImage').on('click', function () {
            var lang = $(this).attr('data-lang');
            $.ajax({
                type: 'get',
                url: '/' + lang + '/renew-captcha-image',
                success: function (response) {
                    $('.captchaImageContainer').html(response);
                },
                fail: function (error) {
                }
            });
        });

    </script>
@endpush
