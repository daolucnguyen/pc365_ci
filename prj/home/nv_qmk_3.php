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
    <title>Quên mật khẩu 3</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/style_re.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/nv_out.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400&display=swap" rel="stylesheet">
</head>
<body>
    <div class="header">
        <?php include "../includes/inc_header_nv.php";?>
    </div>

    <div class="q-content-qmk">
        <div class="q-banner-regis-1">
            <span>ĐỔI MẬT KHẨU</span>
        </div>
        <div class="q-content-body-3">
            <div class="q-qmk-3">
                    <p class="q-qmk-title-3">Xác thực email thành công, mời bạn nhập mật khẩu mới tại đây để tiếp tục sử dụng dịch vụ.</p>
                    <form class="q-qmk-form-3">
                        <div class="q-qmk-form-control-3">
                            <p class="q-qmk-form-control-3-title">Mật khẩu mới</p>
                            <input type="password" name="" id="qmk_pass1" class="q-qmk-form-input-3" placeholder="Tối thiểu 6 kí tự">
                            <img src="../images/Hide.png" alt="show" class="q-qmk-form-img-3" id="show_pass1">
                        </div>
                        <p class="val_error" id="val_qmk3_pass"></p>
                        <div class="q-qmk-form-control-3">
                            <p class="q-qmk-form-control-3-title">Nhập lại mật khẩu</p>
                            <input type="password" name="" id="qmk_pass2" class="q-qmk-form-input-3" placeholder="Tối thiểu 6 kí tự">
                            <img src="../images/Hide.png" alt="show" class="q-qmk-form-img-3" id="show_pass2">
                        </div>
                        <p class="val_error" id="val_qmk3_repass"></p>
                        <button type="submit" name="" class="q-qmk-form-button-3"><span>Đổi Mật Khẩu</span></button>
                    </form>
            </div>
        </div>
    </div>
    <? include('../includes/inc_footer.php') ?>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/validate_nv/validate_nv.js"></script>
    <script>
        $(document).ready(function(){
            $('#show_pass1').click(function(){
                if($('#qmk_pass1').attr('type') == 'password')
                {
                    $('#qmk_pass1').attr('type', 'text');
                    $(this).val('Hide');
                    $('#show_pass1').attr("src", "../images/Show.png");
                } else {
                    $('#qmk_pass1').attr('type', 'password');
                    $(this).val('Show');
                    $('#show_pass1').attr("src", "../images/Hide.png");
                }
            });
            
            $('#show_pass2').click(function(){
                if($('#qmk_pass2').attr('type') == 'password')
                {
                    $('#qmk_pass2').attr('type', 'text');
                    $(this).val('Hide');
                    $('#show_pass2').attr("src", "../images/Show.png");
                } else {
                    $('#qmk_pass2').attr('type', 'password');
                    $(this).val('Show');
                    $('#show_pass1').attr("src", "../images/Hide.png");
                }
            });
        });
    </script>
</body>
</html>