@extends('main_template.master_page.master')

@push('styles')
    <style>

    </style>
@endpush

@section('content')
    <section class="courseRegisterPage">
        <div class="dlab-bnr-inr overlay-black-middle">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">@lang('messages.global.course-registration')</h1>
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
                        <h3 class="font-weight-700 m-t0 m-b20">Course Registration</h3>
                        {{--<p>please select your term from the list</p>--}}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-11 mx-auto m-b30">
                        {{-- steps --}}
                        <div class="p-a30 border-1 m-auto">
                            <div id="steps">
                                @include('main_template.pages.courses.step-1')
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <button id="prevStep" data-lang="{{session('lang')}}"
                                        class="site-button mr-2">Prev
                                </button>

                                <button id="nextStep" data-lang="{{session('lang')}}"
                                        class="site-button ml-2">Next
                                </button>
                            </div>
                            <input type="hidden" value="0"
                                   id="stepIndicator">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        let steps = $('#steps');
        let idsArray = [];

        $('.courseRegisterPage').on('click', '#nextStep', function () {
            let This = $(this), url;
            let counter = parseInt($('#stepIndicator').val());

            if (counter < 3) {
                let lang = This.data('lang');
                let radioValue = $(".courseRegisterPage input[type='radio']:checked").val();

                if (counter === 0) {
                    url = '/' + lang + '/class-show/' + radioValue;
                }
                if (counter === 1) {
                    url = '/' + lang + '/verify/' + radioValue;
                }

                $.ajax({
                    url: url,
                    type: 'get',
                    success: function (response) {
                        counter = counter + 1;
                        $('#stepIndicator').val(counter);
                        $('#prevStepId').val(radioValue);
                        steps.html(response);

                        idsArray.push(radioValue);
                        console.log(idsArray);

                        if (counter === 2) {
                            This.hide().attr('disabled', true);
                            idsArray.splice(-1, 1);
                        }

                    },
                    error: function (error) {
                        console.log(error);
                        if (typeof error.response == 'array')
                            $.each(error.responseJSON.errors, function (key, value) {
                                // $('#' + key).parents('.form-group').find('.invalid-tooltip').show().html(value[0]);
                                toaster('error', key, value);
                            });
                        toaster('error', 'error', error.responseJSON.message);

                    },
                    fail: function (fail) {
                        console.log(fail);
                        toaster('error', 'error', 'error');
                    }
                })
            }
            else {
                toaster('error', 'error', 'error');

//                counter = 3;
//                This.attr('data-counter', counter);
            }
        });

        $('.courseRegisterPage').on('click', '#prevStep', function () {
            let This = $(this), url;
            let counter = parseInt($('#stepIndicator').val());
            console.log(idsArray);

            if (counter >= 0) {
                let lang = This.data('lang');
//                let radioValue = $(".courseRegisterPage input[type='radio']:checked").val();

                if (counter === 2) {
                    url = '/' + lang + '/class-show/' + idsArray[counter];
                }
//                if (counter === 1) {
//                    url = '/' + lang + '/term-show/' + idsArray[counter -1]['id'];
//                }
                if (counter === 1) {
                    url = '/' + lang + '/courses/register/' + idsArray[counter];
                }

                $.ajax({
                    url: url,
                    type: 'get',
                    success: function (response) {
                        counter = counter - 1;
                        $('#stepIndicator').val(counter);
                        steps.html(response);
                        if (counter < 3) {
                            $('#nextStep').show().attr('disabled', false);
                        }
                        idsArray.splice(-1, 1);

                    },
                    error: function (error) {
                        console.log(error);
                        if (typeof error.response == 'array')
                            $.each(error.responseJSON.errors, function (key, value) {
                                // $('#' + key).parents('.form-group').find('.invalid-tooltip').show().html(value[0]);
                                toaster('error', key, value);
                            });
                        toaster('error', 'error', error.responseJSON.message);

                    },
                    fail: function (fail) {
                        console.log(fail);
                        toaster('error', 'error', 'error');
                    }
                })
            }
            else {
//                counter = 3;
//                This.attr('data-counter', counter);
            }
        });


    </script>
@endpush