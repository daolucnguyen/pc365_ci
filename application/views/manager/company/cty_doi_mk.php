<?php
// include "../config/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mật khẩu công ty</title>

    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/quan_ly_cty.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/nv_qly.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/cty_qly.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-125014721-1');
    </script>
    <style>
        .doimatkhau,.ql_tk{
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
            <?php include APPPATH . "/views/includes/header_manager.php"; ?>
            <div class="d-qly-cty1-v1">
                <div id="alert"></div>
                <h3 class="q-qly-thongtin-title">Đổi Mật Khẩu</h3>
                <div class="q-cty-doimk">
                    <form action="" class="q-cty-doimk-form">
                        <div id="thongbao"></div>
                        <div class="q-cty-doimk-row">
                            <div class="q-cty-doimk-row-control">
                                <p class="q-cty-update-row-label">Mật khẩu cũ:</p>
                                <input type="password" name="" id="cty_old_pass" onchange="checkpass();" class="q-cty-update-row-input" placeholder="Nhập mật khẩu hiện tại">
                                <img src="<?= base_url(); ?>assets/images/Hide.png" alt="show" class="q-cty-doimk-icon" id="show_pass1">
                                <p class="val_error" id="val_dmk_old"></p>
                            </div>
                            <div class="q-cty-doimk-row-control">
                                <p class="q-cty-update-row-label">Mật khẩu mới:</p>
                                <input type="password" name="" id="cty_new_pass" class="q-cty-update-row-input" placeholder="Tối thiểu 6 kí tự">
                                <img src="<?= base_url(); ?>assets/images/Hide.png" alt="show" class="q-cty-doimk-icon" id="show_pass2">
                                <p class="val_error" id="val_dmk_new"></p>
                            </div>
                            <div class="q-cty-doimk-row-control">
                                <p class="q-cty-update-row-label">Nhập lại mật khẩu:</p>
                                <input type="password" name="" id="cty_re_new_pass" class="q-cty-update-row-input" placeholder="Tối thiểu 6 kí tự">
                                <img src="<?= base_url(); ?>assets/images/Hide.png" alt="show" class="q-cty-doimk-icon" id="show_pass3">
                                <p class="val_error" id="val_dmk_renew"></p>
                            </div>
                        </div>
                        <div class="q-cty-update-button q-cty-doimk-button">
                            <button type="reset" name="reform-nv-update" class="reform-nv-update reform-cty-update">Nhập Lại</button>
                            <button type="submit" name="submit-cty-doimk" class="submit-nv-updade submit-cty-updade"><span>Đổi mật khẩu</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


    <? include(APPPATH . '/views/includes/inc_footer.php') ?>
    <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/Chart.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/cty/doi_mk_cty.js"></script>
    <script>
        
    </script>
</body>

</html>