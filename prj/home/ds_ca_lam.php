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
    <title>Danh sách ca làm</title>

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
                <h3 class="d-qly-cham-cong">Danh sách ca làm</h3>
                <div class="d-ds-cty-con">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12 d-ds-cty-con1">
                            <input type="text" class="d-ds-cty-input" placeholder="Nhập từ khóa">
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 d-ds-cty-con2">
                            <select name="" id="cong_ty" class="s-ds-cty-con2-1">
                                <option value="">Chọn công ty</option>
                                <option value="1">cty 1</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 d-ds-cty-con2">
                            <select name="" id="phong_ban" class="s-ds-cty-con2-1">
                                <option value="">Chọn phòng/ ban</option>
                                <option value="1">phòng  1</option>
                            </select>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 d-ds-calam">
                            <p class="d-ds-cty-con3-1 d-ds-ca-lam" data-toggle="modal" data-target="#them_cty">Thêm ca làm việc</p>
                        </div>
                    </div>
                </div>
                <div class="d-ds-cty-con2a">
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-12 d-ds-cty-con2a-1">
                            <div class="d-ds-phong-ban1">
                                <div>
                                    <p class="d-them-calam">Ca hành chính:</p>
                                    <a href="/danh-cho-cong-ty/danh-sach-nhan-vien-phong-ky-thuat.html" class="d-ds-phong-ban-p">08:00 am - 11:30 am</a>
                                </div>
                                <div class="dropdown d-phong-ban1">
                                    <img class="dropdown-toggle d-ds-phong-banv1" type="button" data-toggle="dropdown" 
                                    src="../images/them.svg">
                                    <ul class="dropdown-menu">
                                        <li><a class="d-phong-ban-1" data-toggle="modal" data-target="#sua_cty">Sửa</a></li>
                                        <li><a class="d-phong-ban-1">Xóa</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12 d-ds-cty-con2a-1">
                            <div class="d-ds-phong-ban1">
                                <div>
                                    <p class="d-them-calam">Ca hành chính:</p>
                                    <a href="/danh-cho-cong-ty/danh-sach-nhan-vien-phong-ky-thuat.html" class="d-ds-phong-ban-p">08:00 am - 11:30 am</a>
                                </div>
                                <div class="dropdown d-phong-ban1">
                                    <img class="dropdown-toggle d-ds-phong-banv1" type="button" data-toggle="dropdown" 
                                    src="../images/them.svg">
                                    <ul class="dropdown-menu">
                                        <li><a class="d-phong-ban-1" data-toggle="modal" data-target="#sua_cty">Sửa</a></li>
                                        <li><a class="d-phong-ban-1">Xóa</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12 d-ds-cty-con2a-1">
                            <div class="d-ds-phong-ban1">
                                <div>
                                    <p class="d-them-calam">Ca hành chính:</p>
                                    <a href="/danh-cho-cong-ty/danh-sach-nhan-vien-phong-ky-thuat.html" class="d-ds-phong-ban-p">08:00 am - 11:30 am</a>
                                </div>
                                <div class="dropdown d-phong-ban1">
                                    <img class="dropdown-toggle d-ds-phong-banv1" type="button" data-toggle="dropdown" 
                                    src="../images/them.svg">
                                    <ul class="dropdown-menu">
                                        <li><a class="d-phong-ban-1" data-toggle="modal" data-target="#sua_cty">Sửa</a></li>
                                        <li><a class="d-phong-ban-1">Xóa</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12 d-ds-cty-con2a-1">
                            <div class="d-ds-phong-ban1">
                                <div>
                                    <p class="d-them-calam">Ca hành chính:</p>
                                    <a href="/danh-cho-cong-ty/danh-sach-nhan-vien-phong-ky-thuat.html" class="d-ds-phong-ban-p">08:00 am - 11:30 am</a>
                                </div>
                                <div class="dropdown d-phong-ban1">
                                    <img class="dropdown-toggle d-ds-phong-banv1" type="button" data-toggle="dropdown" 
                                    src="../images/them.svg">
                                    <ul class="dropdown-menu">
                                        <li><a class="d-phong-ban-1" data-toggle="modal" data-target="#sua_cty">Sửa</a></li>
                                        <li><a class="d-phong-ban-1">Xóa</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12 d-ds-cty-con2a-1">
                            <div class="d-ds-phong-ban1">
                                <div>
                                    <p class="d-them-calam">Ca hành chính:</p>
                                    <a href="/danh-cho-cong-ty/danh-sach-nhan-vien-phong-ky-thuat.html" class="d-ds-phong-ban-p">08:00 am - 11:30 am</a>
                                </div>
                                <div class="dropdown d-phong-ban1">
                                    <img class="dropdown-toggle d-ds-phong-banv1" type="button" data-toggle="dropdown" 
                                    src="../images/them.svg">
                                    <ul class="dropdown-menu">
                                        <li><a class="d-phong-ban-1" data-toggle="modal" data-target="#sua_cty">Sửa</a></li>
                                        <li><a class="d-phong-ban-1">Xóa</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12 d-ds-cty-con2a-1">
                            <div class="d-ds-phong-ban1">
                                <div>
                                    <p class="d-them-calam">Ca hành chính:</p>
                                    <a href="/danh-cho-cong-ty/danh-sach-nhan-vien-phong-ky-thuat.html" class="d-ds-phong-ban-p">08:00 am - 11:30 am</a>
                                </div>
                                <div class="dropdown d-phong-ban1">
                                    <img class="dropdown-toggle d-ds-phong-banv1" type="button" data-toggle="dropdown" 
                                    src="../images/them.svg">
                                    <ul class="dropdown-menu">
                                        <li><a class="d-phong-ban-1" data-toggle="modal" data-target="#sua_cty">Sửa</a></li>
                                        <li><a class="d-phong-ban-1">Xóa</a></li>
                                    </ul>
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
        <!-- Thêm ca làm việc -->
        <div class="modal fade" id="them_cty">
            <div class="modal-dialog d-them-cty">
                <div class="modal-content d-modal-bo-loc1">
                    <div class="modal-header d-modal-bo-loc2">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <img src="../images/exit.svg" alt="exit" class="follow-map-img">
                        </button>
                        <h4 class="modal-title d-boloc-p">Thêm ca làm việc</h4>
                    </div>
                    <form method="post" class="d-form-them-cty" id="them_ca_lam">
                        <div class="d-fomr-them-cty1">
                            <input type="text" class="d-form-input" id="ten_cty" name="ten_cty" placeholder="Chọn công ty">
                            <div class="error" id="err_cty"></div>
                        </div>
                        <div class="d-fomr-them-cty1">
                            <input type="text" class="d-form-input" id="ca_lam" name="ca_lam" placeholder="Nhập tên ca làm việc">
                            <div class="error" id="err_calam"></div>
                        </div>
                        <div class="d-modal-them-calam">
                            <div class="d-them-ca-lam">
                                <p class="d-them-ca-lam-v1">Giờ vào làm:</p>
                                <p class="d-them-ca-lam-v2">( Check in )</p>
                                <input type="text" class="d-them-ca-lam-v3" id="gio_vao" name="gio_vao" placeholder="Nhập tên giờ">
                                <div class="error" id="err_vaolam"></div>
                            </div>
                            <div class="d-them-ca-lam1">
                                <p class="d-them-ca-lam-v1">Giờ hết ca:</p>
                                <p class="d-them-ca-lam-v2">( Check out )</p>
                                <input type="text" class="d-them-ca-lam-v3" id="gio_ra" name="gio_ra" placeholder="Nhập tên giờ">
                                <div class="error" id="err_tanlam"></div>
                            </div>
                        </div>
                        <div class="d-button-them-cty">
                            <button type="reset" class="d-them-cty-reset" data-dismiss="modal" aria-hidden="true">Nhập lại</button>
                            <button type="submit" class="d-them-cty-submit">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- sửa ca làm việc -->
        <div class="modal fade" id="sua_cty">
            <div class="modal-dialog d-them-cty">
                <div class="modal-content d-modal-bo-loc1">
                    <div class="modal-header d-modal-bo-loc2">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <img src="../images/exit.svg" alt="exit" class="follow-map-img">
                        </button>
                        <h4 class="modal-title d-boloc-p">Sửa ca làm việc</h4>
                    </div>
                    <form method="post" class="d-form-them-cty" id="edit_company">
                        <div class="d-fomr-them-cty1">
                            <input type="text" class="d-form-input" id="name_com" name="name_com" placeholder="Chọn công ty">
                            <div class="error" id="err_name"></div>
                        </div>
                        <div class="d-fomr-them-cty1">
                            <input type="text" class="d-form-input" id="ten_ca" name="ten_ca" placeholder="Nhập tên ca làm việc">
                            <div class="error" id="err_tenca"></div>
                        </div>
                        <div class="d-modal-them-calam">
                            <div class="d-them-ca-lam">
                                <p class="d-them-ca-lam-v1">Giờ vào làm:</p>
                                <p class="d-them-ca-lam-v2">( Check in )</p>
                                <input type="text" class="d-them-ca-lam-v3" id="time_in" name="time_in" placeholder="Nhập tên giờ">
                            </div>
                            <div class="d-them-ca-lam1">
                                <p class="d-them-ca-lam-v1">Giờ hết ca:</p>
                                <p class="d-them-ca-lam-v2">( Check out )</p>
                                <input type="text" class="d-them-ca-lam-v3" id="time_out" name="time_out" placeholder="Nhập tên giờ">
                            </div>
                        </div>
                            <div class="error" id="err_time"></div>
                        <div class="d-button-them-cty">
                            <button type="reset" class="d-them-cty-reset" data-dismiss="modal" aria-hidden="true">Nhập lại</button>
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
<script src="../js/cty/them_ca_lam.js"></script>
<script>
</script>
</body>
</html>
