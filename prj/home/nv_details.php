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
    <title>Chi tiết nhân viên</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/style_re.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/menu-header.css">
    <link rel="stylesheet" href="../css/nv_qly.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400&display=swap" rel="stylesheet">
</head>
<body>
        <div class="q-contain">
            <div class="row q-contain-row">
                <div class="col-lg-3 col-md-3 q-contain-left">
                    <? include('../includes/nv_menu_qly.php') ?>
                </div>
                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 q-contain-right">
                    <?include('../includes/nv_menu_header.php') ?>
                <div class="q-right-nv" id="right_nv">
                    <div class="q-right-title" id="right_title">
                        <p>Chi tiết nhân viên</p>
                    </div>
                    <div class="q-right-nv-details">
                        <div class="q-nv-modify ">
                            <div class="q-nv-modyfi-dot"></div>
                            <div class="q-nv-modyfi-dot"></div>
                            <div class="q-nv-modyfi-dot"></div>
                        </div>
                        <div class="q-nv-choice hide">
                            <a href="../home/nv_update.php" class="q-nv-option">Sửa</a>
                            <a href="" class="q-nv-option">Xóa</a>
                            <a href="" class="q-nv-option">Mã QR</a>
                            
                        </div>
                        <div class="q-nv-avatar">
                            <img src="../images/fb.png" alt="avatar">
                        </div>
                        <div class="q-nv-qr">
                            <img src="../images/twitter.png" alt="qr">
                        </div>
                        <div class="q-nv-des">
                            <p class="q-nv-name"><span class="q-nv-id">(ID)</span>name</p>
                            <p class="q-nv-vitri">Nhan vien</p>
                            <div class="q-nv-info">
                                <div class="q-nv-info-list">
                                    <img src="../images/dot.png" alt="dot">
                                    <p>Email:<span>email</span></p>
                                </div>
                                <div class="q-nv-info-list">
                                    <img src="../images/dot.png" alt="dot">
                                    <p>Tên công ty:<span>tên cty</span></p>
                                </div>
                                <div class="q-nv-info-list">
                                    <img src="../images/dot.png" alt="dot">
                                    <p>SĐT:<span>sdt</span></p>
                                </div>
                                <div class="q-nv-info-list">
                                    <img src="../images/dot.png" alt="dot">
                                    <p>Mật khẩu:<span>matkhau</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <? include('../includes/inc_footer.php') ?>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.item-drop').click(function () {
                $('.menu-drop').toggleClass('hide');
            });

            $('#link-5').addClass('link-active');
            $('#link-5').removeClass('menu-link');
            $('#link-6').addClass('link-active');
            $('#link-6').removeClass('menu-link');

            $('#menu_cat').attr('src','../images/Category.png');
            $('#menu_pro').attr('src','../images/Profile-active.png');
            

            
            $(".q-right-work").click(function(){
                $("#q-right-details-work").click();
            });
                    $(".q-nv-modify").click(function(e){ 
                        $(".q-nv-choice").toggleClass("hide");
                        e.stopPropagation();
                    });
                    $(document,).click(function(){
                        $(".q-nv-choice").addClass("hide");
                    });


        });
    </script>
</body>
</html>
 