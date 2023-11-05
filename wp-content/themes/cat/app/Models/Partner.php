<?php

namespace App\Models;

use App\Core\Model\Model;

class Partner extends Model
{
    protected $postType = 'partner';

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
}
