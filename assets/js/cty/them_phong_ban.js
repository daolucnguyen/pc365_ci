$(document).ready(function() {
    // Thêm phòng ban
    $('#cong_ty').select2({
        placeholder: "Chọn công ty",
        width: "100%",
    }).on('change', function() {
        $.ajax({
            type: "POST",
            url: '/company/Company_controller/list_department',
            dataType: "json",
            data: {
                com_id: $("#cong_ty").val()
            },
            success: function(response) {
                if (response.status == 1) {
                    $('.d-ds-cty-con2a .row').html(response.info);

                } else {
                    return false;
                }
            }
        });
    });
    // click sửa phòng ban
    $('.update_department').click(function() {
        var id_department = $(this).attr("id");
        var name_department = $(this).attr("name");
        $('#phong_bann').val(name_department);
        $("#truy_cap3").select2({
            width: "100%"
        }).val(id_department).trigger("change");
        $.ajax({
            type: "POST",
            url: '/company/Company_controller/list_department',
            dataType: "json",
            data: {
                id_department: id_department
            },
        });
        $("#edit_company").submit(function(event) {
            event.preventDefault();
            var form_oke = true;
            // var ten_cty = $.trim($('#cong_ty_2').val());
            var phong_ban = $.trim($('#phong_bann').val());
            var form_data = new FormData();
            var arr_id_to_focus = [];

            // if (ten_cty == "") {
            //     $("#err_namee").html("Tên công ty không được để trống");
            //     arr_id_to_focus.push("#ten_ctyy");
            //     form_oke = false;
            // } else {
            //     $("#err_namee").html("");
            //     form_data.append('ten_cty', ten_cty);
            // }
            if (phong_ban == "") {
                $("#err_phongbann").html("Phòng ban không được để trống");
                arr_id_to_focus.push("#phong_bann");
                form_oke = false;
            } else {
                $("#err_phongbann").html("");
                form_data.append("phong_ban", phong_ban);
            }
            if (form_oke == true) {
                $.ajax({
                    type: "POST",
                    url: '/company/Company_controller/update_department',
                    dataType: "json",
                    data: {
                        // com_id: $("#cong_ty_2").val(),
                        name_department: phong_ban,
                        id_department: id_department
                    },
                    success: function(data) {
                        if (data.result == 2) {
                            $("#alert").append('<div class="alert-success">' + data.message + '</div>');
                            setTimeout(function() {
                                $(".alert-success").fadeOut(1000, function() {});
                            }, 1500);
                            $("#name_department" + id_department).html(phong_ban);
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
    // submit sửa

    $('#cong_ty_2').select2({
        placeholder: "Chọn công ty",
        // multiple: true,
        width: "100%",
    });

    // xóa phòng ban
    $('.delete_department').click(function() {
        if (confirm('Bạn có chắc muốn xóa phòng ban này ?')) {
            var id_department = $(this).attr("name");
            $('div[name=' + id_department + ']').remove();
            if (id_department != '') {
                $.ajax({
                    type: "POST",
                    url: '/company/Company_controller/delete_department',
                    dataType: "json",
                    data: {
                        id_department: id_department
                    },
                    success: function(data) {
                        if (data.result == 2) {
                            $("#alert").append('<div class="alert-success">' + data.message + '</div>');
                            setTimeout(function() {
                                $(".alert-success").fadeOut(1000, function() {});
                            }, 1500);
                            $("#dep" + id_department).html("");
                            // $('#sua_cty').modal('hide');
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
    });



    $('.d-them-cty-reset').click(function() {
        $('#cong_ty_2').val(null).trigger('change');
        $("#err_phongbann").html("");
    });
    $('#chon_cty').select2({
        // dropdownAutoWidth: true,
        // multiple: true,
        width: '100%',
        // height: '50px',
        placeholder: "Chọn công ty",
        // allowClear: true,
    });
    $("#ten_cty").change(function() {
        if ($(this) == '' || $(this) == null) {
            $("#err_name").html("Tên công ty không được để trống");
            return false
        } else {
            $("#err_name").html("");
        }
    });
    $("#phong_ban").change(function() {
        if ($(this) == '' || $(this) == null) {
            $("#err_phongban").html("Phòng ban không được để trống");
            return false
        } else {
            $("#err_phongban").html("");
        }
    });
    $("#ten_ctyy").change(function() {
        if ($(this) == '' || $(this) == null) {
            $("#err_namee").html("Tên công ty không được để trống");
            return false
        } else {
            $("#err_namee").html("");
        }
    });
    $("#phong_bann").change(function() {
        if ($(this) == '' || $(this) == null) {
            $("#err_phongbann").html("Phòng ban không được để trống");
            return false
        } else {
            $("#err_phongbann").html("");
        }
    });

    $("#add_department").submit(function(event) {
        event.preventDefault();
        var form_oke = true;
        var ten_cty = $('#chon_cty').val();
        var phong_ban = $.trim($('#phong_ban').val());
        var form_data = new FormData();
        var arr_id_to_focus = [];
        if (phong_ban == "" || phong_ban == null) {
            $("#err_phongban").html("Phòng ban không được để trống");
            arr_id_to_focus.push("#phong_ban");
            form_oke = false;
        } else {
            $("#err_phongban").html("");
            form_data.append("phong_ban", phong_ban);
        }
        if (form_oke == true) {
            $.ajax({
                type: "POST",
                url: '/company/Company_controller/create_department',
                dataType: "json",
                data: {
                    name_department: phong_ban
                },
                success: function(data) {
                    if (data.result == 2) {
                        $("#alert").append('<div class="alert-success">' + data.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {
                                location.reload();
                            });
                        }, 1500);
                    } else if (data.result == 3) {
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
    var name = $('#keyWord').val();
    var congty = $('#cong_ty').val();
    if (name != '' && congty != "") {
        window.location.href = '/danh-sach-phong-ban.html/?keyWord=' + name + '&congty=' + congty;
    } else if (name != '' && congty == '') {
        window.location.href = '/danh-sach-phong-ban.html/?keyWord=' + name;
    } else if (name == '' && congty != '') {
        window.location.href = '/danh-sach-phong-ban.html/?congty=' + congty;
    } else {
        window.location.href = '/danh-sach-phong-ban.html';
    }
}