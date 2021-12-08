
    $(document).ready(function () {
        $("#ten_ns").change(function(){
            if ($(this) == "") {
                $("#err_name").html("Bạn chưa điền tên nhân viên");
                return false;
            }else{
                $("#err_name").html("");
            }
        });
        $("#email").change(function(){
            if ($(this) == "") {
                $("#err_email").html("Bạn chưa điền email");
                return false;
            } else {
                $("#err_email").html("");
            }
        });
        $("#mat_khau").change(function(){
            if ($(this) == "") {
                $("#err_pass").html("Bạn chưa nhập mật khẩu");
                return false;
            } else {
                $("#err_pass").html("");
            }
        });
        $("#repass").change(function(){
            if ($(this) == "") {
                $("#err_repass").html("Bạn chưa nhập mật khẩu");
                return false;
            }else{
                $("#err_repass").html("");
            }
        });
        $("#telephone").change(function(){
            if ($(this) == "") {
                $("#err_sdt").html("Bạn chưa nhập số điện thoại");
                return false;
            }else{
                $("#err_sdt").html("");
            }
        });
        $("#truy_cap").change(function(){
            if ($(this) == "") {
                $("#err_truycap").html("Bạn chưa chọn quyền truy cập");
                return false;
            } else {
                $("#err_truycap").html("");
            }
        });
        $("#phong_ban2").change(function(){
            if ($(this) == "") {
                $("#err_phongban").html("Bạn chưa chọn quyền truy cập");
                return false;
            } else {
                $("#err_phongban").html("");
            }
        });
        $("#chuc_vu").change(function(){
            if ($(this) == "") {
                $("#err_phongban").html("Bạn chưa chọn quyền truy cập");
                return false;
            } else {
                $("#err_phongban").html("");
            }
        });
        $("#them_nv").submit(function(){
            var form_oke = true;
            var ten_ns = $.trim($("#ten_ns").val());
            var email_format = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            var email = $.trim($("#email").val());
            var mat_khau = $.trim($("#mat_khau").val());
            var repass = $.trim($("#repass").val());
            var telephone_format =/((09|03|07|08|05)+([0-9]{8})\b)/g; 
            var telephone = $.trim($('#telephone').val());
            var truy_cap = $.trim($("#truy_cap").val());
            var phong_ban2 = $.trim($("#phong_ban2").val());
            var chuc_vu = $.trim($("#chuc_vu").val());
            var form_data = new FormData();
            var arr_id_to_focus = [];

            if (ten_ns == "" || ten_ns == null) {
                $("#err_name").html("Bạn chưa điền tên nhân viên");
                arr_id_to_focus.push("#ten_ns");
                form_oke = false;
            }else{
                $("#err_name").html("");
                form_data.append('ten_ns', ten_ns);
            }
            if (email == "" || email == null) {
                $("#err_email").html("Bạn chưa điền email");
                arr_id_to_focus.push("#email");
                form_oke = false;
            } else {
                if (email.match(email_format) == null) {
                    $("#err_email").html("Email không đúng định dạng");
                    arr_id_to_focus.push("#email");
                    form_oke = false;
                }else{
                    $("#err_email").html("");
                    form_data.append('email',email);
                }
            }
            if (mat_khau == "" || mat_khau == null) {
                $("#err_pass").html("Bạn chưa nhập mật khẩu");
                arr_id_to_focus.push("#mat_khau");
                form_oke = false;
            } else {
                if (mat_khau.length < 6) {
                    $("#err_pass").html("Mật khẩu phải lớn hơn 6 ký tụ");
                    arr_id_to_focus.push("#mat_khau");
                    form_oke = false;
                }else{
                    $("#err_pass").html("");
                    form_data.append('mat_khau',mat_khau);
                }
            }
            if (repass == "" || repass == null) {
                $("#err_repass").html("Bạn chưa nhập mật khẩu");
                arr_id_to_focus.push("#repass");
                form_oke = false;
            }else{
                if (repass != mat_khau) {
                    $("#err_repass").html("Mật khẩu không trùng khớp");
                    arr_id_to_focus.push("#repass");
                    form_oke = false;
                }else{
                    $("#err_repass").html("");
                    form_data.append("repass",repass);
                }
            }
            if (telephone == "" || telephone == null) {
                $("#err_sdt").html("Bạn chưa nhập số điện thoại");
                arr_id_to_focus.push("#telephone");
                form_oke = false;
            }else{
                if (telephone.match(telephone_format) == null) {
                    $("#err_sdt").html("Số điện thoại không đúng định dạng");
                    arr_id_to_focus.push("#telephone");
                    form_oke = false;
                } else {
                    $("#err_sdt").html("");
                    form_data.append("telephone",telephone);
                }
            }
            if (truy_cap == "" || truy_cap == null) {
                $("#err_truycap").html("Bạn chưa chọn quyền truy cập");
                arr_id_to_focus.push("#truy_cap");
                form_oke = false;
            } else {
                $("#err_truycap").html("");
                form_data.append("truy_cap",truy_cap);
            }
            if (phong_ban2 == "" || phong_ban2 == null) {
                $("#err_phongban").html("Bạn chưa chọn quyền truy cập");
                arr_id_to_focus.push("#phong_ban2");
                form_oke = false;
            } else {
                $("#err_phongban").html("");
                form_data.append("phong_ban2",phong_ban2);
            }
            if (chuc_vu == "" || chuc_vu == null) {
                $("#err_chucvu").html("Bạn chưa chọn quyền truy cập");
                arr_id_to_focus.push("#chuc_vu");
                form_oke = false;
            } else {
                $("#err_chucvu").html("");
                form_data.append("chuc_vu",chuc_vu);
            }
            $(arr_id_to_focus[0]).focus();
            if (form_oke == true) {
                $.ajax({
                    type: "POST",
                    url: "../../ajax/them_nv_cty.php",
                    data: form_data,
                    dataType: "json",
                    success: function (response) {
                        
                    }
                });
            }
            return false;
        });

        $('#phong_ban').select2({
            placeholder: 'Phòng ban nơi nhân viên đang làm',
            width: "100%"
        });
        $('#phong_ban1').select2({
            placeholder: 'Chọn phòng ban',
            width: "100%"
        });
        $('#chi_nhanh').select2({
            placeholder: 'Chọn chức vụ nhân viên đang giữ',
            width: "100%"
        });
        $('#chi_nhanh1').select2({
            placeholder: 'Chọn chi nhánh',
            width: "100%"
        });
        $('#truy_cap').select2({
            placeholder: 'Chọn phòng ban',
            width: "100%"
        });
        $('#phong_ban2').select2({
            placeholder: 'Chọn chức vụ nhân viên đang giữ',
            width: "100%"
        });
        $('#chuc_vu').select2({
            placeholder: 'Chọn chi nhánh',
            width: "100%"
        });
        $(".d-ds-nhan-vien").click(function(){
            $('.d-ds-nhan-vien').addClass('active');
            $('.d-ds-nv').removeClass('active');
            $('#ds_nhan_vien').addClass('active');
            $('#ds_nv_chua_duyet').removeClass('active');
        });
        $(".d-ds-nv").click(function(){
            $('.d-ds-nv').addClass('active');
            $('.d-ds-nhan-vien').removeClass('active');
            $('#ds_nv_chua_duyet').addClass('active');
            $('#ds_nhan_vien').removeClass('active');
        });
        $(".tick-all").click(function(){
            if (!$(this).hasClass("checked")) {
                $(this).addClass('checked').attr('src','../images/chon_all.svg');
                $('.tick-chon').addClass('checked').attr('src','../images/tick_xanh.svg');
                $('.bo-chon').removeClass('checked').attr('src','../images/k_chon.svg');
            }else{
                $(this).removeClass('checked').attr('src','../images/tick.svg');
                $('.tick-chon').removeClass('checked').attr('src','../images/tick.svg');
            }
        });
        $('.tick-chon').click(function(){
            if (!$(this).hasClass("checked")) {
                $(this).addClass('checked').attr('src','../images/tick_xanh.svg');
                $('.bo-chon').removeClass('checked').attr('src','../images/k_chon.svg');
            }
        });
        $('.bo-chon').click(function(){
            if (!$(this).hasClass("checked")) {
                $(this).addClass('checked').attr('src','../images/k_chon1.svg');
                $('.tick-chon').removeClass('checked').attr('src','../images/tick.svg');
                $(".tick-all").removeClass('checked').attr('src','../images/tick.svg');
            }
        });
    });