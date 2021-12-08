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
    <title>Quyền truy cập</title>

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
                <h3 class="d-qly-cham-cong">Quyền truy cập</h3>
                <div class="d-qly-cham-cong1">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <input type="text" class="d-ds-nv-input" placeholder="Nhập từ khóa">
                        </div>
                        <div class= "d-none">
                            <div class="col-md-3 col-sm-6 col-xs-12 d-chii-nhanh">
                                <select name="" id="chii_nhanh" class="d-chi-nhanh1">
                                    <option value="">Chọn chi nhánh</option>
                                    <option value="1">Chi nhánh 1</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 d-phong-bann">
                                <select name="" id="phongg_ban" class="d-chi-nhanh1">
                                    <option value="">Chọn chi nhánh</option>
                                    <option value="1">Chi nhánh 1</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 d-loc-quyenn">
                                <select name="" id="locc_quyen" class="d-chi-nhanh1">
                                    <option value="">Chọn chi nhánh</option>
                                    <option value="1">Chi nhánh 1</option>
                                </select>
                            </div>
                        </div>
                        <div class=" col-xs-12 d-fillter" data-toggle="modal" data-target="#bo_loc">
                            <p class="d-bo-loc-p">Lọc tìm kiếm</p>
                        </div>
                    </div>
                    <div class="d-qly-truy-cap">
                        <div class="d-qly-nhan-vien1">
                            <div class="d-ds-nv1 active" id="ds_nhan_vien">
                                <table class="table-hover d-table-nhan-vien">
                                    <thead>
                                        <tr class="d-table-nv-tr">
                                            <th class="d-table-th d-tb-nv-th1">Thông tin nhân viên ( ID )</th>
                                            <th class="d-table-th d-tb-nv-th">Quyền truy cập</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="d-table-nv-tr1">
                                            <td class="d-table-td">
                                                <div class="d-info-nv">
                                                    <img src="../images/Ellipse124.svg" alt="name_nv" class="d-info-img">
                                                    <div class="d-cham-cong-td1a">
                                                        <p class="d-cham-cong-p">(162) Ngô Ngọc Yến</p>
                                                        <p class="d-cham-cong-p1">Nhân viên phòng kĩ thuật</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="d-table-td">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 d-phan-quyen">
                                                        <select name="" id="phan_quyen" class="d-phan-quyen1">
                                                            <option value=""></option>
                                                            <option value="1">Admin toàn quyền</option>
                                                            <option value="2">Nhân viên</option>
                                                        </select>
                                                    </div>
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
                                    <div class="d-email-nv-mobie">
                                        <div class="row">
                                            <div class="col-xs-12 d-phan-quyen">
                                                <select name="" id="phan_quyen1" class="d-phan-quyen1">
                                                    <option value=""></option>
                                                    <option value="1">Admin toàn quyền</option>
                                                    <option value="2">Nhân viên</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="phan-trang">
                    <div class="pagination">
                        <li><a href="#">&laquo;</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- bộ lọc -->
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
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12 d-chii-nhanh">
                                <select name="" id="chi_nhanh" class="d-chi-nhanh1">
                                    <option value="">Chọn chi nhánh</option>
                                    <option value="1">Chi nhánh 1</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 d-phong-bann">
                                <select name="" id="phong_ban" class="d-chi-nhanh1">
                                    <option value="">Chọn chi nhánh</option>
                                    <option value="1">Chi nhánh 1</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 d-loc-quyenn">
                                <select name="" id="loc_quyen" class="d-chi-nhanh1">
                                    <option value="">Chọn chi nhánh</option>
                                    <option value="1">Chi nhánh 1</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-modal-boloc2">
                            <button type="button" class="d-modal-boloc-huy" data-dismiss="modal" aria-hidden="true">Hủy</button>
                            <button type="submit" class="d-modal-boloc-tk">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
    </div>
    <? include('../includes/inc_footer.php') ?>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/select2.min.js"></script>
<script src="../js/lazysizes.min.js"></script>
<script src="../js/Chart.min.js"></script>
<script>
    $(document).ready(function () {
        $("#phan_quyen").select2({
            width: "100%",
            placeholder: "Cấp quyền truy cập",
        });
        $("#phan_quyen1").select2({
            width: "100%",
            placeholder: "Cấp quyền truy cập",
        });
        $("#chi_nhanh").select2({
            width: "100%",
            placeholder: "Chọn chi nhánh",
        });
        $("#phong_ban").select2({
            width: "100%",
            placeholder: "Chọn phòng ban",
        });
        $("#loc_quyen").select2({
            width: "100%",
            placeholder: "Lọc quyền truy cập",
        });
        $("#chii_nhanh").select2({
            width: "100%",
            placeholder: "Chọn chi nhánh",
        });
        $("#phongg_ban").select2({
            width: "100%",
            placeholder: "Chọn phòng ban",
        });
        $("#locc_quyen").select2({
            width: "100%",
            placeholder: "Lọc quyền truy cập",
        });
    });
</script>
</body>
</html>
