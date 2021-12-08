
    $(document).ready(function () {
        $(".login_cty").click(function(){
            $('.login_cty').addClass('active');
            $('.login_nv').removeClass('active');
            $('#company_login').addClass('active');
            $('#staff_login').removeClass('active');
        });
        $(".login_nv").click(function(){
            $('.login_nv').addClass('active');
            $('.login_cty').removeClass('active');
            $('#staff_login').addClass('active');
            $('#company_login').removeClass('active');
        });
        var flag = 0;
        $('#hide_eyes').click(function(){
            if (flag == 0) {
                $('#pwd').attr('type','text');
                $('#hide_eyes').attr('src','images/Show.svg');
                flag =1;
            }else if(flag == 1){
                $('#pwd').attr('type', 'password');
                $('#hide_eyes').attr('src','images/Hide.svg');
                flag = 0;
            }
        });
        $('#hide_eyes2').click(function(){
            if (flag == 0) {
                $('#pwd2').attr('type','text');
                $('#hide_eyes2').attr('src','images/Show.svg');
                flag =1;
            }else if(flag == 1){
                $('#pwd2').attr('type', 'password');
                $('#hide_eyes2').attr('src','images/Hide.svg');
                flag = 0;
            }
        });
        $("#email").change(function(){
            if ($(this)=='') {
                $(".err-login").html("Email không được để trống");
            }else{
                $(".err-login").html('');
            }
        });
        $("#pwd").change(function(){
            if ($(this)=='') {
                $(".err-login").html("Mật khẩu không được để trống");
            }else{
                $(".err-login").html('');
            }
        });
        
        $("#login_company").click(function(){
            var form_oke = true;
            var email = $.trim($('#email').val());
            var pass = $.trim($("#pwd").val());
        
            if (pass == "" && email == "") {
                $(".err-login").html("Tài khoản và mật khẩu không để trống");
                // alert("ddna");
                form_oke = false;
            }else if (pass == "" && email != "") {
                $(".err-login").html("Mật khẩu không được để trống");
                form_oke = false;
            }else if (email == "" && pass != "") {
                $(".err-login").html("Email không được để trống");
                form_oke = false;
            }else{
                $(".err-login").html("");
            }
            return false;
        });
        
        $("#login_staff").click(function(){
            var form_oke = true;
            var email = $.trim($('#email').val());
            var pass = $.trim($("#pwd").val());
        
            if (pass == "" && email == "") {
                $(".err-login-nv").html("Tài khoản và mật khẩu không để trống");
                // alert("ddna");
                form_oke = false;
            }else if (pass == "" && email != "") {
                $(".err-login-nv").html("Mật khẩu không được để trống");
                form_oke = false;
            }else if (email == "" && pass != "") {
                $(".err-login-nv").html("Email không được để trống");
                form_oke = false;
            }else{
                $(".err-login-nv").html("");
            }
            return false;
        });

    });