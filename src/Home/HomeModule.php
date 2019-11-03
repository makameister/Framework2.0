<?php
namespace App\Home;

use App\Home\Actions\HomeIndexAction;
use DI\Container;
use Framework\Module;
use Framework\Renderer\RendererInterface;
use Framework\Router;

class HomeModule extends Module
{
    const DEFINITIONS = __DIR__ . '/config.php';

    public function __construct(Container $container)
    {
        $homePrefix = $container->get('home.prefix');
        $container->get(RendererInterface::class)->addPath('home', __DIR__ . '/views');
        $router = $container->get(Router::class);
        $router->get($homePrefix, HomeIndexAction::class, 'home.index');
    }
}
