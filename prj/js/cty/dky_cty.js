
    $(document).ready(function () {
        // var check_email = true;
        // $("#email").blur(function(){
        //     var email_oke = $.trim($("#email").val());
        //     $.ajax({
        //         type: "POST",
        //         url: "../../ajax/check_mail.php",
        //         data: {
        //             email: email_oke,
        //         },
        //         dataType: "json",
        //         success: function (response) {
                    
        //         }
        //     });            
        // });
        $("#email").change(function(){
            if ($(this) == "") {
                $("#err_email").html("Email không được để trống");
            }else{
                $("#err_email").html("");
            }

        });
        $("#pass").change(function(){
            var pwd = $.trim($(this).val());
            if (pwd == "" || pwd == null) {
                $("#err_pass").html("Mật khẩu không được để trống");
            }else{
                $("#err_pass").html("");
            }
        });
        $("#re_pass").change(function(){
            if ($(this) == '' || $(this) == null) {
                $("#err_repass").html("Mật khẩu không được để trống");
            }else{
                $("#err_repass").html("");
            }
        });
        $("#ten_cty").change(function(){
            if ($(this) == '' || $(this) == null) {
                $("#err_name").html("Tên công ty không được để trống");
            }else{
                $("#err_name").html("");
            }
        });
        $("#sdt").change(function(){
            if ($(this) == '' || $(this) == null) {
                $("#err_sdt").html("Sđt không được để trống");
            }else{
                $("#err_sdt").html("");
            }
        });
        $("#dia_chi").change(function(){
            if ($(this) == '' || $(this) == null) {
                $("#err_address").html("Địa chỉ không được để trống");
            }else{
                $("#err_address").html("");
            }
        });
        $("#sign_up_company").submit(function(){
            var form_oke = true;
            var email_format = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            var email = $.trim($('#email').val());
            var pass = $.trim($("#pass").val());
            var repass = $.trim($('#re_pass').val());
            var name_cty = $.trim($('#ten_cty').val());
            var address = $.trim($('#dia_chi').val());
            var telephone_format =/((09|03|07|08|05)+([0-9]{8})\b)/g; 
            var telephone = $.trim($('#sdt').val());
            var form_data = new FormData();
            var arr_id_to_focus = [];

            if(email == "" || email == null){
                $("#err_email").html("Email không được để trống");
                form_oke = false;
                arr_id_to_focus.push("#email")
            }else{
                if (email.match(email_format) == null) {
                    $("#err_email").html("Email chưa đúng định dạng");
                    form_oke = false;
                    arr_id_to_focus.push("#email");
                }else{
                    // if (check_email == false) {
                    //     $('#err_email').html('Email đã tồn tại');
                    //     form_oke = false;
                    //     arr_id_to_focus.push('#email');
                    // } else {
                        $('#err_email').html('');
                        form_data.append('email', email);
                    // }
                }
            }
            if (pass == '' || pass == null) {
                $('#err_pass').html('Bạn chưa điền mật khẩu');
                form_oke =  false;
                arr_id_to_focus.push("#pass");
            } else {
                if (pass.length < 6) {
                    $('#err_pass').html('Mật khẩu phải lớn hơn 6 ký tự');
                    form_oke = false;
                    arr_id_to_focus.push("#pass");
                } else {
                    $('#err_pass').html('');
                    form_data.append('pass', pass);
                }
            }
            if (repass == '' || repass == null) {
                    $('#err_repass').html('Bạn chưa nhập mật khẩu');
                    form_oke = false;
                    arr_id_to_focus.push("#re_pass");
            } else {
                if (repass != pass) {
                    $('#err_repass').html('Mật khẩu không trùng khớp');
                    form_oke = false;
                    arr_id_to_focus.push("#re_pass");
                } else {
                    $('#err_repass').html('');
                    form_data.append('re_pass', repass);
                }
            }
            if (name_cty == "" || name_cty == null) {
                $("#err_name").html("Bạn chưa điền tên công ty");
                form_oke = false;
                arr_id_to_focus.push("#ten_cty");
            } else {
                $("#err_name").html("");
                form_data.append('name_cty',name_cty);
            }
            if (address == '' || address == null) {
                $('#err_address').html('Bạn chưa nhập địa chỉ');
                form_oke = false;
                arr_id_to_focus.push("#dia_chi");
            } else {
                $('#err_address').html('');
                form_data.append('address', address);
            }
            if (telephone == '' || telephone == null) {
                $('#err_sdt').html('Bạn chưa nhập số điện thoại');
                form_oke = false;
                arr_id_to_focus.push("#sdt");
            } else {
                if (telephone.match(telephone_format) == null) {
                    $('#err_sdt').html('Số điện thoại không đúng định dạng');
                    form_oke = false;
                    arr_id_to_focus.push("#sdt");
                } else {
                    // if (check_phone == false) {
                    //     $('#err_sdt').html('Số điện thoại đã tồn tại');
                    //     form_oke = false;
                    //     arr_id_to_focus.push("#sdt");
                    // } else {
                        $('#err_sdt').html('');
                        form_data.append('sdt', telephone);
                    // }
                }
            }
            $(arr_id_to_focus[0]).focus();
            if (form_oke == true) {
                // $.ajax({
                //     type: "POST",
                //     url: "../../ajax/sign_up_conpany.php",
                //     data: form_data,
                //     dataType: "json",
                //     success: function (response) {
                        
                //     }
                // });
                
            }else{
                // $.ajax({
                //     type: "POST",
                //     url: "../../ajax/sign_up_err_company.php",
                //     data: form_data,
                //     dataType: "json",
                //     success: function (response) {
                        
                //     }
                // });
            }
            return false;
        });
    });
