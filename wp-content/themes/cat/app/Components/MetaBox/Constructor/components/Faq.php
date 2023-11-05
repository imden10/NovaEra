<?php

namespace App\Components\MetaBox\Constructor\components;

class Faq
{
    public $name = 'Часті запитання';

    public function html($key, $name, $value)
    {
        $subtitle = [
            'name' => $name . '[' . $key . '][content][subtitle]',
            'value' => isset($value['content']['subtitle']) ? $value['content']['subtitle'] : ''
        ];

        $ids = [
            'name' => $name . '[' . $key . '][content][ids]',
            'value' => isset($value['content']['ids']) ? $value['content']['ids'] : []
        ];

        $faqs = get_posts([
            'post_type' => 'faq',
            'posts_per_page' => -1,
            'orderby' => [
                'title' => 'ASC',
            ],
            'lang' => function_exists('pll_current_language') ? pll_current_language() : get_locale(),
        ]);
        ?>

        <div class="faq-subtitle">
            <input type="text" placeholder="<?php _e('Підзаголовок'); ?>" name="<?php echo $subtitle['name']; ?>" value="<?php echo $subtitle['value']; ?>">
        </div>

        <div class="body-block">
            <div class="peoples">
                <label><?php _e('Вибір частих запитань (мультіселект)'); ?></label>
                <select name="<?php echo $ids['name']; ?>[]" class="people-select2-<?php echo $key ?>" size="10" multiple="multiple">
                    <?php foreach ($faqs as $item) : ?>
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

                .faq-subtitle input {
                    width: 100%;
                    margin-bottom: 15px;
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