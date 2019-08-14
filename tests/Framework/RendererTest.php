<?php
namespace Tests\Framework;

use Framework\Renderer;
use PHPUnit\Framework\TestCase;

class RendererTest extends TestCase
{
    private $renderer;

    public function setUp()
    {
        $this->renderer = new Renderer();
        $this->renderer->addPath(__Dir__. '/views');
    }

    public function testRenderTheRightPath()
    {
        $this->renderer->addPath('blog', __Dir__. '/views');
        $content = $this->renderer->render('@blog/demo');
        $this->assertEquals('Demo', $content);
    }

    public function testRendererTheDefaultPath()
    {
        $content = $this->renderer->render('demo');
        $this->assertEquals('Demo', $content);
    }

    public function testRendererWithParams()
    {
        $content = $this->renderer->render('demoparams', ['nom' => 'Marc']);
        $this->assertEquals('Salut Marc', $content);
    }

    public function testGlobalParameters()
    {
        $this->renderer->addGlobal('nom', 'Marc');
        $content = $this->renderer->render('demoparams');
        $this->assertEquals('Salut Marc', $content);
    }
}
