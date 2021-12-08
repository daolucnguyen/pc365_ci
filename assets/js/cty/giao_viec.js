$(document).mouseup(function(e) {
    var container = $(".l_action");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.hide(100);
    }
});
$(".l_click").click(function() {
    $(this).next(".l_action").show(250);
});
$(document).ready(function() {
    $('.d-dropdown').hover(function() {
            $(this).attr('src', '/assets/images/them1.svg');
        },
        function() {
            $(this).attr('src', '/assets/images/them.svg');
        });
    $('#cty').select2({
        placeholder: 'Chọn công ty',
        width: "100%"
    });
    $('#phong_ban').select2({
        placeholder: 'Chọn phòng ban',
        width: "100%"
    });
    $('#lich_trinh').select2({
        placeholder: 'Chọn lịch trinh',
        width: "100%"
    });
    $('#trang_thai').select2({
        placeholder: 'Trạng thái công việc',
        width: "100%",
    });
});

function showdepartment() {
    var id_com = $("#cty").val();
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
    var cty = $('#cty').val();
    var phong_ban = $('#phong_ban').val();
    var trang_thai = $('#trang_thai').val();
    if (date_end == '') {
        date_end = date_start;
    }
    if (date_start == '') {
        date_start = date_end;
    }
    if (name != '' && date_start != '' && date_end != '' && cty != '' && phong_ban != '' && trang_thai != '') {
        window.location.href = '/giao-viec.html?keyWord=' + name + '&datestart=' + date_start + '&dateend=' + date_end + '&cty=' + cty + '&phong_ban=' + phong_ban + '&status=' + trang_thai;

    } else if (name == '' && date_start != '' && date_end != '' && cty != '' && phong_ban != '' && trang_thai != '') {
        window.location.href = '/giao-viec.html?datestart=' + date_start + '&dateend=' + date_end + '&cty=' + cty + '&phong_ban=' + phong_ban + '&status=' + trang_thai;

    } else if (name != '' && date_start != '' && date_end != '' && cty != '' && phong_ban == '' && trang_thai != '') {
        window.location.href = '/giao-viec.html?keyWord=' + name + '&datestart=' + date_start + '&dateend=' + date_end + '&cty=' + cty + '&status=' + trang_thai;

    } else if (name != '' && date_start == '' && date_end == '' && cty != '' && phong_ban != '' && trang_thai != '') {
        window.location.href = '/giao-viec.html?keyWord=' + name + '&cty=' + cty + '&phong_ban=' + phong_ban + '&status=' + trang_thai;
    } else if (name != '' && date_start == '' && date_end == '' && cty != '' && phong_ban == '' && trang_thai != '') {
        window.location.href = '/giao-viec.html?keyWord=' + name + '&cty=' + cty + '&status=' + trang_thai;

    } else if (name != '' && date_start != '' && date_end != '' && cty == '' && phong_ban == '' && trang_thai != '') {
        window.location.href = '/giao-viec.html?keyWord=' + name + '&datestart=' + date_start + '&dateend=' + date_end + '&status=' + trang_thai;

    } else if (name == '' && date_start != '' && date_end != '' && cty == '' && phong_ban == '' && trang_thai != '') {
        window.location.href = '/giao-viec.html?datestart=' + date_start + '&dateend=' + date_end + '&status=' + trang_thai;

    } else if (name == '' && date_start == '' && date_end == '' && cty != '' && phong_ban != '' && trang_thai != '') {
        window.location.href = '/giao-viec.html?cty=' + cty + '&phong_ban=' + phong_ban + '&status=' + trang_thai;

    } else if (name != '' && date_end == '' && date_start == '' && cty == '' && phong_ban == '' && trang_thai != '') {
        window.location.href = '/giao-viec.html?keyWord=' + name + '&status=' + trang_thai;
    } else if (name == '' && date_end == '' && date_start == '' && cty != '' && phong_ban == '' && trang_thai != '') {
        window.location.href = '/giao-viec.html?cty=' + cty + '&status=' + trang_thai;
    } else if (name == '' && date_end == '' && date_start == '' && cty == '' && phong_ban == '' && trang_thai == '') {
        window.location.href = '/giao-viec.html?status=' + trang_thai;
    } else if (name == '' && date_start != '' && date_end != '' && cty != '' && phong_ban != '' && trang_thai == '') {
        window.location.href = '/giao-viec.html?datestart=' + date_start + '&dateend=' + date_end + '&cty=' + cty + '&phong_ban=' + phong_ban;

    } else if (name != '' && date_start != '' && date_end != '' && cty != '' && phong_ban == '' && trang_thai == '') {
        window.location.href = '/giao-viec.html?keyWord=' + name + '&datestart=' + date_start + '&dateend=' + date_end + '&cty=' + cty;

    } else if (name != '' && date_start == '' && date_end == '' && cty != '' && phong_ban != '' && trang_thai == '') {
        window.location.href = '/giao-viec.html?keyWord=' + name + '&cty=' + cty + '&phong_ban=' + phong_ban;
    } else if (name != '' && date_start == '' && date_end == '' && cty != '' && phong_ban == '' && trang_thai == '') {
        window.location.href = '/giao-viec.html?keyWord=' + name + '&cty=' + cty;

    } else if (name != '' && date_start != '' && date_end != '' && cty == '' && phong_ban == '' && trang_thai == '') {
        window.location.href = '/giao-viec.html?keyWord=' + name + '&datestart=' + date_start + '&dateend=' + date_end;

    } else if (name == '' && date_start != '' && date_end != '' && cty == '' && phong_ban == '' && trang_thai == '') {
        window.location.href = '/giao-viec.html?datestart=' + date_start + '&dateend=' + date_end;

    } else if (name == '' && date_start == '' && date_end == '' && cty != '' && phong_ban != '' && trang_thai == '') {
        window.location.href = '/giao-viec.html?cty=' + cty + '&phong_ban=' + phong_ban;

    } else if (name != '' && date_end == '' && date_start == '' && cty == '' && phong_ban == '' && trang_thai == '') {
        window.location.href = '/giao-viec.html?keyWord=' + name;
    } else if (name == '' && date_end == '' && date_start == '' && cty != '' && phong_ban == '' && trang_thai == '') {
        window.location.href = '/giao-viec.html?cty=' + cty;
    } else if (name == '' && date_end == '' && date_start == '' && cty == '' && phong_ban == '' && trang_thai != '') {
        window.location.href = '/giao-viec.html?status=' + trang_thai;
    } else {
        window.location.href = '/giao-viec.html';
    }
}