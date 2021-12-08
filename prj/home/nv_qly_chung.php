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
    <title>Quản lý chung nhân viên</title>

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
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 q-contain-right">
                    <?include('../includes/nv_menu_header.php') ?>
                    <div class="q-right-qly" id="right_qlychung">
                        <div class="q-right-time">
                            <span>Hôm nay, ngày <? echo date('d/m/Y', time())?></span>
                        </div>
                        <div class="q-rigth-control">
                            <div class="q-right-list" id="right_list_chamcong">
                                <img src="../images/right-chamcong.png" alt="chamcong" class="q-right-list-img">
                                <p class="q-right-list-text">Chấm Công</p>
                                <div class="q-right-list-count q-right-list-color-1" id="right-list-active"><span><? echo ''?> Lần</span></div>
                            </div>
                            <div class="q-right-list" id="right_list_work">
                                <img src="../images/right-work.png" alt="congviec" class="q-right-list-img">
                                <p class="q-right-list-text">Giao Việc</p>
                                <div class="q-right-list-count q-right-list-color-2" id="right-list-work"><span><? echo ''?> Công Việc</span></div>
                            </div>
                            <div class="q-right-list" id="right_list_lichtrinh">
                                <img src="../images/right-lichtrinh.png" alt="lichtrinh" class="q-right-list-img">
                                <p class="q-right-list-text">Lịch Trình</p>
                                <div class="q-right-list-count q-right-list-color-3" id="right-list-lichtrinh"><span><? echo ''?> Lịch Trình</span></div>
                            </div>
                        </div>
                        <div class="q-right-details-chamcong">
                            <div class="row q-qly-chung">
                                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 q-right-details-left">
                                    <span class="q-right-details-title">Số Lần Chấm Công Trong Tuần</span>
                                    <div class="q-right-details-desc">
                                        <div class="q-right-details-footer">
                                            <div class="q-right-details-note">
                                                <img src="../images/dunggio.png" alt="note">
                                                <span>Chấm công đúng giờ</span>
                                            </div>
                                            <div class="q-right-details-note">
                                                <img src="../images/saigio.png" alt="note">
                                                <span>Đi muộn/ Về sớm</span>
                                            </div>
                                            <div class="q-right-details-note">
                                                <img src="../images/khong.png" alt="note">
                                                <span>Không chấm công</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 q-right-details-right">
                                    <span class="q-right-details-title" id="q_title_2">Công Việc Ngày Hôm Nay</span>
                                    <div class="q-right-details-list">
                                        <div class="q-right-details-list-item" data-link="/danh-cho-nhan-vien/chi-tiet-cong-viec.html">
                                            <div class="q-list-item-title"><span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facilis atque unde aut nulla quam, nam molestias reiciendis corrupti pariatur!</span></div> 
                                            <span class="q-list-item-address">asdknskndksndkasndkand</span> 
                                            <div class="q-list-item-count"></div>
                                        </div>
                                        <div class="q-right-details-list-item" data-link="/danh-cho-nhan-vien/chi-tiet-cong-viec.html">
                                            <div class="q-list-item-title"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum nam velit, sed, aliquid dolore facere obcaecati</span></div>    
                                            <span class="q-list-item-address">asdkasndnnjansd</span>  
                                            <div class="q-list-item-count"></div>  
                                        </div>
                                        <a href="../home/nv_qly_nhanviec.php" class="q-right-more">Xem Thêm</a>
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
            $("[data-link]").click(function() {
                window.location.href = $(this).attr("data-link");
                return false;
            });
            $('.item-drop').click(function () {
                $('.menu-drop').toggleClass('hide');
            });
            $('#right_list_chamcong').hover(function () {
                $('#right_list_chamcong').addClass('q-right-list-active-chamcong');
                $('#right_list_work').removeClass('q-right-list-active-work');
                $('#right_list_lichtrinh').removeClass('q-right-list-active-lichtrinh');
            });
            $('#right_list_work').hover(function () {
                $('#right_list_chamcong').removeClass('q-right-list-active-chamcong');
                $('#right_list_work').addClass('q-right-list-active-work');
                $('#right_list_lichtrinh').removeClass('q-right-list-active-lichtrinh');
            });
            $('#right_list_lichtrinh').hover(function () {
                $('#right_list_chamcong').removeClass('q-right-list-active-chamcong');
                $('#right_list_work').removeClass('q-right-list-active-work');
                $('#right_list_lichtrinh').addClass('q-right-list-active-lichtrinh');
            });
            

            $('#link-1').addClass('link-active');
            $('#link-1').removeClass('menu-link');
            
            $('#link-1-drop').addClass('link-active');
            $('#link-1-drop').removeClass('menu-link');

            $('#menu_cat').css('background-image', 'url(../images/Category-active.png)');
            $('#menu_cat_drop').attr('src','../images/Category-active.png');
        });
    </script>
</body>
</html>
 