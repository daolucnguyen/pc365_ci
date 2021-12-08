

function checkTime(i){
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
$(document).ready(function () {
    $('#time_start').select2({
        placeholder: "Chọn giờ",
        width: "30%",
    });
    $('#time_end').select2({
        placeholder: "Chọn giờ",
        width: "30%",
    });
    $('#city').select2({
        placeholder: "Tỉnh/ thành",
        width: "100%",
    });
    $('#district').select2({
        placeholder: "Quận/ huyện",
        width: "100%",
    });
    $('#time_nhac').select2({
        placeholder: "Chọn thời gian nhắc nhở",
        width: "100%",
    });
    $('#cach_nhac').select2({
        placeholder: "Chọn cách thức thông báo",
        width: "100%",
    });
    $("#chon1").click(function(){
        $("#haha").css("display","none");
        $('#hihi').css("display","block");
    });
    $("#chon2").click(function(){
        $("#haha").css("display","block");
        $('#hihi').css("display","none");
    });
    $(".item_ca").on('click',function(){
        if(!$(this).hasClass('active')){
            $(this).addClass('active').attr('data-chon',1);
        }else{
            $(this).removeClass('active').attr('data-chon',0);
        }
    });
    $(".item_nv").on('click',function(){
        if(!$(this).hasClass('active')){
            $(this).addClass('active').attr('data-nv',1);
        }else{
            $(this).removeClass('active').attr('data-nv',0);
        }
    });
    $("#tao_cong_viec").submit(function(){
        var form_oke = true;
        var ten_cty = $.trim($("#ten_cty").val());
        var chon_ty = "";
        var cty = document.getElementById('cty').checked;
        var cty2 = document.getElementById('cty2').checked;
        var day = document.getElementById('chon1').checked;
        var days = document.getElementById('chon2').checked;
        var date_start = $.trim($("#date_start").val());
        var date_end = $.trim($("#date_end").val());
        var time_start = $("#time_start").val()
        var time_end = $("#time_end").val()
        var time_startt = $("#time_startt").val();
        var time_endd = $("#time_endd").val();
        var dia_chi = $.trim($("#dia_chi").val());
        var city = $.trim($("#city").val());
        var district = $.trim($("#district").val());
        var time_nhac = $.trim($("#time_nhac").val());
        var cach_nhac = $.trim($("#cach_nhac").val());
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
        if (day == "" && days == "") {
            $("#err_lichlam").html("Bạn chưa chọn ngày làm");
            form_oke = false;
        }else{
            $("#err_lichlam").html("");
            if (day == true) {
                if (date_start == "" || date_start == null) {
                	$('#err_date_start').html("Bạn chưa chọn ngày bắt đầu");
                	form_oke = false;
                	arr_id_to_focus.push('#date_start');
                } else {
                	var today = new Date();
                    var date = today.getFullYear()+'-'+checkTime((today.getMonth()+1))+'-'+checkTime((today.getDate()));
                    if (date_start > date) {
                         $('#err_date_start').html("");
                         form_data.append("date_start",date_start);
                         if (time_start == "") {
                             $("#err_date_start").html("Bạn chưa chọn giờ làm");
                             arr_id_to_focus.push("#time_start")
                             form_oke = false;
                         }else{
                             $("#err_date_start").html("");
                             form_data.append("time_start",time_start);
                         }
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
                             form_data.append('date_end',date_end);
                             if (time_end == "") {
                                 $("#err_date_end").html("Bạn chưa chọn giờ làm");
                                 arr_id_to_focus.push("#time_end")
                                 form_oke = false;
                             }else{
                                 $("#err_date_end").html("");
                                 form_data.append("time_end",time_end);
                             }
                        } else {
                            $('#err_date_end').html("Ngày kết thúc phải sau ngày tạo lịch");
                            form_oke = false;
                            arr_id_to_focus.push('#date_end');
                        }
                	}
                }
            }
            if (days == true) {
                if (time_startt == "" || time_startt == null) {
                	$('#err_time_start').html("Bạn chưa chọn ngày bắt đầu");
                	form_oke = false;
                	arr_id_to_focus.push('#time_startt');
                } else {
                	var today = new Date();
                    var date = today.getFullYear()+'-'+checkTime((today.getMonth()+1))+'-'+checkTime((today.getDate()));
                    if (time_startt > date) {
                        $('#err_time_start').html("");
                        form_data.append('time_startt',time_startt);
                    } else {
                        $('#err_time_start').html("Ngày bắt đầu phải sau ngày tạo lịch");
                        form_oke = false;
                        arr_id_to_focus.push('#time_startt');
                    }
                }
                if (time_endd == "" || time_endd == null) {
                	$('#err_time_end').html("Bạn chưa chọn ngày kết thúc");
                	form_oke = false;
                	arr_id_to_focus.push('#time_endd');
                } else {
                	if (time_endd <= time_startt) {
                		$('#err_time_end').html("Ngày kết thúc phải sau ngày bắt đầu");
                		form_oke = false;
                		arr_id_to_focus.push('#time_endd');
                	} else {
                		var today = new Date();
                        var date = today.getFullYear()+'-'+checkTime((today.getMonth()+1))+'-'+checkTime((today.getDate()));
                        if (time_endd > date) {
                            $('#err_time_end').html("");
                            form_data.append('time_endd',time_endd);
                        } else {
                            $('#err_time_end').html("Ngày kết thúc phải sau ngày tạo lịch");
                            form_oke = false;
                            arr_id_to_focus.push('#time_endd');
                        }
                	}
                }
            }
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
        if (ten_cty == "") {
            $("#err_tencty").html("Bạn chưa nhập tên lịch trình");
            arr_id_to_focus.push("#ten_cty");
            form_oke = false;
        }else{
            $("#err_tencty").html("");
            form_data.append('ten_cty',ten_cty);
        }
        if (dia_chi == "" || dia_chi == null) {
            $("#err_time_lich").html("Bạn chưa nhập địa chỉ");
            arr_id_to_focus.push("#dia_chi");
            form_oke = false;
        }else{
            $("#err_time_lich").html("");
            form_data.append('dia_chi',dia_chi);
            if (city == "" || city == null) {
                $("#err_time_lich").html("Bạn chưa chọn thành phố");
                arr_id_to_focus.push("#city");
                form_oke = false;
            } else {
                $("#err_time_lich").html("");
                form_data.append('city',city);
                if (district == "" || district == null) {
                    $("#err_time_lich").html("Bạn chưa chọn quận huyện");
                    arr_id_to_focus.push("#district");
                } else {
                    $("#err_time_lich").html("");
                    form_data.append('district',district)
                }                
            }
        }
        if (time_nhac == "" || time_nhac == null) {
            $("#err_nhacnho").html("Bạn chưa chọn thời gian nhắc nhở");
            arr_id_to_focus.push("#time_nhac");
            form_oke = false;
        } else {
            $("#err_nhacnho").html("");
            form_data.append("time_nhac",time_nhac);
            if (cach_nhac == "" || cach_nhac == null) {
                $("#err_nhacnho").html("Bạn chưa chọn cách thức thông báo");
                arr_id_to_focus.push("#cach_nhac");
                form_oke = false;
            } else {
                $("#err_nhacnho").html("");
                form_data.append("cach_nhac",cach_nhac);
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