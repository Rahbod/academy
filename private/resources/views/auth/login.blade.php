@extends('main_template.master_page.master')

@section('content')
    <section class="registerPage">
        <div class="dlab-bnr-inr overlay-black-middle">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">@lang('messages.global.login')</h1>
                    <!-- Breadcrumb row -->
                @include('main_template.modules.breadcrumb')
                <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <div class="section-full content-inner shop-account">
            <!-- Product -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="font-weight-700 m-t0 m-b20">@lang('messages.global.login-description')</h3>
                    </div>
                </div>
                <div>
                    <div class="max-w500 m-auto m-b30">
                        <div class="p-a30 border-1 seth">
                            <div class="tab-content nav">
                                <form method="post" id="login" enctype="multipart/form-data"
                                      action="{{ route('login',['lang'=>session('lang')]) }}"
                                      class="tab-pane col-12 p-a0 active">
                                    <h4 class="font-weight-700">@lang('messages.global.login')</h4>
                                    <p class="font-weight-600">@lang('messages.global.login-with')</p>
                                    <div class="form-group">
                                        <label class="font-weight-700">@lang('messages.global.email') *</label>
                                        <input id="email" name="email" required=""
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               value="{{ old('email') }}" autofocus
                                               placeholder="Your Email Id" type="email">
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-700">@lang('messages.global.password') *</label>
                                        <input name="password" required=""
                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               placeholder="Type Password" type="password">
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
                                        <button type="submit" class="site-button m-r5 button-lg radius-no">
                                            @lang('messages.global.login')
                                        </button>
                                        <a data-toggle="tab" href="#forgot-password" class="m-l5"><i
                                                    class="fa fa-unlock-alt"></i> @lang('messages.global.forgot-password')
                                        </a>
                                    </div>
                                </form>
                                <form method="post" id="forgot-password" enctype="multipart/form-data"
                                      action="{{ url(session('lang'). '/password/reset') }}"
                                      class="tab-pane fade col-12 p-a0">
                                    <h4 class="font-weight-700">@lang('messages.global.forgot-password') ?</h4>
                                    <p class="font-weight-600">
                                        @lang('messages.global.send-email')
                                    </p>
                                    <div class="form-group">
                                        <label class="font-weight-700">@lang('messages.global.email') *</label>
                                        <input name="email" required=""
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               placeholder="@lang('messages.global.email')" type="email"
                                               value="{{ old('email') }}"
                                               autofocus>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                        @endif
                                    </div>
                                    <div class="text-left">
                                        <a class="site-button outline gray button-lg radius-no"
                                           data-toggle="tab" href="#login">@lang('messages.global.back')</a>
                                        <button type="submit" class="site-button pull-right button-lg radius-no">
                                            @lang('messages.global.submit')
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
        $('form').on('submit', (e) => {
            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $(e.target);
            var url = form.attr('action');
            var type = form.attr('method');
            console.log(form);
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
                        $('#' + key).parents('.form-group').find('span.invalid-feedback').show().html(value[0]);
                        toaster('error', key, value);
                    });
                },
                fail: function (data) {
                    toaster('error', data.title, data.message);
                }
            });
        })
        ;
    </script>
@endpush
