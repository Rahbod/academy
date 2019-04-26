@extends('main_template.master_pages.master')

@section('header')
    @include('main_template.modules.small_header')
@endsection

@section('content')
    <div class="col-md-8 mx-auto">
        <div class="card mt-4">
            <div class="card-header">{{ __('auth.login') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('login',['lang'=>session('lang')]) }}">
                    @csrf

                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('users.items.email') }}</label>

                        <div class="col-md-6">
                            <input dir="ltr" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('users.items.password') }}</label>

                        <div class="col-md-6">
                            <input dir="ltr" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label mr-4" for="remember">
                                    {{ __('auth.items.remember_me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('auth.login') }}
                            </button>

                            {{--<a class="btn btn-link" href="{{ route('password.request',['lang'=>session('lang')]) }}">--}}
                            {{--{{ __('auth.Forgot Your Password') }}--}}
                            {{--</a>--}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
