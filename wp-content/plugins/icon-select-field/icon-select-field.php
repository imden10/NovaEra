<?php
/*
Plugin Name: Icon Select Field
Description: A plugin to add a select field with icons using a shortcode.
Version: 1.0
*/

// Enqueue scripts and styles
function icon_select_enqueue_assets() {
    $plugin_url = plugins_url( 'assets/style.css', __FILE__ );
    wp_enqueue_style( 'plugin-style', $plugin_url);
}
add_action('admin_enqueue_scripts', 'icon_select_enqueue_assets');

// Define the shortcode function
function icon_select_shortcode($atts) {

    $atts = shortcode_atts(array(
        'name' => 'selected_icon', // Default name attribute value
        'icon' => '',
        'ready' => false,
        'title' => true,
    ), $atts);
    ob_start();

    // Include the list of available icons
    include(plugin_dir_path(__FILE__) . 'icons-list.php');

    return ob_get_clean();
}
add_shortcode('icon_select', 'icon_select_shortcode');

// Include icons list directly
function include_icons_list() {
    ob_start();
    include(plugin_dir_path(__FILE__) . 'icons-list.php');
    return ob_get_clean();
}
add_shortcode('icons_list', 'include_icons_list');

// Initialize shortcodes for PHP files
function initialize_shortcodes_in_php_files($content) {
    global $shortcode_tags;
    $orig_shortcode_tags = $shortcode_tags;
    $shortcode_tags = array('icon_select' => 'icon_select_shortcode', 'icons_list' => 'include_icons_list');

    $content = do_shortcode($content);

    $shortcode_tags = $orig_shortcode_tags;
    return $content;
}

function enqueue_admin_script() {
    // Реєструємо jQuery, якщо це необхідно (перевіряємо чи воно вже зареєстроване)
    if (!wp_script_is('jquery', 'registered')) {
        wp_register_script('jquery', includes_url('/js/jquery/jquery.js'), array(), null, true);
    }

    // Реєструємо та підключаємо ваш скрипт після jQuery
    wp_register_script('icon-select-script', plugin_dir_url(__FILE__) . '/js/icon-select-script.js', array('jquery'), '1.0', true);
    wp_enqueue_script('icon-select-script');
}

add_action('admin_enqueue_scripts', 'enqueue_admin_script');

add_filter('widget_text', 'initialize_shortcodes_in_php_files');
add_filter('widget_text_content', 'initialize_shortcodes_in_php_files');
?>
