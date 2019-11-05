<?php

namespace App\Test\Actions;

use Framework\Renderer\RendererInterface;

class TestIndexAction
{
    /**
     * @var RendererInterface
     */
    private $renderer;

    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function __invoke()
    {
        $this->renderer->render('@test/index');
    }
}