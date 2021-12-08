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
    <title>Đăng ký nhân viên 4</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/style_re.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/nv_out.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400&display=swap" rel="stylesheet">
</head>
<body>
    <div class="header">
        <?php include "../includes/inc_header_nv.php";?>

    </div>

    <div class="q-content-4">
        <div class="q-banner-regis-1">
            <span>ĐĂNG KÍ NHÂN VIÊN</span>
        </div>
        <div class="q-regis-4">
            <div class="q-form-regis-4">
                <div class="q-form-header-1" id="form-header-3">
                    <img src="../images/regis-1-active.png" alt="res1" class="q-form-img">
                    <img src="../images/Line 3-active.png" alt="line" class="q-form-img-line">
                    <img src="../images/regis-2-active.png" alt="res2" class="q-form-img">
                    <img src="../images/Line 3-active.png" alt="line" class="q-form-img-line">
                    <img src="../images/regis-3-active.png" alt="res3" class="q-form-img">
                    <img src="../images/Line 3-active.png" alt="line" class="q-form-img-line">
                    <img src="../images/regis-4-active.png" alt="res4" class="q-form-img">
                </div>
                <div class="q-form-body-4">    
                    <form action="" class="q-form-body-4">
                        <div class="q-upload-4">
                            <div class="q-upload-4-v2">
                                <div class="image-upload">
                                    <label for="file-input">
                                        <img src="../images/regis-4-upload.png"/>
                                    </label>
                                    <input id="file-input" type="file" multiple/>
                                </div>
                                <p>Tải lên ít nhất 3 ảnh gương mặt để sử dụng face ID</p>          
                            </div>
                        </div>
                        <div class="q-regis-show-upload">
                            <!-- <div class="q-regis-show-item">
                                <div class="q-show-image"></div>
                                <div class="q-show-info">
                                    <div class="q-show-name"></div>
                                    <div class="q-show-size"></div>
                                </div>
                                <img src="../images/Delete.png" alt="delete" class="q-show-delete">
                            </div> -->
                        </div>
                        <div class="q-form-button">
                            <a href="../home/nv_dangky_3.php" name="submit-regis-2" class="input-reform-4"><span>Quay Lại</span></a>
                            <button name="submit-regis-2" class="input-submit-4"><span>Tiếp Theo</span></button>
                            <button type="submit" name="submit-regis-3" class="input-confirm-4 hide"><span>Hoàn Tất Đăng Kí</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <? include('../includes/inc_footer.php') ?>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".input-submit-4").click(function(){
                $("#file-input").click();
            });
            $('#file-input').change(function(){
                if($(this).val().length >= 3){
                    $('.input-submit-4').hide();
                    $('.input-confirm-4').removeClass('hide');
                    $('.q-show-upload').removeClass('hide');
                }
            });
            // upload ảnh
            $("#file-input").on('change', function () {
                
            });

        });
    </script>
</body>
</html>