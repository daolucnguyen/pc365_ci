$(document).ready(function() {
    $('#phong_ban').select2({
        placeholder: 'Phòng ban nơi nhân viên đang làm',
        width: "100%"
    });
    $('#phong_ban1').select2({
        placeholder: 'Chọn phòng ban',
        width: "100%"
    });
    $('#chi_nhanh').select2({
        placeholder: 'Chọn công ty',
        width: "100%"
    });
    $('#chi_nhanh1').select2({
        placeholder: 'Chọn chi nhánh',
        width: "100%"
    });
    $('#search').select2({
        placeholder: 'Chọn nhân viên',
        width: "100%"
    });
});

function showdepartment() {
    var id_com = $('#chi_nhanh').val();
    var data = new FormData();

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
            if (data.result == true) {
                $("#phong_ban").html('');
                $("#phong_ban").append('<option value="0">Chọn phòng ban nhân viên</option>');
                for (let i = 0; i < data.list.length; i++) {
                    $("#phong_ban").append('<option value="' + data.list[i].dep_id + '">' + data.list[i].dep_name + '</option>');
                }
            } else {
                return false;
            }
        }
    });
}

function timkiem() {
    var name = $('#search').val();
    var date_start = $('#date_start').val();
    var date_end = $('#date_end').val();
    var cty = $('#chi_nhanh').val();
    var phong_ban = $('#phong_ban').val();

    if ($('#date_start_modal').val() != '') {
        date_start = $('#date_start_modal').val();
    }

    if ($('#date_end_modal').val() != '') {
        date_start = $('#date_end_modal').val();
    }

    if (date_end == '') {
        date_end = date_start;
    }
    if (date_start == '') {
        date_start = date_end;
    }

    if ($('#chi_nhanh1').val() != '') {
        cty = $('#chi_nhanh1').val();
    }

    if ($('#phong_ban1').val() != '') {
        phong_ban = $('#phong_ban1').val();
    }

    if (name != '' && date_start != '' && date_end != '' && cty != '' && phong_ban != '') {
        window.location.href = '/quan-ly-cham-cong.html?keyWord=' + name + '&datestart=' + date_start + '&dateend=' + date_end + '&cty=' + cty + '&phong_ban=' + phong_ban;
    } else if (name == '' && date_start != '' && date_end != '' && cty != '' && phong_ban != '') {
        window.location.href = '/quan-ly-cham-cong.html?datestart=' + date_start + '&dateend=' + date_end + '&cty=' + cty + '&phong_ban=' + phong_ban;
    } else if (name != '' && date_start != '' && date_end != '' && cty != '' && phong_ban == '') {
        window.location.href = '/quan-ly-cham-cong.html?keyWord=' + name + '&datestart=' + date_start + '&dateend=' + date_end + '&cty=' + cty;
    } else if (name != '' && date_start == '' && date_end == '' && cty != '' && phong_ban != '') {
        window.location.href = '/quan-ly-cham-cong.html?keyWord=' + name + '&cty=' + cty + '&phong_ban=' + phong_ban;
    } else if (name != '' && date_start == '' && date_end == '' && cty != '' && phong_ban == '') {
        window.location.href = '/quan-ly-cham-cong.html?keyWord=' + name + '&cty=' + cty;
    } else if (name != '' && date_start != '' && date_end != '' && cty == '' && phong_ban == '') {
        window.location.href = '/quan-ly-cham-cong.html?keyWord=' + name + '&datestart=' + date_start + '&dateend=' + date_end;
    } else if (name == '' && date_start != '' && date_end != '' && cty == '' && phong_ban == '') {
        window.location.href = '/quan-ly-cham-cong.html?datestart=' + date_start + '&dateend=' + date_end;
    } else if (name == '' && date_start == '' && date_end == '' && cty != '' && phong_ban != '') {
        window.location.href = '/quan-ly-cham-cong.html?cty=' + cty + '&phong_ban=' + phong_ban;
    } else if (name == '' && date_start == '' && date_end == '' && cty != '' && phong_ban == '') {
        window.location.href = '/quan-ly-cham-cong.html?cty=' + cty;
    } else if (name != '' && date_end == '' && date_start == '' && cty == '' && phong_ban == '') {
        window.location.href = '/quan-ly-cham-cong.html?keyWord=' + name;
    } else if (name == '' && date_end != '' && date_start != '' && cty != '' && phong_ban == '') {
        window.location.href = '/quan-ly-cham-cong.html?datestart=' + date_start + '&dateend=' + date_end + '&cty=' + cty;
    } else if (name != '' && date_end == '' && date_start == '' && cty != '' && phong_ban != '') {
        window.location.href = '/quan-ly-cham-cong.html?keyWord=' + name + '&cty=' + cty + '&phong_ban=' + phong_ban;
    } else {
        window.location.href = '/quan-ly-cham-cong.html';
    }
}