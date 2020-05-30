@extends('main_template.master_page.master')

@push('styles')
    <style>.mapouter {
            position: relative;
            text-align: right;
            height: auto;
            width: 100%;
        }

        .gmap_canvas {
            overflow: hidden;
            background: none !important;
            height: auto;
            width: 100%;
        }</style>
@endpush

@section('content')
    <section class="contactUs">
{{--        <div class="dlab-bnr-inr overlay-black-middle">--}}
{{--            <div class="container">--}}
{{--                <div class="dlab-bnr-inr-entry">--}}
{{--                    <h1 class="text-white">@lang('messages.global.contact-us')</h1>--}}
{{--                    <!-- Breadcrumb row -->--}}
{{--                @include('main_template.modules.breadcrumb')--}}
{{--                <!-- Breadcrumb row END -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="section-full content-inner bg-white contact-style-1">
            <div class="container">
                <div class="row">
                    <!-- right part start -->
                    <div class="col-lg-4 col-md-6 d-lg-flex d-md-flex">
                        <div class="p-a30 border m-b30 contact-area border-1 align-self-stretch ">
                            <h4 class="m-b10">@lang('messages.global.quick-contact')</h4>
                            <p>If you have any questions simply use the following contact details.</p>
                            <ul class="no-margin">
                                <li class="icon-bx-wraper left m-b30">
                                    <div class="icon-bx-xs border-1"><a href="#" class="icon-cell"><i
                                                    class="fas fa-map-marker-alt"></i>
                                        </a></div>
                                    <div class="icon-content">
                                        <h6 class="text-uppercase m-tb0 dlab-tilte">@lang('messages.global.address')
                                            :</h6>
                                        <p>{{config('system.about_us.address')}}</p>
                                    </div>
                                </li>
                                <li class="icon-bx-wraper left  m-b30">
                                    <div class="icon-bx-xs border-1"><a href="#" class="icon-cell"><i
                                                    class="far fa-envelope"></i></a></div>
                                    <div class="icon-content">
                                        <h6 class="text-uppercase m-tb0 dlab-tilte">@lang('messages.global.email')
                                            :</h6>
                                        <p>{{config('system.about_us.email')}}</p>
                                    </div>
                                </li>
                                <li class="icon-bx-wraper left">
                                    <div class="icon-bx-xs border-1"><a href="#" class="icon-cell"><i
                                                    class="fas fa-phone-office"></i></a></div>
                                    <div class="icon-content">
                                        <h6 class="text-uppercase m-tb0 dlab-tilte">@lang('messages.global.phone')
                                            :</h6>
                                        <p>{{config('system.about_us.phone')}}</p>
                                    </div>
                                </li>
                            </ul>
                            <div class="m-t20">
                                <ul class="dlab-social-icon dlab-social-icon-lg">
                                    <li><a title="whatsapp account" href="{{config('system.about_us.whatsapp')}}"
                                           class="site-button whatsapp sharp"><i
                                                    class="fab fa-whatsapp"></i></a></li>
                                    <li><a title="linked_in account" href="{{config('system.about_us.linked_in')}}"
                                           class="site-button linkedin sharp"><i
                                                    class="fab fa-linkedin-in"></i></a></li>
                                    <li><a title="telegram account" href="{{config('system.about_us.telegram')}}"
                                           class="site-button telegram sharp"><i class="fab fa-telegram-plane"></i></a>
                                    </li>
                                    <li><a title="twitter account" href="{{config('system.about_us.twitter')}}"
                                           class="site-button twitter sharp"><i
                                                    class="fab fa-twitter"></i></a></li>
                                    <li><a title="instagram account" href="{{config('system.about_us.instagram')}}"
                                           class="site-button instagram sharp"><i
                                                    class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- right part END -->
                    <!-- Left part start -->
                    <div class="col-lg-4 col-md-6">
                        <div class="p-a30 m-b30 bg-gray clearfix">
                            <h4>@lang('messages.global.send-message-us')</h4>
                            <div class="dzFormMsg"></div>
                            <form enctype="multipart/form-data" method="post" class="contactUsForm"
                                  action="{{url(session('lang').'/contact-us')}}">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <select style="padding:0 20px;" class="form-control select-lg"
                                                    name="relevant_section" id="">
                                                {{--@if(isset(config('system.main.related_sections')))--}}
                                                <option value="">@lang('messages.global.section')</option>

                                            @foreach(explode(',',config('system.main.related_sections')) as $value)
                                                    <option value="{{$value}}">{{$value}}</option>
                                                @endforeach
                                                {{--@endif--}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="name" type="text" required="" class="form-control"
                                                       placeholder="@lang('messages.global.name')...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="email" type="email" class="form-control" required=""
                                                       placeholder="@lang('messages.global.email')...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <textarea name="content" rows="4" class="form-control" required=""
                                                          placeholder="@lang('messages.global.your-message')..."></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <button type="submit" class="site-button ">
                                            <span>@lang('messages.global.submit')</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Left part END -->
                    <div class="col-lg-4 col-md-12 d-lg-flex m-b30">
                        <div class="mapouter">
                            <div class="gmap_canvas">
                                <iframe width="400" height="500" id="gmap_canvas"
                                        src="https://maps.google.com/maps?q=tehran&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                        frameborder="0" scrolling="no" marginheight="0"
                                        marginwidth="0"></iframe>
                                {{--<a href="https://www.emojilib.com">emojilib.com</a></div>--}}

                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </section>

@endsection


@push('scripts')

@endpush