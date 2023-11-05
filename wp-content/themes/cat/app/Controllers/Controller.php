<?php

namespace App\Controllers;

use App\Core\Controller\Controller as  BaseController;

class Controller extends BaseController
{
    public function single()
    {
        global $wp_query;

        $this->view('controller/single', [
            'post' => $wp_query->post
        ]);
    }

    public function taxonomy(\WP_Term $queriedObject)
    {
        global $wp_query;

        $this->view('controller/taxonomy', [
            'page' => $wp_query->post,
            'posts' => $wp_query->posts,
            'term' => $queriedObject,
        ]);
    }
}
