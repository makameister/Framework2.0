<?php
namespace App\Ajax;

use App\Ajax\Action\AjaxPostsAction;
use DI\Container;
use Framework\Auth\LoggedInMiddleware;
use Framework\Module;
use Framework\Router;

class AjaxModule extends Module
{
    const DEFINITIONS = __DIR__ . '/definitions.php';

    public function __construct(Container $container)
    {
        $router = $container->get(Router::class);
        //$router->post('/ajax', [LoggedInMiddleware::class, AjaxPostsAction::class], 'ajax.posts');
        $router->post('/ajax', AjaxPostsAction::class, 'ajax.posts');
    }
}
