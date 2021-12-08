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
    <title>Danh sách công ty con</title>

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
                <h3 class="d-qly-cham-cong">Danh sách công ty con</h3>
                <div class="d-ds-cty-con">
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-xs-12 d-ds-cty-con1">
                            <input type="text" class="d-ds-cty-input" placeholder="Nhập từ khóa">
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 d-ds-cty-con2">
                            <select name="" id="cong_ty" class="s-ds-cty-con2-1">
                                <option value="">Chọn công ty</option>
                                <option value="1">cty 1</option>
                            </select>
                        </div>
                        <div class="col-md-5 col-sm-6 col-xs-12 d-ds-cty-con3">
                            <p class="d-ds-cty-con3-1" data-toggle="modal" data-target="#them_cty">Thêm công ty</p>
                        </div>
                    </div>
                </div>
                <div class="d-ds-cty-con2a">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12 d-ds-cty-con2a-1">
                            <div class="d-ds-cty-con2-v1">
                                <div class="d-ds-cty-con2-v11">
                                    <div class="d-ds-cty-con-img">
                                        <img src="../images/logo_cty.svg" alt="logo công ty" class="d-ds-cty-con-logo">
                                    </div>
                                    <div class="d-ds-cty-con2-v1a">
                                        <h3 class="d-ds-cty-con2-p">Công ty cổ phần dịch vụ thương mại số 365</h3>
                                        <p class="d-ds-cty-con2-p2">ID: 012345</p>
                                        <p class="d-ds-cty-con2-p3">Số điện thoại: 
                                            <span class="d-ds-cty-con2-span">0123456789</span>
                                        </p>
                                        <p class="d-ds-cty-con2-p3">Địa chỉ: Hà Nội</p>
                                    </div>
                                </div>
                                <div class="d-ds-cty-con2a-2">
                                    <p class="d-ds-cty-xoa">Xóa</p>
                                    <p class="d-ds-cty-sua" data-toggle="modal" data-target="#sua_cty">Sửa</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 d-ds-cty-con2a-1">
                            <div class="d-ds-cty-con2-v1">
                                <div class="d-ds-cty-con2-v11">
                                    <div class="d-ds-cty-con-img">
                                        <img src="../images/logo_cty.svg" alt="logo công ty" class="d-ds-cty-con-logo">
                                    </div>
                                    <div class="d-ds-cty-con2-v1a">
                                        <h3 class="d-ds-cty-con2-p">Công ty cổ phần dịch vụ thương mại số 365</h3>
                                        <p class="d-ds-cty-con2-p2">ID: 012345</p>
                                        <p class="d-ds-cty-con2-p3">Số điện thoại: 
                                            <span class="d-ds-cty-con2-span">0123456789</span>
                                        </p>
                                        <p class="d-ds-cty-con2-p3">Địa chỉ: Hà Nội</p>
                                    </div>
                                </div>
                                <div class="d-ds-cty-con2a-2">
                                    <p class="d-ds-cty-xoa">Xóa</p>
                                    <p class="d-ds-cty-sua" data-toggle="modal" data-target="#sua_cty">Sửa</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 d-ds-cty-con2a-1">
                            <div class="d-ds-cty-con2-v1">
                                <div class="d-ds-cty-con2-v11">
                                    <div class="d-ds-cty-con-img">
                                        <img src="../images/logo_cty.svg" alt="logo công ty" class="d-ds-cty-con-logo">
                                    </div>
                                    <div class="d-ds-cty-con2-v1a">
                                        <h3 class="d-ds-cty-con2-p">Công ty cổ phần dịch vụ thương mại số 365</h3>
                                        <p class="d-ds-cty-con2-p2">ID: 012345</p>
                                        <p class="d-ds-cty-con2-p3">Số điện thoại: 
                                            <span class="d-ds-cty-con2-span">0123456789</span>
                                        </p>
                                        <p class="d-ds-cty-con2-p3">Địa chỉ: Hà Nội</p>
                                    </div>
                                </div>
                                <div class="d-ds-cty-con2a-2">
                                    <p class="d-ds-cty-xoa">Xóa</p>
                                    <p class="d-ds-cty-sua" data-toggle="modal" data-target="#sua_cty">Sửa</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 d-ds-cty-con2a-1">
                            <div class="d-ds-cty-con2-v1">
                                <div class="d-ds-cty-con2-v11">
                                    <div class="d-ds-cty-con-img">
                                        <img src="../images/logo_cty.svg" alt="logo công ty" class="d-ds-cty-con-logo">
                                    </div>
                                    <div class="d-ds-cty-con2-v1a">
                                        <h3 class="d-ds-cty-con2-p">Công ty cổ phần dịch vụ thương mại số 365</h3>
                                        <p class="d-ds-cty-con2-p2">ID: 012345</p>
                                        <p class="d-ds-cty-con2-p3">Số điện thoại: 
                                            <span class="d-ds-cty-con2-span">0123456789</span>
                                        </p>
                                        <p class="d-ds-cty-con2-p3">Địa chỉ: Hà Nội</p>
                                    </div>
                                </div>
                                <div class="d-ds-cty-con2a-2">
                                    <p class="d-ds-cty-xoa">Xóa</p>
                                    <p class="d-ds-cty-sua" data-toggle="modal" data-target="#sua_cty">Sửa</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 d-ds-cty-con2a-1">
                            <div class="d-ds-cty-con2-v1">
                                <div class="d-ds-cty-con2-v11">
                                    <div class="d-ds-cty-con-img">
                                        <img src="../images/logo_cty.svg" alt="logo công ty" class="d-ds-cty-con-logo">
                                    </div>
                                    <div class="d-ds-cty-con2-v1a">
                                        <h3 class="d-ds-cty-con2-p">Công ty cổ phần dịch vụ thương mại số 365</h3>
                                        <p class="d-ds-cty-con2-p2">ID: 012345</p>
                                        <p class="d-ds-cty-con2-p3">Số điện thoại: 
                                            <span class="d-ds-cty-con2-span">0123456789</span>
                                        </p>
                                        <p class="d-ds-cty-con2-p3">Địa chỉ: Hà Nội</p>
                                    </div>
                                </div>
                                <div class="d-ds-cty-con2a-2">
                                    <p class="d-ds-cty-xoa">Xóa</p>
                                    <p class="d-ds-cty-sua" data-toggle="modal" data-target="#sua_cty">Sửa</p>
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
        <!-- thêm công ty -->
        <div class="modal fade" id="them_cty">
            <div class="modal-dialog d-them-cty">
                <div class="modal-content d-modal-bo-loc1">
                    <div class="modal-header d-modal-bo-loc2">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <img src="../images/exit.svg" alt="exit" class="follow-map-img">
                        </button>
                        <h4 class="modal-title d-boloc-p">Thêm công ty con</h4>
                    </div>
                    <form method="POST" class="d-form-them-cty" id="add_company">
                        <p class="d-logo-cty">Logo công ty ( Nếu có )</p>
                        <div class="img-user-ntd">
                            <img src="../images/avt_ntd.svg" alt="avt" class="img-user" id="avatar"
                            onerror='this.onerror=null;this.src="../images/avt_ntd.svg";'>
                            <input type="file" name="avatar" id="user-img" onchange="changeImg(this)" class="hidden">
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
                            <input type="text" class="d-form-input telephone" id="telephone" name="telephone"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Nhập số điện thoại liên hệ">
                            <div class="error" id="err_sdt"></div>
                        </div>
                        <div class="d-fomr-them-cty1">
                            <input type="text" class="d-form-input dia-chi" id="dia_chi" name="dia_chi" placeholder="Nhập địa chỉ">
                            <div class="error" id="err_address"></div>
                        </div>
                        <div class="d-button-them-cty">
                            <button type="reset" class="d-them-cty-reset">Nhập lại</button>
                            <button type="submit" class="d-them-cty-submit">Tạo công ty</button>
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
                            <img src="../images/exit.svg" alt="exit" class="follow-map-img">
                        </button>
                        <h4 class="modal-title d-boloc-p">Sửa công ty con</h4>
                    </div>
                    <form method="POST" class="d-form-them-cty" id="edit_company">
                        <p class="d-logo-cty">Logo công ty ( Nếu có )</p>
                        <div class="img-user-ntd">
                            <img src="../images/avt_ntd.svg" alt="avt" class="img-user" id="avatar"
                            onerror='this.onerror=null;this.src="../images/avt_ntd.svg";'>
                            <input type="file" name="avatar" id="user-img" onchange="changeImg(this)" class="hidden">
                        </div>
                        <div class="d-fomr-them-cty1">
                            <input type="text" class="d-form-input ten-cty" id="ten_ctyy" name="ten_cty" placeholder="Nhập tên công ty">
                            <div class="error" id="err_namee"></div>
                        </div>
                        <div class="d-fomr-them-cty1">
                            <input type="text" class="d-form-input email" id="emaill" name="email" placeholder="Nhập email liên hệ">
                            <div class="error" id="err_emaill"></div>
                        </div>
                        <div class="d-fomr-them-cty1">
                            <input type="text" class="d-form-input telephone" id="telephonee" name="telephone"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Nhập số điện thoại liên hệ">
                            <div class="error" id="err_sdtt"></div>
                        </div>
                        <div class="d-fomr-them-cty1">
                            <input type="text" class="d-form-input dia-chi" id="dia_chii" name="dia_chi" placeholder="Nhập địa chỉ">
                            <div class="error" id="err_addresss"></div>
                        </div>
                        <div class="d-button-them-cty">
                            <button type="reset" class="d-them-cty-reset">Nhập lại</button>
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
<script src="../js/cty/them_cty.js"></script>
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
</script>
</body>
</html>
