$(document).ready(function() {
    $('.d-dropdown').hover(function() {
            $(this).attr('src', '/assets/images/them1.svg');
        },
        function() {
            $(this).attr('src', '/assets/images/them.svg');
        });

    $('#cty_update_avatar').click(function() {
        $('#input_cty_avatar').click();
    });

    $('#show_pass1').click(function() {
        if ($('#cty_old_pass').attr('type') == 'password') {
            $('#cty_old_pass').attr('type', 'text');
            $(this).val('Hide');
            $('#show_pass1').attr("src", "/assets/images/Show.png");
        } else {
            $('#cty_old_pass').attr('type', 'password');
            $(this).val('Show');
            $('#show_pass1').attr("src", "/assets/images/Hide.png");
        }
    });

    $('#show_pass2').click(function() {
        if ($('#cty_new_pass').attr('type') == 'password') {
            $('#cty_new_pass').attr('type', 'text');
            $(this).val('Hide');
            $('#show_pass2').attr("src", "/assets/images/Show.png");
        } else {
            $('#cty_new_pass').attr('type', 'password');
            $(this).val('Show');
            $('#show_pass2').attr("src", "/assets/images/Hide.png");
        }
    });

    $('#show_pass3').click(function() {
        if ($('#cty_re_new_pass').attr('type') == 'password') {
            $('#cty_re_new_pass').attr('type', 'text');
            $(this).val('Hide');
            $('#show_pass3').attr("src", "/assets/images/Show.png");
        } else {
            $('#cty_re_new_pass').attr('type', 'password');
            $(this).val('Show');
            $('#show_pass3').attr("src", "/assets/images/Hide.png");
        }
    });

});

function deletes(e) {
    dom_parent = $(e).parent().remove();
}

function checkpass() {
    var old_pass = $('#cty_old_pass').val().trim();
    var data = new FormData();
    data.append('pass', old_pass);
    var a = 0;
    $.ajax({
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        url: "/company/Company_controller/checkPass",
        data: data,
        dataType: "JSON",
        async: false,
        success: function(data) {
            if (data.result == false) {
                a = 2;
            } else {
                a = 1;
            }
        }
    });
    return a;
}

$('.q-cty-doimk-form').submit(function(event) {
    event.preventDefault();
    var old_pass = $('#cty_old_pass').val().trim();
    var new_pass = $('#cty_new_pass').val().trim();
    var re_new_pass = $('#cty_re_new_pass').val().trim();
    form_oke = true;
    var focusArr = [];

    if (old_pass == '') {
        $('#val_dmk_old').html('Vui lòng nhập mật khẩu hiện tại');
        focusArr.push('#cty_old_pass');
        return false;
    }

    if (new_pass == '') {
        $('#val_dmk_new').html('Vui lòng nhập mật khẩu mới');
        $('#cty_new_pass').focus();
        focusArr.push('#cty_new_pass');
        return false;
    } else {
        if (new_pass.length < 6) {
            $('#val_dmk_new').html('Mật khẩu có tối thiểu 6 kí tự');
            $('#cty_new_pass').focus();
            focusArr.push('#cty_new_pass');
            return false;
        } else {
            $('#val_dmk_new').html('');
        }
    }

    if (re_new_pass == '') {
        $('#val_dmk_renew').html('Vui lòng nhập lại mật khẩu mới');
        $('#cty_re_new_pass').focus();
        focusArr.push('#cty_re_new_pass');
        return false;
    } else {
        if (re_new_pass.length < 6) {
            $('#val_dmk_renew').html('Mật khẩu có tối thiểu 6 kí tự');
            $('#cty_re_new_pass').focus();
            focusArr.push('#cty_re_new_pass');
            return false;
        } else {
            if (re_new_pass != new_pass) {
                $('#val_dmk_renew').html('Mật khẩu nhập lại không đúng');
                $('#cty_re_new_pass').focus();
                focusArr.push('#cty_re_new_pass');
                return false;
            } else {
                $('#val_dmk_renew').html('');
            }
        }
    }
    if (form_oke == true) {
        var data = new FormData;
        data.append('pass', new_pass);
        data.append('old_pass', old_pass);
        $.ajax({
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            url: '/company/Company_controller/changePassword',
            data: data,
            dataType: "JSON",
            async: false,
            success: function(data) {
                if (data.result == true) {
                    $('.val_error').html('');
                    $('#cty_old_pass').val('');
                    $('#cty_new_pass').val('');
                    $('#cty_re_new_pass').val('');
                    $("#alert").append('<div class="alert-success">Đổi mật khẩu thành công</div>');
                    setTimeout(function() {
                        $(".alert-success").fadeOut(1000, function() {
                            $(".alert-success").remove();
                        });
                    }, 2000);
                } else {
                    $('#val_dmk_old').html(data.msg);
                }
            }
        });
    }
    // $(focusArr[0]).focus();
    // return false;
});

// function checkpass(){
//     var old_pass = $('#cty_old_pass').val().trim();
//     var data = new FormData();
//     data.append('pass',old_pass);
//     // console.log(old_pass);
//     // return false;
//     $a = 0;
//     $.ajax({
//         type: "POST",
//         cache: false,
//         contentType: false,
//         processData: false,
//         // enctype: 'multipart/form-data',
//         url: "/company/Company_controller/checkPass",
//         data: data,
//         dataType: "JSON",
//         success: function(data) {
//             if (data.result == false) {
//                 $('#val_dmk_old').html('Mật khẩu cũ không đúng');
//                 $('#cty_old_pass').focus();
//                 $a = 0;
//                 // window.location.href = "/danh-cho-cong-ty/cap-nhat-thong-tin-cong-ty.html";
//                 // console.log(123123);

//             }else{
//                 $('#val_dmk_old').html('')
//                 $a = 1;
//             }

//         }
//     });
//     return a;
// }
// if (form_oke == true) {
//     var data = new FormData();
//     data.append('name', name);
//     data.append('phone', phone);
//     data.append('address', address);
//     data.append('avatar', avatar);
//     $.ajax({
//         type: "POST",
//         cache: false,
//         contentType: false,
//         processData: false,
//         enctype: 'multipart/form-data',
//         url: "/company/Company_controller/update_ntd",
//         data: data,
//         dataType: "JSON",
//         success: function(data) {
//             if (data.result == true) {
//                 window.location.href = "/danh-cho-cong-ty/cap-nhat-thong-tin-cong-ty.html";
//                 // console.log(123123);
//             }

//         }
//     });
// }