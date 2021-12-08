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
});

function timkiem() {
    var name = $('#search').val();
    var cty = $('#chi_nhanh').val();
    var phong_ban = $('#phong_ban').val();

    if ($('#chi_nhanh1').val() != '') {
        cty = $('#chi_nhanh1').val();
    }

    if ($('#phong_ban1').val() != '') {
        phong_ban = $('#phong_ban1').val();
    }

    if (name != '' && cty != '' && phong_ban != '') {
        window.location.href = '/quan-ly-nhan-dien-khuon-mat.html?keyWord=' + name + '&cty=' + cty + '&phong_ban=' + phong_ban;
    } else if (name == '' && cty != '' && phong_ban != '') {
        window.location.href = '/quan-ly-nhan-dien-khuon-mat.html?cty=' + cty + '&phong_ban=' + phong_ban;
    } else if (name != '' && cty != '' && phong_ban == '') {
        window.location.href = '/quan-ly-nhan-dien-khuon-mat.html?keyWord=' + name + '&cty=' + cty;
    } else if (name != '' && cty == '' && phong_ban == '') {
        window.location.href = '/quan-ly-nhan-dien-khuon-mat.html?keyWord=' + name
    } else if (name == '' && cty != '' && phong_ban == '') {
        window.location.href = '/quan-ly-nhan-dien-khuon-mat.html?cty=' + cty;
    } else {
        window.location.href = '/quan-ly-nhan-dien-khuon-mat.html';
    }
}

function update_face(ep_id) {
    if (ep_id != 0) {
        var data = new FormData();
        data.append('ep_id', ep_id);
        $.ajax({
            url: '/company/company_controller/update_face',
            type: 'post',
            async: false,
            dataType: "JSON",
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                if (response.result == true) {
                    $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                    setTimeout(function() {
                        $(".alert-success").fadeOut(500, function() {});
                    }, 2500);
                } else {
                    $("#alert").append('<div class="alert-success_error">' + response.message + '</div>');
                    setTimeout(function() {
                        $(".alert-success_error").fadeOut(500, function() {});
                    }, 2000);
                }
            }
        });
    }
}