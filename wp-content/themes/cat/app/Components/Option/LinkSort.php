<?php

namespace App\Components\Option;

use App\Core\Option\BaseOption;

class LinkSort extends BaseOption
{
    public function html()
    {
        echo '<div style="display: flex; gap: 30px">';
        echo '<input class="form-control" type="text" name="' . $this->name . '[link]" value="' . ($this->value['link'] ?? '') . '">';
        echo '<input class="form-control" type="text" name="' . $this->name . '[sort]" value="' . ($this->value['sort'] ?? 0) . '">';
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