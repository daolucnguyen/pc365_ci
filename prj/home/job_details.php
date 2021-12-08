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
    <title>Chi tiết công việc</title>

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
                <div class="q-right-details" id="right_details">
                    <div class="q-right-title" id="right_title">
                        <p>Chi tiết công việc</p>
                    </div>
                    <div class="q-details-work">
                        <div class="q-work-title"><p>title</p></div>
                        <div class="q-work-nv"><span>Người giao: </span><span>name</span></div>
                        <div class="q-details-time-address">
                            <div class="q-details-date">
                                <img src="../images/details-work-calenda.png" alt="calendar">
                                <div class="q-details-datetime">
                                    <p>ngay</p>
                                    <p >gio</p>
                                </div>
                            </div>
                            <div class="q-details-date">
                                <img src="../images/details-work-location.png" alt="location">
                                <div class="q-details-datetime">
                                    <p>Địa điểm</p>
                                    <p>so nha</p>
                                </div>
                            </div>
                        </div>
                        <p class="q-details-title">Thành Viên Tham Gia</p>
                        <div class="q-details-join">
                            <div class="q-details-member">
                                <div class="q-details-member-avatar"><img src="../images/Calendar.png" alt="avatar"></div>
                                <div class="q-details-member-name"><p>name</p></div>
                            </div>
                            <div class="q-details-member">
                                <div class="q-details-member-avatar"><img src="../images/Calendar.png" alt="avatar"></div>
                                <div class="q-details-member-name"><p>name</p></div>
                            </div>
                            <div class="q-details-member">
                                <div class="q-details-member-avatar"><img src="../images/Calendar.png" alt="avatar"></div>
                                <div class="q-details-member-name"><p>name</p></div>
                            </div>
                            <div class="q-details-member">
                                <div class="q-details-member-avatar"><img src="../images/Calendar.png" alt="avatar"></div>
                                <div class="q-details-member-name"><p>name</p></div>
                            </div>
                        </div>
                        <p class="q-details-title">Ghi Chú</p>
                        <p class="q-details-note">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur ut recusandae rerum atque magnam reprehenderit est? Autem nam atque, animi ipsam tempore odit iure ab, a quisquam ratione ad delectus?</p>

                        <p class="q-details-title">Việc Cần Làm</p>
                        <form action="" class="q-details-work-need">
                            <div class="q-details-work-need-v2">
                                <div class="checkbox q-details-work-need-job">
                                    <label class="q-label-checkbox"><input type="checkbox" value="" class="q-input-checkbox" id="checkbox_1"><span class="q-checkbox-text">Việc cần làm</span></label>
                                </div>
                                <div class="checkbox q-details-work-need-job">
                                    <label class="q-label-checkbox"><input type="checkbox" value="" class="q-input-checkbox" id="checkbox_2"><span class="q-checkbox-text">Việc cần làm</span></label>
                                </div>
                                <div class="checkbox q-details-work-need-job">
                                    <label class="q-label-checkbox"><input type="checkbox" value="" class="q-input-checkbox" id="checkbox_3"><span class="q-checkbox-text">Việc cần làm</span></label>
                                </div>
                            </div>
                            <p class="q-details-title">Tài Liệu Liên Quan</p>
                            <ul class="q-details-ul">
                                <li class="q-details-li">
                                    <a href="" class="q-details-link">
                                        <img src="../images/link 1.png" alt="link">
                                        <p>Tên tài liệu</p>
                                    </a>
                                </li>
                                <li class="q-details-li">
                                    <a href="" class="q-details-link">
                                        <img src="../images/link 1.png" alt="link">
                                        <p>Tên tài liệu</p>
                                    </a>
                                </li>
                                <li class="q-details-li">
                                    <a href="" class="q-details-link">
                                        <img src="../images/link 1.png" alt="link">
                                        <p>Tên tài liệu</p>
                                    </a>
                                </li>
                            </ul>
                            <div class="q-details-update">
                                <button type="submit" class="q-details-update-submit">Cập Nhật Công Việc</button>
                            </div>
                        </form>
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

            $('#link-4').addClass('link-active');
            $('#link-4').removeClass('menu-link');
            $('#link-4-drop').addClass('link-active');
            $('#link-4-drop').removeClass('menu-link');

            $('#menu_cat').attr('src','../images/Category.png');
            $('#menu_cat_drop').attr('src','../images/Category.png');
            $('#menu_work').attr('src','../images/Work-active.png');
            $('#menu_work_drop').attr('src','../images/Work-active.png');

            $('#date_option_1').click(function() {
                $('#date_option_1').addClass('q-right-date-option-active');
                $('#date_option_2').removeClass('q-right-date-option-active');
                $('#date_option_3').removeClass('q-right-date-option-active');
            });
            $('#date_option_2').click(function() {
                $('#date_option_1').removeClass('q-right-date-option-active');
                $('#date_option_2').addClass('q-right-date-option-active');
                $('#date_option_3').removeClass('q-right-date-option-active');
            });
            $('#date_option_3').click(function() {
                $('#date_option_1').removeClass('q-right-date-option-active');
                $('#date_option_2').removeClass('q-right-date-option-active');
                $('#date_option_3').addClass('q-right-date-option-active');
            });
            
            $(".q-right-work").click(function(){
                $("#q-right-details-work").click();
            });
        });
    </script>
</body>
</html>
 