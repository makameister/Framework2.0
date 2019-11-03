<?php

namespace App\Home\Actions;

use Framework\Actions\RouterAwareAction;
use Framework\Renderer\RendererInterface;

class HomeIndexAction
{
    /**
     * @var RendererInterface
     */
    private $renderer;

    use RouterAwareAction;

    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function __invoke()
    {
        return $this->renderer->render('@home/index');
    }
}