<?php

namespace App\Components\MetaBox\Constructor\components;

class TextWithBackground
{
    public $name = 'СТА';

    protected static $defaultImage = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkAQMAAABKLAcXAAAABlBMVEUAAAC7u7s37rVJAAAAAXRSTlMAQObYZgAAACJJREFUOMtjGAV0BvL/G0YMr/4/CDwY0rzBFJ704o0CWgMAvyaRh+c6m54AAAAASUVORK5CYII=';


    public function html($key, $name, $value)
    {
        $text = [
            'name' => $name . '[' . $key . '][content][text]',
            'value' => isset($value['content']['text']) ? $value['content']['text'] : ''
        ];
        ?>

        <div class="body-block">
            <div class="text-block">
                <textarea id="componentTextWithBackground<?php echo $key; ?>" name="<?php echo $text['name']; ?>" class="ck-editor"><?php echo $text['value']; ?></textarea>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#componentTextWithBackground<?php echo $key; ?>').summernote(summernote_options);
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
                    height: 250px!important;
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

        <?php }, 99);
        */
    }
}