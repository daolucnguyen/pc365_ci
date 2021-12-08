$(document).ready(function() {
  // dky 1
    $('#form_dk1').submit(function() {
      var id = $('#form_input_1').val().trim();
      if(id == '') {
        $('.val_error').html('Không được để trống');
        $('#form_input_1').focus();
        return false;
      }else{
        if(isNaN(id)){
          $('.val_error').html('ID phải là số');
          $('#form_input_1').focus();
          return false;
        }
      }
    });
    $('#form_input_1').change(function() {
      if($(this) != ''){
        $('.val_error').html('');
      }
    });


  // dky2
  $('#form_dky_2').submit(function() {
    var form_oke = true;
    var email = $('#input_email_2').val().trim();
    var pass = $('#input_pass_2').val().trim();
    var re_pass = $('#input_repass_2').val().trim();
    var name = $('#input_name_2').val().trim();
    var phone = $('#input_phone_2').val().trim();
    var phongban = $('#input_phongban_2').val().trim();
    var chucvu = $('#input_chucvu_2').val().trim();
    var formData = [];
    var focusArr = [];

    if(email == ''){
      $('#val_dk2_email').html('Vui lòng nhập Email của bạn');
      focusArr.push('#input_email_2');
      form_oke = false;
    }else if (email.indexOf("@") < 1 || email.lastIndexOf(".") < (email.indexOf("@") + 2) || (email.lastIndexOf(".") + 2) >= email.length) {
      $('#val_dk2_email').html('Email không đúng định dạng');
      focusArr.push('#input_email_2');
      form_oke = false;
    }

    if(pass.length == 0){
      $('#val_dk2_pass').html('Vui lòng nhập mật khẩu');
      focusArr.push('#input_pass_2');
      form_oke = false;
    }else if(pass.length < 6){
      $('#val_dk2_pass').html('Mật khẩu có tối thiểu 6 kí tự');
      focusArr.push('#input_pass_2');
      form_oke = false;
    }
    

    if(re_pass.length == 0){
      $('#val_dk2_repass').html('Mật khẩu có tối thiểu 6 kí tự');
      focusArr.push('#input_repass_2');
      form_oke = false;
    }else if(re_pass.length > 6 && repass != pass){
            $('#val_dk2_repass').html('Mật khẩu nhập lại không đúng');
            focusArr.push('#input_repass_2');
            form_oke = false;
    }

    if(name == ''){
      $('#val_dk2_name').html('Vui lòng nhập tên của bạn');
      focusArr.push('#input_name_2');
      form_oke = false;
    }

    if(phone == ''){
      $('#val_dk2_phone').html('Bạn chưa nhập số điện thoại');
      focusArr.push('#input_phone_2');
      form_oke = false;
      }else if (/((09|03|07|08|05)+([0-9]{8})\b)/g.test(phone) == false) {
        $('#val_dk2_phone').html('Số điện thoại của bạn không đúng định dạng!');
          focusArr.push('#input_phone_2');
          form_oke = false;
      }
       

    if(phongban == ''){
      $('#val_dk2_pb').html('Bạn chưa lựa chọn phòng ban');
      focusArr.push('#input_phongban_2');
      form_oke = false;
    }

    if(chucvu == ''){
      $('#val_dk2_cv').html('Bạn chưa lựa chọn chức vụ');
      focusArr.push('#input_chucvu_2');
      form_oke = false;
    }
    $(focusArr[0]).focus();
    return false;
  });

  $('#input_email_2').change(function() {
    if($(this) != ''){
      $('#val_dk2_email').html('');
    }
  });
  $('#input_pass_2').change(function() {
    if($(this) != ''){
      $('#val_dk2_pass').html('');
    }
  });
  $('#input_repass_2').change(function() {
    if($(this) != ''){
      $('#val_dk2_repass').html('');
    }
  });
  $('#input_name_2').change(function() {
    if($(this) != ''){
      $('#val_dk2_name').html('');
    }
  });
  $('#input_phone_2').change(function() {
    if($(this) != ''){
      $('#val_dk2_phone').html('');
    }
  });
  $('#input_phongban_2').change(function() {
    if($(this) != ''){
      $('#val_dk2_pb').html('');
    }
  });
  $('#input_chucvu_2').change(function() {
    if($(this) != ''){
      $('#val_dk2_cv').html('');
    }
  });

  // nhap otp
  $('.q-form-3').submit(function() {
    var otp1 = $("#input_3_1").val();
		var otp2 = $("#input_3_2").val();
		var otp3 = $("#input_3_3").val();
		var otp4 = $("#input_3_4").val();
		var otp5 = $("#input_3_5").val();
		var otp6 = $("#input_3_6").val();
    
    if(otp1 == '' && otp2 == '' && otp3 == '' && otp4 == '' && otp5 == '' && otp6 == '') {
      $('#val_dk3').html('Vui lòng nhập mã OTP được gửi qua Email của bạn');
      $('#input-reform-2').click();
      $("#input_3_1").focus();
      return false;
    }
    if(otp1 == '' || otp2 == '' || otp3 == '' || otp4 == '' || otp5 == '' || otp6 == '') {
      $('#val_dk3').html('Vui lòng nhập đầy đủ mã OTP');
      $('#input-reform-2').click();
      $("#input_3_1").focus();
      return false;
    }

    $('#input_3_1').change(function() {
      if($(this) != ''){
        $('#val_dk3').html('');
      }
    });
  });

  // quên mk 1
  $('.q-qmk-form').submit(function(){
    var email = $('.q-qmk-form-input').val().trim();
    if(email == ''){
      $('#val_qmk1').html('Vui lòng nhập Email của bạn');
      $('.q-qmk-form-input').focus();
      return false;
    }else if (email.indexOf("@") < 1 || email.lastIndexOf(".") < (email.indexOf("@") + 2) || (email.lastIndexOf(".") + 2) >= email.length) {
      $('#val_qmk1').html('Email không đúng định dạng');
      $('.q-qmk-form-input').focus();
      return false;
    }
  });

  // quên mật khẩu 2
  $('.q-qmk-form-2').submit(function() {
    var otp1 = $("#input_2_1").val();
		var otp2 = $("#input_2_2").val();
		var otp3 = $("#input_2_3").val();
		var otp4 = $("#input_2_4").val();
		var otp5 = $("#input_2_5").val();
		var otp6 = $("#input_2_6").val();
    
    if(otp1 == '' && otp2 == '' && otp3 == '' && otp4 == '' && otp5 == '' && otp6 == '') {
      $('#val_qmk2').html('Vui lòng nhập mã OTP được gửi qua Email của bạn');
      $('#input-reform-2').click();
      $("#input_2_1").focus();
      return false;
    }
    if(otp1 == '' || otp2 == '' || otp3 == '' || otp4 == '' || otp5 == '' || otp6 == '') {
      $('#val_qmk2').html('Vui lòng nhập đầy đủ mã OTP');
      $('#input-reform-2').click();
      $("#input_2_1").focus();
      return false;
    }

  });
  
  $('#input_2_1').change(function() {
    if($(this) != ''){
        $('#val_qmk2').html('');
    }
  });

  // quên mật khẩu 3
  $('.q-qmk-form-3').submit(function() {
    var pass = $('#qmk_pass1').val().trim();
    var re_pass = $('#qmk_pass2').val().trim();
    form_oke = true;
    var focusArr = [];

    if(pass.length == 0){
      $('#val_qmk3_pass').html('Vui lòng nhập mật khẩu');
      focusArr.push('#qmk_pass1');
      form_oke = false;
    }else if(pass.length < 6){
      $('#val_qmk3_pass').html('Mật khẩu có tối thiểu 6 kí tự');
      focusArr.push('#qmk_pass1');
      form_oke = false;
    }
    
    if(re_pass.length == 0){
      $('#val_qmk3_repass').html('Mật khẩu có tối thiểu 6 kí tự');
      focusArr.push('#qmk_pass2');
      form_oke = false;
    }else if(re_pass.length > 6 && re_pass != pass){
            $('#val_qmk3_repass').html('Mật khẩu nhập lại không đúng');
            focusArr.push('#qmk_pass2');
            form_oke = false;
    }
    $(focusArr[0]).focus();
    return false;
  });

  $('#qmk_pass1').change(function() {
    if($(this) != ''){
      $('#val_qmk3_pass').html('');
    }
  });
  $('#qmk_pass2').change(function() {
    if($(this) != ''){
      $('#val_qmk3_repass').html('');
    }
  });


  // cập nhật thông tin nv
  $(".q-nv-update-form").submit(function() {
    var name = $('#update_name').val().trim();
    var phone = $('#update_phone').val().trim();
    var chucvu = $('#update_chucvu').val().trim();
    var phongban = $('#update_phongban').val().trim();
    form_oke = true;
    var focusArr = [];

    if(name == ''){
      $('#val_update_name').html('Vui lòng nhập họ tên của bạn');
      focusArr.push('#update_name');
      form_oke = false;
    }
    
    if(phone == ''){
      $('#val_update_phone').html('Vui lòng nhập số điện thoại của bạn');
      focusArr.push('#update_phone');
      form_oke = false;;
    }else if (/((09|03|07|08|05)+([0-9]{8})\b)/g.test(phone) == false) {
      $('#val_update_phone').html('Số điện thoại của bạn không đúng định dạng!');
        focusArr.push('#update_phone');
        form_oke = false;
    }

    if(phongban == ''){
      $('#val_update_phongban').html('Bạn chưa lựa chọn phòng ban');
      focusArr.push('#update_phongban');
      form_oke = false;
      $('.select-icon-update').css('bottom','30px');

    }

    if(chucvu == ''){
      $('#val_update_chucvu').html('Bạn chưa lựa chọn chức vụ');
      focusArr.push('#update_chucvu');
      form_oke = false;
      $('.select-icon-update').css('bottom','30px');
    }
    $(focusArr[0]).focus();
    return false;
  });

  $('#update_name').change(function() {
    if($(this) != ''){
      $('#val_update_name').html('');
    }
  });
  $('#update_phone').change(function() {
    if($(this) != ''){
      $('#val_update_phone').html('');
    }
  });
  $('#update_phongban').change(function() {
    if($(this) != ''){
      $('#val_update_phongban').html('');
    }
  });
  $('#update_chucvu').change(function() {
    if($(this) != ''){
      $('#val_update_chucvu').html('');
    }
  });

  $('.q-cty-doimk-form').submit(function() {
    var old_pass = $('#cty_old_pass').val().trim();
    var new_pass = $('#cty_new_pass').val().trim();
    var re_new_pass = $('#cty_re_new_pass').val().trim();
    form_oke = true;
    var focusArr = [];

    if(old_pass == ''){
      $('#val_dmk_old').html('Vui lòng nhập mật khẩu');
      focusArr.push('#cty_old_pass');
      form_oke = false;
    }else{
      if(old_pass.length < 6){
        $('#val_dmk_old').html('Mật khẩu có tối thiểu 6 kí tự');
        focusArr.push('#cty_old_pass');
        form_oke = false;
      }
    }

    if(new_pass == ''){
      $('#val_dmk_new').html('Vui lòng nhập mật khẩu mới');
      focusArr.push('#cty_new_pass');
      form_oke = false;
    }else{
      if(new_pass.length < 6){
        $('#val_dmk_new').html('Mật khẩu có tối thiểu 6 kí tự');
        focusArr.push('#cty_new_pass');
        form_oke = false;
      }
    }
    
    if(re_new_pass == ''){
      $('#val_dmk_renew').html('Vui lòng nhập mật khẩu');
      focusArr.push('#cty_re_new_pass');
      form_oke = false;
    }else{
      if(re_new_pass.length < 6){
        $('#val_dmk_renew').html('Mật khẩu có tối thiểu 6 kí tự');
        focusArr.push('#cty_re_new_pass');
        form_oke = false;
      }else {
        if(re_new_pass != new_pass){
          $('#val_dmk_renew').html('Mật khẩu nhập lại không đúng');
          focusArr.push('#cty_re_new_pass');
          form_oke = false;
        }
      }
    }
    $(focusArr[0]).focus();
    return false;
  });

  $('#cty_old_pass').change(function() {
    if($(this) != ''){
      $('#val_dmk_old').html('');
    }
  });
  $('#cty_new_pass').change(function() {
    if($(this) != ''){
      $('#val_dmk_new').html('');
    }
  });
  $('#cty_re_new_pass').change(function() {
    if($(this) != ''){
      $('#val_dmk_renew').html('');
    }
  });


  // cập nhật thông tin công ty
  $('.q-cty-update-form').submit(function() {
    var name = $('#cty_update_name').val().trim();
    var phone = $('#cty_update_phone').val().trim();
    var address = $('#cty_update_address').val().trim();
    form_oke = true;
    var focusArr = [];

    if(name == ''){
      $('#val_name').html('Vui lòng nhập họ tên của bạn');
      focusArr.push('#cty_update_name');
      form_oke = false;
    }
    
    if(phone == ''){
      $('#val_phone').html('Vui lòng nhập số điện thoại của bạn');
      focusArr.push('#cty_update_phone');
      form_oke = false;;
    }else if (/((09|03|07|08|05)+([0-9]{8})\b)/g.test(phone) == false) {
      $('#val_phone').html('Số điện thoại của bạn không đúng định dạng!');
        focusArr.push('#cty_update_phone');
        form_oke = false;
    }

    if(address == ''){
      $('#val_address').html('Vui lòng nhập địa chỉ của bạn');
      focusArr.push('#cty_update_address');
      form_oke = false;
    }

    $(focusArr[0]).focus();
    return false;
  });
  $('#cty_update_name').change(function() {
    if($(this) != ''){
      $('#val_name').html('');
    }
  });
  $('#cty_update_phone').change(function() {
    if($(this) != ''){
      $('#val_phone').html('');
    }
  });
  $('#cty_update_address').change(function() {
    if($(this) != ''){
      $('#val_address').html('');
    }
  });


  // báo lỗi công ty
  $('.q-cty-baoloi').submit(function() {
    var img = $('#cty_baoloi_input_img').val();
    var content = $('#cty_baoloi_text').val().trim();
    form_oke = true;
    var focusArr = [];

    if(img == ''){
      $('#val_baoloi_img').html('Cần tải ảnh lên');
      focusArr.push('#cty_baoloi_input_img');
      form_oke = false;
    }else if(img.length < 3){
      $('#val_baoloi_img').html('Cần tải ít nhất 3 ảnh lên');
      focusArr.push('#cty_baoloi_input_img');
      form_oke = false;
    }
    
    if(content == ''){
      $('#val_baoloi_text').html('Vui lòng nhập chi tiết lỗi');
      focusArr.push('#cty_baoloi_text');
      form_oke = false;
    }

    if(img.length > 2 && content != ''){
      $('#submit_baoloi_modal').click();
      $('#reform_baoloi').click();
      $('#val_baoloi_img').html('');
      $('#val_baoloi_text').html('');
    }

    $(focusArr[0]).focus();
    $('#submit_baoloi').click(function () {
      $('.q-cty-baoloi-img').remove();
    });
    return false;
  });

  $('#cty_baoloi_input_img').change(function() {
    if($(this) != ''){
      $('#val_baoloi_img').html('');
    }
  });
  $('#cty_baoloi_text').change(function() {
    if($(this) != ''){
      $('#val_baoloi_text').html('');
    }
  });


  // trang chủ
  $('.q-content-banner-form').submit(function(){
    var name = $('#banne_input_name').val().trim();
    var email = $('#banne_input_email').val().trim();
    var phone = $('#banne_input_phone').val().trim();
    var quymo = $('#banne_input_quymo').val().trim();
    var nd = $('#banne_input_nd').val().trim();
    form_oke = true;
    var focusArr = [];

    if(name == ''){
      $('#index_error_name').html('Vui lòng nhập họ tên của bạn');
      focusArr.push('#banne_input_name');
      form_oke = false;
    }

    if(email == ''){
      $('#index_error_email').html('Vui lòng nhập Email của bạn');
      focusArr.push('#banne_input_email');
      form_oke = false;
    }else if (email.indexOf("@") < 1 || email.lastIndexOf(".") < (email.indexOf("@") + 2) || (email.lastIndexOf(".") + 2) >= email.length) {
      $('#index_error_email').html('Email không đúng định dạng');
      focusArr.push('#banne_input_email');
      form_oke = false;
    }
    
    if(phone == ''){
      $('#index_error_phone').html('Vui lòng nhập số điện thoại của bạn');
      focusArr.push('#banne_input_phone');
      form_oke = false;;
    }else if (/((09|03|07|08|05)+([0-9]{8})\b)/g.test(phone) == false) {
      $('#index_error_phone').html('Số điện thoại của bạn không đúng định dạng!');
        focusArr.push('#banne_input_phone');
        form_oke = false;
    }

    if(quymo == ''){
      $('#index_error_quymo').html('Không được để trống');
      focusArr.push('#banne_input_quymo');
      form_oke = false;
    }

    if(nd == ''){
      $('#index_error_nd').html('Không được để trống');
      focusArr.push('#banne_input_nd');
      form_oke = false;
    }
    $(focusArr[0]).focus();
    return false;
  });

  $('#banne_input_email').change(function() {
    if($(this) != ''){
      $('#index_error_email').html('');
    }
  });
  $('#banne_input_name').change(function() {
    if($(this) != ''){
      $('#index_error_name').html('');
    }
  });
  $('#banne_input_phone').change(function() {
    if($(this) != ''){
      $('#index_error_phone').html('');
    }
  });
  $('#banne_input_quymo').change(function() {
    if($(this) != ''){
      $('#index_error_quymo').html('');
    }
  });
  $('#banne_input_nd').change(function() {
    if($(this) != ''){
      $('#index_error_nd').html('');
    }
  });
});



