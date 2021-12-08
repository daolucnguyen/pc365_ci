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
    <title>Tạo Lịch Trình</title>

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
                <h3 class="d-qly-cham-cong">Tạo lịch trình</h3>
                <div class="d-qly-lich-trinh1">
                    <form method="POST" role="form" id="them_lich">
                    
                        <div class="d-form-group">
                            <label class="d-form-lich-trinh">Mục đích tạo lịch trình:</label>
                            <div class="d-tao-lich">
                                <input type="text" class="d-tao-lich1" value="" id="tao_lich" name="tao_lich" placeholder="Nhập tên lịch trình muốn tạo">
                                <div class="error" id="err_lich"></div>
                            </div>
                        </div>
                        <div class="d-form-group">
                            <div class="d-form-lich-trinh">Người tham gia lịch trình:</div>
                            <div class="d-tao-lich">
                                <div class="d-tao-lich-v1">
                                    <p class="d-from-p">Chọn công ty :</p>
                                    <div class="row d-input-radio">
                                        <div class="col-md-6 col-sm-6 col-xs-12 d-input-radio-v1a">    
                                            <input type="radio" class="d-tao-lich2" value="0" name="cty" id="cty">
                                            <label for="cty" class="d-tao-lich2-v1">Công ty TNHH 1 thành viên HHP</label>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 d-input-radio-v1a">
                                            <input type="radio" class="d-tao-lich2" value="1" name="cty" id="cty2">
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
                                                    <input type="checkbox" class="item_cty d-tao-lich2" data-name="1" data-nv="0">
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
                                                    <input type="checkbox" class="item_cty d-tao-lich2" data-name="1" data-nv="0">
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
                                        <label for="" class="d-from-p">Bắt đầu từ:</label>
                                        <input type="date" name="date_start" id="date_start" class="d-time-v2">
                                        <div class="error" id="err_date_start"></div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 d-time1">
                                        <label for="" class="d-from-p">Kết thúc :</label>
                                        <input type="date" name="date_end" id="date_end" class="d-time-v2">
                                        <div class="error" id="err_date_end"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-form-lich-trinh">Ghi chú:</div>
                            <div class="d-tao-lich">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 d-tao-lich-1">
                                        <textarea name="ghi_chu" id="ghi_chu" cols="30" rows="5" class="d-textarea"
                                        placeholder="Những điều cần lưu ý"></textarea>
                                    </div>
                                </div>
                                <div class="error" id="err_text"></div>
                            </div>
                            <div class="d-form-lich-trinh">Địa điểm di chuyển:</div>
                            <div class="d-tao-lich">
                                <div class="col-md-12 col-sm-12 col-xs-12 d-dichuyen-1">
                                    <div class="d-dichuyen">
                                        <p><img src="../images/dot_blue.svg" alt="dot" class="d-dichuyen-img"> <span class="d-dichuyen-sp">Từ:</span></p>
                                        <input type="text" class="d-dichuyen-input" placeholder="Nhập điểm xuất phát">
                                    </div>
                                    <div class="d-dichuyen2">
                                        <p class="d-dichuyen-p"><img src="../images/dot_blue.svg" alt="dot" class="d-dichuyen-img"> <span class="d-dichuyen-sp">Đến số 1:</span></p>
                                        <input type="text" class="d-dichuyen-input" placeholder="Nhập điểm đến">
                                        <!-- <img src="../images/Delete.svg" alt="xóa" class="d-delete-img"> -->
                                    </div>
                                    <div class="d-them-diem-dung">
                                        <p class="d-them-diem-dung1" id="them_diem_dung">Thêm Điểm Dừng</p>
                                    </div>
                                </div>
                                <div class="error" id="err_dd"></div>
                                
                            </div>
                        </div>
                        <div class="d-lich-trinh-submit">
                            <button type="reset" class="d-lich-trinh-reset"><p class="d-lt-reset-a">Nhập lại</p></button>
                            <button type="submit" class="d-lich-trinh-primary"><p class="d-lt-submit">Tạo lịch trình</p></button>
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
                        <img src="../images/close.svg" alt="exit" class="follow-map-img">
                    </button>
                </div>
                <div class="modal-body d-follow-map">
                    <div class="d-follow-map1">
                        <img src="../images/img_map.svg" alt="map" class="d-follow-map1-img">
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
                                                <img src="../images/Ellipse124.svg" alt="ten nv" class="d-follow-map2-v2a-img">
                                                <div class="d-follow-map2-v2b">
                                                    <p class="d-follow-map2-v2a-p">(162) Ngô Ngọc Yến</p>
                                                    <p class="d-follow-map2-v2a-p1">Nhân viên phòng kĩ thuật</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="d-follow-map-td">
                                            <p class="d-follow-map2-v2a-p2">Ca Sáng  ( 08:00 - 11:30 )</p>
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
    <? include('../includes/inc_footer.php') ?>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/select2.min.js"></script>
<script src="../js/Chart.min.js"></script>
<script src="../js/cty/tao_lich_trinh.js"></script>
<script>
    $(document).ready(function () {
        $('.d-dropdown').hover(function(){
            $(this).attr('src','../images/them1.svg');},
            function(){
            $(this).attr('src','../images/them.svg');
        });
        $('#them_diem_dung').click(function(){
            i = 1;
            let dem = i + 1;
            html = `
            <div class="d-dichuyen2">
                <p class="d-dichuyen-p"><img src="../images/dot_blue.svg" alt="dot" class="d-dichuyen-img"> <span class="d-dichuyen-sp">Đến số `+dem+`:</span></p>
                <input type="text" class="d-dichuyen-input" placeholder="Nhập điểm đến">
                <img src="../images/Delete.svg" alt="xóa" class="d-delete-img" onClick="deletes(this)">
            </div>`;
            $(".d-them-diem-dung").before(html);
        });
    });
    function deletes(e) {
        dom_parent = $(e).parent().remove();
    }
</script>
</body>
</html>
