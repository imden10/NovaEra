<?php

namespace App\Controllers;

use App\Core\Controller\Controller;

class ServiceController extends Controller
{
    public function single()
    {
        global $wp_query;

        $this->view('service/single', [
            'post' => $wp_query->post
        ]);
    }

    public function taxonomy(\WP_Term $queriedObject)
    {
        global $wp_query;

        $this->view('service/taxonomy', [
            'page' => $wp_query->post,
            'services' => $wp_query->posts,
            'term' => $queriedObject,
        ]);
    }
}
