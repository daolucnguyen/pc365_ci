<?php
    include "../config/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa công việc</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/select2.min.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/quan_ly_cty.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="d-quan-ly-cty">
        <?php include "../includes/sidebar_left_cty.php";?>
        <div class="d-quan-ly-cty1">
            <?php include "../includes/header_manager.php";?>
            <div class="d-qly-cty1-v1">
                <h3 class="d-qly-cham-cong">Sửa công việc</h3>
                <div class="d-qly-lich-trinh1">
                    <form method="POST" role="form" id="tao_cong_viec">
                    
                        <div class="d-form-group">
                            <label class="d-form-lich-trinh">Tên công việc:</label>
                            <div class="d-tao-lich">
                                <input type="text" class="d-tao-lich1" value="" id="ten_cty" name="ten_cty"
                                placeholder="Nhập tên công việc">
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
                                            <input type="radio" class="d-tao-lich2" value="" name="chon" id="chon1">
                                            <label for="" class="d-tao-lich2-v1">Làm trong ngày</label>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 d-input-radio-v1a">
                                            <input type="radio" class="d-tao-lich2" value="" name="chon" id="chon2">
                                            <label for="" class="d-tao-lich2-v1">Làm nhiều ngày</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-new-job-v1" id="hihi">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <p class="d-from-p">Thời gian bắt đầu:</p>
                                        <div class="row d-new-job-v2">
                                            <div class="col-md-12 col-sm-12 col-xs-12 d-new-job-v1a">    
                                                <input type="date" class="d-new-job1" value="" name="date_start" id="date_start">
                                                <select name="time_start" id="time_start" class="d-new-job-select">
                                                    <option value="">Chọn giờ</option>
                                                    <option value="1">hihihaha</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 error" id="err_date_start"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <p class="d-from-p">Thời gian kết thúc:</p>
                                        <div class="row d-new-job-v3">
                                            <div class="col-md-12 col-sm-12 col-xs-12 d-new-job-v1a">
                                                <input type="date" class="d-new-job1" value="" name="date_end" id="date_end">
                                                <select name="time_end" id="time_end" class="d-new-job-select">
                                                    <option value="">Chọn giờ</option>
                                                    <option value="1">hihihaha</option>
                                                </select>
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
                                <div class="error" id="err_lichlam"></div>
                            </div>
                        </div>
                        <div class="d-form-group">
                            <div class="d-form-lich-trinh">Người tham gia công việc:</div>
                            <div class="d-tao-lich">
                                <div class="d-tao-lich-v1">
                                    <p class="d-from-p">Chọn công ty :</p>
                                    <div class="row d-input-radio">
                                        <div class="col-md-6 col-sm-6 col-xs-12 d-input-radio-v1a">    
                                            <input type="radio" class="d-tao-lich2" value="" name="cty" id="cty">
                                            <label for="cty" class="d-tao-lich2-v1">Công ty TNHH 1 thành viên HHP</label>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 d-input-radio-v1a">
                                            <input type="radio" class="d-tao-lich2" value="" name="cty" id="cty2">
                                            <label for="cty2" class="d-tao-lich2-v1">Công ty TNHH 1 thành viên HHP</label>
                                        </div>
                                    </div>
                                    <div class="error" id="err_choose_cty"></div>
                                </div>
                                <div class="d-tao-lich-v2">
                                    <p class="d-from-p">Chọn phòng/ban :</p>
                                    <div class="row d-input-checkbox">
                                        <div class="col-md-4 col-sm-4 col-xs-12 d-input-radio-v1a">
                                            <input type="checkbox" class="item_ca d-tao-lich2" value="" data-name="phong_hc" data-chon="0">
                                            <label class="d-tao-lich2-v1">Phòng hành chính</label>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12 d-input-radio-v1a">
                                            <input type="checkbox" class="item_ca d-tao-lich2" value="" data-name="phong_kt" data-chon="0">
                                            <label class="d-tao-lich2-v1">Phòng kỹ thuật</label>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12 d-input-radio-v1a">
                                            <input type="checkbox" class="item_ca d-tao-lich2" value="" data-name="phong_ns" data-chon="0">
                                            <label class="d-tao-lich2-v1">Phòng nhân sự</label>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12 d-input-radio-v1a">
                                            <input type="checkbox" class="item_ca d-tao-lich2" value="" data-name="phong_seo" data-chon="0">
                                            <label class="d-tao-lich2-v1">Phòng SEO</label>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12 d-input-radio-v1a">
                                            <input type="checkbox" class="item_ca d-tao-lich2" value="" data-name="phong_kd" data-chon="0">
                                            <label class="d-tao-lich2-v1">Phòng kinh doanh</label>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12 d-input-radio-v1a">
                                            <input type="checkbox" class="item_ca d-tao-lich2" value="" data-name="phong_nl" data-chon="0">
                                            <label class="d-tao-lich2-v1">Phòng nhập liệu</label>
                                        </div>
                                    </div>
                                    <div class="error" id="err_phongban"></div>
                                    <input type="hidden" name="chon" id="chon">
                                </div>
                                <div class="d-tao-lich-v3">
                                    <p class="d-from-p">Chọn nhân viên :</p>
                                    <div class="col-md-12 col-sm-12 col-xs-12 d-nv-cung-lich">
                                        <div class="d-tao-lich-v3a" id="scroll">
                                            <label for="1" class="col-md-6 col-sm-6 col-xs-12 d-tao-lich-v3a1">
                                                <div class="d-tao-lich-v3-img">
                                                    <img src="../images/Ellipse124.svg" alt="ten_nv" class="nv-tao-lich-img">
                                                </div>
                                                <div class="d-ten-nv">
                                                    <p class="d-cham-cong-p">(162) Ngô Ngọc Yến</p>
                                                    <p class="d-cham-cong-p1">Nhân viên phòng kĩ thuật</p>
                                                </div>
                                                <div class="d-input-nv">
                                                    <input type="checkbox" class="item_nv d-tao-lich2" data-name="1" data-nv="0">
                                                </div>
                                            </label>
                                            <label for="" class="col-md-6 col-sm-6 col-xs-12 d-tao-lich-v3a1">
                                                <div class="d-tao-lich-v3-img">
                                                    <img src="../images/Ellipse124.svg" alt="ten_nv" class="nv-tao-lich-img">
                                                </div>
                                                <div class="d-ten-nv">
                                                    <p class="d-cham-cong-p">(162) Ngô Ngọc Yến</p>
                                                    <p class="d-cham-cong-p1">Nhân viên phòng kĩ thuật</p>
                                                </div>
                                                <div class="d-input-nv">
                                                    <input type="checkbox" class="item_nv d-tao-lich2" data-name="1" data-nv="0">
                                                </div>
                                            </label>
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
                                        <input type="text" name="dia_chi" id="dia_chi" class="d-new-job-v3-1"
                                        placeholder="Nhập địa chỉ">
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6 d-new-job-v3a">
                                        <select name="city" id="city" class="d-new-job-select">
                                            <option value="">Tỉnh/ thành</option>
                                            <option value="1">hihihaha</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6 d-new-job-v3a">
                                        <select name="district" id="district" class="d-new-job-select">
                                            <option value="">Quận/ huyện</option>
                                            <option value="1">hihihaha</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="error" id="err_time_lich"></div>
                            </div>
                            <div class="d-form-new-job">Nhắc nhở công việc:</div>
                            <div class="d-tao-lich">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12 d-new-job-v3a">
                                        <select name="time_nhac" id="time_nhac" class="d-new-job-select">
                                            <option value="">Chọn thời gian nhắc nhở</option>
                                            <option value="1">hihihaha</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 d-new-job-v3a">
                                        <select name="cach_nhac" id="cach_nhac" class="d-new-job-select">
                                            <option value="">Chọn cách thức thông báo</option>
                                            <option value="1">hihihaha</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="error" id="err_nhacnho"></div>
                            </div>
                        </div>
                        <div class="d-new-job-submit">
                            <button type="reset" class="d-lich-trinh-reset"><p class="d-lt-reset-a">Nhập lại</p></button>
                            <button type="submit" class="d-lich-trinh-primary"><p class="d-lt-submit">Cập nhật</p></button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>

    </div>
    <? include('../includes/inc_footer.php') ?>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/select2.min.js"></script>
<script src="../js/Chart.min.js"></script>
<script src="../js/cty/tao_cong_viec.js"></script>
<script>
</script>
</body>
</html>
