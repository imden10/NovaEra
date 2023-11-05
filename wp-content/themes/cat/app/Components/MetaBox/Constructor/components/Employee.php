<?php

namespace App\Components\MetaBox\Constructor\components;

class Employee
{
    public $name = 'Співробітники';

    public function html($key, $name, $value)
    {
        $ids = [
            'name' => $name . '[' . $key . '][content][ids]',
            'value' => isset($value['content']['ids']) ? $value['content']['ids'] : []
        ];

        $employees = get_posts([
            'post_type' => 'employee',
            'posts_per_page' => -1,
            'orderby' => [
                'title' => 'ASC',
            ],
            'lang' => function_exists('pll_current_language') ? pll_current_language() : get_locale(),
        ]);
        ?>

        <div class="body-block">
            <div class="peoples">
                <label><?php _e('Вибір співробітників для відображення (мультіселект)'); ?></label>
                <select name="<?php echo $ids['name']; ?>[]" class="people-select2-<?php echo $key ?>" size="10" multiple="multiple">
                    <?php foreach ($employees as $employee) : ?>
                        <option value="<?php echo $employee->ID; ?>"<?php if (in_array($employee->ID, $ids['value'])) echo ' selected'; ?>><?php echo $employee->post_title; ?></option>
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