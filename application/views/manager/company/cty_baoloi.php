<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo Lỗi</title>

    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/quan_ly_cty.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/nv_qly.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/cty_qly.css">
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
        .l_hinhanh_item1 {
            position: relative;
            margin: 0 20px 20px 0;
        }

        .l_img_delete_TT {
            padding: 8.5px;
        }

        .image-cancel {
            background: #0D71BA;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            position: absolute;
            top: -10px;
            left: 125px;
        }

        .l_hinhanh_2 {
            width: 139px;
            height: 107px;
        }

        .baoloi {
            color: #206AA9;
        }
    </style>
</head>

<body>
    <div class="d-quan-ly-cty">
        <div class="l_block_sidebar">
            <?php require_once APPPATH . '/views/includes/sidebar_left_cty.php'; ?>
        </div>
        <div class="d-quan-ly-cty1">
            <?php require_once APPPATH . '/views/includes/header_manager.php'; ?>
            <div class="d-qly-cty1-v1">
                <h3 class="q-qly-thongtin-title">Báo lỗi</h3>
                <div id="alert"></div>
                <form class="q-cty-baoloi">
                    <p class="q-cty-baoloi-title">Tải hình ảnh: </p>
                    <input type="file" name="" class="q-cty-upload-input" id="cty_baoloi_input_img" accept="image/*" multiple>
                    <div class="q-cty-baoloi-upload" id="l_index_image">
                    </div>
                    <label for="cty_baoloi_input_img" class="q-cty-baoloi-upload-img">
                        <img src="<?= base_url(); ?>assets/images/plus.png" alt="plus">
                    </label>
                    <p class="val_error" id="val_baoloi_img"></p>
                    <p class="q-cty-baoloi-title">Nội dung chi tiết: </p>
                    <textarea style="resize: none;" name="" id="cty_baoloi_text" cols="30" rows="10" class="q-cty-baoloi-content" placeholder="Hãy cho chúng tôi biết rõ tình trạng lỗi bạn đã gặp."></textarea>
                    <p class="val_error" id="val_baoloi_text"></p>
                    <div class="q-cty-baoloi-button">
                        <input type="reset" name="" class="reform-nv-update reform-cty-update reform-baoloi" id="reform_baoloi" value="Nhập Lại"></input>
                        <button type="button" name="" onclick="error(); return false;" class="submit-cty-baoloi" id="submit_baoloi">Báo Lỗi</button>
                        <!-- <button type="button" name="" class="submit-cty-baoloi" id="submit_baoloi_modal" data-toggle="modal" data-target="#modal_baoloi">Báo Lỗi</button> -->
                    </div>

                    <div id="modal_baoloi" class="modal fade q-modal-baoloi" role="dialog">
                        <div class="modal-dialog q-modal-baoloi-dialog">
                            <div class="modal-content q-modal-baoloi-content">
                                <div class="modal-header q-modal-header">
                                    <button type="button" class="q-modal-header-button" data-dismiss="modal"><img src="<?= base_url(); ?>assets/images/x.png" alt="x"></button>
                                    <p class="modal-title q-modal-title">Báo Lỗi Thành Công</p>
                                </div>
                                <div class="modal-body q-modal-body">
                                    <div class="q-modal-body-img">
                                        <img src="<?= base_url(); ?>assets/images/modal-baoloi-frame.png" alt="frame">
                                    </div>
                                    <p class="q-modal-body-title">PunchClock<span>365</span> rất tiếc khi bạn gặp phải trường hợp này</p>
                                    <p class="q-modal-body-title-2">Chúng tôi sẽ nhanh chóng sửa lỗi để không làm gián đoán trải nghiệm của bạn</p>
                                    <div class="q-modal-body-button-div">
                                        <button type="button" class="q-modal-body-button" data-dismiss="modal">Xác Nhận</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>



    <? require_once APPPATH . '/views/includes/inc_footer.php' ?>
    <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/Chart.min.js"></script>
    <!-- <script src="<?= base_url(); ?>assets/js/validate_nv/validate_nv.js"></script> -->
    <script>
        var base_url = '/';
        var flag = false;
        var arr = [];
        var numArr = [];
        var files = 0;
        var list_img = 0;
        var num = 0;
        var i = 0;
        var n = 0;
        var bien = 0;

        n = arr.length;
        if (window.File && window.FileList && window.FileReader) {
            $('#cty_baoloi_input_img').on('change', function(event) {
                var files = event.target.files;
                var output = $("#l_index_image");
                if (files.length == 0) {
                    return false;
                }
                if (files.length <= 6) {
                    if (arr.length <= 5) {
                        for (var i = 0; i < files.length; i++) {
                            var file = files[i];
                            if (!file.type.match('image')) continue;
                            var x = arr.length;
                            if (x < 6) {
                                arr.push(files[i]);
                            }
                        }
                    } else {
                        if (x <= n) {
                            n = n - x;
                        } else {
                            n = 0;
                        }
                        for (var i = 0; i < x; i++) {
                            var file = files[i];
                            if (!file.type.match('image')) continue;
                            $('#l_delete_img' + bien).remove();
                            arr.shift();
                            arr.push(files[i]);
                            bien++;
                        }
                    }
                    for (var i = 0; i < arr.length; i++) {
                        var file = arr[i];
                        var size = arr[i].size;
                        j = n;
                        if (size < 2097152) {
                            if (!file.type.match('image')) continue;
                            var picReader = new FileReader();
                            picReader.addEventListener('load', function(event) {
                                var picFile = event.target;
                                var html = '<div class="l_hinhanh_item1" id = "idappend-' + num + '">' +
                                    '<div title="Xóa hình ảnh" onclick = "l_closeimg(' + num + ',' + j + ')" class="image-cancel" data-no="' + num + '"><img class="lazyload l_img_delete_TT l_curson" src="' + base_url + 'images_staff/Vector.svg" data-src="" alt=""></div>' +
                                    '<img id="pro-img-' + num + '" src="' + picFile.result + '"  data-src="' + picFile.result + '" alt="loading..." class="lazyload l_hinhanh_2" id="l_img_2">' +
                                    '</div>';
                                j++;
                                output.append(html);
                                num++;
                                numArr.push(num);
                            });
                            picReader.readAsDataURL(file);
                        }
                    }
                    var maxnum = Math.max.apply(Math, numArr);
                    for (i = 0; i < maxnum; i++) {
                        $('#idappend-' + i).remove();
                    }

                } else {
                    $("#alert").append('<div class="alert-success_img">Chỉ tải tối đa 6 ảnh</div>');
                    setTimeout(function() {
                        $(".alert-success_img").fadeOut(1000, function() {
                            $(".alert-success_img").remove();
                        });
                    }, 3000);
                    return false;
                }
            });
        } else {
            $("#alert").append('<div class="alert-success_img">Lỗi</div>');
            setTimeout(function() {
                $(".alert-success_img").fadeOut(1000, function() {
                    $(".alert-success_img").remove();
                });
            }, 3000);
        }

        function l_closeimg(x, y) {
            if (window.File && window.FileList && window.FileReader) {
                var files = event.target.files;
                var output = $("#l_index_image");
                $('#idappend-' + x).remove();
                arr.splice(y, 1);
                for (var i = 0; i < arr.length; i++) {
                    var file = arr[i];
                    var size = arr[i].size;
                    j = n;
                    if (size < 2097152) {
                        if (!file.type.match('image')) continue;
                        var picReader = new FileReader();
                        picReader.addEventListener('load', function(event) {
                            var picFile = event.target;
                            var html = '<div class="l_hinhanh_item1" id = "idappend-' + num + '">' +
                                '<a onclick = "l_closeimg(' + num + ',' + j + ')" class="image-cancel" data-no="' + num + '"><img class="lazyload l_img_delete_TT" src="' + base_url + 'images_staff/Vector.svg" data-src="' + base_url + '/images_staff/Vector.svg" alt=""></a>' +
                                '<img id="pro-img-' + num + '" src="' + picFile.result + '" data-src="' + picFile.result + '" alt="loading..." class="lazyload l_hinhanh_2" id="l_img_2">' +
                                '</div>';
                            j++;
                            output.append(html);
                            num++;
                            numArr.push(num);
                        });
                        picReader.readAsDataURL(file);
                    }
                }
                var maxnum = Math.max.apply(Math, numArr);
                for (i = 0; i < maxnum; i++) {
                    $('#idappend-' + i).remove();
                }
            }
        }

        function error() {
            var data = new FormData();
            var focusArr = [];
            var note = $('#cty_baoloi_text').val();
            var flag = false;
            if (arr.length == 0) {
                $('#val_baoloi_img').html('Vui lòng chọn ảnh!');
                // $('#cty_baoloi_input_img').focus();
                focusArr.push('#cty_baoloi_input_img');
            } else {
                $('#val_baoloi_img').html('');
                flag = true;
            }
            if (note == '') {
                $('#val_baoloi_text').html('Vui lòng điền nội dung chi tiết');
                // $('#cty_baoloi_text').focus();
                focusArr.push('#cty_baoloi_text');
            } else {
                $('#val_baoloi_text').html('');
                flag = true;
            }
            data.append('note', note);
            for (var index = 0; index < arr.length; index++) {
                data.append("images[]", arr[index]);
            }
            if (flag == true) {
                $.ajax({
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    enctype: 'multipart/form-data',
                    url: base_url + 'company/Company_controller/error',
                    data: data,
                    dataType: "JSON",
                    async: false,
                    success: function(data) {
                        if (data.result == true) {
                            for (let i = 0; i < arr.length; i++) {
                                arr.splice(i, arr.length);
                            }
                            $('#l_index_image').html('');
                            $('#cty_baoloi_text').val('');
                            $('#modal_baoloi').modal('show');
                        } else {
                            return false;
                        }
                    }
                });
            }
            $(focusArr[0]).focus();
            return false;
        }
    </script>
</body>

</html>