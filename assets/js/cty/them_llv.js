function getcountMonth(year, month) {
    return month == 2 ? 28 + (year % 4 == 0 ? (year % 100 == 0 ? (year % 400 == 0 ? 1 : 0) : 1) : 0) : 31 - (month - 1) % 7 % 2;
}

function showMonthDefault() {
    $('#show_month').html('<div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3b">' +
        '<input type="month" class="d-ten-wifi" id="month" name="monthDefault" placeholder="Chọn tháng">' +
        '<div class="error" id="err_date_start"></div>' +
        '</div>');
    $('#show_day').html('');
    $("#err_day").html("");
}

function showMonth() {
    $('#show_month').html('<div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3b">' +
        '<input type="month" class="d-ten-wifi" id="month" name="month" onchange = "showDay();" placeholder="Chọn ngày bắt đầu">' +
        '<div class="error" id="err_date_start"></div>' +
        '</div>');
}

function showDay() {
    // var curr = new Date;
    // var firstday = new Date(curr.setDate(curr.getDate() - curr.getDay()));
    // var lastday = new Date(curr.setDate(curr.getDate() - curr.getDay() + 6));
    //var numDay = getcountMonth(checkNumMonth[0], checkNumMonth[1]);
    // $('#show_day').html('');
    // for (let i = 1; i <= numDay; i++) {
    //     var days = ['Chủ nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'];
    //     var day = month + '-' + i;
    //     var d = new Date(day);
    //     var dayName = days[d.getDay()];
    //     $('#show_day').append('<div class="col-md-2 col-sm-3 col-xs-6 d-cau-hinh3a1"><input value="' + day + '" type="checkbox" id="day' + i + '" class="itemca cau-hinh d-cau-hinh-input2">' +
    //         '<label for="day' + i + '" class="d-cau-hinh-label">' + dayName + '</label></div>');
    // }
    var month = $('#month').val();
    var checkNumMonth = month.split('-');

    var now = new Date();
    month = checkNumMonth[1];
    year = checkNumMonth[0];
    // labels for week days and months
    var days_labels = ['Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy', 'Chủ Nhật'],
        months_labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    // kiểm tra xem ngày nhập liệu có chính xác không, thay vào đó hãy sử dụng tháng hiện tại
    this.month = (isNaN(month) || month == null) ? now.getMonth() + 1 : month;
    this.year = (isNaN(year) || year == null) ? now.getFullYear() : year;

    var logical_month = this.month - 1;

    // nhận được ngày đầu tiên của tháng và ngày đầu tiên của tuần
    var first_day = new Date(this.year, logical_month, 1),
        first_day_weekday = first_day.getDay() == 0 ? 7 : first_day.getDay();
    // console.log(first_day_weekday);
    // tìm số ngày trong tháng
    var month_length = new Date(this.year, this.month, 0).getDate(),
        previous_month_length = new Date(this.year, logical_month, 0).getDate();

    // tiêu đề lịch
    // var html = '<h2>' + months_labels[logical_month] + ' ' + this.year + '</h2>';
    var html = '';
    // nội dung lịch
    html += '<table class="calendar-table" style = "width: 90%;margin: 0px auto;">';

    // các ngày trong tuần
    html += '<thead>';
    html += '<tr class="week-days">';
    for (var i = 0; i < days_labels.length; i++) {
        html += '<th class="day">';
        html += days_labels[i];
        html += '</th>';
    }
    html += '</tr>';
    html += '</thead>';

    // xác định các biến ngày mặc định
    var day = 1, // ngày tháng hiện tại
        prev = 1, // ngày tháng trước
        next = 1; // những ngày tháng sau
    // console.log(Math.round(month_length / (days_labels.length)));
    html += '<tbody>';
    html += '<tr class="week">';

    // tổng số tuần trong tháng
    var firstOfMonth = new Date(year, month - 1, 1);
    var lastOfMonth = new Date(year, month, 0);
    var firstDay = firstOfMonth.getDay();
    if (firstDay == 7)
        firstDay = 1;
    else
        firstDay += 1;
    var used = firstOfMonth.getDay() % 7 + 1 + lastOfMonth.getDate();
    var total_weekday = Math.ceil(used / 7);


    // vòng lặp tuần (rows)
    for (var i = 0; i <= total_weekday; i++) {
        // vòng lặp các ngày trong tuần (cells)
        for (var j = 1; j <= days_labels.length; j++) {
            if (day <= month_length && (i > 0 || j >= first_day_weekday)) {
                // current month
                var nameDay = day + '-' + month + '-' + year;
                html += '<td class="day">';
                html += '<input value="' + nameDay + '" type="checkbox" id="day' + nameDay + '" class="itemca item_day cau-hinh d-cau-hinh-input2">';
                html += '<label for="day' + nameDay + '" class="d-cau-hinh-label">' + day + '</label></div>';
                // html += day;
                html += '</td>';
                day++;
            } else {
                if (day <= month_length) {
                    // previous month
                    html += '<td class="day other-month">';
                    // html += previous_month_length - first_day_weekday + prev + 1;
                    html += '</td>';
                    prev++;
                } else {
                    // next month
                    html += '<td class="day other-month">';
                    // html += next;
                    html += '</td>';
                    next++;
                }
            }
        }
        // ngừng tạo hàng nếu đó là cuối tháng
        if (day > month_length) {
            html += '</tr>';
            break;
        } else {
            html += '</tr><tr class="week">';
        }
    }
    html += '</tbody>';
    html += '</table>';
    $('#show_day').html(html);
    // return html;
}
$(document).ready(function() {
    $("#cham_cong").select2({
        width: "100%",
        placeholder: "Cấp quyền truy cập",
    });
    $(".ca_lam").on('click', function() {
        if (!$(this).hasClass('active')) {
            $(this).addClass('active').attr('data-nv', 1);
        } else {
            $(this).removeClass('active').attr('data-nv', 0);
        }
    });
    $(".itemca").on('click', function() {
        if (!$(this).hasClass('active')) {
            $(this).addClass('active').attr('data-nv', 1);
        } else {
            $(this).removeClass('active').attr('data-nv', 0);
        }
    });
    $("#them_llv").submit(function() {
        var form_oke = true;
        var data = new FormData();
        var arr_id_to_focus = [];
        var llv = "";
        var date_start = $.trim($("#date_start").val());
        var date_end = $.trim($("#date_end").val());
        var name_calendar = $.trim($("#name_calendar").val());
        var ca = [];
        var ca_lam = $(".ca_lam");
        var dia_diem = [];
        var itemca = $(".itemca");

        var arr_calendar = [];
        var ca_lam = [];
        var item_day = $(".item_day");
        $(".ca_lam").each(function() {
            if ($(this).is(":checked")) {
                ca_lam.push($(this).val());
            }
        });
        $(".llv").each(function() {
            if ($(this).is(":checked")) {
                var type = $(this).val();
                var month = $('#month').val();
                var checkNumMonth = month.split('-');
                var checkdate = type.split('-');
                var start = 0;
                var end = 0;
                if (type == 1) {
                    start = 2;
                    end = 6;
                }
                if (type == 2) {
                    start = 2;
                    end = 7;
                }
                if (type == 3) {
                    start = 2;
                    end = 8;
                }

                var now = new Date();
                month = checkNumMonth[1];
                year = checkNumMonth[0];
                // kiểm tra xem ngày nhập liệu có chính xác không, thay vào đó hãy sử dụng tháng hiện tại
                this.month = (isNaN(month) || month == null) ? now.getMonth() + 1 : month;
                this.year = (isNaN(year) || year == null) ? now.getFullYear() : year;

                var logical_month = this.month - 1;
                // nhận được ngày đầu tiên của tháng và ngày đầu tiên của tuần
                var first_day = new Date(this.year, logical_month, 1),
                    first_day_weekday = first_day.getDay() == 0 ? 7 : first_day.getDay();
                // tìm số ngày trong tháng
                var month_length = new Date(this.year, this.month, 0).getDate();

                // xác định các biến ngày mặc định
                var day = 1; // ngày tháng hiện tại

                // vòng lặp tuần (rows)
                for (var i = 0; i <= 5; i++) {
                    // vòng lặp các ngày trong tuần (cells)
                    // console.log(days_labels.length);
                    for (var j = 1; j <= 7; j++) {
                        if (day <= month_length && (i > 0 || j >= first_day_weekday)) {
                            var arr = {};
                            var nameDay = day + '-' + month + '-' + year;
                            if (j >= start - 1 && j < end) {
                                arr = {
                                    day: nameDay,
                                    shift: ca_lam.toString(),
                                };
                                arr_calendar.push(arr);
                            } else {
                                arr = {
                                    day: nameDay,
                                    shift: "",
                                };
                                arr_calendar.push(arr);
                            }
                            day++;
                        }
                    }
                    // ngừng tạo hàng nếu đó là cuối tháng
                    if (day > month_length) {
                        break;
                    }
                }
            }
        });



        var check = [];
        $(".check").each(function() {
            if ($(this).is(":checked")) {
                check.push($(this).val());
            }
        });

        if (check.length == 0) {
            $("#err_llv").html("Bạn chưa chọn lịch làm việc");
            arr_id_to_focus.push("#err_llv");
            form_oke = false;
        } else {
            $("#err_llv").html("");
        }
        if (name_calendar == '') {
            $("#err_name").html("Bạn chưa nhập tên lịch làm việc");
            arr_id_to_focus.push("#err_name");
            form_oke = false;
        } else {
            $("#err_name").html("");
        }
        if (ca_lam.length == 0) {
            $("#err_calam").html("Bạn chưa chọn ca làm việc");
            arr_id_to_focus.push("#err_calam");
            form_oke = false;
        } else {
            $("#err_calam").html("");
        }
        var check_month = $('#month').val();
        if (check_month == '') {
            $("#err_month").html("Bạn chưa chọn tháng làm việc");
            arr_id_to_focus.push("#err_month");
            form_oke = false;
        } else {
            $("#err_month").html("");
        }
        var checked = 0;
        $(".item_day").each(function() {
            var arr = {};
            if ($(this).is(":checked")) {
                arr = {
                    day: $(this).val(),
                    shift: ca_lam.toString(),
                };
                arr_calendar.push(arr);
                checked++;
            } else {
                arr = {
                    day: $(this).val(),
                    shift: '',
                };
                arr_calendar.push(arr);
            }
        });
        var item_day = $(".item_day");
        if (checked == 0 && item_day.length > 0) {
            $("#err_day").html("Bạn chưa chọn ngày");
            arr_id_to_focus.push("#err_month");
            form_oke = false;
        } else {
            $("#err_day").html("");
        }
        var arr_company = [];

        $(".item_cty").each(function() {
            if ($(this).is(":checked")) {
                arr_company.push($(this).val());
            }
        });
        if (arr_company.length == 0) {
            $("#err_diadiem").html("Bạn chưa chọn công ty");
            arr_id_to_focus.push("#err_diadiem");
            form_oke = false;
        } else {
            $("#err_diadiem").html("");
        }
        if (form_oke == true) {
            data.append('name', name_calendar);
            data.append('month', check_month);
            data.append('choose_calendar', check);
            data.append('ca_lam', ca_lam);
            data.append('arr_calendar', JSON.stringify(arr_calendar));
            data.append('arr_company', arr_company);
            $.ajax({
                type: 'post',
                url: "/company/Company_controller/createCalendar",
                async: false,
                dataType: "JSON",
                contentType: false,
                processData: false,
                data: data,
                success: function(response) {
                    if (response.result == true) {
                        $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {
                                // location.reload();
                                window.location.href = '/danh-sach-lich-lam-viec.html';
                            });
                        }, 1000);
                    } else {
                        return false;
                    }
                },

            });
        }
        $(arr_id_to_focus[0]).focus();
        return false;
    });
    $("#sua_llv").submit(function() {
        var form_oke = true;
        var data = new FormData();
        var arr_id_to_focus = [];
        var llv = "";
        var date_start = $.trim($("#date_start").val());
        var date_end = $.trim($("#date_end").val());
        var id_calendar = $.trim($("#id_calendar").val());
        var name_calendar = $.trim($("#name_calendar").val());
        var ca = [];
        var ca_lam = $(".ca_lam");
        var dia_diem = [];
        var itemca = $(".itemca");

        var arr_calendar = [];
        var ca_lam = [];
        var item_day = $(".item_day");
        $(".ca_lam").each(function() {
            if ($(this).is(":checked")) {
                ca_lam.push($(this).val());
            }
        });
        $(".llv").each(function() {
            if ($(this).is(":checked")) {
                var type = $(this).val();
                var month = $('#month').val();
                var checkNumMonth = month.split('-');
                var checkdate = type.split('-');
                var start = 0;
                var end = 0;
                if (type == 1) {
                    start = 2;
                    end = 6;
                }
                if (type == 2) {
                    start = 2;
                    end = 7;
                }
                if (type == 3) {
                    start = 2;
                    end = 8;
                }

                var now = new Date();
                month = checkNumMonth[1];
                year = checkNumMonth[0];
                // kiểm tra xem ngày nhập liệu có chính xác không, thay vào đó hãy sử dụng tháng hiện tại
                this.month = (isNaN(month) || month == null) ? now.getMonth() + 1 : month;
                this.year = (isNaN(year) || year == null) ? now.getFullYear() : year;

                var logical_month = this.month - 1;
                // nhận được ngày đầu tiên của tháng và ngày đầu tiên của tuần
                var first_day = new Date(this.year, logical_month, 1),
                    first_day_weekday = first_day.getDay() == 0 ? 7 : first_day.getDay();
                // tìm số ngày trong tháng
                var month_length = new Date(this.year, this.month, 0).getDate();

                // xác định các biến ngày mặc định
                var day = 1; // ngày tháng hiện tại

                // vòng lặp tuần (rows)
                for (var i = 0; i <= 5; i++) {
                    // vòng lặp các ngày trong tuần (cells)
                    // console.log(days_labels.length);
                    for (var j = 1; j <= 7; j++) {
                        if (day <= month_length && (i > 0 || j >= first_day_weekday)) {
                            var arr = {};
                            var nameDay = day + '-' + month + '-' + year;
                            if (j >= start - 1 && j < end) {
                                arr = {
                                    day: nameDay,
                                    shift: ca_lam.toString(),
                                };
                                arr_calendar.push(arr);
                            } else {
                                arr = {
                                    day: nameDay,
                                    shift: "",
                                };
                                arr_calendar.push(arr);
                            }
                            day++;
                        }
                    }
                    // ngừng tạo hàng nếu đó là cuối tháng
                    if (day > month_length) {
                        break;
                    }
                }
            }
        });



        var check = [];
        $(".check").each(function() {
            if ($(this).is(":checked")) {
                check.push($(this).val());
            }
        });

        if (check.length == 0) {
            $("#err_llv").html("Bạn chưa chọn lịch làm việc");
            arr_id_to_focus.push("#err_llv");
            form_oke = false;
        } else {
            $("#err_llv").html("");
        }
        if (name_calendar == '') {
            $("#err_name").html("Bạn chưa nhập tên lịch làm việc");
            arr_id_to_focus.push("#err_name");
            form_oke = false;
        } else {
            $("#err_name").html("");
        }
        if (ca_lam.length == 0) {
            $("#err_calam").html("Bạn chưa chọn ca làm việc");
            arr_id_to_focus.push("#err_calam");
            form_oke = false;
        } else {
            $("#err_calam").html("");
        }
        var check_month = $('#month').val();
        if (check_month == '') {
            $("#err_month").html("Bạn chưa chọn tháng làm việc");
            arr_id_to_focus.push("#err_month");
            form_oke = false;
        } else {
            $("#err_month").html("");
        }
        var checked = 0;
        $(".item_day").each(function() {
            var arr = {};
            if ($(this).is(":checked")) {
                arr = {
                    day: $(this).val(),
                    shift: ca_lam.toString(),
                };
                arr_calendar.push(arr);
                checked++;
            } else {
                arr = {
                    day: $(this).val(),
                    shift: '',
                };
                arr_calendar.push(arr);
            }
        });
        var item_day = $(".item_day");
        if (checked == 0 && item_day.length > 0) {
            $("#err_day").html("Bạn chưa chọn ngày");
            arr_id_to_focus.push("#err_month");
            form_oke = false;
        } else {
            $("#err_day").html("");
        }
        var arr_company = [];

        $(".item_cty").each(function() {
            if ($(this).is(":checked")) {
                arr_company.push($(this).val());
            }
        });
        if (arr_company.length == 0) {
            $("#err_diadiem").html("Bạn chưa chọn công ty");
            arr_id_to_focus.push("#err_diadiem");
            form_oke = false;
        } else {
            $("#err_diadiem").html("");
        }
        if (form_oke == true) {
            data.append('id_calendar', id_calendar);
            data.append('name', name_calendar);
            data.append('month', check_month);
            data.append('choose_calendar', check);
            data.append('ca_lam', ca_lam);
            data.append('arr_calendar', JSON.stringify(arr_calendar));
            data.append('arr_company', arr_company);
            $.ajax({
                type: 'post',
                url: "/company/Company_controller/updateCalendar",
                async: false,
                dataType: "JSON",
                contentType: false,
                processData: false,
                data: data,
                success: function(response) {
                    if (response.result == true) {
                        $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {
                                // location.reload();
                                window.location.href = '/danh-sach-lich-lam-viec.html';
                            });
                        }, 1000);
                    } else {
                        return false;
                    }
                },

            });
        }
        $(arr_id_to_focus[0]).focus();
        return false;
    });
});