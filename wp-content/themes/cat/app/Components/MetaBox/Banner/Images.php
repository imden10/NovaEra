<?php

namespace App\Components\MetaBox\Banner;

use App\Core\MetaBox\BaseMetaBox;

class Images extends BaseMetaBox
{
    public function html()
    {
        ?>

        <div class="form-group meta-box-form-group">
            <label>Зображення</label>
            <select class="form-control form-control-sm select-count-image" name="<?=$this->name?>[type]">
                <option value="1" <?php if(isset($this->value['type']) && $this->value['type'] === "1"):?> selected <?php endif;?> >Одне зображення</option>
                <option value="2" <?php if(isset($this->value['type']) && $this->value['type'] === "2"):?> selected <?php endif;?> >Два зображення</option>
            </select>
        </div>

        <div style="display: flex; gap: 30px">
            <div>
                <?php
                media_preview_box($this->name . "[image1]",$this->value['image1'] ?? 0, '');
                ?>
            </div>
            <div class="image2-box" <?php if(isset($this->value['type']) && $this->value['type'] === "2"):?> <?php else:?> style="display: none" <?php endif;?> >
                <?php
                media_preview_box($this->name . "[image2]",$this->value['image2'] ?? 0, '');
                ?>
            </div>
        </div>
        <?php

        add_action('admin_print_footer_scripts', function () { ?>

            <script type="text/javascript">
                jQuery(document).ready(function($) {

                    $('.select-count-image').on('change',function (){
                        let count = $(this).val();

                        if(count == 2){
                            $(".image2-box").show();
                        } else {
                            $(".image2-box").hide();
                        }
                    });

                    $(document).on('click', '.delete-image', function () {
                        removeImage($(this));
                    });

                });
            </script>

        <?php }, 999);
    }

    public static function beforeOutput($value)
    {
        return $value;
    }

    public static function beforeSave($value)
    {
        return $value;
    }
}