<div class="q-content-1">
    <div class="q-banner-regis-1">
        <span>XÁC THỰC NHÂN VIÊN</span>
    </div>
    <div id="alert"></div>
    <div class="q-regis-1">
        <div class="q-form-regis-3" id="xacthuc_nv_1">
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
                <form class="q-form-3_item1" id="form-3" method="post">
                    <div class="q-form-3-v2">
                        <input type="hidden" name="email" class="email_xac_thuc" value="<?= $email; ?>">
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
                        <div onclick="gui_lai_otp();" id="re-send " class="l_curson l_color">Gửi lại</div>
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
                <form class="q-form-4_item1" method="post" enctype="multipart/form-data">
                    <div class="q-upload-4_item1">
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
                        <!-- <div class="q-regis-show-item">
                                <div class="q-show-image"></div>
                                <div class="q-show-info">
                                    <div class="q-show-name"></div>
                                    <div class="q-show-size"></div>
                                </div>
                                <img src="<?= base_url() ?>assets/images/Delete.png" alt="delete" class="q-show-delete">
                            </div> -->
                    </div>
                    <div class="q-form-button">
                        <a href="#" name="submit-regis-2" class="input-reform-4"><span>Quay Lại</span></a>
                        <div class="input-submit-4"><span>Tiếp Theo</span></div>
                        <button type="submit" name="submit-regis-3" class="input-confirm-4 hide"><span>Hoàn Tất Đăng Kí</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>