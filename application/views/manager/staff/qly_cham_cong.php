<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí chấm công nhân viên</title>

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
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
        #link-2 {
            color: #206AA9;
        }

        #dateStart,
        #dateEnd {
            width: 100%;
            height: 45px;
            background: #FFFFFF;
            border: 1px solid #E0E0E0;
            box-sizing: border-box;
            border-radius: 10px;
            padding-left: 15px;
        }

        #right_table {
            width: 150%;
            max-width: unset;
        }

        .q-right-table-chamcong {
            border-radius: 20px;
        }

        .l_custom_btn_search {
            width: 118px;
            height: 45px;
            background: #206AA9;
            border-radius: 5px;
            border: none;
            color: white;
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
                <div class="q-right q-chamcong-right" id="right_chamcong">
                    <div class="q-right-title">
                        <span>Quản Lí Chấm Công</span>
                    </div>
                    <div class="q-right-contain">
                        <div class="q-right-search">
                            <form action="" class="q-right-search-form" onsubmit="timkiem(); return false;">
                                <!-- <img src="<?= base_url() ?>assets/images/Search.png" alt="category" id="search-key-img"> -->
                                <!-- <input type="text" name="" id="search_key" class="q-search-input" placeholder="Nhập từ khóa"> -->
                                <div class="" id="search_date_1">
                                    <input type="date" name="" value="<?= $date_start ?>" id="dateStart" class="q-search-input">
                                </div>
                                <div class="" id="search_date_2">
                                    <input type="date" name="" value="<?= $date_end ?>" id="dateEnd" class="q-search-input">
                                </div>
                                <div class="" id="search_date_2">
                                    <button type="button" class="l_custom_btn_search" onclick="timkiem(); return false;">Tìm kiếm</button>
                                </div>
                            </form>
                        </div>
                        <button class="q-right-excel-chamcong"><span>Xuất Excel</span></button>
                        <div class="table-responsive q-right-table-chamcong">
                            <table class="table" id="right_table">
                                <thead>
                                    <tr class="table_title" id="table_title">
                                        <th><span>Thông tin nhân viên ( ID )</span></th>
                                        <th><span>Ca làm việc</span></th>
                                        <th><span>Thời gian điểm danh</span></th>
                                        <th><span>Địa chỉ</span></th>
                                        <th><span>Ghi chú</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    foreach ($arr_sheet as $key => $value) { ?>
                                        <tr class="q-chamcong-tr" id="chamcong_td">
                                            <td class="q-chamcong-td">
                                                <div>
                                                    <img src="https://chamcong.24hpay.vn/image/time_keeping/<?= $value->ts_image ?>" onerror='this.onerror=null;this.src="<? base_url() ?>/images_staff/avatar_default.png";' alt="avatar" class="q-chamcong-td-img">
                                                </div>
                                                <div class="table-info">
                                                    <div class="table-info-name">
                                                        <span>(<?= $value->ep_id ?>)</span>
                                                        <span> <?= $value->ep_name ?></span>
                                                    </div>
                                                    <div class="table-info-lever">
                                                        Nhân viên (<?= $_SESSION['staff']['dep_name'] ?>)
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="table-time"><?= $value->shift_name; ?></span></td>
                                            <td><span class="table-time"><?= $value->at_time; ?></span></td>
                                            <td><span class="table-time"><?= $value->ts_location_name; ?></span></td>
                                            <td><span class="table-time"><?= ($value->is_success == 1) ? $value->note : $value->ts_error ?></span></td>
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
    <script>
        function timkiem() {
            var date_start = $('#dateStart').val();
            var date_end = $('#dateEnd').val();
            if (date_start == '') {
                date_start = date_end;
            }

            if (date_end == '') {
                date_end = date_start;
            }

            if (date_start != "" && date_end != "") {
                window.location.href = "/quan-ly-cham-cong-nhan-vien.html?date_start=" + date_start + "&date_end=" + date_end;
            } else {
                window.location.href = "/quan-ly-cham-cong-nhan-vien.html";
            }
        }
    </script>
</body>

</html>