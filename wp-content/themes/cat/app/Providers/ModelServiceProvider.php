<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Form;
use App\Models\Page;
use App\Models\Post;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ModelServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container['model.page'] = function ($container) {
            return new Page($container);
        };

        $container['model.post'] = function ($container) {
            return new Post($container);
        };

        $container['model.banner'] = function ($container) {
            return new Banner($container);
        };

        $container['model.form'] = function ($container) {
            return new Form($container);
        };
    }
}
