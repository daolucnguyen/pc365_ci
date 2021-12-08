<style>
    .l_cntn,#link-6-drop {
        color: #206AA9;
    }
    .l_hide,.l_none{
        display: block;
    }
</style>
<div class="q-right-nv" id="right_nv">
    <div class="q-right-title" id="right_title">
        <p>Chi tiết nhân viên</p>
    </div>
    <div class="q-right-nv-details">
        <div class="q-nv-modify ">
            <div class="q-nv-modyfi-dot"></div>
            <div class="q-nv-modyfi-dot"></div>
            <div class="q-nv-modyfi-dot"></div>
        </div>
        <div class="q-nv-choice hide">
            <a href="<?= urlCapNhatThongTinNV(); ?>" class="q-nv-option">Cập nhật</a>
            <!-- <a href="" class="q-nv-option">Xóa</a> -->
            <a href="" class="q-nv-option">Mã QR</a>

        </div>
        <div class="q-nv-avatar">
            <img src="<?= $_SESSION['staff']['avatar'] ?>" alt="avatar" onerror='this.onerror=null;this.src="<?= base_url() ?>assets/images/staff.svg";'>
        </div>
        <div class="q-nv-qr">
            <img src="<?= base_url() ?>assets/images/cty-qr.png" alt="qr">

        </div>
        <div class="q-nv-des">
            <p class="q-nv-name q-nv-id">(<?= $_SESSION['staff']['id'] ?>) <?= $_SESSION['staff']['name'] ?></p>
            <p class="q-nv-vitri"><?= $_SESSION['staff']['dep_name'] ?></p>
            <div class="q-nv-info">
                <div class="q-nv-info-list">
                    <img src="<?= base_url() ?>assets/images/dot.png" alt="dot">
                    <p>Email:<span class="q-nv-info-span"><?= $_SESSION['staff']['email'] ?></span></p>
                </div>
                <div class="q-nv-info-list">
                    <img src="<?= base_url() ?>assets/images/dot.png" alt="dot">
                    <div class=" l_flex">
                        <div class="l_custom_com">Tên công ty: </div>
                        <div class="q-nv-info-span"><?= $_SESSION['staff']['com_name'] ?></div>
                    </div>
                </div>
                <div class="q-nv-info-list">
                    <img src="<?= base_url() ?>assets/images/dot.png" alt="dot">
                    <p>SĐT:<span class="q-nv-info-span"><?= $_SESSION['staff']['ep_phone'] ?></span></p>
                </div>
                <div class="q-nv-info-list">
                    <img src="<?= base_url() ?>assets/images/dot.png" alt="dot">
                    <p>Mật khẩu:<span class="q-nv-info-span">******</span></p>
                </div>
            </div>
        </div>
    </div>
</div>