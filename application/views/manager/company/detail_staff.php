<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết Nhân viên</title>

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/quan_ly_cty.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/cty_qly.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-125014721-1');
    </script>
    <style>
        .ql_nhanvien {
            color: #206AA9;
        }

        .q-qly-cty-thongtin-collapse-div {
            position: absolute;
            right: 3px;
            top: 27px;
            background: #FFFFFF;
            box-shadow: 0px 4px 40px rgb(0 0 0 / 5%);
            border-radius: 5px;
            padding: 10px;
            z-index: 1;
            width: 85px;
            display: none;

        }

        .l_hover_option:hover ul {
            color: red;
        }

        @media only screen and (max-width: 1025px) {
            .q-qly-cty-thongtin {
                height: 286px;
            }
        }
        @media only screen and (max-width: 767.9px) {
            .q-qly-cty-thongtin {
                height: 444px;
            }
            .q-qly-cty-info-v2{
                bottom: 80px;
            }
        }
    </style>
</head>

<body>
    <div class="d-quan-ly-cty">
        <div class="l_block_sidebar">
            <?php require_once APPPATH . '/views/includes/sidebar_left_cty.php'; ?>
        </div>
        <div class="d-quan-ly-cty1">
            <?php require_once APPPATH . "/views/includes/header_manager.php"; ?>
            <div class="d-qly-cty1-v1">
                <h3 class="q-qly-thongtin-title">Chi Tiết Nhân Viên</h3>
                <div id="alert"></div>
                <div class="q-qly-cty-thongtin">
                    <div class="q-qly-cty-avatar">
                        <img class="q-qly-cty-avatar-v2" src="https://chamcong.24hpay.vn/upload/employee/<?= $staff->ep_image ?>" alt="<?= $staff->ep_name ?>" onerror='this.onerror=null;this.src="<? base_url() ?>/images_staff/avatar_default.png";'>
                    </div>
                    <div class="q-qly-cty-qr">

                    </div>
                    <div class="q-qly-cty-info">
                        <p class="q-qly-cty-name"><?= $staff->ep_name ?></p>
                        <p class="q-qly-cty-id">id: <?= $staff->ep_id ?></p>

                        <ul class="q-qly-cty-thongtin-collapse l_hover_option l_curson">
                            <img src="<?= base_url() ?>assets/images/dot-collapse.png" alt="dot" data-toggle="collapse" data-target="cty_collapse" class="q-qly-cty-thongtin-collapse-img">
                            <div class="q-qly-cty-thongtin-collapse-div">
                                <div class="q-qly-cty-thongtin-collapse-div-v2">
                                    <!-- <a href="</?= urlCapNhatThongTinCty() ?>" class="q-qly-cty-thongtin-collapse-link">Sửa</a>
                                <a href="" class="q-qly-cty-thongtin-collapse-link">Xóa</a>
                                <a href="" class="q-qly-cty-thongtin-collapse-link" id="cty_collapse_qr">Mã QR</a> -->
                                    <div class="q-qly-cty-thongtin-collapse-link" data-toggle="modal" data-target='#update_nv' onclick="getInfoStaff(<?= $staff->ep_id ?>)" id="update_staff">Cập nhật</div>
                                    <div onclick="deleteActive(<?= $staff->ep_id ?>);" class="q-qly-cty-thongtin-collapse-link" name="<?= $staff->ep_id ?>">Xóa</div>
                                </div>
                            </div>
                        </ul>

                    </div>
                    <div class="q-qly-cty-info-v2">
                        <div class="q-qly-cty-row">
                            <div class="q-qly-cty-row-dot"></div>
                            <p class="q-qly-cty-row-tite">Email: </p>
                            <p class="q-qly-cty-row-info" id="cty_email"><?= $staff->ep_email ?> </p>
                        </div>
                        <div class="q-qly-cty-row">
                            <div class="q-qly-cty-row-dot"></div>
                            <p class="q-qly-cty-row-tite">Tên công ty: </p>
                            <p class="q-qly-cty-row-info" id="cty_address">
                                <?
                                
                                    foreach ($company_small as $value) {
                                        if ($value->com_id == $staff->com_id) {
                                            echo $value->com_name;
                                        }
                                    }
                                ?>
                            </p>
                        </div>
                        <div class="q-qly-cty-row">
                            <div class="q-qly-cty-row-dot"></div>
                            <p class="q-qly-cty-row-tite">SĐT: </p>
                            <p class="q-qly-cty-row-info" id="cty_phone"><?= $staff->ep_phone ?></p>
                        </div>
                        <div class="q-qly-cty-row">
                            <div class="q-qly-cty-row-dot"></div>
                            <p class="q-qly-cty-row-tite">Mật khẩu: </p>
                            <p class="q-qly-cty-row-info" id="cty_phone">********</p>
                        </div>
                        <div class="q-qly-cty-row">
                            <div class="q-qly-cty-row-dot"></div>
                            <p class="q-qly-cty-row-tite">Quyền truy cập: </p>
                            <p class="q-qly-cty-row-info" id="cty_phone"><?
                                                                            foreach ($quyen as $key => $value) {
                                                                                if ($staff->role_id == $key) {
                                                                                    echo $value;
                                                                                }
                                                                            }
                                                                            ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- sửa nhân viên -->
    <div class="modal fade" id="update_nv">
        <div class="modal-dialog d-add-nv">
            <div class="modal-content d-modal-bo-loc1">
                <div class="modal-header d-modal-bo-loc2">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <img src="<?= base_url(); ?>assets/images/exit.svg" alt="exit" class="follow-map-img">
                    </button>
                    <h4 class="modal-title d-boloc-p">Cập nhật nhân viên</h4>
                </div>
                <form method="POST" id="update_nv1111" class="d-modal-boloc">
                    <input type="hidden" id="id_staff" value="">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                            <label class="d-add-staff">Tên nhân sự:</label>
                            <input type="text" value="" id="ten_ns_update" name="ten_ns" class="d-them-nv-input" placeholder="Mời bạn nhập họ tên">
                            <div class="error" id="err_name"></div>
                        </div>
                        <!-- <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                            <label class="d-add-staff">Mật khẩu:</label>
                            <input type="password" value="" id="mat_khau_update" name="mat_khau" class="d-them-nv-input" placeholder="Tối thiểu 6 kí tự">
                            <div class="error" id="err_pass"></div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                            <label class="d-add-staff">Nhập lại mật khẩu:</label>
                            <input type="password" value="" id="repass_update" name="repass" class="d-them-nv-input" placeholder="Tối thiểu 6 kí tự">
                            <div class="error" id="err_repass"></div>
                        </div> -->
                        <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                            <label class="d-add-staff">Số điện thoại:</label>
                            <input type="text" value="" id="telephone_update" name="telephone" class="d-them-nv-input" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Số điện thoại liên lạc của nhân viên">
                            <div class="error" id="err_sdt"></div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                            <label class="d-add-staff">Quyền truy cập:</label>
                            <select name="truy_cap" id="truy_cap3" class="d-chi-nhanh">
                                <option value="">Chọn quyền nhân viên</option>
                                <?
                                foreach ($quyen as $key => $qu) {
                                ?>
                                    <option value="<?= $key ?>"><?= $qu ?></option>
                                <?
                                }
                                ?>
                            </select>
                            <div class="error" id="err_truycap"></div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                            <label class="d-add-staff">Phòng/ ban làm việc:</label>
                            <select name="phong_ban2" id="phong_ban3" class="d-chi-nhanh">
                                <option value="">Chọn phòng ban nhân viên</option>
                                <?
                                foreach ($phongban as $pb) {
                                ?>
                                    <option value="<?= $pb['dep_id'] ?>"><?= $pb['dep_name'] ?></option>
                                <?
                                }
                                ?>
                            </select>
                            <div class="error" id="err_phongban"></div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                            <label class="d-add-staff">Chức vụ đang nắm giữ:</label>
                            <select name="chuc_vu" id="chuc_vu3" class="d-phong-ban">
                                <option value="">Chọn chức vụ</option>
                                <?
                                foreach ($chucvu as $key => $cv) {
                                ?>
                                    <option value="<?= $key ?>"><?= $cv ?></option>
                                <?
                                }
                                ?>
                            </select>
                            <div class="error" id="err_chucvu"></div>
                        </div>
                        <div class="d-modal-them-nv">
                            <button type="reset" class="d-modal-boloc-huy d-them-nv1">Nhập lại</button>
                            <button type="submit" class="d-modal-boloc-tk d-them-nv1">Cập nhật</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <? require_once APPPATH . "/views/includes/inc_footer.php" ?>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/cty/detail_staff.js"></script>
    
</body>

</html>