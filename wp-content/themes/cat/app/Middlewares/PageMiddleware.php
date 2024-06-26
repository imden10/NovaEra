<?php

namespace App\Middlewares;

use App\Controllers\FormController;
use App\Controllers\BannerController;
use App\Controllers\PageController;
use League\Pipeline\StageInterface;

class PageMiddleware implements StageInterface
{
    public function __invoke($wp_query)
    {
        $app = $wp_query->get('app');

        $queriedObject = $wp_query->get_queried_object();

        if($_SERVER['REQUEST_URI'] == "/api/form/send"){
            $formController = $app->make(FormController::class);
            $formController->sendForm();
        }

        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        if ($path == "/api/form/render" && strpos($query, 'id=') !== false) {
            parse_str($query, $params);
            $id = $params['id'];

            $formController = $app->make(FormController::class);
            $formController->renderFormView($id);
        }

        if ($path == "/api/form/get-data" && strpos($query, 'id=') !== false) {
            parse_str($query, $params);
            $id = $params['id'];

            $formController = $app->make(FormController::class);
            $formController->getFormData($id);
        }

        if ($path == "/api/banner/generate" && strpos($query, 'id=') !== false) {
            parse_str($query, $params);
            $id = $params['id'];

            $bannerController = $app->make(BannerController::class);
            $bannerController->generate($id);
        }

        $pageController = $app->make(PageController::class);

        if( is_search() ){
            $pageController->search();

            die();
        }

        if ((is_front_page() && is_home()) || is_home()) {
            $pageController->posts();

            die();
        }

        if (is_front_page()) {
            $pageController->front();

            die();
        }

        if ($queriedObject instanceof \WP_Post && is_page() && is_page() && is_singular()) {
            $pageController->single();

            die();
        }

        if (is_404() && $_SERVER['REDIRECT_SCRIPT_URL'] !== '/uslugy/') {
            $pageController->notFound();

            die();
        }

        return $wp_query;
    }
}
