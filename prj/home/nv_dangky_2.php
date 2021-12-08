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
    <title>Đăng ký nhân viên 2</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../css/select2.min.css">
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

    <div class="q-content-2">
        <div class="q-banner-regis-1">
            <span>ĐĂNG KÍ NHÂN VIÊN</span>
        </div>
        <div class="q-regis-2">
            <div class="q-form-regis-2">
                <div class="q-form-header-1" id="form-header-2">
                    <img src="../images/regis-1-active.png" alt="res1" class="q-form-img">
                    <img src="../images/Line 3-active.png" alt="line" class="q-form-img-line">
                    <img src="../images/regis-2-active.png" alt="res2" class="q-form-img">
                    <img src="../images/Line 3.png" alt="line" class="q-form-img-line">
                    <img src="../images/regis-3.png" alt="res3" class="q-form-img">
                    <img src="../images/Line 3.png" alt="line" class="q-form-img-line">
                    <img src="../images/regis-4.png" alt="res4" class="q-form-img">
                </div>
                <div class="q-form-body-2">
                    <form action="" class="q-form-2" id="form_dky_2">
                            <p class="q-title-2-tk">Thông Tin Tài Khoản</p>
                            <div class="q-form-col-2">
                                <div class="q-form-control-2">
                                    <p class="q-form-label-2">Email đăng nhập</p>
                                    <input type="text" name="" class="q-form-input-2" id="input_email_2" autocomplete="off" placeholder="Điền email đăng ký của bạn">
                                    <p class="val_error" id="val_dk2_email"></p>
                                </div>
                                <div class="q-form-control-2">
                                    <p class="q-form-label-2">Mật khẩu đăng nhập</p>
                                    <input type="text" name="" class="q-form-input-2" id="input_pass_2" placeholder="Tối thiểu 6 ký tự">
                                    <p class="val_error" id="val_dk2_pass"></p>
                                </div>
                                <div class="q-form-control-2">
                                    <p class="q-form-label-2">Nhập lại mật khẩu</p>
                                    <input type="text" name="" class="q-form-input-2" id="input_repass_2" placeholder="Tối thiểu 6 ký tự">
                                    <p class="val_error" id="val_dk2_repass"></p>
                                </div>
                            </div>
                            <p class="q-title-2-lh">Thông Tin Liên Hệ</p>
                            <div class="q-form-col-2">
                                <div class="q-form-control-2">
                                    <p class="q-form-label-2">Họ tên</p>
                                    <input type="text" name="" class="q-form-input-2" autocomplete="off" placeholder="Họ tên đầy đủ" id="input_name_2">
                                    <p class="val_error" id="val_dk2_name"></p>
                                </div>
                                <div class="q-form-control-2">
                                    <p class="q-form-label-2">Số điện thoại</p>
                                    <input type="text" name="" class="q-form-input-2" autocomplete="off" placeholder="Số điện thoại liên hệ" id="input_phone_2"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                                    <p class="val_error" id="val_dk2_phone"></p>
                                </div>
                                <div class="q-form-control-2">
                                    <p class="q-form-label-2">Phòng / ban</p>
                                    <div class="form-group">
                                        <select class="form-control q-form-input-2" id="input_phongban_2" >
                                            <option value="">Chọn phòng/ ban nơi bạn đang làm việc</option>
                                            <option value=""></option>
                                            <option value=""></option>
                                            <option value=""></option>
                                        </select>
                                        <p class="val_error" id="val_dk2_pb"></p>
                                    </div>
                                </div>
                                <div class="q-form-control-2">
                                    <p class="q-form-label-2">Chức vụ</p>
                                    <div class="form-group">
                                        <select class="form-control q-form-input-2" id="input_chucvu_2">
                                            <option value="">Chọn chức vụ nhân viên đang giữ</option>
                                            <option value=""></option>
                                            <option value=""></option>
                                            <option value=""></option>
                                        </select>
                                        <p class="val_error" id="val_dk2_cv"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="q-form-button">
                                <input type="reset" value="Nhập Lại"  name="submit-regis-2" class="q-submit-regis-2" id="input-reform-2"></input>
                                <button type="submit" name="submit-regis-2" class="q-submit-regis-2" id="input-submit-2"><span>Tiếp Theo</span></button>
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
    <script src="../js/validate_nv/validate_nv.js"></script>
    <script>
        $('#input_phongban_2').select2();
        $('#input_chucvu_2').select2();
    </script>
</body>
</html>