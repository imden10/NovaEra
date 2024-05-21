<div id="icon-select-field">
    <?php
    $decoded_name = base64_decode($atts['name']);
    $icons = [
        'ic-check-large',
        'ic-packages',
        'ic-send',
        'ic-packages1',
        'ic-a-b-2',
        'ic-home',
        'ic-lang',
        'ic-insragram',
        'ic-insragram-light',
        'ic-linkedin',
        'ic-linkedin-simple',
        'ic-messanger',
        'ic-messanger-simple',
        'ic-shopping-cart',
        'ic-telegram',
        'ic-tiktok',
        'ic-tiktok-simple',
        'ic-twitter',
        'ic-twitter-simple',
        'ic-users-group',
        'ic-viber',
        'ic-whatsapp',
        'ic-youtube-simple',
        'ic-basket',
        'ic-building-estate',
        'ic-calculator',
        'ic-chat-1',
        'ic-chat-2',
        'ic-clipboard-check',
        'ic-dots',
        'ic-facebook',
        'ic-facebook-circle',
        'ic-factory',
        'ic-arrow-down',
        'ic-arrow-left',
        'ic-arrow-right',
        'ic-arrow-up',
        'ic-attachment-line',
        'ic-check',
        'ic-check-line',
        'ic-chevron-down',
        'ic-chevron-left',
        'ic-chevron-right',
        'ic-chevron-up',
        'ic-close',
        'ic-close-circle-fill',
        'ic-drop-down',
        'ic-drop-up',
        'ic-error-warning-line',
        'ic-eye-close-line',
        'ic-eye-line',
        'ic-link',
        'ic-mail-line',
        'ic-menu',
        'ic-minus',
        'ic-pin',
        'ic-play',
        'ic-plus',
    ];

    ?>
    <?php if(isset($atts['title']) && $atts['title'] == "true"):?>
    <label for="<?php echo esc_attr($decoded_name); ?>">Іконка:</label>
    <?php endif;?>
    <select style="width: 150px" name="<?php echo esc_attr($decoded_name); ?>" id="<?php echo esc_attr($decoded_name); ?>" class="<?php if($atts['ready']):?>icon-select-component-ready<?php else:?>icon-select-component<?php endif;?>">
        <option value="">Без іконки</option>
        <?php foreach ($icons as $item): ?>
            <option data-icon="<?=$item?>" value="<?=$item?>"<?php selected($atts['icon'], $item); ?>><?=$item?></option>
        <?php endforeach;?>
    </select>
</div>