<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý chung nhân viên</title>

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style_re.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/menu.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/menu-header.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/nv_qly.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/notify.css">
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-125014721-1');
    </script>

    <style>
        #link-1 {
            color: #206AA9;
        }

        .q-list-item-count {
            margin-top: 13px;
            width: 85px;
            height: 35px;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div class="q-contain">
        <div class="row q-contain-row">
            <div class="col-lg-3 col-md-3 q-contain-left">
                <? include(APPPATH . '/views/includes/nv_menu_qly.php') ?>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 q-contain-right">
                <? include(APPPATH . '/views/includes/nv_menu_header.php') ?>
                <div class="q-right-qly" id="right_qlychung">
                    <div id="alert"></div>
                    <div class="q-right-time">
                        <span>Hôm nay, ngày <? echo date('d/m/Y', time()) ?></span>
                    </div>
                    <div class="q-rigth-control">
                        <div class="q-right-list" id="right_list_chamcong">
                            <a href="<?= urlQlyChamCong(); ?>">
                                <img src="<?= base_url() ?>assets/images/right-chamcong.png" alt="chamcong" class="q-right-list-img">
                                <p class="q-right-list-text">Chấm Công</p>
                                <div class="q-right-list-count q-right-list-color-1" id="right-list-active"><span><?= $count_sheet; ?> Lần</span></div>
                            </a>
                        </div>
                        <div class="q-right-list" id="right_list_work">
                            <a href="<?= urlQlyNhanViec(); ?>">
                                <img src="<?= base_url() ?>assets/images/right-work.png" alt="congviec" class="q-right-list-img">
                                <p class="q-right-list-text">Giao Việc</p>
                                <div class="q-right-list-count q-right-list-color-2" id="right-list-work"><span><?= $count_job_day; ?> Công Việc</span></div>
                            </a>
                        </div>
                        <div class="q-right-list" id="right_list_lichtrinh">
                            <a href="<?= urlQlyLichTrinh(); ?>">
                                <img src="<?= base_url() ?>assets/images/right-lichtrinh.png" alt="lichtrinh" class="q-right-list-img">
                                <p class="q-right-list-text">Lịch Trình</p>
                                <div class="q-right-list-count q-right-list-color-3" id="right-list-lichtrinh"><span><?= $count_schedule_day ?> Lịch Trình</span></div>
                            </a>
                        </div>
                    </div>
                    <div class="q-right-details-chamcong">
                        <div class="row q-qly-chung">
                            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 q-right-details-left">
                                <span class="q-right-details-title">Số Lần Chấm Công Trong Tuần</span>
                                <div class="q-right-details-desc">
                                    <div>
                                        <canvas id="myChart" class="my-chart"></canvas>
                                    </div>
                                    <!-- <div class="q-right-details-footer">
                                        <div class="q-right-details-note">
                                            <img src="<?= base_url() ?>assets/images/dunggio.png" alt="note">
                                            <span>Chấm công đúng giờ</span>
                                        </div>
                                        <div class="q-right-details-note">
                                            <img src="<?= base_url() ?>assets/images/saigio.png" alt="note">
                                            <span>Đi muộn/ Về sớm</span>
                                        </div>
                                        <div class="q-right-details-note">
                                            <img src="<?= base_url() ?>assets/images/khong.png" alt="note">
                                            <span>Không chấm công</span>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 q-right-details-right">
                                <span class="q-right-details-title" id="q_title_2">Công Việc Ngày Hôm Nay</span>
                                <div class="q-right-details-list">
                                    <?
                                    $i = 0;
                                    foreach ($list_job_today as $value) {
                                        $i++;
                                    ?>
                                        <div class="q-right-details-list-item">
                                            <div class="q-list-item-title"><a href="<?= urlChiTietCongViecnv(); ?>?job_id=<?= $value['job_id'] ?>"><?= $value['job_name'] ?></a></div>
                                            <span class="q-list-item-address"><?= $value['job_address'] ?>, <?= $value['cit_name'] ?></span>
                                            <div class="q-list-item-count">
                                                <?
                                                $j = 0;
                                                foreach ($showJobPra as $valuePra) {

                                                    if ($valuePra['job_id'] == $value['job_id']) {

                                                        foreach ($arr_staff as $key => $value_arr_staff) {
                                                            if ($valuePra['staff_id'] == $value_arr_staff['ep_id']) {
                                                ?>
                                                                <img src="<?= $value_arr_staff['avatar']; ?>" alt="name" class="d-lich-map-v5-img" onerror='this.onerror=null;this.src="<? base_url() ?>/images_staff/avatar_default.png";'>
                                                <?
                                                            }
                                                        }
                                                    }
                                                    $j++;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    <?
                                        if ($i == 2) {
                                            break;
                                        }
                                    }
                                    ?>
                                    <?
                                    if (count($list_job_today) > 0) {
                                    ?>
                                        <a href="<?= urlQlyNhanViec() ?>" class="q-right-more">Xem Thêm</a>
                                    <?
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <? include(APPPATH . '/views/includes/inc_footer.php') ?>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/Chart.min.js"></script>
    <script src="<?= base_url() ?>assets/js/validate_nv/qly_nv.js"></script>
</body>

</html>