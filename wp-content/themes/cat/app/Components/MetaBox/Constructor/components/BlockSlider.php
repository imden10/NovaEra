<?php

namespace App\Components\MetaBox\Constructor\components;

class BlockSlider
{
    public $name = 'Карточка слайдер';

    protected static $prefix = 'block-slider-item';

    protected static $placeholder = '#block_sliderElementId';

    public function html($key, $name, $value)
    {
        $text = [
            'name' => $name . '[' . $key . '][content][text]',
            'value' => isset($value['content']['text']) ? $value['content']['text'] : ''
        ];

        $list = [
            'name' => $name . '[' . $key . '][content][list]',
            'value' => (isset($value['content']['list']) && is_array($value['content']['list'])) ? $value['content']['list'] : []
        ];
        ?>

        <div class="body-block">
            <div class="list-elements-body">
                <div class="mb-3">
                    <div class="textarea-part">
                        <textarea id="componentBlockSlider<?php echo $key; ?>" class="ck-editor" name="<?php echo $text['name']; ?>"><?php echo $text['value']; ?></textarea>
                    </div>
                </div>

                <template>
                    <li data-item-id="<?php echo self::$placeholder; ?>" class="item-list-template">
                        <div class="card border-success">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <?= media_preview_box($list['name'] . "[" . self::$placeholder . "][image]"); ?>
                                    </div>
                                    <div class="col-9">
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-sm"
                                                   name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][title]"
                                                   placeholder="<?php _e('Заголовок'); ?>"
                                            >
                                        </div>
                                        <div class="mb-3">
                                            <textarea id="component_<?= uniqid(time()) ?>"
                                              name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][text]"
                                              class="ck-editor"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-sm"
                                                   name="<?= $list['name']; ?>[<?php echo self::$placeholder; ?>][link]"
                                                   placeholder="<?php _e('Посилання '); ?>"
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
                                            <?= media_preview_box($list['name'] . "[" . $id . "][image]",esc_attr($value['image'])); ?>
                                        </div>
                                        <div class="col-9">
                                            <div class="mb-3">
                                                <input type="text" class="form-control form-control-sm"
                                                       name="<?php echo $list['name']; ?>[<?php echo $id; ?>][title]"
                                                       value="<?= esc_attr($value['title']); ?>"
                                                       placeholder="<?php _e('Заголовок '); ?>"
                                                >
                                            </div>
                                            <div class="mb-3">
                                                <textarea id="component_<?= uniqid(time()) ?>" name="<?= $list['name']; ?>[<?php echo $id; ?>][text]" class="ck-editor-ready"><?= esc_attr($value['text']); ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" class="form-control form-control-sm"
                                                       name="<?php echo $list['name']; ?>[<?php echo $id; ?>][link]"
                                                       value="<?= esc_attr($value['link']); ?>"
                                                       placeholder="<?php _e('Посилання '); ?>"
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
                $('.ck-editor-ready').summernote(summernote_options);

                $('#componentBlockSlider<?php echo $key; ?>').summernote(summernote_options);
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
                            $(this).summernote({
                                height: 182
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
