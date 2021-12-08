function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

function deletes(e) {
    dom_parent = $(e).parent().remove();
}

function show_depament(id, id_small) {
    $('#scroll').html("");
    var data = new FormData();
    data.append('id', id);
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
                var html = ''
                $('.l_remove_department').remove();
                var a = '';
                if (data.list.length > 0) {
                    for (let index = 0; index < data.list.length; index++) {
                        $('#append_department').append('<div class="col-md-4 col-sm-4 col-xs-12 d-input-radio-v1a l_remove_department ">' +
                            '<input type="checkbox" class="item_ca d-tao-lich2  l_curson" onchange = "show_staff(' + data.list[index].dep_id + ')" id ="' + data.list[index].dep_id + '" value="' + data.list[index].dep_id + '" name="department">' +
                            '<label for="' + data.list[index].dep_id + '" class="d-tao-lich2-v1 l_curson">' + data.list[index].dep_name + '</label>' +
                            '</div>');
                    }
                } else {
                    $('#append_department').append('<div class="col-md-4 col-sm-4 col-xs-12 d-input-radio-v1a l_remove_department">Thêm phòng ban<a class="l_margin_link" href="https://chamcong.timviec365.vn/quan-ly-cong-ty/phong-ban.html"> Tại đây</a></div>');
                }
                if (data.list.length > 0) {
                    for (let i = 0; i < data.show_staff.length; i++) {
                        var name_dep = 'chưa xác định';
                        if (data.show_staff[i].dep_name != null) {
                            name_dep = data.show_staff[i].dep_name;
                        }
                        var html = '<div class="col-md-6 col-sm-6 col-xs-12 d-tao-lich-v3a1 remobe_staff">' +
                            '<div class="d-tao-lich-v3-img">' +
                            '<img src="' + data.show_staff[i].ep_image + '" onerror=' + 'this.onerror=null;this.src="/images_staff/avatar_default.png";' + 'alt="ten_nv" class="nv-tao-lich-img">' +
                            '</div>' +
                            '<label for="st' + data.show_staff[i].ep_id + '">' +
                            '<div class="d-ten-nv">' +
                            '<p class="d-cham-cong-p">(' + data.show_staff[i].ep_id + ') ' + data.show_staff[i].ep_name + '</p>' +
                            '<p class="d-cham-cong-p1">Nhân viên ' + name_dep + '</p>' +
                            '</div>' +
                            '</label>' +
                            '<div class="d-input-nv">' +
                            '<input type="checkbox" name="staff[]" class="item_cty d-tao-lich2 l_curson" id="st' + data.show_staff[i].ep_id + '" data-name="1" value="' + data.show_staff[i].ep_id + '">' +
                            '</div>' +
                            '</div>';
                        $('#scroll').append(html);
                    }
                } else {
                    $('#scroll').append('<div class="col-md-4 col-sm-4 col-xs-12 d-input-radio-v1a remobe_staff">Thêm nhân viên<a class="l_margin_link" href="https://chamcong.timviec365.vn/quan-ly-cong-ty/nhan-vien.html"> Tại đây</a></div>');
                }
            } else {
                return false;
            }
        }
    });
}

function show_staff(a) {
    var data = new FormData();
    var arr_staff = [];
    $(".item_ca").each(function() {
        if ($(this).is(":checked")) {
            arr_staff.push($(this).val());
        }
    });
    data.append('id', arr_staff);
    $.ajax({
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        // enctype: 'multipart/form-data',
        url: '/company/Company_controller/show_staff_by_department',
        data: data,
        dataType: "JSON",
        async: false,
        success: function(data) {
            if (data.result == true) {
                // var html = ''
                $('.remobe_staff').remove();
                var dem = 0;
                for (let index = 0; index < data.list.length; index++) {
                    var html = '<div class="col-md-6 col-sm-6 col-xs-12 d-tao-lich-v3a1 remobe_staff">' +
                        '<div class="d-tao-lich-v3-img">' +
                        '<img src="' + data.list[index].ep_image + '" onerror=' + 'this.onerror=null;this.src="/images_staff/avatar_default.png";' + 'alt="ten_nv" class="nv-tao-lich-img">' +
                        '</div>' +
                        '<label for="st' + data.list[index].ep_id + '">' +
                        '<div class="d-ten-nv">' +
                        '<p class="d-cham-cong-p">(' + data.list[index].ep_id + ') ' + data.list[index].ep_name + '</p>' +
                        '<p class="d-cham-cong-p1">Nhân viên ' + data.list[index].dep_name + '</p>' +
                        '</div>' +
                        '</label>' +
                        '<div class="d-input-nv">' +
                        '<input type="checkbox" name="staff[]" class="item_cty d-tao-lich2" id="st' + data.list[index].ep_id + '" data-name="1" value="' + data.list[index].ep_id + '">' +
                        '</div>' +
                        '</div>';
                    $('#scroll').append(html);

                    if (data.list.length == 0) {
                        dem++;
                    }
                }
                if (dem == data.list.length) {
                    $('#scroll').append('<div class="col-md-4 col-sm-4 col-xs-12 d-input-radio-v1a remobe_staff">Thêm nhân viên<a class="l_margin_link" href="/quan-ly-nhan-vien-cong-ty.html/1"> Tại đây</a></div>');
                }
            } else {
                return false;
            }
        }
    });
}

$(document).ready(function() {
    $('.d-dropdown').hover(function() {
            $(this).attr('src', "`+base_url+`/assets/images/them1.svg");
        },
        function() {
            $(this).attr('src', '`+base_url+`/assets/images/them.svg');
        });

    var check_num = $('.d-dichuyen-input');
    var diemdung = check_num.length;
    $('#them_diem_dung').click(function() {
        $('.l_remove').css('display', 'block');

        html = `
        <div class="d-dichuyen2">
            <p class="d-dichuyen-p"><img src="/assets/images/dot_blue.svg" alt="dot" class="d-dichuyen-img "> <span class="d-dichuyen-sp">Đến điểm dừng:</span></p>
            <input type="text" name="diemden[]" class="d-dichuyen-input" placeholder="Nhập điểm dừng">
            <img src="/assets/images/Delete.svg" alt="xóa" class="d-delete-img l_remove" onClick="deletes(this)">
        </div>`;
        $(".d-them-diem-dung").before(html);
        diemdung++;
    });

    $(".item_ca").on('click', function() {
        if (!$(this).hasClass('active')) {
            $(this).addClass('active').attr('data-chon', 1);
        } else {
            $(this).removeClass('active').attr('data-chon', 0);
        }
    });
    $(".item_cty").on('click', function() {
        if (!$(this).hasClass('active')) {
            $(this).addClass('active').attr('data-nv', 1);
        } else {
            $(this).removeClass('active').attr('data-nv', 0);
        }
    });
    $("#them_lich").submit(function(event) {
        event.preventDefault();
        var form_oke = true;
        var arr_id_to_focus = [];

        var tao_lich = $.trim($("#tao_lich").val());
        var arr_staff = [];

        $(".item_cty").each(function() {
            if ($(this).is(":checked")) {
                arr_staff.push($(this).val());
            }
        });
        var date_start = $.trim($("#date_start").val());
        var date_end = $.trim($("#date_end").val());
        var ghi_chu = $.trim($("#ghi_chu").val());
        var input_place = $('.d-dichuyen-input');
        var place = '';
        for (var i = 0; i < input_place.length; i++) {    
            if (input_place[i].value != '') {
                place += input_place[i].value + ';';
            }
        }
        var form_data = new FormData();
        if (tao_lich == "") {
            $("#err_lich").html("Bạn chưa nhập tên lịch trình");
            arr_id_to_focus.push("#tao_lich");
            form_oke = false;
        } else {
            $("#err_lich").html("");
            form_data.append('tao_lich', tao_lich);
        }

        var cty = [];
        $(".d-tao-lich2").each(function() {
            if ($(this).is(":checked")) {
                cty.push($(this).val());
            }
        });

        if (cty.length == 0) {
            $("#err_choose_cty").html("Bạn chưa chọn công ty");
            arr_id_to_focus.push('#err_choose_cty');
            form_oke = false;
        } else {
            $("#err_choose_cty").html("");
        }


        var cty = [];
        $(".item_ca").each(function() {
            if ($(this).is(":checked")) {
                cty.push($(this).val());
            }
        });

        // if (cty.length == 0) {
        //     $("#err_phongban").html("Bạn chưa chọn phòng ban");
        //     arr_id_to_focus.push('#err_phongban');
        //     form_oke = false;
        // } else {
        //     $("#err_phongban").html("");
        // }

        if (arr_staff.length == 0) {
            $('#err_choose_nv').html('Bạn chưa chọn nhân viên');
            arr_id_to_focus.push('#err_choose_nv');
            form_oke = false;
        } else {
            $('#err_choose_nv').html('');
            form_data.append('chon_nv', arr_staff);
        }

        if (date_start == "" || date_start == null) {
            $('#err_date_start').html("Bạn chưa chọn ngày bắt đầu");
            form_oke = false;
            arr_id_to_focus.push('#date_start');
        } else {
            var today = new Date();
            var date = today.getFullYear() + '-' + checkTime((today.getMonth() + 1)) + '-' + checkTime((today.getDate()));
            if (date_start >= date) {
                $('#err_date_start').html("");
                form_data.append('date_start', date_start);
            } else {
                $('#err_date_start').html("Ngày bắt đầu phải sau ngày tạo lịch");
                form_oke = false;
                arr_id_to_focus.push('#date_start');
            }
        }

        if (date_end == "" || date_end == null) {
            $('#err_date_end').html("Bạn chưa chọn ngày kết thúc");
            form_oke = false;
            arr_id_to_focus.push('#date_end');
        } else {
            if (date_end <= date_start) {
                $('#err_date_end').html("Ngày kết thúc phải sau ngày bắt đầu");
                form_oke = false;
                arr_id_to_focus.push('#date_end');
            } else {
                var today = new Date();
                var date = today.getFullYear() + '-' + checkTime((today.getMonth() + 1)) + '-' + checkTime((today.getDate()));
                if (date_end > date) {
                    $('#err_date_end').html("");
                    form_data.append('date_end', date_end);
                } else {
                    $('#err_date_end').html("Ngày kết thúc phải sau ngày tạo lịch");
                    form_oke = false;
                    arr_id_to_focus.push('#date_end');
                }
            }
        }

        if (place == '') {
            $('#err_dd').html("Bạn phải nhập đủ điểm đầu, điểm cuối")
            form_oke = false;
            arr_id_to_focus.push('.d-dichuyen-input');
        } else {
            $('#err_dd').html("");
            form_data.append('place', place);
        }
        form_data.append('ghi_chu', ghi_chu);
        if (form_oke == true) {
            $.ajax({
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                // enctype: 'multipart/form-data',
                url: '/company/Company_controller/create_schedule_post',
                data: form_data,
                dataType: "JSON",
                async: false,
                success: function(data) {
                    if (data.result == true) {
                        $("#alert").append('<div class="alert-success">' + data.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {
                                $(".alert-success").remove();
                                window.location.href = "/quan-ly-lich-trinh.html";
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

function capnhatlichtrinh(id) {
    event.preventDefault();
    var form_oke = true;
    var arr_id_to_focus = [];

    var tao_lich = $.trim($("#tao_lich").val());
    var arr_staff = [];

    $(".item_cty").each(function() {
        if ($(this).is(":checked")) {
            arr_staff.push($(this).val());
        }
    });
    var date_start = $.trim($("#date_start").val());
    var date_end = $.trim($("#date_end").val());
    var ghi_chu = $.trim($("#ghi_chu").val());
    var input_place = $('.d-dichuyen-input');
    var place = '';
    for (var i = 0; i < input_place.length; i++) {    
        if (input_place[i].value != '') {
            place += input_place[i].value + ';';
        }
    }
    var form_data = new FormData();

    if (id != '' && id != 0) {
        form_data.append('id', id);
    }
    if (tao_lich == "") {
        $("#err_lich").html("Bạn chưa nhập tên lịch trình");
        arr_id_to_focus.push("#tao_lich");
        form_oke = false;
    } else {
        $("#err_lich").html("");
        form_data.append('tao_lich', tao_lich);
    }

    var cty = [];
    $(".d-tao-lich2").each(function() {
        if ($(this).is(":checked")) {
            cty.push($(this).val());
        }
    });

    if (cty.length == 0) {
        $("#err_choose_cty").html("Bạn chưa chọn công ty");
        arr_id_to_focus.push('#err_choose_cty');
        form_oke = false;
    } else {
        $("#err_choose_cty").html("");
    }


    var cty = [];
    $(".item_ca").each(function() {
        if ($(this).is(":checked")) {
            cty.push($(this).val());
        }
    });

    if (cty.length == 0) {
        $("#err_phongban").html("Bạn chưa chọn phòng ban");
        arr_id_to_focus.push('#err_phongban');
        form_oke = false;
    } else {
        $("#err_phongban").html("");
    }

    if (arr_staff.length == 0) {
        $('#err_choose_nv').html('Bạn chưa chọn nhân viên');
        arr_id_to_focus.push('#err_choose_nv');
        form_oke = false;
    } else {
        $('#err_choose_nv').html('');
        form_data.append('chon_nv', arr_staff);
    }

    if (date_start == "" || date_start == null) {
        $('#err_date_start').html("Bạn chưa chọn ngày bắt đầu");
        form_oke = false;
        arr_id_to_focus.push('#date_start');
    } else {
        $('#err_date_start').html("");
        form_data.append('date_start', date_start);
    }

    if (date_end == "" || date_end == null) {
        $('#err_date_end').html("Bạn chưa chọn ngày kết thúc");
        form_oke = false;
        arr_id_to_focus.push('#date_end');
    } else {
        if (date_end < date_start) {
            $('#err_date_end').html("Ngày kết thúc phải sau ngày bắt đầu");
            form_oke = false;
            arr_id_to_focus.push('#date_end');
        } else {
            $('#err_date_end').html("");
            form_data.append('date_end', date_end);
        }
    }

    form_data.append('ghi_chu', ghi_chu);

    if (place == '') {
        $('#err_dd').html("Bạn phải nhập đủ điểm đầu, điểm cuối")
        form_oke = false;
        arr_id_to_focus.push('.d-dichuyen-input');
    } else {
        $('#err_dd').html("");
        form_data.append('place', place);
    }

    if (form_oke == true) {
        $.ajax({
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            // enctype: 'multipart/form-data',
            url: '/company/Company_controller/update_schedule_post',
            data: form_data,
            dataType: "JSON",
            async: false,
            success: function(data) {
                if (data.result == true) {
                    $("#alert").append('<div class="alert-success">' + data.message + '</div>');
                    setTimeout(function() {
                        $(".alert-success").fadeOut(1000, function() {
                            $(".alert-success").remove();
                            window.location.href = "/quan-ly-lich-trinh.html";
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
}