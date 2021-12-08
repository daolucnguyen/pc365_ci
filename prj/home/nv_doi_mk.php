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
    <title>Đổi mật khẩu</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/style_re.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/menu-header.css">
    <link rel="stylesheet" href="../css/nv_qly.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400&display=swap" rel="stylesheet">
</head>
<body>
        <div class="q-contain">
            <div class="row q-contain-row">
                <div class="col-lg-3 col-md-3 q-contain-left">
                    <? include('../includes/nv_menu_qly.php') ?>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 q-contain-right">
                    <?include('../includes/nv_menu_header.php') ?>
                <div class="q-right-doimk" id="right_nv">
                    <div class="q-right-title" id="right_title">
                        <p>Đổi Mật Khẩu</p>
                    </div>
                    <div class="q-cty-doimk">
                    <form method="POST" class="q-cty-doimk-form">
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
    </div>
    <? include('../includes/inc_footer.php') ?>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/validate_nv/validate_nv.js"></script>
    <script>
        $(document).ready(function () {
            $('.item-drop').click(function () {
                $('.menu-drop').toggleClass('hide');
            });

            $('#link-5').addClass('link-active');
            $('#link-5').removeClass('menu-link');
            $('#link-6').addClass('link-active');
            $('#link-6').removeClass('menu-link');
            $('#link-5-drop').addClass('link-active');
            $('#link-5-drop').removeClass('menu-link');
            $('#link-6-drop').addClass('link-active');
            $('#link-6-drop').removeClass('menu-link');

            $('#menu_pro').css('background-image', 'url(../images/Profile-active.png)');
            $('#menu_cat_drop').attr('src','../images/Category.png');
            $('#menu_pro_drop').attr('src','../images/Profile-active.png');
            

            
            $(".q-right-work").click(function(){
                $("#q-right-details-work").click();
            });
                    $(".q-nv-modify").click(function(e){ 
                        $(".q-nv-choice").toggleClass("hide");
                        e.stopPropagation();
                    });
                    $(document,).click(function(){
                        $(".q-nv-choice").addClass("hide");
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
    </script>
</body>
</html>
 