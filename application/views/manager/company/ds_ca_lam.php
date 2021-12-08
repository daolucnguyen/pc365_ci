<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách ca làm</title>

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

        .ds_calam,
        .ql_cong {
            color: #206AA9;
        }

        .l_hover_calam:hover ul {
            display: block;
            cursor: pointer;
        }

        .d-ds-cty-con3-1::before {
            margin-right: 5px;
        }

        .d-modal-them-calam {
            justify-content: space-between;
        }

        .d-them-ca-lam {
            margin: 0;
        }

        .d-phong-ban1 .dropdown-menu {
            min-width: 55px;
            top: 26px;
            left: -46px;
        }

        .l_form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            width: 94%;
            margin: 0px auto;
        }

        .l_width_select,
        .d-ds-cty-con1 {
            width: 35%;
        }

        .l_width_btn_search {
            width: auto;
        }

        .d-ds-cty-con2a-1 {
            border: none;
            box-shadow: none;

        }

        .d-ds-calam {
            padding: 0;
        }

        .btn_search {
            font-weight: bold;
        }

        .d-them-ca-lam,
        .d-them-ca-lam1 {
            width: 48%;
        }

        #num_shift,
        #hourly,
        #num_shift_edit,
        #hourly_edit {
            width: auto;
            margin: 0 13px 0 0;
        }

        .row {
            margin: 0;
        }

        .num_to_calculate {
            display: none;
        }

        @media only screen and (max-width: 768px) {
            .d-ds-ca-lam {
                width: auto;
            }

            .d-ds-cty-con2 {
                padding: 0;
            }

            .d-ds-cty-con2a-1,
            .d-ds-cty-con2 {
                width: 100%;
                padding: 0;
            }

            .d-ds-cty-con2a-1 {
                margin: 2% 0;
            }

            .l_width_select,
            .d-ds-cty-con1 {
                width: 100%;
                margin: 10px 0;
            }

            .d-ds-calam {
                padding-top: 10px;
            }
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
                <h3 class="d-qly-cham-cong">Danh sách ca làm</h3>
                <div id="alert"></div>
                <div class="d-ds-cty-con">
                    <div class="row">
                        <div class="l_form">
                            <!-- <div class=" d-ds-cty-con1 ">
                                <input type="text" class="d-ds-cty-input" id="keyWord" placeholder="Nhập từ khóa">
                            </div> -->
                            <div class=" d-ds-cty-con2 ">
                                <select name="" id="cong_ty" onchange="timkiem();" class="s-ds-cty-con2-1">
                                    <option value="">Chọn công ty</option>
                                    <?
                                    foreach ($company_small as $value) {
                                    ?>
                                        <option <?
                                                if ($id_com == $value->com_id) {
                                                    echo "selected";
                                                }
                                                ?> value="<?= $value->com_id ?>"><?= $value->com_name ?></option>
                                    <?
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- <div class=" d-ds-cty-con2 l_text_right l_width_btn_search">
                                <button class="btn_search l_clear_margin" type="button" onclick="timkiem(); return false;">Tìm kiếm</button>
                            </div> -->
                            <div class=" d-ds-calam">
                                <p class="d-ds-cty-con3-1 d-ds-ca-lam" data-toggle="modal" data-target="#them_cty">Thêm ca làm việc</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-ds-cty-con2a">
                    <div class="row">
                        <?
                        $ds_ca_lam = array_reverse($ds_ca_lam);
                        foreach ($ds_ca_lam as $value) {
                        ?>
                            <div class="col-md-3 col-sm-4 col-xs-12 d-ds-cty-con2a-1" id="shift<?= $value['shift_id'] ?>">
                                <div class="d-ds-phong-ban1">
                                    <div>
                                        <p class="d-them-calam" id="name<?= $value['shift_id'] ?>"><?= $value['shift_name'] ?></p>
                                        <div class="d-ds-phong-ban-p" id="time<?= $value['shift_id'] ?>"><?= $value['start_time'] ?> - <?= $value['end_time'] ?></div>
                                    </div>
                                    <div class="dropdown d-phong-ban1 l_hover_calam">
                                        <img class="dropdown-toggle d-ds-phong-banv1 l_curson" type="button" src="<?= base_url() ?>assets/images/them.svg">
                                        <ul class="dropdown-menu">
                                            <li><a class="d-phong-ban-1" onclick="getInfoShift(<?= $value['shift_id'] ?>)" data-toggle="modal" data-target="#sua_cty">Cập nhật</a></li>
                                            <li><a class="d-phong-ban-1" onclick="deleteShift(<?= $value['shift_id'] ?>);">Xóa</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?
                        }
                        ?>
                    </div>
                </div>
                <div class="phan-trang">
                </div>

            </div>
        </div>
        <!-- Thêm ca làm việc -->
        <div class="modal fade" id="them_cty">
            <div class="modal-dialog d-them-cty">
                <div class="modal-content d-modal-bo-loc1">
                    <div class="modal-header d-modal-bo-loc2">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <img src="<?= base_url() ?>assets/images/exit.svg" alt="exit" class="follow-map-img">
                        </button>
                        <h4 class="modal-title d-boloc-p">Thêm ca làm việc</h4>
                    </div>
                    <form method="post" class="d-form-them-cty" id="them_ca_lam">
                        <div class="d-fomr-them-cty1">
                            <select name="" id="chon_cty_add" class="d-form-input">
                                <option value="">Chọn công ty</option>
                                <?
                                foreach ($company_small as $value) {
                                ?>
                                    <option value="<?= $value->com_id ?>"><?= $value->com_name ?></option>
                                <?
                                }
                                ?>
                            </select>
                            <div class="error" id="err_cty"></div>
                        </div>
                        <div class="d-fomr-them-cty1">
                            <input type="text" class="d-form-input" id="ca_lam" name="ca_lam" placeholder="Nhập tên ca làm việc">
                            <div class="error" id="err_calam"></div>
                        </div>
                        <div class="d-modal-them-calam">
                            <div class="d-them-ca-lam">
                                <p class="d-them-ca-lam-v1">Giờ vào làm:</p>
                                <p class="d-them-ca-lam-v2">( Check in )</p>
                                <input type="time" class="d-them-ca-lam-v3" id="gio_vao" name="gio_vao" placeholder="Nhập tên giờ">
                                <div class="error" id="err_vaolam"></div>
                            </div>
                            <div class="d-them-ca-lam1">
                                <p class="d-them-ca-lam-v1">Giờ hết ca:</p>
                                <p class="d-them-ca-lam-v2">( Check out )</p>
                                <input type="time" class="d-them-ca-lam-v3" id="gio_ra" name="gio_ra" placeholder="Nhập tên giờ">
                                <div class="error" id="err_tanlam"></div>
                            </div>
                        </div>
                        <div class="d-modal-them-calam">
                            <div class="d-them-ca-lam">
                                <p class="d-them-ca-lam-v1">Giờ vào làm:</p>
                                <p class="d-them-ca-lam-v2">( Muộn nhất )</p>
                                <input type="time" class="d-them-ca-lam-v3" id="gio_vao_muon" name="gio_vao_muon" placeholder="Nhập tên giờ">
                                <div class="error" id="err_gio_vao_muon"></div>
                            </div>
                            <div class="d-them-ca-lam1">
                                <p class="d-them-ca-lam-v1">Giờ hết ca:</p>
                                <p class="d-them-ca-lam-v2">( Sớm nhất )</p>
                                <input type="time" class="d-them-ca-lam-v3" id="gio_ra_som" name="gio_ra_som" placeholder="Nhập tên giờ">
                                <div class="error" id="err_gio_ra_som"></div>
                            </div>
                        </div>
                        <div class="d-modal-them-calam">
                            <div class="d-them-ca-lam">
                                <div class="l_flex">
                                    <input type="radio" value="2" class="d-them-ca-lam-v3 d-tao-lich2 cach_thuc_tinh" id="hourly" name="num" placeholder="Nhập tên giờ">
                                    <label for="hourly">Tính công theo giờ</label>
                                </div>
                            </div>
                            <div class="d-them-ca-lam1">
                                <div class="l_flex">
                                    <input type="radio" value="1" class="d-them-ca-lam-v3 d-tao-lich2 cach_thuc_tinh" id="num_shift" name="num" placeholder="Nhập tên giờ">
                                    <label for="num_shift">Tính công theo số ca</label>
                                </div>
                            </div>
                        </div>
                        <div class="d-modal-them-calam">
                            <div class="error" id="err_cach_thuc_tinh"></div>
                        </div>
                        <div class="d-modal-them-calam num_to_calculate">
                            <select name="" id="num_to_calculate">
                                <option value="">Chọn số công</option>
                                <option value="1">0,25 công / 1 ca</option>
                                <option value="2">0,5 công / 1 ca</option>
                                <option value="3">1 công / 1 ca</option>
                                <option value="4">1,5 công / 1 ca</option>
                                <option value="5">2 công / 1 ca</option>
                                <option value="6">3 công / 1 ca</option>
                                <option value="7">4 công / 1 ca</option>
                            </select>
                        </div>
                        <div class="d-modal-them-calam num_to_calculate">
                            <div class="error" id="err_num_to_calculate"></div>
                        </div>
                        <div class="d-button-them-cty">
                            <button type="reset" class="d-them-cty-reset" data-dismiss="modal" aria-hidden="true">Nhập lại</button>
                            <button type="submit" class="d-them-cty-submit">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- sửa ca làm việc -->
        <div class="modal fade" id="sua_cty">
            <div class="modal-dialog d-them-cty">
                <div class="modal-content d-modal-bo-loc1">
                    <div class="modal-header d-modal-bo-loc2">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <img src="<?= base_url() ?>assets/images/exit.svg" alt="exit" class="follow-map-img">
                        </button>
                        <h4 class="modal-title d-boloc-p">Sửa ca làm việc</h4>
                    </div>
                    <form method="post" class="d-form-them-cty" id="edit_company">
                        <div class="d-fomr-them-cty1">
                            <input type="hidden" class="d-form-input" id="id_shift" value="" name="id_shift" placeholder="Chọn công ty">
                            <select name="" id="chon_cty_update" class="d-form-input">
                                <option value="">Chọn công ty</option>
                                <?
                                foreach ($company_small as $value) {
                                ?>
                                    <option value="<?= $value->com_id ?>"><?= $value->com_name ?></option>
                                <?
                                }
                                ?>
                            </select>
                            <div class="error" id="err_name"></div>
                        </div>
                        <div class="d-fomr-them-cty1">
                            <input type="text" class="d-form-input" id="ten_ca" name="ten_ca" placeholder="Nhập tên ca làm việc">
                            <div class="error" id="err_tenca"></div>
                        </div>
                        <div class="d-modal-them-calam">
                            <div class="d-them-ca-lam">
                                <p class="d-them-ca-lam-v1">Giờ vào làm:</p>
                                <p class="d-them-ca-lam-v2">( Check in )</p>
                                <input type="time" class="d-them-ca-lam-v3" id="time_in" name="time_in" placeholder="Nhập tên giờ">
                            </div>
                            <div class="d-them-ca-lam1">
                                <p class="d-them-ca-lam-v1">Giờ hết ca:</p>
                                <p class="d-them-ca-lam-v2">( Check out )</p>
                                <input type="time" class="d-them-ca-lam-v3" id="time_out" name="time_out" placeholder="Nhập tên giờ">
                            </div>
                        </div>
                        <div class="error" id="err_time"></div>

                        <div class="d-modal-them-calam">
                            <div class="d-them-ca-lam">
                                <p class="d-them-ca-lam-v1">Giờ vào làm:</p>
                                <p class="d-them-ca-lam-v2">( Muộn nhất )</p>
                                <input type="time" class="d-them-ca-lam-v3" id="gio_vao_muon_edit" name="gio_vao_muon" placeholder="Nhập tên giờ">
                                <div class="error" id="err_gio_vao_muon_edit"></div>
                            </div>
                            <div class="d-them-ca-lam1">
                                <p class="d-them-ca-lam-v1">Giờ hết ca:</p>
                                <p class="d-them-ca-lam-v2">( Sớm nhất )</p>
                                <input type="time" class="d-them-ca-lam-v3" id="gio_ra_som_edit" name="gio_ra_som" placeholder="Nhập tên giờ">
                                <div class="error" id="err_gio_ra_som_edit"></div>
                            </div>
                        </div>
                        <div class="d-modal-them-calam">
                            <div class="d-them-ca-lam">
                                <div class="l_flex">
                                    <input type="radio" value="2" class="d-them-ca-lam-v3 d-tao-lich2 cach_thuc_tinh" id="hourly_edit" name="num" placeholder="Nhập tên giờ">
                                    <label for="hourly_edit">Tính công theo giờ</label>
                                </div>
                            </div>
                            <div class="d-them-ca-lam1">
                                <div class="l_flex">
                                    <input type="radio" value="1" class="d-them-ca-lam-v3 d-tao-lich2 cach_thuc_tinh" id="num_shift_edit" name="num" placeholder="Nhập tên giờ">
                                    <label for="num_shift_edit">Tính công theo số ca</label>
                                </div>
                            </div>
                        </div>
                        <div class="d-modal-them-calam">
                            <div class="error" id="err_cach_thuc_tinh_edit"></div>
                        </div>
                        <div class="d-modal-them-calam num_to_calculate">
                            <select name="" class="num_to_calculate" id="num_to_calculate_edit">
                                <option value="">Chọn số công</option>
                                <option value="1">0,25 công / 1 ca</option>
                                <option value="2">0,5 công / 1 ca</option>
                                <option value="3">1 công / 1 ca</option>
                                <option value="4">1,5 công / 1 ca</option>
                                <option value="5">2 công / 1 ca</option>
                                <option value="6">3 công / 1 ca</option>
                                <option value="7">4 công / 1 ca</option>
                            </select>
                        </div>
                        <div class="d-modal-them-calam num_to_calculate">
                            <div class="error" id="err_num_to_calculate_edit"></div>
                        </div>
                        <div class="d-button-them-cty">
                            <button type="reset" class="d-them-cty-reset" data-dismiss="modal" aria-hidden="true">Nhập lại</button>
                            <button type="submit" class="d-them-cty-submit">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <? include(APPPATH . '/views/includes/inc_footer.php') ?>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/lazysizes.min.js"></script>
    <script src="<?= base_url() ?>assets/js/cty/them_ca_lam.js"></script>
    <script>
    </script>
</body>

</html>