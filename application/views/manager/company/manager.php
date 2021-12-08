
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>

    <link rel="stylesheet" href="<?= base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/css/header.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/css/quan_ly_cty.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/css/style.css">
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
    <div class="d-quan-ly-cty">
        <div class="l_block_sidebar">
        <?php require_once APPPATH.'/views/includes/sidebar_left_cty.php'; ?>
        </div>
        <div id="alert"></div>
        <div class="d-quan-ly-cty1">
            <?php require_once APPPATH.'/views/includes/header_manager.php';?>
            <?php
                if (isset($content)) {
                    $this->load->view($content);
                }
            ?>
        </div>

    </div>
    <? require_once APPPATH.'/views/includes/inc_footer.php' ?>
<script src="<?= base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url();?>assets/js/select2.min.js"></script>
<script src="<?= base_url();?>assets/js/jquery.validate.min.js"></script>
<?php
    if(isset($chart_js)){
?>
    <script src="<?= base_url();?>assets/js/<?=$chart_js?>"></script>
<?php
    }
?>

<?php
    if(isset($js)){
?>
    <script src="<?= base_url();?>assets/js/cty/<?=$js?>"></script>
<?php
    }
?>

</body>
</html>
