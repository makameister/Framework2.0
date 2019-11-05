<?php

namespace App\Ajax;

use App\Ajax\Actions\PostsGetCategories;
use DI\Container;
use Framework\Module;
use Framework\Router;

class AjaxModule extends Module
{
    const DEFINITIONS = __DIR__ . '/config.php';

    public function __construct(Container $container, Router $router)
    {
        $ajaxPrefix = $container->get('ajax.prefix');
        $router->get($ajaxPrefix . 'list-categories', PostsGetCategories::class, 'ajax.list.categories');
    }
}
