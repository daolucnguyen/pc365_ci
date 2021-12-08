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
    <title>HOÀN TẤT ĐĂNG KÝ</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/select2.min.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/style_re.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include "../includes/inc_header.php";?>
    <div class="form-dky-cty">
        <h1 class="chooses">đăng kí công ty</h1>

        <form method="post" class="d-dang-ky-cty" id="sign_up_company">
            <div class="d-dang-ky-cty1">
                <img src="../images/dky_cty3.svg" alt="bước 1" class="dky-cty">
            </div>
            <div class="d-dang-ky-cty2">
                <p class="d-dky-cty2 col-md-12">thông tin tài khoản quản trị phụ ( Có thể thêm vào sau )</p>
                <div class="form-dky-cty2 col-md-6 col-sm-6 col-xs-12">
                    <label for="" class="label-dky-cty">Email đăng nhập</label>
                    <input type="text" class="d-form-control" id="email" name="email" placeholder="Điền email đăng kí của bạn">
                    <div class="error" id="err_email"></div>
                </div>
                <div class="form-dky-cty2 col-md-6 col-sm-6 col-xs-12">
                    <label for="" class="label-dky-cty">Mật khẩu đăng nhập</label>
                    <input type="password" class="d-form-control" id="pass" name="pwd" placeholder="Tối thiểu 6 kí tự">
                    <div class="error" id="err_pass"></div>
                </div>
                <div class="form-dky-cty2 col-md-6 col-sm-6 col-xs-12">
                    <label for="" class="label-dky-cty">Nhập lại mật khẩu</label>
                    <input type="password" class="d-form-control" id="re_pass" name="re_pwd" placeholder="Tối thiểu 6 kí tự">
                    <div class="error" id="err_repass"></div>
                </div>

            </div>
            <div class="d-dang-ky-cty3">
                <p class="d-dky-cty2 col-md-12">thông tin liên hệ</p>
                <div class="form-dky-cty2 col-md-6 col-sm-6 col-xs-12">
                    <label for="" class="label-dky-cty">Số điện thoại</label>
                    <input type="text" class="d-form-control" id="sdt" name="sdt" placeholder="Số điện thoại liên hệ"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    <div class="error" id="err_sdt"></div>
                </div>
                <div class="form-dky-cty2 col-md-6 col-sm-6 col-xs-12">
                    <label for="" class="label-dky-cty">Địa chỉ</label>
                    <input type="text" class="d-form-control" id="dia_chi" name="dia_chi" placeholder="Địa chỉ công ty">
                    <div class="error" id="err_address"></div>
                </div>
            </div>
            <div class="d-dang-ky-cty3">
                <p class="d-dky-cty2 col-md-12">thông tin truy cập</p>
                <div class="form-dky-cty2 col-md-6 col-sm-6 col-xs-12">
                    <label for="" class="label-dky-cty">Phòng ban của nhân viên</label>
                    <select name="phong_ban" id="phong_ban" class="d-form-control">
                        <option value="">Chọn phòng ban</option>
                        <option value="2">Chọn phòng ban 1</option>
                        <option value="3">Chọn phòng ban 2</option>
                    </select>
                    <div class="error" id="err_phong_ban"></div>
                </div>
                <div class="form-dky-cty2 col-md-6 col-sm-6 col-xs-12">
                    <label for="" class="label-dky-cty">Chức vụ</label>
                    <select name="chuc_vu" id="chuc_vu" class="d-form-control">
                        <option value="">Chọn chức vụ</option>
                        <option value="2">Chọn chức vụ 1</option>
                        <option value="3">Chọn chức vụ 2</option>
                    </select>
                    <div class="error" id="err_chucvu"></div>
                </div>
                <div class="form-dky-cty2 col-md-6 col-sm-6 col-xs-12">
                    <label for="" class="label-dky-cty">Quyền truy cập</label>
                    <select name="phan_quyen" id="phan_quyen" class="d-form-control">
                        <option value="">Chọn quyền truy cập</option>
                        <option value="2">Chọn quyền truy cập 1</option>
                        <option value="3">Chọn quyền truy cập 2</option>
                    </select>
                    <div class="error" id="err_phan_quyen"></div>
                </div>
            </div>
            <div class="d-dky-cty4">
                <button type="reset" class="button-reset"><p class="reset-p">Bỏ qua</p></button>
                <button type="submit" class="button-submit" id="submit"><p class="submit-p">Hoàn tất</p></button>
            </div>
        </form>
    </div>
    <? include('../includes/inc_footer.php') ?>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/select2.min.js"></script>
<script src="../js/cty/dky_cty3.js"></script>
<script>
    $(document).ready(function () {
        $('#phong_ban').select2({
            placeholder: 'Phòng ban nơi nhân viên đang làm',
            width: "100%"
        });
        $('#chuc_vu').select2({
            placeholder: 'Chọn chức vụ nhân viên đang giữ',
            width: "100%"
        });
        $('#phan_quyen').select2({
            placeholder: 'Chọn quyền truy cập cho nhân viên',
            width: "100%"
        });
    });
</script>
</body>
</html>
