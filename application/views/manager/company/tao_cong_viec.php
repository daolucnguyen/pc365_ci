<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo công việc</title>

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

        .l_margin_link {
            margin-left: 5px;
        }

        @media only screen and (max-width: 768px) {

            /* .l_absolude {
                display: block;
            }
            .d-bo-loc-lich{
                padding: 0;
            } */
            .d-new-job-v1a {
                display: unset;
            }

            .l_margin_top {
                margin-top: 20px;
            }

            .d-new-job1 {
                width: 100%;
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
                <h3 class="d-qly-cham-cong">Tạo công việc</h3>
                <div class="d-qly-lich-trinh1">
                    <div id="alert"></div>
                    <form method="POST" role="form" id="tao_cong_viec">

                        <div class="d-form-group">
                            <label class="d-form-lich-trinh">Tên công việc:</label>
                            <div class="d-tao-lich">
                                <input type="text" class="d-tao-lich1" value="" id="ten_cv" name="ten_cv" placeholder="Nhập tên công việc">
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
                                            <input type="radio" class="d-tao-lich2 l_curson" value="" name="chon" id="chon1">
                                            <label for="chon1" class="d-tao-lich2-v1 l_curson">Làm trong ngày</label>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 d-input-radio-v1a">
                                            <input type="radio" class="d-tao-lich2 l_curson" value="" name="chon" id="chon2">
                                            <label for="chon2" class="d-tao-lich2-v1 l_curson">Làm nhiều ngày</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-new-job-v1" id="hihi">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <p class="d-from-p">Thời gian bắt đầu:</p>
                                        <div class="row d-new-job-v2">
                                            <div class="col-md-12 col-sm-12 col-xs-12 d-new-job-v1a">
                                                <input type="date" class="d-new-job1" value="" name="date_start" onchange="date_start_value();" id="date_start">
                                                <input type="time" class="d-new-job1 l_margin_top" value="" name="time_in" id="time_in">
                                                <!-- <select name="time_start" id="time_start" class="d-new-job-select">
                                                    <option value="">Chọn giờ</option>
                                                    <option value="1">hihihaha</option>
                                                </select> -->
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 error" id="err_date_start"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <p class="d-from-p">Thời gian kết thúc:</p>
                                        <div class="row d-new-job-v3">
                                            <div class="col-md-12 col-sm-12 col-xs-12 d-new-job-v1a">
                                                <input type="date" class="d-new-job1" disabled value="" name="date_end" id="date_end">
                                                <input type="time" class="d-new-job1 l_margin_top" value="" name="time_out" id="time_out">
                                                <!-- <select name="time_end" id="time_end" class="d-new-job-select">
                                                    <option value="">Chọn giờ</option>
                                                    <option value="1">hihihaha</option>
                                                </select> -->
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 error" id="err_date_end"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-new-job-v1" id="haha">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <p class="d-from-p">Thời gian bắt đầu:</p>
                                        <input type="date" class="d-new-job2" value="" name="time_startt" id="time_startt">
                                        <div class="error" id="err_time_start"></div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <p class="d-from-p">Thời gian kết thúc:</p>
                                        <input type="date" class="d-new-job2" value="" name="time_endd" id="time_endd">
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
                                            <input type="radio" class="d-tao-lich2 l_curson" onchange="show_depament(<?= $detail_company['com_id'] ?>,0);" value="" name="cty" id="cty">
                                            <label for="cty" class="d-tao-lich2-v1 l_curson"><?= $detail_company['com_name'] ?></label>
                                        </div> -->
                                        <?
                                        foreach ($detail_company_small as $value) {
                                        ?>
                                            <div class="col-md-6 col-sm-6 col-xs-12 d-input-radio-v1a">
                                                <input type="radio" class="d-tao-lich2 l_curson" onchange="show_depament(<?= $value->com_id ?>,0);" value="<?= $value->com_id ?>" name="cty" id="cty<?= $value->com_id ?>">
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
                                    </div>
                                    <div class="error" id="err_phongban" tabindex='1'></div>
                                    <input type="hidden" name="chon" id="chon">
                                </div>
                                <div class="d-tao-lich-v3">
                                    <p class="d-from-p">Chọn nhân viên :</p>
                                    <div class="col-md-12 col-sm-12 col-xs-12 d-nv-cung-lich">
                                        <div class="d-tao-lich-v3a" id="scroll">
                                        </div>
                                    </div>
                                    <div class="error" id="err_choose_nv" tabindex='1'></div>
                                    <input type="hidden" name="chon_nv" id="chon_nv">
                                </div>
                            </div>
                            <div class="d-form-lich-trinh3">Địa điểm làm việc:</div>
                            <div class="d-tao-lich">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <div class="d-time">
                                            <input type="text" name="dia_chi" id="dia_chi" class="d-new-job-v3-1" placeholder="Nhập địa chỉ">
                                        </div>
                                        <div class="error" id="err_address"></div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12 ">
                                        <div class="d-new-job-v3a">
                                            <select name="city" onchange="show_district();" id="city" class="d-new-job-select">
                                                <option value="">Tỉnh/ thành</option>
                                                <?
                                                foreach ($show_city as $cit) {
                                                ?>
                                                    <option value="<?= $cit['cit_id'] ?>"><?= $cit['cit_name'] ?></option>
                                                <?
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="error" id="err_city"></div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12 ">
                                        <div class="d-new-job-v3a">
                                            <select name="district" id="district" class="d-new-job-select">
                                                <option value="">Quận/ huyện</option>
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
                                        <select name="time_nhac" id="time_nhac" class="d-new-job-select">
                                            <option value="">Chọn thời gian nhắc nhở</option>
                                            <option value="1">Khi bắt đầu</option>
                                            <option value="2">Trước 5 phút</option>
                                            <option value="3">Trước 15 phút</option>
                                            <option value="4">Trước 30 phút</option>
                                            <option value="5">trước 1 giờ</option>
                                            <option value="6">trước 1 ngày</option>
                                        </select>
                                        <div class="error" id="err_nhacnho"></div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 d-new-job-v3a">
                                        <select name="cach_nhac" id="cach_nhac" class="d-new-job-select">
                                            <option value="">Chọn cách thức thông báo</option>
                                            <option value="1">Không bao giờ lặp lại</option>
                                            <option value="2">Hàng ngày</option>
                                            <option value="3">Hàng tuần</option>
                                            <option value="4">Cách 2 tuần</option>
                                            <option value="5">Cách 1 tháng</option>
                                            <option value="6">Hàng năm</option>
                                        </select>
                                        <div class="error" id="err_laplai"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-form-group">
                            <label class="d-form-lich-trinh">Ghi chú:</label>
                            <div class="d-tao-lich">
                                <!-- <input type="text" class="d-tao-lich1" value="" id="ten_cty" name="ten_cty" placeholder="Ghi chú"> -->
                                <textarea name="note" id="note" class="d-tao-lich1" cols="30" rows="5"></textarea>
                                <div class="error" id="err_tencty"></div>
                            </div>
                        </div>
                        <div class="d-form-group" id="add_content">
                            <label class="d-form-lich-trinh">Việc Cần làm:</label>
                            <div class="d-tao-lich">
                                <!-- <div class="l_delete">
                                    <img src="<?= base_url() ?>assets/images/Delete.svg" alt="xóa" class="l_img_delete">
                                </div> -->
                                <div class="padding_content">
                                    <input type="text" class="d-tao-lich1 l_content l_forcus_content" value="" id="l_content" name="l_content[]" placeholder="Nhập Việc cần làm">
                                </div>
                            </div>
                        </div>
                                <div class="error" id="err_content" tabindex="1"></div>
                        <div class="btn_add_content">
                            <button type="button" class="d-them-diem-dung1 l_custom_btn" onclick="add_content();" id="them_viec">Thêm Việc cần làm</button>

                        </div>
                        <div class="d-new-job-submit">
                            <button type="reset" class="d-lich-trinh-reset">
                                <p class="d-lt-reset-a">Nhập lại</p>
                            </button>
                            <button type="submit" class="d-lich-trinh-primary">
                                <p class="d-lt-submit">Tạo Công việc</p>
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