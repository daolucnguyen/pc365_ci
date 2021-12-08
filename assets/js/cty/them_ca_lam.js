function showdepartment() {
    var id_com = $("#cong_ty").val();
    var id_small = 0;
    var data = new FormData();

    data.append('id', id_com);
    data.append('id_small', id_small);
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
                $("#phong_ban").html('');
                $("#phong_ban").append('<option value="">Chọn phòng ban</option>');
                for (let i = 0; i < data.list.length; i++) {
                    $("#phong_ban").append('<option value="' + data.list[i].id_department + '">' + data.list[i].name_department + '</option>');
                }
            } else {
                return false;
            }
        }
    });
}

function getInfoShift(id) {
    var data = new FormData();
    data.append('id', id);
    var num = 0;
    $.ajax({
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        // enctype: 'multipart/form-data',
        url: '/company/Company_controller/getInfoShift',
        data: data,
        dataType: "JSON",
        async: false,
        success: function(data) {
            if (data.result == true) {
                id_com = data.id_com;
                $("#ten_ca").val(data.shift_name);
                $("#time_in").val(data.start_time);
                $("#time_out").val(data.end_time);
                $("#gio_vao_muon_edit").val(data.start_time_latest);
                $("#gio_ra_som_edit").val(data.end_time_earliest);
                $("#id_shift").val(data.shift_id);
                if (data.shift_type == 2) {
                    $('#hourly_edit').prop('checked', true);
                } else {
                    $('#num_shift_edit').prop('checked', true);
                    num = data.num_to_calculate;
                    $('.num_to_calculate').show().val(num).trigger("change");
                }
            } else {
                return false;
            }
        }
    });
    $("#chon_cty_update").select2({
        placeholder: 'Chọn công ty',
        width: "100%"
    }).val(id_com).trigger("change");

}

$(document).ready(function() {
    $('#cong_ty').select2({
        placeholder: "Chọn công ty",
        width: "100%",
    });
    $('#num_to_calculate,#num_to_calculate_edit').select2({
        placeholder: "Chọn số công",
        width: "100%",
    });
    $('#chon_cty,#chon_cty_update,#chon_cty_add').select2({
        placeholder: "Chọn công ty",
        width: "100%",
    });
    $('#phong_ban').select2({
        placeholder: "Chọn phòng ban",
        width: "100%",
    });

    $('#num_shift,#num_shift_edit').change(function() {
        $('.num_to_calculate').show();
    })

    $('#hourly,#hourly_edit').change(function() {
        $('.num_to_calculate').hide();
    })

    $("#them_ca_lam").submit(function() {
        var form_oke = false;
        var form_data = new FormData();
        var arr_id_to_focus = [];
        var ten_cty = $.trim($("#chon_cty_add").val());
        var ca_lam = $.trim($("#ca_lam").val());
        var gio_vao = $.trim($("#gio_vao").val());
        var gio_ra = $.trim($("#gio_ra").val());
        var gio_vao_muon = $.trim($("#gio_vao_muon").val());
        var gio_ra_som = $.trim($("#gio_ra_som").val());

        if (ten_cty == "" || ten_cty == null) {
            $("#err_cty").html("Bạn chưa chọn công ty");
            arr_id_to_focus.push("#ten_ty");
        } else {
            $("#err_cty").html("");
            form_data.append("ten_cty", ten_cty);
            form_oke = true;
        }
        if (ca_lam == "" || ca_lam == null) {
            $("#err_calam").html("Bạn chưa nhập ca làm");
            arr_id_to_focus.push("#ca_lam");
        } else {
            $("#err_calam").html("");
            form_data.append("ca_lam", ca_lam);
            form_oke = true;
        }
        if (gio_vao == "") {
            $("#err_vaolam").html("Bạn chưa nhập giờ vào làm");
            arr_id_to_focus.push("#gio_vao");
        } else {
            form_oke = true;
            $("#err_vaolam").html("");
            form_data.append("gio_vao", gio_vao);
        }
        if (gio_ra == "") {
            $("#err_tanlam").html("Bạn chưa nhập giờ tan làm");
            arr_id_to_focus.push("#gio_ra");
        } else {
            form_oke = true;
            $("#err_tanlam").html("");
            form_data.append("gio_ra", gio_ra);
        }

        if (gio_vao_muon == "") {
            $("#err_gio_vao_muon").html("Bạn chưa nhập giờ vào ca muộn nhất");
            arr_id_to_focus.push("#gio_vao_muon");
        } else if (gio_vao_muon < gio_vao) {
            $("#err_gio_vao_muon").html("Giờ vào ca muộn nhất phải lớn hơn giờ vào ca");
            arr_id_to_focus.push("#gio_vao_muon");
        } else {
            form_oke = true;
            $("#err_gio_vao_muon").html("");
            form_data.append("gio_vao_muon", gio_vao_muon);
        }

        if (gio_ra_som == "") {
            $("#err_gio_ra_som").html("Bạn chưa nhập giờ vào ca muộn nhất");
            arr_id_to_focus.push("#gio_ra_som");
        } else if (gio_ra_som > gio_ra) {
            $("#err_gio_ra_som").html("Giờ vào ca muộn nhất phải nhỏ hơn giờ vào ca");
            arr_id_to_focus.push("#gio_ra_som");
        } else {
            form_oke = true;
            $("#err_gio_ra_som").html("");
            form_data.append("gio_ra_som", gio_ra_som);
        }

        var cach_thuc_tinh = [];
        $(".cach_thuc_tinh").each(function() {
            if ($(this).is(":checked")) {
                cach_thuc_tinh.push($(this).val());
            }
        });
        if (cach_thuc_tinh[0] == undefined) {
            $("#err_cach_thuc_tinh").html("Bạn chưa chọn cách thức tính công");
            arr_id_to_focus.push("#hourly");
        } else if (cach_thuc_tinh[0] == 2) {
            $("#err_cach_thuc_tinh").html("");
            form_data.append("type", cach_thuc_tinh[0]);
            form_data.append("num_to_calculate", 1);
            form_oke = true;
        } else if (cach_thuc_tinh[0] == 1) {
            $("#err_cach_thuc_tinh").html("");
            var num_to_calculate = $.trim($('#num_to_calculate').val());
            if (num_to_calculate == '') {
                $("#err_num_to_calculate").html("Bạn chưa chọn số công của 1 ca");
                arr_id_to_focus.push("#num_to_calculate");
            } else {
                $("#err_num_to_calculate").html("");
                form_data.append("type", cach_thuc_tinh[0]);
                form_oke = true;
                form_data.append("num_to_calculate", num_to_calculate);
            }
        }
        if (form_oke == true) {
            $.ajax({
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                // enctype: 'multipart/form-data',
                url: '/company/Company_controller/createShift',
                data: form_data,
                dataType: "JSON",
                async: false,
                success: function(data) {
                    if (data.result == true) {
                        $("#alert").append('<div class="alert-success">' + data.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {
                                location.reload();
                            });
                        }, 500);
                    } else {
                        $("#alert").append('<div class="alert-success_error">' + data.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success_error").fadeOut(1000, function() {});
                        }, 1500);
                    }
                }
            });
        }
        $(arr_id_to_focus[0]).focus();
        return false;
    });
    $("#edit_company").submit(function() {
        var form_oke = true;
        var form_data = new FormData();
        var arr_id_to_focus = [];
        var id_com = $.trim($("#chon_cty_update").val());
        var ten_ca = $.trim($("#ten_ca").val());
        var time_in = $.trim($("#time_in").val());
        var time_out = $.trim($("#time_out").val());
        var id_shift = $.trim($("#id_shift").val());
        var gio_vao_muon = $.trim($("#gio_vao_muon_edit").val());
        var gio_ra_som = $.trim($("#gio_ra_som_edit").val());
        form_data.append("id_shift", id_shift);
        if (id_com == "" || id_com == null) {
            $("#err_name").html("Bạn chưa chọn công ty");
            arr_id_to_focus.push("#ten_ty");
            form_oke = false;
        } else {
            $("#err_name").html("");
            form_data.append("id_com", id_com);
        }
        if (ten_ca == "" || ten_ca == null) {
            $("#err_tenca").html("Bạn chưa nhập ca làm");
            arr_id_to_focus.push("#ten_ca");
            form_oke = false;
        } else {
            $("#err_tenca").html("");
            form_data.append("ten_ca", ten_ca);
        }
        if (time_in == "") {
            $("#err_time").html("Bạn chưa nhập giờ vào làm");
            arr_id_to_focus.push("#time_in");
            form_oke = false;
        } else {
            $("#err_time").html("");
            form_data.append("time_in", time_in);
            if (time_out == "") {
                $("#err_time").html("Bạn chưa nhập giờ tan làm");
                arr_id_to_focus.push("#time_out");
                form_oke = false;
            } else {
                $("#err_time").html("");
                form_data.append("time_out", time_out);
            }
        }


        if (gio_vao_muon == "") {
            $("#err_gio_vao_muon_edit").html("Bạn chưa nhập giờ vào ca muộn nhất");
            arr_id_to_focus.push("#gio_vao_muon_edit");
        } else if (gio_vao_muon < time_in) {
            $("#err_gio_vao_muon_edit").html("Giờ vào ca muộn nhất phải lớn hơn giờ vào ca");
            arr_id_to_focus.push("#gio_vao_muon_edit");
        } else {
            form_oke = true;
            $("#err_gio_vao_muon_edit").html("");
            form_data.append("gio_vao_muon", gio_vao_muon);
        }

        if (gio_ra_som == "") {
            $("#err_gio_ra_som_edit").html("Bạn chưa nhập giờ vào ca muộn nhất");
            arr_id_to_focus.push("#gio_ra_som_edit");
        } else if (gio_ra_som > time_out) {
            $("#err_gio_ra_som_edit").html("Giờ vào ca muộn nhất phải nhỏ hơn giờ vào ca");
            arr_id_to_focus.push("#gio_ra_som_edit");
        } else {
            form_oke = true;
            $("#err_gio_ra_som_edit").html("");
            form_data.append("gio_ra_som", gio_ra_som);
        }

        var cach_thuc_tinh = [];
        $(".cach_thuc_tinh").each(function() {
            if ($(this).is(":checked")) {
                cach_thuc_tinh.push($(this).val());
            }
        });
        if (cach_thuc_tinh[0] == undefined) {
            $("#err_cach_thuc_tinh_edit").html("Bạn chưa chọn cách thức tính công");
            arr_id_to_focus.push("#hourly");
        } else if (cach_thuc_tinh[0] == 2) {
            $("#err_cach_thuc_tinh_edit").html("");
            form_data.append("type", cach_thuc_tinh[0]);
            form_data.append("num_to_calculate", 1);
            form_oke = true;
        } else if (cach_thuc_tinh[0] == 1) {
            $("#err_cach_thuc_tinh_edit").html("");
            var num_to_calculate = $.trim($('#num_to_calculate_edit').val());
            if (num_to_calculate == '') {
                $("#err_num_to_calculate_edit").html("Bạn chưa chọn số công của 1 ca");
                arr_id_to_focus.push("#num_to_calculate_edit");
            } else {
                $("#err_num_to_calculate_edit").html("");
                form_data.append("type", cach_thuc_tinh[0]);
                form_oke = true;
                form_data.append("num_to_calculate", num_to_calculate);
            }
        }
        if (form_oke = true) {
            $.ajax({
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                // enctype: 'multipart/form-data',
                url: '/company/Company_controller/updateShift',
                data: form_data,
                dataType: "JSON",
                async: false,
                success: function(data) {
                    if (data.result == true) {
                        $("#alert").append('<div class="alert-success">' + data.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {});
                        }, 1500);
                        $('#time' + id_shift).html(time_in + '-' + time_out);
                        $('#name' + id_shift).html(ten_ca);
                        $('#sua_cty').modal('hide');
                    } else {
                        $("#alert").append('<div class="alert-success_error">' + data.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success_error").fadeOut(1000, function() {});
                        }, 1500);
                    }
                }
            });
        }
        $(arr_id_to_focus[0]).focus();
        return false;
    });
});

function timkiem() {
    var cong_ty = $('#cong_ty').val();
    if (cong_ty != "") {
        window.location.href = "danh-sach-ca-lam-viec.html?com=" + cong_ty;
    } else {
        window.location.href = "danh-sach-ca-lam-viec.html";
    }
}

function deleteShift(id) {
    if (confirm('Bạn có muốn xóa ca làm việc?')) {
        var form_data = new FormData();
        form_data.append('id', id)
        $.ajax({
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            // enctype: 'multipart/form-data',
            url: '/company/Company_controller/deleteShift',
            data: form_data,
            dataType: "JSON",
            async: false,
            success: function(data) {
                if (data.result == true) {
                    $("#alert").append('<div class="alert-success">' + data.message + '</div>');
                    setTimeout(function() {
                        $(".alert-success").fadeOut(1000, function() {});
                    }, 1500);
                    $('#shift' + id).css('display', 'none');
                } else {
                    $("#alert").append('<div class="alert-success_error">' + data.message + '</div>');
                    setTimeout(function() {
                        $(".alert-success_error").fadeOut(1000, function() {});
                    }, 1500);
                }
            }
        });
    }
}