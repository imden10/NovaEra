<?php

namespace App\Models;

use App\Core\Model\Model;

class Employee extends Model
{
    protected $postType = 'employee';

    public function all()
    {
        return new \WP_Query([
            'posts_per_page' => $this->postsPerPage,
            'post_type' => $this->postType,
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ]);
    }

    public function forFrontPage()
    {
        return new \WP_Query([
            'posts_per_page' => -1,
            'post_type' => $this->postType,
            'meta_query' => [
                [
                    'key' => 'employee_information_on_front_page',
                    'compare' => 'EXISTS',
                ],
                [
                    'key' => 'employee_information_on_front_page',
                    'value' => 1,
                    'type' => 'numeric',
                    'compare' => '=',
                ],
            ],
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

    public function getRelationTermStringIds($service_ids = [])
    {
        $terms = [];

        array_map(function($item) use(&$terms) {
            array_map(function($item) use(&$terms) {
                array_push($terms, $item->term_id);
            }, wp_get_post_terms($item, 'direction'));
        }, $service_ids);

        return implode(',', array_unique($terms));
    }
}
