<footer>
  <div class="container j_spbw">
    <div class="footer_1">
      <div class="title_footer">Timviec365.com - Tìm Việc Làm Nhanh, Tuyển Dụng Hiệu Quả</div>
      <p>Công ty TNHH MTV nguồn nhân lực 365 | Mã số thuế: 0109218540 do Sở kế hoạch và đầu tư thành phố Hà Nội cấp ngày 10/06/2020</p>
    </div>
    <div class="footer_1_1">
      <div>Timviec365.com - Tìm Việc Làm Nhanh, Tuyển Dụng Hiệu Quả</div>
      <p>Công ty TNHH MTV nguồn nhân lực 365 </p>
      <p>Mã số thuế: 0109218540 do Sở kế hoạch và đầu tư thành phố Hà Nội cấp ngày 10/06/2020</p>
    </div>
    <div class="footer_2">
      <div class="title_footer">Thông tin liên hệ</div>
      <p class="phone">Hotline: 0971.335.869 | 024 36.36.66.99</p>
      <p class="email">Email: Timviec365com@gmail.com</p>
      <p class="address">Địa chỉ: Số 206 Định Công Hạ , Phường Định Công, Quận Hoàng Mai, Thành phố Hà Nội, Việt Nam</p>
    </div>
    <div class="footer_4">
      <div class="title_footer">Ứng dụng thương mại điện tử </div>
      <div class="download_footer">
        <a class="ap_tv365" href="#"><span class="app_tv365">Tải app Timviec365</span></a>
        <a class="ap_cv365" href="#"><span class="app_cv365">Tải app CV365</span></a>
      </div>
    </div>
  </div>
  <div class="footer_5">
    <div class="container d_flex a_center j_spbw">
      <div class="footer_5_1 d_flex a_center">
        <a class="d_flex" href="https://twitter.com/timviec365_com"><img width="29" height="29" src="<?= base_url() ?>assets/images/twitter.png" alt="Twitter"></a>
        <a class="d_flex" href="https://www.facebook.com/timviec365com"><img width="29" height="29" src="<?= base_url() ?>assets/images/fb.png" alt="Facaebook"></a>
        <a class="d_flex" href="https://www.youtube.com/channel/UC5N0y9Dm9iu9CLQQFzxCaDw"><img width="29" height="29" src="<?= base_url() ?>assets/images/yt.png" alt="Youtube"></a>
      </div>
      <div class="footer_5_2 d_flex a_center">
        <ul class="d_flex menu_ft">
          <li><a href="https://timviec365.com/lien-he">Liên hệ</a></li>
          <li><a href="https://timviec365.com/quy-che-hoat-dong.html">Quy chế hoạt động</a></li>
          <li><a href="https://timviec365.com/thong-tin-can-biet.html">Thông tin cần biết</a></li>
          <li><a href="https://timviec365.com/thoa-thuan-su-dung.html">Thỏa thuận sử dụng</a></li>
          <li><a href="https://timviec365.com/quy-dinh-bao-mat.html">Quy định bảo mật</a></li>
          <li><a href="https://timviec365.com/co-che-giai-quyet-tranh-chap.html">Cơ chế giải quyết tranh chấp</a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>
<? require_once APPPATH . '/views/includes/inc_chat_staff_bottom.php'; ?>

<? require_once APPPATH . '/views/includes/inc_danhgia_nv.php'; ?>
<?php include APPPATH . '/views/includes/inc_danhgia.php'; ?>
<div class="backtotop" id="toTop">
  <img src="/assets/images/backtotop.svg" alt="backtotop">
</div>

<div class="modal fade" id="exampleModalLogout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width: 350px;margin: 50px auto;">
    <div class="modal-content">
      <div class="modal-header" style="position: relative;">
        <div class="modal-title" id="exampleModalLabel" style="color: #206AA9;font-weight: bold;font-size: 20px;">Thông báo</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute;top: 16px;right: 15px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="color: black;font-size: 16px;">
        Bạn có thực sự muốn đăng xuất không ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Quay lại</button>
        <a href="<?= urlDangXuatCty(); ?>" type="button" class="btn btn-primary">Đồng ý</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalLogoutStaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width: 350px;margin: 50px auto;">
    <div class="modal-content">
      <div class="modal-header" style="position: relative;">
        <div class="modal-title" id="exampleModalLabel" style="color: #206AA9;font-weight: bold;font-size: 20px;">Thông báo</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute;top: 16px;right: 15px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="color: black;font-size: 16px;">
        Bạn có thực sự muốn đăng xuất không ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Quay lại</button>
        <a href="<?= urlDangXuat(); ?>" type="button" class="btn btn-primary">Đồng ý</a>
      </div>
    </div>
  </div>
</div>
<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/js/cty/l_sidebar.js"></script>