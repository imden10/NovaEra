<?php

namespace App\Components\Option;

use App\Core\Option\BaseOption;

class SelectTerm extends BaseOption
{
    public function html()
    {
        if (isset($this->params['term'])) :
            $terms = get_terms(['taxonomy' => $this->params['term'], 'hide_empty' => false]); ?>

            <div class="form-group meta-box-form-group">
                <select class="form-control meta-box-post-select-field <?php echo $this->name; ?>-select2" name="<?php echo $this->name; ?>">
                    <option value="">---</option>

                    <?php foreach ($terms as $item) :
                        $selected = ($item->term_id == $this->value) ? ' selected' : ''; ?>

                        <option value="<?php echo $item->term_id; ?>" <?php echo $selected; ?>><?php echo $item->name; ?></option>
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
