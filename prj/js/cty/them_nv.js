
$(document).ready(function () {
    $("#cham_cong").select2({
        width: "100%",
        placeholder: "Cấp quyền truy cập",
    });
    $(".item_nv").on('click',function(){
        if(!$(this).hasClass('active')){
            $(this).addClass('active').attr('data-nv',1);
        }else{
            $(this).removeClass('active').attr('data-nv',0);
        }
    });
    $("#them_nv").submit(function(){
        var form_oke = true;
        var form_data = new FormData();
        var arr_id_to_focus = [];
        var chon_ty = "";
        var cty = document.getElementById('cty').checked;
        var cty2 = document.getElementById('cty2').checked;
        var chon_nv = [];
        var item_nv = $('.item_nv');
        var chon_pb = "";
        
        if (cty == "" && cty2 == "") {
            $("#err_choose_cty").html("Bạn chưa chọn công ty");
            form_oke = false;
        }else{
            $("#err_choose_cty").html("");
            if (cty == true) {
                chon_ty = 0;
                form_data.append('cty',chon_ty);
            }
            if (cty2 == true) {
                chon_ty = 1;
                form_data.append('cty',chon_ty);
            }
        }
        if(!item_nv.hasClass('active')){
            $('#err_choose_nv').html('Bạn chưa chọn nhân viên');
            form_oke = false;
        }else{
            $('#err_choose_nv').html('');
            $('.item_nv.active').each(function(){
                var ten_nv = $(this).attr('data-name');
                chon_nv.push(ten_nv);
             });
            chon_nv = chon_nv.toString();
            $('#chon_nv').val(chon_nv);
            form_data.append('chon_nv', chon_nv);
            console.log(chon_nv);
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