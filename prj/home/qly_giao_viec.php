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
    <title>Giao việc</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/select2.min.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/quan_ly_cty.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="d-quan-ly-cty">
        <?php include "../includes/sidebar_left_cty.php";?>
        <div class="d-quan-ly-cty1">
            <?php include "../includes/header_manager.php";?>
            <div class="d-qly-cty1-v1">
                <h3 class="d-qly-cham-cong">Giao việc</h3>
                <div class="d-qly-cham-cong1">
                    <div class="lich-trinh-nv">
                        <div class="d-qly-cham-cong1-v1">
                            <div class="col-md-6 col-sm-12 col-xs-12 d-qly-cham-cong1-v1a">
                                <input type="text" value="" id="search" name="search" class="d-qly-cham-cong1-v1a-input"
                                placeholder="Nhập từ khóa">
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 d-qly-lich-trinh-v1a1">
                                <input type="date" value="" id="search" name="search" class="d-qly-cham-cong1-v1a-input">
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 d-qly-lich-trinh1-v1a2">
                                <input type="date" value="" id="search" name="search" class="d-qly-cham-cong1-v1a-input">
                            </div>
                        </div>
                        <div class="d-qly-lich-trinh">
                            <div class="col-sm-7 col-xs-12 d-bo-loc-lich" data-toggle="modal" data-target="#bo_loc">
                                <p class="d-filter-p">Lọc tìm kiếm</p>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 d-giao-viec">
                                <select name="trang_thai" id="trang_thai" class="trang-thai">
                                    <option value="">Trạng thái công việc</option>
                                    <option value="1">zzchihih</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-6 d-giao-viec1">
                                <a href="/danh-cho-cong-ty/tao-cong-viec.html" class="d-giao-viec-nv">Tạo công việc</a>
                            </div>
                        </div>
                        <div class="d-giao-viec-1">
                            <p class="d-giao-viec-1a">Hôm nay</p>
                        </div>
                        <div class="d-giao-viec-2">
                            <div class="row d-giaoviec2">
                                <div class="d-giao-viec-2a">
                                    <p class="d-giao-viec-2a-1">Đang làm</p>
                                    <p class="d-giao-viec-2a-1" style="color:#185DA0;display:none;">Hoàn thành</p>
                                    <p class="d-giao-viec-2a-1" style="color:#999999;display:none;">Hủy</p>
                                    <a href="javascript:void(0)" class="d-giao-viec-2a-2">Check AMP của 5 site tin tức đồng thời check giao diện .vn</a>
                                    <p class="d-giao-viec-2a-3">123 Định Công, Hoàng Mai, Hà Nội</p>
                                    <div class="d-giao-viec-2a-4">
                                        <div class="d-giaoviec-2a-4">
                                            <img src="../images/Ellipse124.svg" alt="name" class="d-lich-map-v5-img"
                                            onerror='this.onerror=null;this.src="../images/avt_login.svg";'>
                                            <img src="../images/Ellipse124.svg" alt="name" class="d-lich-map-v5-img1"
                                            onerror='this.onerror=null;this.src="../images/avt_login.svg";'>
                                            <img src="../images/Ellipse124.svg" alt="name" class="d-lich-map-v5-img2"
                                            onerror='this.onerror=null;this.src="../images/avt_login.svg";'>
                                        </div>
                                        <div class="d-giaoviec-2a-4">
                                            <p class="d-giaoviec-2a-time">T2,01/01/2021</p>
                                            <p class="d-giaoviec-2a-time">04:00pm - 06:00pm</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-giao-viec-2a">
                                    <p class="d-giao-viec-2a-1">Đang làm</p>
                                    <p class="d-giao-viec-2a-1" style="color:#185DA0;display:none;">Hoàn thành</p>
                                    <p class="d-giao-viec-2a-1" style="color:#999999;display:none;">Hủy</p>
                                    <h3 class="d-giao-viec-2a-2">Check AMP của 5 site tin tức đồng thời check giao diện .vn</h3>
                                    <p class="d-giao-viec-2a-3">123 Định Công, Hoàng Mai, Hà Nội</p>
                                    <div class="d-giao-viec-2a-4">
                                        <div class="d-giaoviec-2a-4">
                                            <img src="../images/Ellipse124.svg" alt="name" class="d-lich-map-v5-img"
                                            onerror='this.onerror=null;this.src="../images/avt_login.svg";'>
                                            <img src="../images/Ellipse124.svg" alt="name" class="d-lich-map-v5-img1"
                                            onerror='this.onerror=null;this.src="../images/avt_login.svg";'>
                                            <img src="../images/Ellipse124.svg" alt="name" class="d-lich-map-v5-img2"
                                            onerror='this.onerror=null;this.src="../images/avt_login.svg";'>
                                        </div>
                                        <div class="d-giaoviec-2a-4">
                                            <p class="d-giaoviec-2a-time">T2,01/01/2021</p>
                                            <p class="d-giaoviec-2a-time">04:00pm - 06:00pm</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-giao-viec-2a">
                                    <p class="d-giao-viec-2a-1">Đang làm</p>
                                    <p class="d-giao-viec-2a-1" style="color:#185DA0;display:none;">Hoàn thành</p>
                                    <p class="d-giao-viec-2a-1" style="color:#999999;display:none;">Hủy</p>
                                    <h3 class="d-giao-viec-2a-2">Check AMP của 5 site tin tức đồng thời check giao diện .vn</h3>
                                    <p class="d-giao-viec-2a-3">123 Định Công, Hoàng Mai, Hà Nội</p>
                                    <div class="d-giao-viec-2a-4">
                                        <div class="d-giaoviec-2a-4">
                                            <img src="../images/Ellipse124.svg" alt="name" class="d-lich-map-v5-img"
                                            onerror='this.onerror=null;this.src="../images/avt_login.svg";'>
                                            <img src="../images/Ellipse124.svg" alt="name" class="d-lich-map-v5-img1"
                                            onerror='this.onerror=null;this.src="../images/avt_login.svg";'>
                                            <img src="../images/Ellipse124.svg" alt="name" class="d-lich-map-v5-img2"
                                            onerror='this.onerror=null;this.src="../images/avt_login.svg";'>
                                        </div>
                                        <div class="d-giaoviec-2a-4">
                                            <p class="d-giaoviec-2a-time">T2,01/01/2021</p>
                                            <p class="d-giaoviec-2a-time">04:00pm - 06:00pm</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-qly-cham-cong2">
                    <div class="phan-trang">dành cho phân trang</div>
                </div>
            </div>
        </div>

    </div>
    <!-- modal map -->
    
    <div class="modal fade" id="follow_map">
        <div class="modal-dialog d-modal-dialog">
            <div class="modal-content d-modal-content-map">
                <div class="modal-header modal-follow-map">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <img src="../images/close.svg" alt="exit" class="follow-map-img">
                    </button>
                </div>
                <div class="modal-body d-follow-map">
                    <div class="d-follow-map1">
                        <img src="../images/img_map.svg" alt="map" class="d-follow-map1-img">
                    </div>
                    <div class="d-follow-map2">
                        <h4 class="d-follow-map2-v1">Chấm công ngày 19/4/2021</h4>
                        <div class="d-follow-map2-v2">
                            <table class="d-follow-map2-table">
                                <thead>
                                    <tr>
                                        <th class="d-follow-map-th">Thông tin</th>
                                        <th class="d-follow-map-th">Ca làm việc</th>
                                        <th class="d-follow-map-th">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="d-follow-map-td">
                                            <div class="d-follow-map2-v2a">
                                                <img src="../images/Ellipse124.svg" alt="ten nv" class="d-follow-map2-v2a-img">
                                                <div class="d-follow-map2-v2b">
                                                    <p class="d-follow-map2-v2a-p">(162) Ngô Ngọc Yến</p>
                                                    <p class="d-follow-map2-v2a-p1">Nhân viên phòng kĩ thuật</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="d-follow-map-td">
                                            <p class="d-follow-map2-v2a-p2">Ca Sáng  ( 08:00 - 11:30 )</p>
                                        </td>
                                        <td class="d-follow-map-td">
                                            <div class="d-follow-map-v2">
                                                <p class="d-follow-map2-v2a-p3">Đúng giờ</p>
                                                <p class="d-follow-map2-v2a-p4" style="display:none">Đi muộn</p>
                                                <p class="d-follow-map2-v2a-p5" style="display:none">Về sớm</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal bộ lọc -->
    
    <div class="modal fade" id="bo_loc">
        <div class="modal-dialog d-modal-bo-loc">
            <div class="modal-content d-modal-bo-loc1">
                <div class="modal-header d-modal-bo-loc2">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <img src="../images/exit.svg" alt="exit" class="follow-map-img">
                    </button>
                    <h4 class="modal-title d-boloc-p">Lọc tìm kiếm</h4>
                </div>
                <form class="d-modal-boloc">
                    <div class="d-modal-boloc1">
                        <select name="cty" id="cty" class="d-chi-nhanh">
                            <option value=""></option>
                            <option value="1">dasda</option>
                        </select>
                    </div>
                    <div class="d-modal-boloc1">
                        <select name="phong_ban" id="phong_ban" class="d-phong-ban">
                            <option value=""></option>
                            <option value="1">1</option>
                        </select>
                    </div>
                    <div class="d-modal-boloc2">
                        <button type="button" class="d-modal-boloc-huy" data-dismiss="modal" aria-hidden="true">Hủy</button>
                        <button type="submit" class="d-modal-boloc-tk">Tìm kiếm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <? include('../includes/inc_footer.php') ?>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/select2.min.js"></script>
<script src="../js/Chart.min.js"></script>
<script>
    $(document).ready(function () {
        $('.d-dropdown').hover(function(){
            $(this).attr('src','../images/them1.svg');},
            function(){
            $(this).attr('src','../images/them.svg');
        });
        // $('.d-dropdown').After(function(){
        //     $(this).attr('src','../images/them1.svg');},
        //     function(){
        //     $(this).attr('src','../images/them.svg');
        // });

        $('#cty').select2({
            placeholder: 'Chọn công ty',
            width: "100%"
        });
        $('#phong_ban').select2({
            placeholder: 'Chọn phòng ban',
            width: "100%"
        });
        $('#lich_trinh').select2({
            placeholder: 'Chọn lịch trinh',
            width: "100%"
        });
        $('#trang_thai').select2({
            placeholder: 'Trạng thái công việc',
            width: "100%",
        });
    });
</script>
</body>
</html>
