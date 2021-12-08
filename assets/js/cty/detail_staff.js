$(document).ready(function() {
    $("#update_nv1111").submit(function(event) {
        event.preventDefault();
        var form_oke = true;
        var ten_ns = $.trim($("#ten_ns_update").val());
        var id_staff = $.trim($("#id_staff").val());
        // var email = $.trim($("#email_update").val());
        // var mat_khau = $.trim($("#mat_khau_update").val());
        // var repass = $.trim($("#repass_update").val());
        var telephone_format = /((09|03|07|08|05)+([0-9]{8})\b)/g;
        var telephone = $.trim($('#telephone_update').val());
        var truy_cap = $("#truy_cap3").val();
        var phong_ban2 = $.trim($("#phong_ban3").val());
        var chuc_vu = $.trim($("#chuc_vu3").val());
        var form_data = new FormData();
        var arr_id_to_focus = [];

        form_data.append('staff_id', id_staff);

        if (ten_ns == "" || ten_ns == null) {
            $("#err_name").html("Bạn chưa điền tên nhân viên");
            arr_id_to_focus.push("#ten_ns");
            form_oke = false;
        } else {
            $("#err_name").html("");
            form_data.append('ten_ns', ten_ns);
        }
        // if (mat_khau == "" || mat_khau == null) {
        //     $("#err_pass").html("Bạn chưa nhập mật khẩu");
        //     arr_id_to_focus.push("#mat_khau");
        //     form_oke = false;
        // } else {
        //     if (mat_khau.length < 6) {
        //         $("#err_pass").html("Mật khẩu phải lớn hơn 6 ký tụ");
        //         arr_id_to_focus.push("#mat_khau");
        //         form_oke = false;
        //     } else {
        //         $("#err_pass").html("");
        //         form_data.append('mat_khau', mat_khau);
        //     }
        // }
        // if (repass == "" || repass == null) {
        //     $("#err_repass").html("Bạn chưa nhập mật khẩu");
        //     arr_id_to_focus.push("#repass");
        //     form_oke = false;
        // } else {
        //     if (repass != mat_khau) {
        //         $("#err_repass").html("Mật khẩu không trùng khớp");
        //         arr_id_to_focus.push("#repass");
        //         form_oke = false;
        //     } else {
        //         $("#err_repass").html("");
        //         form_data.append("repass", repass);
        //     }
        // }
        if (telephone == "" || telephone == null) {
            $("#err_sdt").html("Bạn chưa nhập số điện thoại");
            arr_id_to_focus.push("#telephone");
            form_oke = false;
        } else {
            if (telephone.match(telephone_format) == null) {
                $("#err_sdt").html("Số điện thoại không đúng định dạng");
                arr_id_to_focus.push("#telephone");
                form_oke = false;
            } else {
                $("#err_sdt").html("");
                form_data.append("telephone", telephone);
            }
        }
        if (truy_cap == "" || truy_cap == null) {
            $("#err_truycap").html("Bạn chưa chọn quyền truy cập");
            arr_id_to_focus.push("#truy_cap3");
            form_oke = false;
        } else {
            $("#err_truycap").html("");
            form_data.append("truy_cap", truy_cap);
        }
        if (phong_ban2 == "" || phong_ban2 == null) {
            $("#err_phongban").html("Bạn chưa chọn quyền truy cập");
            arr_id_to_focus.push("#phong_ban3");
            form_oke = false;
        } else {
            $("#err_phongban").html("");
            form_data.append("phong_ban2", phong_ban2);
        }
        if (chuc_vu == "" || chuc_vu == null) {
            $("#err_chucvu").html("Bạn chưa chọn quyền truy cập");
            arr_id_to_focus.push("#chuc_vu3");
            form_oke = false;
        } else {
            $("#err_chucvu").html("");
            form_data.append("chuc_vu", chuc_vu);
        }
        if (form_oke == true) {
            $.ajax({
                type: "POST",
                url: '/company/Company_controller/update_staff',
                data: form_data,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.result == true) {
                        $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {
                                location.reload();
                            });
                        }, 1500);
                    } else {
                        return false;
                    }
                }
            });
        } else {
            $(arr_id_to_focus[0]).focus();
        }
        return false;
    });

});

function deleteActive(id) {
    if (confirm('Bạn có chắc muốn xóa nhân viên?')) {
        var data = new FormData();
        data.append('id', id);
        $.ajax({
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            // enctype: 'multipart/form-data',
            url: '/company/Company_controller/deleteActive',
            data: data,
            dataType: "JSON",
            async: false,
            success: function(data) {
                if (data.result == true) {
                    $("#alert").append('<div class="alert-success">Xóa nhân viên thành công</div>');
                    setTimeout(function() {
                        $(".alert-success").fadeOut(1000, function() {
                            window.location.href = "/quan-ly-nhan-vien-cong-ty.html/1";
                        });
                    }, 500);
                } else {
                    return false;
                }
            }
        });
    }
}

function getInfoStaff(a) {
    $('.error').html('');
    var data = new FormData;
    var id_power = 0;
    var department = 0;
    var position = 0;
    data.append('staff_id', a);
    $.ajax({
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        // enctype: 'multipart/form-data',
        url: '/company/Company_controller/infoStaff',
        data: data,
        dataType: "JSON",
        async: false,
        success: function(data) {
            if (data.result == true) {
                $('#ten_ns_update').val(data.info.ep_name);
                $('#telephone_update').val(data.info.ep_phone);
                $('#id_staff').val(a);
                id_power = data.info.role_id;
                department = data.info.dep_id;
                position = data.info.position_id;
            } else {
                return false;
            }
        }
    });
    $("#truy_cap3").select2({
        placeholder: 'Phòng ban nơi nhân viên đang làm',
        width: "100%"
    }).val(id_power).trigger("change");
    $("#phong_ban3").select2({
        placeholder: 'Phòng ban nơi nhân viên đang làm',
        width: "100%"
    }).val(department).trigger("change");
    $("#chuc_vu3").select2({
        placeholder: 'Phòng ban nơi nhân viên đang làm',
        width: "100%"
    }).val(position).trigger("change");
}

function deletes(e) {
    dom_parent = $(e).parent().remove();
}