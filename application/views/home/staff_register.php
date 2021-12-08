<style>
    body {
        background-color: #f5f5f5;
    }
</style>
<div class="q-content-1">
    <div class="q-banner-regis-1">
        <span>ĐĂNG KÝ NHÂN VIÊN</span>
        <div id="alert"></div>
    </div>
    <div class="q-regis-1">
        <div class="q-form-regis-1" >
            <div class="q-form-header-1">
                <div class="q-form-header-1-v2">
                    <img src="<?= base_url() ?>assets/images/regis-1-active.png" alt="res1" class="q-form-img">
                    <img src="<?= base_url() ?>assets/images/Line 3.png" alt="line" class="q-form-img-line">
                    <img src="<?= base_url() ?>assets/images/regis-2.png" alt="res2" class="q-form-img">
                    <img src="<?= base_url() ?>assets/images/Line 3.png" alt="line" class="q-form-img-line">
                    <img src="<?= base_url() ?>assets/images/regis-3.png" alt="res3" class="q-form-img">
                    <img src="<?= base_url() ?>assets/images/Line 3.png" alt="line" class="q-form-img-line">
                    <img src="<?= base_url() ?>assets/images/regis-4.png" alt="res4" class="q-form-img">
                </div>
            </div>
            <div class="q-form-body-1">
                <p class="q-form-label-1">Mã ID Công Ty ( Do Nhân Sự Cung Cấp ) </p>
                <form class="q-form-1" id="form_dk1" method="post">
                    <input type="text" name="id_company" id="form_input_1" class="q-form-input-1" placeholder="Nhập mã ID">
                    <p class="val_error"></p>
                    <button type="submit" name="submit-regis-1" class="q-submit-regis-1" id="q-submit-regis-1"><span>Tiếp Theo</span></button>
                </form>
            </div>
        </div>
        <div class="q-form-regis-2" style="display: none;">
            <div class="q-form-header-1" id="form-header-2">
                <img src="<?= base_url() ?>assets/images/regis-1-active.png" alt="res1" class="q-form-img">
                <img src="<?= base_url() ?>assets/images/Line 3-active.png" alt="line" class="q-form-img-line">
                <img src="<?= base_url() ?>assets/images/regis-2-active.png" alt="res2" class="q-form-img">
                <img src="<?= base_url() ?>assets/images/Line 3.png" alt="line" class="q-form-img-line">
                <img src="<?= base_url() ?>assets/images/regis-3.png" alt="res3" class="q-form-img">
                <img src="<?= base_url() ?>assets/images/Line 3.png" alt="line" class="q-form-img-line">
                <img src="<?= base_url() ?>assets/images/regis-4.png" alt="res4" class="q-form-img">
            </div>
            <div class="q-form-body-2">
                <form class="q-form-2" id="form_dky_2" method="post">
                    <p class="q-title-2-tk">Thông Tin Tài Khoản</p>
                    <div class="q-form-col-2">
                        <div class="q-form-control-2">
                            <p class="q-form-label-2">Email đăng nhập</p>
                            <input type="text" name="" class="q-form-input-2 input_email_2"  id="input_email_2" autocomplete="off" placeholder="Điền email đăng ký của bạn">
                            <p class="val_error" id="val_dk2_email"></p>
                        </div>
                        <div class="q-form-control-2">
                            <p class="q-form-label-2">Mật khẩu đăng nhập</p>
                            <input type="password" name="" class="q-form-input-2" id="input_pass_2" placeholder="Tối thiểu 6 ký tự">
                            <p class="val_error" id="val_dk2_pass"></p>
                        </div>
                        <div class="q-form-control-2">
                            <p class="q-form-label-2">Nhập lại mật khẩu</p>
                            <input type="password" name="" class="q-form-input-2" id="input_repass_2" placeholder="Tối thiểu 6 ký tự">
                            <p class="val_error" id="val_dk2_repass"></p>
                        </div>
                    </div>
                    <p class="q-title-2-lh">Thông Tin Liên Hệ</p>
                    <div class="q-form-col-2">
                        <div class="q-form-control-2">
                            <p class="q-form-label-2">Họ tên</p>
                            <input type="text" name="" class="q-form-input-2" autocomplete="off" placeholder="Họ tên đầy đủ" id="input_name_2">
                            <p class="val_error" id="val_dk2_name"></p>
                        </div>
                        <div class="q-form-control-2">
                            <p class="q-form-label-2">Số điện thoại</p>
                            <input type="text" name="" class="q-form-input-2" autocomplete="off" placeholder="Số điện thoại liên hệ" id="input_phone_2" oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                            <p class="val_error" id="val_dk2_phone"></p>
                        </div>
                        <div class="q-form-control-2">
                            <p class="q-form-label-2">Địa chỉ</p>
                            <input type="text" name="" class="q-form-input-2" autocomplete="off" placeholder="Nhập địa chỉ" id="input_address">
                            <p class="val_error" id="val_dk2_address"></p>
                        </div>
                        <div class="q-form-control-2">
                            <p class="q-form-label-2">Giới tính</p>
                            <div class="form-group l_clear_margin">
                                <select class="form-control q-form-input-2 select2" id="input_gender" name="staff_gender">
                                    <option value="">Chọn giới tính</option>
                                    <option value="1">Nam</option>
                                    <option value="2">Nữ</option>
                                    <option value="3">Khác</option>
                                </select>
                                <p class="val_error" id="val_dk2_gender"></p>
                            </div>
                        </div>
                        <div class="q-form-control-2">
                            <p class="q-form-label-2 ">Ngày sinh</p>
                            <input type="date" name="" class="q-form-input-2" autocomplete="off" placeholder="Nhập ngày sinh" id="input_brith" >
                            <p class="val_error" id="val_dk2_brith"></p>
                        </div>
                        <div class="q-form-control-2">
                            <p class="q-form-label-2">Tình trạng hôn nhân</p>
                            <div class="form-group l_clear_margin">
                                <select class="form-control q-form-input-2 select2" id="input_marriage_2" name="staff_marriage">
                                    <option value="">Chọn tình trạng hôn nhân</option>
                                    <option value="1">Đã lập gia đình</option>
                                    <option value="2">Độc thân</option>
                                </select>
                                <p class="val_error" id="val_marriage_cv"></p>
                            </div>
                        </div>
                        <div class="q-form-control-2">
                            <p class="q-form-label-2">Trình độ học vấn</p>
                            <div class="form-group l_clear_margin">
                                <?
                                $arr = [
                                    1 => 'Trên đại học',
                                    2 => 'Đại học',
                                    3 => 'Cao đẳng',
                                    4 => 'Trung cấp',
                                    5 => 'Đào tạo nghề',
                                    6 => 'Trung học phổ thông',
                                    7 => 'Trung học cơ sở',
                                    8 => 'Tiểu học',
                                ];
                                ?>
                                <select class="form-control q-form-input-2 select2" id="input_education_2" name="staff_education">
                                    <option value="">Chọn trình độ học vấn</option>
                                    <?
                                    foreach ($arr as $key => $value) {
                                        ?>
                                        <option value="<?= $key ?>"><?= $value ?></option>
                                        <?
                                    }
                                    ?>
                                </select>
                                <p class="val_error" id="val_dk2_education"></p>
                            </div>
                        </div>
                        
                        <div class="q-form-control-2">
                            <p class="q-form-label-2">kinh nghiệm làm việc</p>
                            <div class="form-group l_clear_margin">
                                <?
                                $arr_experience = [
                                    1 => 'Chưa có kinh nghiệm',
                                    2 => 'Dưới 1 năm kinh nghiệm',
                                    3 => '1 năm',
                                    4 => '2 năm',
                                    5 => '3 năm',
                                    6 => '4 năm',
                                    7 => '5 năm',
                                    8 => 'Trên 5 năm',
                                ];
                                ?>
                                <select class="form-control q-form-input-2 select2" id="input_experience_2" name="staff_experience">
                                    <option value="">Chọn trình độ học vấn</option>
                                    <?
                                    foreach ($arr_experience as $key => $value) {
                                        ?>
                                        <option value="<?= $key ?>"><?= $value ?></option>
                                        <?
                                    }
                                    ?>
                                </select>
                                <p class="val_error" id="val_experience_pb"></p>
                            </div>
                        </div>
                        
                        <div class="q-form-control-2">
                            <p class="q-form-label-2 ">Ngày bắt đầu làm việc</p>
                            <input type="date" name="" class="q-form-input-2" autocomplete="off" placeholder="Nhập ngày bắt đầu làm việc" id="input_date_join">
                            <p class="val_error" id="val_dk2_date_join"></p>
                        </div>

                        <div class="q-form-control-2">
                            <p class="q-form-label-2">Phòng / ban</p>
                            <div class="form-group l_clear_margin">
                                <select class="form-control q-form-input-2 select2" id="input_phongban_2" name="staff_phongban">
                                    <option value="">Chọn phòng ban nhân viên</option>
                                </select>
                                <p class="val_error" id="val_dk2_pb"></p>
                            </div>
                        </div>
                        
                        <div class="q-form-control-2">
                            <p class="q-form-label-2">Tổ</p>
                            <div class="form-group l_clear_margin">
                                <select class="form-control q-form-input-2 select2" id="input_nest_2" name="staff_nest">
                                    <option value="">Chọn tổ</option>
                                </select>
                                <p class="val_error" id="val_dk2_nest"></p>
                            </div>
                        </div>
                        
                        <div class="q-form-control-2">
                            <p class="q-form-label-2">Nhóm</p>
                            <div class="form-group l_clear_margin">
                                <select class="form-control q-form-input-2 select2" id="input_group_2" name="staff_group">
                                    <option value="">Chọn nhóm</option>
                                </select>
                                <p class="val_error" id="val_dk2_group"></p>
                            </div>
                        </div>
                        <div class="q-form-control-2">
                            <p class="q-form-label-2">Chức vụ</p>
                            <div class="form-group l_clear_margin ">
                                <select class="form-control q-form-input-2 select2" id="input_chucvu_2" name="staff_chucvu">
                                    <option value="">Chọn chức vụ nhân viên</option>
                                </select>
                                <p class="val_error" id="val_dk2_cv"></p>
                            </div>
                        </div>
                    </div>
                    <div class="q-form-button">
                        <button type="reset" name="submit-regis-2" class="q-submit-regis-2" id="input-reform-2">Nhập Lại</button>
                        <button type="submit" name="submit-regis-2" class="q-submit-regis-2" id="input-submit-2">Tiếp tục</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="q-form-regis-3" style="display: none;">
            <div class="q-form-header-1" id="form-header-3">
                <img src="<?= base_url() ?>assets/images/regis-1-active.png" alt="res1" class="q-form-img">
                <img src="<?= base_url() ?>assets/images/Line 3-active.png" alt="line" class="q-form-img-line">
                <img src="<?= base_url() ?>assets/images/regis-2-active.png" alt="res2" class="q-form-img">
                <img src="<?= base_url() ?>assets/images/Line 3-active.png" alt="line" class="q-form-img-line">
                <img src="<?= base_url() ?>assets/images/regis-3-active.png" alt="res3" class="q-form-img">
                <img src="<?= base_url() ?>assets/images/Line 3.png" alt="line" class="q-form-img-line">
                <img src="<?= base_url() ?>assets/images/regis-4.png" alt="res4" class="q-form-img">
            </div>
            <div class="q-form-body-3">
                <p class="q-form-title-3">Nhập mã OTP gồm 6 chữ số đã được gửi thông qua email.</p>
                <form class="q-form-3" id="form-3" method="post">
                    <div class="q-form-3-v2">
                        <input type="text" autocomplete="off" class="q-form-input-3" id="input_3_1" name="input_3_1" data-next="input_3_2" oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                        <input type="text" autocomplete="off" class="q-form-input-3" id="input_3_2" name="input_3_2" data-next="input_3_3" data-previous="input_3_1" oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                        <input type="text" autocomplete="off" class="q-form-input-3" id="input_3_3" name="input_3_3" data-next="input_3_4" data-previous="input_3_2" oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                        <input type="text" autocomplete="off" class="q-form-input-3" id="input_3_4" name="input_3_4" data-next="input_3_5" data-previous="input_3_3" oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                        <input type="text" autocomplete="off" class="q-form-input-3" id="input_3_5" name="input_3_5" data-next="input_3_6" data-previous="input_3_4" oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                        <input type="text" autocomplete="off" class="q-form-input-3" id="input_3_6" name="input_3_6" data-previous="input_3_5" oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                    </div>
                    <p class="val_error" id="val_dk3"></p>
                    <div class="q-form-footer-3">
                        <p>Không nhận được mã ?
                        <div onclick="retypeMail();" id="re-send " class="l_curson l_color">Gửi lại</div>
                        </p>
                    </div>
                    <div class="q-form-button">
                        <input type="reset" value="Nhập Lại" name="submit-regis-2" class="q-submit-regis-2" id="input-reform-3"></input>
                        <button type="submit" name="submit-regis-2" class="q-submit-regis-2" id="input-submit-3"><span>Tiếp Theo</span></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="q-form-regis-4" style="display: none;">
            <div class="q-form-header-1" id="form-header-3">
                <img src="<?= base_url() ?>assets/images/regis-1-active.png" alt="res1" class="q-form-img">
                <img src="<?= base_url() ?>assets/images/Line 3-active.png" alt="line" class="q-form-img-line">
                <img src="<?= base_url() ?>assets/images/regis-2-active.png" alt="res2" class="q-form-img">
                <img src="<?= base_url() ?>assets/images/Line 3-active.png" alt="line" class="q-form-img-line">
                <img src="<?= base_url() ?>assets/images/regis-3-active.png" alt="res3" class="q-form-img">
                <img src="<?= base_url() ?>assets/images/Line 3-active.png" alt="line" class="q-form-img-line">
                <img src="<?= base_url() ?>assets/images/regis-4-active.png" alt="res4" class="q-form-img">
            </div>
            <div class="q-form-body-4">
                <form class="q-form-4" method="post" enctype="multipart/form-data">
                    <div class="q-upload-4">
                        <div class="q-upload-4-v2">
                            <div class="image-upload">
                                <label for="file-input">
                                    <img src="<?= base_url() ?>assets/images/regis-4-upload.png" />
                                </label>
                                <input id="file-input" type="file" name="regis_img" accept="image/png, image/jpeg" multiple />
                                <p class="val_error" id="val_dk4"></p>
                            </div>
                            <p>Tải lên ít nhất 3 ảnh gương mặt để sử dụng face ID</p>
                        </div>
                    </div>
                    <div class="q-regis-show-upload">
                        <div class="q-regis-show-item">
                                <div class="q-show-image"></div>
                                <div class="q-show-info">
                                    <div class="q-show-name"></div>
                                    <div class="q-show-size"></div>
                                </div>
                                <img src="<?= base_url() ?>assets/images/Delete.png" alt="delete" class="q-show-delete">
                            </div>
                    </div>
                    <div class="q-form-button">
                        <a href="#" name="submit-regis-2" onclick="quaylai();" class="input-reform-4"><span>Quay Lại</span></a>
                        <div class="input-submit-4"><span>Tiếp Theo</span></div>
                        <button type="submit" name="submit-regis-3" class="input-confirm-4 hide"><span>Hoàn Tất Đăng Kí</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>