<?php
    include "../config/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/style_re.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/trangchu.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400&display=swap" rel="stylesheet">
</head>
<body>
    <div class="q-trangchu">
        <div class="header">
            <?php include "../includes/inc_header_nv.php";?>
        </div>
        <div class="q-trangchu-banner">
            <div class="q-trangchu-banner-radius">
                <div class="q-banner-title">
                    <p>Punclock<span id="span_365">365</span></p>
                    <p>App chấm công bằng công nghệ mới nhất hiện nay</p>
                    <p>Chúng tôi mang đến dịch vụ tuyệt vời nhất cho các công ty quản lí và người lao động</p>
                    <a href="" class="" id="google_play">
                        <div class="q-banner-button">
                            <img src="../images/gplay.png" alt="google_play">
                            <div class="q-banner-button-span">
                                <span id="text_down1">TẢI MIỄN PHÍ</span>
                                <span>Google Play</span>
                            </div>
                        </div>
                    </a>
                    <a href="" class="" id="app_store">
                        <div class="q-banner-button">
                            <img src="../images/app-store.png" alt="app_store">
                            <div class="q-banner-button-span">
                                <span id="text_down2">TẢI MIỄN PHÍ</span>
                                <span>App Store</span>
                            </div>
                        </div>
                    </a>
                </div>
                </div>
                    <div class="q-banner-phone-img">
                        
                    </div>
                    <div class="q-banner-work">
                        <img src="../images/trangchu-banner-work.png" alt="work">
                    </div>
                    <div class="q-trangchu-banner-info">
                        <div class="q-banner-img " id="q-banner-img-sm1">
                            <img src="../images/trangchu-img1.png" alt="img">
                        </div>
                        <div class="q-banner-img" id="q-banner-img-sm2">
                            <img src="../images/trangchu-img2.png" alt="img">
                        </div>
                        <div class="q-banner-img hide-on-mobile" id="q-banner-img-sm3">
                            <img src="../images/trangchu-img3.png" alt="img">
                        </div>
                        <div class="q-banner-img" id="q-banner-img-sm4">
                            <img src="../images/trangchu-img4.png" alt="img">
                        </div>
                        <div class="q-banner-profile">
                            <img src="../images/trangchu-banner-profile.png" alt="profile">
                        </div>
            </div>

        </div>
        <div class="q-trangchu-content">
            <div class="q-content-row q-content-row1">
                <p class="q-content-row1-title">Thiết Kế Thân Thiện </p>
                <p class="q-content-row1-desc"><span>PunClock</span>365 có các tính năng phù hợp sử 
                        dụng trên thiết bị di động và máy tính</p>
                <div class="q-content-row1-flex">
                    <div class="q-content-col1" id="row1_1">
                        <div class="q-content-col1-img">
                            <img src="../images/trangchu-row-1-1.png" alt="img">
                        </div>
                        <div class="q-content-col1-title">
                            <p>Giao Diện Thân Thiện</p>
                        </div>
                        <div class="q-content-col1-info">
                            <p>Các tính năng của App chấm công 365 được sắp xếp một cách hệ thống, rõ ràng, 
                                đính kèm thêm những hướng dẫn trực quan giúp nhân viên và doanh nghiệp dễ thao tác và sử dụng.</p>
                        </div>
                    </div>
                    <div class="q-content-col1 hide-on-mobile" id="row1_2">
                        <div class="q-content-col1-img">
                            <img src="../images/trangchu-row-1-2.png" alt="img">
                        </div>
                        <div class="q-content-col1-title">
                            <p>Dễ Dàng Tùy Chỉnh</p>
                        </div>
                        <div class="q-content-col1-info">
                            <p>Doanh nghiệp và nhân viên công ty dễ dàng cập nhật số lượng nhân viên, 
                                phòng ban, mật khẩu, ảnh đại diện, vị trí doanh nghiệp một cách nhanh 
                                chóng...</p>
                        </div>
                    </div>
                    <div class="q-content-col1 hide-on-mobile" id="row1_3">
                        <div class="q-content-col1-img">
                            <img src="../images/trangchu-row-1-3.png" alt="img">
                        </div>
                        <div class="q-content-col1-title">
                            <p>Tính Năng Mạnh Mẽ</p>
                        </div>
                        <div class="q-content-col1-info">
                            <p>Tốc độ nhận diện khuôn mặt chỉ trong 2s. Chủ động chấm và xuất 
                                công ngay trên ứng dụng. Cập nhật nhanh những thông tin chấm 
                                công đúng giờ, số phút muộn theo ngày.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="q-row1-mobile hide-on-pc">
                <div class="q-row1-mobile-circle q-circle-focus" id="circle_1"></div>
                <div class="q-row1-mobile-circle" id="circle_2"></div>
                <div class="q-row1-mobile-circle" id="circle_3"></div>
            </div>
            <div class="q-content-row q-content-row2">
                <div class="q-content-row2-left">
                    <img src="../images/trangchu-content-frame.png" alt="" class="content-row2-img-frame">
                    <img src="../images/trangchu-content-phone.png" alt="" class="content-row2-img-phone">
                    <img src="../images/trangchu-content-profile.png" alt="" class="content-row2-img-proflie">
                </div>
                <div class="q-content-row2-right">
                    <div class="q-content-row2-title">
                        <p>Các Tính Năng Nổi Bật</p>
                    </div>
                    <div class="q-content-row2-desc">
                        <p>App chấm công giúp tăng hiệu quả quản lý và tiết kiệm chi phí đầu tư</p>
                    </div>
                    <div class="q-content-row2-details">
                        <div class="q-content-row2-div">
                            <div class="q-content-row2-div-img">
                                <img src="../images/content-row2-div1.png" alt="img">
                            </div>
                            <div class="q-content-row2-div-text">
                                <p>Đồng Bộ Hệ Thống</p>
                                <p>Đồng nhất giữa nhân viên chấm công bằng máy chấm công và chấm công bằng app.</p>
                            </div>
                        </div>
                        <div class="q-content-row2-div">
                            <div class="q-content-row2-div-img">
                                <img src="../images/content-row2-div2.png" alt="img">
                            </div>
                            <div class="q-content-row2-div-text">
                                <p>Theo Dõi Vị Trí</p>
                                <p>Vị trí cùng lịch trình nhân viên cập nhật từng giây.</p>
                            </div>
                        </div>
                        <div class="q-content-row2-div">
                            <div class="q-content-row2-div-img">
                                <img src="../images/content-row2-div3.png" alt="img">
                            </div>
                            <div class="q-content-row2-div-text">
                                <p>Chấm Công Đúng Vị Trí Và Thời Gian</p>
                                <p>Chấm công theo vị trí GPS. Địa điểm xác định theo vị trí 
                                    của Google Map (đúng vị trí mới cho điểm danh), thời gian lấy theo giờ server.</p>
                            </div>
                        </div>
                        <div class="q-content-row2-div">
                            <div class="q-content-row2-div-img">
                                <img src="../images/content-row2-div4.png" alt="img">
                            </div>
                            <div class="q-content-row2-div-text">
                                <p>Theo Dõi Và Giao Việc Mỗi Ngày</p>
                                <p>Công việc được sắp xếp, bàn giao và kiểm tra từ xa. 
                                    Trao đổi thông tin thường xuyên qua mục tin nhắn và gọi điện.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="q-content-row q-content-row3">
                <div class="q-content-row3-left">
                <div class="q-content-row3-title">
                    <p>Hỗ Trợ Xuất Bản Chấm Công</p>
                </div>
                <div class="q-content-row3-desc">
                    <p>Ứng dụng app chấm công này rất dễ sử dụng cho các nhân viên, 
                        giao diện rất thân thiện và dễ dàng thao tác, mang lại sự 
                        tiện lợi cho các nhân viên và cho sự quản lý chấm công của 
                        các nhân sự cũng trở nên dễ dàng hơn.</p>
                </div>
                </div>
                <div class="q-content-row3-right">
                    <img class="q-content-row3-right-img" src="../images/trangchu-content-row3.png" alt="img">
                </div>
            </div>
            <div class="q-content-row q-content-row4">
                <div class="q-content-row4-left">
                    <img src="../images/trangchu_row4_left.png" alt="img" class="q-content-row4-left-img">
                </div>

                <div class="q-content-row4-right">
                    <div class="q-content-row4-title">
                        <p>Quản Lý Công Ty Cùng Nhân Viên Một Cách Hiệu Quả</p>
                    </div>
                    <div class="q-content-row4-desc">
                        <p><span>PunchClock</span>365 là giải pháp cho các tập đoàn lớn cập nhật 
                            nhanh chóng và quản lý dễ dàng các công ty con qua tính 
                            năng cập cập, thêm mới các địa chỉ chi nhánh, phòng ban, 
                            tạo ca làm việc, theo dõi lịch trình nhân, giao việc... 
                            theo dõi được thời gian cụ thể được thời điểm chấm công 
                            của từng nhân viên theo danh sách ID.</p>
                    </div>
                </div>
            </div>
            <div class="q-content-row q-content-row5">
                <div class="q-content-row5-left">
                    <div class="q-content-row5-title">
                        <p>Giao Diện Thân Thiện</p>
                    </div>
                    <div class="q-content-row5-desc">
                        <p>Ứng dụng app chấm công này rất dễ sử dụng cho các nhân viên, giao diện rất 
                            thân thiện và dễ dàng thao tác, mang lại sự tiện lợi cho các nhân viên 
                            và cho sự quản lý chấm công của các nhân sự cũng trở nên dễ dàng hơn.
                        </p>
                        <br>
                        <p>
                            Ngoài ra, các nhân viên sau khi chấm công, có thể thấy ngay được kết 
                            quả chấm công của mình, không còn sợ đến cuối kỳ công mới bị phát 
                            hiện sót công hay sai công mà không biết phải kiểm tra ở đâu và kiểm 
                            tra như thế nào. Tất cả dữ liệu chấm công từ điện thoại hay từ máy 
                            chấm công cùng chuyển về cùng 1 hệ thống tính công và kết quả trên 
                            cùng 1 bảng công.</p>
                    </div>
                </div>
                <div class="q-content-row5-right">
                    <div class="q-content-row5-img">
                        <img src="../images/trangchu-row5.png" alt="img">
                    </div>
                </div>
            </div>
            <div class="q-content-row q-content-row6">
                <div class="q-content-row6-left">   
                    <div class="q-content-row6-video">
                    <video width="100%" height="100%" controls>
                        <source src="movie.mp4" type="video/mp4">
                    </video>
                    </div>
                </div>
                <div class="q-content-row6-right">
                    <div class="q-content-row2-title">
                        <p>Video Demo App Chấm Công</p>
                    </div>
                    <div class="q-content-row4-desc">
                        <p> <span>PunchClock</span>365 là một giải pháp mới giúp người dùng có 
                        thể tự quản lý và theo dõi được ngày công của mình. Đồng thời các 
                        nhà quản trị nhân sự sẽ không phải tốn nhiều thời gian cho việc quản 
                        lý công cán cho nhân viên trong doanh nghiệp.</p>
                    </div>
                </div>
            </div>
            <div class="q-content-banner">
                <div class="q-content-banner-frame"></div>
                <div class="q-content-banner-left">
                    <div class="q-content-banner-desc">
                        <div class="q-banner-col">
                            <div class="q-banner-row">
                                <div class="q-banner-row-count">
                                    <p>150+</p>
                                    <p>Công ty đã sử dụng</p>
                                </div>
                                <div class="q-banner-row-count">
                                    <p>2000+</p>
                                    <p>Người lao động</p>
                                </div>
                                <div class="q-banner-row-count">
                                    <p>5*</p>
                                    <p>Đánh giá ứng dụng</p>
                                </div>
                            </div>
                            <div class="q-banner-row">
                                <div class="q-banner-row-img">
                                    <img src="../images/trangchu-body-banner-phone.png" alt="img">
                                </div>
                                <span class="q-banner-row-phonenumber">0971.335.869</span><span>024 36.36.66.99</span>
                            </div>
                            <div class="q-banner-row">
                                <div class="q-banner-row-img">
                                    <img src="../images/trangchu-body-banner-mail.png" alt="img">
                                </div>
                                <p>Timviec365com@gmail.com</p>
                            </div>
                            <div class="q-banner-row">
                                <div class="q-banner-row-img">
                                    <img src="../images/trangchu-body-banner-address.png" alt="img">
                                </div>
                                <div class="q-banner-row-address">
                                    <p>Số 206 Định Công Hạ , Phường Định Công,</p>
                                    <p>Quận Hoàng Mai, Thành phố Hà Nội, Việt Nam</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="q-content-banner-right">
                    <form class="q-content-banner-form">
                        <p class="q-content-banner-form-title">Tên người nhận tư vấn</p>
                        <input type="text" name="" id="banne_input_name" class="q-content-banner-input">
                        <p class="val_error" id="index_error_name"></p>
                        <p class="q-content-banner-form-title">Email</p>
                        <input type="text" name="" id="banne_input_email" class="q-content-banner-input">
                        <p class="val_error" id="index_error_email"></p>
                        <p class="q-content-banner-form-title">Số điện thoại</p>
                        <input type="text" name="" id="banne_input_phone" class="q-content-banner-input">
                        <p class="val_error" id="index_error_phone"></p>
                        <p class="q-content-banner-form-title">Quy mô của công ty</p>
                        <input type="text" name="" id="banne_input_quymo" class="q-content-banner-input">
                        <p class="val_error" id="index_error_quymo"></p>
                        <p class="q-content-banner-form-title">Nội dung cần được tư vấn</p>
                        <input type="text" name="" id="banne_input_nd" class="q-content-banner-input">
                        <p class="val_error" id="index_error_nd"></p>
                        <button type="submit" class="q-content-banner-button"><span>Đăng ký</span></button>
                    </form>
                </div>
            </div>
            <div class="q-content-p">
                <p class="q-content-p-first">Bước tiến mạnh mẽ của công nghệ số đã và đang thay đổi một cách ngoạn 
                    mục mọi mặt đời sống kinh tế, xã hội, trong đó cách các nhà quản trị 
                    vận hành doanh nghiệp.Việc ứng dụng công nghệ vào các phương pháp quản 
                    lý trong các hoạt động thường nhật như điểm danh, chấm công, tính lương 
                    trở thành xu hướng tất yếu được lựa chọn bởi các nhà quản trị doanh nghiệp. 
                    Các ứng dụng chấm công cho nhân viên trực tuyến tiêu biểu như App 
                    chấm công online, chấm công nhận diện khuôn mặt là “đại biểu” cho 
                    xu hướng số hóa này. Vậy App chấm công là gì? Và mang lại lợi ích 
                    cụ thể như thế nào? Hãy cùng timviec365.vn tìm hiểu cụ thể sau bài viết sau nhé. </p>
                <div class="q-content-p-title">
                    <span>
                    1. Chấm công là gì? Có những ứng dụng chấm công đi làm nào?1.1. Máy chấm công bạn hiểu là gì? </span> 
                    </span> 
                </div>
                <p>
                    Ngay từ thời điểm doanh nghiệp hình thành,các thiết bị chấm công kết hợp 
                    với việc điểm danh cơ học của nhân sự trở thành căn cứ tiêu biểu giúp 
                    các công ty ghi lại được thời điểm đến làm việc, tan làm, nghỉ phép của 
                    người lao động từ đó, tính công và lương, thưởng cho người lao động vào 
                    cuối tháng một cách chính xác, đồng thời góp phần nâng cao ý thức làm việc 
                    và kỷ luật của nhân viên tại nơi làm việc.
                </p>
                <div class="q-content-p-img">
                    <div class="q-content-p-img-r2"></div>
                </div>
                <div class="q-content-p-title">
                    <span>
                    1.2.1. Máy chấm công cơ học
                    </span> 
                </div>
                <p>
                Đối với những loại hình doanh nghiệp ra đời vào những năm 90 đến thập niên 2000, 
                đều không quá xa lạ với phương thức chấm công này. Trong đó, để ghi lại 
                thời điểm đến địa chỉ làm việc, nhân viên chỉ cần đưa thẻ vào máy. Máy sẽ 
                tự quét thời thời gian ra vào của từng người ra ra giấy và in ra. Với những 
                tiện ích đính kèm là thời gian chấm công nhanh, chỉ mất một giây, có chuông 
                báo giờ và ca tan làm. Thời điểm đầu mới ra mắt, máy chấm công cơ học hút 
                được sự quan tâm đông đảo của cộng đồng quản trị. Tuy nhiên, song song với 
                những ưu điểm, máy chấm công cơ học cũng phát sinh một số khe hở, ảnh hưởng 
                đến vấn đề quản lý bao gồm: chi phí giấy và mực in tăng vọt, không thể kiểm 
                soát được tình trạng chấm công hộ. Đặc biệt là không tối ưu được tình trạng 
                tính lương thủ công.
                </p>
            </div>
            <div class="q-content-download">
                <div class="q-content-download-phone"></div>
                <div class="q-content-download-div">
                    <p>Tải App Ngay Hôm Nay Để Được Sử Dụng Công Nghệ Chấm Công Mới Nhất</p>
                    <div class="q-content-download-div-button">
                        <a href=""><div class="q-content-download-button">
                            <img src="../images/gplay.png" alt="ggplay">
                            <p>Google Play</p>
                        </div></a>
                        <a href=""><div class="q-content-download-button">
                            <img src="../images/app-store.png" alt="app-store">
                            <p>App Store</p>
                        </div></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <? include('../includes/inc_footer.php') ?>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/select2.min.js"></script>
    <script src="../js/slick.min.js"></script>
    <script src="../js/validate_nv/validate_nv.js"></script>
    <script>
        $(document).ready(function () {
            $(window).resize(function(){
                var width = $(window).width();
                if(width<=541){
                    $('.q-content-row1-flex').addClass('q-content-slick');
                    // $('.q-content-slick').slick({
                    //     autoplay: true,
                    //     autoplaySpeed: 2000,
                    //     slidesToShow: 1,
                    //     slidesToScroll: 1,
                    // });
                }   
            });
    
        });
    </script>
</body>
</html>