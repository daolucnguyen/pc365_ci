<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật công việc</title>

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
                <h3 class="d-qly-cham-cong">Cập nhật công việc</h3>
                <div class="d-qly-lich-trinh1">
                    <div id="alert"></div>
                    <form method="POST" role="form" onsubmit="updateJob(<?= $infoJob['job_id'] ?>); return false;">

                        <div class="d-form-group">
                            <label class="d-form-lich-trinh">Tên công việc:</label>
                            <div class="d-tao-lich">
                                <input type="text" class="d-tao-lich1" value="<?= $infoJob['job_name'] ?>" id="ten_cv" name="ten_cv" placeholder="Nhập tên công việc">
                                <div class="error" id="err_tencty"></div>
                            </div>
                        </div>
                        <div class="d-form-group">
                            <div class="d-form-news-job">Thời gian làm việc:</div>
                            <div class="d-tao-lich">
                                <div class="d-tao-lich-v1">
                                    <p class="d-from-p">Lịch làm việc:</p>
                                    <div class="row d-input-radio">
                                        <div class="col-md-6 col-sm-6 col-xs-12 d-input-radio-v1a">
                                            <input type="radio" <? if ($infoJob['job_time_in'] != $infoJob['job_time_out']) {
                                                                    echo "checked";
                                                                } ?> class="d-tao-lich2" value="" name="chon" id="chon1">
                                            <label for="chon1" class="d-tao-lich2-v1">Làm trong ngày</label>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 d-input-radio-v1a">
                                            <input type="radio" <? if ($infoJob['job_time_in'] == $infoJob['job_time_out']) {
                                                                    echo "checked";
                                                                } ?> class="d-tao-lich2" value="" name="chon" id="chon2">
                                            <label for="chon2" class="d-tao-lich2-v1">Làm nhiều ngày</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-new-job-v1" <? if ($infoJob['job_time_in'] != $infoJob['job_time_out']) {
                                                                ?> style="display:block" <?
                                                                                        } ?> id="hihi">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <p class="d-from-p">Thời gian bắt đầu:</p>
                                        <div class="row d-new-job-v2">
                                            <div class="col-md-12 col-sm-12 col-xs-12 d-new-job-v1a">
                                                <input type="date" class="d-new-job1" value="<?= date('Y-m-d', $infoJob['job_day_start']); ?>" name="date_start" id="date_start">
                                                <input type="time" class="d-new-job1" value="<?= date('H:i:s', $infoJob['job_time_in']); ?>" name="time_in" id="time_in">
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 error" id="err_date_start"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <p class="d-from-p">Thời gian kết thúc:</p>
                                        <div class="row d-new-job-v3">
                                            <div class="col-md-12 col-sm-12 col-xs-12 d-new-job-v1a">
                                                <input type="date" class="d-new-job1" value="<?= date('Y-m-d', $infoJob['job_day_end']); ?>" name="date_end" id="date_end">
                                                <input type="time" class="d-new-job1" value="<?= date('H:i:s', $infoJob['job_time_out']); ?>" name="time_out" id="time_out">
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 error" id="err_date_end"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-new-job-v1" <? if ($infoJob['job_time_in'] == $infoJob['job_time_out']) {
                                                                ?> style="display:block" <?
                                                                                        } ?> id="haha">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <p class="d-from-p">Thời gian bắt đầu:</p>
                                        <input type="date" class="d-new-job2" value="<?= date('Y-m-d', $infoJob['job_day_start']); ?>" name="time_startt" id="time_startt">
                                        <div class="error" id="err_time_start"></div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <p class="d-from-p">Thời gian kết thúc:</p>
                                        <input type="date" class="d-new-job2" value="<?= date('Y-m-d', $infoJob['job_day_end']); ?>" name="time_endd" id="time_endd">
                                        <div class="error" id="err_time_end"></div>
                                    </div>
                                </div>
                                <div class="error" id="err_lichlam" tabindex='1'></div>
                            </div>
                        </div>
                        <div class="d-form-group">
                            <div class="d-form-lich-trinh">Người tham gia công việc:</div>
                            <div class="d-tao-lich">
                                <div class="d-tao-lich-v1">
                                    <p class="d-from-p">Chọn công ty :</p>
                                    <div class="row d-input-radio">
                                        <!-- <div class="col-md-6 col-sm-6 col-xs-12 d-input-radio-v1a">
                                            <input type="radio" <?
                                                                if ($detail_company['com_id'] == $infoJob['job_com_id']) {
                                                                    echo "checked";
                                                                }
                                                                ?> class="d-tao-lich2" onchange="show_depament(<?= $detail_company['com_id'] ?>,0);" value="" name="cty" id="cty">
                                            <label for="cty" class="d-tao-lich2-v1"><?= $detail_company['com_name'] ?></label>
                                        </div> -->
                                        <?
                                        foreach ($detail_company_small as $value) {
                                        ?>
                                            <div class="col-md-6 col-sm-6 col-xs-12 d-input-radio-v1a">
                                                <input type="radio" <?
                                                                    if ($value->com_id == $infoJob['job_com_id']) {
                                                                        echo "checked";
                                                                    }
                                                                    ?> class="d-tao-lich2 l_curson" onchange="show_depament(<?= $value->com_id  ?>,0);" value="<?= $value->com_id  ?>" name="cty" id="cty<?= $value->com_id ?>">
                                                <label for="cty<?= $value->com_id ?>" class="d-tao-lich2-v1 l_curson"><?= $value->com_name ?></label>
                                            </div>
                                        <?
                                        }
                                        ?>

                                    </div>
                                    <div class="error" id="err_choose_cty" tabindex='1'></div>
                                </div>
                                <div class="d-tao-lich-v2">
                                    <p class="d-from-p">Chọn phòng/ban :</p>
                                    <div class="row d-input-checkbox" id="append_department">
                                        <?
                                         foreach ($listDepartment as $value) {

                                        ?>
                                            <div class="col-md-4 col-sm-4 col-xs-12 d-input-radio-v1a l_remove_department">
                                                <input type="checkbox" <?
                                                                        foreach ($department as $key => $d) {
                                                                            if ($value->dep_id == $d) {
                                                                                echo "checked";
                                                                            }
                                                                        }
                                                                        ?> class="item_ca d-tao-lich2 l_curson" onchange="show_staff('<?= $value->dep_id ?>')" id="dep<?= $value->dep_id ?>" value="<?= $value->dep_id ?>" name="department">
                                                <label for="dep<?= $value->dep_id ?>" class="d-tao-lich2-v1 l_curson"><?= $value->dep_name ?></label>
                                            </div>
                                        <?
                                        }
                                        ?>
                                    </div>
                                    <div class="error" id="err_phongban" tabindex='1'></div>
                                    <input type="hidden" name="chon" id="chon">
                                </div>
                                <div class="d-tao-lich-v3">
                                    <p class="d-from-p">Chọn nhân viên :</p>
                                    <div class="col-md-12 col-sm-12 col-xs-12 d-nv-cung-lich">
                                        <div class="d-tao-lich-v3a" id="scroll">
                                            <?
                                                foreach ($show_staff_department as $key => $value) {

                                            ?>
                                                    <div class="col-md-6 col-sm-6 col-xs-12 d-tao-lich-v3a1 remobe_staff">
                                                        <div class="d-tao-lich-v3-img">
                                                            <img src="<?= $value->ep_image; ?>" onerror='this.onerror=null;this.src="<?= base_url(); ?>images_staff/avatar_default.png"' ; alt="ten_nv" class="nv-tao-lich-img">
                                                        </div>
                                                        <label for="st<?= $value->ep_id; ?>">
                                                            <div class="d-ten-nv">
                                                                <p class="d-cham-cong-p">(<?= $value->ep_id; ?>)<?= $value->ep_name ?></p>
                                                                <p class="d-cham-cong-p1">Nhân viên <?= $value->dep_name ?></p>
                                                            </div>
                                                        </label>
                                                        <div class="d-input-nv">
                                                            <input type="checkbox" <?
                                                                                    foreach ($listScheduleStaff as $ss) {
                                                                                        if ($ss['staff_id'] == $value->ep_id) {
                                                                                            echo "checked";
                                                                                        }
                                                                                    }
                                                                                    ?> name="staff[]" class="item_cty d-tao-lich2" id="st" data-name="1" value="<?= $value->ep_id; ?>">
                                                        </div>
                                                    </div>
                                            <?
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="error" id="err_choose_nv" tabindex='1'></div>
                                    <input type="hidden" name="chon_nv" id="chon_nv">
                                </div>
                            </div>
                            <div class="d-form-lich-trinh3">Thời gian lịch trình:</div>
                            <div class="d-tao-lich">
                                <div class="row">
                                    <div class="col-md-5 col-sm-3 col-xs-6 ">
                                        <div class="d-time">
                                            <input type="text" name="dia_chi" id="dia_chi" value="<?= $infoJob['job_address'] ?>" class="d-new-job-v3-1" placeholder="Nhập địa chỉ">
                                        </div>
                                        <div class="error" id="err_address"></div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6 ">
                                        <div class="d-new-job-v3a">
                                            <select name="city" onchange="show_district();" id="city" class="d-new-job-select">
                                                <option value="">Tỉnh/ thành</option>
                                                <?
                                                foreach ($show_city as $cit) {
                                                ?>
                                                    <option <?
                                                            if ($infoJob['job_city'] == $cit['cit_id']) {
                                                                echo "selected";
                                                            }
                                                            ?> value="<?= $cit['cit_id'] ?>"><?= $cit['cit_name'] ?></option>
                                                <?
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="error" id="err_city"></div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6 ">
                                        <div class="d-new-job-v3a">
                                            <select name="district" id="district" class="d-new-job-select">
                                                <option value="">Quận/ huyện</option>
                                                <?
                                                foreach ($show_city2 as $value) {
                                                ?>
                                                    <option <?
                                                            if ($infoJob['job_district'] == $value['cit_id']) {
                                                                echo "selected";
                                                            }
                                                            ?> value="<?= $value['cit_id'] ?>"><?= $value['cit_name'] ?></option>
                                                <?
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="error" id="err_district"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-form-new-job">Nhắc nhở công việc:</div>
                            <div class="d-tao-lich">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12 d-new-job-v3a">
                                        <?
                                        $arr = [
                                            "1" => "Khi bắt đầu",
                                            "2" => "Trước 5 phút",
                                            "3" => "Trước 15 phút",
                                            "4" => "Trước 30 phút",
                                            "5" => "trước 1 giờ",
                                            "6" => "trước 1 ngày",
                                        ];
                                        ?>
                                        <select name="time_nhac" id="time_nhac" class="d-new-job-select">
                                            <option value="">Chọn thời gian nhắc nhở</option>
                                            <?
                                            foreach ($arr as $key => $value) {
                                            ?>
                                                <option <?
                                                        if ($key == $infoJob['time_notify']) {
                                                            echo "selected";
                                                        }
                                                        ?> value="<?= $key ?>"><?= $value ?></option>
                                            <?
                                            }
                                            ?>
                                            <!-- <option value="1">Khi bắt đầu</option>
                                            <option value="2">Trước 5 phút</option>
                                            <option value="3">Trước 15 phút</option>
                                            <option value="4">Trước 30 phút</option>
                                            <option value="5">trước 1 giờ</option>
                                            <option value="6">trước 1 ngày</option> -->
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 d-new-job-v3a">
                                        <?
                                        $arr = [
                                            "1" => "Không bao giờ lặp lại",
                                            "2" => "Hàng ngày",
                                            "3" => "Hàng tuần",
                                            "4" => "Cách 2 tuần",
                                            "5" => "Cách 1 tháng",
                                            "6" => "Hàng năm",
                                        ];
                                        ?>
                                        <select name="cach_nhac" id="cach_nhac" class="d-new-job-select">
                                            <option value="">Chọn cách thức thông báo</option>
                                            <?
                                            foreach ($arr as $key => $value) {
                                            ?>
                                                <option <?
                                                        if ($key == $infoJob['time_notify']) {
                                                            echo "selected";
                                                        }
                                                        ?> value="<?= $key ?>"><?= $value ?></option>
                                            <?
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="error" id="err_nhacnho"></div>
                            </div>
                        </div>
                        <div class="d-form-group">
                            <label class="d-form-lich-trinh">Ghi chú:</label>
                            <div class="d-tao-lich">
                                <!-- <input type="text" class="d-tao-lich1" value="" id="ten_cty" name="ten_cty" placeholder="Ghi chú"> -->
                                <textarea name="note" id="note" class="d-tao-lich1" cols="30" rows="5"><?= $infoJob['note']; ?></textarea>
                                <div class="error" id="err_tencty"></div>
                            </div>
                        </div>
                        <div class="d-form-group" id="add_content">
                            <label class="d-form-lich-trinh">Việc Cần làm:</label>
                            <!-- <div class="d-tao-lich"> -->
                            <!-- <div class="l_delete">
                                    <img src="<?= base_url() ?>assets/images/Delete.svg" alt="xóa" class="l_img_delete">
                                </div> -->
                            <div class="d-tao-lich">
                                <?
                                $i = 0;
                                foreach ($show_job_content as $value) {
                                    if ($i >= 1) {
                                ?>
                                        <div class="l_delete">
                                            <img src="<?= base_url() ?>assets/images/Delete.svg" alt="xóa" onclick="deletes(this)" class="l_img_delete">
                                        </div>
                                    <?
                                    }
                                    ?>
                                    <div class="l_margin_content">
                                        <input type="text" class="d-tao-lich1 l_content" value="<?= $value['content'] ?>" id="l_content" name="l_content[]" placeholder="Nhập Việc cần làm">
                                    </div>
                                <?
                                    $i++;
                                }
                                ?>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="error l_forcus_contents" id="err_content" tabindex="1"></div>
                        <div class="btn_add_content">
                            <button type="button" class="d-them-diem-dung1 l_custom_btn" onclick="add_content();" id="them_viec">Thêm Việc cần làm</button>
                        </div>
                        <div class="d-new-job-submit">
                            <button type="reset" class="d-lich-trinh-reset">
                                <p class="d-lt-reset-a">Nhập lại</p>
                            </button>
                            <button type="submit" onclick="updateJob(<?= $infoJob['job_id'] ?>); return false;" class="d-lich-trinh-primary">
                                <p class="d-lt-submit">Cập nhật công việc</p>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <? include(APPPATH . 'views/includes/inc_footer.php') ?>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/Chart.min.js"></script>
    <script src="<?= base_url() ?>assets/js/cty/tao_cong_viec.js"></script>
    <script>
    </script>
</body>

</html>