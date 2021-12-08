<div class="l_staff_notify">
    <div class="height_notify">
        <?
        $arr_img = [
            1 => '/assets/images/notify_error.svg',
            2 => '/assets/images/notify_cham_cong.svg',
            3 => '/assets/images/notify_cong_viec.svg',
            4 => '/assets/images/notify_cv_moi.svg',
            5 => '/assets/images/notify_lichtrinh_moi.svg',
        ];
        foreach ($notify as $value) {
        ?>
            <div class="l_flex l_justify l_delete_notify_staff" id="notify<?= $value['id_notify'] ?>" data-id="<?= $value['id_notify'] ?>">
                <div class="l_notify_item1">
                    <img src="<?
                    foreach ($arr_img as $key => $valueimg) {
                        if ($key == $value['image_notify']) {
                            echo base_url().$valueimg;
                        }
                    }
                    ?>" alt="icon_notify">
                </div>
                <div class="l_notify_item2">
                    <p class="l_notify_content"><?= $value['note']; ?></p>
                </div>
            </div>
        <?
        }
        ?>
    </div>
    <div class="l_flex l_justify l_delete_notify">
        <span class="l_delete_notify_item l_curson" onclick="deleteNotify()">
            Xóa hết tất cả
        </span>
    </div>
</div>