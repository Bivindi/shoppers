$(document).ready(function () {
    var shown = localStorage.getItem('isshow');
    if (shown != "p") {
        $('#loginRegister').trigger('click');
        localStorage.setItem('isshow', "p");
    }

    $('.register_form').click(function(){
        $('#sign-up').addClass('show active');
        $('#login').removeClass('show active');
        $('#forgot_password').removeClass('show active');
    });

    $('.login_form').click(function(){
        $('#login').addClass('show active');
        $('#sign-up').removeClass('show active');
        $('#forgot_password').removeClass('show active');
    });

    $('.forgot_password').click(function(){
        $('#forgot_password').addClass('show active');
        $('#login').removeClass('show active');
        $('#sign-up').removeClass('show active');
    });


});

// function showRegisterForm() {
//     $('.loginBox').fadeOut('fast', function () {
//         $('.forgotBox').fadeOut('fast');
//         $('.registerBox').fadeIn('fast');
//         $('.login-footer').fadeOut('fast', function () {
//             $('.register-footer').fadeIn('fast');
//         });
//         $('.modal-title').html('Register with');
//     });
//     $('.error').removeClass('alert alert-danger').html('');

// }

// function showLoginForm() {
//     $('#loginModal .registerBox').fadeOut('fast', function () {
//         $('.loginBox').fadeIn('fast');
//         $('.register-footer').fadeOut('fast', function () {
//             $('.login-footer').fadeIn('fast');
//         });

//         $('.modal-title').html('Login with');
//     });
//     $('.error').removeClass('alert alert-danger').html('');
// }

// function showForgotForm() {
//     $('#loginModal .loginBox').fadeOut('fast', function () {
//         $('.forgotBox').fadeIn('fast');
//         $('.register-footer').fadeOut('fast', function () {
//             $('.login-footer').fadeIn('fast');
//         });

//        $('.modal-title').html('Forgot Password');
//     });
//     $('.error').removeClass('alert alert-danger').html('');
// }


function openLoginModal() {
    showLoginForm();
    setTimeout(function () {
        $('#loginModal').modal('show');
    }, 230);

}

function openRegisterModal() {
    showRegisterForm();
    setTimeout(function () {
        $('#loginModal').modal('show');
    }, 230);

}

// function shakeModal() {
//     $('#loginModal .modal-dialog').addClass('shake');
//     setTimeout(function () {
//         $('#loginModal .modal-dialog').removeClass('shake');
//     }, 1000);
// }

function shakeModal() {
    $('#login .tab-pane').addClass('shake');
    setTimeout(function () {
        $('#login .tab-pane').removeClass('shake');
    }, 1000);
}