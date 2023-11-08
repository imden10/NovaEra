<?php

namespace App\Components\MetaBox;

use App\Core\MetaBox\BaseMetaBox;

class Separator extends BaseMetaBox
{
    public function html()
    {
        echo '<br><h5>'.$this->label.'</h5><br>';
    }
}