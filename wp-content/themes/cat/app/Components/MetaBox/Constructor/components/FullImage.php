<?php

namespace App\Components\MetaBox\Constructor\components;

class FullImage
{
    public $name = 'Фото';


    public function html($key, $name, $value)
    {
        $widthOptions = [
            '80' => __('По контейнеру'),
            '100' => __('На всю ширину'),
        ];
        $width_type = [
            'name' => $name . '[' . $key . '][content][width_type]',
            'value' => isset($value['content']['width_type']) ? $value['content']['width_type'] : '80'
        ];

        $font_size_options = [
            'normal' => __('Звичайний'),
            'small' => __('Маленький'),
        ];

        $title_font_size = [
            'name' => $name . '[' . $key . '][content][title_font_size]',
            'value' => isset($value['content']['title_font_size']) ? $value['content']['title_font_size'] : 'normal'
        ];

        $image_id = [
            'name' => $name . '[' . $key . '][content][image][id]',
            'value' => isset($value['content']['image']['id']) ? $value['content']['image']['id'] : '0'
        ];
        ?>

        <div class="body-block">
            <div class="list-elements-body">
                <div class="mb-3">
                    <label for="title_font_size" class="form-label"><?php _e('Розмір шрифту заголовка '); ?></label>
                    <select name="<?php echo $title_font_size['name']; ?>" class="form-control form-control-sm" id="title_font_size">
                        <?php foreach ($font_size_options as $key => $name) : ?>
                            <option value="<?php echo $key; ?>"<?php echo ($title_font_size['value'] == $key) ? ' selected' : ''; ?>><?php echo $name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label><?php _e('Ширина фото '); ?></label>
                    <select name="<?php echo $width_type['name']; ?>" class=" form-control form-control-sm">
                        <?php foreach ($widthOptions as $k => $name) : ?>
                            <option value="<?php echo $k; ?>"<?php echo ($width_type['value'] == $k) ? ' selected' : ''; ?>><?php echo $name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <?= media_preview_box($image_id['name'],$image_id['value'], "Зображення"); ?>
            </div>
        </div>

        <?php
    }

    public function handlerStyle()
    {
        add_action('admin_footer', function () { ?>

            <style type="text/css">
                .text-block {
                    -webkit-align-self: stretch;
                    align-self: stretch;
                    width: 100%;
                }

                .text-block textarea {
                    width: 100%;
                    height: calc(100% - 30px)!important;
                }

                .text-block input {
                    margin-top: 0;
                }

                .delete-image {
                    width: 200px;
                    margin: 0 auto;
                }

                .position-image-select {
                    width: 100%;
                }

            </style>

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