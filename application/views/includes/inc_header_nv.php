<header>
    <div class="header1">
        <div class="header2">
            <div class="header2-v1">
                <div class="header2-v1a">
                    <a href="/" class="header-home"><img src="<?= base_url() ?>assets/images/img_company.svg" alt="home" class="header-home-img"></a>
                </div>
                <div class="header2-v1a"><a href="/" class="home-a trang_chu">Trang chủ</a></div>
                <div class="header2-v1a"><a href="gioi-thieu.html" class="home-a gioi_thieu">Giới thiệu</a></div>
                <div class="header2-v1a"><a href="huong-dan.html" class="home-a huong_dan">Hướng dẫn</a></div>
                <div class="header2-v1a"><a href="download.html" class="home-a download">Download</a></div>
                <div class="header2-v1a"><a href="#" class="home-a tin_tuc">Tin tức</a></div>
            </div>
            <div class="header2-v2">
                <?
                if ($session == 0 || !isset($session)) {
                ?>
                    <div class="header2-v3 l_none">
                        <div class="sign-in"><a href="/dang-nhap.html" class="login-a">Đăng nhập</a></div>
                        <div class="sign-up"><a href="<?= urlDangKy() ?>" class="signup-a">Đăng ký</a></div>
                    </div>
                    <div class="header-tab">
                        <img src="<?= base_url() ?>assets/images/menu.svg" alt="menu" id="img_list_menu_tt" class="menu-tab">
                        <div class="list-menu" id="list_menu_tt">
                            <div class="list-menu-v2">
                                <div class="collapse-link-div"><a href="/" class="collapse-link">Trang chủ</a></div>
                                <div class="collapse-link-div" id="div_odd"><a href="/gioi-thieu.html" class="collapse-link">Giới thiệu</a></div>
                                <div class="collapse-link-div"><a href="/huong-dan.html" class="collapse-link">Hướng dẫn</a></div>
                                <div class="collapse-link-div" id="div_odd"><a href="/download.html" class="collapse-link">Download</a></div>
                                <div class="collapse-link-div"><a href="#" class="collapse-link">Tin tức</a></div>
                            </div>
                            <hr class="collapse-hr">
                            <div class="collapse-button">
                                <a href="dang-nhap.html" class="collapse-button-v2">Đăng nhập</a>
                                <a href="<?= urlDangKy() ?>" class="collapse-button-v2">Đăng ký</a>
                            </div>
                        </div>
                    </div>
                <?
                } else {
                ?>
                    <div class="header2-v3">
                        <img src="<?= $avatar ?>" alt="ten" class="avt-login l_cursor l_show_menu" onerror='this.onerror=null;this.src="<?= base_url() ?>assets/images/avt_login.svg";'>
                        <h2 class="name-staff l_none l_show_menu"><?= $name ?></h2>
                        <img src="<?= base_url() ?>assets/images/menu_down.svg" alt="home" class="l_img_menu_down l_cursor l_show_menu">
                    </div>
                    <div class="list-menu" id="menu_sau_dn">
                        <div class="l_none_dropdown">
                            <div class="l_img">
                                <div class="l_border_img">
                                    <img src="<?= base_url().$avatar ?>" alt="ten" class="l_avt-login" onerror='this.onerror=null;this.src="<?= base_url() ?>assets/images/avt_login.svg";'>
                                </div>
                                <h2 class="l_name_user"><?= $name ?></h2>
                            </div>
                            <a href="/" class="collapse-link">
                                <div class="l_flex">

                                    <div>
                                        <p class="l_text">Trang chủ</p>
                                    </div>
                                </div>
                            </a>
                            <a href="/gioi-thieu.html" class="collapse-link">
                                <div class="l_flex">

                                    <div>
                                        <p class="l_text">Giới thiệu</p>
                                    </div>
                                </div>
                            </a>
                            <a href="/huong-dan.html" class="collapse-link">
                                <div class="l_flex">

                                    <div>
                                        <p class="l_text">Hướng dẫn</p>
                                    </div>
                                </div>
                            </a>
                            <a href="/download.html" class="collapse-link">
                                <div class="l_flex">
                                    <div>
                                        <p class="l_text">Download</p>
                                    </div>
                                </div>
                            </a>
                            <a href="javascript:void(0)" class="collapse-link">
                                <div class="l_flex">

                                    <div>
                                        <p class="l_text">Tin tức</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <a href="<?
                            if (isset($_SESSION['company'])) {
                                echo urlQlyCty();
                            }
                            if (isset($_SESSION['staff'])) {
                                echo urlQlyChungNv();
                            }
                        ?>" class="collapse-link">
                            <div class="l_flex">
                                <div>
                                    <p class="l_text">Quản lý chung</p>
                                </div>
                            </div>
                        </a>
                        <a href="<?= urlDangXuatCty();?>" class="collapse-link">
                            <div class="l_flex">
                                <div>
                                    <p class="l_text">Đăng xuất</p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?
                }
                ?>
            </div>
        </div>
    </div>
</header>