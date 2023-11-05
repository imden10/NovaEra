<?php

namespace App\Components\MetaBox\Constructor\components;

class TextDivider
{
    public $name = 'Роздільник тексту';

    public function html($key, $name, $value)
    {
        $font_size_options = [
            'normal' => __('Звичайний'),
            'small' => __('Маленький'),
        ];

        $font_size = [
            'name' => $name . '[' . $key . '][content][font_size]',
            'value' => isset($value['content']['font_size']) ? $value['content']['font_size'] : 'normal'
        ];

        $text = [
            'name' => $name . '[' . $key . '][content][text]',
            'value' => isset($value['content']['text']) ? $value['content']['text'] : ''
        ];
        ?>

        <div class="body-block">
            <div class="list-elements-body">
                <div class="mb-3">
                    <label for="font_size" class="form-label"><?php _e('Розмір шрифту '); ?></label>
                    <select name="<?php echo $font_size['name']; ?>" class="form-control form-control-sm" id="font_size">
                        <?php foreach ($font_size_options as $key2 => $name) : ?>
                            <option value="<?php echo $key2; ?>"<?php echo ($font_size['value'] == $key2) ? ' selected' : ''; ?>><?php echo $name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <div class="textarea-part">
                        <textarea id="componentTextDivider<?php echo $key; ?>" class="ck-editor" name="<?php echo $text['name']; ?>"><?php echo $text['value']; ?></textarea>
                    </div>
                </div>
            </div>

        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#componentTextDivider<?php echo $key; ?>').summernote({
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
                .textarea-part,
                .textarea-part textarea {
                    width: 100%;
                }

                .type-checkbox {
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
            </script>

        <?php });
        */
    }
}