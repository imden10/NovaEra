<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>

    <?= config('theme')['fonts'][get_option('theme_settings__font_style')]['link'] ?>
</head>
<body <?php body_class(); ?> style="--font: <?=get_option('theme_settings__font_style')?>">
<!--<div>-->
<!--    Приклад, як буде виглядати шрифт-->
<!--</div>-->
<!--<pre>-->
<!--    --><?php
//        print_r([
//                'bg_type' => get_option('theme_settings__bg_type'),
//                'color' => get_option('theme_settings__color'),
//                'gradient_color_1' => get_option('theme_settings__gradient_color_1'),
//                'gradient_color_2' => get_option('theme_settings__gradient_color_2'),
//                'gradient_type' => get_option('theme_settings__gradient_type'),
//                'gradient_deg' => get_option('theme_settings__gradient_deg'),
//                'noise' => get_option('theme_settings__noise'),
//                'font_style' => get_option('theme_settings__font_style'),
//        ]);
//    ?>
<!--</pre>-->


<?php require_once app('path.views') . '/layouts/sections/header.php'; ?>
test 1234567890



