<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhân viên đồng lịch trình</title>

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
        .ql_lichtrinh{
        color: #206AA9;
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
                <h3 class="d-qly-cham-cong">Nhân viên đồng lịch trình</h3>
                <div class="d-qly-cham-cong1">
                    <div class="d-qly-cham-cong1-v3">
                        <div class="d-qly-nhan-vien1">
                            <div class="d-ds-nv12 active" id="ds_nhan_vien">
                                <table class="table-hover d-table-lich-trinh">
                                    <thead>
                                        <tr class="d-table-nv-tr ">
                                            <th class="d-table-nv-th d-tb-nv-th1 ">Thông tin nhân viên ( ID )</th>
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
                                            <tr class="d-table-nv-tr1" id="schedule<?= $value['id'] ?><?= $arr_ep[$value['staff_id']]['ep_id'] ?>">
                                                <td class=" d-table-nv-td">
                                                    <div class="d-info-nv">
                                                        <img src="https://chamcong.24hpay.vn/upload/employee/<?= $arr_ep[$value['staff_id']]['ep_image'] ?>" onerror='this.onerror=null;this.src="<? base_url() ?>/images_staff/avatar_default.png";' alt="name_nv" class="d-info-img">
                                                        <div class="d-cham-cong-td1a">
                                                            <p class="d-cham-cong-p">(<?= $arr_ep[$value['staff_id']]['ep_id'] ?>) <?= $arr_ep[$value['staff_id']]['ep_name'] ?></p>
                                                            <p class="d-cham-cong-p1">Nhân viên <?= $arr_ep[$value['staff_id']]['dep_name'] ?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center d-table-nv-td">
                                                    <p class="d-cham-cong-p"><?= $value['name'] ?></p>
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
                                                    <div class="dropdown">
                                                        <img src="<?= base_url() ?>assets/images/them.svg" alt="3 chấm" class="dropdown-toggle d-dropdown" data-toggle="dropdown">
                                                        <div class="dropdown-menu d-dropdown-menu">
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
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?
                                        $i++;
                                        }
                                        ?>
                                        <tr class="d-table-nv-tr1" style="height: 50px;"></tr>
                                    </tbody>
                                </table>
                                <?
                                $i = 0;
                                foreach ($info_schedule as $value) {
                                ?>
                                    <div class="d-ds-lich-trinh-mobile" id="scheduleMb<?= $value['id'] ?><?= $arr_ep[$value['staff_id']]['ep_id'] ?>">
                                        <div class="d-ds-lich-trinh">
                                            <img src="https://chamcong.24hpay.vn/upload/employee/<?= $arr_ep[$value['staff_id']]['ep_image'] ?>" onerror='this.onerror=null;this.src="<? base_url() ?>/images_staff/avatar_default.png";' alt="name_nv" class="d-info-img">
                                            <div class="d-lich-trinh-td1a">
                                                <p class="d-cham-cong-p">(<?= $arr_ep[$i]->ep_id ?>) <?= $arr_ep[$value['staff_id']]['ep_name'] ?></p>
                                                <p class="d-cham-cong-p1">Nhân viên <?= $arr_ep[$value['staff_id']]['dep_name'] ?></p>
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
                                                    <!-- <div><a href="</?= urlSualichtrinh(); ?>" class="d-update-nv">Sửa</a></div>
                                                    <div><a class="d-delete-nv d-lich-trinh">Xóa</a></div>
                                                    <div><a class="d-lich-trinh">Theo dõi</a></div> -->
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
                                            <!-- <p class="d-email-nv" style="color:#1F3F77;padding:0 6px;background: #EEF5FC;border-radius: 5px; display:none">Hoàn thành</p>
                                            <p class="d-email-nv" style="color: #F79722;padding:0 6px;background: rgba(247, 151, 34, 0.1);border-radius: 5px;">Đang làm</p>
                                            <p class="d-email-nv" style="color:#B31217;padding:0 6px;background: rgba(179, 18, 23, 0.1);border-radius: 5px; display:none">Hủy</p> -->
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
                <form class="d-modal-boloc">
                    <div class="d-modal-boloc1">
                        <select name="cty" id="cty" class="d-chi-nhanh">
                            <option value=""></option>
                            <option value="1">dasda</option>
                        </select>
                    </div>
                    <div class="d-modal-boloc1">
                        <select name="phong_ban" id="phong_ban" class="d-phong-ban">
                            <option value=""></option>
                            <option value="1">1</option>
                        </select>
                    </div>
                    <div class="d-modal-boloc1">
                        <select name="chi_nhanh" id="lich_trinh" class="d-chi-nhanh">
                            <option value=""></option>
                            <option value="1">dasda</option>
                        </select>
                    </div>
                    <div class="d-modal-boloc2">
                        <button type="button" class="d-modal-boloc-huy" data-dismiss="modal" aria-hidden="true">Hủy</button>
                        <button type="submit" class="d-modal-boloc-tk">Tìm kiếm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal thêm nv -->
    <? include(APPPATH . 'views/includes/inc_footer.php') ?>
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/Chart.min.js"></script>
    <script>
        var base_url = "/";
        $(document).ready(function() {
            $('.d-dropdown').hover(function() {
                    $(this).attr('src', '<?= base_url() ?>assets/images/them1.svg');
                },
                function() {
                    $(this).attr('src', '<?= base_url() ?>assets/images/them.svg');
                });
            // $('.d-dropdown').After(function(){
            //     $(this).attr('src','<?= base_url() ?>assets/images/them1.svg');},
            //     function(){
            //     $(this).attr('src','<?= base_url() ?>assets/images/them.svg');
            // });

            $('#cty').select2({
                placeholder: 'Chọn công ty',
                width: "100%"
            });
            $('#phong_ban').select2({
                placeholder: 'Chọn phòng ban',
                width: "100%"
            });
            $('#lich_trinh').select2({
                placeholder: 'Chọn lịch trinh',
                width: "100%"
            });

            $(".d-ds-nhan-vien").click(function() {
                $('.d-ds-nhan-vien').addClass('active');
                $('.d-ds-nv').removeClass('active');
                $('#ds_nhan_vien').addClass('active');
                $('#ds_nv_chua_duyet').removeClass('active');
            });
            $(".d-ds-nv").click(function() {
                $('.d-ds-nv').addClass('active');
                $('.d-ds-nhan-vien').removeClass('active');
                $('#ds_nv_chua_duyet').addClass('active');
                $('#ds_nhan_vien').removeClass('active');
            });
            $(".tick-all").click(function() {
                if (!$(this).hasClass("checked")) {
                    $(this).addClass('checked').attr('src', '<?= base_url() ?>assets/images/chon_all.svg');
                    $('.tick-chon').addClass('checked').attr('src', '<?= base_url() ?>assets/images/tick_xanh.svg');
                    $('.bo-chon').removeClass('checked').attr('src', '<?= base_url() ?>assets/images/k_chon.svg');
                } else {
                    $(this).removeClass('checked').attr('src', '<?= base_url() ?>assets/images/tick.svg');
                    $('.tick-chon').removeClass('checked').attr('src', '<?= base_url() ?>assets/images/tick.svg');
                }
            });
            $('.tick-chon').click(function() {
                if (!$(this).hasClass("checked")) {
                    $(this).addClass('checked').attr('src', '<?= base_url() ?>assets/images/tick_xanh.svg');
                    $('.bo-chon').removeClass('checked').attr('src', '<?= base_url() ?>assets/images/k_chon.svg');
                }
            });
            $('.bo-chon').click(function() {
                if (!$(this).hasClass("checked")) {
                    $(this).addClass('checked').attr('src', '<?= base_url() ?>assets/images/k_chon1.svg');
                    $('.tick-chon').removeClass('checked').attr('src', '<?= base_url() ?>assets/images/tick.svg');
                    $(".tick-all").removeClass('checked').attr('src', '<?= base_url() ?>assets/images/tick.svg');
                }
            });
        });

        function deleteSchedule(id_sch, id_staff) {
            var id = 'schedule' + id_sch + id_staff;
            var data = new FormData();
            data.append('id_sch', id_sch);
            data.append('id_staff', id_staff);
            $.ajax({
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                // enctype: 'multipart/form-data',
                url: base_url + '/company/Company_controller/deleteStaffBySchedule',
                data: data,
                dataType: "JSON",
                async: false,
                success: function(data) {
                    if (data.result == true) {
                        $("#alert").append('<div class="alert-success">' + data.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {
                                $(".alert-success").remove();
                            });
                        }, 1500);
                        $("#schedule" + id_sch + id_staff).css("display", "none");
                        $("#scheduleMb" + id_sch + id_staff).css("display", "none");
                    } else {
                        return false;
                    }
                }
            });
        }
    </script>
</body>

</html>