$(document).ready(function() {
    var flag = 0;
    $('#hide_eyes').click(function() {
        if (flag == 0) {
            $('#pwd').attr('type', 'text');
            $('#hide_eyes').attr('src', '/assets/images/Show.svg');
            flag = 1;
        } else if (flag == 1) {
            $('#pwd').attr('type', 'password');
            $('#hide_eyes').attr('src', '/assets/images/Hide.svg');
            flag = 0;
        }
    });
    $('#hide_eyes2').click(function() {
        if (flag == 0) {
            $('#pwd2').attr('type', 'text');
            $('#hide_eyes2').attr('src', '/assets/images/Show.svg');
            flag = 1;
        } else if (flag == 1) {
            $('#pwd2').attr('type', 'password');
            $('#hide_eyes2').attr('src', '/assets/images/Hide.svg');
            flag = 0;
        }
    });
    $(".login_cty").click(function() {
        $('.login_cty').addClass('active');
        $('.login_nv').removeClass('active');
        $('#company_login').addClass('active');
        $('#staff_login').removeClass('active');
    });
    $(".login_nv").click(function() {
        $('.login_nv').addClass('active');
        $('.login_cty').removeClass('active');
        $('#staff_login').addClass('active');
        $('#company_login').removeClass('active');
    });

    $("#email").change(function() {
        if ($(this) == '') {
            $(".err-login").html("Email không được để trống");
        } else {
            $(".err-login").html('');
        }
    });
    $("#pwd").change(function() {
        if ($(this) == '') {
            $(".err-login").html("Mật khẩu không được để trống");
        } else {
            $(".err-login").html('');
        }
    });

});

function login_staff() {
    event.preventDefault();
    var form_oke = true;
    var email = $.trim($('#email_staff').val());
    var pass = $.trim($("#pwd2").val());
    var focusArr = [];
    if (email == '') {
        $('#login_email').html('Vui lòng nhập Email của bạn');
        focusArr.push('#email_staff');
        return false;
    } else if (email.indexOf("@") < 1 || email.lastIndexOf(".") < (email.indexOf("@") + 2) || (email.lastIndexOf(".") + 2) >= email.length) {
        $('#login_email').html('Email không đúng định dạng');
        focusArr.push('#email_staff');
        return false;
    } else {
        $('#login_email').html('');
        form_oke = true;
    }

    if (pass.length == 0) {
        $('#login_pass').html('Vui lòng nhập mật khẩu');
        focusArr.push('#pwd2');
        form_oke = false;
    } else if (pass.length < 6) {
        $('#login_pass').html('Mật khẩu có tối thiểu 6 kí tự');
        focusArr.push('#pwd2');
        form_oke = false;
    } else {
        $('#login_pass').html('');
        form_oke = true;
    }
    if (form_oke == true) {
        $('#login_staff1').html('<span class="loading"></span>');
        $.ajax({
            url: '/staff/StaffLoginController/staff_login',
            type: 'POST',
            dataType: 'json',
            data: {
                email: email,
                pass: pass
            },
            success: function(data) {
                if (data.status == 1) {
                    window.location.href = '/quan-ly-chung-nhan-vien.html';
                } else if (data.status == 2) {
                    window.location.href = '/xac-thuc-nhan-vien.html?email=' + email;
                } else {
                    $('#login_staff1').html('Đăng nhập');
                    $('#error_login_staff').html('Tài khoản hoặc mật khẩu không chính xác');
                }
            }
        });
    }

    $(focusArr[0]).focus();
    return false;
}

function loginCompany() {
    // alert("hello");
    // return false;
    event.preventDefault();
    var form_oke = true;
    var email = $.trim($('#email').val());
    var pass = $.trim($("#pwd").val());
    var focusArr = [];

    if (email == '') {
        $('#error_email_com').html('Vui lòng nhập Email của bạn');
        focusArr.push('#email');
        form_oke = false;
    } else if (email.indexOf("@") < 1 || email.lastIndexOf(".") < (email.indexOf("@") + 2) || (email.lastIndexOf(".") + 2) >= email.length) {
        $('#error_email_com').html('Email không đúng định dạng');
        focusArr.push('#email');
        form_oke = false;
    } else {
        $('#error_email_com').html('');
        form_oke = true;
    }

    if (pass.length == 0) {
        $('#error_pass_com').html('Vui lòng nhập mật khẩu');
        focusArr.push('#pwd');
        form_oke = false;
    } else if (pass.length < 6) {
        $('#error_pass_com').html('Mật khẩu có tối thiểu 6 kí tự');
        focusArr.push('#pwd');
        form_oke = false;
    } else {
        $('#error_pass_com').html('');
        form_oke = true;
    }

    $(focusArr[0]).focus();
    if (form_oke == true) {
        $.ajax({
            type: "POST",
            url: "/dang-nhap-cong-ty.html",
            data: {
                email: email,
                pass: pass,
            },
            dataType: "json",
            async: false,
            success: function(data) {
                console.log(data.result);
                if (data.result == 1) {
                    window.location.href = "/quan-ly-cong-ty.html";
                } else if (data.result == 2) {
                    window.location.href = "/xac-thuc-dang-ky.html";
                } else {
                    $('#error_pass_com').html(data.msg);
                }
            }
        });
    }
    return false;
}