<?php
namespace App\Dev;

use App\Dev\Action\DevTestAction;
use DI\Container;
use Framework\Module;
use Framework\Renderer\RendererInterface;
use Framework\Router;

class DevModule extends Module
{
    const DEFINITIONS = __DIR__ . '/definitions.php';

    public function __construct(Container $container)
    {
        $container->get(RendererInterface::class)->addPath('dev', __DIR__ . '/views');
        $router = $container->get(Router::class);
        $router->get('/test', DevTestAction::class, 'dev.test');
    }
}
