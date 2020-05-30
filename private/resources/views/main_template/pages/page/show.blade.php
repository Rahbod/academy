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
        <div class="section-full content-inner">
            <div class="container">
                <div class="row m-b30">
                    <div class="col-lg-push-2 col-md-push-2 col-lg-8 col-md-7 m-b10">
                        <div class="product-gallery m-b30">
                            <img src="{{$page['image']}}" class="img-fluid" alt="">
                        </div>
                        <div class="d-flex info-bx m-b30">
                            <div class="tour-title">
                                <h2>{{$page['title']}}</h2>
                            </div>
                        </div>
                        <div class="tour-days">
                            <p>{!! $page['text']!!}</p>
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