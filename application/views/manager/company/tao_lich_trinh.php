<style>
    .ql_lichtrinh {
        color: #206AA9;
    }
    .l_margin_link{
        margin-left: 5px;
    }
</style>
<div class="d-qly-cty1-v1">
    <h3 class="d-qly-cham-cong">Tạo lịch trình</h3>
    <div class="d-qly-lich-trinh1">
        <div id="alert"></div>

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
                            <!-- <div class="col-md-6 col-sm-6 col-xs-12 d-input-radio-v1a">
                                <input type="radio" class="d-tao-lich2 l_curson" onchange="show_depament(<?= $detail_company['com_id'] ?>,0,0)" value="<?= $detail_company['com_id'] ?>" name="cty" id="cty">
                                <label for="cty" class="d-tao-lich2-v1 l_curson"><?= $detail_company['com_name'] ?></label>
                            </div> -->
                            <? foreach ($detail_company_small as $value) { ?>
                                <div class="col-md-6 col-sm-6 col-xs-12 d-input-radio-v1a">
                                    <input type="radio" class="d-tao-lich2 l_curson" onchange="show_depament(<?= $value->com_id ?>,<?= $value->com_id; ?>,0)" value="<?= $value->com_id; ?>" name="cty" id="cty<?= $value->com_id; ?>">
                                    <label for="cty<?= $value->com_id; ?>" class="d-tao-lich2-v1 l_curson"><?= $value->com_name; ?></label>
                                </div>
                            <? } ?>
                        </div>
                        <div class="error" id="err_choose_cty"></div>
                    </div>
                    <div class="d-tao-lich-v2">
                        <p class="d-from-p">Chọn phòng/ban :</p>
                        <div class="row d-input-checkbox" id="append_department">
                        </div>
                        <div class="error" tabindex="-1" id="err_phongban"></div>
                        <input type="hidden" name="chon" id="chon">
                    </div>
                    <div class="d-tao-lich-v3">
                        <p class="d-from-p">Chọn nhân viên :</p>
                        <div class="col-md-12 col-sm-12 col-xs-12 d-nv-cung-lich">
                            <div class="d-tao-lich-v3a" id="scroll">
                            </div>
                        </div>
                        <div class="error" tabindex="-1" id="err_choose_nv"></div>
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
                            <textarea name="ghi_chu" id="ghi_chu" cols="30" rows="5" class="d-textarea" placeholder="Những điều cần lưu ý"></textarea>
                        </div>
                    </div>
                    <div class="error" id="err_text"></div>
                </div>
                <div class="d-form-lich-trinh">Địa điểm di chuyển:</div>
                <div class="d-tao-lich">
                    <div class="col-md-12 col-sm-12 col-xs-12 d-dichuyen-1">
                        <div class="d-dichuyen">
                            <p><img src="<?= base_url(); ?>assets/images/dot_blue.svg" alt="dot" class="d-dichuyen-img"> <span class="d-dichuyen-sp">Từ:</span></p>
                            <input type="text" name="diemden[]" class="d-dichuyen-input" placeholder="Nhập điểm xuất phát">
                        </div>
                        <div class="d-dichuyen2">
                            <p class="d-dichuyen-p"><img src="<?= base_url(); ?>assets/images/dot_blue.svg" alt="dot" class="d-dichuyen-img"> <span class="d-dichuyen-sp" >Đến điểm dừng:</span></p>
                            <input type="text" name="diemden[]" class="d-dichuyen-input" placeholder="Nhập điểm dừng">
                            <!-- <img src="<?= base_url(); ?>assets/images/Delete.svg" alt="xóa" class="d-delete-img"> -->
                        </div>
                        <div class="d-them-diem-dung">
                            <p class="d-them-diem-dung1" id="them_diem_dung">Thêm Điểm Dừng</p>
                        </div>
                    </div>
                    <div class="error" id="err_dd"></div>

                </div>
            </div>
            <div class="d-lich-trinh-submit">
                <button type="reset" class="d-lich-trinh-reset">
                    <p class="d-lt-reset-a">Nhập lại</p>
                </button>
                <button type="submit" class="d-lich-trinh-primary">
                    <p class="d-lt-submit">Tạo lịch trình</p>
                </button>
            </div>
        </form>

    </div>
</div>
<!-- modal map -->

<div class="modal fade" id="follow_map">
    <div class="modal-dialog d-modal-dialog">
        <div class="modal-content d-modal-content-map">
            <div class="modal-header modal-follow-map">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <img src="<?= base_url(); ?>assets/images/close.svg" alt="exit" class="follow-map-img">
                </button>
            </div>
            <div class="modal-body d-follow-map">
                <div class="d-follow-map1">
                    <img src="<?= base_url(); ?>assets/images/img_map.svg" alt="map" class="d-follow-map1-img">
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
                                            <img src="<?= base_url(); ?>assets/images/Ellipse124.svg" alt="ten nv" class="d-follow-map2-v2a-img">
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