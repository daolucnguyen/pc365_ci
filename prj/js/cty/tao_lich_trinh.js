

function checkTime(i){
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
$(document).ready(function () {
    $(".item_ca").on('click',function(){
        if(!$(this).hasClass('active')){
            $(this).addClass('active').attr('data-chon',1);
        }else{
            $(this).removeClass('active').attr('data-chon',0);
        }
    });
    $(".item_cty").on('click',function(){
        if(!$(this).hasClass('active')){
            $(this).addClass('active').attr('data-nv',1);
        }else{
            $(this).removeClass('active').attr('data-nv',0);
        }
    });
    $("#them_lich").submit(function(){
        var form_oke = true;
        var tao_lich = $.trim($("#tao_lich").val());
        var chon_ty = "";
        var cty = document.getElementById('cty').checked;
        var cty2 = document.getElementById('cty2').checked;
        var date_start = $.trim($("#date_start").val());
        var date_end = $.trim($("#date_end").val());
        var ghi_chu = $.trim($("#ghi_chu").val());
        var form_data = new FormData();
        var arr_id_to_focus = [];
        var chon_nv = [];
        var chon = [];
        var item_ca = $('.item_ca');
        var item_cty = $('.item_cty');
        if(!item_ca.hasClass('active')){
            $('#err_phongban').html('Bạn chưa chọn phòng ban');
            form_oke = false;
        }else{
            $('#err_phongban').html('');
            $('.item_ca.active').each(function(){
                var name = $(this).attr('data-name');
                chon.push(name);
             });
            chon = chon.toString();
            $('#chon').val(chon);
            form_data.append('chon', chon);
            console.log(chon);
        }
        if(!item_cty.hasClass('active')){
            $('#err_choose_nv').html('Bạn chưa chọn nhân viên');
            form_oke = false;
        }else{
            $('#err_choose_nv').html('');
            $('.item_cty.active').each(function(){
                var ten_nv = $(this).attr('data-name');
                chon_nv.push(ten_nv);
             });
            chon_nv = chon_nv.toString();
            $('#chon_nv').val(chon_nv);
            form_data.append('chon_nv', chon_nv);
            console.log(chon_nv);
        }
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
        if (tao_lich == "") {
            $("#err_lich").html("Bạn chưa nhập tên lịch trình");
            arr_id_to_focus.push("#tao_lich");
            form_oke = false;
        }else{
            $("#err_lich").html("");
            form_data.append('tao_lich',tao_lich);
        }
        if (ghi_chu == "") {
            $("#err_text").html("Bạn chưa nhập ghi chú");
            arr_id_to_focus.push("#ghi_chu");
            form_oke = false;   
        } else {
            // if (ghi_chu.split(" ").length < 10) {
            //     $("#err_text").html("Bạn phải nhập ít nhất 10 từ");
            //     arr_id_to_focus.push("#ghi_chu");
            //     form_oke = false;   
            // }else{
                
            // }
            $("#err_text").html("");
            form_data.append("ghi_chu",ghi_chu);
        }
		if (date_start == "" || date_start == null) {
			$('#err_date_start').html("Bạn chưa chọn ngày bắt đầu");
			form_oke = false;
			arr_id_to_focus.push('#date_start');
		} else {
			var today = new Date();
            var date = today.getFullYear()+'-'+checkTime((today.getMonth()+1))+'-'+checkTime((today.getDate()));
            if (date_start > date) {
                 $('#err_date_start').html("");
            } else {
                $('#err_date_start').html("Ngày bắt đầu phải sau ngày tạo lịch");
                form_oke = false;
                arr_id_to_focus.push('#date_start');
            }
		}
		if (date_end == "" || date_end == null) {
			$('#err_date_end').html("Bạn chưa chọn ngày kết thúc");
			form_oke = false;
			arr_id_to_focus.push('#date_end');
		} else {
			if (date_end <= date_start) {
				$('#err_date_end').html("Ngày kết thúc phải sau ngày bắt đầu");
				form_oke = false;
				arr_id_to_focus.push('#date_end');
			} else {
				var today = new Date();
	            var date = today.getFullYear()+'-'+checkTime((today.getMonth()+1))+'-'+checkTime((today.getDate()));
	            if (date_end > date) {
	                 $('#err_date_end').html("");
	            } else {
	                $('#err_date_end').html("Ngày kết thúc phải sau ngày tạo lịch");
	                form_oke = false;
	                arr_id_to_focus.push('#date_end');
	            }
			}
		}
        $(arr_id_to_focus[0]).focus()
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