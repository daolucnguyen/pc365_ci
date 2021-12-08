$(function() {
    var star = '.star',
        selected = '.selected';

    $(star).on('click', function() {
        $(selected).each(function() {
            $(this).removeClass('selected');
        });
        $(this).addClass('selected');
    });

});

$(window).scroll(function() {
    if ($(this).scrollTop()) {
        $('#toTop').fadeIn();
    } else {
        $('#toTop').fadeOut();
    }
});

$("#toTop").click(function() {
    $("html, body").animate({ scrollTop: 0 }, 1000);
});

$(".l_show1").click(function() {
    $(this).next(".l_drop1").slideToggle(250);
});

$("#li_qlytaikhoan").click(function() {
    $(this).next(".l_hide").slideToggle(250);
});

$(document).mouseup(function(e) {
    var container = $("#list_menu1,#list_menu,#list_menu_tt,#menu_sau_dn,#list_menu_nv,.l_staff_notify,.l_chat_staff");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.hide(100);
    }
});

$("#menu_header").click(function() {
    $("#list_menu_nv").css('display', 'block');
});

$(".item-drop").click(function() {
    $(".menu-drop").slideToggle(250);
});



$(".l_click_chat").click(function() {
    $(".l_chat_staff").css('display', 'block');
});

$('.l_chat_header_item2').click(function() {
    $(".l_chat_staff").css('display', 'none');
});

$('#l_img').click(function() {
    // $("#list_menu1").show();
    if ($('#list_menu1').css('display') == 'none') {
        $('#list_menu1').css('display', 'block');
    } else {
        $('#list_menu1').css('display', 'none');
    }
});

$('#l_img_sidebar').click(function() {
    if ($('#list_menu').css('display') == 'none') {
        $('#list_menu').css('display', 'block');
    } else {
        $('#list_menu').css('display', 'none');
    }
});

$('#img_list_menu_tt').click(function() {
    if ($('#list_menu_tt').css('display') == 'none') {
        $('#list_menu_tt').css('display', 'block');
    } else {
        $('#list_menu_tt').css('display', 'none');
    }
});


$('.l_show_menu').click(function() {
    if ($('#menu_sau_dn').css('display') == 'none') {
        $('#menu_sau_dn').css('display', 'block');
    } else {
        $('#menu_sau_dn').css('display', 'none');
    }
});

function danhgia() {
    var star = 0;
    var note = $('#note').val();
    $('.star').each(function() {
        if ($(this).hasClass('selected')) {
            star = $(this).attr('name');
        }
    });
    var data = new FormData();
    var check = false;
    if (star == 0) {
        $('#err_evaluate').html('Bạn phải chọn sao trước khi gửi đánh giá');
        return false;
    } else {
        $('#err_evaluate').html('');
        check = true;
    }
    data.append('star', star);
    data.append('note', note);
    if (check == true) {
        $.ajax({
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            // enctype: 'multipart/form-data',
            url: '/company/Company_controller/evaluate',
            data: data,
            dataType: "JSON",
            async: false,
            success: function(data) {
                if (data.result == true) {
                    $("#alert").append('<div class="alert-success">' + data.message + '</div>');
                    setTimeout(function() {
                        $(".alert-success").fadeOut(1000, function() {
                            // $(".alert-success").remove();
                            // window.location.href = "/quan-ly-lich-trinh.html";
                        });
                    }, 2000);
                    $('#modal_danhgia').modal('hide');
                } else {
                    return false;
                }
            }
        });
    }
}

function danhGiaNv() {
    console.log(12312312);
    var star = 0;
    var note = $('#note_nv').val();
    $('.star').each(function() {
        if ($(this).hasClass('selected')) {
            star = $(this).attr('name');
        }
    });
    var data = new FormData();
    var check = false;
    if (star == 0) {
        $('#err_evaluate').html('Bạn phải chọn sao trước khi gửi đánh giá');
        return false;
    } else {
        $('#err_evaluate').html('');
        check = true;
    }
    data.append('star', star);
    data.append('note', note);
    if (check == true) {
        $.ajax({
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            // enctype: 'multipart/form-data',
            url: '/staff/StaffController/evaluate',
            data: data,
            dataType: "JSON",
            async: false,
            success: function(data) {
                if (data.result == true) {
                    $("#alert").append('<div class="alert-success">' + data.message + '</div>');
                    setTimeout(function() {
                        $(".alert-success").fadeOut(1000, function() {
                            // $(".alert-success").remove();
                            // window.location.href = "/quan-ly-lich-trinh.html";
                        });
                    }, 2000);
                    $('#modal_danhgia_nv').modal('hide');
                } else {
                    return false;
                }
            }
        });
    }
}

// chat

$(".l_user_chat").click(function() {
    $(".l_chat_botton").css('display', 'block');
    $(".l_chat_staff").hide(100);
});

$(".l_name_user_bottom_item2 ").click(function() {
    $(".l_chat_botton").css('display', 'none');
});


// update notify staff
$(".l_click_notify").click(function() {
    $(".l_staff_notify").css('display', 'block');
    var data = new FormData();
    status = 1;
    data.append('status', status);
    $.ajax({
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        // enctype: 'multipart/form-data',
        url: '/staff/StaffController/updateNotify',
        data: data,
        dataType: "JSON",
        async: false,
        success: function(data) {
            if (data.result == true) {
                $('#menu_notifi_dot').css('display', 'none');
            } else {
                return false;
            }
        }
    });
});

function deleteNotify() {
    var data = new FormData();
    var status = 1;
    data.append('status', status);
    $.ajax({
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        // enctype: 'multipart/form-data',
        url: '/staff/StaffController/deleteNotifystaff',
        data: data,
        dataType: "JSON",
        async: false,
        success: function(data) {
            if (data.result == true) {
                $('.l_delete_notify_staff').css('display', 'none');
            } else {
                return false;
            }
        }
    });
}


// notify company

$(".notify_company").click(function() {
    if ($(".l_staff_notify").css('display', 'block')) {
        var data = new FormData();
        status = 1;
        data.append('status', status);
        $.ajax({
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            // enctype: 'multipart/form-data',
            url: '/company/Company_controller/updateNotify',
            data: data,
            dataType: "JSON",
            async: false,
            success: function(data) {
                if (data.result == true) {
                    $('.l_dot_notify').css('display', 'none');
                } else {
                    return false;
                }
            }
        });
    }
});

function deleteNotifyCompany() {
    var data = new FormData();
    var status = 1;
    data.append('status', status);
    $.ajax({
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        // enctype: 'multipart/form-data',
        url: '/company/Company_controller/deleteNotifyCompany',
        data: data,
        dataType: "JSON",
        async: false,
        success: function(data) {
            if (data.result == true) {
                $('.l_delete').css('display', 'none');
            } else {
                return false;
            }
        }
    });
}