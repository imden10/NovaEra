<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>

    <?= config('theme')['fonts'][get_option('theme_settings__font_style')]['link'] ?>
    <link rel="icon" href="<?= get_image_url_by_id(get_option('theme_settings__favicon')) ?>" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
    <?php if (in_array($_SERVER['REQUEST_URI'], ['/cookies', '/rules-for-using-the-site', '/privacy-policy'])) : ?>
        <meta name="robots" content="noindex">
    <?php endif; ?>
</head>

<?php
$preset = get_option('theme_settings__bg_type') === 'presets' ? get_option('theme_settings__preset') : '';
?>

<body <?php body_class($preset); ?> style="--font: <?= get_option('theme_settings__font_style') ?>" data-theme="nova-era" data-windowsize="1440-1280" data-mode="<?= get_option('theme_settings__mode') ?>">

    <?php require_once app('path.views') . '/layouts/sections/header.php'; ?>

    <!-- <button onclick="modalFormShow()">show modal</button>
    <button onclick="modalFormHide()">hide modal</button> -->