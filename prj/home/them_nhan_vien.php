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
    <title>Thiết lập thêm nhân viên</title>

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
                <h3 class="d-qly-cham-cong">Thiết lập thêm nhân viên</h3>
                <form method="post" class="d-cau-hinh" id="them_nv">
                    <h3 class="d-cau-hinh1">Chọn nhân viên để thêm:</h3>
                        <div class="d-form-group">
                            <div class="d-tao-lich">
                                <div class="d-tao-lich-v1">
                                    <p class="d-from-p">Chọn công ty :</p>
                                    <div class="row d-input-radio">
                                        <div class="col-md-6 col-sm-6 col-xs-12 d-input-radio-v1a">    
                                            <input type="radio" class="d-tao-lich2" value="" name="cty" id="cty" checked>
                                            <label for="cty" class="d-tao-lich2-v1">Công ty TNHH 1 thành viên HHP</label>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 d-input-radio-v1a">
                                            <input type="radio" class="d-tao-lich2" value="" name="cty" id="cty2">
                                            <label for="cty2" class="d-tao-lich2-v1">Công ty TNHH 1 thành viên HHP</label>
                                        </div>
                                    </div>
                                    <div class="error" id="err_choose_cty"></div>
                                </div>
                                <div class="d-tao-lich-v2">
                                    <p class="d-from-p">Chọn phòng/ban :</p>
                                    <div class="row d-input-checkbox">
                                        <?php 
                                            for ($i=1; $i <= 6 ; $i++) { 
                                        ?>
                                            <div class="col-md-4 col-sm-4 col-xs-12 d-input-radio-v1a">
                                                <input type="radio" class="item_ca d-tao-lich3 active" value="" name="phong_ban" id="phong_<?=$i?>" data-id="<?=$i?>">
                                                <label for="phong_<?=$i?>" class="d-tao-lich2-v1">Phòng hành chính <?=$i?></label>
                                            </div>
                                        <?php        
                                            }
                                        ?>
                                    </div>
                                    <div class="error" id="err_phongban"></div>
                                    <input type="hidden" name="chon" id="chon">
                                </div>
                                <div class="d-tao-lich-v3">
                                    <p class="d-from-p">Chọn nhân viên :</p>
                                    <div class="col-md-12 col-sm-12 col-xs-12 d-nv-cung-lich">
                                        <div class="d-tao-lich-v3a" id="scroll">
                                            
                                        </div>
                                    </div>
                                    <div class="error" id="err_choose_nv"></div>
                                    <input type="hidden" name="chon_nv" id="chon_nv">
                                </div>
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
<script src="../js/cty/them_nv.js"></script>
<script>
    $(document).ready(function () {
        $(".item_ca").click(function(){
            
            dom = $("#scroll").children().remove();
            var id = $(this).attr("data-id");
            var html = `
            <label for="" class="col-md-6 col-sm-6 col-xs-12 d-tao-lich-v3a1" id="phong_ban_`+id+`">
                <div class="d-tao-lich-v3-img">
                    <img src="../images/Ellipse124.svg" alt="ten_nv" class="nv-tao-lich-img">
                </div>
                <div class="d-ten-nv">
                    <p class="d-cham-cong-p">(162) Ngô Ngọc Yến</p>
                    <p class="d-cham-cong-p1">Nhân viên phòng kĩ thuật</p>
                </div>
                <div class="d-input-nv">
                    <input type="checkbox" class="item_nv d-tao-lich2" data-name="1" data-nv="0">
                </div>
            </label>`;
            $("#scroll").append(html);
        });
    });
</script>
</body>
</html>
