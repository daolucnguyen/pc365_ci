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
    <title>XÁC THỰC TÀI KHOẢN</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/style_re.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include "../includes/inc_header_nv.php";?>
    <div class="form-dky-cty">
        <h1 class="chooses">đăng kí công ty</h1>

        <form method="post" class="d-dang-ky-cty" id="otp" data-group-name="digits" >
            <div class="d-dang-ky-cty1">
                <img src="../images/dky_cty2.svg" alt="bước 2" class="dky-cty">
            </div>
            <div class="otp-cty">
                <p class="otp-p">Nhập mã OTP gồm 6 chữ số đã được gửi thông qua email.</p>
                <div class="otp-cty2">
                    <input type="text" autocomplete="off" class="otp-input" id="digit-1" name="digit-1" data-next="digit-2" 
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"/>
                    <input type="text" autocomplete="off" class="otp-input" id="digit-2" name="digit-2" data-next="digit-3" 
                        data-previous="digit-1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"/>
                    <input type="text" autocomplete="off" class="otp-input" id="digit-3" name="digit-3" data-next="digit-4" 
                        data-previous="digit-2" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"/>
                    <input type="text" autocomplete="off" class="otp-input" id="digit-4" name="digit-4" data-next="digit-5"
                        data-previous="digit-3" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"/>
                    <input type="text" autocomplete="off" class="otp-input" id="digit-5" name="digit-5" data-next="digit-6" 
                        data-previous="digit-4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"/>
                    <input type="text" autocomplete="off" class="otp-input" id="digit-6" name="digit-6" data-previous="digit-5" 
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"/>
                </div>
            </div>
            <div class="otp-cty3">
                <p class="otp-cty3-p">
                    Không nhận được mã ? <span class="d-gui-lai-ma">Gửi lại</span>
                </p>
            </div>
            <div class="d-dky-cty4">
                <button type="button" class="button-reset"><p class="reset-p">Quay lại</p></button>
                <button type="submit" class="button-submit"><p class="submit-p">Tiếp theo</p></button>
            </div>
        </form>
    </div>
    <? include('../includes/inc_footer.php') ?>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script>
    $('.otp-cty2').find('input').each(function() {
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
</script>
</body>
</html>