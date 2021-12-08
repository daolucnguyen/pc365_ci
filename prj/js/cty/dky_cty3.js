
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
        $("#sign_up_company").submit(function(){
            var form_oke = true;
            var email_format = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            var email = $.trim($('#email').val());
            var pass = $.trim($("#pass").val());
            var repass = $.trim($('#re_pass').val());
            var address = $.trim($('#dia_chi').val());
            var telephone_format =/((09|03|07|08|05)+([0-9]{8})\b)/g; 
            var telephone = $.trim($('#sdt').val());
            var phong_ban = $.trim($('#phong_ban').val());
            var chuc_vu = $.trim($("#chuc_vu").val());
            var phan_quyen = $.trim($("#phan_quyen").val());
            var form_data = new FormData();
            var arr_id_to_focus = [];

            if(email == "" || email == null){
                $("#err_email").html("");
                form_data.append('email', email);
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
                $('#err_pass').html('');
                form_data.append('pass', pass);
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
                    $('#err_repass').html('');
                    form_data.append('re_pass', repass);
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
            if (telephone == '' || telephone == null) {
                $('#err_sdt').html('');
                form_data.append('sdt', telephone);
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
            form_data.append('dia_chi',address);
            form_data.append('phong_ban',phong_ban);
            form_data.append('chuc_vu',chuc_vu);
            form_data.append('phan_quyen',phan_quyen);
            $(arr_id_to_focus[0]).focus();
            if (form_oke == true) {
                // $.ajax({
                //     type: "POST",
                //     url: "../../ajax/",
                //     data: form_data,
                //     dataType: "json",
                //     success: function (response) {
                        
                //     }
                // });
                
            }else{
                // $.ajax({
                //     type: "POST",
                //     url: "../../ajax/",
                //     data: form_data,
                //     dataType: "json",
                //     success: function (response) {
                        
                //     }
                // });
            }
            return false;
        });
    });