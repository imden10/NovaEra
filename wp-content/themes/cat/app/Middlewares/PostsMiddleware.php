<?php

namespace App\Middlewares;

use App\Controllers\PostController;
use League\Pipeline\StageInterface;

class PostsMiddleware implements StageInterface
{
    public function __invoke($wp_query)
    {
        $app = $wp_query->get('app');

        $queriedObject = $wp_query->get_queried_object();

        $postController = $app->make(PostController::class);

        dd($queriedObject->post_type,is_single());

        if ($queriedObject instanceof \WP_Post && 'post' === $queriedObject->post_type && is_single()) {
            $postController->single();

            die();
        }

        if (is_year() || is_month() || is_day()) {
            $postController->taxonomy(null);

            die();
        }

        return $wp_query;
    }
}
