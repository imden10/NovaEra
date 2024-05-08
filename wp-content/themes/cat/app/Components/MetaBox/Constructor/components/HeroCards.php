<?php

namespace App\Components\MetaBox\Constructor\components;

class HeroCards
{
    public $name = 'Картки';

    protected static $prefix = 'herocard-item';

    protected static $placeholder = '#herocardElementId';

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

        $list = [
            'name' => $name . '[' . $key . '][content][list]',
            'value' => (isset($value['content']['list']) && is_array($value['content']['list'])) ? $value['content']['list'] : []
        ];

        $iconTypeList = [
            'standard' => 'Стандартна',
            'custom'   => 'Кастомна',
        ];
        ?>

        <div class="body-block">
            <div class="list-elements-body">
                <div class="row">
                  <div class="col-9">
                      <div class="mb-3">
                          <label class="form-label"><?php _e('Текст'); ?></label>
                          <textarea id="componentHero50Grid<?php echo $key; ?>" class="ck-editor" name="<?php echo $text['name']; ?>"><?php echo $text['value']; ?></textarea>
                      </div>
                  </div>
                  <div class="col-3">
                      <div class="mb-3">
                          <?= media_preview_box($image_id['name'],$image_id['value'], "Зображення"); ?>
                      </div>
                  </div>
                </div>

                <template>
                    <li data-item-id="<?php echo self::$placeholder; ?>" class="item-list-template">
                        <div class="card border-success">
                            <div class="card-body">
                                <div class="row row-item-card">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label>Заголовок</label>
                                            <input type="text" placeholder="Заголовок" class="form-control form-control-sm" name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][title]" disabled="disabled">
                                        </div>
                                        <div class="mb-3">
                                            <label>Посилання</label>
                                            <input type="text" placeholder="Посилання" class="form-control form-control-sm" name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][link]" disabled="disabled">
                                        </div>
                                        <div class="mb-3">
                                            <label>Тип іконки</label>
                                            <select name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][icon_type]" disabled="disabled" class="form-control icon_type_select">
                                                <?php foreach ($iconTypeList as $iconTypeListKey => $iconTypeListItem) : ?>
                                                    <option value="<?= $iconTypeListKey ?>"><?= $iconTypeListItem ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="type-with-container" style="width: 100%">
                                            <div class="type-with-icon">
                                                <label>Іконка</label>
                                                <?= do_shortcode('[icon_select title="false" name="' . esc_attr(base64_encode($list['name'] ."[".self::$placeholder."][icon]" )) . '"]'); ?>
                                            </div>
                                            <div class="type-with-icon-custom" style="display: none">
                                                <label>Іконка</label>
                                                <?= media_preview_box($list['name'] . "[" . self::$placeholder . "][icon_custom]"); ?>
                                            </div>
                                        </div>
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
                                                <label>Заголовок</label>
                                                <input type="text" placeholder="Заголовок" class="form-control form-control-sm" name="<?php echo $list['name']; ?>[<?php echo $id; ?>][title]" value="<?= esc_attr($value['title']); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label>Посилання</label>
                                                <input type="text" placeholder="Посилання" class="form-control form-control-sm" name="<?php echo $list['name']; ?>[<?php echo $id; ?>][link]" value="<?= esc_attr($value['link']); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label>Тип іконки</label>
                                                <select name="<?php echo $list['name']; ?>[<?php echo $id; ?>][icon_type]"  class="form-control icon_type_select">
                                                    <?php foreach ($iconTypeList as $iconTypeListKey => $iconTypeListItem) : ?>
                                                        <option value="<?= $iconTypeListKey ?>" <?php if ($iconTypeListKey == $value['icon_type']) : ?> selected <?php endif; ?>><?= $iconTypeListItem ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="type-with-container" style="width: 100%">
                                                <div class="type-with-icon" style="<?php if($value['icon_type'] == 'standard'):?> <?php else:?> display: none <?php endif;?>">
                                                    <label>Іконка</label>
                                                    <?= do_shortcode('[icon_select title="false" ready="true" icon="' . $value['icon'] . '" name="' . esc_attr(base64_encode($list['name'] . "[" . $id . "][icon]")) . '"]'); ?>
                                                </div>
                                                <div class="type-with-icon-custom" style="<?php if($value['icon_type'] == 'custom'):?> <?php else:?> display: none <?php endif;?>">
                                                    <label>Іконка</label>
                                                    <?= media_preview_box($list['name'] . "[" . $id . "][icon_custom]",esc_attr($value['icon_custom'])); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-danger btn-sm float-end delete-list-card-element"><?php _e('Delete'); ?></button>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <button type="button" data-count_items="<?= count($list['value']) ?>" class="btn-add-item btn btn-success btn-sm add-<?php echo self::$prefix; ?>">Додати картку</button>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.ck-editor-ready').summernote({
                    height: 182
                });

                $('#componentHero50Grid<?php echo $key; ?>').summernote({
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

                        itemsContainer.find('.icon-select-component').each(function () {
                            $(this).select2({
                                templateResult: formatStateIcon,
                                templateSelection: formatStateIcon,
                            });
                        });
                    });

                    $(document).on('change','.icon_type_select',function (){
                       let type = $(this).val();
                       let $container = $(this).closest('.row-item-card').find('.type-with-container');

                       if(type == 'standard'){
                           console.log($container);
                           $container.find('.type-with-icon').show();
                           $container.find('.type-with-icon-custom').hide();
                       } else {
                           $container.find('.type-with-icon').hide();
                           $container.find('.type-with-icon-custom').show();
                       }
                    });

                    $(document).on('click', '.delete-image', function () {
                        removeImage($(this));
                    });
                });
            </script>

        <?php });
    }
}
