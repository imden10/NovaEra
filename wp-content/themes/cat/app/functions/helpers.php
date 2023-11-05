<?php

use App\Core\Container\Container;

if (!function_exists('app')) {
    function app($abstract = null) {
        if (is_null($abstract)) {
            return Container::getInstance();
        }

        $container = Container::getInstance();

        return $container[$abstract];
    }
}

if (!function_exists('config')) {
    function config($key = null, $default = null) {
        if (is_null($key)) {
            return Container::getInstance();
        }

        $config = Container::getInstance()->raw('config.' . $key);

        return $config ? $config : $default;
    }
}

if (!function_exists('appConfig')) {
    function appConfig($key = null, $default = null) {
        $config = config('app');

        if (is_null($key)) {
            return $config;
        }

        return isset($config[$key]) ? $config[$key] : $default;
    }
}

if (!function_exists('model')) {
    function model($key = null) {
        if (is_null($key)) {
            return Container::getInstance();
        }

        $model = Container::getInstance();

        return $model['model.' . $key];
    }
}

if (!function_exists('media_preview_box')) {

    function media_preview_box($name, $image_id = null, $title = null) {
        $defaultImage = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkAQMAAABKLAcXAAAABlBMVEUAAAC7u7s37rVJAAAAAXRSTlMAQObYZgAAACJJREFUOMtjGAV0BvL/G0YMr/4/CDwY0rzBFJ704o0CWgMAvyaRh+c6m54AAAAASUVORK5CYII=';
        $url = $image_id != 0 ? get_image_url_by_id($image_id) : $defaultImage;
        $is_image = wp_attachment_is_image($image_id);

        if ($image_id && !$is_image) {
            $fileUrl = get_attached_file($image_id);
            $file_info = pathinfo($fileUrl);
            $ext = strtolower($file_info['extension']);
            $url_prefix = get_template_directory_uri() . "/img/file-ext/";
            $url_path = $url_prefix . $ext . '.png';

            if(file_exists(get_template_directory() . "/img/file-ext/" . $ext . ".png")){
                $url = get_template_directory_uri() . "/img/file-ext/" . $ext . ".png";
            } else {
                $url = get_template_directory_uri() . "/img/file-ext/no-file.png";
            }
        }

        ?>
        <div class="image-block">
            <?php if($title): ?>
                <h6><?= $title?></h6>
            <?php endif;?>
            <div class="image-wrapper">
                <a class="attach-image" href="#">
                    <img src="<?= $url ?>" alt="">
                </a>
                <input type="hidden" name="<?= $name ?>" value="<?= $image_id; ?>" class="image-id">

                <button type="button" class="button button-secondary delete-image">
                    <?php _e('Remove'); ?>
                </button>
            </div>
        </div>
    <?php }

}

if (!function_exists('get_image_url_by_id')) {
    function get_image_url_by_id($attachment_id) {
        $image_attributes = wp_get_attachment_image_src($attachment_id, 'full');
        if ($image_attributes) {
            return $image_attributes[0];
        }
        return '';
    }
}

