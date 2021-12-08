
$(document).ready(function () {
    $('#cong_ty').select2({
        placeholder: "Chọn công ty",
        width: "100%",
    });
    $('#chon_cty').select2({
        placeholder: "Chọn công ty mẹ",
        width: "100%",
    });
    $('#phong_ban').select2({
        placeholder: "Chọn phòng ban",
        width: "100%",
    });
    $("#them_ca_lam").submit(function(){
        var form_oke = true;
        var form_data = new FormData();
        var arr_id_to_focus = [];
        var ten_cty = $.trim($("#ten_cty").val());
        var ca_lam = $.trim($("#ca_lam").val());
        var gio_vao = $.trim($("#gio_vao").val());
        var gio_ra = $.trim($("#gio_ra").val());
        
        if (ten_cty == "" || ten_cty == null) {
            $("#err_cty").html("Bạn chưa điền tên công ty");
            arr_id_to_focus.push("#ten_ty");
            form_oke = false;
        } else {
            $("#err_cty").html("");
            form_data.append("ten_cty",ten_cty);
        }
        if (ca_lam == "" || ca_lam == null) {
            $("#err_calam").html("Bạn chưa nhập ca làm");
            arr_id_to_focus.push("#ca_lam");
            form_oke = false;
        } else {
            $("#err_calam").html("");
            form_data.append("ca_lam",ca_lam);
        }
        if (gio_vao == "") {
            $("#err_vaolam").html("Bạn chưa nhập giờ vào làm");
            arr_id_to_focus.push("#gio_vao");
            form_oke = false;
        }else{
            $("#err_vaolam").html("");
            form_data.append("gio_vao",gio_vao);
        }
        if (gio_ra == "") {
            $("#err_tanlam").html("Bạn chưa nhập giờ tan làm");
            arr_id_to_focus.push("#gio_ra");
            form_oke = false;
        } else {
            $("#err_tanlam").html("");
            form_data.append("gio_ra",gio_ra);
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
        var form_data = new FormData();
        var arr_id_to_focus = [];
        var name_com = $.trim($("#name_com").val());
        var ten_ca = $.trim($("#ten_ca").val());
        var time_in = $.trim($("#time_in").val());
        var time_out = $.trim($("#time_out").val());
        
        if (name_com == "" || name_com == null) {
            $("#err_name").html("Bạn chưa điền tên công ty");
            arr_id_to_focus.push("#ten_ty");
            form_oke = false;
        } else {
            $("#err_name").html("");
            form_data.append("name_com",name_com);
        }
        if (ten_ca == "" || ten_ca == null) {
            $("#err_tenca").html("Bạn chưa nhập ca làm");
            arr_id_to_focus.push("#ten_ca");
            form_oke = false;
        } else {
            $("#err_tenca").html("");
            form_data.append("ten_ca",ten_ca);
        }
        if (time_in == "") {
            $("#err_time").html("Bạn chưa nhập giờ vào làm");
            arr_id_to_focus.push("#time_in");
            form_oke = false;
        }else{
            $("#err_time").html("");
            form_data.append("time_in",time_in);
            if (time_out == "") {
                $("#err_time").html("Bạn chưa nhập giờ tan làm");
                arr_id_to_focus.push("#time_out");
                form_oke = false;
            } else {
                $("#err_time").html("");
                form_data.append("time_out",time_out);
            }
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
});