
$(document).ready(function () {
    $("#cham_cong").select2({
        width: "100%",
        placeholder: "Cấp quyền truy cập",
    });
    $(".ca_lam").on('click',function(){
        if(!$(this).hasClass('active')){
            $(this).addClass('active').attr('data-nv',1);
        }else{
            $(this).removeClass('active').attr('data-nv',0);
        }
    });
    $(".itemca").on('click',function(){
        if(!$(this).hasClass('active')){
            $(this).addClass('active').attr('data-nv',1);
        }else{
            $(this).removeClass('active').attr('data-nv',0);
        }
    });
    $("#them_llv").submit(function(){
        var form_oke = true;
        var form_data = new FormData();
        var arr_id_to_focus = [];
        var llv1 = document.getElementById('llv1').checked;
        var llv2 = document.getElementById('llv2').checked;
        var llv3 = document.getElementById('llv3').checked;
        var llv4 = document.getElementById('llv4').checked;
        var llv = "";
        var date_start = $.trim($("#date_start").val());
        var date_end = $.trim($("#date_end").val());
        var ca = [];
        var ca_lam = $(".ca_lam");
        var dia_diem = [];
        var itemca = $(".itemca")
        if(!ca_lam.hasClass('active')){
            $('#err_calam').html('Bạn chưa chọn phòng ban');
            form_oke = false;
        }else{
            $('#err_calam').html('');
            $('.ca_lam.active').each(function(){
                var name = $(this).attr('data-name');
                ca.push(name);
             });
            ca = ca.toString();
            $('#ca').val(ca);
            form_data.append('ca', ca);
            console.log(ca);
        }
        if(!itemca.hasClass('active')){
            $('#err_diadiem').html('Bạn chưa chọn phòng ban');
            form_oke = false;
        }else{
            $('#err_diadiem').html('');
            $('.itemca.active').each(function(){
                var name = $(this).attr('data-name');
                dia_diem.push(name);
             });
            dia_diem = dia_diem.toString();
            $('#dia_diem').val(dia_diem);
            form_data.append('dia_diem', dia_diem);
            console.log(dia_diem);
        }
        if (date_start == "") {
            $("#err_date_start").html("Bạn chưa chọn ngày bắt đầu");
            arr_id_to_focus.push("#date_start");
            form_oke = false;
        }else{
            $("#err_date_start").html("");
            form_data.append("date_start",date_start)
        }
        if (date_end == "") {
            $("#err_date_end").html("Bạn chưa chọn ngày kết thúc");
            arr_id_to_focus.push("#date_end");
            form_oke = false;
        } else {
            $("#err_date_end").html("Bạn chưa chọn ngày kết thúc");
            form_data.append("date_end",date_end);
        }
        if (llv1 == "" && llv2 == "" && llv3 == "" && llv4 == "") {
            $("#err_llv").html("Bạn chưa chọn lịch làm việc");
            form_oke = false;
        } else {
            $("#err_llv").html("");
            if (llv1 == true) {
                llv = 1;
                form_data.append("llv",llv);
            }
            if (llv2 == true) {
                llv = 2;
                form_data.append("llv",llv);
            }
            if (llv3 == true) {
                llv = 3;
                form_data.append("llv",llv);
            }
            if (llv4 == true) {
                llv = 4;
                form_data.append("llv",llv);
            }
            console.log(llv);
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