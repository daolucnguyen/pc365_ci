function changeImg(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#cty_update_avatar').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$(document).ready(function () {
    $('.d-dropdown').hover(function () {
        $(this).attr('src', '/assets/images/them1.svg');
    },
        function () {
            $(this).attr('src', '/assets/images/them.svg');
        });

    $('#cty_update_avatar').click(function () {
        $('#input_cty_avatar').click();
    });
    $(".l_show").click(function () {
        $(this).next(".l_drop").slideToggle(250);
    });

});
$('#update_company').submit(function () {
    var name = $('#cty_update_name').val().trim();
    var phone = $('#cty_update_phone').val().trim();
    var address = $('#cty_update_address').val().trim();
    form_oke = false;
    var focusArr = [];

    if (name == '') {
        $('#val_name').html('Vui lòng nhập tên công ty');
        focusArr.push('#cty_update_name');
        form_oke = false;
    } else {
        $('#val_name').html('');
        form_oke = true;
    }

    if (phone == '') {
        $('#val_phone').html('Vui lòng nhập số điện thoại của bạn');
        focusArr.push('#cty_update_phone');
        form_oke = false;
    } else if (/((09|03|07|08|05)+([0-9]{8})\b)/g.test(phone) == false) {
        $('#val_phone').html('Số điện thoại của bạn không đúng định dạng!');
        focusArr.push('#cty_update_phone');
        form_oke = false;
    } else {
        $('#val_phone').html('');
        form_oke = true;
    }

    if (address == '') {
        $('#val_address').html('Vui lòng nhập địa chỉ của bạn');
        focusArr.push('#cty_update_address');
        form_oke = false;
    } else {
        $('#val_address').html('');
        form_oke = true;
    }
    var avatar = $('#input_cty_avatar').prop('files')[0];
    if (avatar != undefined) {
        var type = avatar.type;
        var match = ["image/gif", "image/png", "image/jpg", "image/jpeg", "image/jfif", "image/PNG"];
        if ((type == match[0] || type == match[1] || type == match[2] || type == match[3] || type == match[4] || type == match[5]) && avatar.size < 2097152) {
            if (avatar.size > 2097152) {
                $('#err_avt').html("Vui lòng tải lên ảnh nhỏ hơn 2000kb");
                form_oke = false;
                focusArr.push("#input_cty_avatar");
            }
        } else {
            $('#err_avt').html("Ảnh không hợp lệ, vui lòng chọn ảnh khác");
            form_oke = false;
            focusArr.push("#input_cty_avatar");
        }
    }

    $(focusArr[0]).focus();
    if (form_oke == true) {
        var data = new FormData();
        data.append('name', name);
        data.append('phone', phone);
        data.append('address', address);
        data.append('avatar', avatar);
        $.ajax({
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            url: "/company/Company_controller/update_ntd",
            data: data,
            dataType: "JSON",
            success: function (data) {
                if (data.result == true) {
                    window.location.href = "/thong-tin-cong-ty.html";
                }

            }
        });
    }
    return false;
});
$('#cty_update_name').change(function () {
    if ($(this) != '') {
        $('#val_name').html('');
    }
});
$('#cty_update_phone').change(function () {
    if ($(this) != '') {
        $('#val_phone').html('');
    }
});
$('#cty_update_address').change(function () {
    if ($(this) != '') {
        $('#val_address').html('');
    }
});


$('#cty_update_name').change(function () {
    if ($(this) != '') {
        $('#val_name').html('');
    }
});
$('#cty_update_phone').change(function () {
    if ($(this) != '') {
        $('#val_phone').html('');
    }
});
$('#cty_update_address').change(function () {
    if ($(this) != '') {
        $('#val_address').html('');
    }
});


function deletes(e) {
    dom_parent = $(e).parent().remove();
}