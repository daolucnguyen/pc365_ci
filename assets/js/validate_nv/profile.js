function changeImg(input) {
    var imgPath = $('#input_avatar').val();
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
    if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
        if (typeof(FileReader) != "undefined") {
            // var file_name = imgPath.substring(imgPath.lastIndexOf('\\') + 1).toLowerCase();
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#staff_avatar').attr('src', e.target.result);
                    $('#staff_update_avatar').html('');
                }
                reader.readAsDataURL(input.files[0]);
            }
        } else {
            $('#staff_update_avatar').html('Trình duyệt không hỗ trợ');
            return false;
        }
    } else {
        $('#staff_update_avatar').html('Vui lòng chọn ảnh');
        return false;
    }

}
$(document).ready(function() {
    $('#update_chucvu').select2({
        width: '100%',
        ajax: {
            url: '/staff/StaffController/show_position',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    searchTerm: params.term // search term
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });
    $('#update_phongban').select2({
        width: '100%',
        ajax: {
            url: '/staff/StaffController/show_department',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    searchTerm: params.term // search term
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });
    // $('.item-drop').click(function() {
    //     $('.menu-drop1').toggleClass('hide');
    // });
    $('#link-5').addClass('link-active');
    $('#link-5').removeClass('menu-link');
    $('#link-6').addClass('link-active');
    $('#link-6').removeClass('menu-link');
    $('#link-5-drop').addClass('link-active');
    $('#link-5-drop').removeClass('menu-link');
    $('#link-6-drop').addClass('link-active');
    $('#link-6-drop').removeClass('menu-link');

    // $('#menu_pro').css('background-image', 'url(/assets/images/Profile-active.png)');
    $('#menu_cat_drop').attr('src', '/assets/images/Category.png');
    $('#menu_pro_drop').attr('src', '/assets/images/Profile-active.png');

    // show
    $(".q-right-work").click(function() {
        $("#q-right-details-work").click();
    });
    $(".q-nv-modify").click(function(e) {
        $(".q-nv-choice").toggleClass("hide");
        e.stopPropagation();
    });
    $(document, ).click(function() {
        $(".q-nv-choice").addClass("hide");
    });

    // update
    $('.q-nv-avatar-update').click(function() {
        $("#input_avatar").click();
    });
    $('#show_pass1').click(function() {
        if ($('#cty_old_pass').attr('type') == 'password') {
            $('#cty_old_pass').attr('type', 'text');
            $(this).val('Hide');
            $('#show_pass1').attr("src", '/assets/images/Show.png');
        } else {
            $('#cty_old_pass').attr('type', 'password');
            $(this).val('Show');
            $('#show_pass1').attr("src", '/assets/images/Hide.png');
        }
    });

    $('#show_pass2').click(function() {
        if ($('#cty_new_pass').attr('type') == 'password') {
            $('#cty_new_pass').attr('type', 'text');
            $(this).val('Hide');
            $('#show_pass2').attr("src", "/assets/images/Show.png");
        } else {
            $('#cty_new_pass').attr('type', 'password');
            $(this).val('Show');
            $('#show_pass2').attr("src", "/assets/images/Hide.png");
        }
    });

    $('#show_pass3').click(function() {
        if ($('#cty_re_new_pass').attr('type') == 'password') {
            $('#cty_re_new_pass').attr('type', 'text');
            $(this).val('Hide');
            $('#show_pass3').attr("src", "/assets/images/Show.png");
        } else {
            $('#cty_re_new_pass').attr('type', 'password');
            $(this).val('Show');
            $('#show_pass3').attr("src", "/assets/images/Hide.png");
        }
    });


});