<?php

namespace App\Components\MetaBox\Constructor\components;

class Images3
{
    public $name = '3 картинки в рядок';

    protected static $prefix = 'images-3';

    protected static $placeholder = '#imagesElementId';

    protected static $defaultImage = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkAQMAAABKLAcXAAAABlBMVEUAAAC7u7s37rVJAAAAAXRSTlMAQObYZgAAACJJREFUOMtjGAV0BvL/G0YMr/4/CDwY0rzBFJ704o0CWgMAvyaRh+c6m54AAAAASUVORK5CYII=';


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

        $title_font_size = [
            'name' => $name . '[' . $key . '][content][title_font_size]',
            'value' => isset($value['content']['title_font_size']) ? $value['content']['title_font_size'] : 'normal'
        ];

        $list = [
            'name' => $name . '[' . $key . '][content][list]',
            'value' => (isset($value['content']['list']) && is_array($value['content']['list'])) ? $value['content']['list'] : []
        ];
        ?>

        <div class="body-block">
            <div class="list-elements-body" data-count="<?= count($list['value']) ?>">
                <div class="mb-3">
                    <label for="title_font_size" class="form-label"><?php _e('Розмір шрифту заголовка '); ?></label>
                    <select name="<?php echo $title_font_size['name']; ?>" class="form-control form-control-sm" id="title_font_size">
                        <?php foreach ($font_size_options as $key => $name) : ?>
                            <option value="<?php echo $key; ?>"<?php echo ($title_font_size['value'] == $key) ? ' selected' : ''; ?>><?php echo $name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="font_size" class="form-label"><?php _e('Розмір шрифту '); ?></label>
                    <select name="<?php echo $font_size['name']; ?>" class="form-control form-control-sm" id="font_size">
                        <?php foreach ($font_size_options as $key => $name) : ?>
                            <option value="<?php echo $key; ?>"<?php echo ($font_size['value'] == $key) ? ' selected' : ''; ?>><?php echo $name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <template>
                    <li data-item-id="<?php echo self::$placeholder; ?>" class="item-list-template">
                        <div class="card border-success">
                            <div class="card-body">
                                <div class="mb-3">
                                    <?= media_preview_box($list['name'] . "[" . self::$placeholder . "][image]"); ?>
                                </div>
                                <button type="button" class="btn btn-danger btn-sm float-end delete-list-element-<?php echo self::$prefix; ?>"><?php _e('Delete'); ?></button>
                            </div>
                        </div>
                    </li>
                </template>

                <ul class="list-elements-container">
                    <?php foreach ($list['value'] as $id => $value) : ?>
                        <li data-item-id="<?php echo $id; ?>" class="item-list-template">
                            <div class="card border-success">
                                <div class="card-body">
                                    <div class="mb-3" data-val="<?= esc_attr($value['image']) ?>">
                                        <?= media_preview_box($list['name'] . "[" . $id . "][image]",esc_attr($value['image'])); ?>
                                    </div>
                                    <button type="button" class="btn btn-danger btn-sm float-end delete-list-element-<?php echo self::$prefix; ?>"><?php _e('Delete'); ?></button>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <button type="button" style="<?php if(count($list['value']) == 3):?> display: none <?php endif?>" class="btn btn-success btn-sm add-<?php echo self::$prefix; ?>"><?php _e('Add'); ?></button>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.ck-editor-ready').summernote({
                    height: 182
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
                    const prefix = '<?php echo self::$prefix; ?>';
                    const placeholder = '<?php echo self::$placeholder; ?>';

                    $(document).on('click', '.add-' + prefix, function () {
                        const container = $(this).parents('.list-elements-body');
                        let countBlock = container.data('count');
                        const template = container.find('template')[0];
                        const itemTemplate = $(template.content).find(".item-list-template");
                        const itemsContainer = container.find('.list-elements-container');

                        createItemFromTemplate(container, itemTemplate, itemsContainer, placeholder);
                        countBlock++;
                        container.data('count',countBlock);

                        if(countBlock == 3){
                            $(this).hide();
                        }
                    });

                    $(document).on('click', '.delete-list-element-' + prefix, function () {
                        let container = $(this).closest('.list-elements-body');
                        let countBlock = container.data('count');
                        let addBtn = container.find('.add-' + prefix);

                        deleteItem($(this));
                        countBlock--;
                        container.data('count',countBlock);

                        if(countBlock >= 3){
                            addBtn.hide();
                        } else {
                            addBtn.show();
                        }
                    });

                    $(document).on('click', '.delete-image', function () {
                        removeImage($(this));
                    });

                    $("#post").on('submit',function (e){
                       // e.preventDefault();
                    });
                });
            </script>

        <?php });
    }
}
