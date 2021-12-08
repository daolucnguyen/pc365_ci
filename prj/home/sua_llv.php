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
    <title>Sửa lịch làm việc</title>

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
                <h3 class="d-qly-cham-cong">Sửa lịch làm việc</h3>
                <form method="post" class="d-cau-hinh" id="them_llv">
                    <h3 class="d-cau-hinh1">Chọn lịch làm việc cho công ty:</h3>
                        <div class="d-cau-hinh2">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6 d-them-llv">
                                    <input type="radio" class="them-lich d-cau-hinh-input" name="llv" id="llv1">
                                    <label for="" class="d-cau-hinh-label">Thứ 2 - Thứ 6</label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 d-them-llv">
                                    <input type="radio" class="them-lich d-cau-hinh-input1" name="llv" id="llv2">
                                    <label for="" class="d-cau-hinh-label">Thứ 2 - Thứ 7</label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 d-them-llv">
                                    <input type="radio" class="them-lich d-cau-hinh-input2" name="llv" id="llv3">
                                    <label for="" class="d-cau-hinh-label">Thứ 2 - Chủ Nhật</label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 d-them-llv">
                                    <input type="radio" class="them-lich d-cau-hinh-input2" name="llv" id="llv4">
                                    <label for="" class="d-cau-hinh-label">Tùy chỉnh</label>
                                </div>
                            </div>
                                <div class="error" id="err_llv"></div>
                        </div>
                    <div class="d-cau-hinh-3">
                        <h3 class="d-cau-hinh1">Chọn ca làm việc đang có:</h3>
                        <div class="d-cau-hinh2">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3a">
                                    <input type="checkbox" class="ca_lam cau-hinh d-cau-hinh-input" data-name="ca1" data-chon="0">
                                    <label for="" class="d-cau-hinh-label">Ca hành chính ( 08:00 am - 11:30 am)</label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3a1">
                                    <input type="checkbox" class="ca_lam cau-hinh d-cau-hinh-input1" data-name="ca2" data-chon="0">
                                    <label for="" class="d-cau-hinh-label">Ca hành chính ( 02:00 pm - 06:00 pm)</label>
                                </div>
                            </div>
                            <div class="error" id="err_calam"></div>
                            <input type="hidden" name="ca" id="ca">
                        </div>
                    </div>
                    <div class="d-cau-hinh-3">
                        <h3 class="d-cau-hinh1">Chọn ngày làm việc:</h3>
                        <div class="d-cau-hinh2">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3b">
                                    <input type="date" class="d-ten-wifi" id="date_start" name="date_start" placeholder="Chọn ngày bắt đầu">
                                    <div class="error" id="err_date_start"></div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3c">
                                    <input type="date" class="d-ten-wifi" id="date_end" name="date_end" placeholder="Chọn ngày kết thúc">
                                    <div class="error" id="err_date_end"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-cau-hinh-3">
                        <h3 class="d-cau-hinh1">Địa điểm áp dụng:</h3>
                        <div class="d-cau-hinh2">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3a">
                                    <input type="checkbox" class="itemca cau-hinh d-cau-hinh-input" data-name="dia_diem1" data-cty="0">
                                    <label for="" class="d-cau-hinh-label">Công ty cổ phần thương mại Hà Đông</label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3a1">
                                    <input type="checkbox" class="itemca cau-hinh d-cau-hinh-input1" data-name="dia_diem2" data-cty="0">
                                    <label for="" class="d-cau-hinh-label">Công ty cổ phần thương mại Hà Đông</label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3a1">
                                    <input type="checkbox" class="itemca cau-hinh d-cau-hinh-input2" data-name="dia_diem3" data-cty="0">
                                    <label for="" class="d-cau-hinh-label">Công ty cổ phần thương mại Hà Đông</label>
                                </div>
                            </div>
                            <div class="error" id="err_diadiem"></div>
                            <input type="hidden" name="dia_diem" id="dia_diem">
                        </div>
                    </div>
                    <div class="d-cau-hinh-4">
                        <button type="reset" class="d-cau-hinh-reset">Nhập lại</button>
                        <button type="submit" class="d-cau-hinh-submit">Tạo lịch làm việc</button>
                    </div>
                </form>
            </div>
        </div>
    
    </div>
    <? include('../includes/inc_footer.php') ?>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/select2.min.js"></script>
<script src="../js/lazysizes.min.js"></script>
<script src="../js/cty/them_llv.js"></script>
<script>
</script>
</body>
</html>
