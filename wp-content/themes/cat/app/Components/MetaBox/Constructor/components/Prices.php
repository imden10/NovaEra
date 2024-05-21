<?php

namespace App\Components\MetaBox\Constructor\components;

use App\Models\Form;

class Prices
{
    public $name = 'Ціни';

    protected static $prefix = 'price-item';

    protected static $placeholder = '#priceElementId';

    public function html($key, $name, $value)
    {
        $price_color_options = [
            'blue' => __('Синій'),
            'green' => __('Зелений'),
            'black' => __('Чорний'),
        ];

        $list = [
            'name' => $name . '[' . $key . '][content][list]',
            'value' => (isset($value['content']['list']) && is_array($value['content']['list'])) ? $value['content']['list'] : []
        ];

        $formsList = Form::getList();
        ?>

        <div class="body-block">
            <div class="list-elements-body">
                <template>
                    <li data-item-id="<?php echo self::$placeholder; ?>" class="item-list-template">
                        <div class="card border-success">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="mb-3">
                                            <label>Заголовок</label>
                                            <input type="text" class="form-control form-control-sm" name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][title]" disabled="disabled">
                                        </div>
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label>Ціна</label>
                                                        <input type="text" class="form-control form-control-sm" name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][price_title]" disabled="disabled">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label>Колір</label>
                                                        <select name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][price_color]" class="form-control form-control-sm" disabled="disabled">
                                                            <?php foreach ($price_color_options as $keyColorOption => $itemColorOption ):?>
                                                                <option value="<?= $keyColorOption?>"><?= $itemColorOption?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <textarea id="component_<?= uniqid(time()) ?>" name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][description]" class="ck-editor" disabled="disabled"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <h4>Налаштування кнопки</h4>
                                        <label>Текст на кнопці</label>
                                        <input type="text" style="margin: 5px 0 15px 0" placeholder="Текст" class="form-control form-control-sm" name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][btn__text]" disabled="disabled">
                                        <label>Тип дії</label>
                                        <select style="margin: 5px 0 15px 0" name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][btn__type_link]" class="form-control form-control-sm type_link">
                                            <option value="link">Довільне посилання</option>
                                            <option value="form">Форма</option>
                                        </select>
                                        <input type="text" style="margin: 5px 0 15px 0" placeholder="Посилання" class="form-control form-control-sm type_link_link" name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][btn__link]" disabled="disabled">
                                        <select style="margin: 5px 0 15px 0; display: none" name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][btn__form_id]" class="form-control form-control-sm type_link_form">
                                            <?php foreach ($formsList as $formListKey => $formList) : ?>
                                                <option value="<?= $formListKey ?>"><?= $formList ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                        <label>Колір</label>
                                        <select style="margin: 5px 0 15px 0" name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][btn__color]" class="form-control form-control-sm">
                                            <?php foreach (config('buttons')['color'] as $listKey => $listItem) : ?>
                                                <option value="<?= $listKey ?>"><?= $listItem ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                        <label>Розмір</label>
                                        <select style="margin: 5px 0 15px 0" name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][btn__size]" class="form-control form-control-sm">
                                            <?php foreach (config('buttons')['size'] as $listKey => $listItem) : ?>
                                                <option value="<?= $listKey ?>"><?= $listItem ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                        <label>Тип кнопки</label>
                                        <select style="margin: 5px 0 15px 0" name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][btn__type]" class="form-control form-control-sm">
                                            <?php foreach (config('buttons')['type'] as $listKey => $listItem) : ?>
                                                <option value="<?= $listKey ?>"><?= $listItem ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?= do_shortcode('[icon_select name="' . esc_attr(base64_encode($list['name'] . "[" . self::$placeholder . "][btn__icon]")) . '"]'); ?>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger btn-sm float-end delete-list-element"><?php _e('Delete'); ?></button>
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
                                        <div class="col-9">
                                            <div class="mb-3">
                                                <input type="text" class="form-control form-control-sm" name="<?php echo $list['name']; ?>[<?php echo $id; ?>][title]" value="<?= esc_attr($value['title']); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label>Ціна</label>
                                                            <input type="text" class="form-control form-control-sm" name="<?php echo $list['name']; ?>[<?php echo $id; ?>][price_title]" value="<?= esc_attr($value['price_title']); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label>Колір</label>
                                                            <?php $price_color_val = esc_attr($value['price_color']); ?>
                                                            <select name="<?php echo $list['name']; ?>[<?php echo $id; ?>][price_color]" class="form-control form-control-sm">
                                                                <?php foreach ($price_color_options as $keyColorOption => $itemColorOption ):?>
                                                                    <option value="<?= $keyColorOption?>" <?php if($price_color_val == $keyColorOption):?> selected <?php endif;?> ><?= $itemColorOption?></option>
                                                                <?php endforeach;?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <textarea id="component_<?= uniqid(time()) ?>" name="<?= $list['name']; ?>[<?php echo $id; ?>][description]" class="ck-editor-ready"><?= esc_attr($value['description']); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <h4>Налаштування кнопки</h4>
                                            <label>Текст на кнопці</label>
                                            <input style="margin: 5px 0 15px 0" type="text" placeholder="Текст" class="form-control form-control-sm" name="<?php echo $list['name']; ?>[<?php echo $id; ?>][btn__text]" value="<?= esc_attr($value['btn__text']); ?>">
                                            <?php $type_link = $value['btn__type_link'] ?? ''; ?>
                                            <label>Тип дії</label>
                                            <select style="margin:5px 0 15px 0" name="<?php echo $list['name']; ?>[<?php echo $id; ?>][btn__type_link]" class="form-control form-control-sm type_link">
                                                <option value="link" <?php if ($type_link == 'link') echo "selected"; ?>>Довільне посилання</option>
                                                <option value="form" <?php if ($type_link == 'form') echo "selected"; ?>>Форма</option>
                                            </select>
                                            <input type="text"
                                                   placeholder="Посилання"
                                                   class="form-control form-control-sm type_link_link"
                                                   name="<?php echo $list['name']; ?>[<?php echo $id; ?>][btn__link]"
                                                   style="margin:5px 0 15px 0;<?php if ($type_link != 'link') : ?> display: none <?php endif; ?>"
                                                   value="<?= esc_attr($value['btn__link']); ?>">
                                            <?php $form_id = $value['btn__form_id'] ?? ''; ?>
                                            <select
                                                    name="<?php echo $list['name']; ?>[<?php echo $id; ?>][btn__form_id]"
                                                    class="form-control form-control-sm type_link_form"
                                                    style="margin:5px 0 15px 0;<?php if ($type_link != 'form') : ?> display: none <?php endif; ?>"
                                            >
                                                <?php foreach ($formsList as $formListKey => $formList) : ?>
                                                    <option value="<?= $formListKey ?>" <?php if ($form_id == $formListKey) echo "selected"; ?>><?= $formList ?></option>
                                                <?php endforeach; ?>
                                            </select>

                                            <?php $btn__color = $value['btn__color'] ?? ''; ?>
                                            <label>Колір</label>
                                            <select style="margin:5px 0 15px 0" name="<?php echo $list['name']; ?>[<?php echo $id; ?>][btn__color]" class="form-control form-control-sm">
                                                <?php foreach (config('buttons')['color'] as $listKey => $listItem) : ?>
                                                    <option value="<?= $listKey ?>" <?php if ($btn__color == $listKey) echo "selected"; ?>><?= $listItem ?></option>
                                                <?php endforeach; ?>
                                            </select>

                                            <?php $btn__size = $value['btn__size'] ?? ''; ?>
                                            <label>Розмір</label>
                                            <select style="margin:5px 0 15px 0" name="<?php echo $list['name']; ?>[<?php echo $id; ?>][btn__size]" class="form-control form-control-sm">
                                                <?php foreach (config('buttons')['size'] as $listKey => $listItem) : ?>
                                                    <option value="<?= $listKey ?>" <?php if ($btn__size == $listKey) echo "selected"; ?>><?= $listItem ?></option>
                                                <?php endforeach; ?>
                                            </select>

                                            <?php $btn__type = $value['btn__type'] ?? ''; ?>
                                            <label>Тип кнопки</label>
                                            <select style="margin:5px 0 15px 0" name="<?php echo $list['name']; ?>[<?php echo $id; ?>][btn__type]" class="form-control form-control-sm">
                                                <?php foreach (config('buttons')['type'] as $listKey => $listItem) : ?>
                                                    <option value="<?= $listKey ?>" <?php if ($btn__type == $listKey) echo "selected"; ?>><?= $listItem ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?= do_shortcode('[icon_select ready="true" icon="' . $value['btn__icon'] . '" name="' . esc_attr(base64_encode($list['name'] . "[" . $id . "][btn__icon]")) . '"]'); ?>
                                        </div>
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

                        itemsContainer.find('input, textarea, select').each(function () {
                            $(this).prop('disabled', false);
                        });

                        itemsContainer.find('textarea.ck-editor').each(function () {
                            $(this).summernote(summernote_options);
                        });

                        itemsContainer.find('.icon-select-component').each(function () {
                            $(this).select2({
                                templateResult: formatStateIcon,
                                templateSelection: formatStateIcon,
                            });
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
