<?php

namespace App\Components\MetaBox\Constructor\components;

class Stages
{
    public $name = 'Етапи';

    protected static $prefix = 'stages-item';

    protected static $placeholder = '#stagesElementId';

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
                                    <input type="text" class="form-control form-control-sm"
                                           name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][title]">
                                </div>
                                <div class="mb-3">
                                    <textarea id="component_<?= uniqid(time()) ?>"
                                              name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][description]"
                                              class="ck-editor"></textarea>
                                </div>
                                <button type="button"
                                        class="btn btn-danger btn-sm float-end delete-list-element"><?php _e('Delete'); ?></button>
                            </div>
                        </div>
                    </li>
                </template>

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
                        const template = container.find('template')[0];
                        const itemTemplate = $(template.content).find(".item-list-template");
                        const itemsContainer = container.find('.list-elements-container');

                        createItemFromTemplate(container, itemTemplate, itemsContainer, placeholder);

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
