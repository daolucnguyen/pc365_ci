<style>
    .l_cntn,#link-6-drop {
        color: #206AA9;
    }
    .l_hide,.l_none{
        display: block;
    }
</style>
<div class="q-right-update" id="right_update">
    <div class="q-right-title" id="right_title">
        <div id="alert"></div>
        <p>Cập Nhật Thông Tin Nhân Viên</p>
    </div>
    <div class="q-right-nv-update">
        <div class="q-nv-avatar-update">
            <img src="<?= $_SESSION['staff']['avatar'] ?>" alt="avatar" class="q-nv-update-avatar" id="staff_avatar" onerror='this.onerror=null;this.src="<?= base_url() ?>assets/images/staff.svg";'>
            <img src="<?= base_url() ?>assets/images/staff-update-avatar.svg" alt="" class="q-nv-update-icon">
        </div>
        <p class="val_error" id="staff_update_avatar"></p>
        <form action="" class="q-nv-update-form" method="POST" id="update_staff">
            <input type="file" name="input_avatar" id="input_avatar" class="q-nv-avatar-input"  accept="image/*" onchange="changeImg(this)">
            <div class="q-nv-form-control">
                <label for="" class="q-nv-update-label">Tên nhân sự:</label>
                <input type="text" name="name_staff" id="update_name" value="<?= $_SESSION['staff']['name'] ?>" class="q-nv-update-input" placeholder="Mời bạn nhập họ tên">
                <p class="val_error" id="val_update_name"></p>
            </div>

            <div class="q-nv-form-control">
                <label for="" class="q-nv-update-label">Số điện thoại:</label>
                <input type="text" name="phone_staff" id="update_phone" value="<?= $_SESSION['staff']['ep_phone'] ?>" class="q-nv-update-input" placeholder="Số điện thoại liên lạc của nhân viên" oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g, '$1')">
                <p class="val_error" id="val_update_phone"></p>
            </div>

            <!-- <div class="q-nv-form-control">
                <label for="" class="q-nv-update-label">Chức vụ đang nắm giữ:</label>
                <select class="q-nv-update-input" name="position" id="update_chucvu">
                    <option class="q-nv-update-choice" value="">Lựa chọn chức vụ</option>
                    <option class="q-nv-update-choice" value=""></option>
                    <option class="q-nv-update-choice" value=""></option>
                    <option class="q-nv-update-choice" value=""></option>
                </select>
                <p class="val_error" id="val_update_chucvu"></p>
            </div>

            <div class="q-nv-form-control">
                <label for="" class="q-nv-update-label">Phòng/ ban làm việc</label>
                <select class="q-nv-update-input" name="department" id="update_phongban">
                    <option class="q-nv-update-choice" value="">Lựa chọn phòng/ ban làm việc</option>
                    <option class="q-nv-update-choice" value=""></option>
                    <option class="q-nv-update-choice" value=""></option>
                    <option class="q-nv-update-choice" value=""></option>
                </select>
                <p class="val_error" id="val_update_phongban"></p>
            </div> -->
            <div class="q-nv-update-button">
                <input type="reset" name="reform-nv-update" class="reform-nv-update" value="Nhập Lại"></input>
                <button type="submit" name="submit-nv-updade" class="submit-nv-updade"><span>Cập nhật thông tin</span></button>
            </div>
        </form>
    </div>
</div>