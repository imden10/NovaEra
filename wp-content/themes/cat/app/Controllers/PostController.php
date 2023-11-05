<?php

namespace App\Controllers;

use App\Core\Controller\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function single()
    {
        global $wp_query;

        $this->view('post/single', [
            'post' => $wp_query->post
        ]);
    }

    public function taxonomy(\WP_Term $queriedObject)
    {
        global $wp_query;

        $this->view('post/taxonomy', [
            'page' => get_post(get_option('page_for_posts')),
            'taxonomy_query' => $wp_query,
            'term' => $queriedObject,
        ]);
    }
}
