<?php

namespace App\Components\MetaBox\Constructor\components;

class Numbers
{
    public $name = 'Цифри';

    protected static $prefix = 'numbers-item';

    protected static $placeholder = '#numbersElementId';

    public function html($key, $name, $value)
    {
        $font_size_options = [
            'normal' => __('Звичайний'),
            'small' => __('Маленький'),
        ];

        $title_font_size = [
            'name' => $name . '[' . $key . '][content][title_font_size]',
            'value' => isset($value['content']['title_font_size']) ? $value['content']['title_font_size'] : 'normal'
        ];

        $items_in_row_options = [
            '2' => '2',
            '3' => '3',
            '4' => '4',
        ];

        $items_in_row = [
            'name' => $name . '[' . $key . '][content][items_in_row]',
            'value' => isset($value['content']['items_in_row']) ? $value['content']['items_in_row'] : '2'
        ];

        $list = [
            'name' => $name . '[' . $key . '][content][list]',
            'value' => (isset($value['content']['list']) && is_array($value['content']['list'])) ? $value['content']['list'] : []
        ];
        ?>

        <div class="body-block">
            <div class="list-elements-body">
                <div class="mb-3">
                    <label for="title_font_size" class="form-label"><?php _e('Розмір шрифту заголовка '); ?></label>
                    <select name="<?php echo $title_font_size['name']; ?>" class="form-control form-control-sm" id="title_font_size">
                        <?php foreach ($font_size_options as $key => $name) : ?>
                            <option value="<?php echo $key; ?>"<?php echo ($title_font_size['value'] == $key) ? ' selected' : ''; ?>><?php echo $name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="items_in_row" class="form-label"><?php _e('В ряду по '); ?></label>
                    <select name="<?php echo $items_in_row['name']; ?>" class="form-control form-control-sm" id="items_in_row">
                        <?php foreach ($items_in_row_options as $key => $name) : ?>
                            <option value="<?php echo $key; ?>"<?php echo ($items_in_row['value'] == $key) ? ' selected' : ''; ?>><?php echo $name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <template>
                    <li data-item-id="<?php echo self::$placeholder; ?>" class="item-list-template">
                        <div class="card border-success">
                            <div class="card-body">
                                <div class="mb-3">
                                    <input type="text" class="form-control form-control-sm"
                                           name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][number]"
                                            placeholder="<?php _e('Цифра '); ?>"
                                    >
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control form-control-sm"
                                           name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][title]"
                                           placeholder="<?php _e('Заголовок '); ?>"
                                    >
                                </div>
                                <div class="mb-3">
                                    <label>
                                        <?php _e('Розмір шрифту заголовка '); ?>
                                        <select class="form-control" name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][title_font_size]">
                                            <?php foreach ($font_size_options as $key => $name) : ?>
                                                <option value="<?php echo $key; ?>"><?php echo $name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <textarea id="component_<?= uniqid(time()) ?>"
                                              name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][text]"
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
                                        <input type="text" class="form-control form-control-sm"
                                               name="<?php echo $list['name']; ?>[<?php echo $id; ?>][number]"
                                               value="<?= esc_attr($value['number']); ?>"
                                               placeholder="<?php _e('Цифра '); ?>"
                                        >
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control form-control-sm"
                                               name="<?php echo $list['name']; ?>[<?php echo $id; ?>][title]"
                                               value="<?= esc_attr($value['title']); ?>"
                                               placeholder="<?php _e('Заголовок '); ?>"
                                        >
                                    </div>
                                    <div class="mb-3">
                                        <label>
                                            <?php _e('Розмір шрифту заголовка '); ?>
                                            <select class="form-control" name="<?= $list['name']; ?>[<?php echo $id; ?>][title_font_size]">
                                                <?php foreach ($font_size_options as $key => $name) : ?>
                                                    <option value="<?php echo $key; ?>" <?php if($key == $value['title_font_size']):?> selected <?php endif?> ><?php echo $name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <textarea id="component_<?= uniqid(time()) ?>" name="<?= $list['name']; ?>[<?php echo $id; ?>][text]" class="ck-editor-ready"><?= esc_attr($value['text']); ?></textarea>
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
                $('.ck-editor-ready').summernote(summernote_options);
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
                        const template = container.find('template')[0];
                        const itemTemplate = $(template.content).find(".item-list-template");
                        const itemsContainer = container.find('.list-elements-container');

                        createItemFromTemplate(container, itemTemplate, itemsContainer, placeholder);

                        itemsContainer.find('textarea.ck-editor').each(function () {
                            $(this).summernote(summernote_options);
                        });
                    });

                    $(document).on('click', '.delete-list-element', function () {
                        deleteItem($(this));
                    });
                });
            </script>

        <?php });
    }
}
