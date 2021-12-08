<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUẢN LÝ CHẤM CÔNG NHÂN VIÊN</title>

    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/quan_ly_cty.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
    <style>
        .ql_face {
            color: #206AA9;
        }

        #d-qly-cham-cong1-v1a1,
        #d-qly-cham-cong1-v1a2 {
            display: block;
        }

        .l_custom_btn_cham_cong {
            padding: 0;
            margin-left: 6px;
        }

        .l_custom_btn_cham_cong button {
            border: none;
            height: 49px;
            margin-top: 0;
        }

        .l_margin {
            padding: 20px 0px 0px;
        }


        .d-qly-cham-cong1-v3a {
            width: 100%;
        }

        .btn_face {
            border: 1px solid #ccc;
            padding: 5px 10px;
            border-radius: 10px;
            color: white;
            background: #206AA9;
        }

        .form_search{
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .input_search{
            width: 100%;
        }

        .d-qly-cham-cong1-v1a-input{
            width: 100%;
        }

        .d-qly-cham-cong1-v1{
            width: 30%;
        }

        .d-qly-cham-cong1-v2{
            width: 60%;
            display: flex;
            justify-content: space-between;
        }
        .d-xuat-excel{
            padding: 5px 20px
        }
        @media only screen and (max-width:1024px) {
            #d-qly-cham-cong1-v1a1,
            #d-qly-cham-cong1-v1a2 {
                display: none;
            }
            .l_margin {
                display: flex;
                align-items: center;
            }
        }

        @media only screen and (max-width:768px) {
            .d-qly-cham-cong1-v3a {
                width: 180%;
            }
            .d-qly-cham-cong1-v1,.d-qly-cham-cong1-v2{
                width: 100%;
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
            <?php require_once APPPATH . '/views/includes/header_manager.php'; ?>
            <div class="d-qly-cty1-v1">
                <div id="alert"></div>
                <h3 class="d-qly-cham-cong">Quản lí nhận diện khuôn mặt</h3>
                <div class="d-qly-cham-cong1">
                    <div class="d-qly-cc">
                        <form action="" class="form_search" onsubmit="timkiem(); return false;">
                            <div class="d-qly-cham-cong1-v1">
                                <div class="d-qly-cham-cong1-v1a input_search">
                                    <input type="text" value="<?= $keyword ?>" id="search" name="search" class="d-qly-cham-cong1-v1a-input" placeholder="Nhập từ khóa">
                                </div>
                            </div>
                            <div class="d-qly-cham-cong1-v2 ">
                                <div class="col-md-5 d-qly-cham-cong1-v1a d-qly-cham-cong-tab">
                                    <select name="chi_nhanh" onchange="showdepartment(1)" id="chi_nhanh" class="d-chi-nhanh">
                                        <option value="">Chọn Chi nhánh</option>
                                        <?
                                        foreach ($list_company as $company) {
                                        ?>
                                            <option <?= ($com_id == $company->com_id) ? "selected" : "" ?> value="<?= $company->com_id ?>"><?= $company->com_name ?></option>
                                        <?
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="col-md-4 d-qly-cham-cong1-v1a1">
                                    <select name="phong_ban" id="phong_ban" class="d-phong-ban">
                                        <option value="">Chọn phòng ban nhân viên</option>

                                        <?
                                        if (!empty($com_id)) {
                                            foreach ($show_department as $pb) {
                                        ?>
                                                <option <?= ($department == $pb['dep_id']) ? "selected" : "" ?> value="<?= $pb['dep_id'] ?>"><?= $pb['dep_name'] ?></option>
                                        <?
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="d-qly-cham-cong1-v1a3 l_custom_btn_cham_cong">
                                    <button type="button" onclick="timkiem(); return false;" class="d-xuat-excel">tìm kiếm</button>
                                </div>
                                <div class="d-bo-loc" data-toggle="modal" data-target="#bo_loc">
                                    <p class="d-bo-loc-p">Lọc tìm kiếm</p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="d-qly-cham-cong1-v3">
                        <table class="d-qly-cham-cong1-v3a">
                            <thead>
                                <tr class="d-qly-cham-cong1-v3a-tr">
                                    <th class="text-center d-qly-cham-cong-th">
                                        <p class="d-qly-cham-cong-p">Thông tin nhân viên ( ID )</p>
                                    </th>
                                    <th class="text-center d-qly-cham-cong-th">
                                        <p class="d-qly-cham-cong-p">Email</p>
                                    </th>
                                    <th class="text-center d-qly-cham-cong-th">
                                        <p class="d-qly-cham-cong-p">Cấp quyền</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <? if (!empty($staff_active)) {
                                    foreach ($staff_active as $key => $value) { ?>
                                        <tr class="">
                                            <td class="text-center d-qly-cham-cong-td">
                                                <p class="d-cham-cong-p2"><?= $value->ep_name ?> (<?= $value->ep_id ?>)</p>
                                            </td>
                                            <td class="text-center d-qly-cham-cong-td">
                                                <p class="d-cham-cong-p2"><?= $value->ep_email ?></p>
                                            </td>
                                            <td class="text-center d-qly-cham-cong-td">
                                                <button class="btn_face" onclick="update_face(<?= $value->ep_id ?>)">Cấp quyền</button>
                                            </td>
                                        </tr>
                                <? }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-qly-cham-cong2">
                    <div class="phan-trang"><?= $links ?></div>
                </div>
            </div>
        </div>

    </div>
    <!-- modal bộ lọc -->

    <div class="modal fade" id="bo_loc">
        <div class="modal-dialog d-modal-bo-loc">
            <div class="modal-content d-modal-bo-loc1">
                <div class="modal-header d-modal-bo-loc2">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <img src="<?= base_url(); ?>assets/images/exit.svg" alt="exit" class="follow-map-img">
                    </button>
                    <h4 class="modal-title d-boloc-p">Lọc tìm kiếm</h4>
                </div>
                <form class="d-modal-boloc" onsubmit="timkiem(); return false;">
                    <div class="d-modal-boloc1">
                        <select name="chi_nhanh" onchange="showdepartment(2)" id="chi_nhanh1" class="d-chi-nhanh">
                            <option value="">Chọn Chi nhánh</option>

                        </select>
                    </div>
                    <div class="d-modal-boloc1">
                        <select name="phong_ban" id="phong_ban1" class="d-phong-ban">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="d-modal-boloc2">
                        <button type="button" class="d-modal-boloc-huy" data-dismiss="modal" aria-hidden="true">Hủy</button>
                        <button type="button" onclick="timkiem(); return false;" class="d-modal-boloc-tk">Tìm kiếm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <? require_once APPPATH . '/views/includes/inc_footer.php' ?>
    <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/Chart.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/cty/face.js"></script>
</body>
</html>