@extends('main_template.master_page.master')

@push('styles')
    <link type="text/css" rel="stylesheet" href="{{asset('/assets/site/js/vendors/dropzone/basic.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('/assets/site/js/vendors/dropzone/dropzone.css')}}">


    <style>
        .dropzone {
            border: 2px dashed #999999;
            border-radius: 10px;
            background-image: url('{{asset('/assets/site/media/images/public/uploading-archive.svg')}}');
            background-repeat: no-repeat;
            background-position: center center;
            margin-bottom: 1rem;
        }

        .dropzone .dz-default.dz-message {
            height: 171px;
            background-size: 132px 132px;
            margin-top: -101.5px;
            background-position-x: center;

        }

        .dropzone .dz-default.dz-message span {
            display: block;
            margin-top: 145px;
            font-size: 20px;
            text-align: center;
        }
    </style>
@endpush

@section('content')
    <section class="courseShow m-b30">
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
        <div class="section-full content-inner">
            <div class="container">
                <div class="row m-b30">
                    <div class="col-lg-8">
                        <div class="d-flex info-bx m-b30">
                            <div class="tour-title">
                                <h2>English</h2>
                                <p>english training course</p>
                                <p>
                                    <span class="site-button button-sm button-gray">course</span>
                                    <span class="site-button button-sm">rezae</span>
                                </p>
                            </div>
                            <div class="tour-price ml-auto">
                                <span>cost of the course</span>
                                <h2 class="price">1,000,000 T</h2>
                                <del class="actual-price">1,200,000 T</del>
                            </div>
                        </div>
                        <div class="product-gallery">
                            <img src="{{asset('assets/site/media/images/top_courses/pic4.jpg')}}" class="img-fluid"
                                 alt="">
                        </div>
                        <div class="tour-days">
                            <h2 class="m-b10">About Hotel</h2>
                            <p>It is a long established fact that a reader will be distracted by the readable content of
                                a page when looking at its layout. The point of using Lorem Ipsum is that it has a
                                more-or-less normal distribution of letters, as opposed to using 'Content here, content
                                here', making it look like readable English. Many desktop publishing packages and web
                                page editors now use Lorem Ipsum as their default model text, and a search for 'lorem
                                ipsum' will uncover many web sites still in their infancy.</p>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <ul class="list-hand-point primary">
                                        <li>Closeness to ISRO (1.6 km) and BEL (2.4 km)</li>
                                        <li>Cozy rooms with modern interiors</li>
                                        <li>In-house restaurant serving tasty dishes</li>
                                    </ul>
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <h5>Where we are Located</h5>
                                    <ul class="list-hand-point primary">
                                        <li>The FabHotel RMS Comforts is situated on 5th Main in the Mathikere Extension
                                            area
                                        </li>
                                        <li>Yeshwantpur Junction Railway Station is 1.8 km, while Krantivira Sangolli
                                            Rayanna Railway Station is 7.3 km from the hotel
                                        </li>
                                        <li>Sandal Soap Factory Metro Station is 2.6 km and Kempegowda International
                                            Airport is a 40-minute drive (30.5 km)
                                        </li>
                                        <li>Some of the prominent landmarks near the hotel include BBMP Office (700 m),
                                            Ramaiah Institute of Technology (750 m), Indian Institute of Science (950
                                            m), BEL-THALES Systems Limited (1.5 km), ISRO (1.6 km), RTO Office
                                            Yeshwanthpura (1.8 km), Antrix Corporation Limited (1.9 km), Bharat
                                            Electronics Limited (2.1 km) and Professional Tax Office (2.5 km)
                                        </li>
                                        <li>Sandal Soap Factory Metro Station is 2.6 km and Kempegowda International
                                            Airport is a 40-minute drive (30.5 km)
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <h5>Where to Eat</h5>
                                    <ul class="list-hand-point primary">
                                        <li>The hotel has a restaurant that treats you with a wide range of dishes
                                            across multiple cuisines
                                        </li>
                                        <li>Sri Krishna Bhavan (53 m), Shree Sagar (63 m), Delight (72 m), Reddy Mess
                                            (140 m), Star Biryani Center (290 m) and Indira Canteen (300 m) are among
                                            many dining options around the hotel
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="sticky-top">
                            <form class="hotel-booking">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6 col-6">
                                        <div class="form-group">
                                            03/02/1398
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6 col-6">
                                        <div class="form-group">
                                            09/05/1398
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            remaining capacity : 5 person
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-12">
                                        <button type="submit" class="site-button btn-block">join now</button>
                                    </div>
                                </div>
                            </form>
                            <div class="m-t30">
                                <img src="{{asset('assets/site/media/images/top_courses/pic4.jpg')}}" class="img-fluid"
                                     alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')

    <script type="text/javascript" src="{{asset('assets/site/js/vendors/dropzone/dropzone.js')}}"></script>

    <script>
        //    Dropzone.autoDiscover = false;
        Dropzone.options.myAwesomeDropzone = {
            url: '/upload',
            autoProcessQueue: false,
            autoDiscover: false,
            uploadMultiple: true,
            parallelUploads: 5,
            maxFiles: 5,
            maxFilesize: 1,
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            init: function () {
                dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

                // for Dropzone to process the queue (instead of default form behavior):
                document.getElementById("submitBtn").addEventListener("click", function (e) {
                    // Make sure that the form isn't actually being sent.
                    e.preventDefault();
                    e.stopPropagation();
                    dzClosure.processQueue();
                });

                //send all the form data along with the files:
                this.on("sendingmultiple", function (data, xhr, formData) {
                    console.log(formData);
//                formData.append("firstname", jQuery("#firstname").val());
//                formData.append("lastname", jQuery("#lastname").val());
                });
            }
        };

    </script>
@endpush