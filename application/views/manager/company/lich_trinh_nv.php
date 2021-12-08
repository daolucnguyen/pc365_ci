<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Trình Nhân Viên</title>

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
        .ql_lichtrinh {
            color: #206AA9;
        }

        .l_hover_drop:hover ul {
            display: block;
        }

        .d-dropdown-menu {
            top: 20px;
            left: -72px;
            min-width: 88px;
            padding: 10px;
            background: #FFFFFF;
            box-shadow: 0px 4px 40px rgb(0 0 0 / 5%);
            border-radius: 5px;
        }
        .d-qly-cham-cong1-v3{
            overflow: unset; 
            overflow-x: unset;
        }
        .form_search {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .lich-trinh-nv .d-qly-cham-cong1-map {
            padding: 7px 0px;
        }

        .d-qly-cham-cong1-v1a-input,
        .d-qly-cham-cong1-v1a-input1 {
            background: none;
            height: 50px;
        }

        .l_relative {
            position: relative;
        }

        .l_absolude {
            position: absolute;
            right: 5px;
            top: 10px;
            display: none;
        }

        .form_search {
            align-items: center;
        }

        .margin_srarch {
            margin-top: 20px;
        }

        .d-lich-trinh-nv,.d-xuat-excel{
            padding: 12px;
        }

        .d-qly-cham-cong1-map,.d-qly-cham-cong1-v1a3{
            width: 150px;
        }

        @media only screen and (max-width: 1024px) {
            .btn_search {
                margin: 10px 0;
            }
        }

        @media only screen and (max-width: 768px) {
            .l_absolude {
                display: block;
            }
        }
    </style>
</head>

<body>
    <div class="d-quan-ly-cty">
        <div class="l_block_sidebar">
            <?php include APPPATH . "views/includes/sidebar_left_cty.php"; ?>
        </div>
        <div class="d-quan-ly-cty1">
            <?php include APPPATH . "views/includes/header_manager.php"; ?>
            <div class="d-qly-cty1-v1">
                <div id="alert"></div>
                <h3 class="d-qly-cham-cong">Lịch trình nhân viên</h3>
                <div class="d-qly-cham-cong1">
                    <div class="lich-trinh-nv">
                        <div class="d-qly-cham-cong1-v1">
                            <form action="" class="form_search" onsubmit="timkiem(); return false;">
                                <div class="col-md-5 col-sm-12 col-xs-12 d-qly-cham-cong1-v1a">
                                    <input type="text" value="<?= $name ?>" id="search" name="search" class="d-qly-cham-cong1-v1a-input" placeholder="Nhập tên lịch trình">
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 d-qly-lich-trinh-v1a1 l_relative">
                                    <input type="date" value="<? if ($datestart != "") {
                                                                    echo date('Y-m-d', $datestart);
                                                                } ?>" id="date_start" name="search" class="d-qly-cham-cong1-v1a-input">
                                    <label for="date_start" class="l_absolude">
                                        <img src="<?= base_url() ?>assets/images/Calendar.png" alt="date">
                                    </label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 d-qly-lich-trinh1-v1a2 l_relative">
                                    <input type="date" value="<? if ($dateend != "") {
                                                                    echo date('Y-m-d', $dateend);
                                                                } ?>" id="date_end" name="search" class="d-qly-cham-cong1-v1a-input">
                                    <label for="date_start" class="l_absolude">
                                        <img src="<?= base_url() ?>assets/images/Calendar.png" alt="date">
                                    </label>
                                </div>
                                <div class="d-bo-loc-lich margin_srarch" data-toggle="modal" data-target="#bo_loc">
                                    <p class="d-filter-p">Lọc tìm kiếm</p>
                                </div>
                                <button class="btn_search margin_srarch" type="button" onclick="timkiem(); return false;">Tìm kiếm</button>
                            </form>
                        </div>
                        <div class="d-qly-lich-trinh">

                            <div class="col-md-3 col-sm-3 col-xs-6 d-qly-cham-cong1-map">
                                <a href="<?= urlTaolichtrinh(); ?>" class="d-lich-trinh-nv">Tạo lịch trình</a>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-6 d-qly-cham-cong1-v1a3">
                                <div onclick="export_excel_schedule();" class="d-xuat-excel">Xuất Excel</div>
                            </div>
                        </div>
                    </div>
                    <div class="d-qly-cham-cong1-v3">
                        <div class="d-qly-nhan-vien1">
                            <div class="d-ds-nv1 active" id="ds_nhan_vien">
                                <table class="table-hover d-table-lich-trinh">
                                    <thead>
                                        <tr class="d-table-nv-tr">
                                            <th class="d-table-nv-th d-tb-nv-th1">Thông tin nhân viên ( ID )</th>
                                            <th class="d-table-nv-th">Tên lịch trình</th>
                                            <th class="d-table-nv-th">Ngày tháng</th>
                                            <th class="d-table-nv-th">Ghi chú</th>
                                            <th class="d-table-nv-th">Trạng thái</th>
                                            <th class="d-table-nv-th d-tb-nv-th"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?
                                        $i = 0;
                                        foreach ($info_schedule as $value) {
                                        ?>
                                            <tr class="d-table-nv-tr1" id="schedule<?= $value['id'] ?>">
                                                <td class=" d-table-nv-td">
                                                    <div class="d-info-nv">
                                                        <img src="https://chamcong.24hpay.vn/upload/employee/<?= $arr_ep[$value['staff_id']]['ep_image'] ?>" onerror='this.onerror=null;this.src="<? base_url() ?>/images_staff/avatar_default.png";' alt="name_nv" class="d-info-img">
                                                        <div class="d-cham-cong-td1a">
                                                            <p class="d-cham-cong-p">(<?= $arr_ep[$value['staff_id']]['ep_id'] ?>)<?= $arr_ep[$value['staff_id']]['ep_name'] ?></p>
                                                            <p class="d-cham-cong-p1">Nhân viên <?= $arr_ep[$value['staff_id']]['dep_name'] ?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center d-table-nv-td">
                                                    <a href="<?= urlChiTietLichTrinh(); ?>?schduleId=<?= $value['id'] ?>" class="d-cham-cong-p"><?= $value['name'] ?></a>
                                                </td>
                                                <td class="text-center d-table-nv-td">
                                                    <p class="d-ghi-nv"><?= date("d-m-Y", $value['date_start']) ?>||</p>
                                                    <p class="d-ghi-nv"><?= date("d-m-Y", $value['date_end']) ?></p>
                                                </td>
                                                <td class="text-center d-table-nv-td">
                                                    <p class="d-ghi-nv"><?= $value['note'] ?></p>
                                                </td>
                                                <td class="text-center d-table-nv-td">
                                                    <?
                                                    if ($value['status'] == 1) {
                                                    ?>
                                                        <p class="d-email-nv" style="color:#1F3F77;padding:0 6px;background: #EEF5FC;border-radius: 5px;">Hoàn thành</p>
                                                    <?
                                                    }
                                                    if ($value['status'] == 3) {
                                                    ?>
                                                        <p class="d-email-nv" style="color: #F79722;padding:0 6px;background: rgba(247, 151, 34, 0.1);border-radius: 5px;">Đang làm</p>
                                                    <?
                                                    }
                                                    if ($value['status'] == 2) {
                                                    ?>
                                                        <p class="d-email-nv" style="color:#B31217;padding:0 6px;background: rgba(179, 18, 23, 0.1);border-radius: 5px;">Hủy</p>
                                                    <?
                                                    }
                                                    if ($value['status'] == 4) {
                                                    ?>
                                                        <p class="d-email-nv" style="color:#1F3F77;padding:0 6px;background: #EEF5FC;border-radius: 5px;">Dự kiến</p>
                                                    <?
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center d-table-nv-td">
                                                    <div class="dropdown l_hover_drop l_curson">
                                                        <img src="<?= base_url() ?>assets/images/them.svg" alt="3 chấm" class="dropdown-toggle d-dropdown ">
                                                        <ul class="dropdown-menu d-dropdown-menu">
                                                            <div><a href="<?= urlSualichtrinh(); ?>?sc=<?= $value['id'] ?>" class="d-lich-trinh l_curson">Sửa</a></div>
                                                            <?
                                                            if ($value['status'] == 4) {
                                                            ?>
                                                                <div><button type="button" onclick="deleteSchedule(<?= $value['id'] ?>,<?= $value['staff_id'] ?>);" class="d-lich-trinh l_curson">Xóa</button></div>
                                                            <?
                                                            }
                                                            if ($value['status'] == 3) {
                                                            ?>

                                                                <div><a href="/danh-cho-cong-ty/lich-trinh-nhan-vien-tren-map.html" class="d-lich-trinh l_curson">Theo dõi</a></div>
                                                            <?
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?
                                        $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?
                                $i = 0;
                                foreach ($info_schedule as $value) {
                                ?>
                                    <div class="d-ds-lich-trinh-mobile" id="scheduleMb<?= $value['id'] ?>">
                                        <div class="d-ds-lich-trinh">
                                            <img src="https://chamcong.24hpay.vn/upload/employee/<?= $arr_ep[$value['staff_id']]['ep_image'] ?>" onerror='this.onerror=null;this.src="<? base_url() ?>/images_staff/avatar_default.png";' alt="name_nv" class="d-info-img">
                                            <div class="d-lich-trinh-td1a">
                                                <p class="d-cham-cong-p">(<?= $arr_ep[$value['staff_id']]['ep_id'] ?>)<?= $arr_ep[$value['staff_id']]['ep_name'] ?></p>
                                                <p class="d-cham-cong-p1">Nhân viên<?= $arr_ep[$value['staff_id']]['dep_name'] ?></p>
                                            </div>
                                        </div>
                                        <div class="d-lich-trinh-mobie">
                                            <a href="<?= urlChiTietLichTrinh(); ?>?schduleId=<?= $value['id'] ?>" class="d-cham-cong-p"><?= $value['name'] ?></a>
                                        </div>
                                        <div class="d-lich-trinh-mobie"><span class="d-ghichu-nv1">Ghi chú: </span>
                                            <p class="d-ghi-nv"><?= $value['note'] ?></p>
                                        </div>
                                        <div class="d-lich-trinh-mobie">
                                            <p class="d-ghi-nv"><?= date("d-m-Y", $value['date_start']) ?> || <?= date("d-m-Y", $value['date_end']) ?></p>
                                        </div>
                                        <div class="d-lich-trinh1-mobie">
                                            <p class="d-icon-them"></p>
                                            <div class="dropdown-content">
                                                <div class="d-edit-nv l_width">
                                                    <div><a href="<?= urlSualichtrinh(); ?>?sc=<?= $value['id'] ?>" class="d-update-nv l_curson">Sửa</a></div>
                                                    <?
                                                    if ($value['status'] == 4) {
                                                    ?>
                                                        <div><button type="button" onclick="deleteSchedule(<?= $value['id'] ?>,<?= $value['staff_id'] ?>);" class="d-delete-nv d-lich-trinh l_curson">Xóa</button></div>
                                                    <?
                                                    }
                                                    if ($value['status'] == 3) {
                                                    ?>

                                                        <div><a href="/danh-cho-cong-ty/lich-trinh-nhan-vien-tren-map.html" class="d-lich-trinh l_curson">Theo dõi</a></div>
                                                    <?
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-lich-trinh2-mobie">

                                            <?
                                            if ($value['status'] == 1) {
                                            ?>
                                                <p class="d-email-nv" style="color:#1F3F77;padding:0 6px;background: #EEF5FC;border-radius: 5px; ">Hoàn thành</p>
                                            <?
                                            }
                                            if ($value['status'] == 3) {
                                            ?>
                                                <p class="d-email-nv" style="color: #F79722;padding:0 6px;background: rgba(247, 151, 34, 0.1);border-radius: 5px;">Đang làm</p>
                                            <?
                                            }
                                            if ($value['status'] == 2) {
                                            ?>
                                                <p class="d-email-nv" style="color:#B31217;padding:0 6px;background: rgba(179, 18, 23, 0.1);border-radius: 5px; ">Hủy</p>
                                            <?
                                            }
                                            if ($value['status'] == 4) {
                                            ?>
                                                <p class="d-email-nv" style="color:#1F3F77;padding:0 6px;background: #EEF5FC;border-radius: 5px;">Dự kiến</p>
                                            <?
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?
                                $i++;
                                }
                                ?>
                            </div>
                        </div>
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
                        <img src="<?= base_url() ?>assets/images/close.svg" alt="exit" class="follow-map-img">
                    </button>
                </div>
                <div class="modal-body d-follow-map">
                    <div class="d-follow-map1">
                        <img src="<?= base_url() ?>assets/images/img_map.svg" alt="map" class="d-follow-map1-img">
                    </div>
                    <div class="d-follow-map2">
                        <h4 class="d-follow-map2-v1">Chấm công ngày 19/4/2021</h4>
                        <div class="d-follow-map2-v2">
                            <table class="d-follow-map2-table">
                                <thead>
                                    <tr>
                                        <th class="d-follow-map-th">Thông tin</th>
                                        <th class="d-follow-map-th">Ca làm việc</th>
                                        <th class="d-follow-map-th">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="d-follow-map-td">
                                            <div class="d-follow-map2-v2a">
                                                <img src="<?= base_url() ?>assets/images/Ellipse124.svg" alt="ten nv" class="d-follow-map2-v2a-img">
                                                <div class="d-follow-map2-v2b">
                                                    <p class="d-follow-map2-v2a-p">(162) Ngô Ngọc Yến</p>
                                                    <p class="d-follow-map2-v2a-p1">Nhân viên phòng kĩ thuật</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="d-follow-map-td">
                                            <p class="d-follow-map2-v2a-p2">Ca Sáng ( 08:00 - 11:30 )</p>
                                        </td>
                                        <td class="d-follow-map-td">
                                            <div class="d-follow-map-v2">
                                                <p class="d-follow-map2-v2a-p3">Đúng giờ</p>
                                                <p class="d-follow-map2-v2a-p4" style="display:none">Đi muộn</p>
                                                <p class="d-follow-map2-v2a-p5" style="display:none">Về sớm</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
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
                        <img src="<?= base_url() ?>assets/images/exit.svg" alt="exit" class="follow-map-img">
                    </button>
                    <h4 class="modal-title d-boloc-p">Lọc tìm kiếm</h4>
                </div>
                <form class="d-modal-boloc" onsubmit="timkiem();return false;">
                    <div class="d-modal-boloc1">
                        <select name="cty" id="cty" onchange="showdepartment();" class="d-chi-nhanh">
                            <option value="">Chọn công ty</option>
                            <?
                            foreach ($detail_company_small as $cv) {
                            ?>
                                <option <?
                                        if ($cty == $cv->com_id) {
                                            echo "selected";
                                        }
                                        ?> value="<?= $cv->com_id ?>"><?= $cv->com_name ?></option>
                            <?
                            }
                            ?>
                        </select>
                    </div>
                    <div class="d-modal-boloc1">
                        <select name="phong_ban" id="phong_ban" class="d-phong-ban">
                            <option value="">Chọn phòng ban</option>
                        </select>
                    </div>
                    <div class="d-modal-boloc1">
                        <select name="lich_trinh" id="lich_trinh" class="d-chi-nhanh">
                            <option value="">Chọn lịch trình</option>
                            <?
                            foreach ($listSchedule as $value) {
                            ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                            <?
                            }
                            ?>

                        </select>
                    </div>
                    <div class="d-modal-boloc2">
                        <button type="button" class="d-modal-boloc-huy" data-dismiss="modal" aria-hidden="true">Hủy</button>
                        <button type="button" onclick="timkiem();return false;" class="d-modal-boloc-tk">Tìm kiếm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal thêm nv -->
    <? include(APPPATH . 'views/includes/inc_footer.php') ?>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/Chart.min.js"></script>
    <script src="<?= base_url() ?>assets/js/cty/lich_trinh_nv.js"></script>
</body>

</html>