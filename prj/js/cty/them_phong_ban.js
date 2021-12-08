
    $(document).ready(function () {
        $('#cong_ty').select2({
            placeholder: "Chọn công ty",
            width: "100%",
        });$('#chon_cty').select2({
            placeholder: "Chọn công ty mẹ",
            width: "100%",
        });
        $("#ten_cty").change(function(){
            if ($(this) == '' || $(this) == null) {
                $("#err_name").html("Tên công ty không được để trống");
                return false
            }else{
                $("#err_name").html("");
            }
        });
        $("#phong_ban").change(function(){
            if ($(this) == '' || $(this) == null) {
                $("#err_phongban").html("Phòng ban không được để trống");
                return false
            }else{
                $("#err_phongban").html("");
            }
        });
        $("#ten_ctyy").change(function(){
            if ($(this) == '' || $(this) == null) {
                $("#err_namee").html("Tên công ty không được để trống");
                return false
            }else{
                $("#err_namee").html("");
            }
        });
        $("#phong_bann").change(function(){
            if ($(this) == '' || $(this) == null) {
                $("#err_phongbann").html("Phòng ban không được để trống");
                return false
            }else{
                $("#err_phongbann").html("");
            }
        });
        $("#add_company").submit(function(){
            var form_oke = true;
            var ten_cty = $.trim($('#ten_cty').val());
            var phong_ban = $.trim($('#phong_ban').val());
            var form_data = new FormData();
            var arr_id_to_focus = [];
            
            if (ten_cty == "" || ten_cty == null) {
                $("#err_name").html("Tên công ty không được để trống");
                arr_id_to_focus.push("#ten_cty");
                form_oke = false;
            } else {
                $("#err_name").html("");
                form_data.append('ten_cty',ten_cty);
            }
            if (phong_ban == "" || phong_ban == null) {
                $("#err_phongban").html("Phòng ban không được để trống");
                arr_id_to_focus.push("#phong_ban");
                form_oke = false;
            }else{
                $("#err_phongban").html("");
                form_data.append("phong_ban",phong_ban);
            }
            $(arr_id_to_focus[0]).focus();
            // if (form_oke == true) {
            //     $.ajax({
            //         type: "POST",
            //         url: "url",
            //         data: form_data,
            //         dataType: "json",
            //         success: function (response) {
                        
            //         }
            //     });
            // }
            return false;
        });
        $("#edit_company").submit(function(){
            var form_oke = true;
            var ten_cty = $.trim($('#ten_ctyy').val());
            var phong_ban = $.trim($('#phong_bann').val());
            var form_data = new FormData();
            var arr_id_to_focus = [];
            
            if (ten_cty == "") {
                $("#err_namee").html("Tên công ty không được để trống");
                arr_id_to_focus.push("#ten_ctyy");
                form_oke = false;
            } else {
                $("#err_namee").html("");
                form_data.append('ten_cty',ten_cty);
            }
            if (phong_ban == "") {
                $("#err_phongbann").html("Phòng ban không được để trống");
                arr_id_to_focus.push("#phong_bann");
                form_oke = false;
            }else{
                $("#err_phongbann").html("");
                form_data.append("phong_ban",phong_ban);
            }
            $(arr_id_to_focus[0]).focus();
            if (form_oke == true) {
                $.ajax({
                    type: "POST",
                    url: "url",
                    data: form_data,
                    dataType: "json",
                    success: function (response) {
                        
                    }
                });
            }
            return false;
        });
    });