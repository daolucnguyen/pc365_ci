<?php
    include "../config/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký nhân viên 3  </title>

    <link rel="stylesheet" href="../css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/style_re.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/nv_out.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400&display=swap" rel="stylesheet">
</head>
<body>
    <div class="header">
        <?php include "../includes/inc_header_nv.php";?>
    </div>

    <div class="q-content-3">
        <div class="q-banner-regis-1">
            <span>ĐĂNG KÍ NHÂN VIÊN</span>
        </div>
        <div class="q-regis-3">
            <div class="q-form-regis-3">
                <div class="q-form-header-1" id="form-header-3">
                    <img src="../images/regis-1-active.png" alt="res1" class="q-form-img">
                    <img src="../images/Line 3-active.png" alt="line" class="q-form-img-line">
                    <img src="../images/regis-2-active.png" alt="res2" class="q-form-img">
                    <img src="../images/Line 3-active.png" alt="line" class="q-form-img-line">
                    <img src="../images/regis-3-active.png" alt="res3" class="q-form-img">
                    <img src="../images/Line 3.png" alt="line" class="q-form-img-line">
                    <img src="../images/regis-4.png" alt="res4" class="q-form-img">
                </div>
                <div class="q-form-body-3">
                    <p class="q-form-title-3">Nhập mã OTP gồm 6 chữ số đã được gửi thông qua email.</p>
                    <form class="q-form-3" id="form-3">
                        <div class="q-form-3-v2">
                            <input type="text" autocomplete="off" class="q-form-input-3" id="input_3_1" name="input_3_1" data-next="input_3_2"
                                oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                            <input type="text" autocomplete="off" class="q-form-input-3" id="input_3_2" name="input_3_2" data-next="input_3_3" data-previous="input_3_1"
                                oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                            <input type="text" autocomplete="off" class="q-form-input-3" id="input_3_3" name="input_3_3" data-next="input_3_4" data-previous="input_3_2"
                                oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                            <input type="text" autocomplete="off" class="q-form-input-3" id="input_3_4" name="input_3_4" data-next="input_3_5" data-previous="input_3_3"
                                oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                            <input type="text" autocomplete="off" class="q-form-input-3" id="input_3_5" name="input_3_5" data-next="input_3_6" data-previous="input_3_4"
                                oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                            <input type="text" autocomplete="off" class="q-form-input-3" id="input_3_6" name="input_3_6" data-previous="input_3_5"
                                oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                        </div>
                        <p class="val_error" id="val_dk3"></p>
                        <div class="q-form-footer-3">
                            <a href="">Không nhận được mã ? <a href="" id="re-send">Gửi lại</a></a>
                        </div>
                        <div class="q-form-button">
                                    <input type="reset" value="Nhập Lại"  name="submit-regis-2" class="q-submit-regis-2" id="input-reform-2"></input>
                                    <button type="submit" name="submit-regis-2" class="q-submit-regis-2" id="input-submit-2"><span>Tiếp Theo</span></button>
                        </div>                
                    </form>
                </div>
            </div>
        </div>
    </div>

    <? include('../includes/inc_footer.php') ?>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/validate_nv/validate_nv.js"></script>
    <script>
    $(document).ready(function(){
        $('.q-form-3-v2').find('input').each(function() {
        $(this).attr('maxlength', 1);
        $(this).on('keyup', function(e) {
            var parent = $($(this).parent());
            
            if(e.keyCode === 8 || e.keyCode === 37) {
                var prev = parent.find('input#' + $(this).data('previous'));
                
                if(prev.length) {
                    $(prev).select();
                }
            } else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
                var next = parent.find('input#' + $(this).data('next'));
                
                if(next.length) {
                    $(next).select();
                }
            }
        });
    });

});

    </script>
</body>
</html>