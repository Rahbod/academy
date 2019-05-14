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
    <section class="translationPage">
        <div class="dlab-bnr-inr overlay-black-middle">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">Translation</h1>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="#">Home</a></li>
                            <li>Translation</li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <div class="section-full content-inner shop-account">
            <!-- Product -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="font-weight-700 m-t0 m-b20">Translation Request</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 mx-auto m-b30">
                        <div class="p-a30 border-1 m-auto">
                            <div class="">
                                <form action="{{url(session('lang').'/translations')}}" method="post"
                                      enctype="multipart/form-data"
                                      id="translationForm" class="">
                                    <h4 class="font-weight-700">Request Form</h4>
                                    <p class="font-weight-600">please fill the blanks carefully</p>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label class="font-weight-700">Title *</label>
                                            <input name="title" id="title" required="" class="form-control" placeholder="Title"
                                                   type="text">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700">Source Language *</label>
                                            <select name="source_language" id="source_language" class="form-control">
                                                <option value="english" selected>Source Language</option>
                                                <option value="france">france</option>
                                                <option value="germany">germany</option>
                                                <option value="persian">persian</option>
                                                <option value="korea">korea</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700">Destination Language *</label>
                                            <select name="translation_language" id="translation_language" class="form-control">
                                                <option value="english" selected>Destination Language</option>
                                                <option value="france">france</option>
                                                <option value="germany">germany</option>
                                                <option value="persian">persian</option>
                                                <option value="korea">korea</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label class="font-weight-700">Description *</label>
                                            <textarea name="description" id="description" required cols="30" rows="10"
                                                      class="form-control"
                                                      placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="dropzone" id="my-dropzone"></div>

                                    <div class="text-left">
                                        <button type="submit" id="submitBtn"
                                                class="site-button button-lg radius-no outline outline-2">CREATE
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

    <script type="text/javascript" src="{{asset('assets/site/js/vendors/dropzone/dropzone.js')}}"></script>

    <script>
//        let myDropzone=$("#my-dropzone").dropzone();
        Dropzone.options.myDropzone = {
            url: "{{url(session('lang').'/translations')}}",
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 100,
            acceptedFiles: "image/*",
            name:'translated_file',

            init: function () {

                var submitButton = document.querySelector("#submitBtn");
                var wrapperThis = this;

                submitButton.addEventListener("click", function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    wrapperThis.processQueue();
                });

                this.on("addedfile", function (file) {

                    // Create the remove button
                    var removeButton = Dropzone.createElement("<button class='btn btn-lg dark'>Remove File</button>");

                    // Listen to the click event
                    removeButton.addEventListener("click", function (e) {
                        // Make sure the button click doesn't submit the form:
                        e.preventDefault();
                        e.stopPropagation();

                        // Remove the file preview.
                        wrapperThis.removeFile(file);
                        // If you want to the delete the file on the server as well,
                        // you can do the AJAX request here.
                    });

                    // Add the button to the file preview element.
                    file.previewElement.appendChild(removeButton);
                });

                this.on('sendingmultiple', function (data, xhr, formData) {
                    formData.append("category_id", $("#category_id").val());
                    formData.append("title", $("#title").val());
                    formData.append("source_language", $("#source_language").val());
                    formData.append("translation_language", $("#translation_language").val());
                    formData.append("description", $("#description").val());
                });
            }
        };

    </script>
@endpush