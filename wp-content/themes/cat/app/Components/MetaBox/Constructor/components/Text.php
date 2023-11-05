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
        ?>

        <div class="body-block">
            <div class="textarea-part">
                <textarea id="componentText<?php echo $key; ?>" class="ck-editor" name="<?php echo $text['name']; ?>"><?php echo $text['value']; ?></textarea>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#componentText<?php echo $key; ?>').summernote({
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