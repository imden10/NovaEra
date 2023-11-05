<?php

namespace App\Components\MetaBox;

use App\Core\MetaBox\BaseMetaBox;

class MultiSelectPost extends BaseMetaBox
{
    public function html()
    {
        if (!empty($this->params['list'])) : ?>

            <div class="form-group meta-box-form-group">
                <label for="<?php echo $this->name; ?>"><?php echo $this->label; ?></label>

                <select id="<?php echo $this->name; ?>" class="form-control meta-box-post-select-field <?php echo $this->name; ?>-select2" name="<?php echo $this->name; ?>[]" multiple="multiple">
                    <option value="">---</option>

                    <?php foreach ((array) $this->params['list'] as $item) :
                        $selected = in_array($item->ID, $this->value) ? ' selected' : ''; ?>

                        <option value="<?php echo $item->ID ?>" <?php echo $selected; ?>><?php echo $item->post_title; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

        <?php endif;

        add_action('admin_print_footer_scripts', function() { ?>
            <script type="text/javascript">
                jQuery(document).ready(function($){
                    $('.<?php echo $this->name; ?>-select2').select2();
                });
            </script>
        <?php }, 99);
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
