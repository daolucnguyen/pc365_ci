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
    <title>QUẢN LÝ CHUNG</title>

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
                <h3 class="d-qly-cham-cong">Quản lí chấm công</h3>
                <div class="d-qly-cham-cong1">
                    <div class="d-qly-cc">
                        <?php include "../includes/inc_timkiem.php";?>
                    </div>
                    <div class="d-qly-cham-cong1-v3">
                        <table class="d-qly-cham-cong1-v3a"> 
                            <thead>
                                <tr class="d-qly-cham-cong1-v3a-tr">
                                    <th class="text-center d-qly-cham-cong-th">
                                        <p class="d-qly-cham-cong-p">Thông tin nhân viên ( ID )</p>
                                    </th>
                                    <th class="text-center d-qly-cham-cong-th">
                                        <p class="d-qly-cham-cong-p">Ngày tháng</p>
                                    </th>
                                    <th class="text-center d-qly-cham-cong-th">
                                        <p class="d-qly-cham-cong-p">Ca Sáng</p>
                                        <p class="d-qly-cham-cong-p1">( 08:00 - 11:30 )</p>
                                    </th>
                                    <th class="text-center d-qly-cham-cong-th">
                                        <p class="d-qly-cham-cong-p">Ca Chiều</p>
                                        <p class="d-qly-cham-cong-p1">( 14:00 - 18:00 )</p>
                                    </th>
                                    <th class="text-center d-qly-cham-cong-th">
                                        <p class="d-qly-cham-cong-p">Ca Tối</p>
                                        <p class="d-qly-cham-cong-p1">( 18:00 - 22:00 )</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    <td class="d-qly-cham-cong-td">
                                        <div class="d-qly-cham-cong-td1">
                                            <div class="d-cham-cong-td1-img">
                                                <img src="../images/Ellipse124.svg" alt="teen nv" class="d-cham-cong-td-img">
                                            </div>
                                            <div class="d-cham-cong-td1a">
                                                <p class="d-cham-cong-p">(162) Ngô Ngọc Yến</p>
                                                <p class="d-cham-cong-p1">Nhân viên phòng kĩ thuật</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center d-qly-cham-cong-td">
                                        <p class="d-cham-cong-p2">01/01/ 2021</p>
                                    </td>
                                    <td class="text-center d-qly-cham-cong-td">
                                        <p class="d-cham-cong-p2">Vào ca: 07:45</p>
                                        <p class="d-cham-cong-p2">Ra ca: 18:45</p>
                                    </td>
                                    <td class="text-center d-qly-cham-cong-td">
                                        <p class="d-cham-cong-p2">Vào ca: 07:45</p>
                                        <p class="d-cham-cong-p2">Ra ca: 18:45</p>
                                    </td>
                                    <td class="text-center d-qly-cham-cong-td">
                                        <p class="d-cham-cong-p2">Vào ca: 07:45</p>
                                        <p class="d-cham-cong-p2">Ra ca: 18:45</p>
                                    </td>
                                </tr>
                            </tbody>
                            
                        </table>
                        
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
                        <input type="date" value="" id="search" name="search" class="d-qly-cham-cong1-v1a-input">
                    </div>
                    <div class="d-modal-boloc1">
                        <input type="date" value="" id="search" name="search" class="d-qly-cham-cong1-v1a-input">
                    </div>
                    <div class="d-modal-boloc1">
                        <select name="chi_nhanh" id="chi_nhanh1" class="d-chi-nhanh">
                            <option value=""></option>
                            <option value="1">dasda</option>
                        </select>
                    </div>
                    <div class="d-modal-boloc1">
                        <select name="phong_ban" id="phong_ban1" class="d-phong-ban">
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
        $('#phong_ban').select2({
            placeholder: 'Phòng ban nơi nhân viên đang làm',
            width: "100%"
        });
        $('#phong_ban1').select2({
            placeholder: 'Chọn phòng ban',
            width: "100%"
        });
        $('#chi_nhanh').select2({
            placeholder: 'Chọn chức vụ nhân viên đang giữ',
            width: "100%"
        });
        $('#chi_nhanh1').select2({
            placeholder: 'Chọn chi nhánh',
            width: "100%"
        });
    });
</script>
</body>
</html>
