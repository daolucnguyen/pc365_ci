

$(document).ready(function () {
    $(".cau-hinh").on('click',function(){
        if(!$(this).hasClass('active')){
            $(this).addClass('active').attr('data-chon',1);
        }else{
            $(this).removeClass('active').attr('data-chon',0);
        }
    });
    $("#cham_cong").change(function(){
        if ($(this) == "") {
            $("#err_chamcong").html("Bạn chưa chọn công ty");
            return false;
        }else{
            $("#err_chamcong").html("");
        }
    });
    $("#ten_wifi").change(function(){
        if ($(this) == "") {
            $("#err_wifi").html("Bạn chưa nhập tên wifi");
            return false;
        } else {
            $("#err_wifi").html("");
            $("#id_wifi").change(function(){
                if ($(this) == "") {
                    $("#err_wifi").html("Bạn chưa điền id wifi");
                    return false;
                }else{
                    $("#err_wifi").html("");
                }
            });
        }
    });
    $("#toa_do").change(function(){
        if ($(this) == "") {
            $("#err_vitri").html("Bạn chưa nhập tọa độ");
            return false;
        } else {
            $("#err_vitri").html("");
            $("#dia_chi").change(function(){
                if ($(this) == "") {
                    $("#err_vitri").html("Bạn chưa nhập địa chỉ");
                    return false;
                } else {
                    $("#err_vitri").html("");
                }
            });
        }
    });
    $("#cau_hinh").submit(function(){
        var form_oke = true;
        var form_data = new FormData();
        var arr_id_to_focus = [];
        var cham_cong = $.trim($("#cham_cong").val());
        var ten_wifi = $.trim($("#ten_wifi").val());
        var id_wifi = $.trim($("#id_wifi").val());
        var toa_do = $.trim($("#toa_do").val());
        var dia_chi = $.trim($("#dia_chi").val());
        var chon = [];
        var cau_hinh = $(".cau-hinh")
        if(!cau_hinh.hasClass('active')){
            $('#err_cauhinh').html('Bạn chưa chọn cấu hình');
            form_oke = false;
        }else{
            $('#err_cauhinh').html('');
            $('.cau-hinh.active').each(function(){
                var name = $(this).attr('data-name');
                chon.push(name);
             });
            chon = chon.toString();
            $('#chon').val(chon);
            form_data.append('chon', chon);
            console.log(chon);
        }

        if (cham_cong == "" || cham_cong == null) {
            $("#err_chamcong").html("Bạn chưa chọn công ty");
            arr_id_to_focus.push("#cham_cong");
            form_oke = false;
        } else {
            $("#err_chamcong").html("");
            form_data.append("cham_cong",cham_cong);
        }
        if (ten_wifi == "" || ten_wifi == null) {
            $("#err_wifi").html("Bạn chưa nhập tên wifi");
            arr_id_to_focus.push("#ten_wifi");
            form_oke = false;
        } else {
            $("#err_wifi").html("");
            form_data.append('ten_wifi',ten_wifi);
            if (id_wifi == "" || id_wifi == null) {
                $("#err_wifi").html("Bạn chưa điền ip wifi");
                arr_id_to_focus.push("id_wifi");
                form_oke = false;
            } else {
                $("#err_wifi").html("");
                form_data.append("id_wifi",id_wifi);
            }
        }
        if (toa_do == "" || toa_do == null) {
            $("#err_vitri").html("Bạn chưa nhập tọa độ");
            arr_id_to_focus.push("#toa_do");
            form_oke = false;
        } else {
            $("#err_vitri").html("");
            form_data.append("toa_do",toa_do);
            if (dia_chi == "" || dia_chi == null) {
                $("#err_vitri").html("Bạn chưa nhập địa chỉ");
                arr_id_to_focus.push("#toa_do");
                form_oke = false;
            } else {
                $("#err_vitri").html("");
                form_data.append("dia_chi",dia_chi);
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