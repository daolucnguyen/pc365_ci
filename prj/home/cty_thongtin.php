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
    <title>Cập nhật thông tin</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/select2.min.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/quan_ly_cty.css">
    <link rel="stylesheet" href="../css/cty_qly.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="d-quan-ly-cty">
        <?php include "../includes/sidebar_left_cty.php";?>
        <div class="d-quan-ly-cty1">
            <?php include "../includes/header_manager.php";?>
            <div class="d-qly-cty1-v1">
                <h3 class="q-qly-thongtin-title">Chi Tiết Công Ty</h3>
                <div class="q-qly-cty-thongtin">
                    <div class="q-qly-cty-avatar">
                        <div class="q-qly-cty-avatar-v2">

                        </div>
                    </div>
                    <div class="q-qly-cty-qr">
                        
                    </div>
                    <div class="q-qly-cty-info">
                        <p class="q-qly-cty-name">name</p>
                        <p class="q-qly-cty-id">id</p>
                        
                        <div class="q-qly-cty-thongtin-collapse">
                            <img src="../images/dot-collapse.png" alt="dot" data-toggle="collapse" data-target="#cty_collapse" class="q-qly-cty-thongtin-collapse-img">
                        </div>
                            <div class="q-qly-cty-thongtin-collapse-div" id="cty_collapse">
                                <div class="q-qly-cty-thongtin-collapse-div-v2">
                                    <a href="/danh-cho-cong-ty/sua-thong-tin-cong-ty.html" class="q-qly-cty-thongtin-collapse-link">Sửa</a>
                                    <a href="" class="q-qly-cty-thongtin-collapse-link">Xóa</a>
                                    <a href="" class="q-qly-cty-thongtin-collapse-link" id="cty_collapse_qr">Mã QR</a>
                                </div>
                            </div>
                    </div>
                    <div class="q-qly-cty-info-v2">
                            <div class="q-qly-cty-row">
                                <div class="q-qly-cty-row-dot"></div>
                                <p class="q-qly-cty-row-tite">Email: </p>
                                <p class="q-qly-cty-row-info" id="cty_email">email </p>
                            </div>
                            <div class="q-qly-cty-row">
                                <div class="q-qly-cty-row-dot"></div>
                                <p class="q-qly-cty-row-tite">Địa chỉ: </p>
                                <p class="q-qly-cty-row-info" id="cty_address">dia chi </p>
                            </div>
                            <div class="q-qly-cty-row">
                                <div class="q-qly-cty-row-dot"></div>
                                <p class="q-qly-cty-row-tite">SĐT: </p>
                                <p class="q-qly-cty-row-info" id="cty_phone">sdt </p>
                            </div>
                        </div>
                </div>
            </div>
        </div>

    </div>


    <? include('../includes/inc_footer.php') ?>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/select2.min.js"></script>
<script src="../js/Chart.min.js"></script>
<script>
    $(document).ready(function () {
        $('.d-dropdown').hover(function(){
            $(this).attr('src','../images/them1.svg');},
            function(){
            $(this).attr('src','../images/them.svg');
        });

        $(".q-qly-cty-thongtin-collapse").click(function(e){ 
            $("#cty_collapse").show();
            e.stopPropagation();
        });
        $(document).click(function(){
            $("#cty_collapse").hide();
        });
    });
    function deletes(e) {
        dom_parent = $(e).parent().remove();
    }
</script>
</body>
</html>
