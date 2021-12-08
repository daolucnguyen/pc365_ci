<style>
    .ql_chung {
        color: #206AA9;
    }

    .relative {
        position: relative;
        width: 20%;
        /* margin: 0 auto; */
        text-align: center;
    }

    .d-qly-cty1-v1b-a:hover,
    .d-qly-cty1-v1b-a:focus,
    .d-qly-cty1-v1b-a.active {
        top: -18px;
        position: absolute;
        left: 0px;
    }
    @media only screen and (max-width: 540px){
        .relative{
            width: 50%;
        }
        .d-qly-cty1-v1b-a{
            width: 98%;
        }
    }
</style>
<div class="d-qly-cty1-v1">
    <h3 class="d-qly-cty-v1a">Hôm nay, ngày <?= date('d/m/Y', $date) ?></h3>
    <div class="d-qly-cty1-v1b">
        <div class="relative">
            <a href="<?= urlQlyChamCongCty(); ?>" class="d-qly-cty1-v1b-a">
                <p class="d-qly-cty-v1b-img"></p>
                <p class="d-qly-cty-v1b-p">Chấm công</p>
                <p class="d-qly-cty-v1b-p1"><?= $count_time_sheet; ?> Nhân viên</p>
            </a>
        </div>

        <!-- <a href="<?= urlQlyNhanVienCtyActive(1) ?>" class="d-qly-cty1-v1b-a">
            <p class="d-qly-cty-v1b-img1"></p>
            <p class="d-qly-cty-v1b-p">Đi muộn</p>
            <p class="d-qly-cty-v1b-p2"></?= $count_late; ?> Nhân viên</p>
        </a> -->
        <div class="relative">
            <a href="<?= urlQlyGiaoViecCty(); ?>" class="d-qly-cty1-v1b-a">
                <p class="d-qly-cty-v1b-img2"></p>
                <p class="d-qly-cty-v1b-p">Giao việc</p>
                <p class="d-qly-cty-v1b-p3"><?= $count_job; ?> công việc</p>
            </a>
        </div>
        <div class="relative">
            <a href="<?= urlQlyLichTrinhCty(); ?>" class="d-qly-cty1-v1b-a">
                <p class="d-qly-cty-v1b-img3"></p>
                <p class="d-qly-cty-v1b-p">Lịch trình</p>
                <p class="d-qly-cty-v1b-p4"><?= $count_schedule; ?> Lịch trình</p>
            </a>
        </div>
    </div>
    <h3 class="d-qly-cty-v1c">Thống kê nhân viên chấm công trong tuần</h3>
    <div class="d-qly-cty-v1d">
        <canvas id="myChart" class="my-chart"></canvas>
    </div>
</div>