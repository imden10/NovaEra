<?php

namespace App\Components\MetaBox\Constructor\components;

class Hero50Screen
{
    public $name = 'Картинка на 50% екрану';

    public function html($key, $name, $value)
    {
        $image_id = [
            'name' => $name . '[' . $key . '][content][image][id]',
            'value' => isset($value['content']['image']['id']) ? $value['content']['image']['id'] : '0'
        ];

        $text = [
            'name' => $name . '[' . $key . '][content][text]',
            'value' => isset($value['content']['text']) ? $value['content']['text'] : ''
        ];
        ?>

        <div class="body-block">
            <div class="list-elements-body">
                <div class="row">
                  <div class="col-9">
                      <div class="mb-3">
                          <label class="form-label"><?php _e('Текст'); ?></label>
                          <textarea id="componentHero50Screen<?php echo $key; ?>" class="ck-editor" name="<?php echo $text['name']; ?>"><?php echo $text['value']; ?></textarea>
                      </div>
                  </div>
                  <div class="col-3">
                      <div class="mb-3">
                          <?= media_preview_box($image_id['name'],$image_id['value'], "Зображення"); ?>
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

                $('#componentHero50Screen<?php echo $key; ?>').summernote({
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
                    $(document).on('click', '.delete-image', function () {
                        removeImage($(this));
                    });
                });
            </script>

        <?php });
    }
}
