$(document).ready(function() {
    $(".d-phan-quyen1").select2({
        width: "100%",
    });
    $(".d-phan-quyen12").select2({
        width: "100%",
    });
    $("#phan_quyen1").select2({
        width: "100%",
        placeholder: "Cấp quyền truy cập",
    });
    $("#chi_nhanh").select2({
        width: "100%",
        placeholder: "Chọn chi nhánh",
    });
    $("#phong_ban").select2({
        width: "100%",
        placeholder: "Chọn phòng ban",
    });
    $("#loc_quyen").select2({
        width: "100%",
        placeholder: "Chọn quyền truy cập",
    });
    $("#chii_nhanh").select2({
        width: "100%",
        placeholder: "Chọn chi nhánh",
    });
    $("#phongg_ban").select2({
        width: "100%",
        placeholder: "Chọn phòng ban",
    });
    $("#locc_quyen").select2({
        width: "100%",
        placeholder: "Chọn quyền truy cập",
    });
});

function updateRole(id_staff, type) {
    if (type == 1) {
        var id_role = $("#role1" + id_staff).val();
    }
    if (type == 2) {
        var id_role = $("#role" + id_staff).val();
    }
    var data = new FormData();
    data.append('staff_id', id_staff);
    data.append('id_role', id_role);
    $.ajax({
        type: 'post',
        url: "/company/Company_controller/updateRoleStaff",
        async: false,
        dataType: "JSON",
        contentType: false,
        processData: false,
        data: data,
        success: function(response) {
            console.log(response);
            if (response.result == 2) {
                $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                setTimeout(function() {
                    $(".alert-success").fadeOut(1000, function() {});
                }, 1500);
            } else {
                return false;
            }
        },

    });
}

function showdepartment(type) {
    var id = 0;
    if (type == 1) {
        id = $("#chii_nhanh").val();
    }
    if (type == 2) {
        id = $("#chi_nhanh").val();
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
                for (let i = 0; i < data.list.length; i++) {
                    if (type == 1) {
                        $("#phongg_ban").append('<option value="' + data.list[i].dep_id + '">' + data.list[i].dep_name + '</option>');
                    }
                    if (type == 2) {
                        $("#phong_ban").append('<option value="' + data.list[i].dep_id + '">' + data.list[i].dep_name + '</option>');
                    }
                }
            } else {
                return false;
            }
        }
    });
}

function timkiem() {
    var name = $('#keyWord').val();
    var chii_nhanh = $('#chii_nhanh').val();
    var phongg_ban = $('#phongg_ban').val();
    var locc_quyen = $('#locc_quyen').val();
    var chi_nhanh = '';
    var phong_ban = '';
    var quyen = '';
    if ($('#chi_nhanh').val() == '') {
        chi_nhanh = chii_nhanh;
    } else {
        chi_nhanh = $('#chi_nhanh').val();
    }
    if ($('#phong_ban').val() == '') {
        phong_ban = phongg_ban;
    } else {
        phong_ban = $('#phong_ban').val();
    }
    if ($('#loc_quyen').val() == '') {
        quyen = locc_quyen;
    } else {
        quyen = $('#loc_quyen').val();
    }
    console.log(quyen);
    if (name != '' && chi_nhanh != '' && phong_ban != '' && quyen != '') {
        window.location.href = '/quan-ly-quyen-truy-cap.html?keyWord=' + name + '&cn=' + chi_nhanh + '&pb=' + phong_ban + '&q=' + quyen;
    } else if (name != '' && chi_nhanh != '' && phong_ban != '' && quyen == '') {
        window.location.href = '/quan-ly-quyen-truy-cap.html?keyWord=' + name + '&cn=' + chi_nhanh + '&pb=' + phong_ban;
    } else if (name != '' && chi_nhanh != '' && phong_ban == '' && quyen != '') {
        window.location.href = '/quan-ly-quyen-truy-cap.html?keyWord=' + name + '&cn=' + chi_nhanh + '&q=' + quyen;
    } else if (name == '' && chi_nhanh != '' && phong_ban != '' && quyen != '') {
        window.location.href = '/quan-ly-quyen-truy-cap.html?cn=' + chi_nhanh + '&pb=' + phong_ban + '&q=' + quyen;
    } else if (name != '' && chi_nhanh != '' && phong_ban == '' && quyen == '') {
        window.location.href = '/quan-ly-quyen-truy-cap.html?keyWord=' + name + '&cn=' + chi_nhanh;
    } else if (name != '' && chi_nhanh == '' && phong_ban == '' && quyen != '') {
        window.location.href = '/quan-ly-quyen-truy-cap.html?keyWord=' + name + '&q=' + quyen;
    } else if (name == '' && chi_nhanh != '' && phong_ban != '' && quyen == '') {
        window.location.href = '/quan-ly-quyen-truy-cap.html?cn=' + chi_nhanh + '&pb=' + phong_ban;
    } else if (name != '' && chi_nhanh == '' && phong_ban == '' && quyen == '') {
        window.location.href = '/quan-ly-quyen-truy-cap.html?keyWord=' + name;
    } else if (name == '' && chi_nhanh != '' && phong_ban == '' && quyen == '') {
        window.location.href = '/quan-ly-quyen-truy-cap.html?cn=' + chi_nhanh;
    } else if (name == '' && chi_nhanh == '' && phong_ban == '' && quyen != '') {
        window.location.href = '/quan-ly-quyen-truy-cap.html?q=' + quyen;
    } else {
        window.location.href = '/quan-ly-quyen-truy-cap.html';
    }
}