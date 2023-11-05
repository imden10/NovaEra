<?php

namespace App\Components\Option;

use App\Core\Option\BaseOption;

class SelectPost extends BaseOption
{
    public function html()
    {
        if (!empty($this->params['list'])) : ?>

            <div class="form-group meta-box-form-group">
                <select class="form-control meta-box-post-select-field <?php echo $this->name; ?>-select2" name="<?php echo $this->name; ?>">
                    <option value="">---</option>

                    <?php if (!empty($this->params['group_by'])) :

                        foreach ($this->params['group_by'] as $group) : ?>
                            <option disabled>--- <?php echo $group->post_title; ?> ---</option>

                            <?php foreach ((array) $this->params['list'] as $item) :

                                $selected = ($item->ID == $this->value) ? ' selected' : '';

                                if (isset($this->params['group_meta_field'], $item->{$this->params['group_meta_field']}) && $item->{$this->params['group_meta_field']} == $group->ID) : ?>
                                    <option value="<?php echo $item->ID ?>" <?php echo $selected; ?>><?php echo $item->post_title; ?></option>
                                <?php endif;

                            endforeach;

                        endforeach;

                    else :

                        foreach ((array) $this->params['list'] as $item) :
                            $selected = ($item->ID == $this->value) ? ' selected' : ''; ?>

                            <option value="<?php echo $item->ID ?>" <?php echo $selected; ?>><?php echo $item->post_title; ?></option>
                        <?php endforeach;

                    endif; ?>
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
