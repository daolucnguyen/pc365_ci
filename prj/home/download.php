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
    <title>Download</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/style_re.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/trangchu.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400&display=swap" rel="stylesheet">
</head>
<body>
    <div class="q-download">
        <div class="header q-header-download">
            <?php include "../includes/inc_header_nv.php";?>
        </div>
        <div class="q-download-content">
    <div class="q-download-info">
                <div class="q-banner-download-title">
                        <p class="q-download-title">Punclock<span id="span_365_download">365</span></p>
                        <p class="q-download-title-2">App chấm công bằng công nghệ mới nhất hiện nay</p>
                        <p class="q-download-title-3">Chúng tôi mang đến dịch vụ tuyệt vời nhất cho các công ty quản lí và người lao động</p>
                        <div class="q-download-button">
                            <div class="q-download-button-scan">
                                <img src="../images/qr_chamcong 1.png" alt="qr" class="q-download-button-img">
                            </div>
                            <div class="q-download-button-phone">
                                <a href="" class="" id="down_google_play">
                                    <div class="q-button-div">
                                        <img src="../images/google-play-download.png" alt="google_play">
                                        <div class="q-button-div-text">
                                            <span>Google Play</span>
                                        </div>
                                    </div>
                                </a>
                                <a href="" class="" id="down_app_store">
                                    <div class="q-button-div">
                                        <img src="../images/appstore-play-download.png" alt="app_store">
                                        <div class="q-button-div-text">
                                            <span>App Store</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                </div>
                        <div class="q-phone">
                            <img src="../images/download-phone.png" alt="img" class="q-phone-img hide_on_mobile">
                            <img src="../images/download_img_mobile.png" alt="img" class="q-phone-img hide_on_pc">
                        </div>
            </div>
            <div class="q-download-frame">

            </div>
        </div>
    </div>

    <? include('../includes/inc_footer.php') ?>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>