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
                                <form id="register" class="tab-pane active">
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
                                        <label class="font-weight-700">PASSWORD *</label>
                                        <input name="password" required="" class="form-control"
                                               placeholder="Type Password" type="password">
                                    </div>
                                    <div class="text-left">
                                        <button class="site-button button-lg radius-no outline outline-2">CREATE
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
