<?php

namespace App\Components\MetaBox\Constructor\components;

class FormTitle
{
    public $name = 'Заголовок';


    public function html($key, $name, $value)
    {
        $title = [
            'title' => 'Заголовок',
            'name' => $name . '[' . $key . '][content][title]',
            'value' => isset($value['content']['title']) ? $value['content']['title'] : ''
        ];
        ?>

        <div class="body-block">
            <input type="text" class="form-control" placeholder="<?= $title['title'] ?>" id="componentLink<?php echo $key; ?>" name="<?php echo $title['name']; ?>" value="<?php echo $title['value']; ?>">
        </div>
        <?php
    }

    public function handlerStyle()
    {

    }

    public function handlerScript()
    {

    }
}