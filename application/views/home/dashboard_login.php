<div class="form_dang_nhap">
    <h1 class="tt_login">ĐĂNG NHẬP TÀI KHOẢN</h1>
    <div class="fr_log_in">
        <div class="login" id="login_general">
            <li class="li-company active"><a href="#company_login" class="login_cty active" data-toggle="tab">Công ty</a></li>
            <li class="li-staff"><a class="login_nv" href="#staff_login" data-toggle="tab">Nhân viên</a>
            </li>
        </div>
        <div class="login_cty_form">
            <form class="tab-company active" onsubmit="loginCompany(); return false;" id="company_login">
                <p class="login-p">Email đăng nhập</p>
                <div class="email">
                    <input class="input-mail" type="text" placeholder="Nhập email của bạn" id="email">
                    <p class="val_error" id="error_email_com"></p>
                </div>
                <p class="login-p">Mật khẩu</p>
                <div class="pass">
                    <input type="password" class="input-mail" id="pwd" placeholder="*******">
                    <img src="<?= base_url() ?>assets/images/Hide.svg" alt="pass" class="img-pass" id="hide_eyes">
                    <p class="val_error" id="error_pass_com"></p>
                    <p class="val_error" id="error_login_com"></p>
                </div>
                <div class="quen_pass">
                    <a href="/quen-mat-khau-cong-ty.html">Quên mật khẩu</a>
                </div>
                <button type="submit" name="submit_company" onclick="loginCompany(); return false;" class="dang_nhap" id="login_company">Đăng nhập</button>
            </form>

            <form class="tab-company" onsubmit="login_staff(); return false;" id="staff_login">
                <p class="login-p">Email đăng nhập</p>
                <div class="email">
                    <input type="text" class="input-mail" placeholder="Nhập email của bạn" name="staff_email" id="email_staff">
                    <p class="val_error" id="login_email"></p>
                </div>
                <p class="login-p">Mật khẩu</p>
                <div class="pass">
                    <input type="password" class="input-mail" id="pwd2" placeholder="*******" name="staff_password">
                    <img src="<?= base_url() ?>assets/images/Hide.svg" alt="pass" class="img-pass" id="hide_eyes2">
                    <p class="val_error" id="login_pass"></p>
                    <p class="val_error" id="error_login_staff"></p>
                </div>
                <div class="quen_pass"><a href="/quen-mat-khau-nhan-vien.html">Quên mật khẩu</a>
                    <p class="val_error" id="error_login_staff"></p>
                </div>
                <button type="" name="submit_staff" onclick="login_staff(); return false;" class="dang_nhap" id="login_staff1">Đăng nhập</button>
            </form>
        </div>
    </div>
</div>