$(document).ready(function() {
    $('#cong_ty').select2({
        placeholder: "Chọn công ty",
        width: "100%",
    });
    $('#chon_cty').select2({
        placeholder: "Chọn công ty mẹ",
        width: "100%",
    });
    $('#avatar').click(function() {
        $('#user-img').click()
    });
    $("#ten_cty").change(function() {
        if ($(this) == '' || $(this) == null) {
            $("#err_name").html("Tên công ty không được để trống");
        } else {
            $("#err_name").html("");
        }
    });
    $("#email").change(function() {
        if ($(this) == "") {
            $("#err_email").html("Email không được để trống");
        } else {
            $("#err_email").html("");
        }

    });
    $("#telephone").change(function() {
        if ($(this) == '' || $(this) == null) {
            $("#err_sdt").html("Sđt không được để trống");
        } else {
            $("#err_sdt").html("");
        }
    });
    $("#dia_chi").change(function() {
        if ($(this) == '' || $(this) == null) {
            $("#err_address").html("Địa chỉ không được để trống");
        } else {
            $("#err_address").html("");
        }
    });
    $("#ten_ctyy").change(function() {
        if ($(this) == '' || $(this) == null) {
            $("#err_namee").html("Tên công ty không được để trống");
        } else {
            $("#err_namee").html("");
        }
    });
    $("#emaill").change(function() {
        if ($(this) == "") {
            $("#err_emaill").html("Email không được để trống");
        } else {
            $("#err_emaill").html("");
        }

    });
    $("#telephonee").change(function() {
        if ($(this) == '' || $(this) == null) {
            $("#err_sdtt").html("Sđt không được để trống");
        } else {
            $("#err_sdtt").html("");
        }
    });
    $("#dia_chii").change(function() {
        if ($(this) == '' || $(this) == null) {
            $("#err_addresss").html("Địa chỉ không được để trống");
        } else {
            $("#err_addresss").html("");
        }
    });
    var l_check = true;
    $.validator.addMethod("telephone", function(value, element) {
        return this.optional(element) || /((09|03|07|08|05)+([0-9]{8})\b)/g.test(value);
    }, "Số điện thoại không đúng định dạng");
    $("#add_company").validate({
        errorPlacement: function(error, element) {
            error.insertAfter(element);
            error.wrap("<div class='pc365-error'>")
        },
        rules: {
            email: {
                required: true,
                email: true,
                // check_mail: true,
                // mail_small_com: true,
            },
            ten_cty: {
                required: true,
                // check_name: true
            },
            telephone: {
                required: true,
                telephone: true,

            },
            dia_chi: "required",
        },
        messages: {
            email: {
                required: "Email không được để trống",
                email: "Email không đúng định dạng",
                // check_mail: "Email này đã tồn tại",
                // mail_small_com: "Email này đã tồn tại",
            },
            ten_cty: {
                required: "Tên công ty không được để trống",
                // check_name: "Tên công ty đã tồn tại",
            },
            telephone: {
                required: "Số điện thoại không được để trống",
            },
            dia_chi: "Địa chỉ không để trống",
        },
        // submitHandler: function(form) {

        // }
    });

    $("#add_company").submit(function() {
        if (l_check == true) {
            $('#add_company_small').html('<span class="loading"></span>');
            var ten_cty = $.trim($(".ten-cty").val());
            var email = $.trim($(".email").val());
            var telephone = $.trim($(".telephone").val());
            var address = $.trim($(".dia-chi").val());

            var avatar = $('#user-img')[0].files[0];
            var data = new FormData()
            data.append('avatar', avatar);
            data.append('ten_cty', ten_cty);
            data.append('email', email);
            data.append('telephone', telephone);
            data.append('address', address);
            console.log(avatar)
            $.ajax({
                url: "/company/Company_controller/add_company_small",
                type: 'post',
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.result == 2) {
                        $("#them_cty").modal('hide');
                        $("#alert").append('<div class="alert-success">Thêm công ty con thành công</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(500, function() {
                                location.reload();
                            });
                        }, 500);
                    } else if (response.result == 3) {
                        $('#add_company_small').html('Tạo công ty');
                        $("#alert").append('<div class="alert-success_error">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success_error").fadeOut(500, function() {});
                        }, 2000);
                    }
                },
                // error: function(xhr) {
                //     // console.log(xhr);
                //     // alert('Error');
                // }
            });
        }
        return false;
    });
    $("#edit_company").submit(function() {
        var form_oke = true;
        var email_format = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        var telephone_format = /((09|03|07|08|05)+([0-9]{8})\b)/g;
        var ten_cty = $.trim($("#ten_ctyy").val());
        var email = $.trim($(".email").val());
        var telephone = $.trim($("#telephonee").val());
        var address = $.trim($("#dia_chii").val());
        var id = $("#id_com").val();
        var form_data = new FormData();
        var arr_id_to_focus = [];
        form_data.append('id', id);

        if (ten_cty == "" || ten_cty == null) {
            $("#err_namee").html("Tên công ty không được để trống");
            arr_id_to_focus.push(".ten-cty");
            form_oke = false;
        } else {
            $("#err_namee").html("");
            form_data.append('ten_cty', ten_cty);
        }
        if (telephone == '' || telephone == null) {
            $('#err_sdtt').html('Bạn chưa nhập số điện thoại');
            form_oke = false;
            arr_id_to_focus.push(".telephone");
        } else {
            if (telephone.match(telephone_format) == null) {
                $('#err_sdtt').html('Số điện thoại không đúng định dạng');
                form_oke = false;
                arr_id_to_focus.push(".telephone");
            } else {
                $('#err_sdtt').html('');
                form_data.append('telephone', telephone);
            }
        }
        if (address == '' || address == null) {
            $('#err_addresss').html('Bạn chưa nhập địa chỉ');
            form_oke = false;
            arr_id_to_focus.push("#dia_chi");
        } else {
            $('#err_addresss').html('');
            form_data.append('address', address);
        }
        var avatar = $('#user-img1').prop('files')[0];
        if (avatar != undefined) {
            var type = avatar.type;
            var match = ["image/gif", "image/png", "image/jpg", "image/jpeg", "image/jfif", "image/PNG"];
            if ((type == match[0] || type == match[1] || type == match[2] || type == match[3] || type == match[4] || type == match[5]) && avatar.size < 2097152) {
                if (avatar.size > 2097152) {
                    $('#err_img_update').html("Vui lòng tải lên ảnh nhỏ hơn 2000kb");
                    form_oke = false;
                    arr_id_to_focus.push("#err_img_update");
                } else {
                    form_data.append('avatar', avatar);
                    $('#err_img_update').html("");
                }
            } else {
                $('#err_img_update').html("Ảnh không hợp lệ, vui lòng chọn ảnh khác");
                form_oke = false;
                arr_id_to_focus.push("#err_img_update");
            }
        }
        $(arr_id_to_focus[0]).focus();
        if (form_oke == true) {
            $('#edit_company_small').html('<span class="loading"></span>');
            $.ajax({
                type: 'post',
                url: "/company/Company_controller/updateComSmall",
                async: false,
                dataType: "JSON",
                contentType: false,
                processData: false,
                data: form_data,
                success: function(response) {
                    // console.log(response);
                    if (response.result == 2) {
                        $("#them_cty").modal('hide');
                        $("#alert").append('<div class="alert-success">Cập nhật công ty con thành công</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(500, function() {
                                location.reload();
                            });
                        }, 500);
                    } else if (response.result == 3) {
                        $('#edit_company_small').html('Cập nhật');
                        $("#alert").append('<div class="alert-success_error">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success_error").fadeOut(500, function() {});
                        }, 2000);
                    }
                },

            });
        }
        return false;
    });
});

function l_deleteSmall(id) {
    if (confirm('Bạn có chắc muốn xóa công ty này?')) {
        var data = new FormData();
        data.append('id', id);
        $.ajax({
            type: 'post',
            url: "/company/Company_controller/delete_company_small",
            async: false,
            dataType: "JSON",
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                console.log(response);
                if (response.result == true) {
                    $("#comsmall" + id).remove();
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

function infoCompany(id) {
    var data = new FormData();
    data.append('id', id);
    $.ajax({
        url: "/company/Company_controller/detailCompanySmall",
        type: 'post',
        data: data,
        contentType: false,
        processData: false,
        dataType: "JSON",
        async: false,
        success: function(response) {
            if (response.result == true) {
                $("#ten_ctyy").val(response.info.com_name);
                $("#emaill").val(response.info.com_email);
                $("#telephonee").val(response.info.com_phone);
                $("#dia_chii").val(response.info.com_address);
                if (response.info.com_logo != "") {
                    var html = `<img src="https://chamcong.24hpay.vn/upload/company/logo/` + response.info.com_logo + `" onerror='this.onerror=null;this.src="/assets/images/logo_com.png ";'class="img-user" id="avatar1" alt="logo công ty">`;
                    $(".dom_img").html(html);
                }
                $("#id_com").val(response.info.com_id);
            } else {
                return false;
            }
        },

    });
}

function timkiem(e) {
    var congty = $('#cong_ty').val();
    if (congty != 0) {
        window.location.href = '/danh-sach-cong-ty-con.html?congty=' + congty;
    }

}