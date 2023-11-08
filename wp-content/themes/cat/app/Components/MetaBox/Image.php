<?php

namespace App\Components\MetaBox;

use App\Core\MetaBox\BaseMetaBox;

class Image extends BaseMetaBox
{
    public function html()
    {
        media_preview_box($this->name,$this->value ?? 0, $this->label);

        add_action('admin_print_footer_scripts', function () { ?>

            <script type="text/javascript">
                jQuery(document).ready(function($) {

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