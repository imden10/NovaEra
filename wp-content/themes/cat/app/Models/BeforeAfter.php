<?php

namespace App\Models;

use App\Core\Model\Model;

class BeforeAfter extends Model
{
    protected $postType = 'before_after';

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

    public function allWithTerms()
    {
        $before_after = new \WP_Query([
            'posts_per_page' => -1,
            'post_type' => $this->postType,
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ]);

        $result = array_map(function($bf) {
            $bf->categories = [];
            array_map(function($item) use($bf) {
                array_push($bf->categories, $item->term_id);
            }, wp_get_post_terms($bf->before_after_information_service, 'direction'));
            return $bf;
        }, $before_after->posts);

        return $result;
    }
}
