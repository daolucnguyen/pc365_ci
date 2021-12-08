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
    <title>Đổi mật khẩu công ty</title>

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
                <h3 class="q-qly-thongtin-title">Đổi Mật Khẩu</h3>
                <div class="q-cty-doimk">
                    <form action="" class="q-cty-doimk-form">
                        <div class="q-cty-doimk-row">
                            <div class="q-cty-doimk-row-control">
                                <p class="q-cty-update-row-label">Mật khẩu cũ:</p>
                                <input type="password" name="" id="cty_old_pass" class="q-cty-update-row-input" placeholder="Tối thiểu 6 kí tự">
                                <img src="../images/Hide.png" alt="show" class="q-cty-doimk-icon" id="show_pass1">
                                <p class="val_error" id="val_dmk_old"></p>
                            </div>
                            <div class="q-cty-doimk-row-control">
                                <p class="q-cty-update-row-label">Mật khẩu mới:</p>
                                <input type="password" name="" id="cty_new_pass" class="q-cty-update-row-input" placeholder="Tối thiểu 6 kí tự">
                                <img src="../images/Hide.png" alt="show" class="q-cty-doimk-icon" id="show_pass2">
                                <p class="val_error" id="val_dmk_new"></p>
                            </div>
                            <div class="q-cty-doimk-row-control">
                                <p class="q-cty-update-row-label">Nhập lại mật khẩu:</p>
                                <input type="password" name="" id="cty_re_new_pass" class="q-cty-update-row-input" placeholder="Tối thiểu 6 kí tự">
                                <img src="../images/Hide.png" alt="show" class="q-cty-doimk-icon" id="show_pass3">
                                <p class="val_error" id="val_dmk_renew"></p>
                            </div>
                        </div>
                        <div class="q-cty-update-button q-cty-doimk-button">
                                <input type="reset" name="reform-nv-update" class="reform-nv-update reform-cty-update" value="Nhập Lại"></input>
                                <button type="submit" name="submit-cty-doimk" class="submit-nv-updade submit-cty-updade"><span>Cập nhật thông tin</span></button>
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

            $('#show_pass1').click(function(){
                if($('#cty_old_pass').attr('type') == 'password')
                {
                    $('#cty_old_pass').attr('type', 'text');
                    $(this).val('Hide');
                    $('#show_pass1').attr("src", "../images/Show.png");
                } else {
                    $('#cty_old_pass').attr('type', 'password');
                    $(this).val('Show');
                    $('#show_pass1').attr("src", "../images/Hide.png");
                }
            });
            
            $('#show_pass2').click(function(){
                if($('#cty_new_pass').attr('type') == 'password')
                {
                    $('#cty_new_pass').attr('type', 'text');
                    $(this).val('Hide');
                    $('#show_pass2').attr("src", "../images/Show.png");
                } else {
                    $('#cty_new_pass').attr('type', 'password');
                    $(this).val('Show');
                    $('#show_pass2').attr("src", "../images/Hide.png");
                }
            });

            $('#show_pass3').click(function(){
                if($('#cty_re_new_pass').attr('type') == 'password')
                {
                    $('#cty_re_new_pass').attr('type', 'text');
                    $(this).val('Hide');
                    $('#show_pass3').attr("src", "../images/Show.png");
                } else {
                    $('#cty_re_new_pass').attr('type', 'password');
                    $(this).val('Show');
                    $('#show_pass3').attr("src", "../images/Hide.png");
                }
            });

    });
    function deletes(e) {
        dom_parent = $(e).parent().remove();
    }
</script>
</body>
</html>
