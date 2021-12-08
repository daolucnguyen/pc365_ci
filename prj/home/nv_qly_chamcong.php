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
    <title>Quản lí chấm công nhân viên</title>

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
                <div class="q-right q-chamcong-right" id="right_chamcong">
                    <div class="q-right-title">
                        <span>Quản Lí Chấm Công</span>
                    </div>
                    <div class="q-right-contain">
                        <div class="q-right-search">
                            <form action="" class="q-right-search-form">
                                <img src="../images/Search.png" alt="category" id="search-key-img">
                                <input type="text" name="" id="right_search_key" class="q-search-input" placeholder="Nhập từ khóa">
                                <div class="q-search-input-div" id="search_date_1">
                                    <input type="text" name="" id="right_search_date_begin" class="q-search-input" placeholder="Từ ngày" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    <img src="../images/Calendar.png" alt="caledar" class="q-search-date" id="img_date_begin">
                                </div>
                                <div class="q-search-input-div" id="search_date_2">
                                    <input type="text" name="" id="right_search_date_end" class="q-search-input" placeholder="Đến ngày" onfocus="(this.type='date')" onblur="(this.type='text')">
                                    <img src="../images/Calendar.png" alt="caledar"class="q-search-date" id="img_date_end">
                                </div>
                            </form>
                        </div>
                        <button class="q-right-excel-chamcong"><span>Xuất Excel</span></button>
                        <div class="table-responsive q-right-table-chamcong">          
                            <table class="table" id="right_table">
                                <thead >
                                    <tr id="table_title">
                                        <th><span>Thông tin nhân viên ( ID )</span></th>
                                        <th><span>Ngày tháng</span></th>
                                        <th>
                                            <div class="table-time">
                                                <span>Ca Sáng</span>
                                                <span>( 08:00 - 11:30 )</span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="table-time">
                                                <span>Ca Chiều</span>
                                                <span>( 14:00 - 16:00 )</span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="table-time">
                                                <span>Ca Tối</span>
                                                <span>( 16:00 - 21:00 )</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="q-chamcong-tr" id="chamcong_td">
                                        <td class="q-chamcong-td">
                                            <div>
                                                <img src="../images/Delete.png" alt="avatar" class="q-chamcong-td-img">
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
                                        </td>
                                        <td><span class="table-time">01/01/2001</span></td>
                                        <td>
                                            <div class="table-time">
                                                <span>Vào ca: 12</span>
                                                <span>Ra ca: 12</span>
                                            </div>
                                        </td>
                                        <td>
                                        <div class="table-time">
                                                <span>Vào ca: 12</span>
                                                <span>Ra ca: 12</span>
                                            </div>
                                        </td>
                                        <td>
                                        <div class="table-time">
                                                <span>Vào ca: 12</span>
                                                <span>Ra ca: 12</span>
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
    </div>
    <? include('../includes/inc_footer.php') ?>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.item-drop').click(function () {
                $('.menu-drop').toggleClass('hide');
            });

            $('#link-2').addClass('link-active');
            $('#link-2').removeClass('menu-link');

            $('#link-2-drop').addClass('link-active');
            $('#link-2-drop').removeClass('menu-link');

            $('#menu_cat_drop').attr('src','../images/Category.png');
            $('#menu_scan_drop').attr('src','../images/Scan-active.png');

            $('#menu_scan').css('background-image', 'url(../images/Scan-active.png)');

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
 