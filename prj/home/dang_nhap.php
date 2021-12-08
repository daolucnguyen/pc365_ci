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
    <title>ĐĂNG NHẬP</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/style_re.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include "../includes/inc_header_nv.php";?>
    <div class="form_dang_nhap">
        <h1 class="tt_login">ĐĂNG NHẬP TÀI KHOẢN</h1>
        <div class="fr_log_in">

            <div class="login" id="login_general">
                <li class="li-company active"><a href="#company_login"
                        class="login_cty active" data-toggle="tab">Công ty</a></li>
                <li class="li-staff"><a class="login_nv" href="#staff_login"
                        data-toggle="tab">Nhân viên</a>
                </li>
            </div>
            <div class="login_cty_form">
                    <from method="post" class="tab-company active" id="company_login">
                        <p class="login-p">Email đăng nhập</p>
                        <div class="email">
                            <input class="input-mail" type="text" placeholder="Nhập email của bạn" id="email">
                        </div>
                        <p class="login-p">Mật khẩu</p>
                        <div class="pass">
                            <input type="password" class="input-mail" id="pwd" placeholder="*******">
                            <img src="../images/Hide.svg" alt="pass" class="img-pass" id="hide_eyes">
                        </div>
                        <div class="quen_pass">
                            <a href="javascript:void(0)">Quên mật khẩu</a>
                            <div class="error err-login" style="text-align: center;"></div>
                        </div>
                        <button type="submit" name="submit_company" class="dang_nhap" id="login_company">Đăng nhập</button>
                    </from>
                    <from method="post" class="tab-company" id="staff_login">
                        <p class="login-p">Email đăng nhập</p>
                        <div class="email">
                            <input type="text" class="input-mail" placeholder="Nhập email của bạn">
                        </div>
                        <p class="login-p">Mật khẩu</p>
                        <div class="pass">
                            <input  type="password" class="input-mail" id="pwd2" placeholder="*******">
                            <img src="../images/Hide.svg" alt="pass" class="img-pass" id="hide_eyes2">
                        </div>
                        <div class="quen_pass"><a href="javascript:void(0)">Quên mật khẩu</a>
                            <div class="error err-login-nv" style="text-align: center;"></div>
                        </div>
                        <button type="submit" name="submit_staff" class="dang_nhap" id="login_staff">Đăng nhập</button>
                    </from>
            </div>
        </div>
    </div>
    <? include('../includes/inc_footer.php') ?>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/dang_nhap.js"></script>
<script>
</script>
</body>
</html>
