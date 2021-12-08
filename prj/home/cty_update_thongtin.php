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
    <title>Cập nhật thông tin</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/select2.min.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/quan_ly_cty.css">
    <link rel="stylesheet" href="../css/nv_qly.css">
    <link rel="stylesheet" href="../css/cty_qly.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="d-quan-ly-cty">
        <?php include "../includes/sidebar_left_cty.php";?>
        <div class="d-quan-ly-cty1">
            <?php include "../includes/header_manager.php";?>
            <div class="d-qly-cty1-v1">
                <h3 class="q-qly-thongtin-title">Cập Nhật Thông Tin</h3>
                <div class="q-cty-update">
                    <div class="q-cty-update-avatar">
                        <img src="../images/twitter.png" alt="" class="q-cty-update-avatar-img" id="cty_update_avatar">
                        <input type="file" name="" id="input_cty_avatar">
                    </div>
                    <form action="" class="q-cty-update-form">
                        <div class="q-cty-update-row">
                            <div class="q-cty-update-row-control">
                                <p class="q-cty-update-row-label">Tên công ty:</p>
                                <input type="text" name="" id="cty_update_name" class="q-cty-update-row-input" placeholder="Mời bạn nhập tên công ty">
                                <p class="val_error" id="val_name"></p>
                            </div>
                            <div class="q-cty-update-row-control">
                                <p class="q-cty-update-row-label">Số điện thoại:</p>
                                <input type="text" name="" id="cty_update_phone" class="q-cty-update-row-input" placeholder="Số điện thoại liên lạc của nhân viên"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                                <p class="val_error" id="val_phone"></p>
                            </div>
                            <div class="q-cty-update-row-control">
                                <p class="q-cty-update-row-label">Địa chỉ:</p>
                                <input type="text" name="" id="cty_update_address" class="q-cty-update-row-input" placeholder="Nhập địa chỉ công ty">
                                <p class="val_error" id="val_address"></p>
                            </div>
                        </div>
                        <div class="q-nv-update-button q-cty-update-button">
                                <input type="reset" name="reform-nv-update" class="reform-nv-update reform-cty-update" value="Nhập Lại"></input>
                                <button type="submit" name="submit-nv-updade" class="submit-nv-updade submit-cty-updade"><span>Cập nhật thông tin</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


    <? include('../includes/inc_footer.php') ?>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/select2.min.js"></script>
<script src="../js/Chart.min.js"></script>
<script src="../js/validate_nv/validate_nv.js"></script>
<script>
    $(document).ready(function () {
        $('.d-dropdown').hover(function(){
            $(this).attr('src','../images/them1.svg');},
            function(){
            $(this).attr('src','../images/them.svg');
        });

        $('#cty_update_avatar').click(function(){
            $('#input_cty_avatar').click();
        });

    });
    function deletes(e) {
        dom_parent = $(e).parent().remove();
    }
</script>
</body>
</html>
