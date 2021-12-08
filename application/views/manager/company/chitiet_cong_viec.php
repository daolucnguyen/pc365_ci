<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết công việc</title>

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/quan_ly_cty.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-125014721-1');
    </script>
    <style>
        .ql_giaoviec {
            color: #206AA9;
        }

        .l_text_department {
            font-weight: 500;
            font-size: 18px;
            line-height: 140%;
            margin: 10px 0;
            color: #888888;
        }

        .d-detail-job-v3a{
            flex-wrap: wrap;
        }

        .d-detail-job-v3a-1 {
            text-align: center;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="d-quan-ly-cty">
        <div class="l_block_sidebar">
            <?php include APPPATH . "views/includes/sidebar_left_cty.php"; ?>
        </div>
        <div class="d-quan-ly-cty1">
            <?php include APPPATH . "views/includes/header_manager.php"; ?>
            <div class="d-qly-cty1-v1">
                <h2 class="d-qly-cham-cong">Chi tiết công việc</h2>
                <div id="alert"></div>
                <div class="d-job-detail">
                    <h3 class="d-detail-job"><?= $infoJob['job_name'] ?></h3>
                    <p class="d-detail-job-v1">Người giao: <span class="d-detail-job-v1a"><?= $detail_company['com_name'] ?></span></p>
                    <div class="d-detail-job-v2">
                        <div class="col-md-6 col-sm-6 col-xs-12 d-detail-job-v2a">
                            <div class="d-detail-job-img">
                                <img src="<?= base_url() ?>assets/images/lich.svg" alt="lich" class="d-detail-img">
                            </div>
                            <div class="d-detail-job-div">
                                <p class="d-detail-job-p"><?= date('d-m-Y', $infoJob['job_day_start']) ?> || <?= date('d-m-Y', $infoJob['job_day_end']) ?></p>
                                <p class="d-detail-job-p1"><?= date('H:i', $infoJob['job_time_in']) ?> - <?= date('H:i', $infoJob['job_time_out']) ?></p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 d-detail-job-v2a">
                            <div class="d-detail-job-img">
                                <img src="<?= base_url() ?>assets/images/diachi.svg" alt="dia chi" class="d-detail-img">
                            </div>
                            <div class="d-detail-job-div">
                                <p class="d-detail-job-p"><?= $infoJob['job_address'] ?></p>
                                <p class="d-detail-job-p1"><?= $infoJob['job_address'] ?>, <?= $infoJob['cit_name'] ?>,
                                    <?
                                    foreach ($show_city as $value) {
                                        if ($value['cit_id'] == $infoJob['job_city']) {
                                            echo $value['cit_name'];
                                        }
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <h3 class="d-detail-job-v3">Thành viên tham gia</h3>
                    <div class="d-detail-job-v3a">
                        <?
                        foreach ($listStaffByJob as $staff) {
                        ?>
                            <div class="d-detail-job-v3a-1">
                                <img src="https://chamcong.24hpay.vn/upload/employee/<?= $staff->ep_image ?>" alt="ten" class="d-detail-job-img" onerror='this.onerror=null;this.src="<?= base_url() ?>assets/images/avt_login.svg";'>
                                <p class="d-detail-job-v3a-1p">(<?= $staff->ep_id ?>)<?= $staff->ep_name ?></p>
                            </div>
                        <?
                        }
                        ?>

                    </div>
                    <h3 class="d-detail-job-v3">Phòng ban</h3>

                    <div class="l_department">
                        <?
                        foreach ($department as $dep) {
                        ?>
                            <div class="l_text_department"><?= $dep ?></div>
                        <?
                        }
                        ?>

                    </div>
                    <h3 class="d-detail-job-v3">Ghi chú</h3>
                    <span class="d-detail-job-v3b"><?= $infoJob['note'] ?></span>
                    <h3 class="d-detail-job-v3">Ghi chú của nhân viên</h3>
                    <?
                    foreach ($getJobNote as $key => $value) {
                        foreach ($show_staff as $staff) {
                            if ($staff->staff_id == $value['staff_id']) {
                    ?>
                                <span class="d-detail-job-v3b">(<?= $value['staff_id'] ?>)<?= $staff->name_staff ?>: <?= $value['note'] ?></span>
                    <?
                            }
                        }
                    }
                    ?>
                    <form method="POST" class="d-detail-job-v4">
                        <h3 class="d-detail-job-v3">Việc cần làm</h3>
                        <div class="d-detail-job-v4a">
                            <?
                            foreach ($show_job_content as $value) {
                                $dem = 0;
                                $check = 0;
                                foreach ($job_content as $content) {
                                    if ($content['content_staff_id'] == $value['id']) {
                                        if ($content['status'] == 1) {
                                            $check++;
                                        }
                                        $dem++;
                                    }
                                }
                            ?>
                                <div class="col-md-4 col-sm-4 col-xs-12 d-detail-job-v4a-1" id="content<?= $value['id'] ?>">
                                    <input type="checkbox" <?
                                                            if ($check == $dem) {
                                                                echo "checked";
                                                            }
                                                            ?> name="kv1" id="<?= $value['id'] ?>" value="<?= $value['id'] ?>" class="d-detail-job-checkbox">
                                    <label for="<?= $value['id'] ?>" class="d-detail-job-label"><?= $value['content'] ?></label>
                                </div>
                            <?
                            }
                            ?>
                        </div>

                        <div class="d-detail-job-v5" style="margin-top: 30px;">
                            <button type="reset" onclick="deleteJObContent();" class="d-detail-reset d-detail-a">
                                xóa việc cần làm
                            </button>
                            <button type="button" onclick="updateJObContent(<?= $infoJob['job_id'] ?>);" class="d-detail-submit d-dtail-a2">
                                Cập nhật việc cần làm
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
    <? include(APPPATH . 'views/includes/inc_footer.php') ?>
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/lazysizes.min.js"></script>
    <script src="<?= base_url() ?>assets/js/Chart.min.js"></script>
    <script>
        var base_url = "/";
        $(document).ready(function() {
            $('.d-detail-job-p2').click(function() {
                if (!$(this).hasClass("active")) {
                    $(this).addClass("active");
                }
            });
            $('.d-detail-reset').click(function() {
                $('.d-detail-job-p2').removeClass('active');
            });
        });

        function updateJObContent(id) {
            var checked = [];
            $(".d-detail-job-checkbox").each(function() {
                if ($(this).is(":checked")) {
                    checked.push($(this).val());
                }
            });
            var noChecked = [];
            $(".d-detail-job-checkbox").each(function() {
                if (!$(this).is(":checked")) {
                    noChecked.push($(this).val());
                }
            });
            var data = new FormData();
            data.append('job_id', id);
            data.append('checked', checked);
            data.append('noChecked', noChecked);
            $.ajax({
                type: 'post',
                url: base_url + "company/Company_controller/updateStatusJob",
                async: false,
                dataType: "JSON",
                contentType: false,
                processData: false,
                data: data,
                success: function(response) {
                    // console.log(response);
                    if (response.result == true) {
                        $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {});
                        }, 1500);
                    } else {
                        // return false;
                    }
                },

            });
        }

        function deleteJObContent() {
            var checked = [];
            $(".d-detail-job-checkbox").each(function() {
                if ($(this).is(":checked")) {
                    checked.push($(this).val());
                }
            });

            var data = new FormData();
            data.append('checked', checked);
            $.ajax({
                type: 'post',
                url: base_url + "company/Company_controller/deleteJObContent",
                async: false,
                dataType: "JSON",
                contentType: false,
                processData: false,
                data: data,
                success: function(response) {
                    if (response.result == true) {
                        for (let index = 0; index < checked.length; index++) {
                            $('#content' + checked[index]).html('');
                        }
                        $("#alert").append('<div class="alert-success">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {});
                        }, 1500);
                    } else {
                        return false;
                    }
                },

            });
        }
    </script>
</body>

</html>