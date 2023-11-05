<?php

namespace App\Components\MetaBox\Constructor\components;

class LinkList
{
    public $name = 'Посилання';

    protected static $prefix = 'linklist-item';

    protected static $placeholder = '#linklistElementId';

    public function html($key, $name, $value)
    {
        $type_options = [
            'list' => __('Список'),
            'tags' => __('Тегами'),
        ];

        $type = [
            'name' => $name . '[' . $key . '][content][type]',
            'value' => isset($value['content']['type']) ? $value['content']['type'] : 'normal'
        ];

        $file_btn_name = [
            'name' => $name . '[' . $key . '][content][file_btn_name]',
            'value' => isset($value['content']['file_btn_name']) ? $value['content']['file_btn_name'] : ''
        ];

        $link_btn_name = [
            'name' => $name . '[' . $key . '][content][link_btn_name]',
            'value' => isset($value['content']['link_btn_name']) ? $value['content']['link_btn_name'] : ''
        ];

        $list = [
            'name' => $name . '[' . $key . '][content][list]',
            'value' => (isset($value['content']['list']) && is_array($value['content']['list'])) ? $value['content']['list'] : []
        ];
        ?>

        <div class="body-block">
            <div class="list-elements-body">
                <div class="mb-3">
                    <label for="type" class="form-label"><?php _e('Вид '); ?></label>
                    <select name="<?php echo $type['name']; ?>" class="form-control form-control-sm" id="type">
                        <?php foreach ($type_options as $key => $name) : ?>
                            <option value="<?php echo $key; ?>"<?php echo ($type['value'] == $key) ? ' selected' : ''; ?>><?php echo $name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="file_btn_name" class="form-label"><?php _e('Напис на кнопці завантаження '); ?></label>
                    <input type="text" name="<?= $file_btn_name['name']; ?>" value="<?= $file_btn_name['value'] ?? '' ?>" class="form-control form-control-sm"  id="file_btn_name">
                </div>

                <div class="mb-3">
                    <label for="link_btn_name" class="form-label"><?php _e('Назва для переходу по посиланню '); ?></label>
                    <input type="text" name="<?= $link_btn_name['name']; ?>" value="<?= $link_btn_name['value'] ?? '' ?>" class="form-control form-control-sm"  id="link_btn_name">
                </div>

                <template>
                    <li data-item-id="<?php echo self::$placeholder; ?>" class="item-list-template">
                        <div class="card border-success">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <label>Файл</label>
                                        <?= media_preview_box($list['name'] . "[" . self::$placeholder . "][file]"); ?>
                                    </div>
                                    <div class="col-3">
                                        <label>Іконка</label>
                                        <?= media_preview_box($list['name'] . "[" . self::$placeholder . "][icon]"); ?>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-sm"
                                                   name="<?= $list['name']; ?>[<?= self::$placeholder; ?>][name]"
                                                   placeholder="<?php _e('Назва '); ?>"
                                            >
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-sm"
                                                   name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][link]"
                                                   placeholder="<?php _e('Посилання'); ?>"
                                            >
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-sm"
                                                   name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][date]"
                                                   placeholder="<?php _e('Дата'); ?>"
                                            >
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" min="0" step="1" class="form-control form-control-sm"
                                                   name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][order]"
                                                   placeholder="<?php _e('Сортування'); ?>"
                                            >
                                        </div>
                                        <button type="button"
                                                class="btn btn-danger btn-sm float-end delete-list-element"><?php _e('Delete'); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </template>

                <ul class="list-elements-container">
                    <?php foreach ($list['value'] as $id => $value) : ?>
                        <li data-item-id="<?php echo $id; ?>" class="item-list-template">
                            <div class="card border-success">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <label>Файл</label>
                                            <?= media_preview_box($list['name'] . "[" . $id . "][file]",esc_attr($value['file'])); ?>
                                        </div>
                                        <div class="col-3">
                                            <label>Іконка</label>
                                            <?= media_preview_box($list['name'] . "[" . $id . "][icon]",esc_attr($value['icon'])); ?>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <input type="text" class="form-control form-control-sm"
                                                       name="<?php echo $list['name']; ?>[<?php echo $id; ?>][name]"
                                                       value="<?= esc_attr($value['name']); ?>"
                                                       placeholder="<?php _e('Назва '); ?>"
                                                >
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" class="form-control form-control-sm"
                                                       name="<?php echo $list['name']; ?>[<?php echo $id; ?>][link]"
                                                       value="<?= esc_attr($value['link']); ?>"
                                                       placeholder="<?php _e('Посилання'); ?>"
                                                >
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" class="form-control form-control-sm"
                                                       name="<?php echo $list['name']; ?>[<?php echo $id; ?>][date]"
                                                       value="<?= esc_attr($value['date']); ?>"
                                                       placeholder="<?php _e('Дата'); ?>"
                                                >
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" class="form-control form-control-sm"
                                                       name="<?php echo $list['name']; ?>[<?php echo $id; ?>][order]"
                                                       value="<?= esc_attr($value['order']); ?>"
                                                       placeholder="<?php _e('Сортування'); ?>"
                                                >
                                            </div>
                                            <button type="button" class="btn btn-danger btn-sm float-end delete-list-element"><?php _e('Delete'); ?></button>
                                        </div>
                                    </div>
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
                    });

                    $(document).on('click', '.delete-list-element', function () {
                        deleteItem($(this));
                    });
                });
            </script>

        <?php });
    }
}
