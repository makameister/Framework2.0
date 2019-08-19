<?php


namespace Tests\App\Actions\Blog;

use App\Blog\Actions\BlogAction;
use App\Blog\Table\PostTable;
use Framework\Renderer\RendererInterface;
use Framework\Router;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

class BlogActionTest extends TestCase
{
    /**
     * @var BlogAction
     */
    private $action;

    private $renderer;

    private $postTable;

    private $router;

    public function setUp()
    {
        $this->renderer = $this->prophesize(RendererInterface::class);
        $this->postTable = $this->prophesize(PostTable::class);
        $this->router = $this->prophesize(Router::class);
        $this->action = new BlogAction(
            $this->renderer->reveal(),
            $this->postTable->reveal(),
            $this->router->reveal()
        );
    }

    public function makePost(int $id, string $slug): \stdClass
    {
        $post = new \stdClass();
        $post->id = $id;
        $post->slug = $slug;
        return $post;
    }

    public function testShowRedirect()
    {
        $post = $this->makePost(9, 'azeaze-aze');
        $this->router->generateUri('blog.show', ['id' => $post->id, 'slug' => $post->slug])->willReturn('/demo2');
        $request = (new ServerRequest('GET', '/'))
            ->withAttribute('id', $post->id)
            ->withAttribute('slug', 'demo');
        $this->postTable->find($post->id)->willReturn($post);

        $response = call_user_func_array($this->action(), [$request]);
        $this->assertEquals(301, $response->getStatusCode());
        $this->assertEquals(['/demo2'], $response->getHeader('location'));
    }

    public function testShowRender()
    {
        $post = $this->makePost(9, 'azeaze-aze');
        $request = (new ServerRequest('GET', '/'))
            ->withAttribute('id', $post->id)
            ->withAttribute('slug', 'demo');
        $this->postTable->find($post->id)->willReturn($post);
        $this->renderer->render('@blog/show', ['post' => $post]);

        $response = call_user_func_array($this->action(), [$request]);
        $this->assertEquals(true, true);
    }
}