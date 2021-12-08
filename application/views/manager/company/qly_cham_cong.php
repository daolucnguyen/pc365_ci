<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUẢN LÝ CHUNG</title>

    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/quan_ly_cty.css">
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
        .ql_chamcong {
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

        @media only screen and (max-width:1024px) {

            #d-qly-cham-cong1-v1a1,
            #d-qly-cham-cong1-v1a2 {
                display: none;
            }

            .l_margin {
                display: flex;
                align-items: center;
            }

            .l_custom_btn_cham_cong button {
                height: auto;
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
                <h3 class="d-qly-cham-cong">Quản lí chấm công</h3>
                <div class="d-qly-cham-cong1">
                    <div class="d-qly-cc">
                        <form action="" onsubmit="timkiem(); return false;">
                            <div class="d-qly-cham-cong1-v1">
                                <div class="col-md-6 col-sm-12 col-xs-12 d-qly-cham-cong1-v1a">
                                    <!-- <input type="text" value="<?= $keyWord ?>" id="search" name="search" class="d-qly-cham-cong1-v1a-input" placeholder="Nhập từ khóa"> -->
                                    <select class="d-qly-cham-cong1-v1a-input" name="" id="search">
                                        <option value="">Chọn nhân viên</option>
                                        <?
                                        foreach($list_ep as $value){
                                            ?>
                                            <option <?= ($keyWord == $value->ep_id) ? "selected" : "" ?> value="<?= $value->ep_id ?>"><?= $value->ep_name ?></option>
                                            <?
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?
                                $d01 = date('Y-m-01');
                                $d02 = date('Y-m-d');
                                ?>
                                <div class="col-md-3 col-sm-12 col-xs-12 d-qly-cham-cong1-v1a1" id="d-qly-cham-cong1-v1a1">
                                    <input type="date" value="<?= $dateStart ?>" max="<?= $d02 ?>" id="date_start" name="search" class="d-qly-cham-cong1-v1a-input">
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12 d-qly-cham-cong1-v1a2" id="d-qly-cham-cong1-v1a2">
                                    <input type="date" value="<?= $dateEnd ?>" max="<?= $d02 ?>" id="date_end" name="search" class="d-qly-cham-cong1-v1a-input">
                                </div>
                            </div>
                            <div class="d-qly-cham-cong1-v2 l_margin">
                                <div class="col-md-4 d-qly-cham-cong1-v1a d-qly-cham-cong-tab">
                                    <select name="chi_nhanh" onchange="showdepartment()" id="chi_nhanh" class="d-chi-nhanh">
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
                                <div class="col-md-3 d-qly-cham-cong1-v1a1">
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
                                <div class="col-sm-4 col-xs-6 d-bo-loc" data-toggle="modal" data-target="#bo_loc">
                                    <p class="d-bo-loc-p">Lọc tìm kiếm</p>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-6 d-qly-cham-cong1-v1a3 l_custom_btn_cham_cong">
                                    <button type="button" onclick="timkiem(); return false;" class="d-xuat-excel">tìm kiếm</button>
                                </div>
                            </div>
                        </form>
                        <div class="d-qly-cham-cong1-v2">
                            <div class="col-md-3 col-sm-6 col-xs-6 d-qly-cham-cong1-map">
                                <p class="d-cham-cong-map" data-toggle="modal" href='#follow_map'>Theo dõi trên map</p>
                                <p class="d-qly-nv" data-toggle="modal" data-target='#add_staff' id="l_them_nv">Thêm nhân viên</p>
                                <p class="d-lich-trinh-nv" data-toggle="modal" data-target='#add_lich_trinh'>Tạo lịch trình</p>
                            </div>
                            <!-- <div class="col-md-2 col-sm-2 col-xs-6 d-qly-cham-cong1-v1a3">
                                <div class="d-xuat-excel">Xuất Excel</div>
                            </div> -->
                        </div>
                    </div>
                    <div class="d-qly-cham-cong1-v3" style="overflow-x: scroll;">
                        <table class="d-qly-cham-cong1-v3a">
                            <thead>
                                <tr class="d-qly-cham-cong1-v3a-tr">
                                    <th class="text-center d-qly-cham-cong-th">
                                        <p class="d-qly-cham-cong-p">Thông tin nhân viên ( ID )</p>
                                    </th>
                                    <th class="text-center d-qly-cham-cong-th">
                                        <p class="d-qly-cham-cong-p">Ca làm việc</p>
                                    </th>
                                    <th class="text-center d-qly-cham-cong-th">
                                        <p class="d-qly-cham-cong-p">Thời gian điểm danh</p>
                                    </th>
                                    <th class="text-center d-qly-cham-cong-th">
                                        <p class="d-qly-cham-cong-p">Địa chỉ</p>
                                    </th>
                                    <th class="text-center d-qly-cham-cong-th">
                                        <p class="d-qly-cham-cong-p">Ghi chú</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <? if (!empty($arr_sheet)) {
                                    foreach ($arr_sheet as $key => $value) { ?>
                                        <tr class="">
                                            <td class="d-qly-cham-cong-td">
                                                <div class="d-qly-cham-cong-td1">
                                                    <div class="d-cham-cong-td1-img">
                                                        <img src="https://chamcong.24hpay.vn/image/time_keeping/<?= $value->ts_image ?>" onerror='this.onerror=null;this.src="<? base_url() ?>/images_staff/avatar_default.png";' alt="name_nv" class="d-info-img">
                                                    </div>
                                                    <div class="d-cham-cong-td1a">
                                                        <p class="d-cham-cong-p" style="<?= ($value->is_success == 0) ? 'color:red' : '' ?>">(<?= $value->ep_id ?>) <?= $value->ep_name ?></p>
                                                        <p class="d-cham-cong-p1" style="<?= ($value->is_success == 0) ? 'color:red' : '' ?>">Nhân viên <?
                                                                                                                                                        $detail = detailStaff($value->ep_id,$_SESSION['company']['token']);
                                                                                                                                                        echo $detail->dep_name;
                                                                                                                                                        ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center d-qly-cham-cong-td">
                                                <p class="d-cham-cong-p2" style="<?= ($value->is_success == 0) ? 'color:red' : '' ?>"><?= $value->shift_name ?></p>
                                            </td>
                                            <td class="text-center d-qly-cham-cong-td">
                                                <p class="d-cham-cong-p2" style="<?= ($value->is_success == 0) ? 'color:red' : '' ?>"><?= $value->at_time ?></p>
                                            </td>
                                            <td class="text-center d-qly-cham-cong-td">
                                                <p class="d-cham-cong-p2" style="<?= ($value->is_success == 0) ? 'color:red' : '' ?>"><?= $value->ts_location_name ?></p>
                                            </td>
                                            <td class="text-center d-qly-cham-cong-td">
                                                <p class="d-cham-cong-p2" style="<?= ($value->is_success == 0) ? 'color:red' : '' ?>"><?= ($value->is_success == 1) ? $value->note : $value->ts_error ?></p>
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
    <!-- modal map -->

    <div class="modal fade" id="follow_map">
        <div class="modal-dialog d-modal-dialog">
            <div class="modal-content d-modal-content-map">
                <div class="modal-header modal-follow-map">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <img src="<?= base_url(); ?>assets/images/close.svg" alt="exit" class="follow-map-img">
                    </button>
                </div>
                <div class="modal-body d-follow-map">
                    <div class="d-follow-map1">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d14899.584618781577!2d105.8407837!3d20.9967994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1631696074189!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
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
                        <input type="date" value="" id="date_start_modal" name="search" class="d-qly-cham-cong1-v1a-input">
                    </div>
                    <div class="d-modal-boloc1">
                        <input type="date" value="" id="date_end_modal" name="search" class="d-qly-cham-cong1-v1a-input">
                    </div>
                    <div class="d-modal-boloc1">
                        <select name="chi_nhanh" onchange="showdepartment()" id="chi_nhanh1" class="d-chi-nhanh">
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
    <script src="<?= base_url(); ?>assets/js/cty/qly_cham_cong.js"></script>
    
</body>

</html>