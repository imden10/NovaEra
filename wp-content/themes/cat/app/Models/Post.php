<?php

namespace App\Models;

use App\Core\Model\Model;

class Post extends Model
{
    protected $postType = 'post';

    public function all($without_id = [], $count = null, $paged = 1)
    {
        return new \WP_Query([
            'posts_per_page' => $count ? $count : $this->postsPerPage,
            'post_type' => $this->postType,
            'post__not_in' => $without_id,
            'paged' => $paged,
        ]);
    }

    public function byCategoryForFrontPage($category_id)
    {
        return new \WP_Query([
            'posts_per_page' => -1,
            'post_type' => $this->postType,
            'category__in' => [$category_id],
        ]);
    }

    public function find($id)
    {
        return new \WP_Query([
            'p' => (int) $id,
            'post_type' => $this->postType,
        ]);
    }

    public function findMain()
    {
        $result = new \WP_Query([
            'post_type' => $this->postType,
            'meta_query' => [
                [
                    'key' => 'post_information_main',
                    'value'   => 1,
                    'compare' => 'NUMERIC'
                ]
            ]
        ]);

        return !empty($result->posts) ? $result->posts[0] : (new \WP_Query([
            'posts_per_page' => 1,
            'post_type' => $this->postType,
        ]))->posts[0];
    }

    public function similarArticles($without_id = [])
    {
        return new \WP_Query([
            'posts_per_page' => -1,
            'post_type' => $this->postType,
            'post__not_in' => $without_id,
        ]);
    }
}
