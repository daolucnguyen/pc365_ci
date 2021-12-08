<header>
    <div class="header1">
        <div class="header2 l_header">
            <!-- <div class="header2-v">
                <div class="header-tab">
                    <img src="<?= base_url(); ?>assets/images/menu.svg" alt="menu" id="l_img" class="menu-tab_left">
                    <div class="l_list-menu1" id="list_menu1">
                        <div class="d-sidebar-left">
                            <div class="l-sidebar-left-img2">
                                <img src="<?= base_url() . $detail_company['com_avatar'] ?>" alt="ten" class="d-img-home2" onerror='this.onerror=null;this.src="<?= base_url(); ?>assets/images/avt_login.svg";'>
                            </div>
                            <p class="d-sidebar-left-p l_user_name"><?= $detail_company['com_name'] ?></p>
                            <div>
                                <a href="/" class="l_home trang_chu">Trang chủ</a>
                            </div>
                            <div>
                                <a href="/gioi-thieu.html" class="l_home gioi_thieu">Giới thiệu</a>
                            </div>
                            <div>
                                <a href="/huong-dan.html" class="l_home hương_dan">Hướng dẫn</a>
                            </div>
                            <div>
                                <a href="/download.html" class="l_home download">Download</a>
                            </div>
                            <div>
                                <a href="#" class="l_home tin_tuc">Tin tức</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="header2-v1">
                <div class="header2-v1a">
                    <a href="/" class="header-home"><img src="<?= base_url(); ?>assets/images/img_company.svg" alt="home" class="header-home-img"></a>
                </div>
                <div class="header2-v1a"><a href="/" class="home-a trang_chu">Trang chủ</a></div>
                <div class="header2-v1a"><a href="/gioi-thieu.html" class="home-a gioi_thieu">Giới thiệu</a></div>
                <div class="header2-v1a"><a href="/huong-dan.html" class="home-a hương_dan">Hướng dẫn</a></div>
                <div class="header2-v1a"><a href="/download.html" class="home-a download">Download</a></div>
                <div class="header2-v1a"><a href="#" class="home-a tin_tuc">Tin tức</a></div>
            </div>
            <div class="header2-v2">
                    <div class="notify notify_company" id="notify_company">
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
                    
                    <div class="l_curson l_chat_company l_click_chat" id="header_link_notifi">
                        <img src="<?= base_url() ?>assets/images_chat/ic_chat.svg" alt="notifi" class="menu-header-img" id="menu_chat" />
                        <img src="<?= base_url() ?>assets/images/notification-dot.png" alt="notifi-dot" class="l_dot_chat" id="menu_chat_dot" />
                    </div>
                <div class="header2-v3">
                    <img src="<?= $_SESSION['company']['avatar'] ?>" alt="ten" class="avt-login" onerror='this.onerror=null;this.src="<?= base_url(); ?>assets/images/avt_login.svg";'>
                    <h2 class="name-staff"><?= $_SESSION['company']['name'] ?></h2>
                </div>
                <div class="header-tab">
                    <img src="<?= base_url(); ?>assets/images/menu.svg" id="l_img_sidebar" alt="menu" class="menu-tab">
                    
                    <div class="list-menu" id="list_menu">
                        <?
                        include APPPATH . '/views/includes/sidebar_left_cty.php';
                        ?>
                    </div>
                </div>
            </div>
            <?
            include APPPATH . '/views/includes/inc_notify_company.php';
            ?>
        </div>
    </div>
</header>