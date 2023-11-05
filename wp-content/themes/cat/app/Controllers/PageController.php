<?php

namespace App\Controllers;

use App\Core\Controller\Controller;
use App\Models\Page;

class PageController extends Controller
{
    public function front()
    {
        global $wp_query;

        $this->view('page/front', [
            'page' => $wp_query->post
        ]);
    }

    public function single()
    {
        global $wp_query;

        $this->view('page/single', [
            'page' => $wp_query->post
        ]);
    }

    public function posts()
    {
        global $wp_query;

        $posts_page = get_option('page_for_posts');

        $page = (0 != $posts_page)
            ? model('page')->find($posts_page)->post
            : $wp_query->post;

        $articles = (0 != $posts_page)
            ? $wp_query->posts
            : model('post')->all()->posts;

        $this->view('page/posts', [
            'page' => $page,
            'articles' => $articles
        ]);
    }

    public function search()
    {
        global $wp_query;

        $result = [];

        array_map(function($item) use(&$result) {
            $result[$item->post_type][] = $item;
            return $item;
        }, $wp_query->posts);

        $this->view('page/search', [
            'result' => $result,
        ]);
    }

    public function notFound()
    {
        $this->view('page/404', [
            'page' => !empty(getCustomOption('relations_404_page')) ? get_post(getCustomOption('relations_404_page')) : null,
        ]);
    }
}
