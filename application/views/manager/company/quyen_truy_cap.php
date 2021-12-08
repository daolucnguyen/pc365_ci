<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quyền truy cập</title>

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/quan_ly_cty.css">
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
        .ql_phanquyen,
        .ql_cty {
            color: #206AA9;
        }

        #menu-manager1 {
            display: block;
        }
    </style>
</head>

<body>
    <div class="d-quan-ly-cty">
        <div class="l_block_sidebar">
            <?php include APPPATH . "views/includes/sidebar_left_cty.php"; ?>
        </div>
        <div class="d-quan-ly-cty1">
            <?php include APPPATH . "views/includes/header_manager.php"; ?>
            <div class="d-qly-cty1-v1">
                <h3 class="d-qly-cham-cong">Quyền truy cập</h3>
                <div id="alert"></div>
                <div class="d-qly-cham-cong1">
                    <div class="row">
                        <form action="" onsubmit="timkiem(); return false;">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <input type="text" class="d-ds-nv-input" value="<?= $keyWord ?>" id="keyWord" name="name" placeholder="Nhập từ khóa">
                            </div>
                            <div class="d-none">
                                <div class="col-md-3 col-sm-6 col-xs-12 d-chii-nhanh">
                                    <select name="" id="chii_nhanh" onchange="showdepartment(1);" class="d-chi-nhanh1">
                                        <option value="">Chọn chi nhánh</option>
                                        <?
                                        foreach ($detail_company_small as $value) {
                                        ?>
                                            <option <?
                                                    if ($chiNhanh == $value->com_id) {
                                                        echo "selected";
                                                    }
                                                    ?> value="<?= $value->com_id ?>"><?= $value->com_name ?></option>
                                        <?
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 d-phong-bann">
                                    <select name="" id="phongg_ban" class="d-chi-nhanh1">
                                        <option value="">Chọn phòng ban</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12 d-loc-quyenn">
                                    <select name="" id="locc_quyen" class="d-chi-nhanh1">
                                        <option value="">Chọn quyền truy cập</option>
                                        <?
                                        foreach ($quyen as $key => $role) {
                                        ?>
                                            <option <?
                                                    if ($key == $quyen_search) {
                                                        echo 'selected';
                                                    }
                                                    ?> value="<?= $key ?>"><?= $role ?></option>
                                        <?
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="">
                                <button class="btn_search l_custom_btn_timkiem" type="button" onclick="timkiem(); return false;">Tìm kiếm</button>
                            </div>
                        </form>
                        <div class=" col-xs-12 d-fillter" data-toggle="modal" data-target="#bo_loc">
                            <p class="d-bo-loc-p">Lọc tìm kiếm</p>
                        </div>
                    </div>
                    <div class="d-qly-truy-cap">
                        <div class="d-qly-nhan-vien1">
                            <div class="d-ds-nv1 active" id="ds_nhan_vien">
                                <table class=" d-table-nhan-vien">
                                    <thead>
                                        <tr class="d-table-nv-tr">
                                            <th class="d-table-th d-tb-nv-th1">Thông tin nhân viên ( ID )</th>
                                            <th class="d-table-th d-tb-nv-th">Quyền truy cập</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?
                                        if ($quyen_search == '') {
                                            foreach ($staff_active as $value) {
                                        ?>
                                                <tr class="d-table-nv-tr1">
                                                    <td class="d-table-td">
                                                        <div class="d-info-nv">
                                                            <img src="https://chamcong.24hpay.vn/upload/employee/<?= $value->ep_image ?>" onerror='this.onerror=null;this.src="<? base_url() ?>/images_staff/avatar_default.png";' alt="name_nv" class="d-info-img">
                                                            <div class="d-cham-cong-td1a">
                                                                <p class="d-cham-cong-p">(<?= $value->ep_id ?>) <?= $value->ep_name ?></p>
                                                                <p class="d-cham-cong-p1">Nhân viên <?= $value->dep_name ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="d-table-td">
                                                        <div class="row">
                                                            <div class="d-phan-quyen">
                                                                <select name="" onchange="updateRole(<?= $value->ep_id ?>,1);" id="role1<?= $value->ep_id ?>" class="d-phan-quyen1">
                                                                    <option value="" disabled>Chọn quyền truy cập</option>
                                                                    <?
                                                                    foreach ($quyen as $key => $role) {
                                                                    ?>
                                                                        <option <?
                                                                                if ($key == $value->role_id) {
                                                                                    echo "selected";
                                                                                }
                                                                                ?> value="<?= $key ?>"><?= $role ?>
                                                                        </option>
                                                                    <?
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?
                                            }
                                        } else {
                                            foreach ($staff_active as $value) {
                                                if ($value->role_id == $quyen_search) {

                                                ?>
                                                    <tr class="d-table-nv-tr1">
                                                        <td class="d-table-td">
                                                            <div class="d-info-nv">
                                                                <img src="https://chamcong.24hpay.vn/upload/employee/<?= $value->ep_image ?>" onerror='this.onerror=null;this.src="<? base_url() ?>/images_staff/avatar_default.png";' alt="name_nv" class="d-info-img">
                                                                <div class="d-cham-cong-td1a">
                                                                    <p class="d-cham-cong-p">(<?= $value->ep_id ?>) <?= $value->ep_name ?></p>
                                                                    <p class="d-cham-cong-p1">Nhân viên <?= $value->dep_name ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="d-table-td">
                                                            <div class="row">
                                                                <div class="d-phan-quyen">
                                                                    <select name="" onchange="updateRole(<?= $value->ep_id ?>,1);" id="role1<?= $value->ep_id ?>" class="d-phan-quyen1">
                                                                        <option value="" disabled>Chọn quyền truy cập</option>
                                                                        <?
                                                                        foreach ($quyen as $key => $role) {
                                                                        ?>
                                                                            <option <?
                                                                                    if ($key == $value->role_id) {
                                                                                        echo "selected";
                                                                                    }
                                                                                    ?> value="<?= $key ?>"><?= $role ?>
                                                                            </option>
                                                                        <?
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                        <?
                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?
                                if ($quyen_search == '') {
                                    foreach ($staff_active as $value) {
                                ?>
                                        <div class="d-ds-nv-mobile">
                                            <div class="d-info-nv">
                                                <img src="https://chamcong.24hpay.vn/upload/employee/<?= $value->ep_image ?>" onerror='this.onerror=null;this.src="<? base_url() ?>/images_staff/avatar_default.png";' alt="name_nv" class="d-info-img">
                                                <div class="d-cham-cong-td1a">
                                                    <p class="d-cham-cong-p">(<?= $value->ep_id ?>) <?= $value->ep_name ?></p>
                                                    <p class="d-cham-cong-p1">Nhân viên <?= $value->dep_name ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="d-email-nv-mobie">
                                                <div class="row">
                                                    <div class="col-xs-12 d-phan-quyen">
                                                        <select name="" onchange="updateRole(<?= $value->ep_id ?>,2);" id="role<?= $value->ep_id ?>" class="d-phan-quyen12">
                                                            <option value="" disabled>Chọn quyền truy cập</option>
                                                            <?
                                                            foreach ($quyen as $key => $role) {
                                                            ?>
                                                                <option <?
                                                                        if ($key == $value->role_id) {
                                                                            echo "selected";
                                                                        }
                                                                        ?> value="<?= $key ?>"><?= $role ?>
                                                                </option>
                                                            <?
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?
                                    }
                                } else {
                                    foreach ($staff_active as $value) {
                                        if ($value->role_id == $quyen_search) {
                                        ?>
                                            <div class="d-ds-nv-mobile">
                                                <div class="d-info-nv">
                                                    <img src="https://chamcong.24hpay.vn/upload/employee/<?= $value->ep_image ?>" onerror='this.onerror=null;this.src="<? base_url() ?>/images_staff/avatar_default.png";' alt="name_nv" class="d-info-img">
                                                    <div class="d-cham-cong-td1a">
                                                        <p class="d-cham-cong-p">(<?= $value->ep_id ?>) <?= $value->ep_name ?></p>
                                                        <p class="d-cham-cong-p1">Nhân viên <?= $value->dep_name ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="d-email-nv-mobie">
                                                    <div class="row">
                                                        <div class="col-xs-12 d-phan-quyen">
                                                            <select name="" onchange="updateRole(<?= $value->ep_id ?>,2);" id="role<?= $value->ep_id ?>" class="d-phan-quyen12">
                                                                <option value="" disabled>Chọn quyền truy cập</option>
                                                                <?
                                                                foreach ($quyen as $key => $role) {
                                                                ?>
                                                                    <option <?
                                                                            if ($key == $value->role_id) {
                                                                                echo "selected";
                                                                            }
                                                                            ?> value="<?= $key ?>"><?= $role ?>
                                                                    </option>
                                                                <?
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="phan-trang">
                    <?= $links; ?>
                </div>

            </div>
        </div>
        <!-- bộ lọc -->
        <div class="modal fade" id="bo_loc">
            <div class="modal-dialog d-modal-bo-loc">
                <div class="modal-content d-modal-bo-loc1">
                    <div class="modal-header d-modal-bo-loc2">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <img src="<?= base_url() ?>assets/images/exit.svg" alt="exit" class="follow-map-img">
                        </button>
                        <h4 class="modal-title d-boloc-p">Lọc tìm kiếm</h4>
                    </div>
                    <form class="d-modal-boloc" onsubmit="timkiem(); return false;">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12 d-chii-nhanh">
                                <select name="" id="chi_nhanh" onchange="showdepartment(2);" class="d-chi-nhanh1">
                                    <option value="">Chọn chi nhánh</option>
                                    <!-- <option value="<?= $detail_company['com_id'] ?>"><?= $detail_company['com_name'] ?></option> -->
                                    <?
                                    foreach ($detail_company_small as $value) {
                                    ?>
                                        <option value="<?= $value->com_id ?>"><?= $value->com_name ?></option>
                                    <?
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 d-phong-bann">
                                <select name="" id="phong_ban" class="d-chi-nhanh1">
                                    <option value="">Chọn phòng ban</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 d-loc-quyenn">
                                <select name="" id="loc_quyen" class="d-chi-nhanh1">
                                    <option value="">Chọn quyền truy cập</option>
                                    <?
                                    foreach ($quyen as $key => $role) {
                                    ?>
                                        <option value="<?= $key ?>"><?= $role ?></option>
                                    <?
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="d-modal-boloc2">
                            <button type="button" class="d-modal-boloc-huy" data-dismiss="modal" aria-hidden="true">Hủy</button>
                            <button type="button" class="d-modal-boloc-tk" onclick="timkiem(); return false;">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <? include(APPPATH . 'views/includes/inc_footer.php') ?>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/lazysizes.min.js"></script>
    <script src="<?= base_url() ?>assets/js/Chart.min.js"></script>
    <script src="<?= base_url() ?>assets/js/cty/quyen_truy_cap.js"></script>

</body>

</html>