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
    <title>Sửa thông tin nhân viên</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../css/select2.min.css"> 
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
                <div class="q-right-update" id="right_update">
                    <div class="q-right-title" id="right_title">
                        <p>Sửa Thông Tin Nhân Viên</p>
                    </div>
                    <div class="q-right-nv-update">
                        <div class="q-nv-avatar-update">
                            <img src="../images/twitter.png" alt="avatar">
                        </div>
                        <form action="" class="q-nv-update-form" method="POST">
                            <div class="q-nv-form-control">
                                <label for="" class="q-nv-update-label">Tên nhân sự:</label>
                                <input type="text" name="" id="update_name" class="q-nv-update-input" placeholder="Mời bạn nhập họ tên">
                                <p class="val_error" id="val_update_name"></p>
                            </div>

                            <div class="q-nv-form-control">
                                <label for="" class="q-nv-update-label">Số điện thoại:</label>
                                <input type="text" name="" id="update_phone" class="q-nv-update-input" placeholder="Số điện thoại liên lạc của nhân viên"
                                oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                                <p class="val_error" id="val_update_phone"></p>
                            </div>

                            <div class="q-nv-form-control">
                                <label for="" class="q-nv-update-label">Chức vụ đang nắm giữ:</label>
                                <select class="q-nv-update-input" name="" id="update_chucvu">
                                    <option class="q-nv-update-choice" value="" >Lựa chọn chức vụ</option>
                                    <option class="q-nv-update-choice" value=""></option>
                                    <option class="q-nv-update-choice" value=""></option>
                                    <option class="q-nv-update-choice" value=""></option>
                                </select>
                                <p class="val_error" id="val_update_chucvu"></p>
                            </div>

                            <div class="q-nv-form-control">
                                <label for="" class="q-nv-update-label">Phòng/ ban làm việc</label>
                                    <select class="q-nv-update-input" name="" id="update_phongban">
                                            <option class="q-nv-update-choice" value="" >Lựa chọn phòng/ ban làm việc</option>
                                            <option class="q-nv-update-choice" value=""></option>
                                            <option class="q-nv-update-choice" value=""></option>
                                            <option class="q-nv-update-choice" value=""></option>
                                    </select>
                                    <p class="val_error" id="val_update_phongban"></p>
                            </div>
                                <div class="q-nv-update-button">
                                    <input type="reset" name="reform-nv-update" class="reform-nv-update" value="Nhập Lại"></input>
                                    <button type="submit" name="submit-nv-updade" class="submit-nv-updade"><span>Cập nhật thông tin</span></button>
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
    <script src="../js/select2.min.js"></script>

    
    <script>
        $(document).ready(function () {
            $('#update_chucvu').select2({
                width: '100%'
            });
            $('#update_phongban').select2({
                width: '100%'
            });

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

        });
    </script>
</body>
</html>
 