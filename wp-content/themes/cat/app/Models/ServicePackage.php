<?php

namespace App\Models;

use App\Core\Model\Model;

class ServicePackage extends Model
{
    protected $postType = 'service_package';

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
                    'key' => 'service_package_information_on_front_page',
                    'compare' => 'EXISTS',
                ],
                [
                    'key' => 'service_package_information_on_front_page',
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
        return !empty($id)
            ? (new \WP_Query([
                    'p' => (int) $id,
                    'post_type' => $this->postType,
                ]))->post
            : null;
    }
}
