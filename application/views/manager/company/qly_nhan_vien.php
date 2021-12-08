<style>
    .ql_nhanvien {
        color: #206AA9;
    }

    .d-qly-cham-cong1-v2 {
        width: unset;
    }

    /* .d-bo-loc {
        width: 100%;
    } */

    .l_width {
        width: 35%;
    }

    .l_width2 {
        width: 35%;
    }

    .l_form {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
    }

    .d-qly-cham-cong1-v1 {
        display: flex;
        justify-content: space-between;
        width: 86%;
        padding: 0;
    }

    .l_width2 {
        width: 100%;
    }

    .d-qly-cham-cong1-v3 {
        margin-top: 40px;
    }

    .d-xuat-excel {
        padding: 5px 10px;
    }

    .d-table-nhan-vien {
        border-radius: 15px;
        overflow: hidden;
    }

    @media only screen and (max-width: 1025px) {
        .d-qly-cham-cong1-v1 {
            width: 50%;
        }

        .l_width {
            width: 100%;
        }

        .d-qly-cham-cong1-v2 {
            width: 25%;
            padding: 0;
        }

        .l_font {
            font-size: 13px;
        }

        .d-qly-cham-cong1-map {
            width: auto;
        }

        .d-update-nv,
        .d-delete-nv {
            padding: 5px;
            font-size: 15px;
        }

        .tick-chon,
        .bo-chon {
            width: 25px;
            height: 25px;
            cursor: pointer;
            margin: 5px;
        }

        .tick-all {
            width: 25px;
            height: 25px;
        }
    }

    @media only screen and (max-width: 768px) {
        .d-qly-cham-cong1-v1 {
            width: 100%;
        }

        .d-qly-cham-cong1-v2 {
            width: auto;
        }

        .qly-nv .d-bo-loc {
            width: auto;
        }

        .l_width2 {
            margin-top: 20px;
        }

        .d-qly-cham-cong1-map,
        .d-qly-cham-cong1-v1a3 {
            width: auto;
        }

        .dropdown-content {
            padding: 0;
        }

        .d-email-nv1-mobie {
            top: 45px;
        }
    }
</style>
<div class="d-qly-cty1-v1">
    <h3 class="d-qly-cham-cong">Quản lí nhân viên</h3>
    <div class="d-qly-cham-cong1">
        <div class="qly-nv">
            <div id="alert"></div>
            <form onsubmit="timkiem(); return false;" class="l_form">
                <div class="d-qly-cham-cong1-v1">
                    <div class="d-qly-cham-cong1-v1a l_width">
                        <input type="text" value="<?= $keyword ?>" id="search" name="search" class="d-qly-cham-cong1-v1a-input" placeholder="Nhập từ khóa">
                    </div>
                    <div class="d-qly-cham-cong1-v1a d-qly-cham-cong-tab l_width">
                        <select name="chi_nhanh" onchange="show_depament(1)" id="chi_nhanh" class="d-chi-nhanh chi_nhanh">
                            <option value="">Chọn công ty</option>
                            <?
                            foreach ($small_com as $cv) {
                            ?>
                                <option <?
                                        if ($chiNhanh == $cv->com_id) {
                                            echo "selected";
                                        }
                                        ?> value="<?= $cv->com_id ?>"><?= $cv->com_name ?></option>
                            <?
                            }
                            ?>
                        </select>
                    </div>
                    <div class="d-qly-cham-cong1-v1a1 l_width">
                        <select name="phong_ban" id="phong_ban" class="d-phong-ban phong_ban">
                            <option value="">Chọn phòng ban nhân viên</option>
                        </select>
                    </div>
                </div>
                <div class=" d-qly-cham-cong1-v2 d-bo-loc">
                    <div class="d-bo-loc" data-toggle="modal" data-target="#bo_loc">
                        <p class="d-bo-loc-p">Lọc tìm kiếm</p>
                    </div>
                </div>
                <div class="">
                    <button class="btn_search" type="button" onclick="timkiem(); return false;">tìm kiếm</button>
                </div>
                <div class="l_width2">
                    <div class="col-md-3 col-sm-6 col-xs-6 d-qly-cham-cong1-map">
                        <p class="d-qly-nv l_curson" data-toggle="modal" data-target='#add_staff' id="l_them_nv">Thêm nhân viên</p>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-6 d-qly-cham-cong1-v1a3">
                        <div onclick="export_excel();" class="d-xuat-excel">Xuất Excel</div>
                    </div>
                </div>
            </form>
        </div>
        <div class="d-qly-cham-cong1-v3">
            <div class="d-qly-nhan-vien">
                <li class="li-qly-nv  <?
                                        // data-toggle="tab" data-target="#ds_nhan_vien"
                                        $a = $this->uri->segment(2);
                                        if ($a == 1) {
                                            echo 'active';
                                        }
                                        ?>" id="duyet" data-id="<?= $this->uri->segment(2); ?>">
                    <a href="<?= urlQlyNhanVienCtyActive(1); ?>" class="d-ds-nhan-vien l_font  <?
                                                                                                if ($a == 1) {
                                                                                                    echo 'active';
                                                                                                }
                                                                                                ?>">DS nhân viên ( <span id="count_active" class="l_font"><?= $count_staff_active ?></span> )</a>
                </li>
                <li class="li-qly-nv1  <?
                                        if ($a == 2) {
                                            echo 'active';
                                        }
                                        ?>">
                    <!-- data-toggle="tab" data-target="#ds_nv_chua_duyet" -->
                    <a href="<?= urlQlyNhanVienCtyActive(2); ?>" class="d-ds-nv l_font <?
                                                                                        if ($a == 2) {
                                                                                            echo 'active';
                                                                                        }
                                                                                        ?>">DS nhân viên chưa duyệt ( <span id="count_noActive" class="l_font"><?= $count_staff_no_active ?></span> ) </a>
                </li>
            </div>
            <div class="d-qly-nhan-vien1">
                <div class="d-ds-nv1  <?
                                        if ($a == 1) {
                                            echo 'active';
                                        }
                                        ?>" id="ds_nhan_vien">
                    <div class="l_over">
                        <table class="table-hover d-table-nhan-vien">
                            <thead>
                                <tr class="d-table-nv-tr">
                                    <th class="d-table-nv-th d-tb-nv-th1">Thông tin nhân viên ( ID )</th>
                                    <th class="d-table-nv-th">Email</th>
                                    <th class="d-table-nv-th">Số điện thoại</th>
                                    <th class="d-table-nv-th">Quyền truy cập</th>
                                    <th class="d-table-nv-th d-tb-nv-th"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($staff_active as $st) { ?>
                                    <tr class="d-table-nv-tr1" name="<?= $st->ep_id ?>" id="active<?= $st->ep_id ?>">
                                        <td class="text-center d-table-nv-td l_text_left">
                                            <div class="d-info-nv">
                                                <?
                                                $avatar = '';
                                                if ($st->ep_image != '') {
                                                    $avatar = 'https://chamcong.24hpay.vn/upload/employee/' . $st->ep_image;
                                                }
                                                ?>
                                                <img src="<?= $avatar ?>" onerror='this.onerror=null;this.src="<? base_url() ?>/images_staff/avatar_default.png";' alt="name_nv" class="d-info-img">
                                                <div class="d-cham-cong-td1a">
                                                    <a href="<?= urlChiTietNhanVien(); ?>?staff_id=<?= $st->ep_id  ?>" class="d-cham-cong-p">(<?= $st->ep_id ?>)<?= $st->ep_name ?></a>
                                                    <p class="d-cham-cong-p1">Nhân viên <?= $st->dep_name ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center d-table-nv-td">
                                            <p class="d-email-nv"><?= $st->ep_email ?></p>
                                        </td>
                                        <td class="text-center d-table-nv-td">
                                            <p class="d-email-nv"><?= $st->ep_phone ?></p>
                                        </td>
                                        <td class="text-center d-table-nv-td">
                                            <p class="d-email-nv"><? foreach ($quyen as $key => $q) {
                                                                        if ($st->role_id == $key) {
                                                                            echo $q;
                                                                        }
                                                                    }
                                                                    if ($st->role_id == 0) {
                                                                        echo 'Chưa phân quyền';
                                                                    } ?></p>
                                        </td>
                                        <td class="text-center d-table-nv-td">
                                            <div class="d-edit-nv">
                                                <div class="d-update-nv" data-toggle="modal" data-target='#update_nv' onclick="getInfoStaff(<?= $st->ep_id ?>)" id="update_staff">Sửa</div>
                                                <!-- <div onclick="deleteActive(<?= $st->ep_id ?>);" class="d-delete-nv" name="<?= $st->ep_id ?>">Xóa</div> -->
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php foreach ($staff_active as $st) { ?>
                            <div class="d-ds-nv-mobile" id="active-mb<?= $st->ep_id ?>" name="<?= $st->ep_id ?>">
                                <div class="d-info-nv">
                                    <?
                                    $avatar = '';
                                    if ($st->ep_image != '') {
                                        $avatar = 'https://chamcong.24hpay.vn/upload/employee/' . $st->ep_image;
                                    }
                                    ?>
                                    <img src="<?= $avatar ?>" onerror='this.onerror=null;this.src="<? base_url() ?>/images_staff/avatar_default.png";' alt="name_nv" class="d-info-img">

                                    <div class="d-cham-cong-td1a">
                                        <p class="d-cham-cong-p">(<?= $st->ep_id ?>) <?= $st->ep_name ?></p>
                                        <p class="d-cham-cong-p1">Nhân viên phòng <?= $st->dep_name ?></p>
                                    </div>
                                </div>
                                <div class="d-email-nv-mobie"><span class="d-email-nv1">Email: </span>
                                    <p class="d-email-nv"><?= $st->ep_email  ?></p>
                                </div>
                                <div class="d-email-nv-mobie"><span class="d-email-nv1">Số điện thoại: </span>
                                    <p class="d-email-nv"><?= $st->ep_phone ?></p>
                                </div>
                                <div class="d-email-nv-mobie"><span class="d-email-nv1">Quyền truy cập: </span>
                                    <p class="d-email-nv"><? foreach ($quyen as $q) {
                                                                if ($st->role_id == $key) {
                                                                    echo $q;
                                                                }
                                                            }
                                                            if ($st->role_id == 0) {
                                                                echo 'Chưa phân quyền';
                                                            } ?></p>
                                </div>
                                <div class="d-email-nv1-mobie">
                                    <p class="d-icon-them"></p>
                                    <div class="dropdown-content">
                                        <div class="">
                                            <div class="d-update-nv" data-toggle="modal" data-target='#update_nv' onclick="getInfoStaff(<?= $st->ep_id ?>)" id="update_staff">Cập nhật</div>
                                            <!-- <div onclick="deleteActive(<?= $st->ep_id ?>);" class="d-delete-nv" name="<?= $st->ep_id ?>">Xóa</div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="d-qly-cham-cong2">
                        <div class="phan-trang"><?= $pagination; ?></div>
                    </div>

                </div>

                <div class="d-ds-nv1 <?
                                        if ($a == 2) {
                                            echo 'active';
                                        }
                                        ?>" id="ds_nv_chua_duyet">
                    <div class="l_over">
                        <table class="table-hover d-table-nhan-vien">
                            <thead>
                                <tr class="d-table-nv-tr">
                                    <th class="text-center d-table-nv-th d-tb-nv-th1">Thông tin nhân viên ( ID )</th>
                                    <th class="text-center d-table-nv-th">Email</th>
                                    <th class="text-center d-table-nv-th">Số điện thoại</th>
                                    <th class="text-center d-table-nv-th">Quyền truy cập</th>
                                    <th class="text-center d-table-nv-th d-tb-nv-th">
                                        <div class="d-chon-all">Chọn tất cả</div>
                                        <div class="d-img-chon-all"><img src="<?= base_url(); ?>assets/images/tick.svg" alt="chon" onclick="active_all();" class="tick-all" id="tick_all"></div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($staff_no_active as $st) { ?>
                                    <tr class="d-table-nv-tr1" id="no_active<?= $st->ep_id ?>" name="<?= $st->ep_id ?>">
                                        <td class="text-center d-table-nv-td l_text_left">
                                            <div class="d-info-nv">
                                                <?
                                                $avatar = '';
                                                if ($st->ep_image != '') {
                                                    $avatar = 'https://chamcong.24hpay.vn/upload/employee/' . $st->ep_image;
                                                }
                                                ?>
                                                <img src="<?= $avatar ?>" onerror='this.onerror=null;this.src="<? base_url() ?>/images_staff/avatar_default.png";' alt="name_nv" class="d-info-img">
                                                <div class="d-cham-cong-td1a">
                                                    <p class="d-cham-cong-p">(<?= $st->ep_id ?>) <?= $st->ep_name ?></p>
                                                    <p class="d-cham-cong-p1">Nhân viên <?= $st->dep_name ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center d-table-nv-td l_text_left">
                                            <p class="d-email-nv"><?= $st->ep_email ?></p>
                                        </td>
                                        <td class="text-center d-table-nv-td">
                                            <p class="d-email-nv"><?= $st->ep_phone ?></p>
                                        </td>
                                        <td class="text-center d-table-nv-td">
                                            <p class="d-email-nv"><? foreach ($quyen as $key => $q) {
                                                                        if ($st->role_id == $key) {
                                                                            echo $q;
                                                                        }
                                                                    }
                                                                    if ($st->role_id == 0) {
                                                                        echo 'Chưa phân quyền';
                                                                    }  ?></p>
                                        </td>
                                        <td class="text-center d-table-nv-td">
                                            <div class="d-edit-nv">
                                                <img src="<?= base_url(); ?>assets/images/tick.svg" alt="chon" title="Duyệt nhân viên" onclick="chon(<?= $st->ep_id ?>);" class="tick-chon active1" id="tick_chon" data-id="<?= $st->ep_id ?>" name="name[]">
                                                <img src="<?= base_url(); ?>assets/images/k_chon.svg" alt="bo chon" title="Xóa nhân viên" onclick="deleteNoActive(<?= $st->ep_id ?>);" class="bo-chon" id="bo_chon" name="<?= $st->ep_id ?>">
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                        <div class="d-ds-nv-mobile l_border_none">
                            <div class="d-ds-nv-chon">
                                <div class="d-chon-all">Chọn tất cả</div>
                                <div class="d-img-chon-all"><img src="<?= base_url(); ?>assets/images/tick.svg" alt="chon" class="tick-all" id="tick_alls"></div>
                            </div>
                            <?php foreach ($staff_no_active as $st) { ?>
                                <div class="l_style_mb" id="no_active-mb<?= $st->ep_id ?>">
                                    <div class="d-info-nv">
                                        <?
                                        $avatar = '';
                                        if ($st->ep_image != '') {
                                            $avatar = 'https://chamcong.24hpay.vn/upload/employee/' . $st->ep_image;
                                        }
                                        ?>
                                        <img src="<?= $avatar ?>" onerror='this.onerror=null;this.src="<? base_url() ?>/images_staff/avatar_default.png";' alt="name_nv" class="d-info-img">

                                        <div class="d-cham-cong-td1a">
                                            <p class="d-cham-cong-p">(<?= $st->ep_id ?>) <?= $st->ep_name ?></p>
                                            <p class="d-cham-cong-p1">Nhân viên <?= $st->dep_name ?></p>
                                        </div>
                                    </div>
                                    <div class="d-email-nv-mobie"><span class="d-email-nv1">Email: </span>
                                        <p class="d-email-nv"><?= $st->ep_email ?></p>
                                    </div>
                                    <div class="d-email-nv-mobie"><span class="d-email-nv1">Số điện thoại: </span>
                                        <p class="d-email-nv"><?= $st->ep_phone ?></p>
                                    </div>
                                    <div class="d-email-nv-mobie"><span class="d-email-nv1">Quyền truy cập: </span>
                                        <p class="d-email-nv"><? foreach ($quyen as $key => $q) {
                                                                    if ($st->role_id == $key) {
                                                                        echo $q;
                                                                    }
                                                                }
                                                                if ($st->role_id == 0) {
                                                                    echo 'Chưa phân quyền';
                                                                }  ?></p>
                                    </div>
                                    <div class="d-email-nv2-mobie">
                                        <div class="d-edit-nv">
                                            <img src="<?= base_url(); ?>assets/images/tick.svg" alt="chon" onclick="chon(<?= $st->ep_id ?>);" class="tick-chon active1" id="tick_chon" data-id="<?= $st->ep_id ?>" name="name[]">
                                            <img src="<?= base_url(); ?>assets/images/k_chon.svg" alt="bo chon" onclick="deleteNoActive(<?= $st->ep_id ?>);" class="bo-chon" id="bo_chon" name="<?= $st->ep_id ?>">
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="d-qly-cham-cong2">
                        <div class="phan-trang"><?= $links1; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal map -->

<div class="modal fade" id="follow_map">
    <div class="modal-dialog d-modal-dialog">
        <div class="modal-content d-modal-content-map">
            <div class="modal-header modal-follow-map">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <img src="<?= base_url(); ?>assets/images/close.svg" alt="exit" class="follow-map-img">
                </button>
            </div>
            <div class="modal-body d-follow-map">
                <div class="d-follow-map1">
                    <img src="<?= base_url(); ?>assets/images/img_map.svg" alt="map" class="d-follow-map1-img">
                </div>
                <div class="d-follow-map2">
                    <h4 class="d-follow-map2-v1">Chấm công ngày 19/4/2021</h4>
                    <div class="d-follow-map2-v2">
                        <table class="d-follow-map2-table">
                            <thead>
                                <tr>
                                    <th class="d-follow-map-th">Thông tin</th>
                                    <th class="d-follow-map-th">Ca làm việc</th>
                                    <th class="d-follow-map-th">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="d-follow-map-td">
                                        <div class="d-follow-map2-v2a">
                                            <img src="<?= base_url(); ?>assets/images/Ellipse124.svg" alt="ten nv" class="d-follow-map2-v2a-img">
                                            <div class="d-follow-map2-v2b">
                                                <p class="d-follow-map2-v2a-p">(162) Ngô Ngọc Yến</p>
                                                <p class="d-follow-map2-v2a-p1">Nhân viên phòng kĩ thuật</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="d-follow-map-td">
                                        <p class="d-follow-map2-v2a-p2">Ca Sáng ( 08:00 - 11:30 )</p>
                                    </td>
                                    <td class="d-follow-map-td">
                                        <div class="d-follow-map-v2">
                                            <p class="d-follow-map2-v2a-p3">Đúng giờ</p>
                                            <p class="d-follow-map2-v2a-p4" style="display:none">Đi muộn</p>
                                            <p class="d-follow-map2-v2a-p5" style="display:none">Về sớm</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal bộ lọc -->

<div class="modal fade" id="bo_loc">
    <div class="modal-dialog d-modal-bo-loc">
        <div class="modal-content d-modal-bo-loc1">
            <div class="modal-header d-modal-bo-loc2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <img src="<?= base_url(); ?>assets/images/exit.svg" alt="exit" class="follow-map-img">
                </button>
                <h4 class="modal-title d-boloc-p">Lọc tìm kiếm</h4>
            </div>
            <form class="d-modal-boloc" onsubmit="timkiem(); return false;">
                <div class="d-modal-boloc1">
                    <select name="chi_nhanh" onchange="show_depament(2)" id="chi_nhanh1" class="d-chi-nhanh chi_nhanh">
                        <option value="">Chọn chi nhánh</option>
                        <?
                        foreach ($small_com as $cv) {
                        ?>
                            <option value="<?= $cv->com_id ?>"><?= $cv->com_name ?></option>
                        <?
                        }
                        ?>
                    </select>
                </div>
                <div class="d-modal-boloc1">
                    <select name="phong_ban" id="phong_ban1" class="d-phong-ban phong_ban">
                        <option value="">Chọn phòng ban nhân viên</option>

                    </select>
                </div>
                <div class="d-modal-boloc2">
                    <button type="button" class="d-modal-boloc-huy" data-dismiss="modal" aria-hidden="true">Hủy</button>
                    <button type="button" onclick="timkiem(); return false;" class="d-modal-boloc-tk">Tìm kiếm</button>
                </div>
            </form>
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
                    <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv" style="display: none;">
                        <label class="d-add-staff">Mật khẩu:</label>
                        <input type="password" value="" id="mat_khau_update" name="mat_khau" class="d-them-nv-input" placeholder="Tối thiểu 6 kí tự">
                        <div class="error" id="err_pass"></div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv" style="display: none;">
                        <label class="d-add-staff">Nhập lại mật khẩu:</label>
                        <input type="password" value="" id="repass_update" name="repass" class="d-them-nv-input" placeholder="Tối thiểu 6 kí tự">
                        <div class="error" id="err_repass"></div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                        <label class="d-add-staff">Số điện thoại:</label>
                        <input type="text" value="" id="telephone_update" name="telephone" class="d-them-nv-input" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Số điện thoại liên lạc của nhân viên">
                        <div class="error" id="err_sdt"></div>
                    </div>
                    <!-- <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                        <label class="d-add-staff">Quyền truy cập:</label>
                        <select name="truy_cap" id="truy_cap3" class="d-chi-nhanh">
                            <option value="">Chọn quyền truy cập</option>
                            <option value="1">Admin (Toàn bộ quyền)</option>
                            <option value="4">Nhân sự (Quản lý chấm công)</option>
                            <option value="3">Nhân viên</option>
                        </select>
                        <div class="error" id="err_truycap"></div>
                    </div> -->
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
<!-- modal thêm nv -->
<div class="modal fade" id="add_staff">
    <div class="modal-dialog d-add-nv">
        <div class="modal-content d-modal-bo-loc1">
            <div class="modal-header d-modal-bo-loc2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <img src="<?= base_url(); ?>assets/images/exit.svg" alt="exit" class="follow-map-img">
                </button>
                <h4 class="modal-title d-boloc-p">Thêm nhân viên</h4>
            </div>
            <form method="POST" id="them_nv" class="d-modal-boloc">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                        <label class="d-add-staff">Tên nhân sự:</label>
                        <input type="text" value="" id="ten_ns" name="ten_ns" class="d-them-nv-input" placeholder="Mời bạn nhập họ tên">
                        <div class="error" id="err_name1"></div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                        <label class="d-add-staff">Email:</label>
                        <input type="text" value="" id="email" name="email" class="d-them-nv-input" placeholder="Mời bạn nhập email đăng nhập">
                        <div class="error" id="err_email1"></div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                        <label class="d-add-staff">Mật khẩu:</label>
                        <input type="password" value="" id="mat_khau" name="mat_khau" class="d-them-nv-input" placeholder="Tối thiểu 6 kí tự">
                        <div class="error" id="err_pass1"></div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                        <label class="d-add-staff">Nhập lại mật khẩu:</label>
                        <input type="password" value="" id="repass" name="repass" class="d-them-nv-input" placeholder="Tối thiểu 6 kí tự">
                        <div class="error" id="err_repass1"></div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                        <label class="d-add-staff">Số điện thoại:</label>
                        <input type="text" value="" id="telephone" name="telephone" class="d-them-nv-input" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Số điện thoại liên lạc của nhân viên">
                        <div class="error" id="err_sdt1"></div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                        <label class="d-add-staff">Quyền truy cập:</label>
                        <select name="truy_cap" id="truy_cap" class="d-chi-nhanh">
                            <option value="">Chọn quyền truy cập</option>
                            <option value="1">Admin (Toàn bộ quyền)</option>
                            <option value="4">Nhân sự (Quản lý chấm công)</option>
                            <option value="3">Nhân viên</option>
                        </select>
                        <div class="error" id="err_truycap1"></div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                        <label class="d-add-staff">Phòng/ ban làm việc:</label>
                        <select name="phong_ban2" id="phong_ban2" class="d-chi-nhanh">
                            <option value="">Chọn phòng ban nhân viên</option>
                            <?
                            foreach ($phongban as $pb) {
                            ?>
                                <option value="<?= $pb['dep_id'] ?>"><?= $pb['dep_name'] ?></option>
                            <?
                            }
                            ?>
                        </select>
                        <div class="error" id="err_phongban1"></div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                        <label class="d-add-staff">Chức vụ đang nắm giữ:</label>
                        <select name="chuc_vu" id="chuc_vu" class="d-phong-ban">
                            <option value="">Chọn chức vụ</option>
                            <?
                            foreach ($chucvu as $key => $cv) {
                            ?>
                                <option value="<?= $key ?>"><?= $cv ?></option>
                            <?
                            }
                            ?>
                        </select>
                        <div class="error" id="err_chucvu1"></div>
                    </div>
                    <div class="d-modal-them-nv">
                        <button type="reset" class="d-modal-boloc-huy d-them-nv1">Nhập lại</button>
                        <button type="submit" class="d-modal-boloc-tk d-them-nv1">Thêm mới</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>