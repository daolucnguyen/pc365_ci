<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thiết lập thêm nhân viên</title>

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/quan_ly_cty.css">
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
        #menu-manager2 {
            display: block;
        }

        .llv_nv,
        .ql_cong {
            color: #206AA9;
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
                <h3 class="d-qly-cham-cong">Thiết lập thêm nhân viên</h3>
                <div id="alert"></div>
                <form method="post" class="d-cau-hinh" id="them_nv">
                    <h3 class="d-cau-hinh1">Chọn nhân viên để thêm:</h3>
                    <div class="d-form-group">
                        <div class="d-tao-lich">
                            <div class="d-tao-lich-v1">
                                <!-- <p class="d-from-p">Chọn công ty :</p> -->
                                <!-- <div class="row d-input-radio"> -->
                                <!-- <div class="col-md-6 col-sm-6 col-xs-12 d-input-radio-v1a">
                                        <input type="radio" class="d-tao-lich2" value="" name="cty" id="cty<1?= $detail_company['com_id'] ?>">
                                        <label for="cty<1s?= $detail_company['com_id'] ?>" class="d-tao-lich2-v1"><1?= $detail_company['com_name'] ?></label>
                                    </div> -->
                                <!-- <1?
                                    foreach ($company_small as $value) {
                                    ?>
                                        <div class="col-md-6 col-sm-6 col-xs-12 d-input-radio-v1a">
                                            <input type="radio" class="d-tao-lich2" value="" name="cty" id="cty2<1?= $value['com_id'] ?>">
                                            <label for="cty2<1?= $value['com_id'] ?>" class="d-tao-lich2-v1"><1?= $value['com_name'] ?></label>
                                        </div>
                                    <1?
                                    }
                                    ?> -->

                                <!-- </div> -->
                                <!-- <div class="error" id="err_choose_cty"></div> -->
                            </div>
                            <div class="d-tao-lich-v2">
                                <input type="hidden" name="" value="<?= $id_calendar ?>" id="id_calendar">
                                <p class="d-from-p">Chọn phòng/ban :</p>
                                <div class="row d-input-checkbox">
                                    <?php
                                    foreach ($show_department as $value) {
                                    ?>
                                        <div class="col-md-4 col-sm-4 col-xs-12 d-input-radio-v1a">
                                            <input type="checkbox" onchange="show_staff(<?= $value['id_department'] ?>)" class="item_ca d-tao-lich3 active" value="<?= $value['id_department'] ?>" name="phong_ban" id="phong<?= $value['id_department'] ?>" data-id="<?= $value['id_department'] ?>">
                                            <label for="phong<?= $value['id_department'] ?>" class="d-tao-lich2-v1"><?= $value['name_department'] ?></label>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="error" id="err_phongban" tabindex="-1"></div>
                            </div>
                            <div class="d-tao-lich-v3">
                                <p class="d-from-p">Chọn nhân viên :</p>
                                <div class="col-md-12 col-sm-12 col-xs-12 d-nv-cung-lich">
                                    <div class="d-tao-lich-v3a" id="scroll">

                                    </div>
                                </div>
                                <div class="error" id="err_choose_nv" tabindex="-1"></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-cau-hinh-4">
                        <!-- <button type="reset" class="d-cau-hinh-reset">Nhập lại</button> -->
                        <button type="submit" class="d-cau-hinh-submit">Thêm vào lịch làm việc</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <? include(APPPATH . '/views/includes/inc_footer.php') ?>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/lazysizes.min.js"></script>
    <script src="<?= base_url() ?>assets/js/cty/them_nv.js"></script>
</body>

</html>