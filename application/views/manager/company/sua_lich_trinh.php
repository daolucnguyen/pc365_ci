<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Lịch Trình</title>

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
                <h3 class="d-qly-cham-cong">Sửa lịch trình</h3>
                <div class="d-qly-lich-trinh1">
                    <div id="alert"></div>
                    <form onsubmit="capnhatlichtrinh(<?= $detail['id'] ?>); return false;" role="form" id="them_lich">

                        <div class="d-form-group">
                            <label class="d-form-lich-trinh">Mục đích tạo lịch trình:</label>
                            <div class="d-tao-lich">
                                <input type="text" class="d-tao-lich1" value="<?= $detail['name'] ?>" id="tao_lich" name="tao_lich" placeholder="Nhập tên lịch trình muốn tạo">
                                <div class="error" id="err_lich"></div>
                            </div>
                        </div>
                        <div class="d-form-group">
                            <div class="d-form-lich-trinh">Người tham gia lịch trình:</div>
                            <div class="d-tao-lich">
                                <div class="d-tao-lich-v1">
                                    <p class="d-from-p">Chọn công ty :</p>
                                    <div class="row d-input-radio">
                                       <?
                                        foreach ($detail_company_small as $value) {
                                        ?>
                                            <div class="col-md-6 col-sm-6 col-xs-12 d-input-radio-v1a">
                                                <input type="radio" <?
                                                                    if ($detail['com_id'] == $value->com_id) {
                                                                        echo "checked";
                                                                    }
                                                                    ?> class="d-tao-lich2 l_curson" onchange="show_depament(<?= $value->com_id ?>,0)" value="<?= $value->com_id ?>" name="cty" id="sm<?= $value->com_id ?>">
                                                <label for="sm<?= $value->com_id ?>" class="d-tao-lich2-v1 l_curson"><?= $value->com_name; ?></label>
                                            </div>
                                        <?
                                        }
                                        ?>
                                    </div>
                                    <div class="error" id="err_choose_cty"></div>
                                </div>
                                <div class="d-tao-lich-v2">
                                    <p class="d-from-p">Chọn phòng/ban :</p>
                                    <div class="row d-input-checkbox" id="append_department">
                                        <?
                                        foreach ($listDepartment as $pb) {
                                        ?>
                                            <div class="col-md-4 col-sm-4 col-xs-12 d-input-radio-v1a l_remove_department">
                                                <input <?
                                                        foreach ($getDepartment as $key => $value) {
                                                            if ($pb->dep_id == $value) {
                                                                echo "checked";
                                                            }
                                                        }
                                                        ?> type="checkbox" class="item_ca d-tao-lich2 l_curson" onchange="show_staff(<?= $pb->dep_id; ?>,<?= $detail['id'] ?>);" id="pb<?= $pb->dep_id ?>" value="<?= $pb->dep_id; ?>" name="department">
                                                <label for="pb<?= $pb->dep_id?>" class="d-tao-lich2-v1 l_curson"><?= $pb->dep_name ?></label>
                                            </div>
                                        <?
                                        }
                                        ?>
                                    </div>
                                    <div class="error" id="err_phongban"></div>
                                    <input type="hidden" name="chon" id="chon">
                                </div>
                                <div class="d-tao-lich-v3">
                                    <p class="d-from-p">Chọn nhân viên :</p>
                                    <div class="col-md-12 col-sm-12 col-xs-12 d-nv-cung-lich">
                                        <div class="d-tao-lich-v3a" id="scroll">
                                            <?
                                            foreach ($show_staff_department as $key => $value) {
                                                // foreach ($value as $valueStaff) {
                                            ?>
                                                    <label for="1" class="col-md-6 col-sm-6 col-xs-12 d-tao-lich-v3a1 remobe_staff">
                                                        <div class="d-tao-lich-v3-img">
                                                            <img src="<?= $value->ep_image ?>" ; onerror='this.onerror=null;this.src="<?= base_url(); ?>images_staff/avatar_default.png";' alt="<?= $value->ep_name ?>" class="nv-tao-lich-img">
                                                        </div>
                                                        <div class="d-ten-nv">
                                                            <p class="d-cham-cong-p">(<?= $value->ep_id ?>) <?= $value->ep_name ?></p>
                                                            <p class="d-cham-cong-p1">Nhân viên <?= $value->dep_name ?></p>
                                                        </div>
                                                        <div class="d-input-nv">
                                                            <input <?
                                                                    foreach ($listScheduleStaff as $ScheduleStaff) {
                                                                        if ($value->ep_id == $ScheduleStaff['staff_id']) {
                                                                            echo "checked";
                                                                        }
                                                                    }
                                                                    ?> type="checkbox" class="item_nv item_cty d-tao-lich2 l_curson" value="<?= $value->ep_id ?>" data-name="1" data-nv="0">
                                                        </div>
                                                    </label>
                                            <?
                                                // }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="error" id="err_choose_nv"></div>
                                    <input type="hidden" name="chon_nv" id="chon_nv">
                                </div>
                            </div>
                            <div class="d-form-lich-trinh3">Thời gian lịch trình:</div>
                            <div class="d-tao-lich">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12 d-time">
                                        <label for="" class="d-from-p">Bắt đầu từ:</label>
                                        <input type="date" name="date_start" value="<?= date('Y-m-d', $detail['date_start']); ?>" id="date_start" class="d-time-v2">
                                        <div class="error" id="err_date_start"></div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 d-time1">
                                        <label for="" class="d-from-p">Kết thúc :</label>
                                        <input type="date" name="date_end" value="<?= date('Y-m-d', $detail['date_end']); ?>" id="date_end" class="d-time-v2">
                                        <div class="error" id="err_date_end"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-form-lich-trinh">Ghi chú:</div>
                            <div class="d-tao-lich">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 d-tao-lich-1">
                                        <textarea name="ghi_chu" id="ghi_chu" cols="30" rows="5" class="d-textarea" placeholder="Những điều cần lưu ý"><?= $detail['note']; ?></textarea>
                                    </div>
                                </div>
                                <div class="error" id="err_text"></div>
                            </div>
                            <div class="d-form-lich-trinh">Địa điểm di chuyển:</div>
                            <div class="d-tao-lich">
                                <div class="col-md-12 col-sm-12 col-xs-12 d-dichuyen-1">
                                    <?
                                    $i = 0;
                                    foreach ($detail_schedulePlace as $valuePlace) {
                                    ?>
                                        <div class="d-dichuyen2">
                                            <p><img src="<?= base_url() ?>assets/images/dot_blue.svg" alt="dot" class="d-dichuyen-img"> <span class="d-dichuyen-sp">
                                                    <?
                                                    if ($i == 0) {
                                                        echo "Từ";
                                                    } else {
                                                        echo "Đến số " . $i . " :";
                                                    }
                                                    ?>
                                                </span></p>
                                            <input type="text" class="d-dichuyen-input" value="<?= $valuePlace['place'] ?>" placeholder="Nhập điểm xuất phát">
                                            <?
                                            if ($i >= 1) {
                                            ?>
                                                <img src="<?= base_url() ?>assets/images/Delete.svg" alt="xóa" class="d-delete-img l_remove" onClick="deletes(this)">
                                            <?
                                            }
                                            ?>
                                        </div>
                                    <?
                                        $i++;
                                    }
                                    ?>
                                    <div class="d-them-diem-dung">
                                        <p class="d-them-diem-dung1" id="them_diem_dung">Thêm Điểm Dừng</p>
                                    </div>
                                </div>
                                <div class="error" id="err_dd"></div>

                            </div>
                        </div>
                        <div class="d-lich-trinh-submit">
                            <!-- <button type="reset" class="d-lich-trinh-reset">
                                <p class="d-lt-reset-a">Nhập lại</p>
                            </button> -->
                            <button type="submit" onclick="capnhatlichtrinh(<?= $detail['id'] ?>); return false;" class="d-lich-trinh-primary">
                                <p class="d-lt-submit">Cập nhật</p>
                            </button>
                        </div>
                    </form>

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
    <? include(APPPATH . 'views/includes/inc_footer.php') ?>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/Chart.min.js"></script>
    <script src="<?= base_url() ?>assets/js/cty/tao_lich_trinh.js"></script>
    <script>
        $(document).ready(function() {
            var input_place = $('.d-dichuyen2');
            if (input_place.length <= 2) {
                $('.l_remove').css('display', 'none');
            } else {
                $('.l_remove').css('display', 'block');
            }
            $('.d-dropdown').hover(function() {
                    $(this).attr('src', '<?= base_url() ?>assets/images/them1.svg');
                },
                function() {
                    $(this).attr('src', '<?= base_url() ?>assets/images/them.svg');
                }
            );

            // $('#them_diem_dung').click(function() {
            //     i = 1;
            //     let dem = i + 1;
            //     html = `
            // <div class="d-dichuyen2">
            //     <p class="d-dichuyen-p"><img src="<?= base_url() ?>assets/images/dot_blue.svg" alt="dot" class="d-dichuyen-img"> <span class="d-dichuyen-sp">Đến số ` + dem + `:</span></p>
            //     <input type="text" class="d-dichuyen-input" placeholder="Nhập điểm đến">
            //     <img src="<?= base_url() ?>assets/images/Delete.svg" alt="xóa" class="d-delete-img" onClick="deletes(this)">
            // </div>`;
            //     $(".d-them-diem-dung").before(html);
        });

        function deletes(e) {
            dom_parent = $(e).parent().remove();
            var input_place = $('.d-dichuyen2');
            if (input_place.length <= 2) {
                $('.l_remove').css('display', 'none');
            } else {
                $('.l_remove').css('display', 'block');
            }
        }
    </script>
</body>

</html>