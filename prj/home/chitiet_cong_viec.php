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
    <title>Chi tiết công việc</title>

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
                <h2 class="d-qly-cham-cong">Chi tiết công việc</h2>
                <div class="d-job-detail">
                    <h3 class="d-detail-job">Check AMP của 5 site tin tức</h3>
                    <p class="d-detail-job-v1">Người giao: <span class="d-detail-job-v1a">Hà Thu</span></p>
                    <div class="d-detail-job-v2">
                        <div class="col-md-6 col-sm-6 col-xs-12 d-detail-job-v2a">
                            <div class="d-detail-job-img">
                                <img src="../images/lich.svg" alt="lich" class="d-detail-img">
                            </div>
                            <div class="d-detail-job-div">
                                <p class="d-detail-job-p">Thứ 2, 05/04/2021</p>
                                <p class="d-detail-job-p1">04:00 pm - 06:00pm</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 d-detail-job-v2a">
                            <div class="d-detail-job-img">
                                <img src="../images/diachi.svg" alt="dia chi" class="d-detail-img">
                            </div>
                            <div class="d-detail-job-div">
                                <p class="d-detail-job-p">Địa điểm</p>
                                <p class="d-detail-job-p1">213 Định Công, Hoàng Mai, Hà Nội</p>
                            </div>
                        </div>
                    </div>
                    <h3 class="d-detail-job-v3">Thành viên tham gia</h3>
                    <div class="d-detail-job-v3a">
                        <div class="d-detail-job-v3a-1">
                            <img src="../images/Ellipse124.svg" alt="ten" class="d-detail-job-img"
                            onerror='this.onerror=null;this.src="../images/avt_login.svg";'>
                            <p class="d-detail-job-v3a-1p">Chiến Tuấn</p>
                        </div>
                        <div class="d-detail-job-v3a-1">
                            <img src="../images/Ellipse124.svg" alt="ten" class="d-detail-job-img"
                            onerror='this.onerror=null;this.src="../images/avt_login.svg";'>
                            <p class="d-detail-job-v3a-1p">Chiến Tuấn</p>
                        </div>
                    </div>
                    <h3 class="d-detail-job-v3">Ghi chú</h3>
                    <span class="d-detail-job-v3b">Trước khi đến với những cách nói giới thiệu công việc, mình muốn đảm bảo bạn đang học một cách hiệu quả nhất. Bạn đừng chỉ đọc bài viết một lần rồi thôi, vì nhiều khả năng chỉ một hai tiếng sau bạn sẽ quên ngay những gì vừa đọc. Để biến kiến thức trở thành của mình, làm phong phú thêm vốn từ, ngữ pháp và thực sự áp dụng được nó trong đời thực, điều quan trọng là bạn phải luyện tập nó nhiều lần, thường xuyên.</span>
                    <form method="POST" class="d-detail-job-v4">
                        <h3 class="d-detail-job-v3">Việc cần làm</h3>
                        <div class="d-detail-job-v4a">
                            <div class="col-md-4 col-sm-4 col-xs-12 d-detail-job-v4a-1">
                                <input type="checkbox" name="kv1" id="1" class="d-detail-job-checkbox">
                                <label for="1" class="d-detail-job-label">Dọn dẹp khu ăn uống</label>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 d-detail-job-v4a-1">
                                <input type="checkbox" name="kv1" id="" class="d-detail-job-checkbox">
                                <label for="" class="d-detail-job-label">Dọn dẹp khu ăn uống</label>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 d-detail-job-v4a-1">
                                <input type="checkbox" name="kv1" id="" class="d-detail-job-checkbox">
                                <label for="" class="d-detail-job-label">Dọn dẹp khu ăn uống</label>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 d-detail-job-v4a-1">
                                <input type="checkbox" name="kv1" id="" class="d-detail-job-checkbox">
                                <label for="" class="d-detail-job-label">Dọn dẹp khu ăn uống</label>
                            </div>
                        </div>
                        <h3 class="d-detail-job-v3">Tài liệu liên quan</h3>
                        <div class="d-detail-job-v4b">
                            <div class="col-md-4 col-sm-4 col-xs-12 d-detail-job-v4a-2">
                                <p class="d-detail-job-p2">Tài liệu 1</p>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 d-detail-job-v4a-2">
                                <p class="d-detail-job-p2">Tài liệu 1</p>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 d-detail-job-v4a-2">
                                <p class="d-detail-job-p2">Tài liệu 1</p>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 d-detail-job-v4a-2">
                                <p class="d-detail-job-p2">Tài liệu 1</p>
                            </div>
                        </div>
                        <div class="d-detail-job-v5">
                            <button type="reset" class="d-detail-reset">
                                <a class="d-detail-a">xóa công việc</a>
                            </button>
                            <button type="submit" class="d-detail-submit">
                                <a class="d-dtail-a2">Cập nhật công việc</a>
                            </button>
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
        $('.d-detail-job-p2').click(function(){
            if (!$(this).hasClass("active")) {
                $(this).addClass("active");
            }
        });
        $('.d-detail-reset').click(function(){
            $('.d-detail-job-p2').removeClass('active');
        });
    });
</script>
</body>
</html>
