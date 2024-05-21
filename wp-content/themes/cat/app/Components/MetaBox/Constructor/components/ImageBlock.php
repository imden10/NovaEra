<?php

namespace App\Components\MetaBox\Constructor\components;

class ImageBlock
{
    public $name = 'Зображення';


    public function html($key, $name, $value)
    {
        $image_id = [
            'name' => $name . '[' . $key . '][content][image][id]',
            'value' => isset($value['content']['image']['id']) ? $value['content']['image']['id'] : '0'
        ];
        ?>

        <div class="body-block">
            <div class="list-elements-body">
                <?= media_preview_box($image_id['name'],$image_id['value'], "Зображення"); ?>
            </div>
        </div>

        <?php
    }

    public function handlerStyle()
    {
        add_action('admin_footer', function () { ?>

        <?php });
    }

    public function handlerScript()
    {
        add_action('admin_footer', function () { ?>

            <script type="text/javascript">

                $(function () {

                });

            </script>

        <?php }, 99);
    }
}