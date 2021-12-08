$(document).ready(function() {
    $('#chuc_vu').select2({
        placeholder: 'Chọn chức vụ nhân viên đang giữ',
        width: "100%"
    });
    $('#phan_quyen').select2({
        placeholder: 'Chọn quyền truy cập cho nhân viên',
        width: "100%"
    });
    $("#sign_up_company").submit(function(event) {
        var form_oke = false;
        var ten_ns = $.trim($("#name").val());
        var email_format = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        var email = $.trim($("#email").val());
        var mat_khau = $.trim($("#pass").val());
        var repass = $.trim($("#re_pass").val());
        var telephone_format = /((09|03|07|08|05)+([0-9]{8})\b)/g;
        var telephone = $.trim($('#sdt').val());
        var dia_chi = $.trim($("#dia_chi").val());
        var phan_quyen = $.trim($("#phan_quyen").val());
        var chuc_vu = $.trim($("#chuc_vu").val());

        var form_data = new FormData();
        var arr_id_to_focus = [];
        form_data.append('dia_chi', dia_chi);
        if (email == "" || email == null) {
            $("#err_email").html("Bạn chưa điền email");
            arr_id_to_focus.push("#email");
            form_oke = false;
        } else {
            if (email.match(email_format) == null) {
                $("#err_email").html("Email không đúng định dạng");
                arr_id_to_focus.push("#email");
                form_oke = false;
            } else {
                $("#err_email").html("");
                form_data.append('email', email);
            }
        }

        if (mat_khau == "" || mat_khau == null) {
            $("#err_pass").html("Bạn chưa nhập mật khẩu");
            arr_id_to_focus.push("#pass");
            form_oke = false;
        } else {
            if (mat_khau.length < 6) {
                $("#err_pass").html("Mật khẩu phải lớn hơn 6 ký tụ");
                arr_id_to_focus.push("#pass");
                form_oke = false;
            } else {
                $("#err_pass").html("");
                form_data.append('mat_khau', mat_khau);
            }
        }
        if (repass == "" || repass == null) {
            $("#err_repass").html("Bạn chưa nhập lại mật khẩu");
            arr_id_to_focus.push("#re_pass");
            form_oke = false;
        } else {
            if (repass != mat_khau) {
                $("#err_repass").html("Mật khẩu không trùng khớp");
                arr_id_to_focus.push("#re_pass");
                form_oke = false;
            } else {
                $("#err_repass").html("");
                form_data.append("repass", repass);
            }
        }

        if (ten_ns == "" || ten_ns == null) {
            $("#err_name").html("Bạn chưa điền tên nhân viên");
            // $("#err_name").html("Bạn chưa điền email");
            arr_id_to_focus.push("#name");
            form_oke = false;
        } else {
            $("#err_name").html("");
            form_data.append('ten_ns', ten_ns);
            form_oke = true;
        }

        if (telephone == "" || telephone == null) {
            $("#err_sdt").html("Bạn chưa nhập số điện thoại");
            arr_id_to_focus.push("#sdt");
            form_oke = false;
        } else {
            if (telephone.match(telephone_format) == null) {
                $("#err_sdt").html("Số điện thoại không đúng định dạng");
                arr_id_to_focus.push("#sdt");
                form_oke = false;
            } else {
                $("#err_sdt").html("");
                form_data.append("telephone", telephone);
            }
        }

        if (chuc_vu == "" || chuc_vu == null) {
            $("#err_chucvu").html("Bạn chưa chọn chức vụ");
            arr_id_to_focus.push("#chuc_vu");
            form_oke = false;
        } else {
            $("#err_chucvu").html("");
            form_data.append("chuc_vu", chuc_vu);
        }

        if (phan_quyen == "" || phan_quyen == null) {
            $("#err_phan_quyen").html("Bạn chưa chọn quyền truy cập");
            arr_id_to_focus.push("#phan_quyen");
            form_oke = false;
        } else {
            $("#err_phan_quyen").html("");
            form_data.append("phan_quyen", phan_quyen);
        }

        if (form_oke == true) {
            $.ajax({
                type: "POST",
                url: '/company/Company_controller/add_second_account',
                data: form_data,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.result == true) {
                        $("#alert").append('<div class="alert-success"> Thêm nhân viên thành công</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {
                                window.location.href = '/dang-nhap.html';
                            });
                        }, 1000);
                    } else {
                        return false;
                    }
                }
            });
        }

        $(arr_id_to_focus[0]).focus();
        return false;
    });
});

function istrim(evt) {
    var num = String.fromCharCode(evt.which);
    if (num == " ") {
        evt.preventDefault();
    }
}

function del_ss() {
    var a = 1;
    $.ajax({
        type: "POST",
        url: '/company/Company_controller/del_session',
        data: a,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.result == true) {
                window.location.href = '/dang-nhap.html';
            } else {
                return false;
            }
        }
    });
}