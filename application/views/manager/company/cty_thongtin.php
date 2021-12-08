<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/quan_ly_cty.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/cty_qly.css">
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
        .capnhatthongtin,
        .ql_tk {
            color: #206AA9;
        }

        #menu-manager3 {
            display: block;
        }
    </style>
</head>

<body>
    <div class="d-quan-ly-cty">
        <div class="l_block_sidebar">
            <?php require_once APPPATH . '/views/includes/sidebar_left_cty.php'; ?>
        </div>
        <div class="d-quan-ly-cty1">
            <?php require_once APPPATH . "/views/includes/header_manager.php"; ?>
            <div class="d-qly-cty1-v1">
                <h3 class="q-qly-thongtin-title">Chi Tiết Công Ty</h3>
                <div class="q-qly-cty-thongtin">
                    <div class="q-qly-cty-avatar">
                        <img class="q-qly-cty-avatar-v2" src="<?= $detail_company['com_avatar'] ?>" alt="<?= $detail_company['com_name'] ?>" onerror='this.onerror=null;this.src="<?= base_url() ?>assets/images/logo_com.png";'>
                    </div>
                    <div class="q-qly-cty-qr">

                    </div>
                    <div class="q-qly-cty-info">
                        <p class="q-qly-cty-name"><?= $detail_company['com_name'] ?></p>
                        <p class="q-qly-cty-id">id: <?= $detail_company['com_id'] ?></p>

                        <div class="q-qly-cty-thongtin-collapse">
                            <img src="<?= base_url() ?>assets/images/dot-collapse.png" alt="dot" data-toggle="collapse" data-target="#cty_collapse" class="q-qly-cty-thongtin-collapse-img l_curson">
                        </div>
                        <div class="q-qly-cty-thongtin-collapse-div" id="cty_collapse">
                            <div class="q-qly-cty-thongtin-collapse-div-v2">
                                <a href="<?= urlCapNhatThongTinCty() ?>" class="q-qly-cty-thongtin-collapse-link">Cập nhật</a>
                                <!-- <a href="" class="q-qly-cty-thongtin-collapse-link">Xóa</a> -->
                                <a href="" class="q-qly-cty-thongtin-collapse-link" id="cty_collapse_qr">Mã QR</a>
                            </div>
                        </div>
                    </div>
                    <div class="q-qly-cty-info-v2">
                        <div class="q-qly-cty-row">
                            <div class="q-qly-cty-row-dot"></div>
                            <p class="q-qly-cty-row-tite">Email: </p>
                            <p class="q-qly-cty-row-info" id="cty_email"><?= $detail_company['com_email'] ?> </p>
                        </div>
                        <div class="q-qly-cty-row">
                            <div class="q-qly-cty-row-dot"></div>
                            <p class="q-qly-cty-row-tite">Địa chỉ: </p>
                            <p class="q-qly-cty-row-info" id="cty_address"><?= $detail_company['com_address'] ?> </p>
                        </div>
                        <div class="q-qly-cty-row">
                            <div class="q-qly-cty-row-dot"></div>
                            <p class="q-qly-cty-row-tite">SĐT: </p>
                            <p class="q-qly-cty-row-info" id="cty_phone"><?= $detail_company['com_phone'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <? require_once APPPATH . "/views/includes/inc_footer.php" ?>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.d-dropdown').hover(function() {
                    $(this).attr('src', '<?= base_url() ?>assets/images/them1.svg');
                },
                function() {
                    $(this).attr('src', '<?= base_url() ?>assets/images/them.svg');
                });

            $(".q-qly-cty-thongtin-collapse").click(function(e) {
                $("#cty_collapse").show();
                e.stopPropagation();
            });
            $(document).click(function() {
                $("#cty_collapse").hide();
            });

        });

        function deletes(e) {
            dom_parent = $(e).parent().remove();
        }
    </script>
</body>

</html>