<?php

namespace App\Components\MetaBox\Constructor\components;

class VideoAndText
{
    public $name = 'Відео і текст';

    public function html($key, $name, $value)
    {
        $video = [
            'name' => $name . '[' . $key . '][content][link]',
            'value' => isset($value['content']['link']) ? $value['content']['link'] : ''
        ];

        $text = [
            'name' => $name . '[' . $key . '][content][text]',
            'value' => isset($value['content']['text']) ? $value['content']['text'] : ''
        ];
        ?>

        <div class="body-block">
            <div class="list-elements-body">
                <div class="mb-3">
                    <label>Посилання</label>
                    <input type="text" class="form-control" name="<?= $video['name']; ?>" value="<?= $video['value']; ?>">
                </div>
                <div class="mb-3">
                    <label>Текст</label>
                    <textarea id="componentText<?php echo $key; ?>" class="ck-editor" name="<?php echo $text['name']; ?>"><?php echo $text['value']; ?></textarea>
                </div>
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