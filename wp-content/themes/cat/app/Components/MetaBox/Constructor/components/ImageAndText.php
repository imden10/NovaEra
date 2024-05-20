<?php

namespace App\Components\MetaBox\Constructor\components;

class ImageAndText
{
    public $name = 'Зображення і текст';

    protected static $defaultImage = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkAQMAAABKLAcXAAAABlBMVEUAAAC7u7s37rVJAAAAAXRSTlMAQObYZgAAACJJREFUOMtjGAV0BvL/G0YMr/4/CDwY0rzBFJ704o0CWgMAvyaRh+c6m54AAAAASUVORK5CYII=';


    public function html($key, $name, $value)
    {
        $positions = [
            'top' => __('Зверху'),
            'right' => __('Праворуч'),
            //'bottom' => __('Внизу'),
            'left' => __('Ліворуч')
        ];
        $position = [
            'name' => $name . '[' . $key . '][content][image_position]',
            'value' => isset($value['content']['image_position']) ? $value['content']['image_position'] : 'left'
        ];
        $text = [
            'name' => $name . '[' . $key . '][content][text]',
            'value' => isset($value['content']['text']) ? $value['content']['text'] : ''
        ];
        $link = [
            'name' => $name . '[' . $key . '][content][link]',
            'value' => isset($value['content']['link']) ? $value['content']['link'] : ''
        ];
        $image_id = [
            'name' => $name . '[' . $key . '][content][image][id]',
            'value' => isset($value['content']['image']['id']) ? $value['content']['image']['id'] : '0'
        ];
        $imageFormatTypeList = [
            'portrait' => __('Сімейне фото'),
            'fon' => __('Фонове зображення'),
        ];
        $imageFormatType = [
            'name' => $name . '[' . $key . '][content][image_format_type]',
            'value' => isset($value['content']['image_format_type']) ? $value['content']['image_format_type'] : 'portrait'
        ];
        ?>

        <div class="body-block">
            <div class="image-block">
                <label><?php _e('Позиція зображення '); ?></label>
                <select name="<?php echo $position['name']; ?>" class="position-image-select">
                    <?php foreach ($positions as $k => $name) : ?>
                        <option value="<?php echo $k; ?>"<?php echo ($position['value'] == $k) ? ' selected' : ''; ?>><?php echo $name; ?></option>
                    <?php endforeach; ?>
                </select>

                <label style="margin-top: 15px"><?php _e('Формат зображення'); ?></label>
                <select name="<?php echo $imageFormatType['name']; ?>" class="position-image-select">
                    <?php foreach ($imageFormatTypeList as $imageFormatTypeListKey => $imageFormatTypeListItem) : ?>
                        <option value="<?php echo $imageFormatTypeListKey; ?>"<?php echo ($imageFormatType['value'] == $imageFormatTypeListKey) ? ' selected' : ''; ?>><?php echo $imageFormatTypeListItem; ?></option>
                    <?php endforeach; ?>
                </select>

                <div class="image-wrapper">
                    <a class="attach-image" href="#">
                        <img src="<?php echo $image_id['value'] != 0 ? wp_get_attachment_image_url($image_id['value'], 'thumbnail') : self::$defaultImage; ?>" alt="">
                    </a>
                    <input type="hidden" name="<?php echo $image_id['name']; ?>" value="<?php echo $image_id['value']; ?>" class="image-id">

                    <button type="button" class="button button-secondary delete-image">
                        <?php _e('Remove'); ?>
                    </button>
                </div>
            </div>

            <div class="text-block">
                <textarea id="componentImageAndText<?php echo $key; ?>" name="<?php echo $text['name']; ?>" class="ck-editor"><?php echo $text['value']; ?></textarea>

                <input type="text" name="<?php echo $link['name']; ?>" value="<?php echo $link['value']; ?>" placeholder="<?php _e('Посилання '); ?>">
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#componentImageAndText<?php echo $key; ?>').summernote(summernote_options);
            });
        </script>

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