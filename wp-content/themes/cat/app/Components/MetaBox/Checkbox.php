<?php

namespace App\Components\MetaBox;

use App\Core\MetaBox\BaseMetaBox;

class Checkbox extends BaseMetaBox
{
    public function html()
    {
        $checked = isset($this->value) && $this->value == 1 ? ' checked' : ''; ?>

        <div class="form-group">
            <label for="<?php echo $this->name; ?>">
                <input id="<?php echo $this->name; ?>" class="form-control" type="checkbox" name="<?php echo $this->name; ?>" value="1"<?php echo $checked; ?>>

                <?php echo $this->label; ?>
            </label>
        </div>
    <?php }

    public static function beforeOutput($value)
    {
        return $value;
    }

    public static function beforeSave($value)
    {
        return $value;
    }
}
