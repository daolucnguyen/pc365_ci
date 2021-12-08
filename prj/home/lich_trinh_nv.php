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
    <title>Lịch Trình Nhân Viên</title>

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
                <h3 class="d-qly-cham-cong">Lịch trình nhân viên</h3>
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
                                <div class="col-md-3 col-sm-6 col-xs-6 d-qly-cham-cong1-map">
                                    <a href="/danh-cho-cong-ty/tao-lich-trinh.html" class="d-lich-trinh-nv">Tạo lịch trình</a>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-6 d-qly-cham-cong1-v1a3">
                                    <div class="d-xuat-excel">Xuất Excel</div>
                                </div>
                            </div>
                    </div>
                    <div class="d-qly-cham-cong1-v3">
                        <div class="d-qly-nhan-vien1">
                            <div class="d-ds-nv1 active" id="ds_nhan_vien">
                                <table class="table-hover d-table-lich-trinh">
                                    <thead>
                                        <tr class="d-table-nv-tr">
                                            <th class="d-table-nv-th d-tb-nv-th1">Thông tin nhân viên ( ID )</th>
                                            <th class="d-table-nv-th">Tên lịch trình</th>
                                            <th class="d-table-nv-th">Ngày tháng</th>
                                            <th class="d-table-nv-th">Ghi chú</th>
                                            <th class="d-table-nv-th">Trạng thái</th>
                                            <th class="d-table-nv-th d-tb-nv-th"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="d-table-nv-tr1">
                                            <td class="text-center d-table-nv-td">
                                                <div class="d-info-nv">
                                                    <img src="../images/Ellipse124.svg" alt="name_nv" class="d-info-img">
                                                    <div class="d-cham-cong-td1a">
                                                        <p class="d-cham-cong-p">(162) Ngô Ngọc Yến</p>
                                                        <p class="d-cham-cong-p1">Nhân viên phòng kĩ thuật</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center d-table-nv-td">
                                                <p class="d-cham-cong-p">Đến chỗ Hà Đông lấy hồ sơ</p>
                                            </td>
                                            <td class="text-center d-table-nv-td">
                                                <p class="d-ghi-nv">01/01/ 2021</p>
                                            </td>
                                            <td class="text-center d-table-nv-td">
                                                <p class="d-ghi-nv">Mặc áo mưa</p>
                                            </td>
                                            <td class="text-center d-table-nv-td">
                                                <p class="d-email-nv" style="color:#1F3F77;padding:0 6px;background: #EEF5FC;border-radius: 5px;">Hoàn thành</p>
                                                <p class="d-email-nv" style="color: #F79722;padding:0 6px;background: rgba(247, 151, 34, 0.1);border-radius: 5px; display:none">Đang làm</p>
                                                <p class="d-email-nv" style="color:#B31217;padding:0 6px;background: rgba(179, 18, 23, 0.1);border-radius: 5px; display:none">Hủy</p>
                                            </td>
                                            <td class="text-center d-table-nv-td">
                                                <div class="dropdown">
                                                    <img src="../images/them.svg" alt="3 chấm" class="dropdown-toggle d-dropdown" data-toggle="dropdown">
                                                    <div class="dropdown-menu d-dropdown-menu">
                                                        <a href="/danh-cho-cong-ty/sua-lich-trinh.html" class="d-lich-trinh">Sửa</a>
                                                        <p class="d-lich-trinh">Xóa</p>
                                                        <a href="/danh-cho-cong-ty/lich-trinh-nhan-vien-tren-map.html" class="d-lich-trinh">Theo dõi</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="d-ds-lich-trinh-mobile">
                                    <div class="d-ds-lich-trinh">
                                        <img src="../images/Ellipse124.svg" alt="name_nv" class="d-info-img">
                                        <div class="d-lich-trinh-td1a">
                                            <p class="d-cham-cong-p">(162) Ngô Ngọc Yến</p>
                                            <p class="d-cham-cong-p1">Nhân viên phòng kĩ thuật</p>
                                        </div>
                                    </div>
                                    <div class="d-lich-trinh-mobie"><p class="d-cham-cong-p">Đến chỗ Hà Đông lấy hồ sơ</p></div>
                                    <div class="d-lich-trinh-mobie"><span class="d-ghichu-nv1">Ghi chú: </span> <p class="d-ghi-nv"> Mặc áo mưa</p></div>
                                    <div class="d-lich-trinh-mobie"><p class="d-ghi-nv">01/01/ 2021</p></div>
                                    <div class="d-lich-trinh1-mobie">
                                        <p class="d-icon-them"></p>
                                        <div class="dropdown-content">
                                            <div class="d-edit-nv">
                                                <a href="javascript:void(0)" class="d-update-nv">Sửa</a>
                                                <a class="d-delete-nv">Xóa</a>
                                                <a class="d-lich-trinh">Theo dõi</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-lich-trinh2-mobie">
                                        <p class="d-email-nv" style="color:#1F3F77;padding:0 6px;background: #EEF5FC;border-radius: 5px; display:none">Hoàn thành</p>
                                        <p class="d-email-nv" style="color: #F79722;padding:0 6px;background: rgba(247, 151, 34, 0.1);border-radius: 5px;">Đang làm</p>
                                        <p class="d-email-nv" style="color:#B31217;padding:0 6px;background: rgba(179, 18, 23, 0.1);border-radius: 5px; display:none">Hủy</p>
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
                    <div class="d-modal-boloc1">
                        <select name="chi_nhanh" id="lich_trinh" class="d-chi-nhanh">
                            <option value=""></option>
                            <option value="1">dasda</option>
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
    <!-- modal thêm nv -->
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
        
        $(".d-ds-nhan-vien").click(function(){
            $('.d-ds-nhan-vien').addClass('active');
            $('.d-ds-nv').removeClass('active');
            $('#ds_nhan_vien').addClass('active');
            $('#ds_nv_chua_duyet').removeClass('active');
        });
        $(".d-ds-nv").click(function(){
            $('.d-ds-nv').addClass('active');
            $('.d-ds-nhan-vien').removeClass('active');
            $('#ds_nv_chua_duyet').addClass('active');
            $('#ds_nhan_vien').removeClass('active');
        });
        $(".tick-all").click(function(){
            if (!$(this).hasClass("checked")) {
                $(this).addClass('checked').attr('src','../images/chon_all.svg');
                $('.tick-chon').addClass('checked').attr('src','../images/tick_xanh.svg');
                $('.bo-chon').removeClass('checked').attr('src','../images/k_chon.svg');
            }else{
                $(this).removeClass('checked').attr('src','../images/tick.svg');
                $('.tick-chon').removeClass('checked').attr('src','../images/tick.svg');
            }
        });
        $('.tick-chon').click(function(){
            if (!$(this).hasClass("checked")) {
                $(this).addClass('checked').attr('src','../images/tick_xanh.svg');
                $('.bo-chon').removeClass('checked').attr('src','../images/k_chon.svg');
            }
        });
        $('.bo-chon').click(function(){
            if (!$(this).hasClass("checked")) {
                $(this).addClass('checked').attr('src','../images/k_chon1.svg');
                $('.tick-chon').removeClass('checked').attr('src','../images/tick.svg');
                $(".tick-all").removeClass('checked').attr('src','../images/tick.svg');
            }
        });
    });
</script>
</body>
</html>
