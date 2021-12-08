<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch làm việc của nhân viên</title>

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/quan_ly_cty.css">
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

        .llv_nv,
        .ql_cong {
            color: #206AA9;
        }

        .btn_search {
            margin-left: 15px;
            margin-top: 0;
        }

        @media only screen and (max-width: 768px) {
            .d-ds-cty-con2 {
                padding-bottom: 0;
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
                <h3 class="d-qly-cham-cong">Lịch làm việc của nhân viên</h3>
                <div id="alert"></div>
                <div class="d-qly-cham-cong1">
                    <div class="d-ds-cty-con">
                        <div class="row">
                            <form action="" onsubmit="timkiem(); return false;">
                                <div class="col-md-4 col-sm-12 col-xs-12 d-ds-cty-con1 l_margin_bottom_select2">
                                    <input type="text" class="d-ds-cty-input" id="keyWord" placeholder="Nhập từ khóa">
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12 d-ds-cty-con2 l_margin_bottom_select2">
                                    <select name="month" id="id_calendar" class="d-chi-nhanh chi_nhanh">
                                        <option value="">Chọn lịch làm việc đang có</option>
                                        <?
                                        foreach ($listMonth as $cv) {
                                        ?>
                                            <option value="<?= $cv['id'] ?>"><?= $cv['name_calendar'] ?></option>
                                        <?
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div>
                                    <button class="btn_search" type="button" onclick="timkiem(); return false;">tìm kiếm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="d-qly-cham-cong1-v3">
                        <div class="d-qly-nhan-vien1">
                            <div class="d-ds-nv1 active">
                                <table class="d-table-nhan-vien">
                                    <thead>
                                        <tr class="d-table-nv-tr">
                                            <th class="d-table-th d-tb-nv-th1">Thông tin nhân viên ( ID )</th>
                                            <th class="d-table-th">Lịch làm việc đang theo</th>
                                            <th class="d-table-th d-hover-th"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?
                                        $id = 0;
                                        foreach ($listCalendarStaff as $value) {
                                        ?>
                                            <tr class="d-table-nv-tr1" id="calendarStaff<?= $value['staff_id']; ?><?= $value['id']; ?>">
                                                <td class="d-table-td">
                                                    <div class="d-info-nv">
                                                        <img src="<?= $value['avatar'] ?>" onerror='this.onerror=null;this.src="<? base_url() ?>/images_staff/avatar_default.png";' alt="name_nv" class="d-info-img">
                                                        <div class="d-cham-cong-td1a">
                                                            <p class="d-cham-cong-p">(<?= $value['staff_id']; ?>) <?= $value['name_staff']; ?></p>
                                                            <p class="d-cham-cong-p1">Nhân viên
                                                                <?
                                                                $count = 0;
                                                                foreach ($phongban as $dep) {
                                                                    if ($dep['id_department'] == $value['department']) {
                                                                        echo $dep['name_department'];
                                                                        $count++;
                                                                    }
                                                                }
                                                                if ($count == 0) {
                                                                    echo 'chưa xác định';
                                                                }
                                                                ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="d-table-td">
                                                    <p class="d-email-nv"><?= $value['name_calendar'] ?></p>
                                                </td>
                                                <td class="d-table-td">
                                                    <div class="l_flex">
                                                        <div data-toggle="modal" onclick="show_idStaff(<?= $value['staff_id']; ?>,<?= $value['id']; ?>)" data-target="#sua_llv" class="d-update-nv">Sửa</div>
                                                        <div class="d-delete-nv" onclick="delete_idStaff(<?= $value['staff_id']; ?>,<?= $value['id']; ?>)">Xóa</div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?
                                            $id++;
                                        }
                                        ?>

                                    </tbody>
                                </table>
                                <?
                                $id = 0;
                                foreach ($listCalendarStaff as $value) {
                                ?>
                                    <div class="d-ds-nv-mobile" id="calendarStaffMb<?= $value['staff_id']; ?><?= $value['id']; ?>">
                                        <div class="d-info-nv">
                                            <img src="<?= $value['avatar'] ?>" onerror='this.onerror=null;this.src="<? base_url() ?>/images_staff/avatar_default.png";' alt="name_nv" class="d-info-img">
                                            <div class="d-cham-cong-td1a">
                                                <p class="d-cham-cong-p">(<?= $value['staff_id']; ?>) <?= $value['name_staff']; ?></p>
                                                <p class="d-cham-cong-p1">Nhân viên
                                                    <?
                                                    $count = 0;
                                                    foreach ($phongban as $dep) {
                                                        if ($dep['id_department'] == $value['department']) {
                                                            echo $dep['name_department'];
                                                            $count++;
                                                        }
                                                    }
                                                    if ($count == 0) {
                                                        echo 'chưa xác định';
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-email-nv-mobie">
                                            <p class="d-ds-nv-co-lich">Lịch làm việc tháng <?= date('m-Y', $value['month']) ?></p>
                                        </div>
                                        <div class="d-email-nv1-mobie">
                                            <p class="d-icon-them"></p>
                                            <div class="dropdown-content">
                                                <div class="d-edit-nv">
                                                    <div data-toggle="modal" onclick="show_idStaff(<?= $value['staff_id']; ?>,<?= $value['id']; ?>)" data-target="#sua_llv" class="d-update-nv">Sửa</div>
                                                    <div class="d-delete-nv" onclick="delete_idStaff(<?= $value['staff_id']; ?>,<?= $value['id']; ?>)">Xóa</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?
                                    $id++;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="phan-trang">
                    <?= $links; ?>
                </div>

            </div>
        </div>

        <!-- sửa ca làm việc -->
        <div class="modal fade" id="sua_llv">
            <div class="modal-dialog d-them-cty">
                <div class="modal-content d-modal-bo-loc1">
                    <div class="modal-header d-modal-bo-loc2">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <img src="<?= base_url() ?>assets/images/exit.svg" alt="exit" class="follow-map-img">
                        </button>
                        <h4 class="modal-title d-boloc-p">Sửa lịch làm việc</h4>
                    </div>
                    <form method="post" class="d-form-them-cty" id="sua_llv">
                        <div class="d-fomr-them-cty1">
                            <input type="hidden" name="" id="staff_id">
                            <input type="hidden" name="" id="calendar_id">
                            <select name="chon_llv" id="chon_llv" class="d-llv-nv">
                                <option value="">Chọn lịch làm việc đang có</option>
                                <?
                                foreach ($listMonth as $value) {
                                ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['name_calendar']; ?></option>
                                <?
                                }
                                ?>
                            </select>
                            <div class="error" id="err_llv"></div>
                        </div>
                        <div class="d-button-them-cty">
                            <button type="reset" class="d-them-cty-reset" data-dismiss="modal" aria-hidden="true">Hủy</button>
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
    <script>
        var base_url = '';
        $(document).ready(function() {
            $("#chon_llv,#id_calendar").select2({
                width: '100%',
                placeholder: "Chọn lịch làm việc đang có",

            });
            $("#sua_llv").submit(function() {
                var form_oke = true;
                var form_data = new FormData();
                var arr_id_to_focus = [];
                var chon_llv = $.trim($("#chon_llv").val());
                var staff_id = $('#staff_id').val();
                var calendar_id = $('#calendar_id').val();
                if (chon_llv == "" || chon_llv == null) {
                    $("#err_llv").html("Bạn chưa chọn lịch làm việc");
                    arr_id_to_focus.push("chon_llv");
                    form_oke = false;
                } else {
                    $("#err_llv").html("");
                    form_data.append("lich_moi", chon_llv);
                }
                form_data.append("staff_id", staff_id);
                form_data.append("lich_cu", calendar_id);
                $(arr_id_to_focus[0]).focus();
                if (form_oke == true) {
                    $.ajax({
                        type: 'post',
                        url: base_url + "/company/Company_controller/updateStaffToCalendar",
                        async: false,
                        dataType: "JSON",
                        contentType: false,
                        processData: false,
                        data: form_data,
                        success: function(response) {
                            if (response.result == true) {
                                $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                                setTimeout(function() {
                                    $(".alert-success").fadeOut(1000, function() {
                                        location.reload();
                                    });
                                }, 1000);
                            } else {
                                $("#alert").append('<div class="alert-success_error">' + response.message + '</div>');
                                setTimeout(function() {
                                    $(".alert-success_error").fadeOut(1000, function() {});
                                }, 1500);
                            }
                        },

                    });
                }
                return false;
            });
        });

        function show_idStaff(id_staff, id_calendar) {
            $('#staff_id').val(id_staff);
            $('#calendar_id').val(id_calendar);
        }

        function delete_idStaff(id_staff, id_calendar) {
            var data = new FormData();
            data.append('id_staff', id_staff)
            data.append('id_calendar', id_calendar)
            $.ajax({
                type: 'post',
                url: base_url + "/company/Company_controller/deleteStaffToCalendar",
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
                        $('#calendarStaff' + id_staff + id_calendar).css('display', 'none');
                        $('#calendarStaffMb' + id_staff + id_calendar).css('display', 'none');
                    } else {
                        $("#alert").append('<div class="alert-success_error">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success_error").fadeOut(1000, function() {});
                        }, 1500);
                    }
                },

            });
        }

        function timkiem() {
            var keyWord = $('#keyWord').val();
            var id_calendar = $('#id_calendar').val();
            if (keyWord != '' && id_calendar != '') {
                window.location.href = base_url + '/lich-lam-viec-cua-nhan-vien.html?keyWord=' + keyWord + '&id_calendar=' + id_calendar;
            } else if (keyWord != '' && id_calendar == '') {
                window.location.href = base_url + '/lich-lam-viec-cua-nhan-vien.html?keyWord=' + keyWord;
            } else if (keyWord == '' && id_calendar != '') {
                window.location.href = base_url + '/lich-lam-viec-cua-nhan-vien.html?id_calendar=' + id_calendar;
            } else {
                window.location.href = base_url + '/lich-lam-viec-cua-nhan-vien.html';
            }
        }
    </script>
</body>

</html>