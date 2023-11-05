<?php

namespace App\Components\MetaBox\Constructor\components;

class ThreeColumnText
{
    public $name = 'Текст з трьомв колонками';


    public function html($key, $name, $value)
    {
        $text_1 = [
            'name' => $name . '[' . $key . '][content][text][1]',
            'value' => isset($value['content']['text'][1]) ? $value['content']['text'][1] : ''
        ];

        $text_2 = [
            'name' => $name . '[' . $key . '][content][text][2]',
            'value' => isset($value['content']['text'][2]) ? $value['content']['text'][2] : ''
        ];

        $text_3 = [
            'name' => $name . '[' . $key . '][content][text][3]',
            'value' => isset($value['content']['text'][3]) ? $value['content']['text'][3] : ''
        ];
        ?>

        <div class="body-block">
            <div class="textarea-part">
                <textarea id="componentText1<?php echo $key; ?>" class="ck-editor" name="<?php echo $text_1['name']; ?>"><?php echo $text_1['value']; ?></textarea>
            </div>

            <div class="textarea-part">
                <textarea id="componentText2<?php echo $key; ?>" class="ck-editor" name="<?php echo $text_2['name']; ?>"><?php echo $text_2['value']; ?></textarea>
            </div>

            <div class="textarea-part">
                <textarea id="componentText3<?php echo $key; ?>" class="ck-editor" name="<?php echo $text_3['name']; ?>"><?php echo $text_3['value']; ?></textarea>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#componentText1<?php echo $key; ?>').summernote({
                    height: 200
                });
                $('#componentText2<?php echo $key; ?>').summernote({
                    height: 200
                });
                $('#componentText3<?php echo $key; ?>').summernote({
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