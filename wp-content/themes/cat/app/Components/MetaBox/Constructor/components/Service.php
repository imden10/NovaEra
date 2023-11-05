<?php

namespace App\Components\MetaBox\Constructor\components;

class Service
{
    public $name = 'Послуги';

    public function html($key, $name, $value)
    {
        $ids = [
            'name' => $name . '[' . $key . '][content][ids]',
            'value' => isset($value['content']['ids']) ? $value['content']['ids'] : []
        ];

        $services = get_posts([
            'post_type' => 'service',
            'posts_per_page' => -1,
            'orderby' => [
                'title' => 'ASC',
            ],
            'lang' => function_exists('pll_current_language') ? pll_current_language() : get_locale(),
        ]);
        ?>

        <div class="body-block">
            <div class="peoples">
                <label><?php _e('Вибір послуг (мультіселект)'); ?></label>
                <select name="<?php echo $ids['name']; ?>[]" class="people-select2-<?php echo $key ?>" size="10" multiple="multiple">
                    <?php foreach ($services as $item) : ?>
                        <option value="<?php echo $item->ID; ?>"<?php if (in_array($item->ID, $ids['value'])) echo ' selected'; ?>><?php echo $item->post_title; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <script type="text/javascript">

            $('.people-select2-<?php echo $key ?>').select2();

        </script>

        <?php
    }

    public function handlerStyle()
    {
        add_action('admin_footer', function () { ?>

            <style type="text/css">

                .peoples,
                .select2,
                .peoples select {
                    width: 100%!important;
                }

            </style>

        <?php });
    }

    public function handlerScript()
    {
        /*
        add_action('admin_footer', function () { ?>

            <script type="text/javascript">
                jQuery(document).ready(function($) {

                });
            </script>

        <?php });
        */
    }
}