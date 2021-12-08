$(document).ready(function() {
    $('.d-dropdown').hover(function() {
            $(this).attr('src', '/assets/images/them1.svg');
        },
        function() {
            $(this).attr('src', '/assets/images/them.svg');
        });
    // $('.d-dropdown').After(function(){
    //     $(this).attr('src',base_url+'assets/images/them1.svg');},
    //     function(){
    //     $(this).attr('src',base_url+'assets/images/them.svg');
    // });

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
            $(this).addClass('checked').attr('src', '/assets/images/chon_all.svg');
            $('.tick-chon').addClass('checked').attr('src', '/assets/images/tick_xanh.svg');
            $('.bo-chon').removeClass('checked').attr('src', '/assets/images/k_chon.svg');
        } else {
            $(this).removeClass('checked').attr('src', '/assets/images/tick.svg');
            $('.tick-chon').removeClass('checked').attr('src', '/assets/images/tick.svg');
        }
    });
    $('.tick-chon').click(function() {
        if (!$(this).hasClass("checked")) {
            $(this).addClass('checked').attr('src', '/assets/images/tick_xanh.svg');
            $('.bo-chon').removeClass('checked').attr('src', '/assets/images/k_chon.svg');
        }
    });
    $('.bo-chon').click(function() {
        if (!$(this).hasClass("checked")) {
            $(this).addClass('checked').attr('src', '/assets/images/k_chon1.svg');
            $('.tick-chon').removeClass('checked').attr('src', '/assets/images/tick.svg');
            $(".tick-all").removeClass('checked').attr('src', '/assets/images/tick.svg');
        }
    });
});

function deleteSchedule(id_sch, id_staff) {
    var id = 'schedule' + id_sch + id_staff;
    var data = new FormData();
    data.append('id_sch', id_sch);
    data.append('id_staff', id_staff);
    $.ajax({
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        // enctype: 'multipart/form-data',
        url: '/company/Company_controller/deleteStaffBySchedule',
        data: data,
        dataType: "JSON",
        async: false,
        success: function(data) {
            if (data.result == true) {
                $("#alert").append('<div class="alert-success">' + data.message + '</div>');
                setTimeout(function() {
                    $(".alert-success").fadeOut(1000, function() {
                        $(".alert-success").remove();
                    });
                }, 1500);
                $("#schedule" + id_sch + id_staff).css("display", "none");
                $("#scheduleMb" + id_sch + id_staff).css("display", "none");
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
    var lich_trinh = $('#lich_trinh').val();
    if (date_end == '') {
        date_end = date_start;
    }
    if (date_start == '') {
        date_start = date_end;
    }
    if (name != '' && date_start != '' && date_end != '' && cty != '' && phong_ban != '' && lich_trinh != '') {
        window.location.href = '/quan-ly-lich-trinh.html?keyWord=' + name + '&datestart=' + date_start + '&dateend=' + date_end + '&cty=' + cty + '&phong_ban=' + phong_ban + '&lich_trinh=' + lich_trinh;
    } else if (name == '' && date_start != '' && date_end != '' && cty != '' && phong_ban != '' && lich_trinh != '') {
        window.location.href = '/quan-ly-lich-trinh.html?datestart=' + date_start + '&dateend=' + date_end + '&cty=' + cty + '&phong_ban=' + phong_ban + '&lich_trinh=' + lich_trinh;
    } else if (name != '' && date_start == '' && date_end == '' && cty != '' && phong_ban != '' && lich_trinh != '') {
        window.location.href = '/quan-ly-lich-trinh.html?keyWord=' + name + '&cty=' + cty + '&phong_ban=' + phong_ban + '&lich_trinh=' + lich_trinh;
    } else if (name != '' && date_start != '' && date_end != '' && cty != '' && phong_ban != '' && lich_trinh == '') {
        window.location.href = '/quan-ly-lich-trinh.html?keyWord=' + name + '&datestart=' + date_start + '&dateend=' + date_end + '&cty=' + cty + '&phong_ban=' + phong_ban;
    } else if (name != '' && date_start != '' && date_end != '' && cty == '' && phong_ban == '' && lich_trinh == '') {
        window.location.href = '/quan-ly-lich-trinh.html?keyWord=' + name + '&datestart=' + date_start + '&dateend=' + date_end;
    } else if (name == '' && date_start != '' && date_end != '' && cty == '' && phong_ban == '' && lich_trinh == '') {
        window.location.href = '/quan-ly-lich-trinh.html?datestart=' + date_start + '&dateend=' + date_end;
    } else if (name == '' && date_start == '' && date_end == '' && cty != '' && phong_ban != '' && lich_trinh == '') {
        window.location.href = '/quan-ly-lich-trinh.html?cty=' + cty + '&phong_ban=' + phong_ban;
    } else if (name == '' && date_start == '' && date_end == '' && cty != '' && phong_ban == '' && lich_trinh == '') {
        window.location.href = '/quan-ly-lich-trinh.html?cty=' + cty;
    } else if (name == '' && date_start == '' && date_end == '' && cty != '' && phong_ban != '' && lich_trinh != '') {
        window.location.href = '/quan-ly-lich-trinh.html?cty=' + cty + '&phong_ban=' + phong_ban + '&lich_trinh=' + lich_trinh;
    } else if (name != '' && date_end == '' && date_start == '' && cty == '' && phong_ban == '' && lich_trinh == '') {
        window.location.href = '/quan-ly-lich-trinh.html?keyWord=' + name;
    } else if (name == '' && date_end != '' && date_start != '' && cty != '' && phong_ban != '' && lich_trinh == '') {
        window.location.href = '/quan-ly-lich-trinh.html?datestart=' + date_start + '&dateend=' + date_end + '&cty=' + cty + '&phong_ban=' + phong_ban;
    } else if (name != '' && date_end == '' && date_start == '' && cty != '' && phong_ban != '' && lich_trinh == '') {
        window.location.href = '/quan-ly-lich-trinh.html?keyWord=' + name + '&cty=' + cty + '&phong_ban=' + phong_ban;
    } else if (name == '' && date_end == '' && date_start == '' && cty == '' && phong_ban == '' && lich_trinh != '') {
        window.location.href = '/quan-ly-lich-trinh.html?lich_trinh=' + lich_trinh;
    } else {
        window.location.href = '/quan-ly-lich-trinh.html';
    }
}

function showdepartment() {
    var id_com = $("#cty").val();
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
                for (let i = 0; i < data.list.length; i++) {
                    $("#phong_ban").append('<option value="' + data.list[i].dep_id + '">' + data.list[i].dep_name + '</option>');
                }
            } else {
                return false;
            }
        }
    });
}

function export_excel_schedule() {
    var name = $('#search').val();
    var date_start = $('#date_start').val();
    var date_end = $('#date_end').val();
    var cty = $('#cty').val();
    var phong_ban = $('#phong_ban').val();
    var lich_trinh = $('#lich_trinh').val();
    if (date_end == '') {
        date_end = date_start;
    }
    if (date_start == '') {
        date_start = date_end;
    }
    window.location.href = '/xuat-excel-lich-trinh.html?keyWord=' + name + '&datestart=' + date_start + '&dateend=' + date_end + '&cty=' + cty + '&phong_ban=' + phong_ban + '&lich_trinh=' + lich_trinh;
}