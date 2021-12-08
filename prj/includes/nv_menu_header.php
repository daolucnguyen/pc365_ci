<div class="menu-nav" id="header_menu">
    <nav class="navbar navbar-inverse" id="header_nav">
        <ul class="nav navbar-nav navbar-right" id="header_ul">
            <li class="header-li"><a href="/" id="header_link_home">Trang chủ</a></li>
            <li class="header-li"><a href="/gioi-thieu.html" id="header_link_gthieu">Giới thiệu</a></li>
            <li class="header-li"><a href="/huong-dan.html" id="header_link_hdan">Hướng dẫn</a></li>
            <li class="header-li"><a href="/download.html" id="header_link_download">Download</a></li>
            <li class="header-li"><a href="" id="header_link_news">Tin tức</a></li>
            <li class="header-li"><a href="" id="header_link_notifi">
                <img src="../images/notification.png" alt="notifi" class="menu-header-img" id="menu_notifi" />
                <img src="../images/notification-dot.png" alt="notifi-dot" id="menu_notifi_dot" />
                </a></li>
            <li class="header-li">
                <a href="#" id="header_link_profile">
                    <img src="../images/header-profile.png" alt="profile" class="menu-header-img" id="menu_profile" />
                </a>
            </li>
        </ul>
    </nav>
    <div class="header-tab">
        <a href=""><img src="../images/logo-menu.png" alt="logo" class="menu-header-img" id="menu_logo" /></a>
        <img src="../images/header-tablet.png" alt="header" class="menu-header-img" id="menu_header" data-toggle="collapse" data-target="#list_menu_nv"/>
        <div class="collapse list-menu" id="list_menu_nv">
            <div class="list-menu-tab">
                <div class="list-profile">
                    <a href="">
                        <img src="../images/header-profile.png" alt="avatar">
                        <span>name</span>
                    </a>
                    <a href=""><img src="../images/Notification.png" alt="notification" id="menu_tab_notifi"></a>
                    
                </div>
                <div class="list-menu-control">
                    <a href="/" class="list-menu-control-link">Trang chủ</a>
                    <a href="/huong-dan.html" class="list-menu-control-link">Hướng dẫn</a>
                    <a href="/gioi-thieu.html" class="list-menu-control-link">Giới thiệu</a>
                    <a href="/download.html" class="list-menu-control-link">Download</a>
                    <a href="" class="list-menu-control-link">Tin tức</a>
                </div>
                <div class="list-menu-page">
                <div class="menu-qly">
                    <img src="../images/logo-menu.png" alt="logo" class="q-menu-logo" />
                    <uv class="nav " id="menu-ul">
                        <li class="nav-item" id="">
                            <img src="../images/Category-active.png" alt="Category" class="menu-img" id="menu_cat_drop">
                            <span><a href="/danh-cho-nhan-vien/quan-ly-chung.html" class="menu-link " id="link-1-drop">Quản lí chung</a></span>
                        </li>
                        <li class="nav-item">
                            <img src="../images/Scan.png" alt="category" class="menu-img" id="menu_scan_drop">
                            <span><a href="/danh-cho-nhan-vien/quan-ly-cham-cong.html" class="menu-link" id="link-2-drop">Quản lí chấm công</a></span>
                        </li>
                        <li class="nav-item">
                            <img src="../images/Location.png" alt="category" class="menu-img" id="menu_location_drop">
                            <span><a href="/danh-cho-nhan-vien/quan-ly-lich-trinh.html" class="menu-link" id="link-3-drop">Quản lí lịch trình</a></span>
                        </li>
                        <li class="nav-item">
                            <img src="../images/Work.png" alt="category" class="menu-img" id="menu_work_drop">
                            <span><a href="/danh-cho-nhan-vien/nhan-viec.html" class="menu-link" id="link-4-drop">Nhận việc</a></span>
                        </li>
                        <li class="nav-item item-drop">
                            <img src="../images/Profile.png" alt="category" class="menu-img" id="menu_pro_drop">
                            <span class="menu-link" id="link-5-drop">Quản lí tài khoản</span>
                            <img src="../images/drop-img.png" alt="down" class="img-drop">
                        </li>
                        <ul class="menu-drop hide">
                            <li class="li-drop"> <span ><a href="/danh-cho-nhan-vien/cap-nhat-thong-tin.html" class="menu-drop-link menu-link" id="link-6-drop">Cập nhật thông Tin</a></span> </li>
                            <li class="li-drop"> <span ><a href="/danh-cho-nhan-vien/doi-mat-khau.html" class="menu-drop-link menu-link" id="link-7-drop">Đổi mật khẩu</a></span> </li>
                        </ul>
                        <li class="nav-item">
                            <img src="../images/menu-error.png" alt="category" class="menu-img" id="menu_error_drop">
                            <span><a href="/danh-cho-nhan-vien/bao-loi.html" class="menu-link" id="link-8-drop">Báo lỗi</a></span>
                        </li>
                        <li class="nav-item" id="nv_danhgia" data-toggle="modal" data-target="#modal_danhgia">
                            <img src="../images/Star.png" alt="category" class="menu-img" id="menu_star_drop">
                            <span class="menu-link" id="link-9-drop">Đánh giá</span>
                        </li>
                        <li class="nav-item">
                            <img src="../images/Logout.png" alt="category" class="menu-img" id="menu_logout_drop">
                            <span><a href="" class="menu-link" id="link-10-drop">Đăng xuất</a></span>
                        </li>
                    </uv>
                </div>
            </div>
        </div>
        </div>
    </div>

</div>
<?php include '../includes/inc_danhgia.php'; ?>