<style>
    .l_dmk,#link-7-drop {
        color: #206AA9;
    }
    .l_hide,.l_none{
        display: block;
    }
</style>
<div class="q-right-doimk" id="right_nv">
    <div class="q-right-title" id="right_title">
        <p>Đổi Mật Khẩu</p>
        <div id="alert"></div>
    </div>
    <div class="q-cty-doimk">
        <form method="POST" class="q-cty-doimk-form" id="updatePass">
            <div class="q-cty-doimk-row">
                <div class="q-cty-doimk-row-control">
                    <p class="q-cty-update-row-label">Mật khẩu cũ:</p>
                    <input type="password" name="" id="cty_old_pass" class="q-cty-update-row-input" placeholder="Tối thiểu 6 kí tự">
                    <img src="<?= base_url() ?>assets/images/Hide.png" alt="show" class="q-cty-doimk-icon" id="show_pass1">
                    <p class="val_error" id="val_dmk_old"></p>
                </div>
                <div class="q-cty-doimk-row-control">
                    <p class="q-cty-update-row-label">Mật khẩu mới:</p>
                    <input type="password" name="new_pass" id="cty_new_pass" class="q-cty-update-row-input" placeholder="Tối thiểu 6 kí tự">
                    <img src="<?= base_url() ?>assets/images/Hide.png" alt="show" class="q-cty-doimk-icon" id="show_pass2">
                    <p class="val_error" id="val_dmk_new"></p>
                </div>
                <div class="q-cty-doimk-row-control">
                    <p class="q-cty-update-row-label">Nhập lại mật khẩu:</p>
                    <input type="password" name="" id="cty_re_new_pass" class="q-cty-update-row-input" placeholder="Tối thiểu 6 kí tự">
                    <img src="<?= base_url() ?>assets/images/Hide.png" alt="show" class="q-cty-doimk-icon" id="show_pass3">
                    <p class="val_error" id="val_dmk_renew"></p>
                </div>
            </div>
            <div class="q-cty-update-button q-cty-doimk-button">
                <input type="reset" name="reform-nv-update" class="reform-nv-update reform-cty-update" value="Nhập Lại"></input>
                <button type="submit" name="submit-cty-doimk" class="submit-nv-updade submit-cty-updade"><span>Cập nhật thông tin</span></button>
            </div>
        </form>
    </div>
</div>