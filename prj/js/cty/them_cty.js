
    $(document).ready(function () {
        $('#cong_ty').select2({
            placeholder: "Chọn công ty",
            width: "100%",
        });$('#chon_cty').select2({
            placeholder: "Chọn công ty mẹ",
            width: "100%",
        });
        $('#avatar').click(function(){
            $('#user-img').click()
        }); 
        $("#ten_cty").change(function(){
            if ($(this) == '' || $(this) == null) {
                $("#err_name").html("Tên công ty không được để trống");
            }else{
                $("#err_name").html("");
            }
        });
        $("#email").change(function(){
            if ($(this) == "") {
                $("#err_email").html("Email không được để trống");
            }else{
                $("#err_email").html("");
            }

        });
        $("#telephone").change(function(){
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
        $("#ten_ctyy").change(function(){
            if ($(this) == '' || $(this) == null) {
                $("#err_namee").html("Tên công ty không được để trống");
            }else{
                $("#err_namee").html("");
            }
        });
        $("#emaill").change(function(){
            if ($(this) == "") {
                $("#err_emaill").html("Email không được để trống");
            }else{
                $("#err_emaill").html("");
            }

        });
        $("#telephonee").change(function(){
            if ($(this) == '' || $(this) == null) {
                $("#err_sdtt").html("Sđt không được để trống");
            }else{
                $("#err_sdtt").html("");
            }
        });
        $("#dia_chii").change(function(){
            if ($(this) == '' || $(this) == null) {
                $("#err_addresss").html("Địa chỉ không được để trống");
            }else{
                $("#err_addresss").html("");
            }
        });
        $("#add_company").submit(function() {
            var form_oke = true;
            var email_format = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            var telephone_format =/((09|03|07|08|05)+([0-9]{8})\b)/g; 
            var ten_cty = $.trim($(".ten-cty").val());
            var email = $.trim($(".email").val());
            var telephone = $.trim($(".telephone").val());
            var address = $.trim($(".dia-chi").val());
            
            var form_data = new FormData();
            var arr_id_to_focus = [];
             
            if (ten_cty == "" || ten_cty == null) {
                $("#err_name").html("Tên công ty không được để trống");
                arr_id_to_focus.push(".ten-cty");
                form_oke = false;
            } else {
                $("#err_name").html("");
                form_data.append('ten_cty',ten_cty);
            }
            if(email == "" || email == null){
                $("#err_email").html("Email không được để trống");
                form_oke = false;
                arr_id_to_focus.push(".email")
            }else{
                if (email.match(email_format) == null) {
                    $("#err_email").html("Email chưa đúng định dạng");
                    form_oke = false;
                    arr_id_to_focus.push(".email");
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
            if (telephone == '' || telephone == null) {
                $('#err_sdt').html('Bạn chưa nhập số điện thoại');
                form_oke = false;
                arr_id_to_focus.push(".telephone");
            } else {
                if (telephone.match(telephone_format) == null) {
                    $('#err_sdt').html('Số điện thoại không đúng định dạng');
                    form_oke = false;
                    arr_id_to_focus.push(".telephone");
                } else {
                    // if (check_phone == false) {
                    //     $('#err_sdt').html('Số điện thoại đã tồn tại');
                    //     form_oke = false;
                    //     arr_id_to_focus.push(".telephone");
                    // } else {
                        $('#err_sdt').html('');
                        form_data.append('telephone', telephone);
                    // }
                }
            }
            if (address == '' || address == null) {
                $('#err_address').html('Bạn chưa nhập địa chỉ');
                form_oke = false;
                arr_id_to_focus.push("#dia_chi");
            } else {
                $('#err_address').html('');
                form_data.append('address', address);
            }
            $(arr_id_to_focus[0]).focus();
            if (form_oke == true) {
                $.ajax({
                    type: "POST",
                    url: "url",
                    data: form_data,
                    dataType: "dataType",
                    success: function (response) {
                        
                    }
                });
            }
            return false;
        });
        $("#edit_company").submit(function() {
            var form_oke = true;
            var email_format = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            var telephone_format =/((09|03|07|08|05)+([0-9]{8})\b)/g; 
            var ten_cty = $.trim($(".ten-cty").val());
            var email = $.trim($(".email").val());
            var telephone = $.trim($(".telephone").val());
            var address = $.trim($(".dia-chi").val());
            var form_data = new FormData();
            var arr_id_to_focus = [];
             
            if (ten_cty == "" || ten_cty == null) {
                $("#err_namee").html("Tên công ty không được để trống");
                arr_id_to_focus.push(".ten-cty");
                form_oke = false;
            } else {
                $("#err_namee").html("");
                form_data.append('ten_cty',ten_cty);
            }
            if(email == "" || email == null){
                $("#err_emaill").html("Email không được để trống");
                form_oke = false;
                arr_id_to_focus.push(".email")
            }else{
                if (email.match(email_format) == null) {
                    $("#err_emaill").html("Email chưa đúng định dạng");
                    form_oke = false;
                    arr_id_to_focus.push(".email");
                }else{
                    // if (check_email == false) {
                    //     $('#err_emaill').html('Email đã tồn tại');
                    //     form_oke = false;
                    //     arr_id_to_focus.push('#email');
                    // } else {
                        $('#err_emaill').html('');
                        form_data.append('email', email);
                    // }
                }
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
                    // if (check_phone == false) {
                    //     $('#err_sdtt').html('Số điện thoại đã tồn tại');
                    //     form_oke = false;
                    //     arr_id_to_focus.push(".telephone");
                    // } else {
                        $('#err_sdtt').html('');
                        form_data.append('telephone', telephone);
                    // }
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
            $(arr_id_to_focus[0]).focus();
            if (form_oke == true) {
                $.ajax({
                    type: "POST",
                    url: "url",
                    data: form_data,
                    dataType: "dataType",
                    success: function (response) {
                        
                    }
                });
            }
            return false;
        });
    });