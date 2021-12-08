$(document).ready(function() {
    $(".d-cau-hinh2-v1a").select2({
        width: "100%",
    });
    $('.cau-hinh').change(function() {
        var arr_cau_hinh = [];
        $(".cau-hinh ").each(function() {
            if ($(this).is(":checked")) {
                arr_cau_hinh.push($(this).val());
            }
        });
        if (arr_cau_hinh.length > 0) {
            var data = new FormData();
            data.append('id', arr_cau_hinh);
            $.ajax({
                type: 'post',
                url: "/company/Company_controller/update_config",
                async: false,
                dataType: "JSON",
                contentType: false,
                processData: false,
                data: data,
                success: function(response) {
                    console.log(response);
                    if (response.result == true) {
                        $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {
                                location.reload();
                            });
                        }, 500);
                    } else {
                        return false;
                    }
                },

            });
        }
    });

});

function add_config_wifi() {
    $("#l_config_wifi").append('<div class="d-cau-hinh2 l_wifi" data-id="">' +
        '<div class="l_delete_config_wifi"><img src="/assets/images/Delete.svg" alt="xóa" class="l_img_delete_config l_curson" onClick="deletes(this)"></div>' +
        'Địa chỉ wifi:' +
        '<div class="row">' +
        '<div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3c">' +
        '<input type="text" class="d-ten-wifi name_wifi" value="" id="ten_wifi" name="ten_wifi" placeholder="Tên wifi">' +
        '</div>' +
        '<div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3c">' +
        '<input type="text" class="d-ten-wifi ip_wifi" id="ip_wifi" value="" name="ip_wifi" placeholder="IP wifi">' +
        '</div>' +
        '<div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3c">' +
        '<input type="text" class="d-ten-wifi mac" id="mac" value="" name="mac" placeholder="MAC">' +
        '</div>' +
        '<div class="col-md-12 col-sm-12 col-xs-12 error" id="err_wifi"></div>' +
        '</div>' +
        '</div><div class="error_cau_hinh error" tabindex=' + 1 + '></div>');
}

function deletes(e) {
    // dom_parent = $(e).parents('.l_wifi').remove();
    var id_wifi = $(e).parents('.l_wifi').attr('data-id');
    if (id_wifi == '') {
        $(e).parents('.l_wifi').remove();
    } else {
        var data = new FormData();
        data.append('id', id_wifi);
        $.ajax({
            type: 'post',
            url: "/company/Company_controller/delete_wifi",
            async: false,
            dataType: "JSON",
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                console.log(response);
                if (response.result == true) {
                    $(e).parents('.l_wifi').remove();
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
}

function cau_hinh() {
    var check = false;
    // if (arr_cau_hinh.length == 0) {
    //     $('#err_cauhinh').html('Vui lòng chọn cấu hình');
    //     $('#err_cauhinh').focus();
    //     return false;
    // } else {
    //     $('#err_cauhinh').html('');
    //     check = true;
    // }
    var arr_name_wifi = $('.name_wifi');
    var error_cau_hinh = $('.error_cau_hinh');
    var name_wifi = '';
    var arr_wifi_update = [];
    var arr_wifi_new = [];
    var cau_hinh_wifi = $('.l_wifi');
    for (var i = 0; i < arr_name_wifi.length; i++) {
        if (arr_name_wifi[i].value == '') {
            document.getElementsByClassName('error_cau_hinh')[i].innerText = "Vui lòng nhập đủ các trường!";
            arr_name_wifi[i].focus();
            return false;
        } else {
            document.getElementsByClassName('error_cau_hinh')[i].innerText = "";
            name_wifi += arr_name_wifi[i].value + '||';
            check = true;
        }
    }
    var arr_ip_wifi = $('.ip_wifi');
    var ip_wifi = '';
    for (var i = 0; i < arr_ip_wifi.length; i++) {
        if (arr_ip_wifi[i].value != '') {
            document.getElementsByClassName('error_cau_hinh')[i].innerText = "";
            ip_wifi += arr_ip_wifi[i].value + '||';
            check = true;
        } else {
            document.getElementsByClassName('error_cau_hinh')[i].innerText = "Vui lòng nhập đủ các trường!";
            arr_ip_wifi[i].focus();
            return false;
        }
    }
    var arr_mac = $('.mac');
    var mac = '';
    for (var i = 0; i < arr_mac.length; i++) {
        if (arr_mac[i].value != '') {
            document.getElementsByClassName('error_cau_hinh')[i].innerText = "";
            mac += arr_mac[i].value + '||';
            check = true;
        } else {
            document.getElementsByClassName('error_cau_hinh')[i].innerText = "Vui lòng nhập đủ các trường!";
            arr_mac[i].focus();
            return false;
        }
    }
    // var arr_lat = $('.lat');
    // var lat = '';
    // for (var i = 0; i < arr_lat.length; i++) {
    //     if (arr_lat[i].value != '') {
    //         document.getElementsByClassName('error_address')[i].innerText = "";
    //         lat += arr_lat[i].value + '||';
    //         check = true;
    //     } else {
    //         document.getElementsByClassName('error_address')[i].innerText = "Vui lòng nhập đủ các trường!";
    //         arr_lat[i].focus();
    //         return false;
    //     }
    // }

    // var arr_long = $('.long');
    // var long = '';
    // for (var i = 0; i < arr_long.length; i++) {
    //     if (arr_long[i].value != '') {
    //         document.getElementsByClassName('error_address')[i].innerText = "";
    //         long += arr_long[i].value + '||';
    //         check = true;
    //     } else {
    //         document.getElementsByClassName('error_address')[i].innerText = "Vui lòng nhập đủ các trường!";
    //         arr_long[i].focus();
    //         return false;
    //     }
    // }

    // var arr_address = $('.address1');
    // var address = '';
    // for (var i = 0; i < arr_address.length; i++) {
    //     if (arr_address[i].value != '') {
    //         document.getElementsByClassName('error_address')[i].innerText = "";
    //         address += arr_address[i].value + '||';
    //         check = true;
    //     } else {
    //         document.getElementsByClassName('error_address')[i].innerText = "Vui lòng nhập đủ các trường!";
    //         arr_address[i].focus();
    //         return false;
    //     }
    // }

    if (check == true) {
        for (var i = 0; i < cau_hinh_wifi.length; i++) {
            console.log(cau_hinh_wifi.eq(i).attr('data-id'));
            if (cau_hinh_wifi.eq(i).attr('data-id') != '') {
                arr_update = {
                    id_wifi: cau_hinh_wifi.eq(i).attr('data-id'),
                    name_wifi: cau_hinh_wifi.eq(i).find('.name_wifi').val(),
                    ip_wifi: cau_hinh_wifi.eq(i).find('.ip_wifi').val(),
                    mac: cau_hinh_wifi.eq(i).find('.mac').val(),
                };
                arr_wifi_update.push(arr_update);
            } else {
                arr_new = {
                    name_wifi: cau_hinh_wifi.eq(i).find('.name_wifi').val(),
                    ip_wifi: cau_hinh_wifi.eq(i).find('.ip_wifi').val(),
                    mac: cau_hinh_wifi.eq(i).find('.mac').val(),
                };
                arr_wifi_new.push(arr_new);
            }
        }
        var data = new FormData();
        var com_id = $('#cham_cong').val();
        data.append('wifi_update', JSON.stringify(arr_wifi_update));
        data.append('wifi_new', JSON.stringify(arr_wifi_new));
        $.ajax({
            type: 'post',
            url: "/company/Company_controller/update_wifi",
            async: false,
            dataType: "JSON",
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                console.log(response);
                if (response.result == true) {
                    $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                    setTimeout(function() {
                        $(".alert-success").fadeOut(1000, function() {});
                    }, 1500);
                } else {
                    return false;
                }
            },
            error: function(response) {
                $("#alert").append('<div class="alert-success_error">Cập nhật cấu hình thất bại</div>');
                setTimeout(function() {
                    $(".alert-success_error").fadeOut(1000, function() {});
                }, 1500);
            }
        });
    }
}

function showConfig() {
    var com_id = $('#cham_cong').val();
    if (com_id != '' && com_id != 0) {
        window.location.href = '/cau-hinh-cham-cong.html?com_id=' + com_id;
    } else {
        window.location.href = '/cau-hinh-cham-cong.html';
    }
}

function default_wifi(id) {
    if (id != '') {
        var data = new FormData();
        data.append('id', id);
        $.ajax({
            type: 'post',
            url: "/company/Company_controller/default_wifi",
            async: false,
            dataType: "JSON",
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                console.log(response);
                if (response.result == true) {
                    $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                    setTimeout(function() {
                        $(".alert-success").fadeOut(1000, function() {
                            location.reload();
                        });
                    }, 500);
                } else {
                    return false;
                }
            },
            error: function(response) {
                $("#alert").append('<div class="alert-success_error">Cập nhật wifi mặc định thất bại</div>');
                setTimeout(function() {
                    $(".alert-success_error").fadeOut(1000, function() {});
                }, 1500);
            }
        });
    }
}