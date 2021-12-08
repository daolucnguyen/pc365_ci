<?php
    include "../config/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí nhân viên</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/select2.min.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/quan_ly_cty.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="d-quan-ly-cty">
        <?php include "../includes/sidebar_left_cty.php";?>
        <div class="d-quan-ly-cty1">
            <?php include "../includes/header_manager.php";?>
            <div class="d-qly-cty1-v1">
                <h3 class="d-qly-cham-cong">Quản lí nhân viên</h3>
                <div class="d-qly-cham-cong1">
                    <div class="qly-nv">
                        <?php include "../includes/inc_timkiem.php";?>
                    </div>
                    <div class="d-qly-cham-cong1-v3">
                        <div class="d-qly-nhan-vien">
                            <li class="li-qly-nv active"><p class="d-ds-nhan-vien active" 
                                data-toggle="tab" data-target="#ds_nhan_vien">Danh sách nhân viên ( 100 )</p>
                            </li>
                            <li class="li-qly-nv1"><p class="d-ds-nv" data-toggle="tab" 
                                data-target="#ds_nv_chua_duyet">Danh sách nhân viên chưa duyệt ( 5 )</p>
                            </li>
                        </div>
                        <div class="d-qly-nhan-vien1">
                            <div class="d-ds-nv1 active" id="ds_nhan_vien">
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
                                        <tr class="d-table-nv-tr1">
                                            <td class="text-center d-table-nv-td">
                                                <div class="d-info-nv">
                                                    <img src="../images/Ellipse124.svg" alt="name_nv" class="d-info-img">
                                                    <div class="d-cham-cong-td1a">
                                                        <p class="d-cham-cong-p">(162) Ngô Ngọc Yến</p>
                                                        <p class="d-cham-cong-p1">Nhân viên phòng kĩ thuật</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center d-table-nv-td">
                                                <p class="d-email-nv">sieucapvippro@gmail.com</p>
                                            </td>
                                            <td class="text-center d-table-nv-td">
                                                <p class="d-email-nv">0344848666</p>
                                            </td>
                                            <td class="text-center d-table-nv-td">
                                                <p class="d-email-nv">Nhân viên</p>
                                            </td>
                                            <td class="text-center d-table-nv-td">
                                                <div class="d-edit-nv">
                                                    <a href="javascript:void(0)" class="d-update-nv">Sửa</a>
                                                    <a class="d-delete-nv">Xóa</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="d-ds-nv-mobile">
                                    <div class="d-info-nv">
                                        <img src="../images/Ellipse124.svg" alt="name_nv" class="d-info-img">
                                        <div class="d-cham-cong-td1a">
                                            <p class="d-cham-cong-p">(162) Ngô Ngọc Yến</p>
                                            <p class="d-cham-cong-p1">Nhân viên phòng kĩ thuật</p>
                                        </div>
                                    </div>
                                    <div class="d-email-nv-mobie"><span class="d-email-nv1">Email: </span><p class="d-email-nv">sieucapvippro@gmail.com</p></div>
                                    <div class="d-email-nv-mobie"><span class="d-email-nv1">Số điện thoại: </span><p class="d-email-nv">0344848666</p></div>
                                    <div class="d-email-nv-mobie"><span class="d-email-nv1">Quyền truy cập: </span><p class="d-email-nv">Nhân viên</p></div>
                                    <div class="d-email-nv1-mobie">
                                        <p class="d-icon-them"></p>
                                        <div class="dropdown-content">
                                            <div class="d-edit-nv">
                                                <a href="javascript:void(0)" class="d-update-nv">Sửa</a>
                                                <a class="d-delete-nv">Xóa</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-ds-nv1" id="ds_nv_chua_duyet">
                                <table class="table-hover d-table-nhan-vien">
                                    <thead>
                                        <tr class="d-table-nv-tr">
                                            <th class="text-center d-table-nv-th d-tb-nv-th1">Thông tin nhân viên ( ID )</th>
                                            <th class="text-center d-table-nv-th">Email</th>
                                            <th class="text-center d-table-nv-th">Số điện thoại</th>
                                            <th class="text-center d-table-nv-th">Quyền truy cập</th>
                                            <th class="text-center d-table-nv-th d-tb-nv-th">
                                                <div class="d-chon-all">Chọn tất cả</div>
                                                <div class="d-img-chon-all"><img src="../images/tick.svg" alt="chon" class="tick-all" id="tick_all"></div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="d-table-nv-tr1">
                                            <td class="text-center d-table-nv-td">
                                                <div class="d-info-nv">
                                                    <img src="../images/Ellipse124.svg" alt="name_nv" class="d-info-img">
                                                    <div class="d-cham-cong-td1a">
                                                        <p class="d-cham-cong-p">(162) Ngô Ngọc Yến</p>
                                                        <p class="d-cham-cong-p1">Nhân viên phòng kĩ thuật</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center d-table-nv-td">
                                                <p class="d-email-nv">sieucapvippro@gmail.com</p>
                                            </td>
                                            <td class="text-center d-table-nv-td">
                                                <p class="d-email-nv">0344848666</p>
                                            </td>
                                            <td class="text-center d-table-nv-td">
                                                <p class="d-email-nv">Nhân viên</p>
                                            </td>
                                            <td class="text-center d-table-nv-td">
                                                <div class="d-edit-nv">
                                                    <img src="../images/tick.svg" alt="chon" class="tick-chon" id="tick_chon">
                                                    <img src="../images/k_chon.svg" alt="bo chon" class="bo-chon" id="bo_chon">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="d-ds-nv-mobile">
                                    <div class="d-ds-nv-chon">
                                        <div class="d-chon-all">Chọn tất cả</div>
                                        <div class="d-img-chon-all"><img src="../images/tick.svg" alt="chon" class="tick-all" id="tick_alls"></div>
                                    </div>
                                    <div class="d-info-nv">
                                        <img src="../images/Ellipse124.svg" alt="name_nv" class="d-info-img">
                                        <div class="d-cham-cong-td1a">
                                            <p class="d-cham-cong-p">(162) Ngô Ngọc Yến</p>
                                            <p class="d-cham-cong-p1">Nhân viên phòng kĩ thuật</p>
                                        </div>
                                    </div>
                                    <div class="d-email-nv-mobie"><span class="d-email-nv1">Email: </span><p class="d-email-nv">sieucapvippro@gmail.com</p></div>
                                    <div class="d-email-nv-mobie"><span class="d-email-nv1">Số điện thoại: </span><p class="d-email-nv">0344848666</p></div>
                                    <div class="d-email-nv-mobie"><span class="d-email-nv1">Quyền truy cập: </span><p class="d-email-nv">Nhân viên</p></div>
                                    <div class="d-email-nv2-mobie">
                                        <div class="d-edit-nv">
                                            <img src="../images/tick.svg" alt="chon" class="tick-chon" id="tick_chon">
                                            <img src="../images/k_chon.svg" alt="bo chon" class="bo-chon" id="bo_chon">
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                        </div>
                    </div>
                </div>
                <div class="d-qly-cham-cong2">
                    <div class="phan-trang">dành cho phân trang</div>
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
                        <img src="../images/close.svg" alt="exit" class="follow-map-img">
                    </button>
                </div>
                <div class="modal-body d-follow-map">
                    <div class="d-follow-map1">
                        <img src="../images/img_map.svg" alt="map" class="d-follow-map1-img">
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
                                                <img src="../images/Ellipse124.svg" alt="ten nv" class="d-follow-map2-v2a-img">
                                                <div class="d-follow-map2-v2b">
                                                    <p class="d-follow-map2-v2a-p">(162) Ngô Ngọc Yến</p>
                                                    <p class="d-follow-map2-v2a-p1">Nhân viên phòng kĩ thuật</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="d-follow-map-td">
                                            <p class="d-follow-map2-v2a-p2">Ca Sáng  ( 08:00 - 11:30 )</p>
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
                        <img src="../images/exit.svg" alt="exit" class="follow-map-img">
                    </button>
                    <h4 class="modal-title d-boloc-p">Lọc tìm kiếm</h4>
                </div>
                <form class="d-modal-boloc">
                    <div class="d-modal-boloc1">
                        <input type="date" value="" id="to_date" name="to_date" class="d-qly-cham-cong1-v1a-input">
                    </div>
                    <div class="d-modal-boloc1">
                        <input type="date" value="" id="from_date" name="from_date" class="d-qly-cham-cong1-v1a-input">
                    </div>
                    <div class="d-modal-boloc1">
                        <select name="chi_nhanh" id="chi_nhanh1" class="d-chi-nhanh">
                            <option value=""></option>
                            <option value="1">dasda</option>
                        </select>
                    </div>
                    <div class="d-modal-boloc1">
                        <select name="phong_ban" id="phong_ban1" class="d-phong-ban">
                            <option value=""></option>
                            <option value="1">1</option>
                        </select>
                    </div>
                    <div class="d-modal-boloc2">
                        <button type="button" class="d-modal-boloc-huy" data-dismiss="modal" aria-hidden="true">Hủy</button>
                        <button type="submit" class="d-modal-boloc-tk">Tìm kiếm</button>
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
                        <img src="../images/exit.svg" alt="exit" class="follow-map-img">
                    </button>
                    <h4 class="modal-title d-boloc-p">Thêm nhân viên</h4>
                </div>                
                <form method="POST" id="them_nv" class="d-modal-boloc">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                            <label class="d-add-staff">Tên nhân sự:</label>
                            <input type="text" value="" id="ten_ns" name="ten_ns" class="d-them-nv-input"
                            placeholder="Mời bạn nhập họ tên">
                            <div class="error" id="err_name"></div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                            <label class="d-add-staff">Email:</label>
                            <input type="text" value="" id="email" name="email" class="d-them-nv-input"
                            placeholder="Mời bạn nhập email đăng nhập">
                            <div class="error" id="err_email"></div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                            <label class="d-add-staff">Mật khẩu:</label>
                            <input type="text" value="" id="mat_khau" name="mat_khau" class="d-them-nv-input"
                            placeholder="Tối thiểu 6 kí tự">
                            <div class="error" id="err_pass"></div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                            <label class="d-add-staff">Nhập lại mật khẩu:</label>
                            <input type="text" value="" id="repass" name="repass" class="d-them-nv-input"
                            placeholder="Tối thiểu 6 kí tự">
                            <div class="error" id="err_repass"></div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                            <label class="d-add-staff">Số điện thoại:</label>
                            <input type="text" value="" id="telephone" name="telephone" class="d-them-nv-input"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                            placeholder="Số điện thoại liên lạc của nhân viên">
                            <div class="error" id="err_sdt"></div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                            <label class="d-add-staff">Quyền truy cập:</label>
                            <select name="truy_cap" id="truy_cap" class="d-chi-nhanh">
                                <option value=""></option>
                                <option value="1">dasda</option>
                            </select>
                            <div class="error" id="err_truycap"></div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                            <label class="d-add-staff">Phòng/ ban làm việc:</label>
                            <select name="phong_ban2" id="phong_ban2" class="d-chi-nhanh">
                                <option value=""></option>
                                <option value="1">dasda</option>
                            </select>
                            <div class="error" id="err_phongban"></div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 d-them-nv">
                            <label class="d-add-staff">Chức vụ đang nắm giữ:</label>
                            <select name="chuc_vu" id="chuc_vu" class="d-phong-ban">
                                <option value=""></option>
                                <option value="1">1</option>
                            </select>
                            <div class="error" id="err_chucvu"></div>
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
    
    <? include('../includes/inc_footer.php') ?>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/select2.min.js"></script>
<script src="../js/Chart.min.js"></script>
<script src="../js/cty/them_nv_cty.js"></script>
<script>
</script>
</body>
</html>
