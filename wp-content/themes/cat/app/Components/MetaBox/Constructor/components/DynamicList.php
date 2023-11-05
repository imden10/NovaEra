<?php

namespace App\Components\MetaBox\Constructor\components;

class DynamicList
{
    public $name = 'Список';

    protected static $prefix = 'list-item';

    protected static $placeholder = '#listElementId';


    public function html($key, $name, $value)
    {
        $types = [
            'numeric' => __('Нумерований'),
            'no_numeric' => __('Не нумерований'),
        ];
        $type = [
            'name' => $name . '[' . $key . '][content][type]',
            'value' => isset($value['content']['type']) ? $value['content']['type'] : 'no_numeric'
        ];
        $list = [
            'name' => $name . '[' . $key . '][content][list]',
            'value' => (isset($value['content']['list']) && is_array($value['content']['list'])) ? $value['content']['list'] : []
        ];
        ?>

        <div class="body-block">
            <div class="list-elements-body">
                <label>
                    <?php _e('Тип списку '); ?>
                    <select name="<?php echo $type['name']; ?>">
                        <?php foreach ($types as $key => $name) : ?>
                            <option value="<?php echo $key; ?>"<?php echo ($type['value'] == $key) ? ' selected' : ''; ?>><?php echo $name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>

                <div style="display: none">
                    <li data-item-id="<?php echo self::$placeholder; ?>" class="item-list-template">
                        <input type="text" name="<?php echo $list['name']; ?>[<?php echo self::$placeholder; ?>]" disabled="disabled">
                        <button type="button" class="delete-list-element"><?php _e('Delete'); ?></button>
                    </li>
                </div>

                <ul class="list-elements-container">
                    <?php foreach ($list['value'] as $id => $value) : ?>
                        <li data-item-id="<?php echo $id; ?>" class="item-list-template">
                            <input type="text" name="<?php echo $list['name']; ?>[<?php echo $id; ?>]" value="<?php echo esc_attr($value); ?>">
                            <button type="button" class="delete-list-element"><?php _e('Delete'); ?></button>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <button type="button" class="button button-secondary add-<?php echo self::$prefix; ?>"><?php _e('Add'); ?></button>
            </div>
        </div>

        <?php
    }

    public function handlerStyle()
    {
        add_action('admin_footer', function () { ?>

            <style></style>

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

                        itemsContainer.find('input').each(function () {
                            $(this).prop('disabled', false);
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
