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
            <div class="row q-contain-row">
                <div class="col-lg-3 col-md-3 q-contain-left">
                    <? include('../includes/nv_menu_qly.php') ?>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 q-contain-right">
                    <?include('../includes/nv_menu_header.php') ?>
                <div class="q-right" id="right_lichtrinh">
                    <div class="q-right-title" id="right_title_lichtrinh">
                        <span>Lịch Trình Của Tôi</span>
                    </div>
                    <div class="q-right-contain-lichtrinh" id="q_right_contain">
                        <div class="q-right-search">
                            <form action="" class="q-right-search-form">
                                <div class="q-right-search-div q-lichtrinh-search-div">
                                    <img src="../images/Search.png" alt="category" id="search-key-img">
                                    <input type="text" name="" id="lichtrinh_search" class="q-search-input" placeholder="Nhập từ khóa">
                                </div>
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
                                                <button type="button" class="close" id="modal_button_header" data-dismiss="modal">
                                                    <img src="../images/x.png" alt="x" class="q-modal-button-img">
                                                </button>
                                            </div>
                                            <div class="modal-body q-modal-body">
                                                <form action="" class="q-modal-form">
                                                    <div class="q-modal-input-div">
                                                        <input type="text" name="" id="modal_search_date_begin" class="q-search-input" placeholder="Từ ngày" onfocus="(this.type='date')" onblur="(this.type='text')">
                                                        <img src="../images/Calendar.png" alt="caledar" class="q-search-date" id="modal_search_date_1">
                                                    </div>
                                                    <div class="q-modal-input-div">
                                                        <input type="text" name="" id="modal_search_date_end" class="q-search-input" placeholder="Đến ngày" onfocus="(this.type='date')" onblur="(this.type='text')">
                                                        <img src="../images/Calendar.png" alt="caledar"class="q-search-date" id="modal_search_date_2">
                                                    </div>
    
                                                    <select class="q-right-select2 q-search-input" name="" id="modal_select">
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
                        <div class="q-select-lichtrinh">
                                <select class="q-right-select2 q-search-input" name="" id="nv_select2">
                                    <option id="q-right-select2-choice" value="" >Trạng thái lịch trình</option>
                                    <option class="q-right-select2-choice" value="">Hoàn thành</option>
                                    <option class="q-right-select2-choice" value="">Đang làm</option>
                                    <option class="q-right-select2-choice" value="">Hủy</option>
                                </select>
                            <button class="q-right-create-lichtrinh"><span>+ Tạo Lịch Trình</span></button>
                            <button class="q-right-excel-lichtrinh"><span>Xuất Excel</span></button>
                        </div>
                        <div class="q-right-table-lichtrinh">          
                            <table class="table" id="right_table">
                                <thead id="lichtrinh_thead">
                                    <tr class="q-lichtrinh-tr" id="table_title">
                                        <th class="table-th-first"><span>Thông tin nhân viên ( ID )</span></th>
                                        <th class="table-th-first"><span>Tên lịch trình</span></span></th>
                                        <th class="table-th-sm">
                                            <div class="table-time">
                                                <span>Ngày tháng</span>
                                            </div>
                                        </th>
                                        <th class="table-th-sm">
                                            <div class="table-time">
                                                <span>Ghi chú</span>
                                            </div>
                                        </th>
                                        <th class="table-th-sm">
                                            <div class="table-time">
                                                <span>Trạng thái</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="q-lichtrinh-tr">
                                        <td class="table-row q-chamcong-td q-lichtrinh-td table_td" id="table_td1">
                                            <div>
                                                <img src="../images/Delete.png" alt="avatar" class="q-chamcong-td-img" />
                                            </div>
                                            <div class="table-info">
                                                <div class="table-info-name">
                                                    <span>ID</span>
                                                    <span>Họ Và Tên</span>
                                                </div>
                                                <div class="table-info-lever">
                                                    Chức vụ
                                                </div>
                                            </div>
                                        </td >
                                        <td class="table_td q-lichtrinh-td" id="table_td2"><span class="table-ten-lichtrinh">01/01/2001</span></td>
                                        <td class="table_td q-lichtrinh-td" id="table_td3">
                                            <div class="table-time">
                                                <span>Vào ca: 12</span>
                                            </div>
                                        </td>
                                        <td class="table_td q-lichtrinh-td" id="table_td4">
                                            <div class="table-time">
                                                <span>Vào ca: 12</span>
                                            </div>
                                        </td>
                                        <td class="table_td q-lichtrinh-td" id="table_td5">
                                            <div class="table-time">
                                                <span class="table-status">Hoàn thành</span>
                                                <div class="q-table-option">
                                                    <button class="q-table-status" id="status_td_1">
                                                        <div class="q-table-status-dot" ></div>
                                                        <div class="q-table-status-dot"></div>
                                                        <div class="q-table-status-dot"></div>
                                                    </button>
                                                </div>
                                                <div class="q-table-status-link" id="status_link_1">
                                                    <p class="q-table-status-choice"><span class="choice-after">Sửa</span></p>
                                                    <p class="q-table-status-choice"><span class="choice-after">Xóa</span></p>
                                                    <p class="q-table-status-choice"><span>Theo dõi</span></p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
            $('.q-right-select2').select2({
                
            });

            $('.item-drop').click(function () {
                $('.menu-drop').toggleClass('hide');
            });

            $('#link-3').addClass('link-active');
            $('#link-3').removeClass('menu-link');
            $('#link-3-drop').addClass('link-active');
            $('#link-3-drop').removeClass('menu-link');

            $('#menu_location').css('background-image', 'url(../images/Location-active.png)');
            $('#menu_cat_drop').attr('src','../images/Category.png');
            $('#menu_scan_drop').attr('src','../images/Scan.png');
            $('#menu_location_drop').attr('src','../images/Location-active.png');


                    $("#status_td_1").click(function(e){ 
                        $("#status_link_1").toggle();
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
 