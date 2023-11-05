<?php

namespace App\Controllers;

use App\Core\Controller\Controller;

class FaqController extends Controller
{
    public function single()
    {
        global $wp_query;

        $this->view('faq/single', [
            'post' => $wp_query->post
        ]);
    }

    public function taxonomy(\WP_Term $queriedObject)
    {
        global $wp_query;

        $this->view('faq/taxonomy', [
            'page' => $wp_query->post,
            'faqs' => $wp_query->posts,
            'term' => $queriedObject,
        ]);
    }
}
