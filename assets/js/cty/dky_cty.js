$(document).ready(function() {
    $.validator.addMethod("telephone", function(value, element) {
        return this.optional(element) || /((09|03|07|08|05)+([0-9]{8})\b)/g.test(value);
    }, "Số điện thoại không đúng định dạng");
    $("#sign_up_company").validate({
        errorPlacement: function(error, element) {
            error.insertAfter(element);
            error.wrap("<div class='pc365-error'>")
        },
        rules: {
            email: {
                required: true,
                email: true,
                // check_mail: true,
            },
            pass: {
                required: true,
                minlength: 6,
            },
            re_pass: {
                required: true,
                minlength: 6,
                equalTo: "#pass",
            },
            ten_cty: {
                required: true,
                // check_name: true
            },
            sdt: {
                required: true,
                telephone: true,

            },
            dia_chi: "required",
        },
        messages: {
            email: {
                required: "Email không được để trống",
                email: "Email không đúng định dạng",
                // check_mail: "Email đã tồn tại",
            },
            pass: {
                required: "Mật khẩu không được để trống",
                minlength: "Vui lòng nhập ít nhất 6 ký tự",
            },
            re_pass: {
                required: "Mật khẩu nhập lại không được để trống",
                minlength: "Vui lòng nhập ít nhất 6 ký tự",
                equalTo: 'Mật khẩu không trùng khớp',
            },
            ten_cty: {
                required: "Tên công ty không được để trống",
                // check_name: "Tên công ty đã tồn tại",
            },
            sdt: {
                required: "Số điện thoại không được để trống",
            },
            dia_chi: "Địa chỉ không để trống",
        },
        submitHandler: function(form) {
            var com_email = $.trim($('#email').val());
            var com_pass = $.trim($('#pass').val());
            var com_name = $.trim($('#ten_cty').val());
            var com_phone = $.trim($('#sdt').val());
            var com_address = $.trim($('#dia_chi').val());
            var data = new FormData();
            data.append('com_email', com_email);
            data.append('com_pass', com_pass);
            data.append('com_name', com_name);
            data.append('com_phone', com_phone);
            data.append('com_address', com_address);
            $.ajax({
                url: "/company/Company_controller/sign_up_company",
                type: 'post',
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.result == 1) {
                        if (response.message == 'Thông tin email đăng ký đã tồn tại') {
                            $('#err_email').html(response.message);
                            $('#err_name').html('');
                        } else {
                            $('#err_name').html(response.message);
                            $('#err_email').html('');
                        }
                    } else if (response.result == 2) {
                        window.location.href = '/xac-thuc-dang-ky.html';
                    }
                },
            });
        }
    });

});

function istrim(evt) {
    var num = String.fromCharCode(evt.which);
    if (num == " ") {
        evt.preventDefault();
    }
}