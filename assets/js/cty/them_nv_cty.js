function getInfoStaff(a) {
    // $('#update_nv').reset();
    // console.log(123123);
    // return false;
    $('.error').html('');
    var data = new FormData;
    var id_power = 0;
    // var text_power = '';
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
                // return false;chuc_vu3
            }
        }
    });
    $("#truy_cap3").select2({
        placeholder: 'Quyền truy cập',
        width: "100%"
    }).val(id_power).trigger("change");
    $("#phong_ban3").select2({
        placeholder: 'Phòng ban nơi nhân viên đang làm',
        width: "100%"
    }).val(department).trigger("change");
    $("#chuc_vu3").select2({
        placeholder: 'Chức vụ nơi nhân viên đang làm',
        width: "100%"
    }).val(position).trigger("change");
}


function showdepartment() {
    var id_com = $('#chi_nhanh').val();
    var data = new FormData();
    console.log(id_com)
    data.append('id', id_com);
    $.ajax({
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        // enctype: 'multipart/form-data',
        url: '/company/Company_controller/list_department_by_id',
        data: data,
        dataType: "JSON",
        async: false,
        success: function(data) {
            $(".remove").remove();
            if (data.result == true) {
                var html = '<option class="remove" value="0">Chọn phòng ban nhân viên</option>';
                for (var i = 0; i < data.list.length; i++) {
                    html += '<option class="remove" value="' + data.list[i].dep_id + '">' + data.list[i].dep_name + '</option>';
                }
                $("#phong_ban").html(html);
            } else {
                return false;
            }
        }
    });
}

$(document).ready(function() {
    var emailOK = true;
    $("#ten_ns").change(function() {
        if ($(this) == "") {
            $("#err_name").html("Bạn chưa điền tên nhân viên");
            return false;
        } else {
            $("#err_name").html("");
        }
    });
    $("#email").change(function() {
        var email = $('#email').val().trim();
        $.ajax({
            url: '/staff/StaffRegisterController/staff_register_checkemail',
            type: 'post',
            dataType: "json",
            data: {
                email: email
            },
            success: function(data) {
                console.log(data);
                if (data.status == 'false') {
                    $('#err_email').html('Email này đã tồn tại');
                    emailOK = false;
                } else {
                    emailOK = true;
                }
            }
        });
        if ($(this) == "") {
            $("#err_email").html("Bạn chưa điền email");
            return false;
        } else {
            $("#err_email").html("");
        }
    });
    $("#mat_khau").change(function() {
        if ($(this) == "") {
            $("#err_pass").html("Bạn chưa nhập mật khẩu");
            return false;
        } else {
            $("#err_pass").html("");
        }
    });
    $("#repass").change(function() {
        if ($(this) == "") {
            $("#err_repass").html("Bạn chưa nhập mật khẩu");
            return false;
        } else {
            $("#err_repass").html("");
        }
    });
    $("#telephone").change(function() {
        if ($(this) == "") {
            $("#err_sdt").html("Bạn chưa nhập số điện thoại");
            return false;
        } else {
            $("#err_sdt").html("");
        }
    });
    $("#truy_cap").change(function() {
        if ($(this) == "") {
            $("#err_truycap").html("Bạn chưa chọn quyền truy cập");
            return false;
        } else {
            $("#err_truycap").html("");
        }
    });
    $("#phong_ban2").change(function() {
        if ($(this) == "") {
            $("#err_phongban").html("Bạn chưa chọn phòng ban");
            return false;
        } else {
            $("#err_phongban").html("");
        }
    });
    $("#chuc_vu").change(function() {
        if ($(this) == "") {
            $("#err_phongban").html("Bạn chưa chọn chức vụ");
            return false;
        } else {
            $("#err_phongban").html("");
        }
    });
    $("#l_them_nv").click(function(event) {
        $('#them_nv')[0].reset();
        $('.error').html('');
    })
    $("#them_nv").submit(function(event) {
        event.preventDefault();
        var form_oke = false;
        var ten_ns = $.trim($("#ten_ns").val());
        var email_format = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        var email = $.trim($("#email").val());
        var mat_khau = $.trim($("#mat_khau").val());
        var repass = $.trim($("#repass").val());
        var telephone_format = /((09|03|07|08|05)+([0-9]{8})\b)/g;
        var telephone = $.trim($('#telephone').val());
        var truy_cap = $.trim($("#truy_cap").val());
        var phong_ban2 = $.trim($("#phong_ban2").val());
        var chuc_vu = $.trim($("#chuc_vu").val());

        var form_data = new FormData();
        var arr_id_to_focus = [];

        if (ten_ns == "" || ten_ns == null) {
            $("#err_name1").html("Bạn chưa điền tên nhân viên");
            // $("#err_name").html("Bạn chưa điền email");
            arr_id_to_focus.push("#ten_ns");
            form_oke = false;
        } else {
            $("#err_name1").html("");
            form_data.append('ten_ns', ten_ns);
            form_oke = true;
        }

        // return false;
        if (email == "" || email == null) {
            $("#err_email1").html("Bạn chưa điền email");
            arr_id_to_focus.push("#email");
            form_oke = false;
        } else {
            if (email.match(email_format) == null) {
                $("#err_email1").html("Email không đúng định dạng");
                arr_id_to_focus.push("#email");
                form_oke = false;
            } else {
                if (emailOK == false) {
                    $("#err_email1").html("Email đã tồn tại");
                    arr_id_to_focus.push("#email");
                    form_oke = false;
                } else {
                    $("#err_email1").html("");
                    form_data.append('email', email);
                    // form_oke = true;
                }
            }
        }
        if (mat_khau == "" || mat_khau == null) {
            $("#err_pass1").html("Bạn chưa nhập mật khẩu");
            arr_id_to_focus.push("#mat_khau");
            form_oke = false;
        } else {
            if (mat_khau.length < 6) {
                $("#err_pass1").html("Mật khẩu phải lớn hơn 6 ký tụ");
                arr_id_to_focus.push("#mat_khau");
                form_oke = false;
            } else {
                $("#err_pass1").html("");
                form_data.append('mat_khau', mat_khau);
            }
        }
        if (repass == "" || repass == null) {
            $("#err_repass1").html("Bạn chưa nhập mật khẩu");
            arr_id_to_focus.push("#repass");
            form_oke = false;
        } else {
            if (repass != mat_khau) {
                $("#err_repass1").html("Mật khẩu không trùng khớp");
                arr_id_to_focus.push("#repass");
                form_oke = false;
            } else {
                $("#err_repass1").html("");
                form_data.append("repass", repass);
            }
        }
        if (telephone == "" || telephone == null) {
            $("#err_sdt1").html("Bạn chưa nhập số điện thoại");
            arr_id_to_focus.push("#telephone");
            form_oke = false;
        } else {
            if (telephone.match(telephone_format) == null) {
                $("#err_sdt1").html("Số điện thoại không đúng định dạng");
                arr_id_to_focus.push("#telephone");
                form_oke = false;
            } else {
                $("#err_sdt1").html("");
                form_data.append("telephone", telephone);
            }
        }
        if (truy_cap == "" || truy_cap == null) {
            $("#err_truycap1").html("Bạn chưa chọn quyền truy cập");
            arr_id_to_focus.push("#truy_cap");
            form_oke = false;
        } else {
            $("#err_truycap1").html("");
            form_data.append("truy_cap", truy_cap);
        }
        if (phong_ban2 == "" || phong_ban2 == null) {
            $("#err_phongban1").html("Bạn chưa chọn phòng ban");
            arr_id_to_focus.push("#phong_ban2");
            form_oke = false;
        } else {
            $("#err_phongban1").html("");
            form_data.append("phong_ban2", phong_ban2);
        }
        if (chuc_vu == "" || chuc_vu == null) {
            $("#err_chucvu1").html("Bạn chưa chọn chức vụ");
            arr_id_to_focus.push("#chuc_vu");
            form_oke = false;
        } else {
            $("#err_chucvu1").html("");
            form_data.append("chuc_vu", chuc_vu);
        }
        if (form_oke == true) {
            $.ajax({
                type: "POST",
                url: '/company/Company_controller/add_staff',
                data: form_data,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.result == 3) {
                        $("#alert").append('<div class="alert-success"> Thêm nhân viên thành công</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {
                                location.reload();
                            });
                        }, 1500);
                    } else {
                        $("#alert").append('<div class="alert-success_error">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success_error").fadeOut(1000, function() {});
                        }, 1500);
                    }
                }
            });
        } else {
            $(arr_id_to_focus[0]).focus();
        }
        return false;
    });

    // // cập nhật nhân viên

    $("#update_nv1111").submit(function(event) {
        event.preventDefault();
        var form_oke = true;
        var ten_ns = $.trim($("#ten_ns_update").val());
        var id_staff = $.trim($("#id_staff").val());
        // var email = $.trim($("#email_update").val());
        var mat_khau = $.trim($("#mat_khau_update").val());
        var repass = $.trim($("#repass_update").val());
        var telephone_format = /((09|03|07|08|05)+([0-9]{8})\b)/g;
        var telephone = $.trim($('#telephone_update').val());
        // var truy_cap = $("#truy_cap3").val();
        var phong_ban2 = $.trim($("#phong_ban3").val());
        var chuc_vu = $.trim($("#chuc_vu3").val());
        var form_data = new FormData();
        var arr_id_to_focus = [];

        form_data.append('staff_id', id_staff);

        if (ten_ns == "" || ten_ns == null) {
            $("#err_name").html("Bạn chưa điền tên nhân viên");
            arr_id_to_focus.push("#ten_ns_update");
            form_oke = false;
        } else {
            $("#err_name").html("");
            form_data.append('ten_ns', ten_ns);
        }

        if (mat_khau != '') {
            if (mat_khau.length < 6) {
                $("#err_pass").html("Mật khẩu phải lớn hơn 6 ký tự");
                arr_id_to_focus.push("#mat_khau_update");
                form_oke = false;
            } else if (repass == "" || repass == null) {
                $("#err_repass").html("Bạn chưa nhập mật khẩu");
                arr_id_to_focus.push("#repass_update");
                form_oke = false;
            } else {
                if (repass != mat_khau) {
                    $("#err_repass").html("Mật khẩu không trùng khớp");
                    arr_id_to_focus.push("#repass_update");
                    form_oke = false;
                } else {
                    $("#err_repass").html("");
                    form_data.append("mat_khau", mat_khau);
                }
            }
        }

        if (telephone == "" || telephone == null) {
            $("#err_sdt").html("Bạn chưa nhập số điện thoại");
            arr_id_to_focus.push("#telephone_update");
            form_oke = false;
        } else {
            if (telephone.match(telephone_format) == null) {
                $("#err_sdt").html("Số điện thoại không đúng định dạng");
                arr_id_to_focus.push("#telephone_update");
                form_oke = false;
            } else {
                $("#err_sdt").html("");
                form_data.append("telephone", telephone);
            }
        }
        // if (truy_cap == "" || truy_cap == null) {
        //     $("#err_truycap").html("Bạn chưa chọn quyền truy cập");
        //     arr_id_to_focus.push("#truy_cap3");
        //     form_oke = false;
        // } else {
        //     $("#err_truycap").html("");
        //     form_data.append("truy_cap", truy_cap);
        // }
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
            // console.log(form_data);
            // return false;
            $.ajax({
                type: "POST",
                url: '/company/Company_controller/update_staff',
                data: form_data,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.result == true) {
                        $("#alert").append('<div class="alert-success">Cập nhật nhân viên thành công</div>');
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

    $('#phong_ban').select2({
        placeholder: 'Phòng ban nơi nhân viên đang làm',
        width: "100%"
    });
    $('#phong_ban1').select2({
        placeholder: 'Chọn phòng ban',
        width: "100%"
    });
    $('#chi_nhanh').select2({
        placeholder: 'Chọn chi nhánh',
        width: "100%"
    });
    $('#chi_nhanh1').select2({
        placeholder: 'Chọn chi nhánh',
        width: "100%"
    });
    $('#truy_cap').select2({
        placeholder: 'Chọn quyền nhân viên',
        width: "100%"
    });
    $('#phong_ban2').select2({
        placeholder: 'Chọn phòng ban nhân viên',
        width: "100%",
    });
    $('#chuc_vu').select2({
        placeholder: 'Chọn chức vụ',
        width: "100%",

    });
    $('#phong_ban3').select2({
        placeholder: 'Chọn phòng ban nhân viên',
        width: "100%",
    });
    $('#chuc_vu3').select2({
        placeholder: 'Chọn chức vụ',
        width: "100%",
    });
    $('#truy_cap3').select2({
        placeholder: 'Chọn quyền nhân viên',
        width: "100%"
    });
    $(".d-ds-nhan-vien").click(function() {
        $('.d-ds-nhan-vien').addClass('active');
        $('.d-ds-nv').removeClass('active');
        $('#ds_nhan_vien').addClass('active');
        $('#ds_nv_chua_duyet').removeClass('active');
    });
    $(".d-ds-nv").click(function() {
        $('.d-ds-nv').addClass('active');
        $('.d-ds-nhan-vien').removeClass('active');
        $('#ds_nv_chua_duyet').addClass('active');
        $('#ds_nhan_vien').removeClass('active');
    });
    $(".tick-all").click(function() {
        if (!$(this).hasClass("checked")) {
            $(this).addClass('checked').attr('src', '' + '/assets/images/chon_all.svg');
            $('.tick-chon').addClass('checked').attr('src', '' + '/assets/images/tick_xanh.svg');
            $('.bo-chon').removeClass('checked').attr('src', '' + '/assets/images/k_chon.svg');
        } else {
            $(this).removeClass('checked').attr('src', '' + '/assets/images/tick.svg');
            $('.tick-chon').removeClass('checked').attr('src', '' + '/assets/images/tick.svg');
        }
    });
    $('.tick-chon').click(function() {
        if (!$(this).hasClass("checked")) {
            $(this).addClass('checked').attr('src', '' + '/assets/images/tick_xanh.svg');
            $('.bo-chon').removeClass('checked').attr('src', '' + '/assets/images/k_chon.svg');
        }
    });
    $('.bo-chon').click(function() {
        if (!$(this).hasClass("checked")) {
            $(this).addClass('checked').attr('src', '' + '/assets/images/k_chon1.svg');
            $('.tick-chon').removeClass('checked').attr('src', '' + '/assets/images/tick.svg');
            $(".tick-all").removeClass('checked').attr('src', '' + '/assets/images/tick.svg');
        }
    });

});

function chon(id) {
    var data = new FormData();
    data.append('active', id);
    $.ajax({
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        // enctype: 'multipart/form-data',
        url: '/company/Company_controller/activeStaff',
        data: data,
        dataType: "JSON",
        async: false,
        success: function(data) {
            if (data.result == true) {
                $("#alert").append('<div class="alert-success">Thực hiện thành công</div>');
                setTimeout(function() {
                    $(".alert-success").fadeOut(1000, function() {});
                }, 1500);
                $('#count_active').html(data.count_active);
                $('#count_noActive').html(data.count_noactive);
                $('#no_active' + id).css('display', 'none');
                $('#no_active-mb' + id).css('display', 'none');
            } else {
                return false;
            }
        }
    });
}

function deleteNoActive(id) {
    if (confirm('Bạn có chắc muốn xóa nhân viên?')) {
        var data = new FormData();
        data.append('id', id);
        $.ajax({
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            // enctype: 'multipart/form-data',
            url: '/company/Company_controller/deleteNoActive',
            data: data,
            dataType: "JSON",
            async: false,
            success: function(data) {
                if (data.result == true) {
                    $("#alert").append('<div class="alert-success">Xóa nhân viên thành công</div>');
                    setTimeout(function() {
                        $(".alert-success").fadeOut(1000, function() {});
                    }, 1500);
                    // $('#count_active').html(data.count_active);
                    // $('#count_noActive').html(data.count_noactive);
                    $('#no_active' + id).css('display', 'none');
                    $('#no_active-mb' + id).css('display', 'none');
                    $('#active' + id).css('display', 'none');
                    $('#active-mb' + id).css('display', 'none');
                } else {
                    return false;
                }
            }
        });
    }
}

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
                        $(".alert-success").fadeOut(1000, function() {});
                    }, 1500);
                    // $('#count_active').html(data.count_active);
                    // $('#count_noActive').html(data.count_noactive);
                    $('#no_active' + id).css('display', 'none');
                    $('#no_active-mb' + id).css('display', 'none');
                    $('#active' + id).css('display', 'none');
                    $('#active-mb' + id).css('display', 'none');
                } else {
                    return false;
                }
            }
        });
    }
}


function active_all() {
    var a = [];
    $('.active1').each(function() {
        var staff_id = $(this).attr("data-id");
        a.push(staff_id);
    });
    var data = new FormData();
    data.append('active', a);
    $.ajax({
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        // enctype: 'multipart/form-data',
        url: '/company/Company_controller/activeStaff',
        data: data,
        dataType: "JSON",
        async: false,
        success: function(data) {
            if (data.result == true) {
                $("#alert").append('<div class="alert-success">Thực hiện thành công</div>');
                setTimeout(function() {
                    $(".alert-success").fadeOut(1000, function() {});
                }, 1500);
                $('#count_active').html(data.count_active);
                $('#count_noActive').html(data.count_noactive);
                for (let index = 0; index < a.length; index++) {
                    $('#no_active' + a[index]).css('display', 'none');
                }
                $('#active' + id).css('display', 'none');
            } else {
                return false;
            }
        }
    });
}

function show_depament(a) {
    $('#scroll').html("");
    var id = 0;
    if (a == 1) {
        id = $('#chi_nhanh').val();
    } else {
        id = $('#chi_nhanh1').val();
    }
    var data = new FormData();
    data.append('id', id);
    $.ajax({
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        // enctype: 'multipart/form-data',
        url: '/company/Company_controller/list_department_by_id',
        data: data,
        dataType: "JSON",
        async: false,
        success: function(data) {
            if (data.result == true) {
                var html = ''
                $('.l_remove_department').remove();
                if (a == 1) {
                    for (let index = 0; index < data.list.length; index++) {
                        $('#phong_ban').append('<option class="l_remove_department" value="' + data.list[index].dep_id + '">' + data.list[index].dep_name + '</option>');
                    }
                } else {
                    for (let index = 0; index < data.list.length; index++) {
                        $('#phong_ban1').append('<option class="l_remove_department" value="' + data.list[index].dep_id + '">' + data.list[index].dep_name + '</option>');
                    }
                }
                // $('#append_department').append(html);
            } else {
                return false;
            }
        }
    });
}

function timkiem(e) {
    var active = $('#duyet').attr("data-id");
    var name = $('#search').val();
    var chi_nhanh = '';
    var phong_ban = '';
    var chi_nhanh1 = $('#chi_nhanh1').val();
    var phong_ban1 = $('#phong_ban1').val();
    var chi_nhanh = '';
    var phong_ban = '';
    if ($('#chi_nhanh').val() == '') {
        chi_nhanh = chi_nhanh1;
    } else {
        chi_nhanh = $('#chi_nhanh').val();
    }
    if ($('#phong_ban').val() == '') {
        phong_ban = phong_ban1;
    } else {
        phong_ban = $('#phong_ban').val();
    }

    if (name != '' && phong_ban != '' && chi_nhanh != '') {
        window.location.href = '/quan-ly-nhan-vien-cong-ty.html/' + active + '?keyWord=' + name + '&cn=' + chi_nhanh + '&d=' + phong_ban;
    } else if (name != '' && phong_ban == '' && chi_nhanh != '') {
        window.location.href = '/quan-ly-nhan-vien-cong-ty.html/' + active + '?keyWord=' + name + '&cn=' + chi_nhanh;
    } else if (name != '' && phong_ban != '' && chi_nhanh == '') {
        window.location.href = '/quan-ly-nhan-vien-cong-ty.html/' + active + '?keyWord=' + name + '&d=' + phong_ban;
    } else if (name == '' && phong_ban != '' && chi_nhanh != '') {
        window.location.href = '/quan-ly-nhan-vien-cong-ty.html/' + active + '?cn=' + chi_nhanh + '&d=' + phong_ban;
    } else if (name != '' && phong_ban == '' && chi_nhanh == '') {
        window.location.href = '/quan-ly-nhan-vien-cong-ty.html/' + active + '?keyWord=' + name;
    } else if (name == '' && phong_ban == '' && chi_nhanh != '') {
        window.location.href = '/quan-ly-nhan-vien-cong-ty.html/' + active + '?cn=' + chi_nhanh;
    } else if (name == '' && phong_ban != '' && chi_nhanh != '') {
        window.location.href = '/quan-ly-nhan-vien-cong-ty.html/' + active + '?d=' + phong_ban;
    } else {
        window.location.href = '/quan-ly-nhan-vien-cong-ty.html/' + active;
    }

}

function xoa_dau(str) {
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
    str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
    str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
    str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
    str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
    str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
    str = str.replace(/Đ/g, "D");
    return str;
}

function export_excel() {
    var active = $('#duyet').attr("data-id");
    var name = $('#search').val();
    var chi_nhanh = '';
    var phong_ban = '';
    var chi_nhanh1 = $('#chi_nhanh1').val();
    var phong_ban1 = $('#phong_ban1').val();
    var chi_nhanh = '';
    var phong_ban = '';
    if ($('#chi_nhanh').val() == '') {
        chi_nhanh = chi_nhanh1;
    } else {
        chi_nhanh = $('#chi_nhanh').val();
    }
    if ($('#phong_ban').val() == '') {
        phong_ban = phong_ban1;
    } else {
        phong_ban = $('#phong_ban').val();
    }
    window.location.href = '/company/Company_controller/export_excel/' + active + '?keyWord=' + name + '&cn=' + chi_nhanh + '&d=' + phong_ban;
}