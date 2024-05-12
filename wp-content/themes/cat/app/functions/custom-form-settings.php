<?php
// Додайте сторінку налаштувань
function custom_form_settings_menu() {
    add_options_page(
        'Налаштування форм',
        'Налаштування форм',
        'manage_options',
        'custom-form-settings',
        'render_custom_form_settings_page'
    );
}
add_action('admin_menu', 'custom_form_settings_menu');

// Відобразіть сторінку налаштувань
function render_custom_form_settings_page() {
    ?>
    <div class="wrap">
        <h2>Налаштування форм</h2>

        <button style="margin-top: 30px" id="add-bot" class="btn btn-success">Додати бота</button>

        <form method="post" action="options.php">
            <?php
            settings_fields('custom-form-settings');
            do_settings_sections('custom-form-settings');
            ?>
            <div id="bot-list">
                <?php
                $bots = get_option('custom_form_settings', []);

                if (is_array($bots) && !empty($bots)) {
                    foreach ($bots as $index => $bot) {
                        render_bot_settings_fields($index, $bot);
                    }
                }
                ?>
            </div>
            <?php submit_button('Зберегти налаштування'); ?>
        </form>
    </div>
    <script>
        jQuery(document).ready(function ($) {
            let botIndex = <?php echo (isset($bots) && is_array($bots)) ? count($bots) : 0 ?>;

            $('#add-bot').on('click', function () {
                botIndex++;
                const newBotHtml = '<div style="margin-bottom: 15px" class="bot card" id="bot-' + botIndex + '">' +
                    '<div class="card-body">' +
                    '<h3>Бот ' + botIndex + '</h3>' +
                    '<table class="form-table">' +
                    '<tr><th>ID</th><td><input type="text" name="custom_form_settings[' + botIndex + '][form_id]" value="" /></td></tr>' +
                    '<tr><th>Name</th><td><input type="text" name="custom_form_settings[' + botIndex + '][form_name]" value="" /></td></tr>' +
                    '<tr><th>Bot Name</th><td><input type="text" name="custom_form_settings[' + botIndex + '][form_bot_name]" value="" /></td></tr>' +
                    '<tr><th>Bot Token</th><td><input type="text" name="custom_form_settings[' + botIndex + '][form_bot_token]" value="" /></td></tr>' +
                    '<tr><th>Bot Chat ID</th><td><input type="text" name="custom_form_settings[' + botIndex + '][form_bot_chat_id]" value="" /></td></tr>' +
                    '<tr><td colspan="2"><button class="delete-bot btn btn-danger" data-bot-index="' + botIndex + '">Видалити</button></td></tr>' +
                    '</table></div></div>';

                $('#bot-list').append(newBotHtml);
            });

            $('#bot-list').on('click', '.delete-bot', function () {
                const botIndex = $(this).data('bot-index');
                $('#bot-' + botIndex).remove();
            });
        });
    </script>
    <?php
}

function render_bot_settings_fields($index, $bot) {
    ?>
    <div class="bot card" style="margin-bottom: 15px" id="bot-<?php echo $index; ?>">
        <div class="card-body">
        <h3>Бот <?php echo $index; ?></h3>
        <table class="form-table">
            <tr><th>ID</th><td><input type="text" name="custom_form_settings[<?php echo $index; ?>][form_id]" value="<?php echo esc_attr($bot['form_id']); ?>" /></td></tr>
            <tr><th>Name</th><td><input type="text" name="custom_form_settings[<?php echo $index; ?>][form_name]" value="<?php echo esc_attr($bot['form_name']); ?>" /></td></tr>
            <tr><th>Bot Name</th><td><input type="text" name="custom_form_settings[<?php echo $index; ?>][form_bot_name]" value="<?php echo esc_attr($bot['form_bot_name']); ?>" /></td></tr>
            <tr><th>Bot Token</th><td><input type="text" name="custom_form_settings[<?php echo $index; ?>][form_bot_token]" value="<?php echo esc_attr($bot['form_bot_token']); ?>" /></td></tr>
            <tr><th>Bot Chat ID</th><td><input type="text" name="custom_form_settings[<?php echo $index; ?>][form_bot_chat_id]" value="<?php echo esc_attr($bot['form_bot_chat_id']); ?>" /></td></tr>
            <tr>
                <td colspan="2">
                    <button class="delete-bot btn btn-danger" data-bot-index="<?php echo $index; ?>">Видалити</button>
                </td>
            </tr>
        </table>
        </div>
    </div>
    <?php
}

// Реєстрація налаштувань
function custom_form_settings_init() {
    register_setting('custom-form-settings', 'custom_form_settings');
    add_settings_section('custom-form-settings-section', '', 'custom_form_settings_section_callback', 'custom-form-settings');
    add_settings_field('custom-form-settings-field', '', 'custom_form_settings_field_callback', 'custom-form-settings', 'custom-form-settings-section');
}
add_action('admin_init', 'custom_form_settings_init');

function custom_form_settings_section_callback() {
    // Код для секції налаштувань, якщо потрібно
}

function custom_form_settings_field_callback() {
    // Код для полів налаштувань, якщо потрібно
}

// Відключаємо плашку оновлення WP в адмінці ***************************************************************************
function remove_core_updates() {
    global $wp_version;
    return(object) array(
        'last_checked'=> time(),
        'version_checked'=> $wp_version,
    );
}
add_filter('pre_site_transient_update_core','remove_core_updates'); // Hide Updates for WordPress itself
//add_filter('pre_site_transient_update_plugins','remove_core_updates'); // Hide Updates for Plugins
add_filter('pre_site_transient_update_themes','remove_core_updates'); // Hide Updates for Themes
// *********************************************************************************************************************