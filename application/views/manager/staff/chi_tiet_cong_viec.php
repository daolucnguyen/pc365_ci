<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết công việc</title>

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style_re.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/menu.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/menu-header.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/nv_qly.css">
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-125014721-1');
    </script>
    <style>
        #link-4 {
            color: #206AA9;
        }

        .q-right-details {
            width: 90%;
            margin: 55px auto;
        }

        .q-details-work-need-job {
            display: inline-block;
            height: auto;
        }

        .l_div_input {
            margin: 5px;
            width: 80%;
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
        }

        .l_input_note {
            border: none;
            background: none;
            padding: 5px 15px;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="q-contain">
        <div class="row q-contain-row">
            <div class="col-lg-3 col-md-3 q-contain-left">
                <? include(APPPATH . '/views/includes/nv_menu_qly.php') ?>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 q-contain-right">
                <? include(APPPATH . '/views/includes/nv_menu_header.php') ?>
                <div class="q-right-details" id="right_details">
                    <div class="q-right-title" id="right_title" data-id="<?= $detailJob['job_id']; ?>">
                        <p>Chi tiết công việc</p>
                        <div id="alert"></div>
                    </div>
                    <div class="q-details-work">
                        <div class="q-work-title">
                            <p><?= $detailJob['job_name']; ?></p>
                        </div>
                        <div class="q-work-nv"><span>Người giao: </span><span><?= $show_info['com_name'] ?></span></div>
                        <div class="q-details-time-address">
                            <div class="q-details-date">
                                <img src="<?= base_url() ?>assets/images/details-work-calenda.png" alt="calendar">
                                <div class="q-details-datetime">
                                    <p><?= date('d/m/Y', $detailJob['job_day_start']) ?> - <?= date('d/m/Y', $detailJob['job_day_end']) ?></p>
                                    <p><?= date('H:i', $detailJob['job_time_in']) ?> - <?= date('H:i', $detailJob['job_time_out']) ?></p>
                                </div>
                            </div>
                            <div class="q-details-date">
                                <img src="<?= base_url() ?>assets/images/details-work-location.png" alt="location">
                                <div class="q-details-datetime">
                                    <p><?= $detailJob['cit_name'] ?> -
                                        <?
                                        foreach ($show_city as $key => $cit) {
                                            if ($cit['cit_id'] == $detailJob['job_city']) {
                                                echo $cit['cit_name'];
                                            }
                                        }
                                        ?>
                                    </p>
                                    <p><?= $detailJob['job_address'] ?></p>
                                </div>
                            </div>
                        </div>
                        <p class="q-details-title">Thành Viên Tham Gia</p>
                        <div class="q-details-join">
                            <?
                            foreach ($showJobPra as $valuePra) {
                                if ($valuePra['job_id'] == $detailJob['job_id']) {
                                    foreach ($arr_staff as $key => $value_staff) {
                                        if ($valuePra['staff_id'] == $value_staff['ep_id']) {

                            ?>
                                            <div class="q-details-member">
                                                <div class="q-details-member-avatar">
                                                    <img src="<?= $value_staff['avatar']; ?>" alt="name" class="d-lich-map-v5-img" onerror='this.onerror=null;this.src="<? base_url() ?>/images_staff/avatar_default.png";'>
                                                </div>
                                                <div class="q-details-member-name">
                                                    <p>(<?= $value_staff['ep_id'] ?>)<?= $value_staff['ep_name'] ?></p>
                                                </div>
                                            </div>
                            <?
                                        }
                                    }
                                }
                            }
                            ?>
                        </div>
                        <p class="q-details-title">Ghi Chú</p>
                        <p class="q-details-note"><?= $detailJob['note'] ?></p>

                        <p class="q-details-title">Việc Cần Làm</p>
                        <form action="" class="q-details-work-need" onsubmit="updateJObContent(); return false;">
                            <div class="q-details-work-need-v2">
                                <?
                                foreach ($show_job_content as $value) {
                                ?>
                                    <div class=" q-details-work-need-job">
                                        <div>
                                            <input <?
                                                    if ($value['status'] == 1) {
                                                        echo 'checked';
                                                    }
                                                    ?> type="checkbox" value="<?= $value['id'] ?>" class="q-input-checkbox" id="content<?= $value['id'] ?>">
                                            <label class="q-label-checkbox" for="content<?= $value['id'] ?>"><?= $value['content'] ?></label>
                                        </div>
                                        <div class="l_div_input">
                                            <input type="text" name="" class="l_input_note" id="" placeholder="Ghi chú">
                                        </div>
                                    </div>
                                <?
                                }
                                ?>
                            </div>
                            <div class="q-details-update">
                                <button type="button" class="q-details-update-submit" onclick="updateJObContent(); return false;">Cập Nhật Việc Cần Làm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <? include(APPPATH . '/views/includes/inc_footer.php') ?>
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script>
        var base_url = "";
        $(document).ready(function() {});

        function updateJObContent() {
            var l_input_note = $('.l_input_note');
            var note = '';
            for (var i = 0; i < l_input_note.length; i++) {
                if (l_input_note[i].value != '') {
                    note += l_input_note[i].value + '||';
                }
            }
            var job_id = $('#right_title').attr('data-id');
            var checked = [];
            $(".q-input-checkbox").each(function() {
                if ($(this).is(":checked")) {
                    checked.push($(this).val());
                }
            });
            var noChecked = [];
            $(".q-input-checkbox").each(function() {
                if (!$(this).is(":checked")) {
                    noChecked.push($(this).val());
                }
            });
            var data = new FormData();
            data.append('checked', checked);
            data.append('noChecked', noChecked);
            data.append('job_id', job_id);
            data.append('note', note);
            $.ajax({
                type: 'post',
                url: base_url + "/staff/StaffController/updateStatusJob",
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
                        $("#alert").append('<div class="alert-success_error">' + response.message + '</div>');
                        setTimeout(function() {
                            $(".alert-success_error").fadeOut(1000, function() {});
                        }, 1500);
                    }
                },

            });
        }
    </script>
</body>

</html>