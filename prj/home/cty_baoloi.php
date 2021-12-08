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
    <title>Báo Lỗi</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/select2.min.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/quan_ly_cty.css">
    <link rel="stylesheet" href="../css/nv_qly.css">
    <link rel="stylesheet" href="../css/cty_qly.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="d-quan-ly-cty">
        <?php include "../includes/sidebar_left_cty.php";?>
        <div class="d-quan-ly-cty1">
            <?php include "../includes/header_manager.php";?>
            <div class="d-qly-cty1-v1">
                <h3 class="q-qly-thongtin-title">Báo lỗi</h3>
                <form  class="q-cty-baoloi">
                    <p class="q-cty-baoloi-title">Tải hình ảnh: </p>
                    <input type="file" name="" class="q-cty-upload-input" id="cty_baoloi_input_img" multiple>
                    <div class="q-cty-baoloi-upload">
                        
                    </div>
                        <div class="q-cty-baoloi-upload-img">
                            <img src="../images/plus.png" alt="plus">
                        </div>
                        <p class="val_error" id="val_baoloi_img"></p>
                    <p class="q-cty-baoloi-title">Nội dung chi tiết: </p>
                    <textarea style="resize: none;" name="" id="cty_baoloi_text" cols="30" rows="10" class="q-cty-baoloi-content" placeholder="Hãy cho chúng tôi biết rõ tình trạng lỗi bạn đã gặp."></textarea>
                    <p class="val_error" id="val_baoloi_text"></p>
                    <div class="q-cty-baoloi-button">
                        <input type="reset" name="" class="reform-nv-update reform-cty-update reform-baoloi" id="reform_baoloi" value="Nhập Lại"></input>
                        <button type="submit" name="" class="submit-cty-baoloi" id="submit_baoloi">Báo Lỗi</button>
                        <button type="button" name="" class="submit-cty-baoloi" id="submit_baoloi_modal" data-toggle="modal" data-target="#modal_baoloi">Báo Lỗi</button>
                    </div>

                    <div id="modal_baoloi" class="modal fade q-modal-baoloi" role="dialog">
                        <div class="modal-dialog q-modal-baoloi-dialog">
                            <div class="modal-content q-modal-baoloi-content">
                                <div class="modal-header q-modal-header">
                                    <button type="button" class="q-modal-header-button" data-dismiss="modal"><img src="../images/x.png" alt="x"></button>
                                    <p class="modal-title q-modal-title">Báo Lỗi Thành Công</p>
                                </div>
                                <div class="modal-body q-modal-body">
                                    <div class="q-modal-body-img">
                                        <img src="../images/modal-baoloi-frame.png" alt="frame">
                                    </div>
                                    <p class="q-modal-body-title">PunchClock<span>365</span> rất tiếc khi bạn gặp phải trường hợp này</p>
                                    <p class="q-modal-body-title-2">Chúng tôi sẽ nhanh chóng sửa lỗi để không làm gián đoán trải nghiệm của bạn</p>
                                    <div class="q-modal-body-button-div">
                                        <button type="button" class="q-modal-body-button" data-dismiss="modal">Xác Nhận</button>
                                    </div>
                                </div>
                            </div>
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
<script src="../js/validate_nv/validate_nv.js"></script>
<script>
    $(document).ready(function () {
        $('.d-dropdown').hover(function(){
            $(this).attr('src','../images/them1.svg');},
            function(){
            $(this).attr('src','../images/them.svg');
        });

        $('#cty_update_avatar').click(function(){
            $('#input_cty_avatar').click();
        });

        $('.q-cty-baoloi-upload-img').click(function(){
            $('#cty_baoloi_input_img').click();
        });
        
        $("#cty_baoloi_input_img").on('change', function () {
            var countFiles = $(this)[0].files.length;
            if(countFiles < 7) {
                var imgPath = $(this)[0].value;
                var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                var image_holder = $(".q-cty-baoloi-upload");
                image_holder.empty();

                if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                    if (typeof (FileReader) != "undefined") {
                        for (var i = 0; i < countFiles; i++) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $("<img />", {
                                    "src": e.target.result,
                                        "class": "q-cty-baoloi-img"
                                }).appendTo(image_holder);
                            }
                            image_holder.show();
                            reader.readAsDataURL($(this)[0].files[i]);
                        }

                    } else {
                        alert("Trình duyệt không hỗ trợ");
                    }
                } else {
                    alert("Vui lòng chọn ảnh");
                }
            }else{
                alert("Giới hạn ảnh là 6");
            }
            $('.reform-nv-update').click(function () {
                $('.q-cty-baoloi-img').remove();
            });
            $('#submit_baoloi').click(function () {
                $('.q-cty-baoloi-img').remove();
            });
        });
    });
    function deletes(e) {
        dom_parent = $(e).parent().remove();
    }
</script>
</body>
</html>
