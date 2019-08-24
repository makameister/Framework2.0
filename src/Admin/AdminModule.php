<?php
namespace App\Admin;

use Framework\Module;
use Framework\Renderer\RendererInterface;
use Framework\Router;

class AdminModule extends Module
{
    const DEFINITIONS = __DIR__ . '/config.php';

    /**
     * @var RendererInterface
     */
    private $renderer;

    /**
     * @var Router
     */
    private $router;

    public function __construct(RendererInterface $renderer, Router $router, string $prefix)
    {
        $this->renderer = $renderer;
        $this->router = $router;
        $this->renderer->addPath('admin', __DIR__ . '/views');
        $this->router->get($prefix, DashboardAction::class, 'admin');
    }
}