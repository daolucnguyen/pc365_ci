<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XÁC THỰC TÀI KHOẢN</title>

    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style_re.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-125014721-1');
    </script>
    <style>
        .error {
            margin-top: 12px;
        }

        body {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <?php require_once APPPATH . "/views//includes/inc_header_nv.php"; ?>
    <div class="form-dky-cty">
        <h1 class="chooses">đăng kí công ty</h1>
        <div id="alert"></div>

        <form method="post" class="d-dang-ky-cty" id="otp" data-group-name="digits">
            <div class="d-dang-ky-cty1">
                <img src="<?= base_url(); ?>assets/images/dky_cty2.svg" alt="bước 2" class="dky-cty">
            </div>
            <div class="otp-cty">
                <p class="otp-p">Nhập mã OTP gồm 6 chữ số đã được gửi thông qua email.</p>
                <div class="otp-cty2">
                    <input type="text" autocomplete="off" class="otp-input" id="digit-1" name="digit_1" data-next="digit-2" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                    <input type="text" autocomplete="off" class="otp-input" id="digit-2" name="digit_2" data-next="digit-3" data-previous="digit-1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                    <input type="text" autocomplete="off" class="otp-input" id="digit-3" name="digit_3" data-next="digit-4" data-previous="digit-2" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                    <input type="text" autocomplete="off" class="otp-input" id="digit-4" name="digit_4" data-next="digit-5" data-previous="digit-3" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                    <input type="text" autocomplete="off" class="otp-input" id="digit-5" name="digit_5" data-next="digit-6" data-previous="digit-4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                    <input type="text" autocomplete="off" class="otp-input" id="digit-6" name="digit_6" data-previous="digit-5" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                </div>
            </div>
            <div class="otp-cty3">
                <p class="otp-cty3-p">
                    Không nhận được mã ? <span class="d-gui-lai-ma l_curson" onclick="re_otp(<?= $com_id ?>)">Gửi lại</span>
                </p>
            </div>
            <div class="d-dky-cty4">
                <a href="<? base_url(); ?>dang-ky-cong-ty.html" class="button-reset">
                    <p class="reset-p">Quay lại</p>
                </a>
                <button type="submit" name="submit" class="button-submit">
                    <p class="submit-p">Tiếp theo</p>
                </button>
            </div>
        </form>
    </div>
    <? require_once APPPATH . '/views/includes/inc_footer.php' ?>
    <script src="<?= base_url(); ?>assets/js/jquery.validate.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script>
        function re_otp(com_id) {
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>company/Company_controller/re_otp",
                data: {
                    // email:email,
                    // otp:otp,
                },
                dataType: "json",
                success: function(response) {
                    if (response.result == true) {
                        $("#alert").append('<div class="alert-success">Email đã được gửi lại. Vui lòng kiểm tra lại email.</div>');
                        setTimeout(function() {
                            $(".alert-success").fadeOut(1000, function() {});
                        }, 2000);
                    }
                }
            });
        }
        $(document).ready(function() {
            $('.otp-cty2').find('input').each(function() {
                $(this).attr('maxlength', 1);
                $(this).on('keyup', function(e) {
                    var parent = $($(this).parent());

                    if (e.keyCode === 8 || e.keyCode === 37) {
                        var prev = parent.find('input#' + $(this).data('previous'));

                        if (prev.length) {
                            $(prev).select();
                        }
                    } else if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
                        var next = parent.find('input#' + $(this).data('next'));

                        if (next.length) {
                            $(next).select();
                        }
                    }
                });
            });

            $("#otp").submit(function() {
                var ca = document.cookie.split('=');
                var mail = ca[1];
                var form_oke = true;
                var otp1 = $('#digit-1').val();
                var otp2 = $('#digit-2').val();
                var otp3 = $('#digit-3').val();
                var otp4 = $('#digit-4').val();
                var otp5 = $('#digit-5').val();
                var otp6 = $('#digit-6').val();
                var otp = otp1 + otp2 + otp3 + otp4 + otp5 + otp6;
                var html = "";

                dom = $('.error').remove();
                if (otp1 == "" || otp2 == "" || otp3 == "" || otp4 == "" || otp5 == "" || otp6 == "") {
                    html += `<div class='error'>Mã OTP không được để trống</div>`;
                    $(".otp-cty2").after(html);
                    form_oke = false;
                } else {
                    html += `<div class="error"></div>`;
                    $(".otp-cty2").after(html);
                }
                body = `<div class='error'>Mã otp không trùng khớp</div>`;
                if (form_oke == true) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url() ?>company/Company_controller/verification_signup",
                        data: {
                            otp: otp,
                            mail: mail,
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.result == true) {
                                window.location.href = "/hoan-tat-dang-ky.html";
                            } else {
                                $(".otp-cty2").after(body);
                            }
                        }
                    });
                }
                return false;
            });
        });
    </script>
</body>

</html>