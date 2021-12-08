$(document).ready(function() {
    $(window).resize(function() {
        var width = $(window).width();
        if (width <= 541) {
            $('.q-content-row1-flex').addClass('q-content-slick');
            // $('.q-content-slick').slick({
            //     autoplay: true,
            //     autoplaySpeed: 2000,
            //     slidesToShow: 1,
            //     slidesToScroll: 1,
            // });
        }
    });
    // $('.q-form-regis-2').hide();
    // $('.q-form-regis-3').hide();
    // $('.q-form-regis-4').hide();
    // $('#xacthuc_nv_1').show();

    $('.select2').select2({
        width: "100%"
    });
    // $('#input_chucvu_2').select2({
    //     width: "100%"
    // });
    $('.q-form-3-v2').find('input').each(function() {
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
    $(".input-submit-4").click(function() {
        $("#file-input").click();
    });

    $('#file-input').change(function() {
        if ($(this).val().length >= 3) {
            $('.input-submit-4').hide();
            $('.input-confirm-4').removeClass('hide');
        }
    });
    // upload ảnh
    $("#file-input").on('change', function() {
        var countFiles = $(this)[0].files.length;
        var fileSize = $(this)[0].files.size;
        var html = "";
        if (countFiles < 7) {
            var imgPath = $(this)[0].value;
            var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            var file_name = imgPath.substring(imgPath.lastIndexOf('\\') + 1).toLowerCase();
            if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                if (typeof(FileReader) != "undefined") {
                    for (var i = 0; i < countFiles; i++) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            html = `
                            <div class=''q-regis-show-item>
                                <div class='q-show-image'>
                                    <img src='` + e.target.value + `' class='q-show-image'>
                                </div>
                                <div class='q-show-info'>
                                    <div class='q-show-name'>` + fileName + `</div>
                                    <div class='q-show-size'>` + fileSize + `</div>
                                </div>
                                <img src='/assets/images/Delete.png' alt='delete' class='q-show-delete'>
                            </div>
                            `;
                        }
                        $(".q-regis-show-upload").before(html);
                        $(".q-regis-show-upload").show();
                        reader.readAsDataURL($(this)[0].files[i]);
                    }

                } else {
                    $('#val_dk4').html('Trình duyệt không hỗ trợ');
                    return false;
                }
            } else {
                $('#val_dk4').html('Vui lòng chọn ảnh');
                return false;
            }
        } else {
            $('#val_dk4').html('Giới hạn ảnh là 6');
            return false;
        }
        $('.input-reform-4').click(function() {
            $('.q-show-image').remove();
        });

    });
    var flag = 0;
    $('#hide_eyes').click(function() {
        if (flag == 0) {
            $('#pwd').attr('type', 'text');
            $('#hide_eyes').attr('src', '/assets/images/Show.svg');
            flag = 1;
        } else if (flag == 1) {
            $('#pwd').attr('type', 'password');
            $('#hide_eyes').attr('src', '/assets/images/Hide.svg');
            flag = 0;
        }
    });
    $('#hide_eyes2').click(function() {
        if (flag == 0) {
            $('#pwd2').attr('type', 'text');
            $('#hide_eyes2').attr('src', '/assets/images/Show.svg');
            flag = 1;
        } else if (flag == 1) {
            $('#pwd2').attr('type', 'password');
            $('#hide_eyes2').attr('src', '/assets/images/Hide.svg');
            flag = 0;
        }
    });
    $("#getpass_step2").hide();
    $("#getpass_step3").hide();
    $('.q-form-3-v2').find('input').each(function() {
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
    $('#show_pass1').click(function() {
        if ($('#qmk_pass1').attr('type') == 'password') {
            $('#qmk_pass1').attr('type', 'text');
            $(this).val('Hide');
            $('#show_pass1').attr("src", "/assets/images/Show.png");
        } else {
            $('#qmk_pass1').attr('type', 'password');
            $(this).val('Show');
            $('#show_pass1').attr("src", "/assets/images/Hide.png");
        }
    });

    $('#show_pass2').click(function() {
        if ($('#qmk_pass2').attr('type') == 'password') {
            $('#qmk_pass2').attr('type', 'text');
            $(this).val('Hide');
            $('#show_pass2').attr("src", "/assets/images/Show.png");
        } else {
            $('#qmk_pass2').attr('type', 'password');
            $(this).val('Show');
            $('#show_pass1').attr("src", "/assets/images/Hide.png");
        }
    });

});