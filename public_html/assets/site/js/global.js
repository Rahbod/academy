// $(document).ready(function () {
$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

toastr.options = {
    "closeButton": false,
    "rtl": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "4000",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

$('.form-control').on('focus', function (ev) {
    var This = $(ev.target);
    This.parents('.form-group').find('.invalid-tooltip').hide();
}).on('blur', function (ev) {
    var This = $(ev.target);
    This.parents('.form-group').find('.invalid-tooltip').hide();
});

$(".scrollDown").on('click', function () {
    var header_height = $('.header').height();
    $('html, body').animate({
        scrollTop: $(".header").offset().top + header_height
    }, 1500);
});

$('.mainSlider').slick({
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 9000,
    slidesToShow: 1
});

$('.newsSlider--container').slick({
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 9000,
    slidesToShow: 5,
    responsive: [
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 4,
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 400,
            settings: {
                slidesToShow: 1,
            }
        }
    ]
});

$(window).on("load resize scroll", function () {
    var width = $(window).width();
    if (width > 992) {
        var scroll = $(window).scrollTop();
        if (scroll > 47) {
            $('header .sticky-header').addClass('is-fixed');
        }
        else {
            $('header .sticky-header').removeClass('is-fixed');
        }
    }
});

$('#dismiss, .overlay').on('click', function () {
    $('#sidebar').removeClass('active');
    $('.overlay').removeClass('active');
});

$('#sidebarCollapse').on('click', function () {
    $('#sidebar').addClass('active');
    $('.overlay').addClass('active');
    $('.collapse.in').toggleClass('in');
    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
});


// });

$('form.contact-us').on('submit', function (e) {
    e.preventDefault();
    let form = $(e.target);
    let formMethod = $(e.target).attr('method');
    let url = form.attr('action');
    let formData = new FormData(this);

    console.log(form);
    console.log(formMethod);
    console.log(url);
    console.log(formData);

    $.ajax({
        url: url,
        method: formMethod,
        processData: false,
        contentType: false,
        data: formData,
        success: function (success) {
            console.log(success);
            toaster('success', success.title, success.message);
        },
        error: function (error) {
            console.log(error);
            $.each(error.responseJSON.errors, function (key, value) {
                // $('#' + key).parents('.form-group').find('.invalid-tooltip').show().html(value[0]);
                toaster('error', key, value);
            });
        },
        fail: function (fail) {
            console.log(fail);
            toaster('error', 'error', 'error');
        }

    })

});

jQuery.fn.extend({
    successToast: function (title, message) {
        toastr['success'](message, title);
        // return this;
        return $(this[0])
    },
    errorToast: function (title, message) {
        toastr['error'](message, title);
        return this;
    },
    warningToast: function (title, message) {
        toastr['warning'](message, title);
        return this;
    }
});

// jQuery.fn.extend({
//     sendRequest: function (url, formData) {
//
//         console.log(this);
//         // let url = new FormData(data);
//         // let formData = new FormData(data);
//
//         this.ajax({
//             url: url,
//             processData: false,
//             contentType: false,
//             data: formData,
//             success: function (success) {
//                 console.log(success);
//             },
//             error: function (error) {
//                 console.log(error);
//
//             },
//             fail: function (fail) {
//                 console.log(fail);
//
//             }
//
//         })
//     },
// });

function toaster(type, title, message) {
    toastr[type](message, title)
}
