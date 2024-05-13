<?php

namespace App\Components\MetaBox\Constructor\components;

class Quote
{
    public $name = 'Цитата';

    public function html($key, $name, $value)
    {
        $text = [
            'name' => $name . '[' . $key . '][content][text]',
            'value' => isset($value['content']['text']) ? $value['content']['text'] : ''
        ];
        ?>

        <div class="body-block">
            <div class="quote-part">
                <textarea id="componentQuote<?php echo $key; ?>" name="<?php echo $text['name']; ?>" class="ck-editor"><?php echo $text['value']; ?></textarea>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#componentQuote<?php echo $key; ?>').summernote(summernote_options);
            });
        </script>

        <?php
    }

    public function handlerStyle()
    {
        add_action('admin_footer', function () { ?>

            <style type="text/css">

                .quote-part,
                .quote-part textarea {
                    width: 100%;
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