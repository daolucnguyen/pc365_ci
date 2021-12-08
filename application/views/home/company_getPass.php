<div id="alert"></div>
<div class="q-content-qmk" id="getpass_step1">
    <div class="q-banner-regis-1">
        <span>QUÊN MẬT KHẨU</span>
    </div>
    <div class="q-content-body">
        <div class="q-qmk">
            <div class="q-qmk-title">
                <p>Mời bạn nhập email bạn đã đăng ký tài khoản trên PuchClock365.
                    Chúng tôi sẽ gửi tới bạn mã xác thực để tạo mật khẩu mới.
                    Vui lòng kiểm tra email</p>
            </div>
            <form class="q-qmk-form-cty">
                <p class="q-qmk-form-label">Email đăng kí</p>
                <input type="text" name="qmk_email" class="q-qmk-form-input" placeholder="Nhập email của bạn">
                <p class="val_error" id="val_qmk1"></p>
                <button type="submit" class="q-qmk-form-button"><span>Gửi Email Xác Thực</span></button>
            </form>
        </div>
    </div>
</div>
<div class="q-content-qmk" id="getpass_step2">
    <div class="q-banner-regis-1">
        <span>NHẬP MÃ XÁC NHẬN</span>
    </div>
    <div class="q-content-body-2">
        <div class="q-qmk-2">
            <p class="q-qmk-title-2">Nhập mã OTP gồm 6 chữ số đã được gửi thông qua email.</p>
            <form class="q-qmk-form-cty-2">
                <div class="q-form-3-v2">
                    <input type="text" autocomplete="off" class="q-qmk-form-input-2" id="input_2_1" name="input_2_1" data-next="input_2_2" oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                    <input type="text" autocomplete="off" class="q-qmk-form-input-2" id="input_2_2" name="input_2_2" data-next="input_2_3" data-previous="input_2_1" oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                    <input type="text" autocomplete="off" class="q-qmk-form-input-2" id="input_2_3" name="input_2_3" data-next="input_2_4" data-previous="input_2_2" oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                    <input type="text" autocomplete="off" class="q-qmk-form-input-2" id="input_2_4" name="input_2_4" data-next="input_2_5" data-previous="input_2_3" oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                    <input type="text" autocomplete="off" class="q-qmk-form-input-2" id="input_2_5" name="input_2_5" data-next="input_2_6" data-previous="input_2_4" oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                    <input type="text" autocomplete="off" class="q-qmk-form-input-2" id="input_2_6" name="input_2_6" data-previous="input_2_5" oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                </div>
                <p class="val_error" id="val_qmk2"></p>
                <div class="q-qmk-form-footer-2">
                    <p>Không nhận được mã ?
                    <p class="l_curson" onclick="gui_lai_otp_company();" id="re-send">Gửi lại</p>
                    </p>
                </div>
                <div class="q-qmk-form-button-2">
                    <input type="reset" value="Nhập Lại" name="submit-regis-2" class=" hide q-submit-regis-2" id="input-reform-2"></input>
                    <a href="/quen-mat-khau-cong-ty.html" class="q-qmk-button1" id="input-reform-2"><span>Quay Lại</span></span></a>
                    <button type="submit" class="q-qmk-button" id="input-submit-2"><span>Tiếp Theo</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="q-content-qmk" id="getpass_step3">
    <div class="q-banner-regis-1">
        <span>ĐỔI MẬT KHẨU</span>
    </div>
    <div class="q-content-body-3">
        <div class="q-qmk-3">
            <p class="q-qmk-title-3">Xác thực email thành công, mời bạn nhập mật khẩu mới tại đây để tiếp tục sử dụng dịch vụ.</p>
            <form class="q-qmk-form-cty-3">
                <div class="q-qmk-form-control-3">
                    <p class="q-qmk-form-control-3-title">Mật khẩu mới</p>
                    <input type="password" name="" id="qmk_pass1" class="q-qmk-form-input-3" placeholder="Tối thiểu 6 kí tự">
                    <img src="<?= base_url() ?>assets/images/Hide.png" alt="show" class="q-qmk-form-img-3" id="show_pass1">
                </div>
                <p class="val_error" id="val_qmk3_pass"></p>
                <div class="q-qmk-form-control-3">
                    <p class="q-qmk-form-control-3-title">Nhập lại mật khẩu</p>
                    <input type="password" name="" id="qmk_pass2" class="q-qmk-form-input-3" placeholder="Tối thiểu 6 kí tự">
                    <img src="<?= base_url() ?>assets/images/Hide.png" alt="show" class="q-qmk-form-img-3" id="show_pass2">
                </div>
                <p class="val_error" id="val_qmk3_repass"></p>
                <button type="submit" name="" class="q-qmk-form-button-3"><span>Đổi Mật Khẩu</span></button>
            </form>
        </div>
    </div>
</div>