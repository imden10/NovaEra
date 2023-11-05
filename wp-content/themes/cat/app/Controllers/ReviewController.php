<?php

namespace App\Controllers;

use App\Core\Controller\Controller;

class ReviewController extends Controller
{
    public function single()
    {
        global $wp_query;

        $this->view('review/single', [
            'post' => $wp_query->post
        ]);
    }

    public function taxonomy(\WP_Term $queriedObject)
    {
        global $wp_query;

        $this->view('review/taxonomy', [
            'page' => $wp_query->post,
            'reviews' => $wp_query->posts,
            'term' => $queriedObject,
        ]);
    }
}
