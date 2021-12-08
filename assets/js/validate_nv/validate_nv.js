function checkEmailExits(email) {
    $.ajax({
        url: '/staff/StaffRegisterController/staff_register_checkemail',
        type: 'post',
        dataType: "json",
        async: false,
        data: {
            email: email
        },
        success: function(data) {

            if (data.status == 'false') {
                // $('#val_dk2_email').html('Email này đã được sử dụng');
                emailOK = false;
            } else {
                emailOK = true;
            }
        }
    });
    return emailOK;
}

$(document).ready(function() {
    // dky 1

    var emailOK = true;
    var date = new Date();
    var day = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
    // $('#input_email_2').change(function() {
    //     var email = $('#input_email_2').val().trim();
    //     if ($(this) != '') {
    //         $('#val_dk2_email').html('');
    //         checkEmailExits(email);
    //     } else {
    //         $('#val_dk2_email').html('Nhập email vào ô tương ứng');
    //     }
    // });
    $('#form_dk1').submit(function(event) {
        event.preventDefault();
        var id = $('#form_input_1').val().trim();
        if (id == '') {
            $('.val_error').html('Không được để trống');
            $('#form_input_1').focus();
            return false;
        } else {
            if (isNaN(id)) {
                $('.val_error').html('ID phải là số');
                $('#form_input_1').focus();
                return false;
            } else {
                $.ajax({
                    url: '/staff/StaffRegisterController/staff_register_checkid',
                    type: 'post',
                    dataType: "json",
                    data: {
                        id_company: id
                    },
                    success: function(data) {
                        if (data.result == true) {
                            $('.q-form-regis-1').hide();
                            $('.q-form-regis-2').show();
                            $('.q-form-regis-3').hide();
                            $('.q-form-regis-4').hide();
                        } else {
                            $('.val_error').html('Mã ID công ty không chính xác');
                            $('#form_input_1').focus();
                        }
                    }
                });
            }
        }
    });
    $('#form_input_1').change(function() {
        if ($(this) != '') {
            $('.val_error').html('');
        }
    });


    // load phòng ban chức vụ
    $('#q-submit-regis-1').click(function(event) {
        var id = $('#form_input_1').val().trim();
        if (id != "") {
            $.ajax({
                url: '/staff/StaffRegisterController/getListDepartment',
                type: 'post',
                dataType: "json",
                data: {
                    id_company: id
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#input_phongban_2').append('<option value="' + data[i].id + '">' + data[i].name_department + '</option>');
                    }
                }
            });

            $.ajax({
                url: '/staff/StaffRegisterController/getListPosition',
                type: 'post',
                dataType: "json",
                data: {
                    id_company: id
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#input_chucvu_2').append('<option value="' + data[i].id + '">' + data[i].name_position + '</option>');
                    }
                }
            });
        }
    });

    // dky2
    // $("#input_email_2").blur(function() {
    //     var email = $('#input_email_2').val().trim();
    //     if (email.indexOf("@") < 1 || email.lastIndexOf(".") < (email.indexOf("@") + 2) || (email.lastIndexOf(".") + 2) >= email.length) {
    //         $('#val_dk2_email').html('Email không đúng định dạng');
    //         $("#input_email_2").focus();
    //         return false;
    //     }
    // });
    $('#form_dky_2').submit(function(event) {
        event.preventDefault();
        var form_oke = true;
        var id = $('#form_input_1').val().trim();
        var email = $('#input_email_2').val().trim();
        var pass = $('#input_pass_2').val().trim();
        var re_pass = $('#input_repass_2').val().trim();
        var name = $('#input_name_2').val().trim();
        var phone = $('#input_phone_2').val().trim();
        var address = $('#input_address').val().trim();
        var gender = $('#input_gender').val().trim();
        var brith = $('#input_brith').val().trim();
        var marriage = $('#input_marriage_2').val().trim();
        var education = $('#input_education_2').val().trim();
        var experience = $('#input_experience_2').val().trim();
        var date_join = $('#input_date_join').val().trim();
        var phongban = $('#input_phongban_2').val().trim();
        var group = $('#input_group_2').val().trim();
        var nest = $('#input_nest_2').val().trim();
        var chucvu = $('#input_chucvu_2').val().trim();
        var data = new FormData();
        var focusArr = [];



        if (email == '') {
            $('#val_dk2_email').html('Vui lòng nhập Email của bạn');
            focusArr.push('#input_email_2');
            form_oke = false;
        } else {
            if (email.indexOf("@") < 1 || email.lastIndexOf(".") < (email.indexOf("@") + 2) || (email.lastIndexOf(".") + 2) >= email.length) {
                $('#val_dk2_email').html('Email không đúng định dạng');
                focusArr.push('#input_email_2');
                form_oke = false;
            } else {
                $('#val_dk2_email').html('');
                data.append('email', email);
            }
        }

        if (pass.length == 0) {
            $('#val_dk2_pass').html('Vui lòng nhập mật khẩu');
            focusArr.push('#input_pass_2');
            form_oke = false;
        } else if (pass.length < 6) {
            $('#val_dk2_pass').html('Mật khẩu có tối thiểu 6 kí tự');
            focusArr.push('#input_pass_2');
            form_oke = false;
        } else {
            $('#val_dk2_pass').html('');
        }

        if (re_pass.length == 0) {
            $('#val_dk2_repass').html('Mật khẩu có tối thiểu 6 kí tự');
            focusArr.push('#input_repass_2');
            form_oke = false;
        } else if (re_pass != pass) {
            $('#val_dk2_repass').html('Mật khẩu nhập lại không đúng');
            focusArr.push('#input_repass_2');
            form_oke = false;
        } else {
            $('#val_dk2_repass').html('');
            data.append('pass', re_pass);
        }

        if (name == '') {
            $('#val_dk2_name').html('Vui lòng nhập tên của bạn');
            focusArr.push('#input_name_2');
            form_oke = false;
        } else {
            $('#val_dk2_name').html('');
            data.append('name', name);
        }

        if (phone == '') {
            $('#val_dk2_phone').html('Bạn chưa nhập số điện thoại');
            focusArr.push('#input_phone_2');
            form_oke = false;
        } else if (/((09|03|07|08|05)+([0-9]{8})\b)/g.test(phone) == false) {
            $('#val_dk2_phone').html('Số điện thoại của bạn không đúng định dạng!');
            focusArr.push('#input_phone_2');
            form_oke = false;
        } else {
            $('#val_dk2_phone').html('');
            data.append('phone', phone);
        }

        if (address == '') {
            $('#val_dk2_address').html('Bạn nhập địa chỉ');
            focusArr.push('#input_address');
            form_oke = false;
        } else {
            $('#val_dk2_address').html('');
            data.append('address', address);
        }
        if (gender == '') {
            $('#val_dk2_gender').html('Bạn chọn giới tính');
            focusArr.push('#input_gender');
            form_oke = false;
        } else {
            $('#val_dk2_gender').html('');
            data.append('gender', gender);
        }

        if (brith == '') {
            $('#val_dk2_brith').html('Bạn nhập ngày sinh');
            focusArr.push('#input_marriage_2');
            form_oke = false;
        } else {
            $('#val_dk2_brith').html('');
            data.append('brith', brith);
        }

        if (marriage == '') {
            $('#val_marriage_cv').html('Bạn chọn tình trạng hôn nhân');
            focusArr.push('#input_marriage_2');
            form_oke = false;
        } else {
            $('#val_marriage_cv').html('');
            data.append('marriage', marriage);
        }

        if (education == '') {
            $('#val_dk2_education').html('Bạn chọn trình độ học vấn');
            focusArr.push('#input_education_2');
            form_oke = false;
        } else {
            $('#val_dk2_education').html('');
            data.append('education', education);
        }

        if (experience == '') {
            $('#val_experience_pb').html('Bạn chưa chọn kinh nghiệm làm việc');
            focusArr.push('#input_experience_2');
            form_oke = false;
        } else {
            $('#val_experience_pb').html('');
            data.append('experience', experience);
        }

        if (date_join == '') {
            $('#val_dk2_date_join').html('Bạn chưa chọn ngày bắt đầu làm việc');
            focusArr.push('#input_date_join');
            form_oke = false;
        } else {
            if (date_join < day) {
                $('#val_dk2_date_join').html('Ngày bắt đầu không được nhỏ hơn ngày hiện tại');
                focusArr.push('#input_date_join');
                form_oke = false;
            } else {
                $('#val_dk2_date_join').html('');
                data.append('date_join', date_join);
            }
        }

        if (phongban == '') {
            $('#val_dk2_pb').html('Bạn chưa lựa chọn phòng ban');
            focusArr.push('#input_phongban_2');
            form_oke = false;
        } else {
            $('#val_dk2_pb').html('');
            data.append('department', phongban);
        }

        if (chucvu == '') {
            $('#val_dk2_cv').html('Bạn chưa lựa chọn chức vụ');
            focusArr.push('#input_chucvu_2');
            form_oke = false;
        } else {
            $('#val_dk2_cv').html('');
            data.append('position', chucvu);
        }
        if (form_oke == true) {
            $('#input-submit-2').html('<span class="loading"></span>');
            $('#input-submit-2').attr('type', 'button');
            data.append('id', id);
            data.append('group', group);
            data.append('nest', nest);
            $.ajax({
                url: '/staff/StaffRegisterController/insert',
                type: 'post',
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.result == 2) {
                        $('#input-submit-2').html('Tiếp tục');
                        $('#input-submit-2').attr('type', 'submit');
                        $('#val_dk2_email').html('Email đã tồn tại');
                    } else if (response.result == 3) {
                        $("#alert").append('<div class="alert-success">Đăng ký tài khoản thành công. Vui lòng kiểm tra email.</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {});
                        }, 1000);
                        $('.q-form-regis-1').hide();
                        $('.q-form-regis-2').hide();
                        $('.q-form-regis-3').show();
                        $('.q-form-regis-4').hide();
                    }
                }
            });
        } else {
            $(focusArr[0]).focus();
        }
        return false;
    });

    $('#input_email_2').change(function() {
        if ($(this) != '' && $(this).val().indexOf("@") >= 1 && $(this).val().lastIndexOf(".") >= ($(this).val().indexOf("@") + 2) && ($(this).val().lastIndexOf(".") + 2) < $(this).val().length) {
            $('#val_dk2_email').html('');
        }
    });
    $('#input_pass_2').change(function() {
        if ($(this) != '') {
            $('#val_dk2_pass').html('');
        }
    });
    $('#input_repass_2').change(function() {
        if ($(this) != '' && $(this).val() == $('#input_pass_2').val()) {
            $('#val_dk2_repass').html('');
        }
    });
    $('#input_name_2').change(function() {
        if ($(this) != '') {
            $('#val_dk2_name').html('');
        }
    });
    $('#input_phone_2').change(function() {
        if ($(this) != '') {
            $('#val_dk2_phone').html('');
        }
    });
    $('#input_phongban_2').change(function() {
        if ($(this) != '') {
            $('#val_dk2_pb').html('');
        }
    });
    $('#input_chucvu_2').change(function() {
        if ($(this) != '') {
            $('#val_dk2_cv').html('');
        }
    });
    $('#input_gender').change(function() {
        if ($(this) != '') {
            $('#val_dk2_gender').html('');
        }
    });
    $('#input_brith').change(function() {
        if ($(this) != '') {
            $('#val_dk2_brith').html('');
        }
    });
    $('#input_marriage_2').change(function() {
        if ($(this) != '') {
            $('#val_marriage_cv').html('');
        }
    });
    $('#input_education_2').change(function() {
        if ($(this) != '') {
            $('#val_dk2_education').html('');
        }
    });
    $('#input_experience_2').change(function() {
        if ($(this) != '') {
            $('#val_experience_pb').html('');
        }
    });
    $('#input_date_join').change(function() {
        if ($(this) != '' && $(this).val() >= day) {
            $('#val_dk2_date_join').html('');
        }
    });
    $('#input_address').change(function() {
        if ($(this).val() != '') {
            $('#val_dk2_address').html('');
        }
    });

    $('#input_phongban_2').change(function() {
        var dep_id = $(this).val();
        var data = new FormData();
        if (dep_id != 0) {
            var com_id = $('.q-form-input-1').val();
            data.append('dep_id', dep_id);
            data.append('com_id', com_id);
            $.ajax({
                url: '/staff/StaffRegisterController/show_nest_by_id_dep',
                type: 'post',
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response.result == true) {
                        $('.remove_nest').remove();
                        for (var i = 0; i < response.list_nest.length; i++) {
                            $('#input_nest_2').append(` <option class="remove_nest" value="` + response.list_nest[i].gr_id + `">` + response.list_nest[i].gr_name + `</option>`);
                        }
                    }
                }
            });
        }
    })

    $('#input_nest_2').change(function() {
        var nest_id = $(this).val();
        var data = new FormData();
        if (nest_id != 0) {
            var com_id = $('.q-form-input-1').val();
            data.append('nest_id', nest_id);
            data.append('com_id', com_id);
            $.ajax({
                url: '/staff/StaffRegisterController/show_group_by_id_nest',
                type: 'post',
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response.result == true) {
                        $('.remove_group').remove();
                        for (var i = 0; i < response.list_nest.length; i++) {
                            $('#input_group_2').append(` <option class="remove_group" value="` + response.list_nest[i].gr_id + `">` + response.list_nest[i].gr_name + `</option>`);
                        }
                    }
                }
            });
        }
    })

    // nhap otp
    $('.q-form-3').submit(function(event) {
        event.preventDefault();
        var otp1 = $("#input_3_1").val();
        var otp2 = $("#input_3_2").val();
        var otp3 = $("#input_3_3").val();
        var otp4 = $("#input_3_4").val();
        var otp5 = $("#input_3_5").val();
        var otp6 = $("#input_3_6").val();
        var email = $('.input_email_2').val().trim();
        if (otp1 == '' && otp2 == '' && otp3 == '' && otp4 == '' && otp5 == '' && otp6 == '') {
            $('#val_dk3').html('Vui lòng nhập mã OTP được gửi qua Email của bạn');
            $('#input-reform-2').click();
            $("#input_3_1").focus();
            return false;
        }
        if (otp1 == '' || otp2 == '' || otp3 == '' || otp4 == '' || otp5 == '' || otp6 == '') {
            $('#val_dk3').html('Vui lòng nhập đầy đủ mã OTP');
            $('#input-reform-2').click();
            $("#input_3_1").focus();
            return false;
        }
        $.ajax({
            url: '/staff/StaffRegisterController/staff_register_checkotp',
            type: 'POST',
            dataType: 'json',
            data: {
                email: email,
                otp1: otp1,
                otp2: otp2,
                otp3: otp3,
                otp4: otp4,
                otp5: otp5,
                otp6: otp6
            },
            success: function(data) {
                if (data.result == 2) {
                    $('.q-form-regis-1').hide();
                    $('.q-form-regis-2').hide();
                    $('.q-form-regis-3').hide();
                    $('.q-form-regis-4').show();
                } else if (data.result == 1) {
                    $('#val_dk3').html('Mã OTP không chính xác');
                }
            }
        });

        $('#input_3_1').change(function() {
            if ($(this) != '') {
                $('#val_dk3').html('');
            }
        });
    });


    $('.q-form-4').submit(function(event) {
        event.preventDefault();
        var file_name = '';
        var email = $('.input_email_2').val().trim();
        var countFiles = $('#file-input')[0].files.length;
        for (var i = 0; i < countFiles; i++) {
            file_name += $('#file-input')[0].value.substring($('#file-input')[0].value.lastIndexOf('\\') + 1).toLowerCase();
        }
        $.ajax({
            url: '/staff/StaffRegisterController/staff_regis_step4',
            type: 'POST',
            dataType: 'json',
            data: {
                email: email,
                img: file_name
            },
            success: function(data) {
                if (data.result == true) {
                    window.location.href = '/dang-nhap.html';
                } else {
                    alert('Error');
                    return false;
                }
            }
        });
    });

    // quên mk 1
    $('.q-qmk-form').submit(function(event) {
        // event.preventDefault();
        var email = $('.q-qmk-form-input').val().trim();
        if (email == '') {
            $('#val_qmk1').html('Vui lòng nhập Email của bạn');
            $('.q-qmk-form-input').focus();
            return false;
        } else if (email.indexOf("@") < 1 || email.lastIndexOf(".") < (email.indexOf("@") + 2) || (email.lastIndexOf(".") + 2) >= email.length) {
            $('#val_qmk1').html('Email không đúng định dạng');
            $('.q-qmk-form-input').focus();
            return false;
        }
        $('.send_mail_forgot_pass').html('<span class="loading"></span>');
        $.ajax({
            url: '/staff/StaffLoginController/staff_getpass1',
            type: 'post',
            dataType: "json",
            data: {
                email: email
            },
            success: function(data) {
                if (data.result == true) {
                    $("#getpass_step1").hide();
                    $("#getpass_step2").show();
                    $("#getpass_step3").hide();
                } else if (data.result == false) {
                    $('.send_mail_forgot_pass').html('<span>Gửi Email Xác Thực</span>');
                    $('#val_qmk1').html('Không có địa chỉ Email nào trùng khớp');
                    return false;
                }
            }
        });
        return false;
    });
    $('.q-qmk-form-input').change(function() {
        if ($(this) != '') {
            $('#val_qmk1').html('');
        }
    });

    // quên mật khẩu 2
    $('.q-qmk-form-2').submit(function(event) {
        event.preventDefault();
        var email = $('.q-qmk-form-input').val().trim();
        var otp1 = $("#input_2_1").val();
        var otp2 = $("#input_2_2").val();
        var otp3 = $("#input_2_3").val();
        var otp4 = $("#input_2_4").val();
        var otp5 = $("#input_2_5").val();
        var otp6 = $("#input_2_6").val();
        if (otp1 == '' && otp2 == '' && otp3 == '' && otp4 == '' && otp5 == '' && otp6 == '') {
            $('#val_qmk2').html('Vui lòng nhập mã OTP được gửi qua Email của bạn');
            $('#input-reform-2').click();
            $("#input_2_1").focus();
            return false;
        }
        if (otp1 == '' || otp2 == '' || otp3 == '' || otp4 == '' || otp5 == '' || otp6 == '') {
            $('#val_qmk2').html('Vui lòng nhập đầy đủ mã OTP');
            $('#input-reform-2').click();
            $("#input_2_1").focus();
            return false;
        }
        $.ajax({
            url: '/staff/StaffRegisterController/staff_register_checkotp',
            type: 'POST',
            dataType: 'json',
            data: {
                email: email,
                otp1: otp1,
                otp2: otp2,
                otp3: otp3,
                otp4: otp4,
                otp5: otp5,
                otp6: otp6
            },
            success: function(data) {
                if (data.result == 2) {
                    $("#getpass_step1").hide();
                    $("#getpass_step2").hide();
                    $("#getpass_step3").show();
                } else if (data.result == 1) {
                    $('#val_dk3').html('Mã OTP không chính xác');
                    $('#val_qmk2').html('Mã OTP không chính xác');
                }
            }
        });
    });

    $('#input_2_1').change(function() {
        if ($(this) != '') {
            $('#val_qmk2').html('');
        }
    });

    // quên mật khẩu 3
    $('.q-qmk-form-3').submit(function(event) {
        event.preventDefault();
        var pass = $('#qmk_pass1').val().trim();
        var re_pass = $('#qmk_pass2').val().trim();
        var email = $('.q-qmk-form-input').val().trim();
        var otp1 = $("#input_2_1").val();
        var otp2 = $("#input_2_2").val();
        var otp3 = $("#input_2_3").val();
        var otp4 = $("#input_2_4").val();
        var otp5 = $("#input_2_5").val();
        var otp6 = $("#input_2_6").val();
        form_oke = true;
        var focusArr = [];

        if (pass.length == 0) {
            $('#val_qmk3_pass').html('Vui lòng nhập mật khẩu');
            focusArr.push('#qmk_pass1');
            form_oke = false;
        } else if (pass.length < 6) {
            $('#val_qmk3_pass').html('Mật khẩu có tối thiểu 6 kí tự');
            focusArr.push('#qmk_pass1');
            form_oke = false;
        } else {
            $('#val_qmk3_pass').html('');
        }

        if (re_pass.length == 0) {
            $('#val_qmk3_repass').html('Mật khẩu có tối thiểu 6 kí tự');
            focusArr.push('#qmk_pass2');
            form_oke = false;
        } else if (re_pass != pass) {
            $('#val_qmk3_repass').html('Mật khẩu nhập lại không đúng');
            focusArr.push('#qmk_pass2');
            form_oke = false;
        } else {
            $('#val_qmk3_repass').html('');
        }
        if (form_oke == true) {
            $.ajax({
                url: '/staff/StaffLoginController/staff_getpass3',
                type: 'POST',
                dataType: 'json',
                data: {
                    email: email,
                    pass: pass,
                    otp1: otp1,
                    otp2: otp2,
                    otp3: otp3,
                    otp4: otp4,
                    otp5: otp5,
                    otp6: otp6,
                },
                success: function(data) {
                    if (data.result == true) {
                        alert('Đổi mật khẩu thành công');
                        window.location.href = '/dang-nhap.html';
                    } else if (data.result == false) {
                        return false;
                    }
                }
            });
        }
        $(focusArr[0]).focus();
        return false;
    });

    $('#qmk_pass1').change(function() {
        if ($(this) != '') {
            $('#val_qmk3_pass').html('');
        }
    });
    $('#qmk_pass2').change(function() {
        if ($(this) != '') {
            $('#val_qmk3_repass').html('');
        }
    });


    // cập nhật thông tin nv
    $("#update_staff").submit(function() {
        var focusArr = [];
        var name = $('#update_name').val().trim();
        var data = new FormData();
        var phone = $('#update_phone').val().trim();
        var avatar = $('#input_avatar').prop('files')[0];
        var form_oke = true;
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
        if (name == '') {
            $('#val_update_name').html('Vui lòng nhập họ tên của bạn');
            focusArr.push('#update_name');
            form_oke = false;
        } else {
            $('#val_update_name').html('');
        }
        if (phone == '') {
            $('#val_update_phone').html('Vui lòng nhập số điện thoại của bạn');
            focusArr.push('#update_phone');
            form_oke = false;
        } else if (/((09|03|07|08|05)+([0-9]{8})\b)/g.test(phone) == false) {
            $('#val_update_phone').html('Số điện thoại của bạn không đúng định dạng!');
            focusArr.push('#update_phone');
            form_oke = false;
        } else {
            $('#val_update_phone').html('');
        }
        if (form_oke == true) {
            data.append('name', name);
            data.append('phone', phone);
            data.append('avatar', avatar);
            $.ajax({
                type: 'post',
                url: "/staff/StaffController/updateStaff",
                async: false,
                dataType: "JSON",
                enctype: 'multipart/form-data',
                contentType: false,
                processData: false,
                data: data,
                success: function(response) {
                    if (response.result == true) {
                        $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {});
                        }, 1000);
                        $('#menu_profile').attr('src', response.avatar);
                    } else {
                        return false;
                    }
                },
            });
        }
        $(focusArr[0]).focus();
        return false;
    });

    $('#update_name').change(function() {
        if ($(this) != '') {
            $('#val_update_name').html('');
        }
    });
    $('#update_phone').change(function() {
        if ($(this) != '') {
            $('#val_update_phone').html('');
        }
    });
    $('#update_phongban').change(function() {
        if ($(this) != '') {
            $('#val_update_phongban').html('');
        }
    });
    $('#update_chucvu').change(function() {
        if ($(this) != '') {
            $('#val_update_chucvu').html('');
        }
    });

    // đổi mật khẩu
    $('#updatePass').submit(function(event) {
        event.preventDefault();
        var old_pass = $('#cty_old_pass').val().trim();
        var new_pass = $('#cty_new_pass').val().trim();
        var re_new_pass = $('#cty_re_new_pass').val().trim();
        form_oke = true;
        var data = new FormData();
        var focusArr = [];

        if (old_pass == '') {
            $('#val_dmk_old').html('Vui lòng nhập mật khẩu hiện tại');
            focusArr.push('#cty_old_pass');
            form_oke = false;
        } else {
            if (old_pass.length < 6) {
                $('#val_dmk_old').html('Mật khẩu có tối thiểu 6 kí tự');
                focusArr.push('#cty_old_pass');
                form_oke = false;
            }
        }

        if (new_pass == '') {
            $('#val_dmk_new').html('Vui lòng nhập mật khẩu mới');
            focusArr.push('#cty_new_pass');
            form_oke = false;
        } else {
            if (new_pass.length < 6) {
                $('#val_dmk_new').html('Mật khẩu có tối thiểu 6 kí tự');
                focusArr.push('#cty_new_pass');
                form_oke = false;
            }
        }

        if (re_new_pass == '') {
            $('#val_dmk_renew').html('Vui lòng nhập lại mật khẩu mới');
            focusArr.push('#cty_re_new_pass');
            form_oke = false;
        } else {
            if (re_new_pass.length < 6) {
                $('#val_dmk_renew').html('Mật khẩu có tối thiểu 6 kí tự');
                focusArr.push('#cty_re_new_pass');
                form_oke = false;
            } else {
                if (re_new_pass != new_pass) {
                    $('#val_dmk_renew').html('Mật khẩu nhập lại không đúng');
                    focusArr.push('#cty_re_new_pass');
                    form_oke = false;
                }
            }
        }
        if (form_oke == true) {
            data.append('old_pass', old_pass);
            data.append('new_pass', new_pass);
            $.ajax({
                type: 'post',
                url: "/staff/StaffController/updatePass",
                async: false,
                dataType: "JSON",
                enctype: 'multipart/form-data',
                contentType: false,
                processData: false,
                data: data,
                success: function(response) {
                    if (response.result == true) {
                        $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {});
                        }, 1500);
                        $('#cty_old_pass').val('');
                        $('#cty_new_pass').val('');
                        $('#cty_re_new_pass').val('');
                    } else {
                        $("#alert").append('<div class="alert-success_error">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success_error").fadeOut(1000, function() {});
                        }, 2500);
                        $('#cty_old_pass').focus();
                    }
                },

            });
        }
        $(focusArr[0]).focus();
        return false;
    });

    $('#cty_old_pass').change(function() {
        if ($(this) != '') {
            $('#val_dmk_old').html('');
        }
    });
    $('#cty_new_pass').change(function() {
        if ($(this) != '') {
            $('#val_dmk_new').html('');
        }
    });
    $('#cty_re_new_pass').change(function() {
        if ($(this) != '') {
            $('#val_dmk_renew').html('');
        }
    });


    // cập nhật thông tin công ty


    // báo lỗi công ty
    // $('.q-cty-baoloi').submit(function() {
    //     var img = $('#cty_baoloi_input_img').val();
    //     var content = $('#cty_baoloi_text').val().trim();
    //     form_oke = true;
    //     var focusArr = [];

    //     if (img == '') {
    //         $('#val_baoloi_img').html('Cần tải ảnh lên');
    //         focusArr.push('#cty_baoloi_input_img');
    //         form_oke = false;
    //     } else if (img.length < 3) {
    //         $('#val_baoloi_img').html('Cần tải ít nhất 3 ảnh lên');
    //         focusArr.push('#cty_baoloi_input_img');
    //         form_oke = false;
    //     }

    //     if (content == '') {
    //         $('#val_baoloi_text').html('Vui lòng nhập chi tiết lỗi');
    //         focusArr.push('#cty_baoloi_text');
    //         form_oke = false;
    //     }

    //     if (img.length > 2 && content != '') {
    //         $('#submit_baoloi_modal').click();
    //         $('#reform_baoloi').click();
    //         $('#val_baoloi_img').html('');
    //         $('#val_baoloi_text').html('');
    //     }

    //     $(focusArr[0]).focus();
    //     $('#submit_baoloi').click(function() {
    //         $('.q-cty-baoloi-img').remove();
    //     });
    //     return false;
    // });

    $('#cty_baoloi_input_img').change(function() {
        if ($(this) != '') {
            $('#val_baoloi_img').html('');
        }
    });
    $('#cty_baoloi_text').change(function() {
        if ($(this) != '') {
            $('#val_baoloi_text').html('');
        }
    });


    // trang chủ
    $('.q-content-banner-form').submit(function() {
        var name = $('#banne_input_name').val().trim();
        var email = $('#banne_input_email').val().trim();
        var phone = $('#banne_input_phone').val();
        var quymo = $('#banne_input_quymo').val().trim();
        var nd = $('#banne_input_nd').val().trim();
        var data = new FormData();
        form_oke = true;
        var focusArr = [];

        if (name == '') {
            $('#index_error_name').html('Vui lòng nhập họ tên của bạn');
            focusArr.push('#banne_input_name');
            form_oke = false;
        }

        if (email == '') {
            $('#index_error_email').html('Vui lòng nhập Email của bạn');
            focusArr.push('#banne_input_email');
            form_oke = false;
        } else if (email.indexOf("@") < 1 || email.lastIndexOf(".") < (email.indexOf("@") + 2) || (email.lastIndexOf(".") + 2) >= email.length) {
            $('#index_error_email').html('Email không đúng định dạng');
            focusArr.push('#banne_input_email');
            form_oke = false;
        }

        if (phone == '') {
            $('#index_error_phone').html('Vui lòng nhập số điện thoại của bạn');
            focusArr.push('#banne_input_phone');
            form_oke = false;;
        } else if (/((09|03|07|08|05)+([0-9]{8})\b)/g.test(phone) == false) {
            $('#index_error_phone').html('Số điện thoại của bạn không đúng định dạng!');
            focusArr.push('#banne_input_phone');
            form_oke = false;
        }

        if (quymo == '') {
            $('#index_error_quymo').html('Không được để trống');
            focusArr.push('#banne_input_quymo');
            form_oke = false;
        }

        if (nd == '') {
            $('#index_error_nd').html('Không được để trống');
            focusArr.push('#banne_input_nd');
            form_oke = false;
        }
        if (form_oke == true) {
            data.append('name', name);
            data.append('email', email);
            data.append('phone', phone);
            data.append('quymo', quymo);
            data.append('nd', nd);
            $.ajax({
                type: 'post',
                url: "/company/Company_controller/dangky_tuvan",
                async: false,
                dataType: "JSON",
                enctype: 'multipart/form-data',
                contentType: false,
                processData: false,
                data: data,
                success: function(response) {
                    if (response.result == true) {
                        $('#banne_input_name').val('');
                        $('#banne_input_email').val('');
                        $('#banne_input_phone').val('');
                        $('#banne_input_quymo').val('');
                        $('#banne_input_nd').val('');
                        $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {});
                        }, 3000);
                        $('#menu_profile').attr('src', response.avatar);
                    } else {
                        return false;
                    }
                },
            });
        }
        $(focusArr[0]).focus();
        return false;
    });

    $('#banne_input_email').change(function() {
        if ($(this) != '') {
            $('#index_error_email').html('');
        }
    });
    $('#banne_input_name').change(function() {
        if ($(this) != '') {
            $('#index_error_name').html('');
        }
    });
    $('#banne_input_phone').change(function() {
        if ($(this) != '') {
            $('#index_error_phone').html('');
        }
    });
    $('#banne_input_quymo').change(function() {
        if ($(this) != '') {
            $('#index_error_quymo').html('');
        }
    });
    $('#banne_input_nd').change(function() {
        if ($(this) != '') {
            $('#index_error_nd').html('');
        }
    });

    $('.q-form-3_item1').submit(function(event) {
        event.preventDefault();
        var email = $.trim($('.email_xac_thuc').val());
        var otp1 = $("#input_3_1").val();
        var otp2 = $("#input_3_2").val();
        var otp3 = $("#input_3_3").val();
        var otp4 = $("#input_3_4").val();
        var otp5 = $("#input_3_5").val();
        var otp6 = $("#input_3_6").val();
        if (otp1 == '' && otp2 == '' && otp3 == '' && otp4 == '' && otp5 == '' && otp6 == '') {
            $('#val_dk3').html('Vui lòng nhập mã OTP được gửi qua Email của bạn');
            $('#input-reform-2').click();
            $("#input_3_1").focus();
            return false;
        }
        if (otp1 == '' || otp2 == '' || otp3 == '' || otp4 == '' || otp5 == '' || otp6 == '') {
            $('#val_dk3').html('Vui lòng nhập đầy đủ mã OTP');
            $('#input-reform-2').click();
            $("#input_3_1").focus();
            return false;
        }
        $.ajax({
            url: '/staff/StaffRegisterController/staff_register_checkotp',
            type: 'POST',
            dataType: 'json',
            data: {
                email: email,
                otp1: otp1,
                otp2: otp2,
                otp3: otp3,
                otp4: otp4,
                otp5: otp5,
                otp6: otp6
            },
            success: function(data) {
                if (data.result == 2) {
                    $('.q-form-regis-3').hide();
                    $('.q-form-regis-4').show();
                } else if (data.result == 1) {
                    $('#val_dk3').html('Mã OTP không chính xác');
                }
            }
        });

        $('#input_3_1').change(function() {
            if ($(this) != '') {
                $('#val_dk3').html('');
            }
        });
    });


    $('.q-form-4_item1').submit(function(event) {
        event.preventDefault();
        var file_name = '';
        var countFiles = $('#file-input')[0].files.length;
        for (var i = 0; i < countFiles; i++) {
            file_name += $('#file-input')[0].value.substring($('#file-input')[0].value.lastIndexOf('\\') + 1).toLowerCase();
        }
        $.ajax({
            url: '/staff/StaffRegisterController/staff_regis_step4',
            type: 'POST',
            dataType: 'json',
            data: {
                img: file_name
            },
            success: function(data) {
                if (data.result == true) {
                    window.location.href = '/dang-nhap.html';
                } else {
                    alert('Error');
                    return false;
                }
            }
        });
    });

    //công ty

    // quên mk 1
    $('.q-qmk-form-cty').submit(function(event) {
        event.preventDefault();
        var email = $('.q-qmk-form-input').val().trim();
        if (email == '') {
            $('#val_qmk1').html('Vui lòng nhập Email của bạn');
            $('.q-qmk-form-input').focus();
            return false;
        } else if (email.indexOf("@") < 1 || email.lastIndexOf(".") < (email.indexOf("@") + 2) || (email.lastIndexOf(".") + 2) >= email.length) {
            $('#val_qmk1').html('Email không đúng định dạng');
            $('.q-qmk-form-input').focus();
            return false;
        }
        $.ajax({
            url: '/company/Company_controller/company_getpass1',
            type: 'post',
            dataType: "json",
            data: {
                email: email
            },
            success: function(data) {

                if (data.status == true) {
                    $("#getpass_step1").hide();
                    $("#getpass_step2").show();
                    $("#getpass_step3").hide();
                    $("#alert").append('<div class="alert-success">Mã otp đã được gửi. Vui lòng kiểm tra lại email của bạn.</div>');
                    setTimeout(function() {
                        $(".alert-success").fadeOut(1000, function() {
                            $(".alert-success").remove();
                        });
                    }, 2500);
                } else if (data.status == false) {
                    $('#val_qmk1').html('Không có địa chỉ Email nào trùng khớp');
                    return false;
                }
            }
        });
    });
    $('.q-qmk-form-input').change(function() {
        if ($(this) != '') {
            $('#val_qmk1').html('');
        }
    });

    // quên mật khẩu 2
    $('.q-qmk-form-cty-2').submit(function(event) {
        event.preventDefault();
        var email = $('.q-qmk-form-input').val().trim();
        var otp1 = $("#input_2_1").val();
        var otp2 = $("#input_2_2").val();
        var otp3 = $("#input_2_3").val();
        var otp4 = $("#input_2_4").val();
        var otp5 = $("#input_2_5").val();
        var otp6 = $("#input_2_6").val();

        if (otp1 == '' && otp2 == '' && otp3 == '' && otp4 == '' && otp5 == '' && otp6 == '') {
            $('#val_qmk2').html('Vui lòng nhập mã OTP được gửi qua Email của bạn');
            $('#input-reform-2').click();
            $("#input_2_1").focus();
            return false;
        }
        if (otp1 == '' || otp2 == '' || otp3 == '' || otp4 == '' || otp5 == '' || otp6 == '') {
            $('#val_qmk2').html('Vui lòng nhập đầy đủ mã OTP');
            $('#input-reform-2').click();
            $("#input_2_1").focus();
            return false;
        }
        $.ajax({
            url: '/company/Company_controller/company_getpass2',
            type: 'POST',
            dataType: 'json',
            data: {
                email: email,
                otp1: otp1,
                otp2: otp2,
                otp3: otp3,
                otp4: otp4,
                otp5: otp5,
                otp6: otp6
            },
            success: function(data) {
                if (data.status == true) {
                    $("#getpass_step1").hide();
                    $("#getpass_step2").hide();
                    $("#getpass_step3").show();
                } else if (data.status == false) {
                    $('#val_qmk2').html('Mã OTP không chính xác');
                }
            }
        });
    });

    $('#input_2_1').change(function() {
        if ($(this) != '') {
            $('#val_qmk2').html('');
        }
    });

    // quên mật khẩu 3
    $('.q-qmk-form-cty-3').submit(function(event) {
        event.preventDefault();
        var pass = $('#qmk_pass1').val().trim();
        var re_pass = $('#qmk_pass2').val().trim();
        var email = $('.q-qmk-form-input').val().trim();
        form_oke = true;
        var focusArr = [];

        if (pass.length == 0) {
            $('#val_qmk3_pass').html('Vui lòng nhập mật khẩu');
            focusArr.push('#qmk_pass1');
            form_oke = false;
        } else if (pass.length < 6) {
            $('#val_qmk3_pass').html('Mật khẩu có tối thiểu 6 kí tự');
            focusArr.push('#qmk_pass1');
            form_oke = false;
        } else {
            $('#val_qmk3_pass').html('');
        }

        if (re_pass.length == 0) {
            $('#val_qmk3_repass').html('Mật khẩu có tối thiểu 6 kí tự');
            focusArr.push('#qmk_pass2');
            form_oke = false;
        } else if (re_pass != pass) {
            $('#val_qmk3_repass').html('Mật khẩu nhập lại không đúng');
            focusArr.push('#qmk_pass2');
            form_oke = false;
        } else {
            $('#val_qmk3_repass').html('');
        }
        if (form_oke == true) {
            $.ajax({
                url: '/company/Company_controller/company_getpass3',
                type: 'POST',
                dataType: 'json',
                data: {
                    email: email,
                    pass: pass
                },
                success: function(data) {
                    if (data.status == true) {
                        alert('Đổi mật khẩu thành công');
                        window.location.href = '/dang-nhap.html';
                    } else if (data.status == false) {
                        return false;
                    }
                }
            });
        }
        $(focusArr[0]).focus();
        return false;
    });

    $('#qmk_pass1').change(function() {
        if ($(this) != '') {
            $('#val_qmk3_pass').html('');
        }
    });
    $('#qmk_pass2').change(function() {
        if ($(this) != '') {
            $('#val_qmk3_repass').html('');
        }
    });

});


function retypeMail() {
    var email = $('.input_email_2').val();
    $.ajax({
        url: '/staff/StaffRegisterController/retypeMail',
        type: 'post',
        dataType: "json",
        data: {
            email: email
        },
        success: function(data) {
            if (data.status == true) {
                $("#getpass_step1").hide();
                $("#getpass_step2").show();
                $("#getpass_step3").hide();
                $("#alert").append('<div class="alert-success">Gửi lại OTP thành công. Vui lòng kiểm tra lại email.</div>');
                setTimeout(function() {
                    $(".alert-success").fadeOut(1000, function() {
                        $(".alert-success").remove();
                    });
                }, 3000);
            } else if (data.status == false) {
                $('#val_qmk1').html('Không có địa chỉ Email nào trùng khớp');
                return false;
            }
        }
    });
}

function quaylai() {
    $('.q-form-regis-1').hide();
    $('.q-form-regis-2').hide();
    $('.q-form-regis-3').show();
    $('.q-form-regis-4').hide();
}

function gui_lai_otp() {
    var email = $.trim($('.email_xac_thuc').val());
    $.ajax({
        url: '/staff/StaffLoginController/gui_lai_otp',
        type: 'post',
        dataType: "json",
        data: {
            email: email
        },
        success: function(data) {
            if (data.result == true) {
                $("#alert").append('<div class="alert-success">Mã otp đã được gửi. Vui lòng kiểm tra lại email của bạn.</div>');
                setTimeout(function() {
                    $(".alert-success").fadeOut(1000, function() {
                        $(".alert-success").remove();
                    });
                }, 2500);
            } else if (data.result == false) {
                return false;
            }
        }
    });
}

function gui_lai_otp_company() {
    var email = $('.q-qmk-form-input').val().trim();
    if (email == '') {
        $('#val_qmk1').html('Vui lòng nhập Email của bạn');
        $('.q-qmk-form-input').focus();
        return false;
    } else if (email.indexOf("@") < 1 || email.lastIndexOf(".") < (email.indexOf("@") + 2) || (email.lastIndexOf(".") + 2) >= email.length) {
        $('#val_qmk1').html('Email không đúng định dạng');
        $('.q-qmk-form-input').focus();
        return false;
    }
    $.ajax({
        url: '/company/Company_controller/re_otp',
        type: 'post',
        dataType: "json",
        data: {
            email: email
        },
        success: function(data) {

            if (data.result == true) {
                $("#getpass_step1").hide();
                $("#getpass_step2").show();
                $("#getpass_step3").hide();
                $("#alert").append('<div class="alert-success">Mã otp đã được gửi. Vui lòng kiểm tra lại email của bạn.</div>');
                setTimeout(function() {
                    $(".alert-success").fadeOut(1000, function() {
                        $(".alert-success").remove();
                    });
                }, 2500);
            } else {
                $('#val_qmk1').html('Không có địa chỉ Email nào trùng khớp');
                return false;
            }
        }
    });
}