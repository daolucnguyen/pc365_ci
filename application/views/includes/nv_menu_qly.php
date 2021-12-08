<div class="q-menu-sidebar">
    <div class="menu-qly">
        <a href="/"><img src="<?= base_url() ?>assets/images/logo-menu.png" alt="logo" class="q-menu-logo" /></a>
        <uv class="nav " id="menu-ul">
            <li class="nav-item q-nav-item" id="li_qlychung">
                <div class="menu-img" id="menu_cat">
                    <span><a href="<?= urlQlyChungNv(); ?>" class="menu-link " id="link-1">Quản lí chung</a></span>
                </div>
            </li>
            <li class="nav-item q-nav-item" id="li_chamcong">
                <div class="menu-img" id="menu_scan">
                    <span><a href="<?= urlQlyChamCong(); ?>" class="menu-link" id="link-2">Quản lí chấm công</a></span>
                </div>
            </li>
            <li class="nav-item q-nav-item" id="li_lichtrinh">
                <div class="menu-img" id="menu_location">
                    <span><a href="<?= urlQlyLichTrinh(); ?>" class="menu-link" id="link-3">Quản lí lịch trình</a></span>
                </div>
            </li>
            <li class="nav-item q-nav-item" id="li_nhanviec">
                <div class="menu-img" id="menu_work">
                    <span><a href="<?= urlQlyNhanViec(); ?>" class="menu-link" id="link-4">Nhận việc</a></span>
                </div>
            </li>
            <li class="nav-item q-nav-item item-drop" id="li_qlytaikhoan">
                <div class="menu-img" id="menu_pro">
                    <span class="menu-link" id="link-5">Quản lí tài khoản</span>
                    <img src="<?= base_url() ?>/assets/images/drop-img.png" alt="down" class="img-drop">
                </div>
            </li>
            <ul class="menu-drop1 l_hide">
                <li class="li-drop"> <span><a href="<?= urlThongTinNV(); ?>" class="menu-drop-link menu-link l_cntn" id="link-6">Cập nhật thông Tin</a></span> </li>
                <li class="li-drop"> <span><a href="<?= urlDoiMatKhau(); ?>" class="menu-drop-link menu-link l_dmk" id="link-7">Đổi mật khẩu</a></span> </li>
            </ul>
            <li class="nav-item q-nav-item" id="li_baoloi">
                <div class="menu-img" id="menu_error">
                    <span><a href="<?= urlBaoLoi(); ?>" class="menu-link" id="link-8">Báo lỗi</a></span>
                </div>
            </li>
            <li class="nav-item q-nav-item" id="nv_danhgia" data-toggle="modal" data-target="#modal_danhgia_nv">
                <div class="menu-img" id="menu_star">
                    <span>
                        <p class="menu-link" id="link-9">Đánh giá</p>
                    </span>
                </div>
            </li>
            <li class="nav-item q-nav-item">
                <div class="menu-img l_curson" id="menu_logout" data-toggle="modal" data-target="#exampleModalLogoutStaff">
                    <span>
                        <div class="menu-link" id="link-10">Đăng xuất</div>
                    </span>
                </div>
            </li>
        </uv>
    </div>
</div>