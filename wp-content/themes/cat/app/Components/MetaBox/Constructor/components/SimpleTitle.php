<?php

namespace App\Components\MetaBox\Constructor\components;

class SimpleTitle
{
    public $name = 'Заголовок';


    public function html($key, $name, $value)
    {
        $subtitle = [
            'title' => 'Підзаголовок',
            'name' => $name . '[' . $key . '][content][subtitle]',
            'value' => isset($value['content']['subtitle']) ? $value['content']['subtitle'] : ''
        ];
        ?>

        <div class="body-block">
            <div class="textarea-part">
                <input type="text" placeholder="<?= $subtitle['title'] ?>" id="componentLink<?php echo $key; ?>" name="<?php echo $subtitle['name']; ?>" value="<?php echo $subtitle['value']; ?>">
            </div>
        </div>
        <?php
    }

    public function handlerStyle()
    {
        /*
        add_action('admin_footer', function () { ?>

            <style type="text/css">

            </style>

        <?php });*/
    }

    public function handlerScript()
    {
        /*
        add_action('admin_footer', function () { ?>

            <script type="text/javascript">
            </script>

        <?php });
        */
    }
}