<script>

</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cấu hình chấm công</title>
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
        .cauhinhchamcong,
        .ql_cong {
            color: #206AA9;
        }

        #menu-manager2 {
            display: block;
        }

        .cau-hinh[type="checkbox"] {
            margin-left: 0.5px;
            margin-top: 0.5px;
            position: relative;
            width: auto;
            height: auto;
        }

        .cau-hinh[type="checkbox"]:before {
            position: absolute;
            display: block;
            width: 20px;
            height: 20px;
            border: 1px solid #D0D0D0;
            content: "";
            top: -3px;
            left: -2px;
        }

        .cau-hinh[type="checkbox"]:after {
            position: absolute;
            display: block;
            left: -2px;
            top: -3px;
            width: 20px;
            height: 20px;
            border-width: 1px;
            border-color: #00BABA;
            content: "";
            background-repeat: no-repeat;
            background-position: center;
        }

        input[type="checkbox"],
        input[type="radio"] {
            margin: 0;
        }

        .wifi_mac_dinh {
            background: none;
            border: 1px solid #76B51B;
            color: #76B51B;
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
                <h3 class="d-qly-cham-cong">Cấu hình chấm công</h3>
                <?
                // $exWifi = explode(',', $config['id_wifi']);
                // $expLatLong = explode(',', $config['id_lat_long']);
                // $expMethod = explode(',', $config['method']);
                $i = 0;

                ?>
                <div id="alert"></div>
                <form method="post" class="d-cau-hinh" id="cau_hinh" onsubmit="cau_hinh(); return false;">
                    <!-- <h3 class="d-cau-hinh1">Tên công ty muốn cấu hình:</h3>
                    <div class="d-cau-hinh2">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 d-cau-hinh2-v1">
                                <select name="cham_cong" id="cham_cong" onchange="showConfig();" class="d-cau-hinh2-v1a cham_cong1">
                                    <?
                                    foreach ($company_small as $value) {
                                    ?>
                                        <option value="<?= $value->com_id ?>"><?= $value->com_name ?></option>
                                    <?
                                    }
                                    ?>
                                </select>
                                <div class="error" id="err_chamcong"></div>
                            </div>
                        </div>
                    </div> -->
                    <div class="d-cau-hinh-3">
                        <h3 class="d-cau-hinh1">Chọn cấu hình chấm công hợp lệ:</h3>
                        <div class="d-cau-hinh2">
                            <div class="row">

                                <div class="col-md-4 col-sm-4 col-xs-12 d-cau-hinh3a">
                                    <input type="checkbox" class="cau-hinh d-cau-hinh-input" <?= (in_array(1, $config)) ? 'checked' : '' ?> value="1" id="face" data-name="face" data-chon="0">
                                    <label for="face" class="d-cau-hinh-label">Nhận diện khuôn mặt</label>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6 d-cau-hinh3a1">
                                    <input type="checkbox" class="cau-hinh d-cau-hinh-input2" <?= (in_array(2, $config)) ? 'checked' : '' ?> id="wifi" value="2" data-name="wifi" data-chon="0">
                                    <label for="wifi" class="d-cau-hinh-label">Wifi công ty</label>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6 d-cau-hinh3a1">
                                    <input type="checkbox" class="cau-hinh d-cau-hinh-input1" <?= (in_array(3, $config)) ? 'checked' : '' ?> value="3" id="vitri" data-name="vitri" data-chon="0">
                                    <label for="vitri" class="d-cau-hinh-label">Vị trí</label>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 error" id="err_cauhinh" tabindex="1"></div>
                                <input type="hidden" name="chon" id="chon">
                            </div>
                        </div>
                    </div>
                    <div class="l_append" id="l_append">
                        <?

                        ?>
                        <div class="l_config" style="<?= (in_array(2, $config)) ? 'display:block' : 'display:none' ?>">
                            <div class="l-cau-hinh-3 l_config_wifi" id="l_config_wifi">
                                <h3 class="d-cau-hinh1" id="">Wifi mặc định để chấm công:</h3>
                                <?
                                foreach ($config_wifi as $wifi) {
                                ?>
                                    <div class="d-cau-hinh2 l_wifi" data-id="<?= $wifi->wifi_id ?>">

                                        <div class="l_delete_config_wifi">
                                            <?
                                            if ($wifi->is_default == 0) {
                                            ?>
                                                <img src="<?= base_url(); ?>/assets/images/Delete.svg" alt="xóa" class="l_img_delete_config l_curson" onClick="deletes(this)">
                                            <?
                                            }
                                            ?>
                                        </div>
                                        Địa chỉ wifi:
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3c">
                                                <input type="text" class="d-ten-wifi name_wifi" value="<?= $wifi->name_wifi ?>" id="ten_wifi" name="ten_wifi" placeholder="Tên wifi">
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3c">
                                                <input type="text" class="d-ten-wifi ip_wifi" id="ip_wifi" value="<?= $wifi->ip_address ?>" name="ip_wifi" placeholder="IP wifi" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\<?= base_url() ?>assets*)\./g, '$1');">
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3c">
                                                <input type="text" class="d-ten-wifi mac" id="mac" value="<?= $wifi->mac_address ?>" name="mac" placeholder="MAC">
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3c">
                                                <?
                                                if ($wifi->is_default == 1) {
                                                ?>
                                                    <button type="button" class="d-cau-hinh-submit l_curson wifi_mac_dinh">Wifi mặc định chấm công</button>
                                                <?
                                                } else {
                                                ?>
                                                    <button type="button" onclick="default_wifi(<?= $wifi->wifi_id ?>);" class="d-cau-hinh-submit l_curson">Đặt làm Wifi mặc định</button>
                                                <?
                                                }
                                                ?>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 error" id="err_wifi "></div>
                                        </div>
                                    </div>
                                    <div class="error_cau_hinh error" tabindex='1'></div>
                                <?
                                    $i++;
                                }
                                ?>
                            </div>
                            <div class="btn_add_content">
                                <button type="button" class="d-them-diem-dung1 l_custom_btn l_curson" onclick="add_config_wifi();" id="them_viec">Thêm cấu hình wifi</button>
                            </div>
                            <!-- <div class="l-cau-hinh-3 l_config_lat_long" id="l_config_lat_long">
                                <h3 class="d-cau-hinh1">Vị trí mặc định để chấm công:</h3>
                                </?php
                                $j = 1;
                                foreach ($expLatLong as $value1) {
                                    foreach ($config_lat_long as $lat_long) {
                                        if ($lat_long['id'] == $value1) {
                                ?>
                                            <div class="d-cau-hinh2">
                                                <div class="l_delete_config_wifi"><img src="</?= base_url(); ?>/assets/images/Delete.svg" alt="xóa" class="l_img_delete_config l_curson" onClick="deletes(this)"></div>
                                                Tọa độ:
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3c">
                                                        <input type="text" class="d-ten-wifi lat" value="</?= $lat_long['lat'] ?>" id="toa_do" name="toa_do" placeholder="lat">
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3c">
                                                        <input type="text" class="d-ten-wifi long" value="</?= $lat_long['long'] ?>" id="toa_do" name="toa_do" placeholder="longs">
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-12 d-cau-hinh3c">
                                                        <input type="text" class="d-ten-wifi address1" value="</?= $lat_long['address'] ?>" id="dia_chi" name="dia_chi" placeholder="Địa chỉ">
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 " id="err_vitri"></div>
                                                </div>
                                            </div>
                                            <div class="error_address error"></div>
                                </?
                                        }
                                    }
                                    $j++;
                                }
                                ?>
                            </div> -->
                        </div>
                        <?
                        ?>
                    </div>
                    <!-- <div class="btn_add_content">
                        <button type="button" class="d-them-diem-dung1 l_custom_btn l_curson" onclick="add_config_lat_long();" id="them_viec">Thêm tọa độ</button>
                    </div> -->
                    <div class="d-cau-hinh-4" style="<?= (in_array(2, $config)) ? 'display:block' : 'display:none' ?>">
                        <!-- <button type="reset" class="d-cau-hinh-reset">Nhập lại</button> -->
                        <button type="button" class="d-cau-hinh-submit" onclick="cau_hinh(); return false;">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <? include(APPPATH . '/views/includes/inc_footer.php') ?>
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/lazysizes.min.js"></script>
    <script src="<?= base_url() ?>assets/js/cty/cau_hinh_cham_cong.js"></script>
</body>

</html>