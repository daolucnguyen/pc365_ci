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
    <title>Quên mật khẩu 1</title>

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
            <span>QUÊN MẬT KHẨU</span>
        </div>
        <div class="q-content-body">
            <div class="q-qmk">
                <div class="q-qmk-title">
                    <p>Mời bạn nhập email bạn đã đăng ký tài khoản trên PuchClock365. 
                        Chúng tôi sẽ gửi tới bạn mã xác thực để tạo mật khẩu mới. 
                        Vui lòng kiểm tra email</p>
                </div>
                <form class="q-qmk-form">
                    <p class="q-qmk-form-label">Email đăng kí</p>
                    <input type="text" name="qmk_email" class="q-qmk-form-input" placeholder="Nhập email của bạn">
                    <p class="val_error" id="val_qmk1"></p>
                    <button type="submit" class="q-qmk-form-button"><span>Gửi Email Xác Thực</span></button>
                    <p class="q-qmk-footer">
                        <span>Bạn chưa nhận được mã xác thực?</span><a href="">Nhấn vào đây</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <? include('../includes/inc_footer.php') ?>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/validate_nv/validate_nv.js"></script>
</body>
</html>