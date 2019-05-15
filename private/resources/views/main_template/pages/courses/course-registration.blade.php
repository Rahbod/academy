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
                    <h1 class="text-white">Course Registration</h1>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                            <li><a href="#">Home</a></li>
                            <li>course</li>
                            <li>register</li>
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
                        <h3 class="font-weight-700 m-t0 m-b20">Course Registration</h3>
                        <p>please select your term from the list</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10 mx-auto m-b30">
                        {{-- steps --}}
                        <div class="p-a30 border-1 m-auto">
                            <div id="steps">
                                @include('main_template.pages.courses.step-1')
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <a class="site-button mr-2" title="back to courses"
                                   href="{{url(session('lang').'/courses')}}">back to courses</a>

                                <button id="nextStep" data-counter="2"
                                        data-lang="{{session('lang')}}"
                                        class="site-button ml-2">Next
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $('.courseRegisterPage').on('click', '#nextStep', function () {
            let steps = $('#steps');
            let This = $(this);
            let counter = This.attr('data-counter');

            if (parseInt(counter) <= 3) {
                counter = parseInt(counter);
                let step_x = 'step' + counter;
                let lang = This.data('lang');
                let radioValue = $("input[type='radio']:checked").val();

                $.ajax({
                    url: '/' + lang + '/courses/register/' + step_x + '/' + radioValue,
                    type: 'get',
                    success: function (response) {
                        counter = counter + 1;
                        This.attr('data-counter', counter);
                        steps.html(response);
                    },
                    error: function (error) {
                        counter = counter - 1;
                        This.attr('data-counter', counter);
                    }
                })
            }
            else {
                counter = 3;
                This.attr('data-counter', counter);
            }
        })
    </script>
@endpush