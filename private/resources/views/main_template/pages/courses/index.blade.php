@extends('main_template.master_page.master')

@push('styles')

@endpush

@section('content')
    <section class="courseIndex">
        <div class="dlab-bnr-inr overlay-black-middle">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">Our Courses</h1>
                    <!-- Breadcrumb row -->
                @include('main_template.modules.breadcrumb')
                <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>

        <div class="section-full bg-white content-inner dlab-about-1">
            <div class="container">
                <div class="section-head text-black text-center">
                    <h2 class="m-b0 text-uppercase">All Courses</h2>
                    <p class="font-18">
                        List of courses started and will be started in the Acadmy
                    </p>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-4 col-sm-6 m-b30">
                        <div class="dlab-box hotal-box" data-tilt="" data-tilt-max="10" data-tilt-speed="1">
                            <div class="dlab-media dlab-img-effect dlab-img-overlay2"><img
                                        src="{{asset('assets/site/media/images/promotion/img2.jpg')}}" alt="">
                                <div class="dlab-info-has p-a20 text-white no-hover">
                                    <h4 class="m-t0 m-b10">english</h4>
                                    <span>master : Mr.Rezae</span>
                                    <h2 class="m-t10 m-b20">4 month</h2>
                                    <a href="hotel-booking.html" class="site-button outline outline-2 radius-xl">
                                        register
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-sm-6 m-b30">
                        <div class="dlab-box hotal-box" data-tilt="" data-tilt-max="10" data-tilt-speed="1">
                            <div class="dlab-media dlab-img-effect dlab-img-overlay2"><img
                                        src="{{asset('assets/site/media/images/promotion/img3.jpg')}}" alt="">
                                <div class="dlab-info-has p-a20 text-white no-hover">
                                    <h4 class="m-t0 m-b10">francais</h4>
                                    <span>master : Mr.Rezae</span>
                                    <h2 class="m-t10 m-b20">3 month</h2>
                                    <a href="hotel-booking.html" class="site-button outline outline-2 radius-xl">
                                        register
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-sm-6 m-b30">
                        <div class="dlab-box hotal-box" data-tilt="" data-tilt-max="10" data-tilt-speed="1">
                            <div class="dlab-media dlab-img-effect dlab-img-overlay2"><img
                                        src="{{asset('assets/site/media/images/promotion/img4.jpg')}}" alt="">
                                <div class="dlab-info-has p-a20 text-white no-hover">
                                    <h4 class="m-t0 m-b10">chinese</h4>
                                    <span>master : Mr.Rezae</span>
                                    <h2 class="m-t10 m-b20">6 month</h2>
                                    <a href="hotel-booking.html" class="site-button outline outline-2 radius-xl">
                                        register
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-sm-6 m-b30">
                        <div class="dlab-box hotal-box" data-tilt="" data-tilt-max="10" data-tilt-speed="1">
                            <div class="dlab-media dlab-img-effect dlab-img-overlay2"><img
                                        src="{{asset('assets/site/media/images/promotion/img2.jpg')}}" alt="">
                                <div class="dlab-info-has p-a20 text-white no-hover">
                                    <h4 class="m-t0 m-b10">english</h4>
                                    <span>master : Mr.Rezae</span>
                                    <h2 class="m-t10 m-b20">4 month</h2>
                                    <a href="hotel-booking.html" class="site-button outline outline-2 radius-xl">
                                        register
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-sm-6 m-b30">
                        <div class="dlab-box hotal-box" data-tilt="" data-tilt-max="10" data-tilt-speed="1">
                            <div class="dlab-media dlab-img-effect dlab-img-overlay2"><img
                                        src="{{asset('assets/site/media/images/promotion/img3.jpg')}}" alt="">
                                <div class="dlab-info-has p-a20 text-white no-hover">
                                    <h4 class="m-t0 m-b10">francais</h4>
                                    <span>master : Mr.Rezae</span>
                                    <h2 class="m-t10 m-b20">3 month</h2>
                                    <a href="hotel-booking.html" class="site-button outline outline-2 radius-xl">
                                        register
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-sm-6 m-b30">
                        <div class="dlab-box hotal-box" data-tilt="" data-tilt-max="10" data-tilt-speed="1">
                            <div class="dlab-media dlab-img-effect dlab-img-overlay2"><img
                                        src="{{asset('assets/site/media/images/promotion/img4.jpg')}}" alt="">
                                <div class="dlab-info-has p-a20 text-white no-hover">
                                    <h4 class="m-t0 m-b10">chinese</h4>
                                    <span>master : Mr.Rezae</span>
                                    <h2 class="m-t10 m-b20">6 month</h2>
                                    <a href="hotel-booking.html" class="site-button outline outline-2 radius-xl">
                                        register
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')

@endpush