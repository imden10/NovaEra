<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="stylesheet" href="style/jquery.mCustomScrollbar.min.css"> -->

    <?php wp_head(); ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-126925390-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-126925390-1');
    </script>

    <script src='https://www.google.com/recaptcha/api.js?render=<?= RE_CAPTCHA_SITE_KEY ?>'></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('<?= RE_CAPTCHA_SITE_KEY ?>', {action:'callback'})
            .then(function(token) {
                const callbackFields = document.getElementsByName('g-recaptcha-response-callback-form');
                for (let i = 0; i < callbackFields.length; i++) {
                    callbackFields[i].value = token;
                }
            });

            grecaptcha.execute('<?= RE_CAPTCHA_SITE_KEY ?>', {action:'appointment'})
            .then(function(token) {
                const callbackFields = document.getElementsByName('g-recaptcha-response-appointment-form');
                for (let i = 0; i < callbackFields.length; i++) {
                    callbackFields[i].value = token;
                }
            });

            grecaptcha.execute('<?= RE_CAPTCHA_SITE_KEY ?>', {action:'review'})
            .then(function(token) {
                const callbackFields = document.getElementsByName('g-recaptcha-response-review-form');
                for (let i = 0; i < callbackFields.length; i++) {
                    callbackFields[i].value = token;
                }
            });

            grecaptcha.execute('<?= RE_CAPTCHA_SITE_KEY ?>', {action:'package_appointment'})
            .then(function(token) {
                const callbackFields = document.getElementsByName('g-recaptcha-response-package-appointment-form');
                for (let i = 0; i < callbackFields.length; i++) {
                    callbackFields[i].value = token;
                }
            });
        });
    </script>
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


