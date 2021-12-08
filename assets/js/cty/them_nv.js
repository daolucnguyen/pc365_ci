function show_staff(a) {
    var data = new FormData();
    var arr_staff = [];
    $(".item_ca").each(function() {
        if ($(this).is(":checked")) {
            arr_staff.push($(this).val());
        }
    });
    var id_calendar = $('#id_calendar').val();
    data.append('id', arr_staff);
    data.append('id_calendar', id_calendar);
    $.ajax({
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        // enctype: 'multipart/form-data',
        url: '/company/Company_controller/show_staff_by_department_calendar',
        data: data,
        dataType: "JSON",
        async: false,
        success: function(data) {
            if (data.result == true) {
                $('#scroll').html('');
                for (let i = 0; i < data.list.length; i++) {
                    for (let index = 0; index < data.list[i].length; index++) {
                        // if (data.list[index].staff_id == data.staff[i].staff_id) {
                        var html = '<div class="col-md-6 col-sm-6 col-xs-12 d-tao-lich-v3a1 remobe_staff">' +
                            '<div class="d-tao-lich-v3-img">' +
                            '<img src="' + data.list[i][index].avatar + '" onerror=' + 'this.onerror=null;this.src="/images_staff/avatar_default.png";' + 'alt="ten_nv" class="nv-tao-lich-img">' +
                            '</div>' +
                            '<label for="st' + data.list[i][index].staff_id + '">' +
                            '<div class="d-ten-nv">' +
                            '<p class="d-cham-cong-p">(' + data.list[i][index].staff_id + ') ' + data.list[i][index].name_staff + '</p>' +
                            '<p class="d-cham-cong-p1">Nhân viên ' + data.list[i][index].name_department + '</p>' +
                            '</div>' +
                            '</label>' +
                            '<div class="d-input-nv">' +
                            '<input type="checkbox" name="staff[]" class="item_cty d-tao-lich2" id="st' + data.list[i][index].staff_id + '" data-name="1" value="' + data.list[i][index].staff_id + '">' +
                            '</div>' +
                            '</div>';
                        $('#scroll').append(html);
                    }
                }
            } else {
                return false;
            }
        }
    });
}
$(document).ready(function() {
    $("#cham_cong").select2({
        width: "100%",
        placeholder: "Cấp quyền truy cập",
    });
    $(".item_nv").on('click', function() {
        if (!$(this).hasClass('active')) {
            $(this).addClass('active').attr('data-nv', 1);
        } else {
            $(this).removeClass('active').attr('data-nv', 0);
        }
    });
    $("#them_nv").submit(function() {
        var form_oke = false;
        var form_data = new FormData();
        var arr_id_to_focus = [];
        var arr_staff = [];
        var id_calendar = $('#id_calendar').val();
        $(".item_cty").each(function() {
            if ($(this).is(":checked")) {
                arr_staff.push($(this).val());
            }
        });
        var cty = [];
        $(".item_ca").each(function() {
            if ($(this).is(":checked")) {
                cty.push($(this).val());
            }
        });

        if (cty.length == 0) {
            $("#err_phongban").html("Bạn chưa chọn phòng ban");
            $("#err_phongban").focus();
            return false;
        } else {
            $("#err_phongban").html("");
            form_oke = true;
        }

        if (arr_staff.length == 0) {
            $('#err_choose_nv').html('Vui lòng chọn nhân viên');
            $('#err_choose_nv').focus();
            return false;
        } else {
            $('#err_choose_nv').html('');
            form_oke = true;
        }

        if (form_oke == true) {
            form_data.append('id_calendar', id_calendar);
            form_data.append('arr_staff', arr_staff);
            $.ajax({
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                // enctype: 'multipart/form-data',
                url: '/company/Company_controller/addStaffToCalendar',
                data: form_data,
                dataType: "JSON",
                async: false,
                success: function(data) {
                    if (data.result == true) {
                        $("#alert").append('<div class="alert-success">' + data.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {
                                $(".alert-success").remove();
                                window.location.href = "/danh-sach-nhan-vien-co-lich.html?id_calendar=" + id_calendar;
                            });
                        }, 1500);
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