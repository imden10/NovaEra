<?php

namespace App\Components\MetaBox\Constructor\components;

class Accordion
{
    public $name = 'Акордеон';

    protected static $prefix = 'accordion-item';

    protected static $placeholder = '#accordionElementId';

    protected static $defaultImage = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkAQMAAABKLAcXAAAABlBMVEUAAAC7u7s37rVJAAAAAXRSTlMAQObYZgAAACJJREFUOMtjGAV0BvL/G0YMr/4/CDwY0rzBFJ704o0CWgMAvyaRh+c6m54AAAAASUVORK5CYII=';


    public function html($key, $name, $value)
    {
        $content_position_options = [
            'left' => __('Ліворуч'),
            'center' => __('По центру'),
            'right' => __('Праворуч'),
        ];
        $content_position = [
            'name' => $name . '[' . $key . '][content][content_position]',
            'value' => isset($value['content']['content_position']) ? $value['content']['content_position'] : 'left'
        ];

        $type_options = [
            'numerical' => __('З нумерацією'),
            'default' => __('Без нумерації'),
        ];
        $type = [
            'name' => $name . '[' . $key . '][content][type]',
            'value' => isset($value['content']['type']) ? $value['content']['type'] : 'default'
        ];

        $list = [
            'name' => $name . '[' . $key . '][content][list]',
            'value' => (isset($value['content']['list']) && is_array($value['content']['list'])) ? $value['content']['list'] : []
        ];

        $image_id = [
            'name' => $name . '[' . $key . '][content][image][id]',
            'value' => isset($value['content']['image']['id']) ? $value['content']['image']['id'] : '0'
        ];

        $icon = [
            'name' => $name . '[' . $key . '][content][icon]',
            'value' => isset($value['content']['icon']) ? $value['content']['icon'] : ''
        ];
        ?>

        <div class="body-block">
            <div class="list-elements-body">
                <div class="mb-3">
                    <label for="content_position_component" class="form-label"><?php _e('Позиція контенту '); ?></label>
                    <select name="<?php echo $content_position['name']; ?>" class="form-control form-control-sm" id="content_position_component">
                        <?php foreach ($content_position_options as $key => $name) : ?>
                            <option value="<?php echo $key; ?>"<?php echo ($content_position['value'] == $key) ? ' selected' : ''; ?>><?php echo $name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="content_position_component" class="form-label"><?php _e('Тип '); ?></label>
                    <select name="<?php echo $type['name']; ?>" class="form-control form-control-sm" id="content_position_component">
                        <?php foreach ($type_options as $key => $name) : ?>
                            <option value="<?php echo $key; ?>"<?php echo ($type['value'] == $key) ? ' selected' : ''; ?>><?php echo $name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <?= media_preview_box($image_id['name'],$image_id['value'], "Зображення"); ?>

                <div style="display: none">
                    <li data-item-id="<?php echo self::$placeholder; ?>" class="item-list-template">
                        <div class="card border-success">
                            <div class="card-body">
                                <div class="mb-3">
                                    <input type="text" class="form-control form-control-sm" name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][title]" disabled="disabled">
                                </div>
                                <div class="mb-3">
                                    <textarea id="component_<?= uniqid(time()) ?>" name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][description]" class="ck-editor" disabled="disabled"></textarea>
                                </div>
                                <button type="button" class="btn btn-danger btn-sm float-end delete-list-element"><?php _e('Delete'); ?></button>
                            </div>
                        </div>
                    </li>
                </div>

                <ul class="list-elements-container">
                    <?php foreach ($list['value'] as $id => $value) : ?>
                        <li data-item-id="<?php echo $id; ?>" class="item-list-template">
                            <div class="card border-success">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <input type="text" class="form-control form-control-sm" name="<?php echo $list['name']; ?>[<?php echo $id; ?>][title]" value="<?= esc_attr($value['title']); ?>">
                                    </div>
                                    <div class="mb-3">
                                        <textarea id="component_<?= uniqid(time()) ?>" name="<?= $list['name']; ?>[<?php echo $id; ?>][description]" class="ck-editor-ready"><?= esc_attr($value['description']); ?></textarea>
                                    </div>
                                    <button type="button" class="btn btn-danger btn-sm float-end delete-list-element"><?php _e('Delete'); ?></button>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <button type="button" class="btn btn-success btn-sm add-<?php echo self::$prefix; ?>"><?php _e('Add'); ?></button>
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
                        console.log(this)
                        const container = $(this).parents('.list-elements-body');
                        const itemTemplate = container.find('.item-list-template');
                        const itemsContainer = container.find('.list-elements-container');

                        createItem(container, itemTemplate, itemsContainer, placeholder);

                        itemsContainer.find('input, textarea').each(function () {
                            $(this).prop('disabled', false);
                        });

                        itemsContainer.find('textarea.ck-editor').each(function () {
                            $(this).summernote({
                                height: 182
                            });
                        });
                    });

                    $(document).on('click', '.delete-list-element', function () {
                        deleteItem($(this));
                    });

                    $(document).on('click', '.delete-image', function () {
                        removeImage($(this));
                    });
                });
            </script>

        <?php });
    }
}
