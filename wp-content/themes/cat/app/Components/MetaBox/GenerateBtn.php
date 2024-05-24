<?php

namespace App\Components\MetaBox;

use App\Core\MetaBox\BaseMetaBox;

class GenerateBtn extends BaseMetaBox
{
    public function html()
    {
        echo '<span>Generate';
        echo '</span>';
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