<?php

use App\Middlewares\PageMiddleware;
use App\Middlewares\PostsMiddleware;
use League\Pipeline\Pipeline;
use App\Middlewares\CustomPostTypeMiddleware;
use App\Middlewares\TermMiddleware;
use App\Middlewares\UserMiddleware;
use App\Core\Container\Container;

defined('ABSPATH') or die('Access denied');

show_admin_bar(false);

require_once get_template_directory() . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$container = Container::getInstance();

$container['theme']->init();
$container['option']->create();
$container['post_type']->create();
$container['taxonomy']->create();
$container['post_meta_box']->create();
$container['term_meta_box']->create();
$container['widget'];

add_action('template_redirect', function () {
    global $app, $wp_query;

    set_query_var('app', $app);

    $pipeline = (new Pipeline)
        ->pipe(new PostsMiddleware())
        ->pipe(new PageMiddleware())
        ->pipe(new CustomPostTypeMiddleware())
        ->pipe(new TermMiddleware())
        ->pipe(new UserMiddleware())
        ->pipe(function () {
            wp_safe_redirect('/');
            //throw new Exception('Controller not fount');
        });

    try {
        $pipeline->process($wp_query);
    } catch (LogicException $e) {
        echo $e->getMessage();
    }

    die();
});
function enqueue_custom_scripts()
{
    // Подключение стилей
    wp_enqueue_style('style', get_stylesheet_directory_uri() . '/style/style.css');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

function custom_scripts()
{
    wp_enqueue_script('sliders', get_template_directory_uri() . '/js/sliders.js', array(), null, true);
    wp_enqueue_script('accordions', get_template_directory_uri() . '/js/accordions.js', array(), null, true);
    // wp_enqueue_script('gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js', array(), null, true);
    wp_enqueue_script('scrollTrigger', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js', array(), null, true);
    wp_enqueue_script('imask', 'https://unpkg.com/imask', array(), null, true);
    wp_enqueue_script('formsHandler', get_template_directory_uri() . '/js/formsHandler.js', array(), null, false);
}
add_action('wp_enqueue_scripts', 'custom_scripts');
