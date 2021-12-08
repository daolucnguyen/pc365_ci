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
    <title>QUẢN LÝ CHUNG</title>

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
                <h3 class="d-qly-cty-v1a">Hôm nay, ngày 17/04/2021</h3>
                <div class="d-qly-cty1-v1b">
                    <a href="javascript:void(0)" class="d-qly-cty1-v1b-a">
                        <p class="d-qly-cty-v1b-img"></p>
                        <p class="d-qly-cty-v1b-p">Chấm công</p>
                        <p class="d-qly-cty-v1b-p1">25 Nhân viên</p>
                    </a>
                    <a href="javascript:void(0)" class="d-qly-cty1-v1b-a">
                        <p class="d-qly-cty-v1b-img1"></p>
                        <p class="d-qly-cty-v1b-p">Đi muộn</p>
                        <p class="d-qly-cty-v1b-p2">50 Nhân viên</p>
                    </a>
                    <a href="javascript:void(0)" class="d-qly-cty1-v1b-a">
                        <p class="d-qly-cty-v1b-img2"></p>
                        <p class="d-qly-cty-v1b-p">Giao việc</p>
                        <p class="d-qly-cty-v1b-p3">100 công việc</p>
                    </a>
                    <a href="javascript:void(0)" class="d-qly-cty1-v1b-a">
                        <p class="d-qly-cty-v1b-img3"></p>
                        <p class="d-qly-cty-v1b-p">Lịch trình</p>
                        <p class="d-qly-cty-v1b-p4">125 Lịch trình</p>
                    </a>
                </div>
                <h3 class="d-qly-cty-v1c">Thống kê nhân viên chấm công trong ngày</h3>
                <div class="d-qly-cty-v1d">
                    <canvas id="myChart" class="my-chart"></canvas>
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
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN' ],
        datasets: [{
            backgroundColor: "#206AA9",
            data: [13, 20, 30, 40, 50, 35, 45],
            label: "Chấm công đúng giờ",
            borderRadius:15,
            Width:10
        }, {
            backgroundColor: "#D4E7F7",
            data: [28, 68, 40, 19, 96, 100, 30],
            label: "Đi muộn/ Về sớm",
            borderRadius:15,
        },{
            backgroundColor: "#E0E0E0",
            data: [28, 68, 40, 19, 96, 20, 30],
            label: "Không chấm công",
            borderRadius:15,
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
            }
        },
        responsive :true,
        maintainAspectRatio: true
    }
});
</script>
</body>
</html>
