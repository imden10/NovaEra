<?php

namespace App\Components\MetaBox\Constructor\components;

use App\Models\Form;

class CardWithImage
{
    public $name = 'Карточки з картинкой';

    protected static $prefix = 'cardwithimage-item';

    protected static $placeholder = '#cardwithimageElementId';

    public function html($key, $name, $value)
    {
        $list = [
            'name' => $name . '[' . $key . '][content][list]',
            'value' => (isset($value['content']['list']) && is_array($value['content']['list'])) ? $value['content']['list'] : []
        ];

        $formsList = Form::getList();

        $backgroundList = [
            'transparent'  => 'Без фону',
            'on-light' => 'Пресети світлі',
            'on-dark'  => 'Пресети темні',
        ];

        $background_type = [
            'name'  => $name . '[' . $key . '][content][card_background_type]',
            'value' => (isset($value['content']['card_background_type'])) ? $value['content']['card_background_type'] : 'transparent'
        ];

        $background_type_preset_light = [
            'name'  => $name . '[' . $key . '][content][card_on-light]',
            'value' => (isset($value['content']['card_on-light'])) ? $value['content']['card_on-light'] : ''
        ];

        $background_type_preset_dark = [
            'name'  => $name . '[' . $key . '][content][card_on-dark]',
            'value' => (isset($value['content']['card_on-dark'])) ? $value['content']['card_on-dark'] : ''
        ];

        $backgroundListPresetLight = [
            'bg-lighter' => ['title' => 'bg-lighter', 'color' => '#ffffff'],
            'bg-darker'  => ['title' => 'bg-darker', 'color' => '#D9DAD3'],
        ];

        $backgroundListPresetDark = [
            'bg-lighter' => ['title' => 'bg-lighter', 'color' => '#9C9F8B'],
            'bg-darker'  => ['title' => 'bg-darker', 'color' => '#635E78'],
        ];

        $type = [
            'name'  => $name . '[' . $key . '][content][type]',
            'value' => (isset($value['content']['type'])) ? $value['content']['type'] : 'image'
        ];

        $typeList = [
            'image'  => 'З картинкою',
            'icon'   => 'З іконкою',
        ];

        $iconType = [
            'name'  => $name . '[' . $key . '][content][icon_type]',
            'value' => (isset($value['content']['icon_type'])) ? $value['content']['icon_type'] : 'standard'
        ];

        $iconTypeList = [
            'standard' => 'Стандартні',
            'custom'   => 'Кастомні',
        ];
        ?>

        <div class="body-block">
            <div class="list-elements-body">
                <div class="row">
                    <div class="col-3">
                        <label style="margin-bottom: 5px">Колір фону карточок</label>
                        <select name="<?php echo $background_type['name']; ?>" class="form-control select-background-type-mode-card-<?= $key ?>">
                            <?php foreach ($backgroundList as $backgroundListKey => $backgroundListItem) : ?>
                                <option value="<?= $backgroundListKey ?>" <?php if ($backgroundListKey == $background_type['value']) : ?> selected <?php endif; ?>><?= $backgroundListItem ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-3">
                        <div class="theme-block--plight" <?php if ($background_type['value'] != 'on-light') : ?> style="display: none" <?php endif ?>>
                            <label style="margin-bottom: 5px">Пресети світлі</label>
                            <select name="<?php echo $background_type_preset_light['name']; ?>" class="form-control select2-preset" style="width: 250px">
                                <?php foreach ($backgroundListPresetLight as $backgroundListPresetLightKey => $backgroundListPresetLightItem) : ?>
                                    <option value="<?= $backgroundListPresetLightKey ?>" data-color="<?= $backgroundListPresetLightItem['color'] ?>" <?php if ($backgroundListPresetLightKey == $background_type_preset_light['value']) : ?> selected <?php endif; ?>><?= $backgroundListPresetLightItem['title'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="theme-block--pdark" <?php if ($background_type['value'] != 'on-dark') : ?> style="display: none" <?php endif ?>>
                            <label style="margin-bottom: 5px">Пресети темні</label>
                            <select name="<?php echo $background_type_preset_dark['name']; ?>" class="form-control select2-preset" style="width: 250px">
                                <?php foreach ($backgroundListPresetDark as $backgroundListPresetDarkKey => $backgroundListPresetDarkItem) : ?>
                                    <option value="<?= $backgroundListPresetDarkKey ?>" data-color="<?= $backgroundListPresetDarkItem['color'] ?>" <?php if ($backgroundListPresetDarkKey == $background_type_preset_dark['value']) : ?> selected <?php endif; ?>><?= $backgroundListPresetDarkItem['title'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 15px;margin-bottom: 15px">
                    <div class="col-3">
                        <label style="margin-bottom: 5px">Тип карточок</label>
                        <select name="<?php echo $type['name']; ?>" class="form-control select-type-card-val select-type-card-<?= $key ?> <?php if(count($list['value'])):?> disabled-select <?php endif;?>" >
                            <?php foreach ($typeList as $typeListKey => $typeListItem) : ?>
                                <option value="<?= $typeListKey ?>" <?php if ($typeListKey == $type['value']) : ?> selected <?php endif; ?>><?= $typeListItem ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-3 block-icon-type" style="<?php if($type['value'] !== "icon"):?>display: none <?php endif;?>">
                        <label style="margin-bottom: 5px">Іконки</label>
                        <select name="<?php echo $iconType['name']; ?>" class="form-control select-icon-type-card-val">
                            <?php foreach ($iconTypeList as $iconTypeListKey => $iconTypeListItem) : ?>
                                <option value="<?= $iconTypeListKey ?>" <?php if ($iconTypeListKey == $iconType['value']) : ?> selected <?php endif; ?>><?= $iconTypeListItem ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <template>
                    <li data-item-id="<?php echo self::$placeholder; ?>" class="item-list-template">
                        <div class="card border-success">
                            <div class="card-body">
                                <div class="row row-item-card">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Заголовок" class="form-control form-control-sm" name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][title]" disabled="disabled">
                                        </div>
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="text" placeholder="Посилання текст" class="form-control form-control-sm" name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][link_text]" disabled="disabled">
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" placeholder="Посилання URL" class="form-control form-control-sm" name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][link_url]" disabled="disabled">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <textarea id="component_<?= uniqid(time()) ?>" name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][description]" class="ck-editor" disabled="disabled"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-3 type-with-container">
                                        <div class="type-with-image">
                                            <label>Картинка</label>
                                            <?= media_preview_box($list['name'] . "[" . self::$placeholder . "][image]"); ?>
                                        </div>
                                        <div class="type-with-icon">
                                            <label>Іконка</label>
                                            <?= do_shortcode('[icon_select title="false" name="' . esc_attr(base64_encode($list['name'] ."[".self::$placeholder."][icon]" )) . '"]'); ?>
                                        </div>
                                        <div class="type-with-icon-custom">
                                            <label>Іконка</label>
                                            <?= media_preview_box($list['name'] . "[" . self::$placeholder . "][icon_custom]"); ?>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label>Використовувати кнопку</label>
                                        <select style="margin: 5px 0 15px 0" name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][btn__enable]" class="form-control form-control-sm">
                                            <option value="0">Ні</option>
                                            <option value="1">Так</option>
                                        </select>
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
                                <button type="button" class="btn btn-danger btn-sm float-end delete-list-card-element"><?php _e('Delete'); ?></button>
                            </div>
                        </div>
                    </li>
                </template>

                <ul class="list-elements-container">
                    <?php foreach ($list['value'] as $id => $value) : ?>
                        <li data-item-id="<?php echo $id; ?>" class="item-list-template">
                            <div class="card border-success">
                                <div class="card-body">
                                    <div class="row row-item-card">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <input type="text" placeholder="Заголовок" class="form-control form-control-sm" name="<?php echo $list['name']; ?>[<?php echo $id; ?>][title]" value="<?= esc_attr($value['title']); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <input type="text" placeholder="Посилання текст" class="form-control form-control-sm" name="<?php echo $list['name']; ?>[<?php echo $id; ?>][link_text]" value="<?= esc_attr($value['link_text']); ?>">
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="text" placeholder="Посилання URL" class="form-control form-control-sm" name="<?php echo $list['name']; ?>[<?php echo $id; ?>][link_url]" value="<?= esc_attr($value['link_url']); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <textarea id="component_<?= uniqid(time()) ?>" name="<?= $list['name']; ?>[<?php echo $id; ?>][description]" class="ck-editor-ready"><?= esc_attr($value['description']); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="type-with-image" style="<?php if($type['value'] !== "image"):?>display: none <?php endif;?>">
                                                <label>Картинка</label>
                                                <?= media_preview_box($list['name'] . "[" . $id . "][image]",esc_attr($value['image'])); ?>
                                            </div>
                                            <div class="type-with-icon" style="<?php if($type['value'] == "icon" && $iconType['value'] == 'standard'):?> <?php else:?> display: none <?php endif;?>">
                                                <label>Іконка</label>
                                                <?= do_shortcode('[icon_select title="false" ready="true" icon="' . $value['icon'] . '" name="' . esc_attr(base64_encode($list['name'] . "[" . $id . "][icon]")) . '"]'); ?>
                                            </div>
                                            <div class="type-with-icon-custom" style="<?php if($type['value'] == "icon" && $iconType['value'] == 'custom'):?> <?php else:?> display: none <?php endif;?>">
                                                <label>Іконка</label>
                                                <?= media_preview_box($list['name'] . "[" . $id . "][icon_custom]",esc_attr($value['icon_custom'])); ?>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <label style="margin: 5px 0 15px 0">Використовувати кнопку</label>
                                            <?php $btn_enable = $value['btn__enable'] ?? '0'; ?>
                                            <select style="margin: 5px 0 15px 0" name="<?= $list['name']; ?>[<?php echo $id; ?>][btn__enable]" class="form-control form-control-sm">
                                                <option value="0" <?php if ($btn_enable == '0') echo "selected"; ?>>Ні</option>
                                                <option value="1" <?php if ($btn_enable == '1') echo "selected"; ?>>Так</option>
                                            </select>
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

                                    <button type="button" class="btn btn-danger btn-sm float-end delete-list-card-element"><?php _e('Delete'); ?></button>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <button type="button" data-count_items="<?= count($list['value']) ?>" class="btn-add-item btn btn-success btn-sm add-<?php echo self::$prefix; ?>"><?php _e('Add'); ?></button>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $(document).on('change', '.select-background-type-mode-card-<?= $key ?>', function() {
                    let mode = $(this).val();
                    let $wrapper = $(this).closest('.list-elements-body');

                    switch (mode) {
                        case 'on-light':
                            $wrapper.find('.theme-block--plight').show();
                            $wrapper.find('.theme-block--pdark').hide();
                            $wrapper.find('.theme-block--image').hide();
                            break;
                        case 'on-dark':
                            $wrapper.find('.theme-block--plight').hide();
                            $wrapper.find('.theme-block--pdark').show();
                            $wrapper.find('.theme-block--image').hide();
                            break;
                        case 'image':
                            $wrapper.find('.theme-block--plight').hide();
                            $wrapper.find('.theme-block--pdark').hide();
                            $wrapper.find('.theme-block--image').show();
                            break;
                        default:
                            $wrapper.find('.theme-block--plight').hide();
                            $wrapper.find('.theme-block--pdark').hide();
                            $wrapper.find('.theme-block--image').hide();
                            break;
                    }
                });

                $(document).on('change', '.select-type-card-<?= $key ?>', function() {
                    let mode = $(this).val();
                    let $wrapper = $(this).closest('.list-elements-body');

                    switch (mode) {
                        case 'image':
                            $wrapper.find('.block-icon-type').hide();
                            break;
                        case 'icon':
                            $wrapper.find('.block-icon-type').show();
                            break;
                        default:
                            $wrapper.find('.block-icon-type').hide();
                            break;
                    }
                });
            });
        </script>

        <?php
    }

    public function handlerStyle()
    {
        add_action('admin_footer', function () { ?>

            <style>
                .disabled-select {
                    background-color: #f0f0f0;
                    color: #999999;
                    pointer-events: none;
                    cursor: not-allowed;
                }
            </style>

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

                        let count_items = $(this).data('count_items');

                        createItemFromTemplate(container, itemTemplate, itemsContainer, placeholder);

                        itemsContainer.find('input, textarea').each(function () {
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

                        let type = container.find('.select-type-card-val').val();
                        let iconType = container.find('.select-icon-type-card-val').val();

                        switch (type) {
                            case 'image':
                                container.find('.type-with-container .type-with-image').show();
                                container.find('.type-with-container .type-with-icon').hide();
                                container.find('.type-with-container .type-with-icon-custom').hide();
                                break;
                            case 'icon':
                                if(iconType == "standard"){
                                    container.find('.type-with-container .type-with-image').hide();
                                    container.find('.type-with-container .type-with-icon').show();
                                    container.find('.type-with-container .type-with-icon-custom').hide();
                                } else if(iconType == "custom") {
                                    container.find('.type-with-container .type-with-image').hide();
                                    container.find('.type-with-container .type-with-icon').hide();
                                    container.find('.type-with-container .type-with-icon-custom').show();
                                }
                                break;
                            default:
                                container.find('.type-with-container .type-with-image').hide();
                                container.find('.type-with-container .type-with-icon').hide();
                                container.find('.type-with-container .type-with-icon-custom').hide();
                                break;
                        }

                        count_items++;
                        $(this).data('count_items',count_items);

                        if(count_items > 0){
                            container.find(".select-type-card-val").addClass('disabled-select');
                        }
                    });

                    $(document).on('click', '.delete-list-card-element', function () {
                        let container = $(this).closest('.list-elements-body');
                        let count_items = $(this).closest('ul').find('li').length;

                        if(count_items == 1){
                            container.find(".select-type-card-val").removeClass('disabled-select');
                        }

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
