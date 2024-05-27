<?php

namespace App\Controllers;

class BannerController
{
    protected function templateName($object): string
    {
        return ($object instanceof \WP_Post && isset($object->page_template_name))
            ? '-' . strtolower($object->page_template_name)
            : '';
    }

    public function view($template, array $data = []): void
    {
        $viewsPath = app('path.views');

        $object = get_queried_object();

        $template = $viewsPath . DIRECTORY_SEPARATOR . $template .$this->templateName($object) . '.php';

        if (!is_file($template)) {
            throw new \Exception(sprintf('Template file %s not found', $template));
        }

        extract($data);
        status_header(200);
        require_once $template;

        die;
    }

    /**
     * @return void
     */
    public function generate($id)
    {
        $banner = model('banner')->find($id)->post;
        $data = [
            'title'   => $banner->banner_information_title,
            'text'    => $banner->banner_information_text,
            'link'    => $banner->banner_information_link,
            'buttons' => array_values($banner->banner_information_list),
            'images'  => $banner->banner_information_images,
            'size'    => $banner->banner_information_size,
        ];

        $this->view('banner/index', [
            'data' => $data
        ]);
    }
}
