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
    <title>Nhận việc</title>

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
            <div class="row q-contain-row">
                <div class="col-lg-3 col-md-3 q-contain-left">
                    <? include('../includes/nv_menu_qly.php') ?>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 q-contain-right">
                    <?include('../includes/nv_menu_header.php') ?>
                <div class="q-right" id="right_nhanviec">
                    <div class="q-right-title" id="right_title">
                        <p>Nhận việc</p>
                    </div>
                    <div class="q-right-contain-nhanviec" id="q_right_contain">
                        <div class="q-right-search">
                            <form action="" class="q-right-search-form">
                                <img src="../images/Search.png" alt="category" id="search-key-img">
                                <input type="text" name="" id="right_search_key" class="q-search-input" placeholder="Nhập từ khóa">
                                <div class="q-right-search-form-div">
                                    <div class="q-search-input-div" id="search_input_left">
                                        <input type="text" name="" class="q-search-input-lichtrinh" id="right_search_date_begin" placeholder="Từ ngày" onfocus="(this.type='date')" onblur="(this.type='text')">
                                        <img src="../images/Calendar.png" alt="caledar" class="q-search-date" id="img_date_begin">
                                    </div>
                                    <div class="q-search-input-div" id="search_input_right">
                                        <input type="text" name="" class="q-search-input-lichtrinh" id="right_search_date_end" placeholder="Đến ngày" onfocus="(this.type='date')" onblur="(this.type='text')">
                                        <img src="../images/Calendar.png" alt="caledar"class="q-search-date" id="img_date_end">
                                    </div>
                                </div>
                                <button type="button" class="q-modal-button" data-toggle="modal" data-target="#myModal">
                                    <img src="../images/Filter 2.png" alt="filter">
                                    <span>Lọc Tìm Kiếm</span>
                                </button>
                            </form>
                            <div class="q-modal-lichtrinh">
                                <div id="myModal" class="modal fade q-modal-div" role="dialog">
                                    <div class="modal-dialog q-modal-div">
                                        <div class="modal-content q-modal-content">
                                            <div class="modal-header q-modal-header">
                                                <p class="q-modal-header-title">Lọc Tìm Kiếm</p>
                                                <button type="button" class="close" data-dismiss="modal" id="modal_button_header">
                                                    <img src="../images/x.png" alt="x" class="q-modal-button-img">
                                                </button>
                                            </div>
                                            <div class="modal-body q-modal-body">
                                                <form action="" class="q-modal-form">
                                                    <div class="q-modal-input-div">
                                                        <input type="text" name="" id="modal_search_date_begin" class="q-search-input" placeholder="Từ ngày" onfocus="(this.type='date')" onblur="(this.type='text')">
                                                        <img src="../images/Calendar.png" alt="caledar" class="q-search-date" id="modal_date_1">
                                                    </div>
                                                    <div class="q-modal-input-div">
                                                        <input type="text" name="" id="modal_search_date_end" class="q-search-input" placeholder="Đến ngày" onfocus="(this.type='date')" onblur="(this.type='text')">
                                                        <img src="../images/Calendar.png" alt="caledar"class="q-search-date" id="modal_date_2">
                                                    </div>
                                                    <select class="q-right-select2 q-search-input" name="">
                                                        <option id="q-right-select2-choice" value="" >Trạng thái lịch trình</option>
                                                        <option class="q-right-select2-choice" value="">Hoàn thành</option>
                                                        <option class="q-right-select2-choice" value="">Đang làm</option>
                                                        <option class="q-right-select2-choice" value="">Hủy</option>
                                                    </select>
                                                    <div class="q-modal-lichtrinh-button">
                                                        <button type="button" class="btn btn-default q-modal-lichtrinh-button-close" data-dismiss="modal">Hủy</button>
                                                        <button type="submit" name="modal-submit" class="q-moadal-lichtrinh-submit"><span>Tìm Kiếm</span></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="q-excel-div">
                            <button class="q-excel-nhanviec"><span>Xuất Excel</span></button>
                        </div>
                        <div class="select-nhanviec">
                            <select class="q-right-select2-nhanviec" name="">
                                <option id="q-right-select2-choice" value="" >Trạng thái công việc</option>
                                <option class="q-right-select2-choice" value="">Hoàn thành</option>
                                <option class="q-right-select2-choice" value="">Đang làm</option>
                                <option class="q-right-select2-choice" value="">Hủy</option>
                            </select>
                            <!-- <div class="select-icon-nhanviec">
                                <img src="../images/select.png" alt="down" class="select-down-nhanviec">
                            </div> -->
                        </div>
                        <div class="q-right-nhanviec">
                                <div class="q-right-work" data-link="/danh-cho-nhan-vien/chi-tiet-cong-viec.html">
                                    <div class="q-right-work-status q-work-danglam">
                                        <div class="q-work-status-dot q-work-danglam-dot"></div>
                                        <p class="q-right-work-text">Đang làm</p>
                                    </div>
                                    <div class="q-right-work-title">
                                        <p class="q-right-work-title-v2">Check AMP của 5 site tin tức đồng thời check giao diện .vn</p>
                                    </div>
                                    <div class="q-right-work-address">
                                        <p class="q-right-work-address-v2">123 Định Công, Hoàng Mai, Hà Nội</p>
                                    </div>
                                    <div class="q-right-work-avatar">
                                        <p> <img src="" alt="avatar" class="q-right-work-avatar-v2"></p>
                                    </div>
                                    <div class="q-right-work-time">
                                        <p class="q-right-work-time-day">T2,01/01/2021</p>
                                        <p class="q-right-work-time-hour">04:00pm - 06:00pm</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="q-pagin">
                    <a href="" class="q-pagin-link q-pagin-link-active" id="pagin_link_1"><span>1</span></a>
                    <a href="" class="q-pagin-link" id="pagin_link_2"><span>2</span></a>
                    <a href="" class="q-pagin-link"><span>></span></a>
                </div>
            </div>
    </div>
    <? include('../includes/inc_footer.php') ?>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.q-right-select2-nhanviec').select2({
                width:'30%'
            });
            $('.q-right-select2').select2();

            $('.item-drop').click(function () {
                $('.menu-drop').toggleClass('hide');
            });

            $('#link-4').addClass('link-active');
            $('#link-4').removeClass('menu-link');
            $('#link-4-drop').addClass('link-active');
            $('#link-4-drop').removeClass('menu-link');

            $('#menu_work').css('background-image','url(../images/Work-active.png)');

            $('#menu_cat_drop').attr('src','../images/Category.png');
            $('#menu_scan_drop').attr('src','../images/Scan.png');
            $('#menu_location_drop').attr('src','../images/Location.png');
            $('#menu_work_drop').attr('src','../images/Work-active.png');
            
            $(".q-right-work").click(function(){
                $("#q-right-details-work").click();
            });

            $("[data-link]").click(function() {
                        window.location.href = $(this).attr("data-link");
                        return false;
            });

            $('#modal_search_date_begin').focus(function(e){
                $('#modal_search_date_1').hide();
                $('#modal_date_1').hide();
                e.stopPropagation();
             });
            $(document).click(function(){
                $("#modal_search_date_1").show();
                $("#modal_date_1").show();
            });

            $('#modal_search_date_end').focus(function(e){
                $('#modal_search_date_2').hide();
                $('#modal_date_2').hide();
                e.stopPropagation();
             });
            $(document).click(function(){
                $("#modal_search_date_2").show();
                $("#modal_date_2").show();
            });


            $('#right_search_date_begin').focus(function(e){
                $('#img_date_begin').hide();
                e.stopPropagation();
            });
            $(document).click(function(){
                $('#img_date_begin').show();
            });
            $('#right_search_date_end').focus(function(e){
                $('#img_date_end').hide();
                e.stopPropagation();
            });
            $(document).click(function(){
                $('#img_date_end').show();
            });
        });
    </script>
</body>
</html>
 