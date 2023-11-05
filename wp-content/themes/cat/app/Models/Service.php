<?php

namespace App\Models;

use App\Core\Model\Model;

class Service extends Model
{
    protected $postType = 'service';

    public function all()
    {
        return new \WP_Query([
            'posts_per_page' => $this->postsPerPage,
            'post_type' => $this->postType,
        ]);
    }

    public function selectList()
    {
        return new \WP_Query([
            'posts_per_page' => -1,
            'post_type' => $this->postType,
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

    public function termsForFrontPage()
    {
        return get_terms([
            'taxonomy' => 'direction',
            'hide_empty' => true,
            'exclude' => !empty(getCustomOption('relations_stock_category')) ? [getCustomOption('relations_stock_category')] : [],
        ]);
    }

    public function terms()
    {
        return get_terms([
            'taxonomy' => 'direction',
            'hide_empty' => true,
            'exclude' => !empty(getCustomOption('relations_stock_category')) ? [getCustomOption('relations_stock_category')] : [],
        ]);
    }

    public function allByTerm($term_id, $count = null)
    {
        return new \WP_Query([
            'posts_per_page' => $count ? $count : $this->postsPerPage,
            'post_type' => $this->postType,
            'tax_query' => [
                [
                    'taxonomy' => 'direction',
                    'field' => 'id',
                    'terms' => (int) $term_id
                ],
            ],
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ]);
    }

    public function allWithTerms()
    {
        $services = new \WP_Query([
            'posts_per_page' => -1,
            'post_type' => $this->postType,
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ]);

        $result = array_map(function($service) {
            $service->categories = [];
            array_map(function($item) use($service) {
                array_push($service->categories, $item->term_id);
            }, wp_get_post_terms($service->ID, 'direction'));
            return $service;
        }, $services->posts);

        return $result;
    }
}
