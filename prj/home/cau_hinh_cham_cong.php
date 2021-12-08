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
    <title>Cấu hình chấm công</title>

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
                <h3 class="d-qly-cham-cong">Cấu hình chấm công</h3>
                <form method="post" class="d-cau-hinh" id="cau_hinh">
                    <h3 class="d-cau-hinh1">Tên công ty muốn cấu hình:</h3>
                    <div class="d-cau-hinh2">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 d-cau-hinh2-v1">
                                <select name="cham_cong" id="cham_cong" class="d-cau-hinh2-v1a">
                                    <option value="">Lựa chọn công ty muốn cấu hình</option>
                                    <option value="1">gihih</option>
                                </select>
                                <div class="error" id="err_chamcong"></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-cau-hinh-3">
                        <h3 class="d-cau-hinh1">Chọn cấu hình chấm công hợp lệ:</h3>
                        <div class="d-cau-hinh2">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-12 d-cau-hinh3a">
                                    <input type="checkbox" class="cau-hinh d-cau-hinh-input" data-name="face" data-chon="0">
                                    <label class="d-cau-hinh-label">Nhận diện khuôn mặt</label>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6 d-cau-hinh3a1">
                                    <input type="checkbox" class="cau-hinh d-cau-hinh-input1" data-name="vitri" data-chon="0">
                                    <label class="d-cau-hinh-label">Vị trí</label>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6 d-cau-hinh3a1">
                                    <input type="checkbox" class="cau-hinh d-cau-hinh-input2" data-name="wifi" data-chon="0">
                                    <label class="d-cau-hinh-label">Wifi</label>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 error" id="err_cauhinh"></div>
                                <input type="hidden" name="chon" id="chon">
                            </div>
                        </div>
                    </div>
                    <div class="d-cau-hinh-3">
                        <h3 class="d-cau-hinh1">Wifi mặc định để chấm công:</h3>
                        <div class="d-cau-hinh2">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3b">
                                    <input type="text" class="d-ten-wifi" id="ten_wifi" name="ten_wifi" placeholder="Tên wifi">
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3c">
                                    <input type="text" class="d-ten-wifi" id="id_wifi" name="id_wifi" placeholder="IP wifi" 
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 error" id="err_wifi"></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-cau-hinh-3">
                        <h3 class="d-cau-hinh1">Vị trí mặc định để chấm công:</h3>
                        <div class="d-cau-hinh2">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3b">
                                    <input type="text" class="d-ten-wifi" id="toa_do" name="toa_do" placeholder="Tọa độ">
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3c">
                                    <input type="text" class="d-ten-wifi" id="dia_chi" name="dia_chi" placeholder="Địa chỉ ">
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 error" id="err_vitri"></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-cau-hinh-4">
                        <button type="reset" class="d-cau-hinh-reset">Nhập lại</button>
                        <button type="submit" class="d-cau-hinh-submit">Cấu hình chấm công</button>
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
<script src="../js/cty/cau_hinh_cham_cong.js"></script>
<script>
    $(document).ready(function () {
        $("#cham_cong").select2({
            width: "100%",
            placeholder: "Lựa chọn công ty muốn cấu hình",
        });
    });
</script>
</body>
</html>
