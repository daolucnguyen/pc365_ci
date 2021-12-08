<!-- <button type="button" name="" class="button-danhgia" data-toggle="modal" data-target="#modal_danhgia"></button> -->
<div id="modal_danhgia" class="modal fade q-modal-danhgia" role="dialog">
    <div class="modal-dialog q-modal-danhgia-dialog">
        <div class="modal-content q-modal-danhgia-content">
            <div class="modal-header q-modal-header">
                <button type="button" class="q-modal-header-button" data-dismiss="modal"><img src="<?= base_url(); ?>assets/images/x.png" alt="x"></button>
                <p class="modal-title q-modal-title">Đánh Giá</p>
            </div>
            <form action="">
                <div class="modal-body q-modal-body-danhgia">
                    <p class="q-modal-danhgia-title">Đánh Giá Chất Lượng</p>
                    <div class="q-modal-danhgia-div">
                        <ul class="ratings">
                            <li class="star" name="5"></li>
                            <li class="star" name="4"></li>
                            <li class="star" name="3"></li>
                            <li class="star" name="2"></li>
                            <li class="star" name="1"></li>
                        </ul>
                    </div>
                    <p class="q-modal-danhgia-title">Nội dung chi tiết:</p>
                    <textarea style="resize: none;" name="" id="note" cols="30" rows="10" class="q-modal-danhgia-input" placeholder="Hãy cho chúng tôi biết cảm nghĩ của bạn về ứng dụng"></textarea>
                    <div id="err_evaluate" class="error"></div>
                    <div class="q-modal-footer-button-div">
                        <input type="reset" value="" id="baoloi_modal_reset" style="display:none">
                        <button type="button" onclick="danhgia();" class="q-modal-footer-button">Đánh Giá</button>
                        <!-- data-dismiss="modal" -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>