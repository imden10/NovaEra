<?php

namespace App\Models;

use App\Core\Model\Model;

class Form extends Model
{
    protected $postType = 'forms';

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

    public static function getList()
    {
        $all = new \WP_Query([
            'posts_per_page' => -1,
            'post_type' => 'forms',
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ]);

        $list = [];

        if(count($all->posts)){
            foreach ($all->posts as $post){
                $list[$post->ID] = $post->post_title;
            }
        }

        return $list;
    }

    public static function getData($id)
    {
        $form = new \WP_Query([
            'p' => (int) $id,
            'post_type' => 'forms',
        ]);

        if(!isset($form->posts[0])){
            return [];
        }

        $formPost = $form->posts[0];

        $formData = [
            'form_id'       => $id,
            'title'         => $formPost->form_information_title,
            'btn_name'      => $formPost->form_information_btn_name,
            'image'         => get_image_url_by_id($formPost->form_information_image),
            'group_id'      => $formPost->form_information_group_id,
            'success_title' => $formPost->form_information_success_title,
            'success_text'  => $formPost->form_information_success_text,
            'fields'        => array_values($formPost->form_information_fields),
        ];

        return $formData;
    }
}