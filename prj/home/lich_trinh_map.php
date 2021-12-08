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
    <title>Lịch trình nhân viên XX trên bản đồ</title>

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
                <h3 class="d-qly-cham-cong">Lịch trình nhân viên XX trên bản đồ</h3>
                <div class="d-lich-trinh-map">
                    <div class="d-lich-trinh-map1">
                        <img src="../images/maps.svg" alt="map" class="d-lich-trinh-map-img">
                    </div>
                    <div class="lich-trinh-map2">
                        <div class="d-lich-trinh-map2-v1">
                            <div class="d-lich-trinh-map2-img">
                                <img src="../images/Ellipse124.svg" alt="name" class="lich-trinh-map-img"
                                onerror='this.onerror=null;this.src="../images/avt_login.svg";'>
                            </div>
                            <div class="d-lich-trinh-map2-v1a">
                                <p class="d-lich-trinh-map2-v1p">(162) Ngô Ngọc Yến</p>
                                <p class="d-lich-trinh-map2-v1b">Nhân viên phòng kĩ thuật</p>
                            </div>
                        </div>
                        <div class="d-lich-trinh-map2-v2">
                            <a class="d-map2-v1">
                                <p class="d-map2-v1-img"></p> 
                                <p class="d-map2-v1-delete">Xóa</p>
                            </a>
                            <a class="d-map2-v2">
                                <p class="d-map2-v1-img1"></p> 
                                <p class="d-map2-v1-delete">Sửa</p>
                            </a>
                        </div>
                        <div class="d-lich-trinh-map2-v3">
                            <div class="d-lich-trinh-map2-v3a">
                                <p class="d-lich-trinh-map2-v3a-1">Lịch trình ngày 20/04/2021</p>
                                <p class="d-lich-trinh-map2-v3a-2" style="background:#EEF5FC;color:#1F3F77;display:;">Hoàn thành</p>
                                <p class="d-lich-trinh-map2-v3a-2" style="background:rgba(247, 151, 34, 0.1);color:#F79722;display:none;">Đang làm</p>
                            </div>
                            <div class="d-lich-trinh-map2-v3b">
                                <h3 class="d-lich-trinh-map2-v3b-1">Đến Chỗ XYZ để lấy hồ sơ</h3>
                                <p class="d-lich-trinh-map20-v3b-2">Ghi chú: Đeo khẩu trang trước khi vào tòa nhà</p>
                            </div>
                        </div>
                        <div class="d-lich-trinh-map2-v4">
                            <div class="d-lich-trinh-map2-v4a" id="scroll">
                                <div class="d-dichuyen">
                                    <p><img src="../images/dot_blue.svg" alt="dot" class="d-dichuyen-img"> <span class="d-dichuyen-sp">Từ:</span></p>
                                    <input type="text" class="d-lich-map-input" placeholder="Nhập điểm xuất phát">
                                </div>
                                <div class="d-lich-map">
                                    <p class="d-lich-map-p"><img src="../images/dot_blue.svg" alt="dot" class="d-dichuyen-img"> <span class="d-dichuyen-sp">Đến số 1:</span></p>
                                    <input type="text" class="d-lich-map-input" placeholder="Nhập điểm đến">
                                    <!-- <img src="../images/Delete.svg" alt="xóa" class="d-delete-img"> -->
                                </div>
                            </div>
                            <div class="d-them-diem">
                                <p class="d-them-diem-dung1" id="them_diem_dung">Thêm Điểm Dừng</p>
                            </div>                            
                        </div>
                        <div class="d-lich-trinh-map2-v5">
                            <p class="d-lich-trinh-map2-v5a">Đồng hành trình</p>
                            <div class="d-lich-map-v5">
                                <img src="../images/Ellipse124.svg" alt="name" class="d-lich-map-v5-img"
                                onerror='this.onerror=null;this.src="../images/avt_login.svg";'>
                                <img src="../images/Ellipse124.svg" alt="name" class="d-lich-map-v5-img1"
                                onerror='this.onerror=null;this.src="../images/avt_login.svg";'>
                                <img src="../images/Ellipse124.svg" alt="name" class="d-lich-map-v5-img2"
                                onerror='this.onerror=null;this.src="../images/avt_login.svg";'>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('../includes/inc_footer.php');?>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/select2.min.js"></script>
<script src="../js/Chart.min.js"></script>
<script>
    $(document).ready(function () {
        $('#them_diem_dung').click(function(){
            i = 1;
            let dem = i + 1;
            html = `
            <div class="d-lich-map">
                <p class="d-lich-map-p"><img src="../images/dot_blue.svg" alt="dot" class="d-dichuyen-img"> <span class="d-dichuyen-sp">Đến số `+dem+`:</span></p>
                <input type="text" class="d-lich-map-input" placeholder="Nhập điểm đến">
                <img src="../images/cancel.svg" alt="xóa" class="d-cancel-img" onClick="deletes(this)">
            </div>`;
            $(".d-lich-trinh-map2-v4a").append(html);
        });
    });
    function deletes(e) {
        dom_parent = $(e).parent().remove();
    }
</script>
</body>
</html>
