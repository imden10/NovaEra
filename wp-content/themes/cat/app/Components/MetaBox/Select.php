<?php

namespace App\Components\MetaBox;

use App\Core\MetaBox\BaseMetaBox;

class Select extends BaseMetaBox
{
    public function html()
    {
        echo '<div class="form-group meta-box-form-group">';
        echo '<label for="' . $this->name . '">' . $this->label . '</label>';

        echo '<select id="' . $this->name . '" name="' . $this->name . '">';
        if (isset($this->params['list']))
        {
            foreach ((array) $this->params['list'] as $key => $value)
            {
                $selected = ($key == $this->value) ? ' selected' : '';
                echo '<option value="' . $key . '"' . $selected . '>' . $value . '</option>';
            }
        }
        echo '</select>';

        echo '</div>';
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