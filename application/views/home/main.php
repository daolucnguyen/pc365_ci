<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="<?= (isset($index) ? $index : 'noindex,nofollow') ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <?
    if (isset($Des) && isset($Key)) {
    ?>
        <meta name="description" content="<?= $Des ?>" />
        <meta name="Keywords" content="<?= $Key ?>" />
        <meta property="og:title" content="<?= $title ?>" />
        <meta property="og:description" content="<?= $Des ?>" />

        <meta name="twitter:card" content="summary" />
        <meta name="twitter:description" content="<?= $Des ?>" />
        <meta name="twitter:title" content="<?= $title ?>" />
    <?
    }
    if (isset($google)) {
    ?>
        <meta name="google-site-verification" content="<?= $google; ?>" />
    <?
    }
    ?>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/slick-theme.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/slick.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style_re.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/trangchu.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/<?= (isset($style) ? $style : '') ?>.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-125014721-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-125014721-1');
    </script>
</head>

<body>
    <div class="q-gioithieu">
        <div class="header">
            <? require_once APPPATH . '/views/includes/inc_header_nv.php'; ?>
        </div>
        <?
        // echo $session;
        if (isset($content)) {
            $this->load->view($content);
        }
        ?>
    </div>
    <? require_once APPPATH . '/views/includes/inc_footer.php'; ?>
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/slick.min.js"></script>
    <script src="<?= base_url() ?>assets/js/validate_nv/validate_nv.js"></script>
    <script src="<?= base_url() ?>assets/js/dang_nhap.js"></script>
    <?
    if (isset($js)) {
    ?>
        <script src="<?= base_url() ?>assets/js/validate_nv/<?= (isset($js) ? $js : '') ?>.js"></script>
    <?
    }
    ?>
    <script>
        // $(".q-content-row1-flex").slick({
        //     slidesToShow: 3,
        //     slidesToScroll: 1,
        //     autoplay: true,
        //     autoplaySpeed: 3000,
        //     dots: true,
        //     focusOnSelect: true,

        //     pauseOnHover: true,

        //     responsive: [{
        //             breakpoint: 850,
        //             settings: {
        //                 slidesToShow: 2,
        //                 slidesToScroll: 1,
        //             }
        //         },
        //         {
        //             breakpoint: 768,
        //             settings: {
        //                 slidesToShow: 1,
        //                 slidesToScroll: 1
        //             }
        //         },
        //     ]
        // });
        // $('.q-content-row1-flex').slick({
        //     slidesToShow: 3,
        //     slidesToScroll: 1,
        //     autoplay: true,
        //     autoplaySpeed: 3000,
        //     dots: true,
        //     focusOnSelect: true,

        //     pauseOnHover: true,

        //     responsive: [{
        //             breakpoint: 850,
        //             settings: {
        //                 slidesToShow: 2,
        //                 slidesToScroll: 1,
        //             }
        //         },
        //         {
        //             breakpoint: 600,
        //             settings: {
        //                 slidesToShow: 1,
        //                 slidesToScroll: 1
        //             }
        //         },
        //     ]
        // });
    </script>
</body>

</html>