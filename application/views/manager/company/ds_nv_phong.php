<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhân viên phòng kĩ thuật</title>

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
        .ql_phongban,
        .ql_cty {
            color: #206AA9;
        }

        #menu-manager1 {
            display: block;
        }
        .l_btn_pbnv{
            padding: 10px 20px;
        }
    </style>
</head>

<body>
    <div class="d-quan-ly-cty">
        <div class="l_block_sidebar">
            <?php require_once APPPATH . '/views/includes/sidebar_left_cty.php'; ?>
        </div>
        <div class="d-quan-ly-cty1">
            <?php include APPPATH . "/views/includes/header_manager.php"; ?>
            <div class="d-qly-cty1-v1">
                <h3 class="d-qly-cham-cong">Danh sách nhân viên <?= $name_department; ?></h3>
                <div id="alert"></div>
                <div class="d-qly-cham-cong1">
                    <div class="row">
                        <form action="" onsubmit="timkiem(<?= $id_department ?>); return false;">
                            <div class="col-md-10 col-sm-8 col-xs-8">
                                <input type="text" id="keyWord" class="d-ds-nv-input" placeholder="Nhập từ khóa">
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-4 l_clear_padding">
                                <button class="btn_search l_clear_margin l_btn_pbnv" type="button" onclick="timkiem(<?= $id_department ?>); return false;">tìm kiếm</button>
                            </div>
                        </form>
                    </div>
                    <div class="d-qly-cham-cong1-v3">
                        <div class="d-qly-nhan-vien1">
                            <div class="d-ds-nv1 active " id="ds_nhan_vien">
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
                                            <?
                                            foreach ($list as $value) {
                                            ?>
                                                <tr class="d-table-nv-tr1" id="staff<?= $value['staff_id'] ?>">
                                                    <td class=" d-table-nv-td">
                                                        <div class="d-info-nv">
                                                            <img src="<?= $value['avatar'] ?>" onerror='this.onerror=null;this.src="<? base_url() ?>/images_staff/avatar_default.png";' alt="name_nv" class="d-info-img">
                                                            <div class="d-cham-cong-td1a">
                                                                <p class="d-cham-cong-p">(<?= $value['staff_id'] ?>) <?= $value['name_staff'] ?></p>
                                                                <p class="d-cham-cong-p1">Nhân viên <?= $value['name_department'] ?></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center d-table-nv-td">
                                                        <p class="d-email-nv"><?= $value['email'] ?></p>
                                                    </td>
                                                    <td class="text-center d-table-nv-td">
                                                        <p class="d-email-nv"><?= $value['telephone'] ?></p>
                                                    </td>
                                                    <td class="text-center d-table-nv-td">
                                                        <p class="d-email-nv">
                                                            <?
                                                            foreach ($show_position as $posi) {
                                                                if ($posi['id_position'] == $value['position']) {
                                                                    echo $posi['name_position'];
                                                                }
                                                            }
                                                            ?>
                                                        </p>
                                                    </td>
                                                    <td class="text-center d-table-nv-td">
                                                        <div class="d-edit-nv">
                                                            <div data-toggle="modal" data-target='#update_nv' onclick="getInfoStaff(<?= $value['staff_id'] ?>)" id="update_staff" class="d-update-nv">Sửa</div>
                                                            <div onclick="deleteActive(<?= $value['staff_id'] ?>);" class="d-delete-nv">Xóa</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                                <?
                                foreach ($list as $value) {
                                ?>
                                    <div class="d-ds-nv-mobile" id="staffmd<?= $value['staff_id'] ?>">
                                        <div class="d-info-nv">
                                            <img src="<?= $value['avatar'] ?>" onerror='this.onerror=null;this.src="<? base_url() ?>/images_staff/avatar_default.png";' alt="name_nv" class="d-info-img">
                                            <div class="d-cham-cong-td1a">
                                                <p class="d-cham-cong-p">(<?= $value['staff_id'] ?>) <?= $value['name_staff'] ?></p>
                                                <p class="d-cham-cong-p1">Nhân viên <?= $value['name_department'] ?></p>
                                            </div>
                                        </div>
                                        <div class="d-email-nv-mobie"><span class="d-email-nv1">Email: </span>
                                            <p class="d-email-nv"><?= $value['email'] ?></p>
                                        </div>
                                        <div class="d-email-nv-mobie"><span class="d-email-nv1">Số điện thoại: </span>
                                            <p class="d-email-nv"><?= $value['telephone'] ?></p>
                                        </div>
                                        <div class="d-email-nv-mobie"><span class="d-email-nv1">Quyền truy cập: </span>
                                            <p class="d-email-nv"> <?
                                                                    foreach ($show_position as $posi) {
                                                                        if ($posi['id_position'] == $value['position']) {
                                                                            echo $posi['name_position'];
                                                                        }
                                                                    }
                                                                    ?></p>
                                        </div>
                                        <div class="d-email-nv1-mobie">
                                            <p class="d-icon-them"></p>
                                            <div class="dropdown-content">
                                                <div class="d-edit-nv">
                                                    <div data-toggle="modal" data-target='#update_nv' onclick="getInfoStaff(<?= $value['staff_id'] ?>)" id="update_staff" class="d-update-nv">Sửa</div>
                                                    <div onclick="deleteActive(<?= $value['staff_id'] ?>);" class="d-delete-nv">Xóa</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?
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

    </div>

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
                        <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                            <label class="d-add-staff">Mật khẩu:</label>
                            <input type="password" value="" id="mat_khau_update" name="mat_khau" class="d-them-nv-input" placeholder="Tối thiểu 6 kí tự">
                            <div class="error" id="err_pass"></div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                            <label class="d-add-staff">Nhập lại mật khẩu:</label>
                            <input type="password" value="" id="repass_update" name="repass" class="d-them-nv-input" placeholder="Tối thiểu 6 kí tự">
                            <div class="error" id="err_repass"></div>
                        </div>
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
                                foreach ($quyen as $qu) {
                                ?>
                                    <option value="<?= $qu['id'] ?>"><?= $qu['name'] ?></option>
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
                                    <option value="<?= $pb['id_department'] ?>"><?= $pb['name_department'] ?></option>
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
                                foreach ($show_position as $cv) {
                                ?>
                                    <option value="<?= $cv['id_position'] ?>"><?= $cv['name_position'] ?></option>
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

    <? include(APPPATH . '/views/includes/inc_footer.php') ?>
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/lazysizes.min.js"></script>
    <script>
        var base_url = "";
        $(document).ready(function() {
            $("#update_nv1111").submit(function(event) {
                event.preventDefault();
                var form_oke = true;
                var ten_ns = $.trim($("#ten_ns_update").val());
                var id_staff = $.trim($("#id_staff").val());
                // var email = $.trim($("#email_update").val());
                var mat_khau = $.trim($("#mat_khau_update").val());
                var repass = $.trim($("#repass_update").val());
                var telephone_format = /((09|03|07|08|05)+([0-9]{8})\b)/g;
                var telephone = $.trim($('#telephone_update').val());
                var truy_cap = $("#truy_cap3").val();
                var phong_ban2 = $.trim($("#phong_ban3").val());
                var chuc_vu = $.trim($("#chuc_vu3").val());
                var form_data = new FormData();
                var arr_id_to_focus = [];

                form_data.append('staff_id', id_staff);

                if (ten_ns == "" || ten_ns == null) {
                    $("#err_name").html("Bạn chưa điền tên nhân viên");
                    arr_id_to_focus.push("#ten_ns");
                    form_oke = false;
                } else {
                    $("#err_name").html("");
                    form_data.append('ten_ns', ten_ns);
                }
                if (mat_khau == "" || mat_khau == null) {
                    $("#err_pass").html("Bạn chưa nhập mật khẩu");
                    arr_id_to_focus.push("#mat_khau");
                    form_oke = false;
                } else {
                    if (mat_khau.length < 6) {
                        $("#err_pass").html("Mật khẩu phải lớn hơn 6 ký tụ");
                        arr_id_to_focus.push("#mat_khau");
                        form_oke = false;
                    } else {
                        $("#err_pass").html("");
                        form_data.append('mat_khau', mat_khau);
                    }
                }
                if (repass == "" || repass == null) {
                    $("#err_repass").html("Bạn chưa nhập mật khẩu");
                    arr_id_to_focus.push("#repass");
                    form_oke = false;
                } else {
                    if (repass != mat_khau) {
                        $("#err_repass").html("Mật khẩu không trùng khớp");
                        arr_id_to_focus.push("#repass");
                        form_oke = false;
                    } else {
                        $("#err_repass").html("");
                        form_data.append("repass", repass);
                    }
                }
                if (telephone == "" || telephone == null) {
                    $("#err_sdt").html("Bạn chưa nhập số điện thoại");
                    arr_id_to_focus.push("#telephone");
                    form_oke = false;
                } else {
                    if (telephone.match(telephone_format) == null) {
                        $("#err_sdt").html("Số điện thoại không đúng định dạng");
                        arr_id_to_focus.push("#telephone");
                        form_oke = false;
                    } else {
                        $("#err_sdt").html("");
                        form_data.append("telephone", telephone);
                    }
                }
                if (truy_cap == "" || truy_cap == null) {
                    $("#err_truycap").html("Bạn chưa chọn quyền truy cập");
                    arr_id_to_focus.push("#truy_cap3");
                    form_oke = false;
                } else {
                    $("#err_truycap").html("");
                    form_data.append("truy_cap", truy_cap);
                }
                if (phong_ban2 == "" || phong_ban2 == null) {
                    $("#err_phongban").html("Bạn chưa chọn quyền truy cập");
                    arr_id_to_focus.push("#phong_ban3");
                    form_oke = false;
                } else {
                    $("#err_phongban").html("");
                    form_data.append("phong_ban2", phong_ban2);
                }
                if (chuc_vu == "" || chuc_vu == null) {
                    $("#err_chucvu").html("Bạn chưa chọn quyền truy cập");
                    arr_id_to_focus.push("#chuc_vu3");
                    form_oke = false;
                } else {
                    $("#err_chucvu").html("");
                    form_data.append("chuc_vu", chuc_vu);
                }
                if (form_oke == true) {
                    // console.log(form_data);
                    // return false;
                    $.ajax({
                        type: "POST",
                        url: base_url + '/company/Company_controller/update_staff',
                        data: form_data,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.result == true) {
                                $("#alert").append('<div class="alert-success">Cập nhật nhân viên thành công</div>');
                                setTimeout(function() {
                                    $(".alert-success").fadeOut(1000, function() {
                                        location.reload();
                                    });
                                }, 1500);
                            } else {
                                return false;
                            }
                        }
                    });
                } else {
                    $(arr_id_to_focus[0]).focus();
                }
                return false;
            });
        });

        function timkiem(id) {
            var keyWord = $('#keyWord').val();
            if (keyWord != '') {
                window.location.href = base_url + '/danh-sach-nhan-vien-theo-phong-ban.html?id=' + id + '&keyWord=' + keyWord;
            } else {
                window.location.href = base_url + '/danh-sach-nhan-vien-theo-phong-ban.html?id=' + id;
            }
        }

        function getInfoStaff(a) {
            $('.error').html('');
            var data = new FormData;
            var id_power = 0;
            var department = 0;
            var position = 0;
            data.append('staff_id', a);
            $.ajax({
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                // enctype: 'multipart/form-data',
                url: base_url + '/company/Company_controller/infoStaff',
                data: data,
                dataType: "JSON",
                async: false,
                success: function(data) {
                    if (data.result == true) {
                        $('#ten_ns_update').val(data.info.name_staff);
                        $('#telephone_update').val(data.info.telephone);
                        $('#id_staff').val(a);
                        id_power = data.info.power;
                        department = data.info.department;
                        position = data.info.position;
                    } else {
                        return false;
                    }
                }
            });
            $("#truy_cap3").select2({
                placeholder: 'Phòng ban nơi nhân viên đang làm',
                width: "100%"
            }).val(id_power).trigger("change");
            $("#phong_ban3").select2({
                placeholder: 'Phòng ban nơi nhân viên đang làm',
                width: "100%"
            }).val(department).trigger("change");
            $("#chuc_vu3").select2({
                placeholder: 'Phòng ban nơi nhân viên đang làm',
                width: "100%"
            }).val(position).trigger("change");
        }

        function deleteActive(id) {
            var data = new FormData();
            data.append('id', id);
            $.ajax({
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                // enctype: 'multipart/form-data',staffmd
                url: base_url + '/company/Company_controller/deleteStaff',
                data: data,
                dataType: "JSON",
                async: false,
                success: function(data) {
                    if (data.result == true) {
                        $('#staff' + id).css('display', 'none');
                        $('#staffmd' + id).css('display', 'none');
                    } else {
                        return false;
                    }
                }
            });
        }
    </script>
</body>

</html>