<?php
namespace App\Test;

use App\Test\Actions\TestIndexAction;
use DI\Container;
use Framework\Module;
use Framework\Renderer\RendererInterface;
use Framework\Router;

class TestModule extends Module
{
    const DEFINITIONS = __DIR__ . '/config.php';

    public function __construct(Container $container)
    {
        $testPrefix = $container->get('test.prefix');
        $container->get(RendererInterface::class)->addPath('test', __DIR__ . '/views');
        $router = $container->get(Router::class);
        $router->get($testPrefix, TestIndexAction::class, 'test.index');
    }
}
