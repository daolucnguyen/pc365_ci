                 <!-- <button type="button" name="" class="button-danhgia" data-toggle="modal" data-target="#modal_danhgia"></button> -->
                        <div id="modal_danhgia" class="modal fade q-modal-danhgia" role="dialog">
                            <div class="modal-dialog q-modal-danhgia-dialog">
                                <div class="modal-content q-modal-danhgia-content">
                                        <div class="modal-header q-modal-header">
                                            <button type="button" class="q-modal-header-button" data-dismiss="modal"><img src="../images/x.png" alt="x"></button>
                                            <p class="modal-title q-modal-title">Đánh Giá</p>
                                        </div>
                                        <form action="">
                                            <div class="modal-body q-modal-body-danhgia">
                                                <p class="q-modal-danhgia-title">Đánh Giá Chất Lượng</p>
                                                <div class="q-modal-danhgia-div">
                                                    <img src="../images/Star-danhgia.png" alt="star" class="q-modal-danhgia-star">
                                                    <img src="../images/Star-danhgia.png" alt="star" class="q-modal-danhgia-star">
                                                    <img src="../images/Star-danhgia.png" alt="star" class="q-modal-danhgia-star">
                                                    <img src="../images/Star-danhgia.png" alt="star" class="q-modal-danhgia-star">
                                                    <img src="../images/Star-danhgia.png" alt="star" class="q-modal-danhgia-star">
                                                </div>
                                                <p class="q-modal-danhgia-title">Nội dung chi tiết:</p>
                                                <textarea style="resize: none;" name="" id="" cols="30" rows="10" class="q-modal-danhgia-input" placeholder="Hãy cho chúng tôi biết cảm nghĩ của bạn về ứng dụng"></textarea>
                                                <div class="q-modal-footer-button-div">
                                                    <input type="reset" value="" id="baoloi_modal_reset" style="display:none">
                                                    <button type="submit" class="q-modal-footer-button" data-dismiss="modal">Đánh Giá</button>
                                                </div>
                                            </div>
                                        </form>
                                </div>
                            </div>
                        </div>
                        <script src="../js/jquery.min.js"></script>
                        <script src="../js/bootstrap.min.js"></script>
                        <script>
                            $('.q-modal-footer-button').click(function() {
                                $('#baoloi_modal_reset').click();
                            });
                        </script>
