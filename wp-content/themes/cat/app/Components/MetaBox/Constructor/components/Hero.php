<?php

namespace App\Components\MetaBox\Constructor\components;

class Hero
{
    public $name = 'Без картинки';

    public function html($key, $name, $value)
    {
        $text = [
            'name' => $name . '[' . $key . '][content][text]',
            'value' => isset($value['content']['text']) ? $value['content']['text'] : ''
        ];
        ?>

        <div class="body-block">
            <div class="list-elements-body">
                <div class="row">
                  <div class="col-12">
                      <div class="mb-3">
                          <label class="form-label"><?php _e('Текст'); ?></label>
                          <textarea id="componentHero<?php echo $key; ?>" class="ck-editor" name="<?php echo $text['name']; ?>"><?php echo $text['value']; ?></textarea>
                      </div>
                  </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.ck-editor-ready').summernote({
                    height: 182
                });

                $('#componentHero<?php echo $key; ?>').summernote({
                    height: 200
                });
            });
        </script>

        <?php
    }

    public function handlerStyle()
    {
        add_action('admin_footer', function () { ?>
        <?php });
    }

    public function handlerScript()
    {
        add_action('admin_footer', function () { ?>

            <script type="text/javascript">
                jQuery(document).ready(function($) {

                });
            </script>

        <?php });
    }
}
