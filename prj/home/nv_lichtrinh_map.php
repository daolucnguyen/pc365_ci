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
    <title>Lịch trình nhân viên</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../css/select2.min.css">
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
            <div class="row q-contain-row" id="content_row_map">
                <div class="col-lg-3 col-md-3 q-contain-left">
                    <? include('../includes/nv_menu_qly.php') ?>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 q-contain-right">
                    <?include('../includes/nv_menu_header.php') ?>
                <div class="q-right" id="right_lichtrinh">
                    <div class="q-right-title" id="right_title_lichtrinh">
                        <span id="map_title_span">Lịch Trình Của Tôi Trên Map</span>
                    </div>
                    <div class="q-right-lichtrinh-map">
                        <div class="q-right-lichtrinh-map-v2">

                        </div>
                        <div class="q-right-content-map">
                            <div class="q-content-map-header">
                                <div class="q-content-map-header-avatar">
                                    <img id="map_header_avatar" src="../images/content-row2-div1.png" alt="avatar">
                                </div>
                                <div class="q-content-map-header-info">
                                    <div class="q-content-map-header-info-v2">
                                        <p class="q-content-map-header-id">(111)</p>
                                        <p class="q-content-map-header-name">name</p>
                                    </div>
                                    <p class="q-content-map-header-cv">Nhân viên phòng kĩ thuật</p>
                                </div>
                            </div>
                            <hr class="q-content-map-hr">
                            <div class="q-content-map-control">
                                <a href="" class="q-content-map-control-v2" id="map_control_delete">
                                    <img src="../images/delete-map.png" alt="delete" class="q-content-map-control-img">
                                    <p class="q-content-map-control-link">Xóa</p>
                                </a>
                                <a href class="q-content-map-control-v2" id="map_control_edit">
                                    <img src="../images/edit.png" alt="edit" class="q-content-map-control-img">
                                    <p class="q-content-map-control-link">Sửa</p>
                                </a>
                            </div>
                            <hr class="q-content-map-hr">
                            <div class="q-content-map-info">
                                <div class="q-content-map-date">
                                    <p class="q-content-map-date-v2">Lịch trình ngày <span id="map_day">22/22/2222</span></p>
                                    <p class="q-content-map-date-status" id="status_danglam">Đang làm</p>
                                    <p class="q-content-map-date-status hide" id="status_hoanthanh">Hoàn thành</p>
                                </div>
                                <p class="q-content-map-name">Đến Chỗ XYZ để lấy hồ sơ</p>
                                <p class="q-content-map-note">
                                Ghi chú: <span class="q-content-map-note-v2">ghi chu cong viec</span>
                                </p>
                                <div class="q-content-map-step">
                                    <div class="q-content-map-step-left">
                                        <img src="../images/map_checked.png" alt="checked" class="q-content-map-step-img" id="map_check_1">
                                        <img src="../images/map_line_checked.png" alt="line" class="q-content-map-step-line" id="line_1">
                                        <img src="../images/map_checked.png" alt="checked" class="q-content-map-step-img" id="map_check_2">
                                        <img src="../images/map_line_check.png" alt="line" class="q-content-map-step-line" id="line_2">
                                        <img src="../images/map_check.png" alt="checked" class="q-content-map-step-img" id="map_check_3">
                                        <img src="../images/map_line_check.png" alt="line" class="q-content-map-step-line" id="line_2">
                                        <img src="../images/map_check.png" alt="checked" class="q-content-map-step-img" id="map_check_3">
                                    </div>
                                    <div class="q-content-map-step-right">
                                        <div class="q-content-map-step-right-v2">
                                            <div class="q-content-map-step-row">
                                                <p class="q-content-map-step-pos">Điểm bắt đầu</p>
                                                <p class="q-content-map-step-hour">20:00</p>
                                                <img src="../images/map_delete.png" alt="delete" class="q-content-map-step-cancel hide">
                                            </div>
                                            <p class="q-content-map-step-address">Số 123 Định Công, Hoàng Mai, Hà Nội</p>
                                        </div>
                                        <div class="q-content-map-step-right-v2">
                                            <div class="q-content-map-step-row">
                                                <p class="q-content-map-step-pos">Điểm bắt đầu</p>
                                                <p class="q-content-map-step-hour">20:00</p>
                                                <img src="../images/map_delete.png" alt="delete" class="q-content-map-step-cancel hide">
                                            </div>
                                            <p class="q-content-map-step-address">Số 123 Định Công, Hoàng Mai, Hà Nội</p>
                                        </div>
                                        <div class="q-content-map-step-right-v2">
                                            <div class="q-content-map-step-row">
                                                <p class="q-content-map-step-pos">Điểm bắt đầu</p>
                                                <p class="q-content-map-step-hour">20:00</p>
                                                <img src="../images/map_delete.png" alt="delete" class="q-content-map-step-cancel hide">
                                            </div>
                                            <p class="q-content-map-step-address">Số 123 Định Công, Hoàng Mai, Hà Nội</p>
                                        </div>
                                        <div class="q-content-map-step-right-v2">
                                            <div class="q-content-map-step-row">
                                                <p class="q-content-map-step-pos">Điểm bắt đầu</p>
                                                <p class="q-content-map-step-hour">20:00</p>
                                                <img src="../images/map_delete.png" alt="delete" class="q-content-map-step-cancel hide">
                                            </div>
                                            <p class="q-content-map-step-address">Số 123 Định Công, Hoàng Mai, Hà Nội</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="q-content-map-footer">
                                <p class="q-content-map-footer-title">Đồng hành trình</p>
                                <div class="q-content-map-footer-v2">
                                    <div class="q-content-map-footer-avatar">
                                        <img src="../images/app_cv365.png" alt="avatar" id="map_dh_1">
                                        <img src="../images/app_cv365.png" alt="avatar" id="map_dh_2">
                                        <img src="../images/app_cv365.png" alt="avatar" id="map_dh_3">
                                        <div id="map_dh_4">
                                            <p id="map_count">5</p>+
                                        </div>
                                    </div>
                                    <a href="" class="q-content-map-footer-link">Xem thêm</a>
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
    <script src="../js/select2.min.js"></script>
    <script>
        $(document).ready(function () {

            $('.item-drop').click(function () {
                $('.menu-drop').toggleClass('hide');
            });

            $('#link-3').addClass('link-active');
            $('#link-3').removeClass('menu-link');

            $('#link-3-drop').addClass('link-active');
            $('#link-3-drop').removeClass('menu-link');

            $('#menu_scan').attr('src','../images/Scan.png');
            $('#menu_location').attr('src','../images/Location-active.png');

            $('#menu_cat_drop').attr('src','../images/Category.png');
            $('#menu_scan_drop').attr('src','../images/Scan.png');
            $('#menu_location_drop').attr('src','../images/Location-active.png');


                    $("#status_td_1").click(function(e){ 
                        $("#status_link_1").show();
                        e.stopPropagation();
                    });
                    $("#status_td_2").click(function(e){ 
                        $("#status_link_2").show();
                        e.stopPropagation();
                    });
                    $("#status_td_3").click(function(e){ 
                        $("#status_link_3").show();
                        e.stopPropagation();
                    });
                    $("#status_td_4").click(function(e){ 
                        $("#status_link_4").show();
                        e.stopPropagation();
                    });
                    $("#status_td_5").click(function(e){ 
                        $("#status_link_5").show();
                        e.stopPropagation();
                    });

                    $(document).click(function(){
                        $("#status_link_1").hide();
                        $("#status_link_2").hide();
                        $("#status_link_3").hide();
                        $("#status_link_4").hide();
                        $("#status_link_5").hide();
                    });


            $('#modal_search_date_begin').focus(function(e){
                $('#modal_search_date_1').hide();
                e.stopPropagation();
             });
            $(document).click(function(){
                $("#modal_search_date_1").show();
            });

            $('#modal_search_date_end').focus(function(e){
                $('#modal_search_date_2').hide();
                e.stopPropagation();
             });
            $(document).click(function(){
                $("#modal_search_date_2").show();
            });

            $('#right_search_date_begin').focus(function(e){
                $('#q-search-date-1').hide();
                e.stopPropagation();
             });
            $(document).click(function(){
                $("#q-search-date-1").show();
            });

            $('#right_search_date_end').focus(function(e){
                $('#q-search-date-2').hide();
                e.stopPropagation();
             });
            $(document).click(function(){
                $("#q-search-date-2").show();
            });
        });
    </script>
</body>
</html>
 