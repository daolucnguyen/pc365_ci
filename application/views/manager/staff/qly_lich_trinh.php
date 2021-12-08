<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch trình nhân viên</title>

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
        #link-3 {
            color: #206AA9;
        }

        .table-th-first {
            border-bottom: none;
            border-top: none;
        }

        .l_th {
            width: 55px;
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
                <div class="q-right" id="right_lichtrinh">
                    <div class="q-right-title" id="right_title_lichtrinh">
                        <span>Lịch Trình Của Tôi</span>
                    </div>
                    <div id="alert"></div>
                    <div class="q-right-contain-lichtrinh" id="q_right_contain">
                        <div class="q-right-search">
                            <form action="" class="q-right-search-form" onsubmit="timkiem(); return false;">
                                <div class="q-right-search-div q-lichtrinh-search-div">
                                    <!-- <img src="<?= base_url() ?>assets/images/Search.png" alt="category" id="search-key-img"> -->
                                    <input type="text" name="" id="lichtrinh_search" class="q-search-input" placeholder="Nhập từ khóa">
                                </div>
                                <div class="q-right-search-form-div">
                                    <div class="q-search-input-div" id="search_input_left">
                                        <input type="date" name="" class="q-search-input-lichtrinh" id="date_start">
                                        <!-- <img src="<?= base_url() ?>assets/images/Calendar.png" alt="caledar" class="q-search-date" id="img_date_begin"> -->
                                    </div>
                                    <div class="q-search-input-div" id="search_input_right">
                                        <input type="date" name="" class="q-search-input-lichtrinh" id="date_end">
                                        <!-- <img src="<?= base_url() ?>assets/images/Calendar.png" alt="caledar" class="q-search-date" id="img_date_end"> -->
                                    </div>
                                </div>
                                <div class="l_flex l_width_full l_margin_search_mb">
                                    <div class="l_srarch_lich_trinh">
                                        <div class="q-select-lichtrinh">
                                            <select class="q-right-select2 q-search-input" name="" id="status">
                                                <option class="q-right-select2-choice" value="">Chọn trạng thái</option>
                                                <option class="q-right-select2-choice" value="1">Quá hạn</option>
                                                <option class="q-right-select2-choice" value="2">Đã làm</option>
                                                <option class="q-right-select2-choice" value="3">Đang làm</option>
                                                <option class="q-right-select2-choice" value="4">Dự kiến</option>
                                            </select>
                                            <!-- <button class="q-right-create-lichtrinh"><span>+ Tạo Lịch Trình</span></button> -->
                                        </div>
                                    </div>
                                    <div class="q-right-search-div l_margin_btn">
                                        <button type="button" class="q-right-excel-lichtrinh l_margin_btn" onclick="timkiem(); return false;"><span>Tìm kiếm</span></button>
                                    </div>
                                    <div class="q-right-search-div">
                                        <button class="q-right-excel-lichtrinh"><span>Xuất Excel</span></button>
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
                                                <button type="button" class="close" id="modal_button_header" data-dismiss="modal">
                                                    <img src="<?= base_url() ?>assets/images/x.png" alt="x" class="q-modal-button-img">
                                                </button>
                                            </div>
                                            <div class="modal-body q-modal-body">
                                                <form action="" class="q-modal-form" onsubmit="timkiem(); return false;">
                                                    <div class="q-modal-input-div">
                                                        <input type="date" name="" id="modal_date_start" class="q-search-input" placeholder="Từ ngày">
                                                        <!-- <img src="<?= base_url() ?>assets/images/Calendar.png" alt="caledar" class="q-search-date" id="modal_search_date_1"> -->
                                                    </div>
                                                    <div class="q-modal-input-div">
                                                        <input type="date" name="" id="modal_date_end" class="q-search-input" placeholder="Đến ngày">
                                                        <!-- <img src="<?= base_url() ?>assets/images/Calendar.png" alt="caledar" class="q-search-date" id="modal_search_date_2"> -->
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
                                                        <button type="submit" name="modal-submit" onclick="timkiem(); return false;" class="q-moadal-lichtrinh-submit"><span>Tìm Kiếm</span></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="q-right-table-lichtrinh">
                            <table class="table" id="right_table">
                                <thead class="lichtrinh_thead">
                                    <tr class="q-lichtrinh-tr table_title">
                                        <th class="table-th-first "><span>Thông tin nhân viên ( ID )</span></th>
                                        <th class="table-th-first"><span>Tên lịch trình</span></span></th>
                                        <th class="table-th-sm">
                                            <div class="table-time">
                                                <span>Ngày tháng</span>
                                            </div>
                                        </th>
                                        <th class="table-th-sm">
                                            <div class="table-time">
                                                <span>Ghi chú</span>
                                            </div>
                                        </th>
                                        <th class="table-th-sm">
                                            <div class="table-time">
                                                <span>Trạng thái</span>
                                            </div>
                                        </th>

                                        <th class="table-th-sm l_th">
                                            <div class="table-time">
                                                <span></span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    foreach ($listPageSchedule as $value) {
                                    ?>
                                        <tr class="q-lichtrinh-tr" id="lichtrinh<?= $value['id'] ?>">
                                            <td class="table-row q-chamcong-td q-lichtrinh-td table_td" id="table_td1">
                                                <div class="l_avatar_lich_trinh">
                                                    <!-- <img src="<?= base_url() ?>assets/images/Delete.png" alt="avatar" class="q-chamcong-td-img" /> -->
                                                    <img src="<?= $_SESSION['staff']['avatar'] ?>" alt="avatar" class="q-chamcong-td-img" id="staff_avatar" onerror='this.onerror=null;this.src="<?= base_url() ?>assets/images/staff.svg";'>
                                                </div>
                                                <div class="table-info">
                                                    <div class="table-info-name">
                                                        <span>(<?= $value['staff_id'] ?>)</span>
                                                        <span><?= $show_info['name'] ?></span>
                                                    </div>
                                                    <div class="table-info-lever">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="table_td q-lichtrinh-td" id="table_td2"><span class="table-ten-lichtrinh"><?= $value['name'] ?></span></td>
                                            <td class="table_td q-lichtrinh-td" id="table_td3">
                                                <div class="table-time">
                                                    <span><?= date('d-m-Y', $value['date_start']) ?> - <?= date('d-m-Y', $value['date_end']) ?></span>
                                                </div>
                                            </td>
                                            <td class="table_td q-lichtrinh-td" id="table_td4">
                                                <div class="table-time">
                                                    <span><?= $value['note'] ?></span>
                                                </div>
                                            </td>
                                            <td class="table_td q-lichtrinh-td" id="table_td5">
                                                <div class="table-time">
                                                    <!-- <span class="table-status">Hoàn thành</span> -->

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
                                            </td>
                                            <td class="table_td q-lichtrinh-td" id="table_td5">
                                                <div class="table-time">
                                                    <div class="q-table-option">
                                                        <button class="q-table-status l_click_option" id="status_td_1">
                                                            <div class="q-table-status-dot"></div>
                                                            <div class="q-table-status-dot"></div>
                                                            <div class="q-table-status-dot"></div>
                                                        </button>
                                                    </div>
                                                    <div class="q-table-status-link l_show_option" id="status_link_1">
                                                        <!-- <p class="q-table-status-choice"><span class="choice-after">Sửa</span></p>
                                                        <p class="q-table-status-choice"><span class="choice-after">Xóa</span></p> -->
                                                        <a href="<?= urlLichTrinhMap(); ?>" class="q-table-status-choice"><span>Theo dõi</span></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="q-pagin">
                    <?= $links ?>
                </div>
            </div>
        </div>
    </div>
    <? include(APPPATH . '/views/includes/inc_footer.php') ?>
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script>
        var base_url = 'http://chamcong.timviec365.com';
        $(document).ready(function() {
            $('.q-right-select2').select2({
                placeholder: "Chọn trạng thái",
                width: "100%",
            });
            $(".l_click_option").click(function() {
                $(this).parent('.q-table-option').next(".l_show_option").toggle();
            });
        });
        $(document).mouseup(function(e) {
            var container = $(".l_show_option");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container.hide(100);
            }
        });

        function timkiem() {
            var key = $('#lichtrinh_search').val();
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

            // console.log(check_status);
            // return false;
            if (key != "" && day_start != "" && day_end != "" && check_status != "") {
                window.location.href = base_url + "/quan-ly-lich-trinh-nhan-vien.html?key=" + key + "&date_start=" + day_start + "&date_end=" + day_end + "&status=" + check_status;
            } else if (key != "" && day_start != "" && day_end != "" && check_status == "") {
                window.location.href = base_url + "/quan-ly-lich-trinh-nhan-vien.html?key=" + key + "&date_start=" + day_start + "&date_end=" + day_end;
            } else if (key != "" && day_start == "" && day_end == "" && check_status != "") {
                window.location.href = base_url + "/quan-ly-lich-trinh-nhan-vien.html?key=" + key + "&status=" + check_status;
            } else if (key == "" && day_start != "" && day_end != "" && check_status != "") {
                window.location.href = base_url + "/quan-ly-lich-trinh-nhan-vien.html?date_start=" + day_start + "&date_end=" + day_end + "&status=" + check_status;
            } else if (key == "" && day_start != "" && day_end != "" && check_status == "") {
                window.location.href = base_url + "/quan-ly-lich-trinh-nhan-vien.html?date_start=" + day_start + "&date_end=" + day_end;
            } else if (key == "" && day_start == "" && day_end == "" && check_status != "") {
                window.location.href = base_url + "/quan-ly-lich-trinh-nhan-vien.html?status=" + check_status;
            } else if (key != "" && day_start == "" && day_end == "" && check_status == "") {
                window.location.href = base_url + "/quan-ly-lich-trinh-nhan-vien.html?key=" + key;
            } else {
                window.location.href = base_url + "/quan-ly-lich-trinh-nhan-vien.html";
            }
        }
    </script>
</body>

</html>