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
    <title>Quên mật khẩu 2</title>

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

    <div class="q-content-qmk">
        <div class="q-banner-regis-1">
            <span>NHẬP MÃ XÁC NHẬN</span>
        </div>
        <div class="q-content-body-2">
            <div class="q-qmk-2">
                    <p class="q-qmk-title-2">Nhập mã OTP gồm 6 chữ số đã được gửi thông qua email.</p>
                    <form class="q-qmk-form-2">
                        <div class="q-form-3-v2">
                            <input type="text" autocomplete="off" class="q-qmk-form-input-2" id="input_2_1" name="input_2_1" data-next="input_2_2"
                                oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                            <input type="text" autocomplete="off" class="q-qmk-form-input-2" id="input_2_2" name="input_2_2" data-next="input_2_3" data-previous="input_2_1"
                                oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                            <input type="text" autocomplete="off" class="q-qmk-form-input-2" id="input_2_3" name="input_2_3" data-next="input_2_4" data-previous="input_2_2"
                                oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                            <input type="text" autocomplete="off" class="q-qmk-form-input-2" id="input_2_4" name="input_2_4" data-next="input_2_5" data-previous="input_2_3"
                                oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                            <input type="text" autocomplete="off" class="q-qmk-form-input-2" id="input_2_5" name="input_2_5" data-next="input_2_6" data-previous="input_2_4"
                                oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                            <input type="text" autocomplete="off" class="q-qmk-form-input-2" id="input_2_6" name="input_2_6" data-previous="input_2_5"
                                oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                        </div>
                        <p class="val_error" id="val_qmk2"></p>
                        <div class="q-qmk-form-footer-2">
                            <a href="">Không nhận được mã ? <a href="" id="re-send">Gửi lại</a></a>
                        </div>
                        <div class="q-qmk-form-button-2">
                                    <input type="reset" value="Nhập Lại"  name="submit-regis-2" class=" hide q-submit-regis-2" id="input-reform-2"></input>
                                    <a href="/quen-mat-khau-tai-khoan-nhan-vien-buoc-1.html" class="q-qmk-button1" id="input-reform-2"><span>Quay Lại</span></span></a>
                                    <button type="submit" class="q-qmk-button" id="input-submit-2"><span>Tiếp Theo</span></button>
                        </div>                
                    </form>
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