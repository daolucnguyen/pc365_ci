<div class="d-sidebar-left">
    <div class="d-sidebar-left-img">
        <a href="/"><img src="<?= base_url() ?>assets/images/img_company.svg" alt="home" class="d-img-home"></a>
    </div>
    <div class="l_option">
        <div class="">
            <div class="l_flex_sidebar">
                <div class="l-sidebar-left-img2">
                    <div class="com_name">
                        <img src="<?= $_SESSION['company']['avatar'] ?>" alt="ten" class="d-img-home2" onerror='this.onerror=null;this.src="<?= base_url(); ?>assets/images/avt_login.svg";'>
                        <p class="d-sidebar-left-p l_user_name"><?= $_SESSION['company']['name'] ?></p>
                    </div>
                </div>
                <div class="notify notify_company" id="notify_company" style="display: none;">
                    <img src="<?= base_url(); ?>assets/images/notification.svg" alt="thông báo" class="notify-img">
                    <?
                    $dem = 0;
                    foreach ($notify as $value) {
                        if ($value['status'] == 2) {
                            $dem++;
                        }
                    }
                    if ($dem > 0) {
                    ?>
                        <img src="<?= base_url() ?>assets/images/notification-dot.png" class="l_dot_notify" alt="notifi-dot" id="menu_notifi_dot" />
                    <?
                    }
                    ?>
                </div>
                <div class="l_curson l_chat_company l_click_chat" id="header_link_notifi"  style="display: none;">
                    <img src="<?= base_url() ?>assets/images_chat/ic_chat.svg" alt="notifi" class="menu-header-img" id="menu_chat" />
                    <img src="<?= base_url() ?>assets/images/notification-dot.png" alt="notifi-dot" id="menu_chat_dot" />
                </div>
            </div>
            <div class="l_flex_sidebar l_border_none">
                <a href="/" class="l_home trang_chu">Trang chủ</a>

                <a href="/gioi-thieu.html" class="l_home gioi_thieu">Giới thiệu</a>
            </div>
            <div class="l_flex_sidebar l_border_none">
                <a href="/huong-dan.html" class="l_home hương_dan">Hướng dẫn</a>

                <a href="/download.html" class="l_home download">Download</a>
            </div>
            <div class="l_flex_sidebar l_border_none">
                <a href="#" class="l_home tin_tuc">Tin tức</a>
            </div>
        </div>
    </div>
    <div>
        <a href="<?= urlQlyCty(); ?>" class="d-sidebar-left1">
            <p class="d-sidebar-left-img0"></p>
            <p class="d-sidebar-left-p ql_chung">Quản lí chung</p>
        </a>
    </div>
    <div>
        <a href="<?= urlQlyChamCongCty(); ?>" class="d-sidebar-left1">
            <p class="d-sidebar-left-img1"></p>
            <p class="d-sidebar-left-p ql_chamcong">Quản lí chấm công</p>
        </a>
    </div>
    <div>
        <a href="<?= urlFace(); ?>" class="d-sidebar-left1">
            <p class="d-sidebar-left-img1"></p>
            <p class="d-sidebar-left-p ql_face">Quản lí nhận diện khuôn mặt</p>
        </a>
    </div>
    <div>
        <a href="<?= urlQlyNhanVienCtyActive(1); ?>" class="d-sidebar-left1">
            <p class="d-sidebar-left-img2"></p>
            <p class="d-sidebar-left-p ql_nhanvien">Quản lí nhân viên</p>
        </a>
    </div>
    <div>
        <a href="<?= urlQlyLichTrinhCty(); ?>" class="d-sidebar-left1">
            <p class="d-sidebar-left-img3"></p>
            <p class="d-sidebar-left-p ql_lichtrinh">Lịch trình nhân viên</p>
        </a>
    </div>
    <div>
        <a href="<?= urlQlyGiaoViecCty(); ?>" class="d-sidebar-left1">
            <p class="d-sidebar-left-img4"></p>
            <p class="d-sidebar-left-p ql_giaoviec">Giao việc</p>
        </a>
    </div>
    <div>
        <div class="d-sidebar-left1 l_show1">
            <p class="d-sidebar-left-img5"></p>
            <p class="d-sidebar-left-p d-sidebar-left-p1 ql_cty">Quản lí công ty</p>
        </div>
        <div class="menu-manager1 l_drop1" id="menu-manager1">
            <div class="d-menu-qly-cy">
                <a href="<?= urlQlyDanhSachCtyCon(); ?>" class="d-menu-quan-ly-cty ql_cty_con">Danh sách công ty con</a>
            </div>
            <div class="d-menu-qly-cy">
                <a href="<?= urlQlyDanhSachPhongBan(); ?>" class="d-menu-quan-ly-cty ql_phongban">Cấu trúc phòng ban</a>
            </div>
            <div class="d-menu-qly-cy">
                <a href="<?= urlQlyQuyenTruyCap(); ?>" class="d-menu-quan-ly-cty ql_phanquyen">Phân quyền</a>
            </div>
        </div>
    </div>
    <div>
        <div class="d-sidebar-left1 l_show1">
            <p class="d-sidebar-left-img6"></p>
            <p class="d-sidebar-left-p d-sidebar-left-p1 ql_cong">Cài đặt tính công</p>
        </div>
        <div class="menu-manager1 l_drop1" id="menu-manager2">
            <div class="d-menu-qly-cy">
                <a href="<?= urlCauHinhChamCong(); ?>" class="d-menu-quan-ly-cty cauhinhchamcong">Cấu hình chấm công</a>
            </div>
            <div class="d-menu-qly-cy">
                <a href="<?= urlDsCaLamViec(); ?>" class="d-menu-quan-ly-cty ds_calam">Danh sách ca làm</a>
            </div>
            <!-- <div class="d-menu-qly-cy">
                <a href="<?= urlDslichLamViec(); ?>" class="d-menu-quan-ly-cty ds_lichlamviec">Danh sách lịch làm việc</a>
            </div>
            <div class="d-menu-qly-cy">
                <a href="<?= urlLichLamViecNvCty(); ?>" class="d-menu-quan-ly-cty llv_nv">Lịch làm việc của nhân viên</a>
            </div> -->
        </div>
    </div>
    <div>
        <div class="d-sidebar-left1 l_show1">
            <p class="d-sidebar-left-img7"></p>
            <p class="d-sidebar-left-p d-sidebar-left-p1 ql_tk">Quản lí tài khoản</p>
        </div>
        <div class="menu-manager1 l_drop1" id="menu-manager3">
            <div class="d-menu-qly-cy">
                <a href="<?= urlThongTinCty(); ?>" class="d-menu-quan-ly-cty capnhatthongtin">Cập nhật thông tin</a>
            </div>
            <div class="d-menu-qly-cy">
                <a href="<?= urlDoiMatKhauCty(); ?>" class="d-menu-quan-ly-cty doimatkhau">Đổi mật khẩu</a>
            </div>
        </div>
    </div>
    <div>
        <a href="<?= urlBaoLoiCty(); ?>" class="d-sidebar-left1">
            <p class="d-sidebar-left-img8"></p>
            <p class="d-sidebar-left-p baoloi">Báo lỗi</p>
        </a>
    </div>
    <div>
        <a class="d-sidebar-left1" id="danhgia_modal" data-toggle="modal" data-target="#modal_danhgia">
            <p class="d-sidebar-left-img9"></p>
            <p class="d-sidebar-left-p">Đánh giá</p>
        </a>
    </div>
    <div>
        <div href="" class="d-sidebar-left1" data-toggle="modal" data-target="#exampleModalLogout">
            <p class="d-sidebar-left-img10"></p>
            <p class="d-sidebar-left-p">Đăng xuất</p>
        </div>
    </div>
</div>