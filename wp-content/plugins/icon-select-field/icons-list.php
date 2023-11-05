<div id="icon-select-field">
    <?php
    $decoded_name = base64_decode($atts['name']);
    $icons = ['mdi mdi-check-bold','mdi mdi-alert-circle','mdi mdi-alert-decagram','mdi mdi-facebook',
        'mdi mdi-arrow-left-bold','mdi mdi-arrow-right-bold','mdi mdi-bell','mdi mdi-cached'];
    ?>
    <label for="<?php echo esc_attr($decoded_name); ?>">Іконка:</label>
    <select name="<?php echo esc_attr($decoded_name); ?>" id="<?php echo esc_attr($decoded_name); ?>" class="<?php if($atts['ready']):?>icon-select-component-ready<?php else:?>icon-select-component<?php endif;?>">
        <option value="">Без іконки</option>
        <?php foreach ($icons as $item): ?>
            <option data-icon="<?=$item?>" value="<?=$item?>"<?php selected($atts['icon'], $item); ?>><?=$item?></option>
        <?php endforeach;?>
    </select>
</div>