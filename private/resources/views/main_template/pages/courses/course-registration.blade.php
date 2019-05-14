@extends('main_template.master_page.master')

@push('styles')
    <style>

    </style>
@endpush

@section('content')
    <section class="translationPage">
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
                        <div id="steps">
                            @include('main_template.pages.courses.step-1')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            const step=$();
            $('button').on('click', function () {
                let This = $(this);
                let step = This.val();
                let lang = This.data('lang');

                let radioValue = $("input[type='radio']:checked").val();

                let formData = new FormData();
                formData.append('step', step);
                formData.append('id', radioValue);

                $.ajax({
                    url: '/' + lang + '/show_classes/' + radioValue,
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: 'post',
                    async: false,

                    success: function (response) {
                        console.log(response);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                })

            })
        });
    </script>
@endpush