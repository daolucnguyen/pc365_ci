<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách công ty con</title>

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
        .ql_cty_con,
        .ql_cty {
            color: #206AA9;
        }

        #menu-manager1 {
            display: block;
        }

        .d-ds-cty-con3-1::before {
            margin-right: 5px;
        }

        .d-ds-cty-con2-v1:hover,
        .d-ds-cty-con2-v1:focus {
            position: unset;
        }

        @media only screen and (max-width: 768px) {
            .l_padding_department {
                padding: 0;
                padding-bottom: 25px;
            }

            .d-ds-cty-con3-1 {
                width: auto;
            }
            .d-ds-cty-con2a-1,.d-ds-cty-con2{
                width: 100%;
            }
            
        }
    </style>
</head>

<body>
    <div class="d-quan-ly-cty">
        <div class="l_block_sidebar">
            <?php include  APPPATH . "views/includes/sidebar_left_cty.php"; ?>
        </div>
        <div class="d-quan-ly-cty1">
            <?php include APPPATH . "/views/includes/header_manager.php"; ?>
            <div class="d-qly-cty1-v1">
                <h3 class="d-qly-cham-cong">Danh sách công ty con</h3>
                <div id="alert"></div>
                <div class="d-ds-cty-con">
                    <div class="row">
                        <form action="" class="col-md-9 col-sm-12 col-xs-12">
                            <!-- <div class="col-md-5 col-sm-5 col-xs-12 d-ds-cty-con1 l_padding_department">
                                <input type="text" value="<?= $key_word ?>" class="d-ds-cty-input" id="keyWord" placeholder="Nhập từ khóa">
                            </div> -->
                            <div class="col-md-4 col-sm-4 col-xs-12 d-ds-cty-con2 l_padding_department l_clear_padding ">
                                <select name="" id="cong_ty" onchange="timkiem();" class="s-ds-cty-con2-1">
                                    <option value="">Chọn công ty</option>
                                    <?
                                    foreach ($ds_cty_con as $key => $value) {
                                    ?>
                                        <option <?
                                                if ($value['com_id'] == $congty) {
                                                    echo "selected";
                                                }
                                                ?> value="<?= $value['com_id'] ?>"><?= $value['com_name'] ?></option>
                                    <?
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- <div class="col-sm-3 l_text_right col-xs-12 l_clear_padding">
                                <button class="btn_search l_clear_margin" type="button" onclick="timkiem(); return false;">tìm kiếm</button>
                            </div> -->
                        </form>
                        <div class="col-md-3 col-sm-12 col-xs-12 d-ds-cty-con3">
                            <p class="d-ds-cty-con3-1 " data-toggle="modal" data-target="#them_cty" id="l_click">Thêm công ty</p>
                        </div>
                    </div>
                </div>
                <div class="d-ds-cty-con2a">
                    <div class="row" style="display: flex; flex-wrap: wrap;">
                        <?
                        if ($congty != '') {
                            foreach ($ds_cty_con as $key => $value) {
                                if ($key == $congty) {
                        ?>
                                    <div class="col-md-4 col-sm-6 col-xs-12 d-ds-cty-con2a-1" id="comsmall<?= $value['com_id'] ?>">
                                        <div class="d-ds-cty-con2-v1">
                                            <div class="d-ds-cty-con2-v11">
                                                <div class="d-ds-cty-con-img<?= $value['com_id'] ?>">
                                                    <img id="img_comSmall<?= $value['com_id'] ?>" src="https://chamcong.24hpay.vn/upload/company/logo/<?= $value['com_logo'] ?>" onerror='this.onerror=null;this.src="<?= base_url(); ?>assets/images/logo_com.png ";' alt="logo công ty" class="d-ds-cty-con-logo">
                                                </div>
                                                <div class="d-ds-cty-con2-v1a">
                                                    <h3 class="d-ds-cty-con2-p" id="name<?= $value['com_id'] ?>"><?= $value['com_name'] ?></h3>
                                                    <p class="d-ds-cty-con2-p2" id="id<?= $value['com_id'] ?>">ID: <?= $value['com_id'] ?></p>
                                                    <p class="d-ds-cty-con2-p3">Số điện thoại:
                                                        <span class="d-ds-cty-con2-span" id="phone<?= $value['com_id'] ?>"><?= $value['com_phone'] ?></span>
                                                    </p>
                                                    <p class="d-ds-cty-con2-p3" id="address<?= $value['com_id'] ?>">Địa chỉ: <?= $value['com_address'] ?></p>
                                                </div>
                                            </div>
                                            <div class="d-ds-cty-con2a-2">
                                                <!-- <p class="d-ds-cty-xoa" style="" onclick="l_deleteSmall(<?= $value['com_id'] ?>);">Xóa</p> -->
                                                <p class="d-ds-cty-sua" onclick="infoCompany(<?= $value['com_id'] ?>);" data-toggle="modal" data-target="#sua_cty">Sửa</p>
                                            </div>
                                        </div>
                                    </div>
                                <?
                                }
                            }
                        } else {
                            foreach ($ds_cty_con as $key => $value) {
                                ?>
                                <div class="col-md-4 col-sm-6 col-xs-12 d-ds-cty-con2a-1" id="comsmall<?= $value['com_id'] ?>">
                                    <div class="d-ds-cty-con2-v1">
                                        <div class="d-ds-cty-con2-v11">
                                            <div class="d-ds-cty-con-img<?= $value['com_id'] ?>">
                                                <img id="img_comSmall<?= $value['com_id'] ?>" src="https://chamcong.24hpay.vn/upload/company/logo/<?= $value['com_logo'] ?>" onerror='this.onerror=null;this.src="<?= base_url(); ?>assets/images/logo_com.png ";' alt="logo công ty" class="d-ds-cty-con-logo">
                                            </div>
                                            <div class="d-ds-cty-con2-v1a">
                                                <h3 class="d-ds-cty-con2-p" id="name<?= $value['com_id'] ?>"><?= $value['com_name'] ?></h3>
                                                <p class="d-ds-cty-con2-p2" id="id<?= $value['com_id'] ?>">ID: <?= $value['com_id'] ?></p>
                                                <p class="d-ds-cty-con2-p3">Số điện thoại:
                                                    <span class="d-ds-cty-con2-span" id="phone<?= $value['com_id'] ?>"><?= $value['com_phone'] ?></span>
                                                </p>
                                                <p class="d-ds-cty-con2-p3" id="address<?= $value['com_id'] ?>">Địa chỉ: <?= $value['com_address'] ?></p>
                                            </div>
                                        </div>
                                        <div class="d-ds-cty-con2a-2">
                                            <!-- <p class="d-ds-cty-xoa" onclick="l_deleteSmall(<?= $value['com_id'] ?>);">Xóa</p> -->
                                            <p class="d-ds-cty-sua" onclick="infoCompany(<?= $value['com_id'] ?>);" data-toggle="modal" data-target="#sua_cty">Sửa</p>
                                        </div>
                                    </div>
                                </div>
                        <?
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="phan-trang">
                    <!-- <?= $links ?> -->
                </div>
            </div>
        </div>
        <!-- thêm công ty -->
        <div class="modal fade" id="them_cty">
            <div class="modal-dialog d-them-cty">
                <div class="modal-content d-modal-bo-loc1">
                    <div class="modal-header d-modal-bo-loc2">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <img src="<?= base_url() ?>assets/images/exit.svg" alt="exit" class="follow-map-img">
                        </button>
                        <h4 class="modal-title d-boloc-p">Thêm công ty con</h4>
                    </div>
                    <form class="d-form-them-cty" id="add_company" enctype="multipart/form-data">
                        <p class="d-logo-cty">Logo công ty ( Nếu có )</p>
                        <div class="img-user-ntd">
                            <img src="<?= base_url() ?>assets/images/avt_ntd.svg" alt="avt" class="img-user" id="avatar" onerror='this.onerror=null;this.src="<?= base_url() ?>assets/images/avt_ntd.svg";'>
                            <input type="file" name="avatar" id="user-img" accept="image/*" onchange="changeImg(this)" class="hidden">
                            <div class="error" id="err_avt"></div>
                        </div>
                        <div class="d-fomr-them-cty1">
                            <input type="text" class="d-form-input ten-cty" id="ten_cty" name="ten_cty" placeholder="Nhập tên công ty">
                            <div class="error" id="err_name"></div>
                        </div>
                        <div class="d-fomr-them-cty1">
                            <input type="text" class="d-form-input email" id="email" name="email" placeholder="Nhập email liên hệ">
                            <div class="error" id="err_email"></div>
                        </div>
                        <div class="d-fomr-them-cty1">
                            <input type="text" class="d-form-input telephone" id="telephone" name="telephone" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Nhập số điện thoại liên hệ">
                            <div class="error" id="err_sdt"></div>
                        </div>
                        <div class="d-fomr-them-cty1">
                            <input type="text" class="d-form-input dia-chi" id="dia_chi" name="dia_chi" placeholder="Nhập địa chỉ">
                            <div class="error" id="err_address"></div>
                        </div>
                        <div class="d-button-them-cty">
                            <button type="reset" class="d-them-cty-reset">Nhập lại</button>
                            <button type="submit" id="add_company_small" class="d-them-cty-submit">Tạo công ty</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- sửa công ty -->
        <div class="modal fade" id="sua_cty">
            <div class="modal-dialog d-them-cty">
                <div class="modal-content d-modal-bo-loc1">
                    <div class="modal-header d-modal-bo-loc2">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <img src="<?= base_url() ?>assets/images/exit.svg" alt="exit" class="follow-map-img">
                        </button>
                        <h4 class="modal-title d-boloc-p">Cập nhật công ty con</h4>
                    </div>
                    <form method="POST" class="d-form-them-cty" id="edit_company">
                        <p class="d-logo-cty">Logo công ty ( Nếu có )</p>
                        <input type="hidden" value="" id="id_com">
                        <div class="img-user-ntd">
                            <input type="file" id="user-img1" accept="image/*" onchange="changeImg1(this)" class="hidden">
                            <label for="user-img1" class="dom_img">
                                <img src="" onerror='this.onerror=null;this.src="<?= base_url(); ?>assets/images/logo_com.png ";' class="img-user" id="avatar1" alt="logo công ty">
                            </label>
                            <div class="error" id="err_img_update"></div>
                        </div>
                        <div class="d-fomr-them-cty1">
                            <input type="text" class="d-form-input ten-cty" id="ten_ctyy" name="ten_cty" placeholder="Nhập tên công ty">
                            <div class="error" id="err_namee"></div>
                        </div>
                        <div class="d-fomr-them-cty1">
                            <input type="text" class="d-form-input email" readonly id="emaill" name="email" placeholder="Nhập email liên hệ">
                            <div class="error" id="err_emaill"></div>
                        </div>
                        <div class="d-fomr-them-cty1">
                            <input type="text" class="d-form-input telephone" id="telephonee" name="telephone" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Nhập số điện thoại liên hệ">
                            <div class="error" id="err_sdtt"></div>
                        </div>
                        <div class="d-fomr-them-cty1">
                            <input type="text" class="d-form-input dia-chi" id="dia_chii" name="dia_chi" placeholder="Nhập địa chỉ">
                            <div class="error" id="err_addresss"></div>
                        </div>
                        <div class="d-button-them-cty">
                            <button type="reset" class="d-them-cty-reset">Nhập lại</button>
                            <button type="submit" id="edit_company_small" class="d-them-cty-submit">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <? include APPPATH . "/views//includes/inc_footer.php" ?>
    <script src="<?= base_url() ?>assets/js/jquery.validate.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/lazysizes.min.js"></script>
    <script src="<?= base_url() ?>assets/js/cty/them_cty.js"></script>
    <script>
        function changeImg(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#avatar').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function changeImg1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#avatar1').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $('#l_click').click(function() {
            $('#add_company')[0].reset();
            $('.error').html('');
        });
    </script>
</body>

</html>