function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

function add_content() {
    $("#add_content").append(`<div class="d-tao-lich">
    <div class="l_flex">
    <input type="text" class="d-tao-lich1 l_content" value="" id="l_content" name="l_content[]" placeholder="Nhập Việc cần làm">
    <img src=" /assets/images/Delete.svg" alt="xóa" class="l_img_delete" onClick="deletes(this)">
    </div>
    <div class="error" id="err_tencty"></div></div>`);
}

function deletes(e) {
    dom_parent = $(e).parents('.d-tao-lich').remove();
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
                        $('#append_department').append('<div class="col-md-4 col-sm-4 col-xs-12 d-input-radio-v1a l_remove_department">' +
                            '<input type="checkbox" class="item_ca d-tao-lich2 l_curson" onchange = "show_staff(' + data.list[index].dep_id + ')" id ="dep' + data.list[index].dep_id + '" value="' + data.list[index].dep_id + '" name="department">' +
                            '<label for="dep' + data.list[index].dep_id + '" class="d-tao-lich2-v1 l_curson">' + data.list[index].dep_name + '</label>' +
                            '</div>');
                        // }
                    }
                } else {
                    $('#append_department').append('<div class="col-md-4 col-sm-4 col-xs-12 d-input-radio-v1a l_remove_department">Thêm phòng ban<a class="l_margin_link" href="/danh-sach-phong-ban.html"> Tại đây</a></div>');
                }
                $('.remobe_staff').remove();
                if (data.show_staff.length > 0) {
                    for (let i = 0; i < data.show_staff.length; i++) {
                        var name_dep = 'chưa xác định';
                        if (data.show_staff[i].dep_name != null) {
                            name_dep = data.show_staff[i].dep_name;
                        }
                        var html = '<div class="col-md-6 col-sm-6 col-xs-12 d-tao-lich-v3a1 remobe_staff">' +
                            '<div class="d-tao-lich-v3-img">' +
                            '<img src="https://chamcong.24hpay.vn/upload/employee/' + data.show_staff[i].image + '" onerror=' + 'this.onerror=null;this.src="/images_staff/avatar_default.png";' + 'alt="ten_nv" class="nv-tao-lich-img">' +
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
                    $('#scroll').append('<div class="col-md-4 col-sm-4 col-xs-12 d-input-radio-v1a remobe_staff">Thêm nhân viên<a class="l_margin_link" href="/quan-ly-nhan-vien-cong-ty.html/1"> Tại đây</a></div>');
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
    console.log(arr_staff);
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
                // for (let i = 0; i < data.list.length; i++) {
                for (let index = 0; index < data.list.length; index++) {
                    var html = '<div class="col-md-6 col-sm-6 col-xs-12 d-tao-lich-v3a1 remobe_staff">' +
                        '<div class="d-tao-lich-v3-img">' +
                        '<img src="https://chamcong.24hpay.vn/upload/employee/' + data.list[index].ep_image + '" onerror=' + 'this.onerror=null;this.src="/images_staff/avatar_default.png";' + 'alt="ten_nv" class="nv-tao-lich-img">' +
                        '</div>' +
                        '<label for="st' + data.list[index].ep_id + '">' +
                        '<div class="d-ten-nv">' +
                        '<p class="d-cham-cong-p">(' + data.list[index].ep_id + ') ' + data.list[index].ep_name + '</p>' +
                        '<p class="d-cham-cong-p1">Nhân viên ' + data.list[index].dep_name + '</p>' +
                        '</div>' +
                        '</label>' +
                        '<div class="d-input-nv">' +
                        '<input type="checkbox" name="staff[]" class="item_cty d-tao-lich2 l_curson" id="st' + data.list[index].ep_id + '" data-name="1" value="' + data.list[index].ep_id + '">' +
                        '</div>' +
                        '</div>';
                    $('#scroll').append(html);
                }
                if (data.list.length == 0) {
                    dem++;
                }
                // }
                if (dem == data.list.length) {
                    $('#scroll').append('<div class="col-md-4 col-sm-4 col-xs-12 d-input-radio-v1a remobe_staff">Thêm nhân viên<a class="l_margin_link" href="/quan-ly-nhan-vien-cong-ty.html/1"> Tại đây</a></div>');
                }
            } else {
                return false;
            }
        }
    });
}

function show_district() {
    var cit_id = $('#city').val();
    var data = new FormData();
    data.append('cit_id', cit_id);
    $.ajax({
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        // enctype: 'multipart/form-data',
        url: '/company/Company_controller/showDistrict',
        data: data,
        dataType: "JSON",
        async: false,
        success: function(data) {
            if (data.result == true) {
                for (let index = 0; index < data.message.length; index++) {
                    $('#district').append('<option value="' + data.message[index].cit_id + '">' + data.message[index].cit_name + '</option>');
                }
            } else {
                return false;
            }
        }
    });
}
$(document).ready(function() {
    $('#time_start').select2({
        placeholder: "Chọn giờ",
        width: "30%",
    });
    $('#time_end').select2({
        placeholder: "Chọn giờ",
        width: "30%",
    });
    $('#city').select2({
        placeholder: "Tỉnh/ thành",
        width: "100%",
    });
    $('#district').select2({
        placeholder: "Quận/ huyện",
        width: "100%",
    });
    $('#time_nhac').select2({
        placeholder: "Chọn thời gian nhắc nhở",
        width: "100%",
    });
    $('#cach_nhac').select2({
        placeholder: "Chọn cách thức thông báo",
        width: "100%",
    });
    $("#chon1").click(function() {
        $("#haha").css("display", "none");
        $('#hihi').css("display", "block");
    });
    $("#chon2").click(function() {
        $("#haha").css("display", "block");
        $('#hihi').css("display", "none");
    });
    $(".item_ca").on('click', function() {
        if (!$(this).hasClass('active')) {
            $(this).addClass('active').attr('data-chon', 1);
        } else {
            $(this).removeClass('active').attr('data-chon', 0);
        }
    });
    $(".item_nv").on('click', function() {
        if (!$(this).hasClass('active')) {
            $(this).addClass('active').attr('data-nv', 1);
        } else {
            $(this).removeClass('active').attr('data-nv', 0);
        }
    });
    $("#tao_cong_viec").submit(function() {
        var form_oke = true;
        var ten_cty = $.trim($("#ten_cv").val());
        var chon_ty = "";
        var day = document.getElementById('chon1').checked;
        var days = document.getElementById('chon2').checked;
        var date_start = $.trim($("#date_start").val());
        var date_end = $.trim($("#date_end").val());
        var time_in = $("#time_in").val()
        var time_out = $("#time_out").val()
        var time_startt = $("#time_startt").val();
        var time_endd = $("#time_endd").val();
        var arr_staff = [];

        $(".item_cty").each(function() {
            if ($(this).is(":checked")) {
                arr_staff.push($(this).val());
            }
        });

        var dia_chi = $.trim($("#dia_chi").val());
        var city = $.trim($("#city").val());
        var district = $.trim($("#district").val());
        var time_nhac = $.trim($("#time_nhac").val());
        var cach_nhac = $.trim($("#cach_nhac").val());
        var note = $.trim($("#note").val());
        // var content = $.trim($("#content").val());
        var input_contetn = $('.l_content');
        var content = '';
        for (var i = 0; i < input_contetn.length; i++) {    
            if (input_contetn[i].value != '') {
                content += input_contetn[i].value + '||';
            }
        }

        var form_data = new FormData();

        var arr_id_to_focus = [];
        if (ten_cty == "") {
            $("#err_tencty").html("Bạn chưa nhập tên lịch trình");
            arr_id_to_focus.push("#ten_cv");
            form_oke = false;
        } else {
            $("#err_tencty").html("");
            form_data.append('ten_cty', ten_cty);
        }
        if (day == "" && days == "") {
            $("#err_lichlam").html("Bạn chưa chọn ngày làm");
            arr_id_to_focus.push("#err_lichlam");
            form_oke = false;
        } else {
            $("#err_lichlam").html("");
            if (day == true) {
                if (date_start == "" || date_start == null) {
                    $('#err_date_start').html("Bạn chưa chọn ngày bắt đầu");
                    form_oke = false;
                    arr_id_to_focus.push('#date_start');
                } else {
                    var today = new Date();
                    var date = today.getFullYear() + '-' + checkTime((today.getMonth() + 1)) + '-' + checkTime((today.getDate()));
                    if (date_start > date) {
                        $('#err_date_start').html("");
                        form_data.append("date_start", date_start);
                        if (time_in == "") {
                            $("#err_date_start").html("Bạn chưa chọn giờ làm");
                            arr_id_to_focus.push("#time_in")
                            form_oke = false;
                        } else {
                            $("#err_date_start").html("");
                            form_data.append("time_in", time_in);
                        }
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
                    if (date_end < date_start) {
                        $('#err_date_end').html("Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu");
                        form_oke = false;
                        arr_id_to_focus.push('#date_end');
                    } else {
                        var today = new Date();
                        var date = today.getFullYear() + '-' + checkTime((today.getMonth() + 1)) + '-' + checkTime((today.getDate()));
                        if (date_end > date) {
                            $('#err_date_end').html("");
                            form_data.append('date_end', date_end);
                            if (time_out == "") {
                                $("#err_date_end").html("Bạn chưa chọn giờ làm");
                                arr_id_to_focus.push("#time_out")
                                form_oke = false;
                            } else {
                                $("#err_date_end").html("");
                                form_data.append("time_out", time_out);
                            }
                        } else {
                            $('#err_date_end').html("Ngày kết thúc phải sau ngày tạo lịch");
                            form_oke = false;
                            arr_id_to_focus.push('#date_end');
                        }
                    }
                }
            }
            if (days == true) {
                if (time_startt == "" || time_startt == null) {
                    $('#err_time_start').html("Bạn chưa chọn ngày bắt đầu");
                    form_oke = false;
                    arr_id_to_focus.push('#time_startt');
                } else {
                    var today = new Date();
                    var date = today.getFullYear() + '-' + checkTime((today.getMonth() + 1)) + '-' + checkTime((today.getDate()));
                    if (time_startt > date) {
                        $('#err_time_start').html("");
                        form_data.append('date_start', time_startt);
                    } else {
                        $('#err_time_start').html("Ngày bắt đầu phải sau ngày tạo lịch");
                        form_oke = false;
                        arr_id_to_focus.push('#time_startt');
                    }
                }
                if (time_endd == "" || time_endd == null) {
                    $('#err_time_end').html("Bạn chưa chọn ngày kết thúc");
                    form_oke = false;
                    arr_id_to_focus.push('#time_endd');
                } else {
                    if (time_endd <= time_startt) {
                        $('#err_time_end').html("Ngày kết thúc phải sau ngày bắt đầu");
                        form_oke = false;
                        arr_id_to_focus.push('#time_endd');
                    } else {
                        var today = new Date();
                        var date = today.getFullYear() + '-' + checkTime((today.getMonth() + 1)) + '-' + checkTime((today.getDate()));
                        if (time_endd > date) {
                            $('#err_time_end').html("");
                            form_data.append('date_end', time_endd);
                        } else {
                            $('#err_time_end').html("Ngày kết thúc phải sau ngày tạo lịch");
                            form_oke = false;
                            arr_id_to_focus.push('#time_endd');
                        }
                    }
                }
            }
        }

        var cty = [];
        $(".d-tao-lich2").each(function() {
            if ($(this).is(":checked")) {
                cty.push($(this).val());
            }
        });


        if (cty.length <= 1) {
            $("#err_choose_cty").html("Bạn chưa chọn công ty");
            arr_id_to_focus.push('#err_choose_cty');
            form_oke = false;
        } else {
            $("#err_choose_cty").html("");
        }

        var item_ca = [];
        $(".item_ca").each(function() {
            if ($(this).is(":checked")) {
                item_ca.push($(this).val());
            }
        });

        // if (item_ca.length < 1) {
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

        if (dia_chi == "" || dia_chi == null) {
            $("#err_address").html("Bạn chưa nhập địa chỉ");
            arr_id_to_focus.push("#dia_chi");
            form_oke = false;
        } else {
            $("#err_address").html("");
            form_data.append('dia_chi', dia_chi);
        }
        if (city == "" || city == null) {
            $("#err_city").html("Bạn chưa chọn thành phố");
            arr_id_to_focus.push("#city");
            form_oke = false;
        } else {
            $("#err_city").html("");
            form_data.append('city', city);

        }
        if (district == "" || district == null) {
            $("#err_district").html("Bạn chưa chọn quận huyện");
            arr_id_to_focus.push("#district");
        } else {
            $("#err_district").html("");
            form_data.append('district', district)
        }
        if (time_nhac == "" || time_nhac == null) {
            $("#err_nhacnho").html("Bạn chưa chọn thời gian nhắc nhở");
            arr_id_to_focus.push("#time_nhac");
            form_oke = false;
        } else {
            $("#err_nhacnho").html("");
            form_data.append("time_nhac", time_nhac);
        }
        if (cach_nhac == "" || cach_nhac == null) {
            $("#err_laplai").html("Bạn chưa chọn cách lặp lại thông báo");
            arr_id_to_focus.push("#cach_nhac");
            form_oke = false;
        } else {
            $("#err_laplai").html("");
            form_data.append("cach_nhac", cach_nhac);
        }
        if (content == '') {
            $("#err_content").html("Bạn chưa nhập công việc cần làm");
            arr_id_to_focus.push(".l_forcus_contents");
            form_oke = false;
        } else {
            $("#err_content").html("");
            form_data.append("content", content);
        }
        form_data.append("note", note);
        if (form_oke == true) {
            $.ajax({
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                // enctype: 'multipart/form-data',
                url: '/company/Company_controller/create_job',
                data: form_data,
                dataType: "JSON",
                async: false,
                success: function(data) {
                    if (data.result == true) {
                        $("#alert").append('<div class="alert-success">' + data.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {
                                $(".alert-success").remove();
                                window.location.href = "/giao-viec.html";
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

function date_start_value() {
    var value = $('#date_start').val();
    $('#date_end').val(value);
    console.log(value);
}

function updateJob(id) {
    var form_oke = true;
    var ten_cty = $.trim($("#ten_cv").val());
    var chon_ty = "";
    var day = document.getElementById('chon1').checked;
    var days = document.getElementById('chon2').checked;
    var date_start = $.trim($("#date_start").val());
    var date_end = $.trim($("#date_end").val());
    var time_in = $("#time_in").val()
    var time_out = $("#time_out").val()
    var time_startt = $("#time_startt").val();
    var time_endd = $("#time_endd").val();
    var arr_staff = [];

    $(".item_cty").each(function() {
        if ($(this).is(":checked")) {
            arr_staff.push($(this).val());
        }
    });

    var dia_chi = $.trim($("#dia_chi").val());
    var city = $.trim($("#city").val());
    var district = $.trim($("#district").val());
    var time_nhac = $.trim($("#time_nhac").val());
    var cach_nhac = $.trim($("#cach_nhac").val());
    var note = $.trim($("#note").val());
    // var content = $.trim($("#content").val());
    var input_contetn = $('.l_content');
    var content = '';
    for (var i = 0; i < input_contetn.length; i++) {    
        if (input_contetn[i].value != '') {
            content += input_contetn[i].value + '||';
        }
    }
    var form_data = new FormData();

    form_data.append('id', id);
    var arr_id_to_focus = [];
    if (ten_cty == "") {
        $("#err_tencty").html("Bạn chưa nhập tên lịch trình");
        arr_id_to_focus.push("#ten_cv");
        form_oke = false;
    } else {
        $("#err_tencty").html("");
        form_data.append('ten_cty', ten_cty);
    }
    if (day == "" && days == "") {
        $("#err_lichlam").html("Bạn chưa chọn ngày làm");
        arr_id_to_focus.push("#err_lichlam");
        form_oke = false;
    } else {
        $("#err_lichlam").html("");
        if (day == true) {
            if (date_start == "" || date_start == null) {
                $('#err_date_start').html("Bạn chưa chọn ngày bắt đầu");
                form_oke = false;
                arr_id_to_focus.push('#date_start');
            } else {
                // var today = new Date();
                // var date = today.getFullYear() + '-' + checkTime((today.getMonth() + 1)) + '-' + checkTime((today.getDate()));
                // if (date_start > date) {
                $('#err_date_start').html("");
                form_data.append("date_start", date_start);
                if (time_in == "") {
                    $("#err_date_start").html("Bạn chưa chọn giờ làm");
                    arr_id_to_focus.push("#time_in")
                    form_oke = false;
                } else {
                    $("#err_date_start").html("");
                    form_data.append("time_in", time_in);
                }
                // } else {
                //     $('#err_date_start').html("Ngày bắt đầu phải sau ngày tạo lịch");
                //     form_oke = false;
                //     arr_id_to_focus.push('#date_start');
                // }
            }
            if (date_end == "" || date_end == null) {
                $('#err_date_end').html("Bạn chưa chọn ngày kết thúc");
                form_oke = false;
                arr_id_to_focus.push('#date_end');
            } else {
                // if (date_end < date_start) {
                //     $('#err_date_end').html("Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu");
                //     form_oke = false;
                //     arr_id_to_focus.push('#date_end');
                // } else {
                //     var today = new Date();
                //     var date = today.getFullYear() + '-' + checkTime((today.getMonth() + 1)) + '-' + checkTime((today.getDate()));
                //     if (date_end > date) {
                $('#err_date_end').html("");
                form_data.append('date_end', date_end);
                if (time_out == "") {
                    $("#err_date_end").html("Bạn chưa chọn giờ làm");
                    arr_id_to_focus.push("#time_out")
                    form_oke = false;
                } else {
                    $("#err_date_end").html("");
                    form_data.append("time_out", time_out);
                }
                //     } else {
                //         $('#err_date_end').html("Ngày kết thúc phải sau ngày tạo lịch");
                //         form_oke = false;
                //         arr_id_to_focus.push('#date_end');
                //     }
                // }
            }
        }
        if (days == true) {
            if (time_startt == "" || time_startt == null) {
                $('#err_time_start').html("Bạn chưa chọn ngày bắt đầu");
                form_oke = false;
                arr_id_to_focus.push('#time_startt');
            } else {
                var today = new Date();
                var date = today.getFullYear() + '-' + checkTime((today.getMonth() + 1)) + '-' + checkTime((today.getDate()));
                if (time_startt > date) {
                    $('#err_time_start').html("");
                    form_data.append('date_start', time_startt);
                } else {
                    $('#err_time_start').html("Ngày bắt đầu phải sau ngày tạo lịch");
                    form_oke = false;
                    arr_id_to_focus.push('#time_startt');
                }
            }
            if (time_endd == "" || time_endd == null) {
                $('#err_time_end').html("Bạn chưa chọn ngày kết thúc");
                form_oke = false;
                arr_id_to_focus.push('#time_endd');
            } else {
                if (time_endd <= time_startt) {
                    $('#err_time_end').html("Ngày kết thúc phải sau ngày bắt đầu");
                    form_oke = false;
                    arr_id_to_focus.push('#time_endd');
                } else {
                    var today = new Date();
                    var date = today.getFullYear() + '-' + checkTime((today.getMonth() + 1)) + '-' + checkTime((today.getDate()));
                    if (time_endd > date) {
                        $('#err_time_end').html("");
                        form_data.append('date_end', time_endd);
                    } else {
                        $('#err_time_end').html("Ngày kết thúc phải sau ngày tạo lịch");
                        form_oke = false;
                        arr_id_to_focus.push('#time_endd');
                    }
                }
            }
        }
    }

    var cty = [];
    $(".d-tao-lich2").each(function() {
        if ($(this).is(":checked")) {
            cty.push($(this).val());
        }
    });


    if (cty.length <= 1) {
        $("#err_choose_cty").html("Bạn chưa chọn công ty");
        arr_id_to_focus.push('#err_choose_cty');
        form_oke = false;
    } else {
        $("#err_choose_cty").html("");
    }

    var item_ca = [];
    $(".item_ca").each(function() {
        if ($(this).is(":checked")) {
            item_ca.push($(this).val());
        }
    });

    if (item_ca.length < 1) {
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

    if (dia_chi == "" || dia_chi == null) {
        $("#err_address").html("Bạn chưa nhập địa chỉ");
        arr_id_to_focus.push("#dia_chi");
        form_oke = false;
    } else {
        $("#err_address").html("");
        form_data.append('dia_chi', dia_chi);
        if (city == "" || city == null) {
            $("#err_city").html("Bạn chưa chọn thành phố");
            arr_id_to_focus.push("#city");
            form_oke = false;
        } else {
            $("#err_city").html("");
            form_data.append('city', city);
            if (district == "" || district == null) {
                $("#err_district").html("Bạn chưa chọn quận huyện");
                arr_id_to_focus.push("#district");
            } else {
                $("#err_district").html("");
                form_data.append('district', district)
            }
        }
    }
    if (time_nhac == "" || time_nhac == null) {
        $("#err_nhacnho").html("Bạn chưa chọn thời gian nhắc nhở");
        arr_id_to_focus.push("#time_nhac");
        form_oke = false;
    } else {
        $("#err_nhacnho").html("");
        form_data.append("time_nhac", time_nhac);
        if (cach_nhac == "" || cach_nhac == null) {
            $("#err_nhacnho").html("Bạn chưa chọn cách thức thông báo");
            arr_id_to_focus.push("#cach_nhac");
            form_oke = false;
        } else {
            $("#err_nhacnho").html("");
            form_data.append("cach_nhac", cach_nhac);
        }
    }

    if (content == '') {
        $("#err_content").html("Bạn chưa nhập công việc cần làm");
        arr_id_to_focus.push(".l_forcus_contents");
        form_oke = false;
    } else {
        $("#err_content").html("");
        form_data.append("content", content);
    }
    form_data.append("note", note);
    if (form_oke == true) {
        $.ajax({
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            // enctype: 'multipart/form-data',
            url: '/company/Company_controller/update_job',
            data: form_data,
            dataType: "JSON",
            async: false,
            success: function(data) {
                if (data.result == true) {
                    $("#alert").append('<div class="alert-success">' + data.message + '</div>');
                    setTimeout(function() {
                        $(".alert-success").fadeOut(1000, function() {
                            $(".alert-success").remove();
                            window.location.href = "/giao-viec.html";
                        });
                    }, 1500);
                } else {
                    return false;
                }
            }
        });
    }
    $(arr_id_to_focus[0]).focus();
}