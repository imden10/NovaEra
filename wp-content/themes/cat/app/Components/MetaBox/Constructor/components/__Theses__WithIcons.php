<?php

namespace App\Components\MetaBox\Constructor\components;

class Theses
{
    public $name = 'Тези';

    protected static $prefix = 'theses-item';

    protected static $placeholder = '#thesesElementId';

    public function html($key, $name, $value)
    {
        $list = [
            'name' => $name . '[' . $key . '][content][list]',
            'value' => (isset($value['content']['list']) && is_array($value['content']['list'])) ? $value['content']['list'] : []
        ];
        ?>

        <div class="body-block">
            <div class="list-elements-body">
                <template>
                    <li data-item-id="<?php echo self::$placeholder; ?>" class="item-list-template">
                        <div class="card border-success">
                            <div class="card-body">
                                <div class="mb-3">
                                    <input type="text" class="form-control form-control-sm"
                                           name="<?= $list['name']; ?>[<?= self::$placeholder; ?>][thesis]"
                                            placeholder="<?php _e('Теза '); ?>"
                                    >
                                </div>
                                <div class="mb-3">
                                    <?= do_shortcode('[icon_select name="' . esc_attr(base64_encode($list['name'] ."[".self::$placeholder."][icon]" )) . '"]'); ?>
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
                                               name="<?php echo $list['name']; ?>[<?php echo $id; ?>][thesis]"
                                               value="<?= esc_attr($value['thesis']); ?>"
                                               placeholder="<?php _e('Теза '); ?>"
                                        >
                                    </div>
                                    <div class="mb-3">
                                        <?= do_shortcode('[icon_select ready="true" icon="'.$value['icon'].'" name="' . esc_attr(base64_encode($list['name'] ."[".$id."][icon]" )) . '"]'); ?>
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

                    $(".icon-select-component-ready").each(function () {
                        $(this).select2({
                            templateResult: formatStateIcon,
                            templateSelection: formatStateIcon,
                        });
                    });
                });
            </script>

        <?php });
    }
}
