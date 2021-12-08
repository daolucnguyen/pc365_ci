
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ĐĂNG KÝ TÀI KHOẢN CÔNG TY</title>

    <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="<?=base_url();?>assets/css/header.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/style_re.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/style.css">
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-125014721-1');
    </script>
</head>
<body>
    <?php require_once APPPATH."/views//includes/inc_header_nv.php";?>
    <div class="form-dky-cty">
        <h1 class="chooses">đăng ký công ty</h1>

        <form method="post" class="d-dang-ky-cty" id="sign_up_company" action="">
            <div class="d-dang-ky-cty1">
                <img src="<?=base_url();?>assets/images/dky_cty.svg" alt="bước 1" class="dky-cty">
            </div>
            <div class="d-dang-ky-cty2">
                <p class="d-dky-cty2 col-md-12">thông tin tài khoản</p>
                
                <input type="file" name="avatar" id="input_cty_avatar" accept="image/*" style="display:none">
                <div class="form-dky-cty2 col-md-6 col-sm-6 col-xs-12">
                    <label for="" class="label-dky-cty">Email đăng nhập</label>
                    <input type="text" class="d-form-control" onkeypress="istrim(event)" id="email" name="email" placeholder="Điền email đăng kí của bạn">
                    <div class="error" id="err_email"></div>
                </div>
                <div class="form-dky-cty2 col-md-6 col-sm-6 col-xs-12">
                    <label for="" class="label-dky-cty">Mật khẩu đăng nhập</label>
                    <input type="password" onkeypress="istrim(event)" class="d-form-control" id="pass" name="pass" placeholder="Tối thiểu 6 kí tự">
                    <div class="error" id="err_pass"></div>
                </div>
                <div class="form-dky-cty2 col-md-6 col-sm-6 col-xs-12">
                    <label for="" class="label-dky-cty">Nhập lại mật khẩu</label>
                    <input type="password" onkeypress="istrim(event)" class="d-form-control" id="re_pass" name="re_pass" placeholder="Tối thiểu 6 kí tự">
                    <div class="error" id="err_repass"></div>
                </div>

            </div>
            <div class="d-dang-ky-cty3">
                <p class="d-dky-cty2 col-md-12">thông tin liên hệ</p>
                <div class="form-dky-cty2 col-md-6 col-sm-6 col-xs-12">
                    <label for="" class="label-dky-cty">Tên công ty</label>
                    <input type="text" class="d-form-control" id="ten_cty" name="ten_cty" placeholder="Nhập tên công ty của bạn">
                    <div class="error" id="err_name"></div>
                </div>
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
            <div class="d-dky-cty4">
                <button type="reset" class="button-reset"><p class="reset-p">Nhập lại</p></button>
                <button type="submit" name="save" class="button-submit"><p class="submit-p">Tiếp theo</p></button>
            </div>
        </form>
    </div>
    <? require_once APPPATH.'/views/includes/inc_footer.php' ?>
<script src="<?=base_url();?>assets/js/jquery.validate.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/js/cty/dky_cty.js"></script>
</body>
</html>
