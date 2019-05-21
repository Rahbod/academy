@extends('main_template.master_page.master')
@push('meta_tags')
    <meta name="robots" content="noindex">
@endpush
@push('styles')
    <link rel="stylesheet" type="text/css" media="screen" href={{asset("assets/site/css/message.css")}}>

    <style>

        .background-danger {
            background-color: #a06166;
        }

        .background-danger:hover {
            background-color: #c0797f !important;
        }

        .background-success {
            background-color: #16a085c2;
        }

        .background-success:hover {
            background-color: #16A085;
        }

        .background-warning {
            background-color: #bd720c;
        }

        .background-warning:hover {
            background-color: #d1800c;
        }

        .background-primary {
            background-color: #0146A0;
        }

        .background-primary:hover {
            background-color: #015acf;
        }

        header {
            height: 0 !important;
            min-height: 0;
            margin: 0;
            padding: 0;
        }


    </style>
@endpush

@section('content')
    <section>
        <div class="d-flex justify-content-center">
            <div class="message__container shadow alert alert-{{$type}}">
                <div class="d-flex justify-content-center" style="margin-bottom: 4rem;">
                    <a class="message_about-link text-center" href="{{url('/')}}">
                        {{--<img src="{{asset('images/home/header/logoSquare.png')}}"--}}
                        {{--class="message_logo w-50 img-thumbnail background-{{$type}}" alt="">--}}
                        Academy Logo
                    </a>
                </div>
                <div class="my-4">
                    <h3 class="text-center mb-3">{{$title}}</h3>
                    <p class="message_text text-center">{!! $message !!}</p>

                    <a class="btn message_home-link background-{{$type}}" href="{{url(session('lang'). '/')}}">
                        @lang('messages.global.home')
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

