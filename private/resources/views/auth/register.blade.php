@extends('main_template.master_page.master')

@section('content')
    <section class="registerPage">
        <div class="dlab-bnr-inr overlay-black-middle">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">Register</h1>
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
                        <h3 class="font-weight-700 m-t0 m-b20">Create An Account</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 m-b30">
                        <div class="p-a30 border-1  max-w500 m-auto">
                            <div class="tab-content">
                                <form enctype="multipart/form-data" id="register" method="post"
                                      action="{{ route('register',['lang'=>session('lang')]) }}"
                                      class="tab-pane active">
                                    @csrf
                                    <h4 class="font-weight-700">PERSONAL INFORMATION</h4>
                                    <p class="font-weight-600">If you have an account with us, please log in.</p>
                                    <div class="form-group">
                                        <label class="font-weight-700">Full Name *</label>
                                        <input name="name" required="" class="form-control" placeholder="Full Name"
                                               type="text">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-700">User Name *</label>
                                        <input name="username" required="" class="form-control" placeholder="User Name"
                                               type="text">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-700">E-MAIL *</label>
                                        <input name="email" required="" class="form-control" placeholder="Email"
                                               type="email">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-700">Mobile Number *</label>
                                        <input name="mobile_number" required="" class="form-control"
                                               placeholder="Mobile Number" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-700">Melli Code</label>
                                        <input name="melli_code" class="form-control" placeholder="Melli Code"
                                               type="text">
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-700">Gender *</label>
                                        <select class="form-control" name="gender" id="gender">
                                            <option value="0">male</option>
                                            <option value="1">female</option>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label class="font-weight-700">PASSWORD *</label>
                                        <input name="password" required="" class="form-control"
                                               placeholder="Type Password" type="password">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-700">PASSWORD CONFIRMATION *</label>
                                        <input name="confirm_password" required="" class="form-control"
                                               placeholder="Type Your Password Again" type="password">
                                    </div>
                                    <div class="text-left">
                                        <button type="submit" class="site-button button-lg radius-no outline outline-2">Register
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
    <script>
        $('form').on('submit', (e) => {
            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $(e.target);
            var url = form.attr('action');
            var type = form.attr('method');
            console.log(form);
            var formData = new FormData(form[0]);

            $.ajax({
                type: type,
                url: url,
                processData: false,
                contentType: false,
                data: formData, // serializes the form's elements.
                success: function (response) {
                    console.log(response);
                    toaster('success', response.title, response.message);
                    window.location.href = '/';
                },
                error: function (data) {
                    $.each(data.responseJSON.errors, function (key, value) {
                        $('#' + key).parents('.form-group').find('.invalid-feedback span').show().html(value[0]);
                        toaster('error', key, value);
                    });
                },
                fail: function (data) {
                    toaster('error', data.title, data.message);
                }
            });
        });
    </script>
@endpush
