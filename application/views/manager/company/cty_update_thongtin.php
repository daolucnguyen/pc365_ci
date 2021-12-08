<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin</title>

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/quan_ly_cty.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/nv_qly.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/cty_qly.css">
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
        .capnhatthongtin,.ql_tk{
            color: #206AA9;
        }
        #menu-manager3{
            display: block;
        }
    </style>
</head>

<body>
    <div class="d-quan-ly-cty">
        <div class="l_block_sidebar">
            <?php require_once APPPATH . '/views/includes/sidebar_left_cty.php'; ?>
        </div>
        <div class="d-quan-ly-cty1">
            <?php require_once APPPATH . "/views/includes/header_manager.php"; ?>
            <div class="d-qly-cty1-v1">
                <h3 class="q-qly-thongtin-title">Cập Nhật Thông Tin</h3>
                <div class="q-cty-update">
                    <form action="" method="post" class="q-cty-update-form" id="update_company" enctype="multipart/form-data">
                        <div class="q-cty-update-avatar">
                            <img src="<?= $detail_company['com_avatar'] ?>" alt="<?= $detail_company['com_name'] ?>" class="q-cty-update-avatar-img" id="cty_update_avatar" onerror='this.onerror=null;this.src="<?= base_url() ?>assets/images/logo_com.png";'>
                            <input type="file" name="avatar" id="input_cty_avatar" accept="image/*" onchange="changeImg(this)">
                            <label for="input_cty_avatar" class="l_lable_camera">
                                <img src="<?= base_url() ?>assets/images/Image_camera.svg" alt="">
                            </label>
                            <p class="error" id="err_avt"></p>
                        </div>
                        <div class="q-cty-update-row">
                            <div class="q-cty-update-row-control">
                                <p class="q-cty-update-row-label">Tên công ty:</p>
                                <input type="text" name="ten_cty" id="cty_update_name" class="q-cty-update-row-input" placeholder="Mời bạn nhập tên công ty" value="<?= $detail_company['com_name'] ?>">
                                <p class="val_error" id="val_name"></p>
                            </div>
                            <div class="q-cty-update-row-control">
                                <p class="q-cty-update-row-label">Số điện thoại:</p>
                                <input type="text" name="sdt" id="cty_update_phone" class="q-cty-update-row-input" placeholder="Số điện thoại liên lạc của nhân viên" value="<?= $detail_company['com_phone'] ?>" oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                                <p class="val_error" id="val_phone"></p>
                            </div>
                            <div class="q-cty-update-row-control">
                                <p class="q-cty-update-row-label">Địa chỉ:</p>
                                <input type="text" name="dia_chi" id="cty_update_address" class="q-cty-update-row-input" placeholder="Nhập địa chỉ công ty" value="<?= $detail_company['com_address'] ?>">
                                <p class="val_error" id="val_address"></p>
                            </div>
                        </div>
                        <div class="q-nv-update-button q-cty-update-button">
                            <input type="reset" name="reform-nv-update" class="reform-nv-update reform-cty-update" value="Nhập Lại"></input>
                            <button type="submit" class="submit-nv-updade submit-cty-updade"><span>Cập nhật thông tin</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


    <? require_once APPPATH . "/views//includes/inc_footer.php" ?>
    <script src="<?= base_url() ?>assets/js/jquery.validate.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/cty/updateCompany.js"></script>

</html>