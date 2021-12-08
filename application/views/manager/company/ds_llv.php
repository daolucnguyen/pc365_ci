<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách lịch làm việc</title>

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/quan_ly_cty.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/datepicker.css">
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

        .ds_lichlamviec,
        .ql_cong {
            color: #206AA9;
        }

        .l_absolude {
            position: absolute;
            right: 35px;
            top: 10px;
            display: none;
        }

        .d-ds-cty-input {
            background: none;
        }

        .l_custom_width {
            width: 100%;
            height: 50px;
        }

        .l_hover_llv:hover ul {
            display: block;
            cursor: pointer;
        }

        .d-ds-ca-lam {
            width: 190px;
            border: none;
            outline: none;
        }

        .d-ds-cty-con3-11::before {
            content: unset;
        }

        .d-phong-ban1 .dropdown-menu {
            min-width: 55px;
            top: 34px;
            left: -46px;
        }

        #datepicker {
            width: 180px;
            margin: 0 20px 20px 20px;
        }

        #datepicker>span:hover {
            cursor: pointer;
        }

        .l_flex_calendar {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            width: 100%;
            margin: 0px auto;
        }

        .d-ds-cty-con2a-1 {
            padding: 0;
            position: relative;
            margin-bottom: 30px;
            box-shadow: 0px 4px 15px rgb(32 106 169 / 10%);
            border-radius: 16px;
            width: 30%;
        }

        .d-ds-phong-ban1 {
            box-shadow: unset;
        }

        @media only screen and (max-width:1023.9px) {
            .d-ds-cty-con2 {
                margin-top: 20px;
            }

            .d-ds-cty-con2a-1 {
                width: 48%;
            }

            .d-ds-cty-con3-1::before {
                margin-right: 5px;
            }

            .d-ds-ca-lam {
                width: auto;
            }

            .d-ds-cty-con2 {
                padding-bottom: 0px;
            }

            .d-ds-cty-con3 {
                padding: 20px 20px 0;
            }
        }

        @media only screen and (max-width: 767.9px) {
            .l_absolude {
                display: block;
            }

            .d-ds-cty-con2 {
                width: 100%;
            }
            .d-ds-cty-con2a-1 {
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
            <?php include APPPATH . "/views/includes/header_manager.php"; ?>
            <div class="d-qly-cty1-v1">
                <h3 class="d-qly-cham-cong">Danh sách lịch làm việc</h3>
                <div id="alert"></div>
                <div class="d-ds-cty-con">
                    <div class="row">
                        <form action="" onsubmit="timkiem(); return false;">
                            <div class="col-md-3 col-sm-12 col-xs-12 d-ds-cty-con1">
                                <input type="text" value="<?= $keyWord; ?>" class="d-ds-cty-input" id="keyWord" placeholder="Nhập từ khóa">
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12 d-ds-cty-con2 l_relative">
                                <input type="month" value="<?= $date; ?>" class="d-ds-cty-input l_custom_width" id="date">
                                <label for="date_start" class="l_absolude">
                                    <img src="<?= base_url() ?>assets/images/Calendar.png" alt="date">
                                </label>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12 d-ds-cty-con3">
                                <button type="button" onclick="timkiem(); return false;" class="d-ds-cty-con3-1 d-ds-cty-con3-11 d-ds-ca-lam">Tìm kiếm</button>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12 d-ds-cty-con3">
                                <a href="<?= urlThietLapLichLamViec(); ?>" class="d-ds-cty-con3-1 d-ds-ca-lam">Thêm lịch làm việc</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="d-ds-cty-con2a">
                    <div class="row l_flex_calendar">
                        <?
                        $i = 0;
                        foreach ($show_list_calendar as $value) {
                        ?>
                            <div class="col-md-4 col-sm-6 col-xs-12 d-ds-cty-con2a-1" id="calendar<?= $value['id'] ?>">
                                <div class="d-ds-phong-ban1">
                                    <div>
                                        <a href="<?= urlChiTietLichLamViec(); ?>?id_calendar=<?= $value['id'] ?>" class="d-ds-phong-ban-p"><?= $value['name_calendar']; ?></a>
                                        <p class="d-ds-llv2">
                                            Áp dụng: tháng <?= date('m-Y', $value['month']); ?> ( <?
                                                                                                    if ($value['staff_id'] == '') {
                                                                                                        echo 0;
                                                                                                    } else {
                                                                                                        $explodeStaff = explode(',', $value['staff_id']);
                                                                                                        echo count($explodeStaff);
                                                                                                    } ?> nhân viên đang theo)</p>
                                        <p class="ds-llv1">
                                            <?
                                            ?>
                                        </p>
                                        <div>Ca làm việc: <?
                                                            foreach ($arr_list_shift[$i] as $key => $id_shift) {
                                                                foreach ($list_shift as $shift) {
                                                                    if ($shift['id_shift'] == $id_shift) {
                                                                        echo '<div>+ ' . $shift['name_shift'] . '(' . date('H:i', $shift['time_in']) . '-' . date('H:i', $shift['time_out']) . ')' . '</div>';
                                                                    }
                                                                }
                                                            }
                                                            ?> </div>
                                    </div>
                                    <div class="dropdown d-phong-ban1 l_hover_llv">
                                        <img class="dropdown-toggle d-ds-phong-banv1 l_curson" type="button" src="<?= base_url() ?>assets/images/them.svg">
                                        <ul class="dropdown-menu">
                                            <li><a href="<?= urlSualichLamViec() ?>?calendar_id=<?= $value['id'] ?>" class="d-phong-ban-1 l_curson">Sửa</a></li>
                                            <li>
                                                <div onclick="deleteCalendar(<?= $value['id'] ?>);" class="d-phong-ban-1 l_curson">Xóa</div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?
                            $i++;
                        }
                        ?>
                    </div>

                </div>
                <div class="phan-trang">
                    <?= $links ?>
                </div>

            </div>
        </div>
    </div>
    <? include(APPPATH . '/views/includes/inc_footer.php') ?>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/lazysizes.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap-datepicker.js"></script>

    <script>
        $(function() {
            $("#datepicker").datepicker({
                autoclose: true,
                todayHighlight: true,
                format: "dd/mm/yyyy"
            }).datepicker('update', new Date());
        });

        function deleteCalendar(id_calendar) {
            if (confirm('Bạn có chắc muốn xóa lịch làm việc?')) {
                var data = new FormData();
                data.append('id_calendar', id_calendar);
                $.ajax({
                    type: 'post',
                    url: base_url + "/company/Company_controller/deleteCalendar",
                    async: false,
                    dataType: "JSON",
                    contentType: false,
                    processData: false,
                    data: data,
                    success: function(response) {
                        if (response.result == true) {
                            $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                            setTimeout(function() {
                                $(".alert-success").fadeOut(1000, function() {});
                            }, 1000);
                            $('#calendar' + id_calendar).css('display', 'none');
                        } else {
                            return false;
                        }
                    },
                });
            }
        }

        function timkiem() {
            var keyWord = $('#keyWord').val();
            var date = $('#date').val();
            if (keyWord != '' && date != '') {
                window.location.href = "/danh-sach-lich-lam-viec.html?key=" + keyWord + '&date=' + date;
            } else if (keyWord != '') {
                window.location.href = "/danh-sach-lich-lam-viec.html?key=" + keyWord;
            } else if (date != '') {
                window.location.href = "/danh-sach-lich-lam-viec.html?date=" + date;
            } else {
                window.location.href = "/danh-sach-lich-lam-viec.html";
            }
        }
    </script>
</body>

</html>