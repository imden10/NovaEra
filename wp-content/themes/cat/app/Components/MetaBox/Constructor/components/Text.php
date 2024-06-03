<?php

namespace App\Components\MetaBox\Constructor\components;

class Text
{
    public $name = 'Текст';

    public function html($key, $name, $value)
    {
        $text = [
            'name' => $name . '[' . $key . '][content][text]',
            'value' => isset($value['content']['text']) ? $value['content']['text'] : ''
        ];

        $miniText = [
            'name' => $name . '[' . $key . '][content][mini_text]',
            'value' => isset($value['content']['mini_text']) ? $value['content']['mini_text'] : ''
        ];
        ?>

        <div class="body-block">
            <div class="textarea-part">
                <label>Текст</label>
                <textarea id="componentText<?php echo $key; ?>" class="ck-editor" name="<?php echo $text['name']; ?>"><?php echo $text['value']; ?></textarea>

                <br>

                <label>Міні текст</label>
                <textarea id="componentMiniText<?php echo $key; ?>" class="ck-editor" name="<?php echo $miniText['name']; ?>"><?php echo $miniText['value']; ?></textarea>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#componentText<?php echo $key; ?>').summernote(summernote_options);
            });

            $(document).ready(function() {
                $('#componentMiniText<?php echo $key; ?>').summernote(summernote_options);
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