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
    <title>Danh sách nhân viên phòng kinh doanh</title>

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
                <h3 class="d-qly-cham-cong">Danh sách nhân viên phòng kinh doanh</h3>
                <div class="d-qly-cham-cong1">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="d-ds-nv-input" placeholder="Nhập từ khóa">
                        </div>
                    </div>
                    <div class="d-qly-cham-cong1-v3">
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

    </div>
    <? include('../includes/inc_footer.php') ?>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/select2.min.js"></script>
<script src="../js/lazysizes.min.js"></script>
<script>
    $(document).ready(function () {
    });
</script>
</body>
</html>
