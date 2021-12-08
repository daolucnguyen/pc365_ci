<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhận việc</title>

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style_re.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/menu.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/menu-header.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/nv_qly.css">
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-125014721-1');
    </script>
    <style>
        #link-4 {
            color: #206AA9;
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
                <div class="q-right" id="right_nhanviec">
                    <div class="q-right-title" id="right_title">
                        <p>Nhận việc</p>
                    </div>
                    <div class="q-right-contain-nhanviec" id="q_right_contain">
                        <div class="q-right-search">
                            <form action="" class="q-right-search-form" onsubmit="timkiem(); return false;">
                                <!-- <img src="<?= base_url() ?>assets/images/Search.png" alt="category" id="search-key-img"> -->

                                <input type="text" name="" id="right_search_key" value="<?= $key1 ?>" class="q-search-input" placeholder="Nhập từ khóa">
                                <div class="q-right-search-form-div">
                                    <div class="q-search-input-div" id="search_input_left">
                                        <input type="date" name="" value="<?
                                                                            if ($date_start != '') {
                                                                                echo date('Y-m-d', $date_start);
                                                                            }
                                                                            ?>" class="q-search-input-lichtrinh" id="date_start" placeholder="Từ ngày">
                                    </div>
                                    <div class="q-search-input-div" id="search_input_right">
                                        <input type="date" name="" value="<?
                                                                            if ($date_end != '') {
                                                                                echo date('Y-m-d', $date_end);
                                                                            }
                                                                            ?>" class="q-search-input-lichtrinh" id="date_end" placeholder="Đến ngày">
                                    </div>
                                </div>
                                <div class="l_flex l_khoangcach">
                                    <div class="select-nhanviec">
                                        <select class="q-right-select2 q-search-input" name="" id="status">
                                            <option class="q-right-select2-choice" value="">Chọn trạng thái</option>
                                            <option class="q-right-select2-choice" value="1">Quá hạn</option>
                                            <option class="q-right-select2-choice" value="2">Đã làm</option>
                                            <option class="q-right-select2-choice" value="3">Đang làm</option>
                                            <option class="q-right-select2-choice" value="4">Dự kiến</option>
                                        </select>
                                    </div>
                                    <div class="l_margin_search">
                                        <button type="button" class="q-right-search-lichtrinh l_margin_btn" onclick="timkiem(); return false;"><span>Tìm kiếm</span></button>
                                    </div>
                                    <div class="l_margin_search">
                                        <button class="q-excel-nhanviec"><span>Xuất Excel</span></button>
                                    </div>
                                </div>
                                <button type="button" class="q-modal-button" data-toggle="modal" data-target="#myModal">
                                    <img src="<?= base_url() ?>assets/images/Filter 2.png" alt="filter">
                                    <span>Lọc Tìm Kiếm</span>
                                </button>
                            </form>
                            <div class="q-modal-lichtrinh">
                                <div id="myModal" class="modal fade q-modal-div" role="dialog">
                                    <div class="modal-dialog q-modal-div">
                                        <div class="modal-content q-modal-content">
                                            <div class="modal-header q-modal-header">
                                                <p class="q-modal-header-title">Lọc Tìm Kiếm</p>
                                                <button type="button" class="close" data-dismiss="modal" id="modal_button_header">
                                                    <img src="<?= base_url() ?>assets/images/x.png" alt="x" class="q-modal-button-img">
                                                </button>
                                            </div>
                                            <div class="modal-body q-modal-body">
                                                <form action="" class="q-modal-form">
                                                    <div class="q-modal-input-div">
                                                        <input type="date" name="" id="modal_date_start" class="q-search-input" placeholder="Từ ngày">
                                                    </div>
                                                    <div class="q-modal-input-div">
                                                        <input type="date" name="" id="modal_date_end" class="q-search-input" placeholder="Đến ngày">
                                                    </div>
                                                    <select class="q-right-select2 q-search-input" name="" id="modal_status">
                                                        <option class="q-right-select2-choice" value="">Chọn trạng thái</option>
                                                        <option class="q-right-select2-choice" value="1">Đã hủy</option>
                                                        <option class="q-right-select2-choice" value="2">Đã làm</option>
                                                        <option class="q-right-select2-choice" value="3">Đang làm</option>
                                                        <option class="q-right-select2-choice" value="4">Dự kiến</option>
                                                    </select>
                                                    <div class="q-modal-lichtrinh-button">
                                                        <button type="button" class="btn btn-default q-modal-lichtrinh-button-close" data-dismiss="modal">Hủy</button>
                                                        <button type="submit" name="modal-submit" class="q-moadal-lichtrinh-submit"><span>Tìm Kiếm</span></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="q-right-nhanviec">
                            <?
                            foreach ($list as $value) {
                            ?>
                                <div class="q-right-work">
                                    <div class="q-right-work-status q-work-danglam">
                                        <div class="q-work-status-dot q-work-danglam-dot"></div>
                                        <?
                                        if ($value['status'] == 2) {
                                        ?>
                                            <p class="table-status" style="color:#1F3F77;padding:0 6px;background: #EEF5FC;border-radius: 5px;">Hoàn thành</p>
                                        <?
                                        }
                                        if ($value['status'] == 3) {
                                        ?>
                                            <p class="table-status" style="color: #F79722;padding:0 6px;background: rgba(247, 151, 34, 0.1);border-radius: 5px;">Đang làm</p>
                                        <?
                                        }
                                        if ($value['status'] == 1) {
                                        ?>
                                            <p class="table-status" style="color:#B31217;padding:0 6px;background: rgba(179, 18, 23, 0.1);border-radius: 5px;">Quá hạn</p>
                                        <?
                                        }
                                        if ($value['status'] == 4) {
                                        ?>
                                            <p class="table-status" style="color:#1F3F77;padding:0 6px;background: #EEF5FC;border-radius: 5px;">Dự kiến</p>
                                        <?
                                        }
                                        ?>
                                    </div>
                                    <div class="q-right-work-title">
                                        <a href="<?= urlChiTietCongViecnv(); ?>?job_id=<?= $value['job_id'] ?>" class="q-right-work-title-v2"><?= $value['job_name'] ?></a>
                                    </div>
                                    <div class="q-right-work-address">
                                        <p class="q-right-work-address-v2"><?= $value['job_address'] ?></p>
                                    </div>
                                    <div class="q-right-work-avatar">
                                        <?
                                        $i = 0;
                                        foreach ($showJobPra as $valuePra) {

                                            if ($valuePra['job_id'] == $value['job_id']) {
                                                foreach ($arr_staff as $key => $value_staff) {

                                                    if ($valuePra['staff_id'] == $value_staff['ep_id']) {

                                        ?>
                                                        <img src="<?= $value_staff['avatar']; ?>" alt="name" class="d-lich-map-v5-img" onerror='this.onerror=null;this.src="<? base_url() ?>/images_staff/avatar_default.png";'>
                                        <?
                                                    }
                                                }
                                            }
                                            $i++;
                                        }
                                        ?>
                                    </div>
                                    <div class="q-right-work-time">
                                        <p class="q-right-work-time-day"><?= date('d/m/Y', $value['job_day_start']) ?> - <?= date('d/m/Y', $value['job_day_end']) ?></p>
                                        <p class="q-right-work-time-hour"><?= date('H:i', $value['job_time_in']) ?> - <?= date('H:i', $value['job_time_out']) ?></p>
                                    </div>
                                </div>
                            <?
                            }
                            ?>

                        </div>
                    </div>
                </div>
                <div class="q-pagin">
                    <?= $links ?>
                </div>
            </div>
        </div>
        <? include(APPPATH . '/views/includes/inc_footer.php') ?>
        <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
        <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
        <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.q-right-select2').select2({
                    placeholder: "Chọn trạng thái",
                    width: "100%",
                });
            });
            var base_url = '';

            function timkiem() {
                var key = $('#right_search_key').val();
                var date_start = $('#date_start').val();
                var date_end = $('#date_end').val();
                var status = $('#status').val();
                var modal_date_start = $('#modal_date_start').val();
                var modal_date_end = $('#modal_date_end').val();
                var modal_status = $('#modal_status').val();
                var day_start = '';
                var day_end = '';
                var check_status = '';

                if (date_start == '' && modal_date_start == '') {
                    day_start = date_end;
                } else if (date_start != '' && modal_date_start == '') {
                    day_start = date_start;
                } else if (date_start == '' && modal_date_start != '') {
                    day_start = modal_date_start;
                } else {
                    day_start = date_start;
                }

                if (date_end == "" && modal_date_end == '') {
                    day_end = date_start;
                } else if (date_end != '' && modal_date_end == '') {
                    day_end = date_end;
                } else if (date_end == '' && modal_date_end != '') {
                    day_end = modal_date_end;
                } else {
                    day_end = date_end;
                }

                if (status != '' && modal_status == '') {
                    check_status = status;
                } else if (status == '' && modal_status != '') {
                    check_status = modal_status;
                } else {
                    check_status = status;
                }

                if (day_start == '') {
                    day_start = day_end;
                }

                if (day_end == '') {
                    day_end = day_start;
                }

                if (key != "" && day_start != "" && day_end != "" && check_status != "") {
                    window.location.href = base_url + "/nhan-viec.html?key=" + key + "&date_start=" + day_start + "&date_end=" + day_end + "&status=" + check_status;
                } else if (key != "" && day_start != "" && day_end != "" && check_status == "") {
                    window.location.href = base_url + "/nhan-viec.html?key=" + key + "&date_start=" + day_start + "&date_end=" + day_end;
                } else if (key != "" && day_start == "" && day_end == "" && check_status != "") {
                    window.location.href = base_url + "/nhan-viec.html?key=" + key + "&status=" + check_status;
                } else if (key == "" && day_start != "" && day_end != "" && check_status != "") {
                    window.location.href = base_url + "/nhan-viec.html?date_start=" + day_start + "&date_end=" + day_end + "&status=" + check_status;
                } else if (key == "" && day_start != "" && day_end != "" && check_status == "") {
                    window.location.href = base_url + "/nhan-viec.html?date_start=" + day_start + "&date_end=" + day_end;
                } else if (key == "" && day_start == "" && day_end == "" && check_status != "") {
                    window.location.href = base_url + "/nhan-viec.html?status=" + check_status;
                } else if (key != "" && day_start == "" && day_end == "" && check_status == "") {
                    window.location.href = base_url + "/nhan-viec.html?key=" + key;
                } else {
                    window.location.href = base_url + "/nhan-viec.html";
                }
            }
        </script>
</body>

</html>