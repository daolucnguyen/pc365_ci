<div class="q-menu-sidebar">
    <div class="menu-qly">
        <a href="/"><img src="../images/logo-menu.png" alt="logo" class="q-menu-logo" /></a>
        <uv class="nav " id="menu-ul">
            <li class="nav-item q-nav-item" id="li_qlychung">
                <div class="menu-img" id="menu_cat">
                <span><a href="/danh-cho-nhan-vien/quan-ly-chung.html" class="menu-link " id="link-1">Quản lí chung</a></span>
            </li>
            <li class="nav-item q-nav-item" id="li_chamcong">
                <div class="menu-img" id="menu_scan">
                <span><a href="/danh-cho-nhan-vien/quan-ly-cham-cong.html" class="menu-link" id="link-2">Quản lí chấm công</a></span>
            </li>
            <li class="nav-item q-nav-item" id="li_lichtrinh">
                <div class="menu-img" id="menu_location">
                <span><a href="/danh-cho-nhan-vien/quan-ly-lich-trinh.html" class="menu-link" id="link-3">Quản lí lịch trình</a></span>
            </li>
            <li class="nav-item q-nav-item" id="li_nhanviec">
                <div class="menu-img" id="menu_work">
                <span><a href="/danh-cho-nhan-vien/nhan-viec.html" class="menu-link" id="link-4">Nhận việc</a></span>
            </li>
            <li class="nav-item q-nav-item item-drop" id="li_qlytaikhoan">
                <div class="menu-img" id="menu_pro">
                <span class="menu-link" id="link-5">Quản lí tài khoản</span>
                <img src="../images/drop-img.png" alt="down" class="img-drop">
            </li>
            <ul class="menu-drop hide">
                <li class="li-drop"> <span ><a href="/danh-cho-nhan-vien/cap-nhat-thong-tin.html" class="menu-drop-link menu-link" id="link-6">Cập nhật thông Tin</a></span> </li>
                <li class="li-drop"> <span ><a href="/danh-cho-nhan-vien/doi-mat-khau.html" class="menu-drop-link menu-link" id="link-7">Đổi mật khẩu</a></span> </li>
            </ul>
            <li class="nav-item q-nav-item" id="li_baoloi">
                <div class="menu-img" id="menu_error">
                <span><a href="/danh-cho-nhan-vien/bao-loi.html" class="menu-link" id="link-8">Báo lỗi</a></span>
            </li>
            <li class="nav-item q-nav-item" id="nv_danhgia" data-toggle="modal" data-target="#modal_danhgia">
                <div class="menu-img" id="menu_star">
                <span><p class="menu-link" id="link-9">Đánh giá</p></span>
            </li>
            <li class="nav-item q-nav-item">
               <div class="menu-img" id="menu_logout">
               <span><a href="" class="menu-link" id="link-10">Đăng xuất</a></span>
            </li>
        </uv>
    </div>
    <?php include '../includes/inc_danhgia.php'; ?>
</div>
<script>
    $(document).ready(function () {

        $('#li_qlychung').mouser(function(){
            $('#menu_cat').attr('src','../images/Category-active.png');
        });
        $('#li_qlychung').mouseout(function(){
            $('#menu_cat').attr('src','../images/Category.png');
        });
        // $('#li_chamcong').hover(function(){
        //     $('#menu_scan').attr('src','../images/Scan-active.png');
        // });
        // $('#li_chamcong').mouseout(function(){
        //     $('#menu_scan').attr('src','../images/Scan.png');
        // });
        // $('#li_lichtrinh').hover(function(){
        //     $('#menu_location').attr('src','../images/Location-active.png');
        // });
        // $('#li_lichtrinh').mouseout(function(){
        //     $('#menu_location').attr('src','../images/Location.png');
        // });
        // $('#li_nhanviec').hover(function(){
        //     $('#menu_work').attr('src','../images/Work-active.png');
        // });
        // $('#li_nhanviec').mouseout(function(){
        //     $('#menu_work').attr('src','../images/Work.png');
        // });
        // $('#li_qlytaikhoan').hover(function(){
        //     $('#menu_pro').attr('src','../images/Profile-active.png');
        // });
        // $('#li_qlytaikhoan').mouseout(function(){
        //     $('#menu_pro').attr('src','../images/Profile.png');
        // });
        // $('#li_baoloi').hover(function(){
        //     $('#menu_error').attr('src','../images/menu-error-active.png');
        // });
        // $('#li_baoloi').mouseout(function(){
        //     $('#menu_error').attr('src','../images/menu-error.png');
        // });
    });
</script>