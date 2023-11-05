<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use App\Models\Review;
use App\Models\Faq;
use App\Models\Employee;
use App\Models\BeforeAfter;
use App\Models\Partner;
use App\Models\ServicePackage;
use App\Models\Benefit;
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

        $container['model.service'] = function ($container) {
            return new Service($container);
        };

        $container['model.review'] = function ($container) {
            return new Review($container);
        };

        $container['model.faq'] = function ($container) {
            return new Faq($container);
        };

        $container['model.employee'] = function ($container) {
            return new Employee($container);
        };

        $container['model.before_after'] = function ($container) {
            return new BeforeAfter($container);
        };

        $container['model.partner'] = function ($container) {
            return new Partner($container);
        };

        $container['model.service_package'] = function ($container) {
            return new ServicePackage($container);
        };

        $container['model.benefit'] = function ($container) {
            return new Benefit($container);
        };

        $container['model.banner'] = function ($container) {
            return new Banner($container);
        };
    }
}
