<?php

function dd($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    die;
}

function trans($text = '', $domain = false)
{
    if (function_exists('pll__')) {
        return pll__($text);
    }

    $domain = ($domain) ? (string) $domain : (defined('TEXT_DOMAIN') ? TEXT_DOMAIN : '');

    return translate($text, $domain);
}


function getCustomOption($option, $default = '')
{
    $locale = explode('_', get_locale());

    $result = get_option(strtolower($locale[0]) . '_' . $option);

    return $result ? $result : (getOption($option) ? getOption($option) : $default);
}

function getPostDate($raw_date, $format = 'd F Y')
{
    return mb_strtolower(date_i18n($format, strtotime($raw_date)));
}

function getOption($option, $default = '')
{
    return get_option($option, $default);
}

function menuItems($menuId)
{
    return wp_get_nav_menu_items(wp_get_nav_menu_object($menuId));
}

function getTreeMenu($menu)
{
    $menu_raw_items = menuItems($menu);

    $menu_items = [];

    if (!empty($menu_raw_items)) {
        foreach ($menu_raw_items as $item) {
            $menu_items[$item->menu_item_parent][$item->ID] = $item;
            $menu_items[$item->menu_item_parent][$item->ID]->description = get_post_meta($item->ID, '_menu_item_desc', true) ?? '';
            $menu_items[$item->menu_item_parent][$item->ID]->is_custom_menu = (bool)get_post_meta($item->ID, '_menu_item_menu_custom', true) ?? false;
            $menu_items[$item->menu_item_parent][$item->ID]->target_blank = (bool)get_post_meta($item->ID, '_menu_item_target_blank', true) ?? false;
        }

        $node = $menu_items[0];

        treeNode($node, $menu_items);

        return $node;
    }

    return $menu_items;
}

function treeNode(&$node, $normalize)
{
    foreach ($node as $key => $item) {
        if (!isset($item->children)) {
            $node[$key]->children = [];
        }

        if (array_key_exists($key, $normalize)) {
            $node[$key]->children = $normalize[$key];

            treeNode($node[$key]->children, $normalize);
        }
    }
}

/* Build page content from constructor-array */
function buildContentFromConstructorArray($post_type, $data = [])
{
    if (!empty($data) && is_array($data)) {
        foreach ($data as $key => $section) {
            if (!isset($section['display']) || $section['display'] == 'off') continue;

            $content = isset($section['content']) ? $section['content'] : null;

            $component_type = isset($section['component']) ? $section['component'] : null;

            $component_type_parts = preg_split('/(?=[A-Z])/', $component_type, -1, PREG_SPLIT_NO_EMPTY);

            $component_file_name = implode('-', array_map('mb_strtolower', $component_type_parts));

            $file = app('path.views') . '/constructor/' . $post_type . '/' . $component_file_name . '.php';
            if (file_exists($file)) {
                if ($content['background_type'] !== 'image' && $content['background_type'] !== 'gradient') {
                    $bg = $content[$content['background_type']] ?? '';
                    echo "<section class='$component_file_name  mt-{$content['top_separator']} mb-{$content['bottom_separator']} {$content['background_type']} {$bg}'>";
                } elseif ($content['background_type'] === 'gradient') {
                    echo "<section class='$component_file_name  mt-{$content['top_separator']} mb-{$content['bottom_separator']} on-light bg-gradient'>";
                } else {
                    echo "<section style='background-image: url(" . wp_get_attachment_image_url($content['background_type_image']['id'], 'full') . ")' class='$component_file_name mt-{$content['top_separator']} mb-{$content['bottom_separator']} on-dark bg-img'>";
                }
                require $file;
                echo "</section>";
            }
        }
    }
}
/* End Build page content from constructor-array */

function num_decline($number, $titles, $param2 = '', $param3 = '')
{
    if ($param2)
        $titles = [$titles, $param2, $param3];

    if (is_string($titles))
        $titles = preg_split('/, */', $titles);

    if (empty($titles[2]))
        $titles[2] = $titles[1]; // когда указано 2 элемента

    $cases = [2, 0, 1, 1, 1, 2];

    $intnum = abs(intval(strip_tags($number)));

    return "$number " . $titles[($intnum % 100 > 4 && $intnum % 100 < 20) ? 2 : $cases[min($intnum % 10, 5)]];
}
