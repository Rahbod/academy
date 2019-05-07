@extends('main_template.master_page.master')

@push('styles')

@endpush

@section('content')
    <section class="contactUs">
        <div class="dlab-bnr-inr overlay-black-middle">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">Contact Us</h1>
                    <!-- Breadcrumb row -->
                @include('main_template.modules.breadcrumb')
                <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <div class="section-full content-inner bg-white contact-style-1">
            <div class="container">
                <div class="row">
                    <!-- right part start -->
                    <div class="col-lg-4 col-md-6 d-lg-flex d-md-flex">
                        <div class="p-a30 border m-b30 contact-area border-1 align-self-stretch ">
                            <h4 class="m-b10">Quick Contact</h4>
                            <p>If you have any questions simply use the following contact details.</p>
                            <ul class="no-margin">
                                <li class="icon-bx-wraper left m-b30">
                                    <div class="icon-bx-xs border-1"><a href="#" class="icon-cell"><i
                                                    class="ti-location-pin"></i></a></div>
                                    <div class="icon-content">
                                        <h6 class="text-uppercase m-tb0 dlab-tilte">Address:</h6>
                                        <p>123 West Street, Melbourne Victoria 3000 Australia</p>
                                    </div>
                                </li>
                                <li class="icon-bx-wraper left  m-b30">
                                    <div class="icon-bx-xs border-1"><a href="#" class="icon-cell"><i
                                                    class="ti-email"></i></a></div>
                                    <div class="icon-content">
                                        <h6 class="text-uppercase m-tb0 dlab-tilte">Email:</h6>
                                        <p>info@example.com</p>
                                    </div>
                                </li>
                                <li class="icon-bx-wraper left">
                                    <div class="icon-bx-xs border-1"><a href="#" class="icon-cell"><i
                                                    class="ti-mobile"></i></a></div>
                                    <div class="icon-content">
                                        <h6 class="text-uppercase m-tb0 dlab-tilte">PHONE</h6>
                                        <p>+61 3 8376 6284</p>
                                    </div>
                                </li>
                            </ul>
                            <div class="m-t20">
                                <ul class="dlab-social-icon dlab-social-icon-lg">
                                    <li><a href="javascript:void(0);" class="fa fa-facebook bg-primary"></a></li>
                                    <li><a href="javascript:void(0);" class="fa fa-twitter bg-primary"></a></li>
                                    <li><a href="javascript:void(0);" class="fa fa-linkedin bg-primary"></a></li>
                                    <li><a href="javascript:void(0);" class="fa fa-pinterest-p bg-primary"></a></li>
                                    <li><a href="javascript:void(0);" class="fa fa-google-plus bg-primary"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- right part END -->
                    <!-- Left part start -->
                    <div class="col-lg-4 col-md-6">
                        <div class="p-a30 m-b30 	bg-gray clearfix">
                            <h4>Send Message Us</h4>
                            <div class="dzFormMsg"></div>
                            <form method="post" class="dzForm" action="script/contact.php">
                                <input type="hidden" value="Contact" name="dzToDo">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="dzName" type="text" required="" class="form-control"
                                                       placeholder="Your Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="dzEmail" type="email" class="form-control" required=""
                                                       placeholder="Your Email Id">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <textarea name="dzMessage" rows="4" class="form-control" required=""
                                                          placeholder="Your Message..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="g-recaptcha"
                                                     data-sitekey="6LefsVUUAAAAADBPsLZzsNnETChealv6PYGzv3ZN"
                                                     data-callback="verifyRecaptchaCallback"
                                                     data-expired-callback="expiredRecaptchaCallback">
                                                    <div style="width: 304px; height: 78px;">
                                                        <div>
                                                            <iframe src="https://www.google.com/recaptcha/api2/anchor?ar=2&amp;k=6LefsVUUAAAAADBPsLZzsNnETChealv6PYGzv3ZN&amp;co=aHR0cDovL3RyaXBlci5kZXhpZ25sYWIuY29tOjgw&amp;hl=en&amp;v=v1555968629716&amp;size=normal&amp;cb=l4p15dllxaax"
                                                                    width="304" height="78" role="presentation"
                                                                    name="a-yznmvzn2rbxr" frameborder="0" scrolling="no"
                                                                    sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe>
                                                        </div>
                                                        <textarea id="g-recaptcha-response" name="g-recaptcha-response"
                                                                  class="g-recaptcha-response"
                                                                  style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea>
                                                    </div>
                                                </div>
                                                <input class="form-control d-none" style="display:none;"
                                                       data-recaptcha="true" required=""
                                                       data-error="Please complete the Captcha">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button name="submit" type="submit" value="Submit" class="site-button "><span>Submit</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Left part END -->
                    <div class="col-lg-4 col-md-12 d-lg-flex m-b30">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d227748.3825624477!2d75.65046970649679!3d26.88544791796718!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396c4adf4c57e281%3A0xce1c63a0cf22e09!2sJaipur%2C+Rajasthan!5e0!3m2!1sen!2sin!4v1500819483219"
                                class="align-self-stretch " style="border:0; width:100%; min-height:350px;"
                                allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


@push('scripts')

@endpush