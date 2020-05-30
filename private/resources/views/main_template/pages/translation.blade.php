@extends('main_template.master_page.master')

@push('styles')
    <link type="text/css" rel="stylesheet" href="{{asset('/assets/site/js/vendors/dropzone/basic.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('/assets/site/js/vendors/dropzone/dropzone.css')}}">




    <style>
        /* The MIT License */
        .dropzone,
        .dropzone *,
        .dropzone-previews,
        .dropzone-previews * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .dropzone .dz-preview .dz-image {
            width: auto;
        }

        .dropzone .dz-preview .dz-details .dz-size, .dropzone-previews .dz-preview .dz-details .dz-size {
            bottom: -15px;
            left: 0px;
        }

        .dropzone {
            position: relative;
            border: 1px solid rgba(0, 0, 0, 0.08);
            background: rgba(0, 0, 0, 0.02);
            padding: 1em;
        }

        .dropzone.dz-clickable {
            cursor: pointer;
        }

        .dropzone.dz-clickable .dz-message,
        .dropzone.dz-clickable .dz-message span {
            cursor: pointer;
        }

        .dropzone.dz-clickable * {
            cursor: default;
        }

        .dropzone .dz-message {
            opacity: 1;
            -ms-filter: none;
            filter: none;
        }

        .dropzone.dz-drag-hover {
            border-color: rgba(0, 0, 0, 0.15);
            background: rgba(0, 0, 0, 0.04);
        }

        .dropzone.dz-started .dz-message {
            display: none;
        }

        .dropzone .dz-preview,
        .dropzone-previews .dz-preview {
            background: rgba(255, 255, 255, 0.8);
            position: relative;
            display: inline-block;
            margin: 17px;
            vertical-align: top;
            border: 1px solid #acacac;
            padding: 6px 6px 6px 6px;
        }

        .dropzone .dz-preview.dz-file-preview [data-dz-thumbnail],
        .dropzone-previews .dz-preview.dz-file-preview [data-dz-thumbnail] {
            display: none;
        }

        .dropzone .dz-preview .dz-details,
        .dropzone-previews .dz-preview .dz-details {
            width: 100px;
            height: 100px;
            position: relative;
            background: #ebebeb;
            padding: 5px;
            margin-bottom: 22px;
        }

        .dropzone .dz-preview .dz-details .dz-filename,
        .dropzone-previews .dz-preview .dz-details .dz-filename {
            overflow: hidden;
            height: 100%;
        }

        .dropzone .dz-preview .dz-details img,
        .dropzone-previews .dz-preview .dz-details img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100px;
            height: 100px;
        }

        .dropzone .dz-preview .dz-details .dz-size,
        .dropzone-previews .dz-preview .dz-details .dz-size {
            position: absolute;
            bottom: -28px;
            left: 3px;
            height: 28px;
            line-height: 28px;
        }

        .dropzone .dz-preview.dz-error .dz-error-mark,
        .dropzone-previews .dz-preview.dz-error .dz-error-mark {
            display: block;
        }

        .dropzone .dz-preview.dz-success .dz-success-mark,
        .dropzone-previews .dz-preview.dz-success .dz-success-mark {
            display: block;
        }

        .dropzone .dz-preview:hover .dz-details img,
        .dropzone-previews .dz-preview:hover .dz-details img {
            display: none;
        }

        .dropzone .dz-preview .dz-success-mark,
        .dropzone-previews .dz-preview .dz-success-mark,
        .dropzone .dz-preview .dz-error-mark,
        .dropzone-previews .dz-preview .dz-error-mark {
            display: none;
            position: absolute;
            width: 40px;
            height: 40px;
            font-size: 30px;
            text-align: center;
            right: -10px;
            top: -10px;
        }

        .dropzone .dz-preview .dz-success-mark,
        .dropzone-previews .dz-preview .dz-success-mark {
            color: #8cc657;
        }

        .dropzone .dz-preview .dz-error-mark,
        .dropzone-previews .dz-preview .dz-error-mark {
            color: #ee162d;
        }

        .dropzone .dz-preview .dz-progress,
        .dropzone-previews .dz-preview .dz-progress {
            position: absolute;
            top: 100px;
            left: 6px;
            right: 6px;
            height: 6px;
            background: #d7d7d7;
            display: none;
        }

        .dropzone .dz-preview .dz-progress .dz-upload,
        .dropzone-previews .dz-preview .dz-progress .dz-upload {
            display: block;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 0%;
            background-color: #8cc657;
        }

        .dropzone .dz-preview.dz-processing .dz-progress,
        .dropzone-previews .dz-preview.dz-processing .dz-progress {
            display: block;
        }

        .dropzone .dz-preview .dz-error-message,
        .dropzone-previews .dz-preview .dz-error-message {
            display: none;
            position: absolute;
            top: -5px;
            left: -20px;
            background: rgba(245, 245, 245, 0.8);
            padding: 8px 10px;
            color: #800;
            min-width: 140px;
            max-width: 500px;
            z-index: 500;
        }

        .dropzone .dz-preview:hover.dz-error .dz-error-message,
        .dropzone-previews .dz-preview:hover.dz-error .dz-error-message {
            display: block;
        }

        .dropzone {
            border: 1px solid rgba(0, 0, 0, 0.03);
            min-height: 360px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
            background: rgba(0, 0, 0, 0.03);
            padding: 23px;
        }

        .dropzone .dz-default.dz-message {
            opacity: 1;
            -ms-filter: none;
            filter: none;
            -webkit-transition: opacity 0.3s ease-in-out;
            -moz-transition: opacity 0.3s ease-in-out;
            -o-transition: opacity 0.3s ease-in-out;
            -ms-transition: opacity 0.3s ease-in-out;
            transition: opacity 0.3s ease-in-out;
            /*background-image: url("../images/spritemap.png");*/
            background-repeat: no-repeat;
            background-position: 0 0;
            position: absolute;
            width: 428px;
            height: 123px;
            margin-left: -214px;
            margin-top: -61.5px;
            top: 50%;
            left: 50%;
        }

        @media all and (-webkit-min-device-pixel-ratio: 1.5),(min--moz-device-pixel-ratio: 1.5),(-o-min-device-pixel-ratio: 1.5/1),(min-device-pixel-ratio: 1.5),(min-resolution: 138dpi),(min-resolution: 1.5dppx) {
            .dropzone .dz-default.dz-message {
                /*background-image: url("../images/spritemap@2x.png");*/
                -webkit-background-size: 428px 406px;
                -moz-background-size: 428px 406px;
                background-size: 428px 406px;
            }
        }

        .dropzone .dz-default.dz-message span {
            display: none;
        }

        .dropzone.dz-square .dz-default.dz-message {
            background-position: 0 -123px;
            width: 268px;
            margin-left: -134px;
            height: 174px;
            margin-top: -87px;
        }

        .dropzone.dz-drag-hover .dz-message {
            opacity: 0.15;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=15)";
            filter: alpha(opacity=15);
        }

        .dropzone.dz-started .dz-message {
            display: block;
            opacity: 0;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            filter: alpha(opacity=0);
        }

        .dropzone .dz-preview,
        .dropzone-previews .dz-preview {
            -webkit-box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.16);
            box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.16);
            font-size: 14px;
        }

        .dropzone .dz-preview.dz-image-preview:hover .dz-details img,
        .dropzone-previews .dz-preview.dz-image-preview:hover .dz-details img {
            display: block;
            opacity: 0.1;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=10)";
            filter: alpha(opacity=10);
        }

        .dropzone .dz-preview.dz-success .dz-success-mark,
        .dropzone-previews .dz-preview.dz-success .dz-success-mark {
            opacity: 1;
            -ms-filter: none;
            filter: none;
        }

        .dropzone .dz-preview.dz-error .dz-error-mark,
        .dropzone-previews .dz-preview.dz-error .dz-error-mark {
            opacity: 1;
            -ms-filter: none;
            filter: none;
        }

        .dropzone .dz-preview.dz-error .dz-progress .dz-upload,
        .dropzone-previews .dz-preview.dz-error .dz-progress .dz-upload {
            background: #ee1e2d;
        }

        .dropzone .dz-preview .dz-error-mark,
        .dropzone-previews .dz-preview .dz-error-mark,
        .dropzone .dz-preview .dz-success-mark,
        .dropzone-previews .dz-preview .dz-success-mark {
            display: block;
            opacity: 0;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            filter: alpha(opacity=0);
            -webkit-transition: opacity 0.4s ease-in-out;
            -moz-transition: opacity 0.4s ease-in-out;
            -o-transition: opacity 0.4s ease-in-out;
            -ms-transition: opacity 0.4s ease-in-out;
            transition: opacity 0.4s ease-in-out;
            /*background-image: url("../images/spritemap.png");*/
            background-repeat: no-repeat;
        }

        @media all and (-webkit-min-device-pixel-ratio: 1.5),(min--moz-device-pixel-ratio: 1.5),(-o-min-device-pixel-ratio: 1.5/1),(min-device-pixel-ratio: 1.5),(min-resolution: 138dpi),(min-resolution: 1.5dppx) {
            .dropzone .dz-preview .dz-error-mark,
            .dropzone-previews .dz-preview .dz-error-mark,
            .dropzone .dz-preview .dz-success-mark,
            .dropzone-previews .dz-preview .dz-success-mark {
                /*background-image: url("../images/spritemap@2x.png");*/
                -webkit-background-size: 428px 406px;
                -moz-background-size: 428px 406px;
                background-size: 428px 406px;
            }
        }

        .dropzone .dz-preview .dz-error-mark span,
        .dropzone-previews .dz-preview .dz-error-mark span,
        .dropzone .dz-preview .dz-success-mark span,
        .dropzone-previews .dz-preview .dz-success-mark span {
            display: none;
        }

        .dropzone .dz-preview .dz-error-mark,
        .dropzone-previews .dz-preview .dz-error-mark {
            background-position: -268px -123px;
        }

        .dropzone .dz-preview .dz-success-mark,
        .dropzone-previews .dz-preview .dz-success-mark {
            background-position: -268px -163px;
        }

        .dropzone .dz-preview .dz-progress .dz-upload,
        .dropzone-previews .dz-preview .dz-progress .dz-upload {
            -webkit-animation: loading 0.4s linear infinite;
            -moz-animation: loading 0.4s linear infinite;
            -o-animation: loading 0.4s linear infinite;
            -ms-animation: loading 0.4s linear infinite;
            animation: loading 0.4s linear infinite;
            -webkit-transition: width 0.3s ease-in-out;
            -moz-transition: width 0.3s ease-in-out;
            -o-transition: width 0.3s ease-in-out;
            -ms-transition: width 0.3s ease-in-out;
            transition: width 0.3s ease-in-out;
            -webkit-border-radius: 2px;
            border-radius: 2px;
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            /*background-image: url("../images/spritemap.png");*/
            background-repeat: repeat-x;
            background-position: 0px -400px;
        }

        @media all and (-webkit-min-device-pixel-ratio: 1.5),(min--moz-device-pixel-ratio: 1.5),(-o-min-device-pixel-ratio: 1.5/1),(min-device-pixel-ratio: 1.5),(min-resolution: 138dpi),(min-resolution: 1.5dppx) {
            .dropzone .dz-preview .dz-progress .dz-upload,
            .dropzone-previews .dz-preview .dz-progress .dz-upload {
                /*background-image: url("../images/spritemap@2x.png");*/
                -webkit-background-size: 428px 406px;
                -moz-background-size: 428px 406px;
                background-size: 428px 406px;
            }
        }

        .dropzone .dz-preview.dz-success .dz-progress,
        .dropzone-previews .dz-preview.dz-success .dz-progress {
            display: block;
            opacity: 0;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            filter: alpha(opacity=0);
            -webkit-transition: opacity 0.4s ease-in-out;
            -moz-transition: opacity 0.4s ease-in-out;
            -o-transition: opacity 0.4s ease-in-out;
            -ms-transition: opacity 0.4s ease-in-out;
            transition: opacity 0.4s ease-in-out;
        }

        .dropzone .dz-preview .dz-error-message,
        .dropzone-previews .dz-preview .dz-error-message {
            display: block;
            opacity: 0;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            filter: alpha(opacity=0);
            -webkit-transition: opacity 0.3s ease-in-out;
            -moz-transition: opacity 0.3s ease-in-out;
            -o-transition: opacity 0.3s ease-in-out;
            -ms-transition: opacity 0.3s ease-in-out;
            transition: opacity 0.3s ease-in-out;
        }

        .dropzone .dz-preview:hover.dz-error .dz-error-message,
        .dropzone-previews .dz-preview:hover.dz-error .dz-error-message {
            opacity: 1;
            -ms-filter: none;
            filter: none;
        }

        .dropzone a.dz-remove,
        .dropzone-previews a.dz-remove {
            background-image: -webkit-linear-gradient(top, #fafafa, #eee);
            background-image: -moz-linear-gradient(top, #fafafa, #eee);
            background-image: -o-linear-gradient(top, #fafafa, #eee);
            background-image: -ms-linear-gradient(top, #fafafa, #eee);
            background-image: linear-gradient(to bottom, #fafafa, #eee);
            -webkit-border-radius: 2px;
            border-radius: 2px;
            border: 1px solid #eee;
            text-decoration: none;
            display: block;
            padding: 4px 5px;
            text-align: center;
            color: #aaa;
            margin-top: 26px;
        }

        .dropzone a.dz-remove:hover,
        .dropzone-previews a.dz-remove:hover {
            color: #666;
        }

        @-moz-keyframes loading {
            from {
                background-position: 0 -400px;
            }
            to {
                background-position: -7px -400px;
            }
        }

        @-webkit-keyframes loading {
            from {
                background-position: 0 -400px;
            }
            to {
                background-position: -7px -400px;
            }
        }

        @-o-keyframes loading {
            from {
                background-position: 0 -400px;
            }
            to {
                background-position: -7px -400px;
            }
        }

        @keyframes loading {
            from {
                background-position: 0 -400px;
            }
            to {
                background-position: -7px -400px;
            }
        }

    </style>

    <style>
        .site-button.outline:hover {
            border-color: #1a7f4b;
            background-color: #21ab64;
            color: #fff;
        }

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

        .dropzone .dz-preview .dz-details .dz-size, .dropzone-previews .dz-preview .dz-details .dz-size {
            bottom: -16px;
            left: 0px;
            right: 0;
        }
    </style>

@endpush

@section('content')
    <section class="translationPage">
{{--        <div class="dlab-bnr-inr overlay-black-middle">--}}
{{--            <div class="container">--}}
{{--                <div class="dlab-bnr-inr-entry">--}}
{{--                    <h1 class="text-white">@lang('messages.global.translations')</h1>--}}
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
                        <h3 class="font-weight-700 m-t0 m-b20">@lang('messages.global.translation-request')</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 mx-auto m-b30">
                        <div class="p-a30 border-1 m-auto">
                            <div class="">
                                <form action="{{url(session('lang').'/translations')}}" method="post"
                                      enctype="multipart/form-data"
                                      id="translationForm" class="">
                                    <h4 class="font-weight-700">@lang('messages.global.translation-request-form')</h4>
                                    <p class="font-weight-600">@lang('messages.global.fill-carefully')</p>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label class="font-weight-700"
                                                   for="category_id">@lang('messages.global.category') *</label>
                                            <select name="category_id" id="category_id" class="form-control">
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label class="font-weight-700">@lang('messages.global.class-title')
                                                *</label>
                                            <input name="title" id="title" required="" class="form-control"
                                                   placeholder="@lang('messages.global.class-title')"
                                                   type="text">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700">@lang('messages.global.source-language')
                                                *</label>
                                            <select name="source_language" id="source_language"
                                                    class="form-control p-1">
                                                <option value="english"
                                                        selected>@lang('messages.global.source-language')</option>
                                                <option value="france">france</option>
                                                <option value="germany">germany</option>
                                                <option value="persian">persian</option>
                                                <option value="korea">korea</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-700">@lang('messages.global.destination-language')
                                                *</label>
                                            <select name="translation_language" id="translation_language"
                                                    class="form-control p-1">
                                                <option value="english"
                                                        selected>@lang('messages.global.destination-language')</option>
                                                <option value="france">france</option>
                                                <option value="germany">germany</option>
                                                <option value="persian">persian</option>
                                                <option value="korea">korea</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label class="font-weight-700">@lang('messages.global.class-description')
                                                *</label>
                                            <textarea name="description" id="description" required cols="30" rows="10"
                                                      class="form-control"
                                                      placeholder="@lang('messages.global.class-description') "></textarea>
                                        </div>
                                    </div>
                                    <div class="dropzone" id="my-dropzone"></div>

                                    <div class="text-left">
                                        <button type="submit" id="submitBtn"
                                                class="site-button button-lg radius-no outline outline-2">@lang('messages.global.submit')
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
        Dropzone.options.myDropzone = {
            url: "{{url(session('lang').'/translation-requests')}}",
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 100,
            acceptedFiles: ",jpg,.jpeg,.png,.pdf,.rar,.zip,.doc,.docx,.txt",
            addRemoveLinks: true,
            dictResponseError: 'Server not Configured',

            init: function () {
                var self = this;
                // config
                self.options.addRemoveLinks = true;
                self.options.dictRemoveFile = "@lang('messages.global.remove')";

                var submitButton = document.querySelector("#submitBtn");

                submitButton.addEventListener("click", function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    self.processQueue();
                });

                self.on("addedfile", function (file) {
                    // Create the remove button
                    {{--var removeButton = Dropzone.createElement("<button class='btn btn-lg dark'>@lang('messages.global.remove') </button>");--}}

                    // Listen to the click event
//                    removeButton.addEventListener("click", function (e) {
//                        // Make sure the button click doesn't submit the form:
//                        e.preventDefault();
//                        e.stopPropagation();
//
//                        // Remove the file preview.
//                        self.removeFile(file);
//                        // If you want to the delete the file on the server as well,
//                        // you can do the AJAX request here.
//                    });

                    // Add the button to the file preview element.
//                    file.previewElement.appendChild(removeButton);
                });


                // Send file starts
                self.on("sending", function (file) {
                    $('.meter').show();
                });

                // File upload Progress
                self.on("totaluploadprogress", function (progress) {
                    $('.roller').width(progress + '%');
                });

                self.on("queuecomplete", function (progress) {
                    $('.meter').delay(999).slideUp(999);
                });

                self.on('sendingmultiple', function (data, xhr, formData) {
                    formData.append("category_id", $("#category_id").val());
                    formData.append("title", $("#title").val());
                    formData.append("source_language", $("#source_language").val());
                    formData.append("translation_language", $("#translation_language").val());
                    formData.append("description", $("#description").val());
                    formData.append("_token", '{{csrf_token()}}');
                });
                self.on("completemultiple", function (file) {
                    if (self.getUploadingFiles().length === 0 && self.getQueuedFiles().length === 0) {
                        submitButton.removeAttribute("disabled");
                    }
                });
                self.on("successmultiple", function (file, response) {
                    $('#translationForm').trigger("reset");

                    toaster('success', 'success', response.message);
                    $(response).each(function (index, element) {
                        if (element.status) {
                            $("body").prepend('<div class="alert alert-success alert-dismissable">' +
                                '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                                '<strong>Success! </strong> ' + element.fileName + ' was uploaded successfully</div>');
                        }
                        else {
                            $("body").prepend('<div class="alert alert-danger alert-dismissable">' +
                                '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                                '<strong>Error!</strong> ' + element.message + '</div >');
                        }
                    });
                    submitButton.removeAttribute("disabled");
                });
                self.on("error", function (file, errorMessage) {
                    toaster('error', 'error', errorMessage.message);

                    $("body").prepend('<div class="alert alert-danger alert-dismissable">' +
                        '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                        '<strong>Error!</strong> ' + errorMessage + '</div >');
                    submitButton.removeAttribute("disabled");
                });


            }
        };

    </script>
@endpush