<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo Lỗi</title>

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
        #link-8{
            color: #206AA9;
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
                <div class="q-right-update" id="right_update">
                    <div class="q-right-title-update" id="right_title">
                        <div class="q-right-title">
                            <span>Báo Lỗi</span>
                        </div>
                        <div id="alert"></div>
                        <form class="q-cty-baoloi" onsubmit="error(); return false;">
                            <p class="q-cty-baoloi-title">Tải hình ảnh: </p>
                            <input type="file" name="" class="q-cty-upload-input" accept="image/*" id="cty_baoloi_input_img" multiple>
                            <div class="q-cty-baoloi-upload" id="l_index_image">

                            </div>
                            <label for="cty_baoloi_input_img" class="q-cty-baoloi-upload-img">
                                <img src="<?= base_url() ?>assets/images/plus.png" alt="plus">
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
                                            <button type="button" class="q-modal-header-button" data-dismiss="modal"><img src="<?= base_url() ?>assets/images/x.png" alt="x"></button>
                                            <p class="modal-title q-modal-title">Báo Lỗi Thành Công</p>
                                        </div>
                                        <div class="modal-body q-modal-body">
                                            <div class="q-modal-body-img">
                                                <img src="<?= base_url() ?>assets/images/modal-baoloi-frame.png" alt="frame">
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
        </div>
    </div>
    <? include(APPPATH . '/views/includes/inc_footer.php') ?>
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <!-- <script src="<?= base_url() ?>assets/js/validate_nv/validate_nv.js"></script> -->


    <script>
        var base_url = 'http://localhost:8894/';
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
                                    '<div title="Xóa hình ảnh" onclick = "l_closeimg(' + num + ',' + j + ')" class="image-cancel" data-no="' + num + '"><img class="lazyload l_img_delete_TT" src="' + base_url + '/images_staff/Vector.svg" data-src="" alt=""></div>' +
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
                                '<a onclick = "l_closeimg(' + num + ',' + j + ')" class="image-cancel" data-no="' + num + '"><img class="lazyload l_img_delete_TT" src="' + base_url + '/images_staff/Vector.svg" data-src="' + base_url + '/images_staff/Vector.svg" alt=""></a>' +
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
            var note = $('#cty_baoloi_text').val();
            if (arr.length == 0) {
                $('#val_baoloi_img').html('Vui lòng chọn ảnh!');
                $('#cty_baoloi_input_img').focus();
                return false;
            } else {
                $('#val_baoloi_img').html('');
                flag = true;
            }
            if (note == '') {
                $('#val_baoloi_text').html('Vui lòng điền nội dung chi tiết');
                $('#cty_baoloi_text').focus();
                return false;
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
                    url: base_url + 'staff/StaffController/error',
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

        }



        //     $(document).ready(function () {
        //         $('.item-drop').click(function () {
        //             $('.menu-drop').toggleClass('hide');
        //         });

        //         $('#link-8').addClass('link-active');
        //         $('#link-8').removeClass('menu-link');
        //         $('#link-8-drop').addClass('link-active');
        //         $('#link-8-drop').removeClass('menu-link');

        //         $('#menu_error').css('background-image','url(<?= base_url() ?>assets/images/menu-error-active.png');
        //         $('#menu_error_drop').attr('src','<?= base_url() ?>assets/images/menu-error-active.png');
        //         $('#menu_cat_drop').attr('src','<?= base_url() ?>assets/images/Category.png');

        //         $('.q-cty-baoloi-upload-img').click(function(){
        //             $('#cty_baoloi_input_img').click();
        //         });


        //         $("#cty_baoloi_input_img").on('change', function () {
        //         var countFiles = $(this)[0].files.length;
        //         if(countFiles < 7) {
        //             var imgPath = $(this)[0].value;
        //             var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        //             var image_holder = $(".q-cty-baoloi-upload");
        //             image_holder.empty();

        //             if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
        //                 if (typeof (FileReader) != "undefined") {
        //                     for (var i = 0; i < countFiles; i++) {
        //                         var reader = new FileReader();
        //                         reader.onload = function (e) {
        //                             $("<img />", {
        //                                 "src": e.target.result,
        //                                     "class": "q-cty-baoloi-img"
        //                             }).appendTo(image_holder);
        //                         }
        //                         image_holder.show();
        //                         reader.readAsDataURL($(this)[0].files[i]);
        //                     }

        //                 } else {
        //                     alert("Trình duyệt không hỗ trợ");
        //                 }
        //             } else {
        //                 alert("Vui lòng chọn ảnh");
        //             }
        //         }else{
        //             alert("Giới hạn ảnh là 6");
        //         }
        //         $('.reform-nv-update').click(function () {
        //             $('.q-cty-baoloi-img').remove();
        //         });

        //     });
        // });
    </script>
</body>

</html>