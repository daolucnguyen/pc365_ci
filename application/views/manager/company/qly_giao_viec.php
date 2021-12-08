<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giao việc</title>

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
        .ql_giaoviec {
            color: #206AA9;
        }

        .l_form {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            align-items: center;
        }

        .row:before,
        .row:after {
            content: unset;
        }

        .d-giaoviec2 {
            justify-content: space-between;
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

        .d-giao-viec {
            margin-top: 20px;
        }

        .d-giao-viec .select2-container--default .select2-selection--single .select2-selection__arrow,
        .d-giao-viec .select2-container .select2-selection--single {
            height: 47px;
        }

        .btn_search {
            margin-top: 20px;
        }

        .d-bo-loc-lich {
            margin-top: 20px;
        }

        .d-qly-cham-cong1-v1a-input,
        .d-qly-cham-cong1-v1a-input1 {
            height: 50px;
            background: none;
        }

        .num_ep {
            width: 30px;
            height: 30px;
            border: 1px solid #cccccc;
            border-radius: 50%;
            line-height: 30px;
            text-align: center;
            background: #c6c6c6;
        }

        .l_margin_img{
            display: flex;
        }

        @media only screen and (max-width: 768px) {
            .l_absolude {
                display: block;
            }

            .d-bo-loc-lich {
                padding: 0;
            }

            .d-new-job-v1a {
                display: unset;
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
                <h3 class="d-qly-cham-cong">Giao việc</h3>
                <div class="d-qly-cham-cong1">
                    <div class="lich-trinh-nv">
                        <div class="d-qly-cham-cong1-v1">
                            <form action="" onsubmit="timkiem(); return false;" class="l_form">
                                <div class="col-md-4 col-sm-12 col-xs-12 d-qly-cham-cong1-v1a">
                                    <input type="text" value="<?= $keyWord ?>" id="search" name="search" class="d-qly-cham-cong1-v1a-input" placeholder="Nhập từ khóa">
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 d-qly-lich-trinh-v1a1 l_relative">
                                    <input type="date" value="<? if ($date_start != '') {
                                                                    echo  date('Y-m-d', $date_start);
                                                                } ?>" id="date_start" name="search" class="d-qly-cham-cong1-v1a-input">
                                    <label for="date_start" class="l_absolude">
                                        <img src="<?= base_url() ?>assets/images/Calendar.png" alt="date">
                                    </label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 d-qly-lich-trinh1-v1a2 l_relative">
                                    <input type="date" value="<? if ($date_end != '') {
                                                                    echo date('Y-m-d', $date_end);
                                                                } ?>" id="date_end" name="search" class="d-qly-cham-cong1-v1a-input">
                                    <label for="date_start" class="l_absolude">
                                        <img src="<?= base_url() ?>assets/images/Calendar.png" alt="date">
                                    </label>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 d-giao-viec">
                                    <?
                                    $arr = [
                                        '1' => 'Quá hạn',
                                        '2' => 'Đã làm',
                                        '3' => 'Đang làm',
                                        '4' => 'Dự kiến',
                                    ];
                                    ?>
                                    <select name="trang_thai" id="trang_thai" class="trang-thai">
                                        <option value="">Trạng thái công việc</option>
                                        <?
                                        foreach ($arr as $key => $value) {
                                        ?>
                                            <option <?
                                                    if ($key == $status) {
                                                        echo 'selected';
                                                    }
                                                    ?> value="<?= $key ?>"><?= $value ?></option>
                                        <?
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-4 col-xs-6 d-bo-loc-lich" data-toggle="modal" data-target="#bo_loc">
                                    <p class="d-filter-p">Lọc tìm kiếm</p>
                                </div>
                                <button class="btn_search" type="submit" onclick="timkiem(); return false;">tìm kiếm</button>
                            </form>
                        </div>
                        <div class="d-qly-lich-trinh">

                            <div class="col-md-3 col-sm-6 col-xs-6 d-giao-viec1">
                                <a href="<?= urlTaoCongViec(); ?>" class="d-giao-viec-nv">Tạo công việc</a>
                            </div>
                        </div>
                        <!-- <div class="d-giao-viec-1">
                            <p class="d-giao-viec-1a">Hôm nay</p>
                        </div> -->
                        <div class="d-giao-viec-2">
                            <div class="row d-giaoviec2">
                                <?
                                foreach ($listJob as $value) {
                                ?>
                                    <div class="d-giao-viec-2a" id="job<?= $value['job_id'] ?>">

                                        <?
                                        if ($value['status'] == 1) {
                                        ?>
                                            <p class="d-giao-viec-2a-1" style="color:#999999">Quá hạn</p>
                                        <?
                                        }
                                        if ($value['status'] == 2) {
                                        ?>
                                            <p class="d-giao-viec-2a-1" style="color:#185DA0">Hoàn Thành</p>
                                        <?
                                        }
                                        if ($value['status'] == 3) {
                                        ?>
                                            <p class="d-giao-viec-2a-1">Đang làm</p>
                                        <?
                                        }
                                        if ($value['status'] == 4) {
                                        ?>
                                            <p class="d-giao-viec-2a-1" style="color:#185DA0">Dự kiến</p>
                                        <?
                                        }
                                        ?>
                                        <div class="l_icon_gv l_curson l_click"></div>
                                        <div class="l_action">
                                            <div><a href="<?= urlCapNhatCongViec(); ?>?id_job=<?= $value['job_id'] ?>" id="" class="l_update_job l_curson">Cập nhật</a></div>
                                            <div>
                                                <div class="l_curson" onclick="l_deleteJob(<?= $value['job_id'] ?>)">Xóa</div>
                                            </div>
                                        </div>
                                        <p class="d-giao-viec-2a-1" style="color:#185DA0;display:none;">Hoàn thành</p>
                                        <p class="d-giao-viec-2a-1" style="color:#999999;display:none;">Hủy</p>
                                        <a href="<?= urlChiTietCongViec(); ?>?jobId=<?= $value['job_id'] ?>" class="d-giao-viec-2a-2"><?= $value['job_name'] ?></a>
                                        <p class="d-giao-viec-2a-3"><?= $value['job_address'] ?>, <?= $value['cit_name'] ?>, <?
                                                                                                                                foreach ($showCity as $valueCit) {
                                                                                                                                    if ($valueCit['cit_id'] == $value['job_city']) {
                                                                                                                                        echo $valueCit['cit_name'];
                                                                                                                                    }
                                                                                                                                }
                                                                                                                                ?></p>
                                        <div class="d-giao-viec-2a-4">
                                            <div class="d-giaoviec-2a-4">
                                                <div class="l_margin_img">
                                                    <?
                                                    $i = 0;
                                                    foreach ($showJobPra[$value['job_id']] as $valuePra) {
                                                        $i++;
                                                    ?>
                                                        <img src="https://chamcong.24hpay.vn/upload/employee/<?= $staff_active[$valuePra['staff_id']]['ep_image']; ?>" alt="name" class="d-lich-map-v5-img" onerror='this.onerror=null;this.src="<? base_url() ?>/images_staff/avatar_default.png";'>
                                                        <?
                                                        if ($i == 3) {
                                                            break;
                                                        }
                                                    }
                                                    if (count($showJobPra[$value['job_id']]) > 3) {
                                                        ?>
                                                        <div class="num_ep">+<?= count($showJobPra[$value['job_id']]) - 3 ?></div>
                                                    <?
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="d-giaoviec-2a-4">
                                                <p class="d-giaoviec-2a-time"><?= date('d-m-Y', $value['job_day_start']) ?> - <?= date('d-m-Y', $value['job_day_end']) ?></p>
                                                <p class="d-giaoviec-2a-time"><?= date('H:i:s', $value['job_time_in']) ?> - <?= date('H:i:s', $value['job_time_out']) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-qly-cham-cong2">
                    <div class="phan-trang"><?= $links; ?></div>
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
                <form class="d-modal-boloc" onsubmit="timkiem(); return false;">
                    <div class="d-modal-boloc1">
                        <select name="cty" onchange="showdepartment()" id="cty" class="d-chi-nhanh">
                            <option value="">Chọn công ty</option>
                            <?
                            foreach ($detail_company_small as $value) {
                            ?>
                                <option value="<?= $value->com_id ?>"><?= $value->com_name ?></option>
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
                    <div class="d-modal-boloc2">
                        <button type="button" class="d-modal-boloc-huy" data-dismiss="modal" aria-hidden="true">Hủy</button>
                        <button type="submit" onclick="timkiem(); return false;" class="d-modal-boloc-tk">Tìm kiếm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <? include(APPPATH . 'views/includes/inc_footer.php') ?>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/Chart.min.js"></script>
    <script src="<?= base_url() ?>assets/js/cty/giao_viec.js"></script>

</body>

</html>