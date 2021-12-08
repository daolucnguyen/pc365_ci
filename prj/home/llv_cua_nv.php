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
    <title>Lịch làm việc của nhân viên</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/select2.min.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/quan_ly_cty.css">
</head>
<body>
    <div class="d-quan-ly-cty">
        <?php include "../includes/sidebar_left_cty.php";?>
        <div class="d-quan-ly-cty1">
            <?php include "../includes/header_manager.php";?>
            <div class="d-qly-cty1-v1">
                <h3 class="d-qly-cham-cong">Lịch làm việc của nhân viên</h3>
                <div class="d-qly-cham-cong1">
                    <div class="d-ds-cty-con">
                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12 d-ds-cty-con1">
                                <input type="text" class="d-ds-cty-input" placeholder="Nhập từ khóa">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 d-ds-cty-con2">
                                <input type="date" class="d-ds-cty-input">
                            </div>
                            <!-- <div class="col-md-4 col-sm-12 col-xs-12 d-ds-cty-con3">
                                <a href="/danh-cho-cong-ty/thiet-lap-lich-lam-viec.html" class="d-ds-cty-con3-1 d-ds-ca-lam">Thêm ca làm việc</a>
                            </div> -->
                        </div>
                    </div>
                    <div class="d-qly-cham-cong1-v3">
                        <div class="d-qly-nhan-vien1">
                            <div class="d-ds-nv1 active">
                                <table class="table-hover d-table-nhan-vien">
                                    <thead>
                                        <tr class="d-table-nv-tr">
                                            <th class="d-table-th d-tb-nv-th1">Thông tin nhân viên ( ID )</th>
                                            <th class="d-table-th">Lịch làm việc đang theo</th>
                                            <th class="d-table-th d-hover-th"></th>
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
                                                <p class="d-email-nv">Lịch làm việc tháng 4</p>
                                            </td>
                                            <td class="d-table-td">
                                                <div class="d-hover-edit">
                                                    <a data-toggle="modal" data-target="#sua_llv" class="d-update-nv">Sửa</a>
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
                                    <div class="d-email-nv-mobie"><p class="d-ds-nv-co-lich">Lịch làm việc tháng 4</p></div>
                                    <div class="d-email-nv1-mobie">
                                        <p class="d-icon-them"></p>
                                        <div class="dropdown-content">
                                            <div class="d-edit-nv">
                                                <a data-toggle="modal" data-target="#sua_llv" class="d-update-nv">Sửa</a>
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

        <!-- sửa ca làm việc -->
        <div class="modal fade" id="sua_llv">
            <div class="modal-dialog d-them-cty">
                <div class="modal-content d-modal-bo-loc1">
                    <div class="modal-header d-modal-bo-loc2">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <img src="../images/exit.svg" alt="exit" class="follow-map-img">
                        </button>
                        <h4 class="modal-title d-boloc-p">Sửa lịch làm việc</h4>
                    </div>
                    <form method="post" class="d-form-them-cty" id="sua_llv">
                        <div class="d-fomr-them-cty1">
                            <select name="chon_llv" id="chon_llv" class="d-llv-nv">
                                <option value="">Chọn lịch làm việc đang có</option>
                                <option value="1">Tháng 4</option>
                            </select>
                            <div class="error" id="err_llv"></div>
                        </div>
                        <div class="d-button-them-cty">
                            <button type="reset" class="d-them-cty-reset" data-dismiss="modal" aria-hidden="true">Hủy</button>
                            <button type="submit" class="d-them-cty-submit">Cập nhật</button>
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
<script>
    $(document).ready(function () {
        $("#chon_llv").select2({
            width: '100%',
            placeholder: "Chọn lịch làm việc đang có",

        });
        $("#sua_llv").submit(function(){
            var form_oke = true;
            var form_data = new FormData();
            var arr_id_to_focus = [];
            var chon_llv = $.trim($("#chon_llv").val());
            if (chon_llv == "" || chon_llv == null) {
                $("#err_llv").html("Bạn chưa chọn lịch làm việc");
                arr_id_to_focus.push("chon_llv");
                form_oke = false;
            }else{
                $("#err_llv").html("");
                form_data.append("chon_llv",chon_llv);
            }
            $(arr_id_to_focus[0]).focus();
            // if (form_pke == true) {
            //     $.ajax({
            //         type: "POST",
            //         url: "url",
            //         data: form_data,
            //         dataType: "json",
            //         success: function (response) {
                        
            //         }
            //     });
            // }
            return false;
        });
    });
</script>
</body>
</html>
