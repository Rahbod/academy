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
    </style>
@endpush

@section('content')
    <section class="registerPage">
{{--        <div class="dlab-bnr-inr overlay-black-middle">--}}
{{--            <div class="container">--}}
{{--                <div class="dlab-bnr-inr-entry">--}}
{{--                    <h1 class="text-white">Register</h1>--}}
{{--                    <!-- Breadcrumb row -->--}}
{{--                @include('main_template.modules.breadcrumb')--}}
{{--                <!-- Breadcrumb row END -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="section-full content-inner shop-account">
            <!-- Product -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="font-weight-700 m-t0 m-b20">Create An Account</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 m-b30">
                        <div class="p-a30 border-1  max-w500 m-auto">
                            <div class="tab-content">
                                <form enctype="multipart/form-data" id="register" method="post"
                                      action="{{ route('register',['lang'=>session('lang')]) }}"
                                      class="tab-pane active">
                                    @csrf
                                    <h4 class="font-weight-700">PERSONAL INFORMATION</h4>
                                    <p class="font-weight-600">If you have an account with us, please log in.</p>
                                    <div class="form-group">
                                        <label class="font-weight-700">Full Name</label>
                                        <input tabindex="1" name="name" class="form-control" placeholder="Full Name"
                                               type="text">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-700">User Name *</label>
                                        <input tabindex="2" name="username" required=""
                                               class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                               placeholder="User Name" value="{{ old('username') }}"
                                               type="text">
                                        @if ($errors->has('username'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-700">E-MAIL *</label>
                                        <input tabindex="3" name="email" required=""
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               placeholder="Email" value="{{ old('email') }}"
                                               type="email">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-700">Mobile Number *</label>
                                        <input tabindex="4" name="mobile_number" required=""
                                               class="form-control{{ $errors->has('mobile_number') ? ' is-invalid' : '' }}"
                                               placeholder="Mobile Number" type="text"
                                               value="{{ old('mobile_number') }}">
                                        @if ($errors->has('mobile_number'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('mobile_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-700">Melli Code</label>
                                        <input tabindex="5" name="melli_code"
                                               class="form-control{{ $errors->has('melli_code') ? ' is-invalid' : '' }}"
                                               placeholder="Melli Code" value="{{ old('melli_code') }}"
                                               type="text">
                                        @if ($errors->has('melli_code'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('melli_code') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-700">Gender *</label>
                                        <select tabindex="6" class="form-control" name="gender" id="gender">
                                            <option value="0">male</option>
                                            <option value="1">female</option>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label class="font-weight-700">PASSWORD *</label>
                                        <input tabindex="7" name="password" required=""
                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               placeholder="Type Password" type="password"
                                               value="{{ old('password') }}">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <label class="font-weight-700">PASSWORD CONFIRMATION *</label>
                                        <input tabindex="9" name="password_confirmation" required
                                               class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                               placeholder="Type Your Password Again" type="password"
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
                                                   tabindex="10"
                                                   name="captcha" required
                                                   id="captcha">

                                            <a style="padding: 10px 16px;" data-lang="{{session('lang')}}"
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

                                    <div class="text-left">
                                        <button tabindex="11" type="submit"
                                                class="site-button button-lg radius-no outline outline-2">Register
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
