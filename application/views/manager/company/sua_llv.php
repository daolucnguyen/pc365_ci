<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật lịch làm việc</title>

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
        #menu-manager2{
            display: block;
        }
        .ds_lichlamviec,.ql_cong{
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
                <h3 class="d-qly-cham-cong">Thiết lập lịch làm việc</h3>
                <div id="alert"></div>
                <form method="post" class="d-cau-hinh" id="sua_llv">
                    <h3 class="d-cau-hinh1">Chọn lịch làm việc cho công ty:</h3>
                    <div class="d-cau-hinh2">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6 d-them-llv">
                                <input type="hidden" name="" id="id_calendar" value="<?= $detail_calendar['id'] ?>">
                                <input type="radio" <?
                                                    if ($detail_calendar['choose_calendar'] == 1) {
                                                        echo 'checked';
                                                    }
                                                    ?> class="them-lich d-cau-hinh-input llv check" name="llv" value="1" onchange="showMonthDefault();" id="llv1">
                                <label for="llv1" class="d-cau-hinh-label">Thứ 2 - Thứ 6</label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 d-them-llv">
                                <input type="radio" <?
                                                    if ($detail_calendar['choose_calendar'] == 2) {
                                                        echo 'checked';
                                                    }
                                                    ?> class="them-lich d-cau-hinh-input1 llv check" name="llv" value="2" onchange="showMonthDefault();" id="llv2">
                                <label for="llv2" class="d-cau-hinh-label">Thứ 2 - Thứ 7</label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 d-them-llv">
                                <input type="radio" <?
                                                    if ($detail_calendar['choose_calendar'] == 3) {
                                                        echo 'checked';
                                                    }
                                                    ?> class="them-lich d-cau-hinh-input2 llv check" name="llv" value="3" onchange="showMonthDefault();" id="llv3">
                                <label for="llv3" class="d-cau-hinh-label">Thứ 2 - Chủ Nhật</label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 d-them-llv ">
                                <input type="radio" <?
                                                    if ($detail_calendar['choose_calendar'] == 4) {
                                                        echo 'checked';
                                                    }
                                                    ?> class="them-lich d-cau-hinh-input2 check" name="llv" value="4" onchange="showMonth();" id="llv4">
                                <label for="llv4" class="d-cau-hinh-label">Tùy chỉnh</label>
                            </div>
                        </div>
                        <div class="error" id="err_llv" tabindex="1"></div>
                    </div>
                    <div class="d-cau-hinh-3">
                        <h3 class="d-cau-hinh1">Nhập tên lịch làm việc:</h3>
                        <div class="col-md-12 col-sm-12 col-xs-12 d-them-llv l_them_llv">
                            <input type="text" class="d-ds-cty-input" id="name_calendar" value="<?= $detail_calendar['name_calendar'] ?>" placeholder="Nhập tên lịch làm việc">
                            <div class="error" id="err_name" tabindex="1"></div>
                        </div>
                    </div>
                    <div class="d-cau-hinh-3">
                        <h3 class="d-cau-hinh1">Chọn ca làm việc đang có:</h3>
                        <div class="d-cau-hinh2">
                            <div class="row">
                                <?
                                $id_shift = explode(',', $detail_calendar['id_shift']);
                                foreach ($list_shift as $value) {
                                ?>
                                    <div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3a">
                                        <input <?
                                                foreach ($id_shift as $valueid_shift) {
                                                    if ($valueid_shift == $value['id_shift']) {
                                                        echo "checked";
                                                    }
                                                }
                                                ?> type="checkbox" value="<?= $value['id_shift']; ?>" id="shift<?= $value['id_shift']; ?>" class="ca_lam cau-hinh d-cau-hinh-input">
                                        <label for="shift<?= $value['id_shift']; ?>" class="d-cau-hinh-label"><?= $value['name_shift']; ?> ( <?= date('H:i', $value['time_in']) ?> - <?= date('H:i', $value['time_out']) ?>)</label>
                                    </div>
                                <?
                                }
                                ?>
                            </div>
                            <div class="error" id="err_calam" tabindex="1"></div>
                        </div>
                    </div>
                    <div class="d-cau-hinh-3">
                        <h3 class="d-cau-hinh1">Chọn tháng :</h3>
                        <div class="d-cau-hinh2">
                            <div class="row" id="show_month">
                                <div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3b">
                                    <input type="month" class="d-ten-wifi" value="<?= date('Y-m', $detail_calendar['month']) ?>" id="month" name="month" placeholder="Chọn tháng">
                                    <div class="error" id="err_date_start"></div>
                                </div>
                            </div>
                            <div class="row" id="show_day">

                            </div>
                        </div>
                        <div class="error" id="err_month" tabindex="1"></div>
                        <div class="error" id="err_day" tabindex="1"></div>
                    </div>
                    <div class="d-cau-hinh-3">
                        <h3 class="d-cau-hinh1">Địa điểm áp dụng:</h3>
                        <div class="d-cau-hinh2">
                            <div class="row">
                                <!-- <div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3a1">
                                    <input </?
                                            if ($detail_company['com_id'] == $detail_calendar['id_company']) {
                                                echo 'checked';
                                            }
                                            ?> type="radio" id="dia_diem2</?= $detail_company['com_id'] ?>" value="</?= $detail_company['com_id'] ?>" class="itemca cau-hinh d-cau-hinh-input1 item_cty" data-name="dia_diem2" data-cty="0">
                                    <label for="dia_diem2</?= $detail_company['com_id'] ?>" class="d-cau-hinh-label"></?= $detail_company['com_name'] ?></label>
                                </div> -->
                                <div class="col-md-6 col-sm-6 col-xs-6 d-them-llv">
                                    <input <?
                                            if ($detail_company['com_id'] == $detail_calendar['id_company']) {
                                                echo 'checked';
                                            }
                                            ?> type="radio" class="them-lich d-cau-hinh-input item_cty" name="com" id="dia_diem2<?= $detail_company['com_id'] ?>" value="<?= $detail_company['com_id'] ?>">
                                    <label for="dia_diem2<?= $detail_company['com_id'] ?>" class="d-cau-hinh-label"><?= $detail_company['com_name'] ?></label>
                                </div>
                                <?
                                foreach ($company_small as $key => $value) {
                                ?>
                                    <div class="col-md-6 col-sm-6 col-xs-6 d-them-llv">
                                        <input <?
                                                if ($value['com_id'] == $detail_calendar['id_company']) {
                                                    echo 'checked';
                                                }
                                                ?> type="radio" class="them-lich d-cau-hinh-input item_cty" name="com" id="dia_diem2<?= $value['com_id'] ?>" value="<?= $value['com_id'] ?>">
                                        <label for="dia_diem2<?= $value['com_id'] ?>" class="d-cau-hinh-label"><?= $value['com_name'] ?></label>
                                    </div>
                                <?
                                }
                                ?>
                            </div>
                            <div class="error" id="err_diadiem" tabindex="1"></div>
                        </div>
                    </div>
                    <div class="d-cau-hinh-4">
                        <!-- <button type="reset" class="d-cau-hinh-reset">Nhập lại</button> -->
                        <button type="submit" class="d-cau-hinh-submit">Cập nhật lịch làm việc</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <? include(APPPATH . '/views/includes/inc_footer.php') ?>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/lazysizes.min.js"></script>
    <script src="<?= base_url() ?>assets/js/cty/them_llv.js"></script>
    <script>

    </script>
</body>

</html>