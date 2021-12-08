<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOÀN TẤT ĐĂNG KÝ</title>

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style_re.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-125014721-1');
    </script>
    <style>
        body {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <?php require_once APPPATH . "/views/includes/inc_header_nv.php"; ?>
    <div class="form-dky-cty">
        <h1 class="chooses">đăng kí công ty</h1>
        <div id="alert"></div>
        <form method="post" class="d-dang-ky-cty" id="sign_up_company">
            <div class="d-dang-ky-cty1">
                <img src="<?= base_url() ?>assets/images/dky_cty3.svg" alt="bước 1" class="dky-cty">
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
                    <input type="password" class="d-form-control" onkeypress="istrim(event)" id="pass" name="pass" placeholder="Tối thiểu 6 kí tự">
                    <div class="error" id="err_pass"></div>
                </div>
                <div class="form-dky-cty2 col-md-6 col-sm-6 col-xs-12">
                    <label for="" class="label-dky-cty">Nhập lại mật khẩu</label>
                    <input type="password" class="d-form-control" onkeypress="istrim(event)" id="re_pass" name="re_pwd" placeholder="Tối thiểu 6 kí tự">
                    <div class="error" id="err_repass"></div>
                </div>

            </div>
            <div class="d-dang-ky-cty3">
                <p class="d-dky-cty2 col-md-12">thông tin liên hệ</p>
                <div class="form-dky-cty2 col-md-6 col-sm-6 col-xs-12">
                    <label for="" class="label-dky-cty">Họ tên: </label>
                    <input type="text" class="d-form-control" id="name" name="name" placeholder="Nhập tên">
                    <div class="error" id="err_name"></div>
                </div>
                <div class="form-dky-cty2 col-md-6 col-sm-6 col-xs-12">
                    <label for="" class="label-dky-cty">Số điện thoại:</label>
                    <input type="text" class="d-form-control" id="sdt" name="sdt" placeholder="Số điện thoại liên hệ" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    <div class="error" id="err_sdt"></div>
                </div>
                <div class="form-dky-cty2 col-md-6 col-sm-6 col-xs-12">
                    <label for="" class="label-dky-cty">Địa chỉ:</label>
                    <input type="text" class="d-form-control" id="dia_chi" name="dia_chi" placeholder="Địa chỉ">
                    <div class="error" id="err_address"></div>
                </div>
            </div>
            <div class="d-dang-ky-cty3">
                <p class="d-dky-cty2 col-md-12">thông tin truy cập</p>
                <!-- <div class="form-dky-cty2 col-md-6 col-sm-6 col-xs-12">
                    <label for="" class="label-dky-cty">Phòng ban của nhân viên:</label>
                    <select name="phong_ban" id="phong_ban" class="d-form-control">
                        <option value="">Chọn phòng ban</option>
                    </select>
                    <div class="error" id="err_phong_ban"></div>
                </div> -->
                <div class="form-dky-cty2 col-md-6 col-sm-6 col-xs-12">
                    <label for="" class="label-dky-cty">Chức vụ</label>
                    <select name="chuc_vu" id="chuc_vu" class="d-form-control">
                        <option value="">Chọn chức vụ</option>
                        <?
                        foreach ($show_position as $key => $value) {
                        ?>
                            <option value="<?= $key ?>"><?= $value ?></option>
                        <?
                        }
                        ?>
                    </select>
                    <div class="error" id="err_chucvu"></div>
                </div>
                <div class="form-dky-cty2 col-md-6 col-sm-6 col-xs-12">
                    <label for="" class="label-dky-cty">Quyền truy cập</label>
                    <select name="phan_quyen" id="phan_quyen" class="d-form-control">
                        <option value="">Chọn quyền truy cập</option>
                        <option value="1">Admin (Toàn bộ quyền)</option>
                        <option value="4">Nhân sự (Quản lý chấm công)</option>
                        <option value="3">Nhân viên</option>
                    </select>
                    <div class="error" id="err_phan_quyen"></div>
                </div>
            </div>
            <div class="d-dky-cty4">
                <button type="button" onclick="del_ss();" name="submit" class="button-reset" >
                    <p class="reset-p">Bỏ qua</p>
                </button>
                <button type="submit" name="save" class="button-submit" id="submit">
                    <p class="submit-p">Hoàn tất</p>
                </button>
            </div>
        </form>
    </div>
    <? require_once APPPATH . '/views/includes/inc_footer.php' ?>
    <script src="<?= base_url(); ?>assets/js/jquery.validate.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/cty/dky_cty3.js"></script>
</body>

</html>