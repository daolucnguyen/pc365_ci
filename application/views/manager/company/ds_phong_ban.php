<style>
    .ql_phongban,
    .ql_cty {
        color: #206AA9;
    }

    #menu-manager1 {
        display: block;
    }

    /* .d-ds-phong-ban {
        width: auto;
    } */
    .d-ds-cty-con3-1::before {
        margin-right: 5px;
    }

    .d-phong-ban1 .dropdown-menu {
        top: 30px;
        left: -87px
    }

    @media only screen and (max-width: 768px) {

        /* .l_padding_department {
                padding: 0;
                padding-bottom: 25px;
            } */
        .d-ds-phong-ban {
            width: auto;
        }
    }
</style>
<div class="d-qly-cty1-v1">
    <h3 class="d-qly-cham-cong">Danh sách phòng ban</h3>
    <div class="d-ds-cty-con">
        <div id="alert"></div>
        <div class="row">
            <form class="search_department" action="" onsubmit="timkiem(); return false;">
                <div class="search_department_item l_padding_department">
                    <input type="text" value="<?= $keyWord ?>" class="d-ds-cty-input" id="keyWord" placeholder="Nhập từ khóa">
                </div>
                <div class="search_department_item d-ds-cty-con2 ">
                    <select name="ten_cty" id="cong_ty" class="s-ds-cty-con2-1 form-control">
                        <option value="">Chọn công ty</option>
                        <?
                        foreach ($detail_company_small as $pb) {
                        ?>
                            <option <?
                                    if ($congty == $pb->com_id) {
                                        echo 'selected';
                                    } ?> value="<?= $pb->com_id ?>"><?= $pb->com_name ?></option>
                        <?
                        }
                        ?>
                    </select>
                </div>
                <div class="search_department_item l_text_right">
                    <button class="btn_search l_clear_margin" type="button" onclick="timkiem(); return false;">tìm kiếm</button>
                </div>
            </form>
            <div class="col-md-12 col-sm-6 col-xs-12 d-ds-cty-con3 ">
                <p class="d-ds-cty-con3-1 d-ds-phong-ban" data-toggle="modal" data-target="#them_cty">Thêm phòng ban</p>
            </div>
        </div>
    </div>
    <div class="d-ds-cty-con2a">
        <div class="row l_list_department">
            <?php
            $department = array_reverse($department);
            foreach ($department as $each) { ?>
                <div class="col-md-3 col-sm-4 col-xs-12 d-ds-cty-con2a-11 l_padding_department" id="dep<?= $each['dep_id']; ?>" name="<?= $each['dep_id']; ?>">
                    <div class="d-ds-phong-ban1">
                        <a href="<?= urlQlyDanhSachNvTheoPhongBan(); ?>?id=<?= $each['dep_id']; ?>" class="d-ds-phong-ban-p" id="name_department<?= $each['dep_id']; ?>"><?= $each['dep_name']; ?></a>
                        <div class="dropdown d-phong-ban1 l_hover_depment">
                            <img class="dropdown-toggle d-ds-phong-banv1 l_curson " src="<?= base_url(); ?>assets/images/them.svg">
                            <ul class="dropdown-menu">
                                <li><a class="d-phong-ban-1 update_department" data-toggle="modal" id="<?= $each['dep_id']; ?>" data-target="#sua_cty" name="<?= $each['dep_name']; ?>">Cập nhật</a></li>
                                <li><a class="d-phong-ban-1 delete_department" name="<?= $each['dep_id']; ?>">Xóa</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>
    <div class="phan-trang">
        <!-- <?= $links ?> -->
    </div>

</div>
<!-- thêm phòng ban -->
<div class="modal fade" id="them_cty">
    <div class="modal-dialog d-them-cty">
        <div class="modal-content d-modal-bo-loc1">
            <div class="modal-header d-modal-bo-loc2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <img src="<?= base_url(); ?>assets/images/exit.svg" alt="exit" class="follow-map-img">
                </button>
                <h4 class="modal-title d-boloc-p">Thêm phòng ban</h4>
            </div>
            <form method="POST" class="d-form-them-cty" id="add_department">
                <!-- <div class="d-fomr-them-cty1">
                    <select name="ten_cty" id="chon_cty" class="d-form-input">
                        <option value="">Chọn công ty</option>
                        <?
                        foreach ($detail_company_small as $pb) {
                        ?>
                            <option value="<?= $pb->com_id ?>"><?= $pb->com_name ?></option>
                        <?
                        }
                        ?>
                    </select>
                    <div class="error" id="err_name"></div>
                </div> -->
                <div class="d-fomr-them-cty1">
                    <input type="text" class="d-form-input" id="phong_ban" name="phong_ban" placeholder="Nhập tên phòng ban muốn đặt">
                    <div class="error" id="err_phongban"></div>
                </div>
                <div class="d-button-them-cty">
                    <button type="reset" class="d-them-cty-reset" data-dismiss="modal" aria-hidden="true">Hủy</button>
                    <button type="submit" class="d-them-cty-submit">Thêm mới</button>
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
                    <img src="<?= base_url(); ?>assets/images/exit.svg" alt="exit" class="follow-map-img">
                </button>
                <h4 class="modal-title d-boloc-p">Sửa phòng ban</h4>
            </div>
            <form method="POST" class="d-form-them-cty" id="edit_company">
                <!-- <select name="ten_cty" id="cong_ty_2" class="s-ds-cty-con2-1 form-control">
                    <option value="">Chọn công ty</option>
                    <?
                    foreach ($detail_company_small as $pb) {
                    ?>
                        <option value="<?= $pb->com_id ?>"><?= $pb->com_name ?></option>
                    <?
                    }
                    ?>
                </select> -->
                <div class="d-fomr-them-cty1">
                    <input type="text" class="d-form-input" id="phong_bann" name="phong_ban" value="">
                    <div class="error" id="err_phongbann"></div>
                </div>
                <div class="d-button-them-cty">
                    <button type="reset" class="d-them-cty-reset" data-dismiss="modal" aria-hidden="true">Hủy</button>
                    <button type="submit" class="d-them-cty-submit">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>