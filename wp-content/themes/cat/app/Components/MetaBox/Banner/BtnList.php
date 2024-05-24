<?php

namespace App\Components\MetaBox\Banner;

use App\Core\MetaBox\BaseMetaBox;
use App\Models\Form;

class BtnList extends BaseMetaBox
{
    protected static $placeholder = '#btnlistItemId';

    public function html()
    {
        $formsList = Form::getList();
        ?>
        <div class="form-group form-group-meta-box">
            <label><?php echo $this->label; ?></label>
            <div class="items-container list-items">
                <template>
                    <li data-item-id="<?php echo self::$placeholder; ?>" class="item-template item-list-template">
                        <div class="card border-success" style="width: 100%; padding: 0; min-width: 220px">
                            <div class="card-header" style="display: flex;justify-content: space-between;padding: 0px 0px 0 10px;align-items: center;">
                                <span>Кнопка</span>
                                <a class="btn-card-collapse" data-bs-toggle="collapse" href="#collapseExample<?= self::$placeholder; ?>" role="button" aria-expanded="false" aria-controls="collapseExample<?= self::$placeholder; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M201.4 137.4c12.5-12.5 32.8-12.5 45.3 0l160 160c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L224 205.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l160-160z"/></svg>
                                </a>
                            </div>
                            <div class="card-body collapse" id="collapseExample<?= self::$placeholder; ?>">
                                <div class="row">
                                    <div class="col-12">
                                        <label>Текст на кнопці</label>
                                        <input type="text" style="margin: 5px 0 15px 0;width: 100% !important;" placeholder="Текст" class="form-control form-control-sm" name="<?php echo $this->name; ?>[<?php echo self::$placeholder; ?>][btn_text]" disabled="disabled">
                                        <label>Тип дії</label>
                                        <select style="margin: 5px 0 15px 0" name="<?php echo $this->name; ?>[<?php echo self::$placeholder; ?>][btn__type_link]" class="form-control form-control-sm type_link">
                                            <option value="link">Довільне посилання</option>
                                            <option value="form">Форма</option>
                                        </select>
                                        <input type="text" style="margin: 5px 0 15px 0;width: 100% !important;" placeholder="Посилання" class="form-control form-control-sm type_link_link" name="<?php echo $this->name; ?>[<?php echo self::$placeholder; ?>][btn__link]" disabled="disabled">
                                        <select style="margin: 5px 0 15px 0; display: none" name="<?php echo $this->name; ?>[<?php echo self::$placeholder; ?>][btn__form_id]" class="form-control form-control-sm type_link_form">
                                            <?php foreach ($formsList as $formListKey => $formList) : ?>
                                                <option value="<?= $formListKey ?>"><?= $formList ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                        <label>Колір</label>
                                        <select style="margin: 5px 0 15px 0" name="<?php echo $this->name; ?>[<?php echo self::$placeholder; ?>][btn__color]" class="form-control form-control-sm">
                                            <?php foreach (config('buttons')['color'] as $listKey => $listItem) : ?>
                                                <option value="<?= $listKey ?>"><?= $listItem ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                        <label>Розмір</label>
                                        <select style="margin: 5px 0 15px 0" name="<?php echo $this->name; ?>[<?php echo self::$placeholder; ?>][btn__size]" class="form-control form-control-sm">
                                            <?php foreach (config('buttons')['size'] as $listKey => $listItem) : ?>
                                                <option value="<?= $listKey ?>"><?= $listItem ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                        <label>Тип кнопки</label>
                                        <select style="margin: 5px 0 15px 0" name="<?php echo $this->name; ?>[<?php echo self::$placeholder; ?>][btn__type]" class="form-control form-control-sm">
                                            <?php foreach (config('buttons')['type'] as $listKey => $listItem) : ?>
                                                <option value="<?= $listKey ?>"><?= $listItem ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?= do_shortcode('[icon_select name="' . esc_attr(base64_encode($this->name . "[" . self::$placeholder . "][btn__icon]")) . '"]'); ?>
                                    </div>
                                </div>
                                <button type="button" style="margin-top: 10px;" class="btn btn-danger btn-sm float-end delete-list-element"><?php _e('Delete'); ?></button>
                            </div>
                        </div>
                    </li>
                </template>

                <ul class="items-container" style="display: flex; gap: 15px;flex-wrap: wrap;">
                    <?php foreach ($this->value as $key => $value) : ?>
                        <li data-item-id="<?php echo $key; ?>" class="item-list-template">
                            <div class="card border-success" style="width: 100%; padding: 0; min-width: 220px">
                                <div class="card-header" style="display: flex;justify-content: space-between;padding: 0px 0px 0 10px;align-items: center;">
                                    <span><?php echo $value['btn_text'] ?? ''; ?></span>
                                    <a class="btn-card-collapse" data-bs-toggle="collapse" href="#collapseExample<?=$key?>" role="button" aria-expanded="false" aria-controls="collapseExample<?=$key?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M201.4 137.4c12.5-12.5 32.8-12.5 45.3 0l160 160c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L224 205.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l160-160z"/></svg>
                                    </a>
                                </div>
                                <div class="card-body collapse" id="collapseExample<?=$key?>">
                                    <div class="row">
                                        <div class="col-12">
                                            <label>Текст на кнопці</label>
                                            <input type="text" style="margin: 5px 0 15px 0;width: 100% !important;" placeholder="Текст" class="form-control form-control-sm" name="<?php echo $this->name; ?>[<?php echo $key; ?>][btn_text]" value="<?php echo $value['btn_text'] ?? ''; ?>">
                                            <?php $type_link = $value['btn__type_link'] ?? ''; ?>
                                            <label>Тип дії</label>
                                            <select style="margin:5px 0 15px 0" name="<?php echo $this->name; ?>[<?php echo $key; ?>][btn__type_link]" class="form-control form-control-sm type_link">
                                                <option value="link" <?php if ($type_link == 'link') echo "selected"; ?>>Довільне посилання</option>
                                                <option value="form" <?php if ($type_link == 'form') echo "selected"; ?>>Форма</option>
                                            </select>
                                            <input type="text"
                                                   placeholder="Посилання"
                                                   class="form-control form-control-sm type_link_link"
                                                   name="<?php echo $this->name; ?>[<?php echo $key; ?>][btn__link]"
                                                   style="margin:5px 0 15px 0;width: 100% !important;<?php if ($type_link != 'link') : ?> display: none <?php endif; ?>"
                                                   value="<?= esc_attr($value['btn__link']); ?>">
                                            <?php $form_id = $value['btn__form_id'] ?? ''; ?>
                                            <select
                                                    name="<?php echo $this->name; ?>[<?php echo $key; ?>][btn__form_id]"
                                                    class="form-control form-control-sm type_link_form"
                                                    style="margin:5px 0 15px 0;<?php if ($type_link != 'form') : ?> display: none <?php endif; ?>"
                                            >
                                                <?php foreach ($formsList as $formListKey => $formList) : ?>
                                                    <option value="<?= $formListKey ?>" <?php if ($form_id == $formListKey) echo "selected"; ?>><?= $formList ?></option>
                                                <?php endforeach; ?>
                                            </select>

                                            <?php $btn__color = $value['btn__color'] ?? ''; ?>
                                            <label>Колір</label>
                                            <select style="margin:5px 0 15px 0" name="<?php echo $this->name; ?>[<?php echo $key; ?>][btn__color]" class="form-control form-control-sm">
                                                <?php foreach (config('buttons')['color'] as $listKey => $listItem) : ?>
                                                    <option value="<?= $listKey ?>" <?php if ($btn__color == $listKey) echo "selected"; ?>><?= $listItem ?></option>
                                                <?php endforeach; ?>
                                            </select>

                                            <?php $btn__size = $value['btn__size'] ?? ''; ?>
                                            <label>Розмір</label>
                                            <select style="margin:5px 0 15px 0" name="<?php echo $this->name; ?>[<?php echo $key; ?>][btn__size]" class="form-control form-control-sm">
                                                <?php foreach (config('buttons')['size'] as $listKey => $listItem) : ?>
                                                    <option value="<?= $listKey ?>" <?php if ($btn__size == $listKey) echo "selected"; ?>><?= $listItem ?></option>
                                                <?php endforeach; ?>
                                            </select>

                                            <?php $btn__type = $value['btn__type'] ?? ''; ?>
                                            <label>Тип кнопки</label>
                                            <select style="margin:5px 0 15px 0" name="<?php echo $this->name; ?>[<?php echo $key; ?>][btn__type]" class="form-control form-control-sm">
                                                <?php foreach (config('buttons')['type'] as $listKey => $listItem) : ?>
                                                    <option value="<?= $listKey ?>" <?php if ($btn__type == $listKey) echo "selected"; ?>><?= $listItem ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?= do_shortcode('[icon_select ready="true" icon="' . $value['btn__icon'] . '" name="' . esc_attr(base64_encode($this->name . "[" . $key . "][btn__icon]")) . '"]'); ?>
                                        </div>
                                    </div>
                                    <button type="button" style="margin-top: 10px;" class="btn btn-danger btn-sm float-end delete-list-element"><?php _e('Delete'); ?></button>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <button type="button" class="button button-add add-<?php echo $this->name ?>"><?php _e('Add'); ?></button>
            </div>
        </div>

        <?php add_action('admin_footer', function () { ?>

        <script type="text/javascript">
            jQuery(document).ready(function($) {

                const prefix = '<?php echo $this->name; ?>';
                const placeholder = '<?php echo self::$placeholder; ?>';

                $(document).on('click', '.add-' + prefix, function () {
                    const container = $(this).parents('.items-container');
                    const template = container.find('template')[0];
                    const itemTemplate = $(template.content).find(".item-list-template");
                    const itemsContainer = container.find('.items-container');

                    createItemFromTemplate(container, itemTemplate, itemsContainer, placeholder);

                    itemsContainer.find('input, textarea').each(function () {
                        $(this).prop('disabled', false);
                    });

                    itemsContainer.find('.icon-select-component').each(function () {
                        $(this).select2({
                            templateResult: formatStateIcon,
                            templateSelection: formatStateIcon,
                        });
                    });
                });

                $(document).on('click', '.delete-item', function () {
                    deleteItem($(this));
                });

            });
        </script>

    <?php }, 99);
    }

    public static function beforeOutput($value)
    {
        return empty($value) ? [] : (array) $value;
    }

    public static function beforeSave($value)
    {
        if (isset($value[self::$placeholder])) unset($value[self::$placeholder]);

        return $value;
    }
}