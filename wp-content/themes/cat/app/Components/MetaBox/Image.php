<?php

namespace App\Components\MetaBox;

use App\Core\MetaBox\BaseMetaBox;

class Image extends BaseMetaBox
{
    public function html()
    {
        $src = $this->value != 0 ? wp_get_attachment_image_url($this->value, 'thumbnail') : 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkAQMAAABKLAcXAAAABlBMVEUAAAC7u7s37rVJAAAAAXRSTlMAQObYZgAAACJJREFUOMtjGAV0BvL/G0YMr/4/CDwY0rzBFJ704o0CWgMAvyaRh+c6m54AAAAASUVORK5CYII=';

        echo '<div class="form-group form-group-meta-term">';
        echo '<label for="' . $this->name . '">' . $this->label . '</label>';
        ?>

        <div class="image-wrapper" style="width: 200px; margin-top: 15px;">
            <a class="attach-image-<?php echo $this->name; ?>" href="#"><img src="<?php echo $src; ?>" alt="" style="width: 100%; height: auto"></a>

            <button type="button" class="button button-secondary remove-image"><?php _e('Remove'); ?></button>

            <input type="hidden" name="<?php echo $this->name; ?>" value="<?php echo $this->value; ?>" class="image-id">
        </div>

        <?php
        echo '</div>';

        add_action('admin_print_footer_scripts', function () { ?>

            <script type="text/javascript">
                jQuery(document).ready(function($) {

                    $(document).on('click', '.remove-image', function () {
                        removeImage($(this));
                    });

                    $(document).on('click', '.attach-image-<?php echo $this->name; ?>', function (e) {
                        choiceImage(e, $(this));
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
