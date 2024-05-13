<?php

namespace App\Components\MetaBox\Constructor\components;

class Hero30Grid
{
    public $name = 'Картинка на 30% сітки';

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

        $imageTypeList = [
            'square' => __('Квадратна'),
            'circle' => __('Кругла'),
        ];
        $imageType = [
            'name' => $name . '[' . $key . '][content][image_type]',
            'value' => isset($value['content']['image_type']) ? $value['content']['image_type'] : 'square'
        ];
        ?>

        <div class="body-block">
            <div class="list-elements-body">
                <div class="row">
                  <div class="col-9">
                      <div class="mb-3">
                          <label class="form-label"><?php _e('Текст'); ?></label>
                          <textarea id="componentHero30Grid<?php echo $key; ?>" class="ck-editor" name="<?php echo $text['name']; ?>"><?php echo $text['value']; ?></textarea>
                      </div>
                  </div>
                  <div class="col-3">
                      <div class="mb-3">
                          <?= media_preview_box($image_id['name'],$image_id['value'], "Зображення"); ?>
                      </div>
                      <div class="mb-3">
                          <label class="form-label"><?php _e('Тип зображення'); ?></label>
                          <select name="<?php echo $imageType['name']; ?>" class="form-control form-control-sm">
                              <?php foreach ($imageTypeList as $imageTypeListKey => $imageTypeListItem) : ?>
                                  <option value="<?php echo $imageTypeListKey; ?>"<?php echo ($imageType['value'] == $imageTypeListKey) ? ' selected' : ''; ?>><?php echo $imageTypeListItem; ?></option>
                              <?php endforeach; ?>
                          </select>
                      </div>
                  </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.ck-editor-ready').summernote(summernote_options);

                $('#componentHero30Grid<?php echo $key; ?>').summernote(summernote_options);
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
