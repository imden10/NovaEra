<?php

namespace App\Components\MetaBox\Constructor\components;

class VideoAndText
{
    public $name = 'Відео і текст';

    public function html($key, $name, $value)
    {
        $positions = [
            'top' => __('Зверху'),
            'right' => __('Ліворуч'),
            //'bottom' => __('Внизу'),
            'left' => __('Праворуч')
        ];
        $position = [
            'name' => $name . '[' . $key . '][content][video_position]',
            'value' => isset($value['content']['video_position']) ? $value['content']['video_position'] : 'left'
        ];
        $video = [
            'name' => $name . '[' . $key . '][content][video_src]',
            'value' => isset($value['content']['video_src']) ? $value['content']['video_src'] : ''
        ];
        $text = [
            'name' => $name . '[' . $key . '][content][text]',
            'value' => isset($value['content']['text']) ? $value['content']['text'] : ''
        ];
        $link = [
            'name' => $name . '[' . $key . '][content][link]',
            'value' => isset($value['content']['link']) ? $value['content']['link'] : ''
        ];
        ?>

        <div class="body-block body-video-text">
            <div class="video-block">
                <label><?php _e('Позиция відео '); ?></label>
                <select name="<?php echo $position['name']; ?>" class="position-video-select">
                    <?php foreach ($positions as $k => $name) : ?>
                        <option value="<?php echo $k; ?>"<?php echo ($position['value'] == $k) ? ' selected' : ''; ?>><?php echo $name; ?></option>
                    <?php endforeach; ?>
                </select>

                <label><?php _e('Посилання на сторінку із відео (YouTube-ресурс)'); ?></label>
                <input type="url" class="meta-constructor-file-field" name="<?php echo $video['name']; ?>" value="<?php echo $video['value']; ?>">
            </div>

            <div class="text-block">
                <textarea id="componentVideoAndText<?php echo $key; ?>" name="<?php echo $text['name']; ?>" class="ck-editor"><?php echo $text['value']; ?></textarea>

                <input type="url" name="<?php echo $link['name']; ?>" value="<?php echo $link['value']; ?>" placeholder="<?php _e('Посилання '); ?>">
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#componentVideoAndText<?php echo $key; ?>').summernote({
                    height: 200
                });
            });
        </script>

        <?php
    }

    public function handlerStyle()
    {
        add_action('admin_footer', function () { ?>

            <style type="text/css">

                .body-video-text {
                    flex-wrap: wrap;
                }

                .video-block {
                    margin-bottom: 15px;
                    width: 100%;
                }

                .video-block input {
                    width: 50%;
                }

                .body-video-text .text-block textarea {
                    height: 250px!important;
                }

                .meta-constructor-file-field {
                    width: 100%!important;
                }

                .position-video-select {
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