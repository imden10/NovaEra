<?php

namespace App\Models;

use App\Core\Model\Model;

class Review extends Model
{
    protected $postType = 'review';

    public function all()
    {
        return new \WP_Query([
            'posts_per_page' => $this->postsPerPage,
            'post_type' => $this->postType,
        ]);
    }

    public function forFrontPage()
    {
        return new \WP_Query([
            'posts_per_page' => -1,
            'post_type' => $this->postType,
            'meta_query' => [
                [
                    'key' => 'review_information_on_front_page',
                    'compare' => 'EXISTS',
                ],
                [
                    'key' => 'review_information_on_front_page',
                    'value' => 1,
                    'type' => 'numeric',
                    'compare' => '=',
                ],
            ],
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
        $reviews = new \WP_Query([
            'posts_per_page' => -1,
            'post_type' => $this->postType,
        ]);

        $result = array_map(function($review) {
            $review->categories = [];
            array_map(function($item) use($review) {
                array_push($review->categories, $item->term_id);
            }, wp_get_post_terms($review->review_information_service, 'direction'));
            return $review;
        }, $reviews->posts);

        return $result;
    }
}
