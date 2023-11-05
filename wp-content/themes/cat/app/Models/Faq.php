<?php

namespace App\Models;

use App\Core\Model\Model;

class Faq extends Model
{
    protected $postType = 'faq';

    public function all()
    {
        return new \WP_Query([
            'posts_per_page' => $this->postsPerPage,
            'post_type' => $this->postType,
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ]);
    }

    public function find($id)
    {
        return new \WP_Query([
            'p' => (int) $id,
            'post_type' => $this->postType,
        ]);
    }

    public function allForPage()
    {
        return new \WP_Query([
            'posts_per_page' => -1,
            'post_type' => $this->postType,
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ]);
    }

    public function allWithTerms()
    {
        $faqs = new \WP_Query([
            'posts_per_page' => -1,
            'post_type' => $this->postType,
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ]);

        $result = array_map(function($faq) {
            $faq->categories = [];
            array_map(function($item) use($faq) {
                array_push($faq->categories, $item->term_id);
            }, wp_get_post_terms($faq->faq_information_service, 'direction'));
            return $faq;
        }, $faqs->posts);

        return $result;
    }
}
