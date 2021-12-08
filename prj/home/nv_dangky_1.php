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
    <title>Đăng ký nhân viên 1</title>

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

    <div class="q-content-1">
        <div class="q-banner-regis-1">
            <span>ĐĂNG KÍ NHÂN VIÊN</span>
        </div>
        <div class="q-regis-1">
            <div class="q-form-regis-1">
                <div class="q-form-header-1">
                    <div class="q-form-header-1-v2">
                        <img src="../images/regis-1-active.png" alt="res1" class="q-form-img">
                        <img src="../images/Line 3.png" alt="line" class="q-form-img-line">
                        <img src="../images/regis-2.png" alt="res2" class="q-form-img">
                        <img src="../images/Line 3.png" alt="line" class="q-form-img-line">
                        <img src="../images/regis-3.png" alt="res3" class="q-form-img">
                        <img src="../images/Line 3.png" alt="line" class="q-form-img-line">
                        <img src="../images/regis-4.png" alt="res4" class="q-form-img">
                    </div>
                </div>
                <div class="q-form-body-1">
                    <p class="q-form-label-1">Mã ID Công Ty ( Do Nhân Sự Cung Cấp ) </p>
                    <form action="" class="q-form-1" id="form_dk1">
                        <input type="text" name="id" id="form_input_1" class="q-form-input-1" placeholder="Nhập mã ID">
                        <p class="val_error"></p>
                        <button type="submit" name="submit-regis-1" class="q-submit-regis-1"><span>Tiếp Theo</span></button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <? include('../includes/inc_footer.php') ?>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/validate_nv/validate_nv.js"></script>
</body>
</html>