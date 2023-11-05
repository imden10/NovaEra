<?php

namespace App\Components\Option;

use App\Core\Option\BaseOption;

class WorkSchedule extends BaseOption
{
    protected static $placeholder = '#listItemId';

    public function html()
    { ?>
        <div class="form-group">
            <div class="items-container list-items">
                <ul style="display: none;">
                    <li data-item-id="<?php echo self::$placeholder; ?>" class="item-template">
                        <input type="text" name="<?php echo $this->name; ?>[<?php echo self::$placeholder; ?>][day]" disabled>
                        <input type="text" name="<?php echo $this->name; ?>[<?php echo self::$placeholder; ?>][hours]" disabled>
                        <button type="button" class="button delete-item"><?php _e('Delete'); ?></button>
                    </li>
                </ul>

                <ul class="items-container">
                    <?php foreach ($this->value as $key => $value) : ?>
                        <li data-item-id="<?php echo $key; ?>">
                            <input type="text" name="<?php echo $this->name; ?>[<?php echo $key; ?>][day]" value="<?php echo $value['day']; ?>">
                            <input type="text" name="<?php echo $this->name; ?>[<?php echo $key; ?>][hours]" value="<?php echo $value['hours']; ?>">
                            <button type="button" class="button delete-item"><?php _e('Delete'); ?></button>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <button type="button" class="button button-add add-<?php echo $this->name ?>"><?php _e('Add'); ?></button>
            </div>
        </div>

        <?php add_action('admin_footer', function () { ?>

        <script type="text/javascript">
            jQuery(document).ready(function($) {

                const prefix = '<?php echo $this->name ?>';
                const placeholder = '<?php echo self::$placeholder; ?>';

                $(document).on('click', '.add-' + prefix, function () {
                    const container = $(this).parents('.items-container');
                    const itemTemplate = container.find('.item-template');
                    const itemsContainer = container.find('.items-container');

                    createItem(container, itemTemplate, itemsContainer, placeholder);

                    itemsContainer.find('input').each(function () {
                        $(this).prop('disabled', false);
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
        return $value ? $value : [];
    }

    public static function beforeSave($value)
    {
        return $value;
    }
}