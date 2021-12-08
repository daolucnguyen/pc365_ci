<div class="menu-nav" id="header_menu">
    <nav class="navbar navbar-inverse" id="header_nav">
        <ul class="nav navbar-nav navbar-right" id="header_ul">
            <li class="header-li"><a href="/" id="header_link_home" target="_blank">Trang chủ</a></li>
            <li class="header-li"><a href="/gioi-thieu.html" id="header_link_gthieu" target="_blank">Giới thiệu</a></li>
            <li class="header-li"><a href="/huong-dan.html" id="header_link_hdan" target="_blank">Hướng dẫn</a></li>
            <li class="header-li"><a href="/download.html" id="header_link_download" target="_blank">Download</a></li>
            <li class="header-li"><a href="#" id="header_link_news">Tin tức</a></li>
            <li class="header-li">
                <div class="l_curson l_custom_notify l_click_notify" id="header_link_notifi">
                    <img src="<?= base_url() ?>assets/images/notification.svg" alt="notifi" class="menu-header-img" id="menu_notifi" />
                    <?
                    $dem = 0;
                    foreach ($notify as $value) {
                        if ($value['status'] == 2) {
                            $dem++;
                        }
                    }
                    if ($dem > 0) {
                    ?>
                        <img src="<?= base_url() ?>assets/images/notification-dot.png" alt="notifi-dot" id="menu_notifi_dot" />
                    <?
                    }
                    ?>
                </div>
            </li>
            <li class="header-li">
                <div class="l_curson l_custom_notify l_click_chat" id="header_link_notifi">
                    <img src="<?= base_url() ?>assets/images_chat/ic_chat.svg" alt="notifi" class="menu-header-img" id="menu_chat" />
                    <img src="<?= base_url() ?>assets/images/notification-dot.png" alt="notifi-dot" id="menu_chat_dot" />
                </div>
            </li>
            <li class="header-li">
                <div href="#" id="header_link_profile">
                    <img src="<?= $_SESSION['staff']['avatar']; ?>" alt="avatar" class="menu-header-img" id="menu_profile" onerror='this.onerror=null;this.src="<?= base_url() ?>assets/images/staff.svg";'>
                    <!-- <img src="<?= base_url() ?>assets/images/header-profile.png" alt="profile"  /> -->
                </div>
            </li>
        </ul>
    </nav>
    <div class="header-tab">
        <div>
            <a href="/"><img src="<?= base_url() ?>assets/images/logo-menu.png" alt="logo" class="menu-header-img" id="menu_logo" /></a>
        </div>
        <div class="l_flex">
            <div class="l_curson l_custom_notify l_click_notify" id="header_link_notifi">
                <img src="<?= base_url() ?>assets/images/notification.svg" alt="notifi" class="menu-header-img" id="menu_notifi" />
                <?
                $dem = 0;
                foreach ($notify as $value) {
                    if ($value['status'] == 2) {
                        $dem++;
                    }
                }
                if ($dem > 0) {
                ?>
                    <img src="<?= base_url() ?>assets/images/notification-dot.png" alt="notifi-dot" id="menu_notifi_dot" />
                <?
                }
                ?>
            </div>
            <div class="l_curson l_custom_notify l_click_chat" id="header_link_notifi">
                <img src="<?= base_url() ?>assets/images_chat/ic_chat.svg" alt="notifi" class="menu-header-img" id="menu_chat" />
                <img src="<?= base_url() ?>assets/images/notification-dot.png" alt="notifi-dot" id="menu_chat_dot" />
            </div>
            <img src="<?= base_url() ?>assets/images/header-tablet.png" alt="header" class="menu-header-img" id="menu_header" />
        </div>
        <div class="collapse list-menu" id="list_menu_nv">
            <div class="list-menu-tab">
                <div class="list-profile">
                    <a href="">
                        <img src="<?= base_url() ?>assets/images/header-profile.png" alt="avatar">
                        <span><?= $show_info['name']; ?></span>
                    </a>
                    <div class="" style="display: none;"><img src="<?= base_url() ?>assets/images/notification.svg" class="l_click_notify" alt="notification" id="menu_tab_notifi"></div>

                </div>
                <div class="list-menu-control">
                    <a href="/" class="list-menu-control-link" target="_blank">Trang chủ</a>
                    <a href="<?= base_url() ?>/huong-dan.html" class="list-menu-control-link" target="_blank">Hướng dẫn</a>
                    <a href="<?= base_url() ?>/gioi-thieu.html" class="list-menu-control-link" target="_blank">Giới thiệu</a>
                    <a href="<?= base_url() ?>/download.html" class="list-menu-control-link" target="_blank">Download</a>
                    <a href="" class="list-menu-control-link">Tin tức</a>
                </div>
                <div class="list-menu-page">
                    <div class="menu-qly">
                        <img src="<?= base_url() ?>assets/images/logo-menu.png" alt="logo" class="q-menu-logo" />
                        <uv class="nav " id="menu-ul">
                            <li class="nav-item" id="">
                                <img src="<?= base_url() ?>assets/images/Category-active.png" alt="Category" class="menu-img" id="menu_cat_drop">
                                <span><a href="<?= urlQlyChungNv() ?>" class="menu-link " id="link-1-drop">Quản lí chung</a></span>
                            </li>
                            <li class="nav-item">
                                <img src="<?= base_url() ?>assets/images/Scan.png" alt="category" class="menu-img" id="menu_scan_drop">
                                <span><a href="<?= urlQlyChamCong(); ?>" class="menu-link" id="link-2-drop">Quản lí chấm công</a></span>
                            </li>
                            <li class="nav-item">
                                <img src="<?= base_url() ?>assets/images/Location.png" alt="category" class="menu-img" id="menu_location_drop">
                                <span><a href="<?= urlQlyLichTrinh(); ?>" class="menu-link" id="link-3-drop">Quản lí lịch trình</a></span>
                            </li>
                            <li class="nav-item">
                                <img src="<?= base_url() ?>assets/images/Work.png" alt="category" class="menu-img" id="menu_work_drop">
                                <span><a href="<?= urlQlyNhanViec(); ?>" class="menu-link" id="link-4-drop">Nhận việc</a></span>
                            </li>
                            <li class="nav-item item-drop">
                                <img src="<?= base_url() ?>assets/images/Profile.png" alt="category" class="menu-img" id="menu_pro_drop">
                                <span class="menu-link" id="link-5-drop">Quản lí tài khoản</span>
                                <img src="<?= base_url() ?>assets/images/drop-img.png" alt="down" class="img-drop">
                            </li>
                            <ul class="menu-drop l_none">
                                <li class="li-drop"> <span><a href="<?= urlThongTinNV(); ?>" class="menu-drop-link menu-link" id="link-6-drop">Cập nhật thông Tin</a></span> </li>
                                <li class="li-drop"> <span><a href="<?= urlDoiMatKhau(); ?>" class="menu-drop-link menu-link" id="link-7-drop">Đổi mật khẩu</a></span> </li>
                            </ul>
                            <li class="nav-item">
                                <img src="<?= base_url() ?>assets/images/menu-error.png" alt="category" class="menu-img" id="menu_error_drop">
                                <span><a href="<?= urlBaoLoi(); ?>" class="menu-link" id="link-8-drop">Báo lỗi</a></span>
                            </li>
                            <li class="nav-item" id="nv_danhgia1" data-toggle="modal" data-target="#modal_danhgia_nv">
                                <img src="<?= base_url() ?>assets/images/Star.png" alt="category" class="menu-img" id="menu_star_drop">
                                <span class="menu-link" id="link-9-drop">Đánh giá</span>
                            </li>
                            <li class="nav-item">
                                <div data-toggle="modal" data-target="#exampleModalLogoutStaff">
                                    <img src="<?= base_url() ?>assets/images/Logout.png" alt="category" class="menu-img" id="menu_logout_drop">
                                    <span class="menu-link" id="link-10-drop">Đăng xuất</span>
                                </div>
                            </li>
                        </uv>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <? require_once APPPATH . '/views/includes/inc_notify_staff.php'; ?>
    <? require_once APPPATH . '/views/includes/inc_chat_staff.php'; ?>
</div>