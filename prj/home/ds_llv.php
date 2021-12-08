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
    <title>Danh sách lịch làm việc</title>

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
                <h3 class="d-qly-cham-cong">Danh sách lịch làm việc</h3>
                <div class="d-ds-cty-con">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12 d-ds-cty-con1">
                            <input type="text" class="d-ds-cty-input" placeholder="Nhập từ khóa">
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 d-ds-cty-con2">
                            <input type="date" class="d-ds-cty-input">
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12 d-ds-cty-con3">
                            <a href="/danh-cho-cong-ty/thiet-lap-lich-lam-viec.html" class="d-ds-cty-con3-1 d-ds-ca-lam">Thêm ca làm việc</a>
                        </div>
                    </div>
                </div>
                <div class="d-ds-cty-con2a">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12 d-ds-cty-con2a-1">
                            <div class="d-ds-phong-ban1">
                                <div>
                                    <a href="/danh-cho-cong-ty/danh-sach-nhan-vien-co-lich.html" class="d-ds-phong-ban-p">Lịch làm việc tháng 4/ 2021</a>
                                    <p class="d-ds-llv2">Áp dụng: tháng 4/2021 ( 1 nhân viên đang theo )</p>
                                    <p class="d-ds-llv">T3 hằng tuần ( 01/ 05/ 2021 - 30/ 05/ 2021)</p>
                                    <p class="ds-llv1">Ca sáng: ( 08:00 - 11:30 ) / 3.5h</p>
                                </div>
                                <div class="dropdown d-phong-ban1">
                                    <img class="dropdown-toggle d-ds-phong-banv1" type="button" data-toggle="dropdown" 
                                    src="../images/them.svg">
                                    <ul class="dropdown-menu">
                                        <li><a href="/danh-cho-cong-ty/sua-lich-lam-viec.html" class="d-phong-ban-1">Sửa</a></li>
                                        <li><a class="d-phong-ban-1">Xóa</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 d-ds-cty-con2a-1">
                            <div class="d-ds-phong-ban1">
                                <div>
                                    <a href="/danh-cho-cong-ty/danh-sach-nhan-vien-co-lich.html" class="d-ds-phong-ban-p">Lịch làm việc tháng 4/ 2021</a>
                                    <p class="d-ds-llv2">Áp dụng: tháng 4/2021 ( 1 nhân viên đang theo )</p>
                                    <p class="d-ds-llv">T3 hằng tuần ( 01/ 05/ 2021 - 30/ 05/ 2021)</p>
                                    <p class="ds-llv1">Ca sáng: ( 08:00 - 11:30 ) / 3.5h</p>
                                </div>
                                <div class="dropdown d-phong-ban1">
                                    <img class="dropdown-toggle d-ds-phong-banv1" type="button" data-toggle="dropdown" 
                                    src="../images/them.svg">
                                    <ul class="dropdown-menu">
                                        <li><a class="d-phong-ban-1" data-toggle="modal" data-target="#sua_cty">Sửa</a></li>
                                        <li><a class="d-phong-ban-1">Xóa</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 d-ds-cty-con2a-1">
                            <div class="d-ds-phong-ban1">
                                <div>
                                    <a href="/danh-cho-cong-ty/danh-sach-nhan-vien-co-lich.html" class="d-ds-phong-ban-p">Lịch làm việc tháng 4/ 2021</a>
                                    <p class="d-ds-llv2">Áp dụng: tháng 4/2021 ( 1 nhân viên đang theo )</p>
                                    <p class="d-ds-llv">T3 hằng tuần ( 01/ 05/ 2021 - 30/ 05/ 2021)</p>
                                    <p class="ds-llv1">Ca sáng: ( 08:00 - 11:30 ) / 3.5h</p>
                                </div>
                                <div class="dropdown d-phong-ban1">
                                    <img class="dropdown-toggle d-ds-phong-banv1" type="button" data-toggle="dropdown" 
                                    src="../images/them.svg">
                                    <ul class="dropdown-menu">
                                        <li><a class="d-phong-ban-1" data-toggle="modal" data-target="#sua_cty">Sửa</a></li>
                                        <li><a class="d-phong-ban-1">Xóa</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 d-ds-cty-con2a-1">
                            <div class="d-ds-phong-ban1">
                                <div>
                                    <a href="/danh-cho-cong-ty/danh-sach-nhan-vien-co-lich.html" class="d-ds-phong-ban-p">Lịch làm việc tháng 4/ 2021</a>
                                    <p class="d-ds-llv2">Áp dụng: tháng 4/2021 ( 1 nhân viên đang theo )</p>
                                    <p class="d-ds-llv">T3 hằng tuần ( 01/ 05/ 2021 - 30/ 05/ 2021)</p>
                                    <p class="ds-llv1">Ca sáng: ( 08:00 - 11:30 ) / 3.5h</p>
                                </div>
                                <div class="dropdown d-phong-ban1">
                                    <img class="dropdown-toggle d-ds-phong-banv1" type="button" data-toggle="dropdown" 
                                    src="../images/them.svg">
                                    <ul class="dropdown-menu">
                                        <li><a class="d-phong-ban-1" data-toggle="modal" data-target="#sua_cty">Sửa</a></li>
                                        <li><a class="d-phong-ban-1">Xóa</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 d-ds-cty-con2a-1">
                            <div class="d-ds-phong-ban1">
                                <div>
                                    <a href="/danh-cho-cong-ty/danh-sach-nhan-vien-co-lich.html" class="d-ds-phong-ban-p">Lịch làm việc tháng 4/ 2021</a>
                                    <p class="d-ds-llv2">Áp dụng: tháng 4/2021 ( 1 nhân viên đang theo )</p>
                                    <p class="d-ds-llv">T3 hằng tuần ( 01/ 05/ 2021 - 30/ 05/ 2021)</p>
                                    <p class="ds-llv1">Ca sáng: ( 08:00 - 11:30 ) / 3.5h</p>
                                </div>
                                <div class="dropdown d-phong-ban1">
                                    <img class="dropdown-toggle d-ds-phong-banv1" type="button" data-toggle="dropdown" 
                                    src="../images/them.svg">
                                    <ul class="dropdown-menu">
                                        <li><a class="d-phong-ban-1" data-toggle="modal" data-target="#sua_cty">Sửa</a></li>
                                        <li><a class="d-phong-ban-1">Xóa</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 d-ds-cty-con2a-1">
                            <div class="d-ds-phong-ban1">
                                <div>
                                    <a href="/danh-cho-cong-ty/danh-sach-nhan-vien-co-lich.html" class="d-ds-phong-ban-p">Lịch làm việc tháng 4/ 2021</a>
                                    <p class="d-ds-llv2">Áp dụng: tháng 4/2021 ( 1 nhân viên đang theo )</p>
                                    <p class="d-ds-llv">T3 hằng tuần ( 01/ 05/ 2021 - 30/ 05/ 2021)</p>
                                    <p class="ds-llv1">Ca sáng: ( 08:00 - 11:30 ) / 3.5h</p>
                                </div>
                                <div class="dropdown d-phong-ban1">
                                    <img class="dropdown-toggle d-ds-phong-banv1" type="button" data-toggle="dropdown" 
                                    src="../images/them.svg">
                                    <ul class="dropdown-menu">
                                        <li><a class="d-phong-ban-1" data-toggle="modal" data-target="#sua_cty">Sửa</a></li>
                                        <li><a class="d-phong-ban-1">Xóa</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="phan-trang">
                    <div class="pagination">
                        <li><a href="#">&laquo;</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <? include('../includes/inc_footer.php') ?>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/select2.min.js"></script>
<script src="../js/lazysizes.min.js"></script>
<script>
    $(document).ready(function () {
        $('#cong_ty').select2({
            placeholder: "Chọn công ty",
            width: "100%",
        });
        $('#chon_cty').select2({
            placeholder: "Chọn công ty mẹ",
            width: "100%",
        });
        $('#phong_ban').select2({
            placeholder: "Chọn công ty mẹ",
            width: "100%",
        });
    });
</script>
</body>
</html>
