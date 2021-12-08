<?php
    include "../config/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow"/>
    <meta name="robots" content="noindex,nofollow"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>trang chủ quản lý nhà tuyển dụng</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/style_re.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include "../includes/inc_header_nv.php";?>
    <div class="dang-ky-chung">
        <h1 class="chooses">Lựa chọn Đăng kí</h1>
        <div class="chooses1">
            <a href="/dang-ky-cong-ty.html" class="chooses1-v1">
                <p class="img-company"></p>
                <p class="signup-company">Đăng kí công ty</p>
            </a>
            <a href="/dang-ky-nhan-vien-buoc-1.html" class="chooses1-v1">
                <p class="img-staff"></p>
                <p class="signup-company">Đăng kí nhân viên</p>
            </a>
        </div>
    </div>
<? include('../includes/inc_footer.php') ?>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
