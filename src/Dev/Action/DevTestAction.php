<?php
namespace App\Dev\Action;

use App\Blog\Table\CategoryTable;
use Framework\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;

class DevTestAction
{
    /**
     * @var RendererInterface
     */
    private $renderer;

    /**
     * @var CategoryTable
     */
    private $categoryTable;

    public function __construct(RendererInterface $renderer, CategoryTable $categoryTable)
    {
        $this->renderer = $renderer;
        $this->categoryTable = $categoryTable;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        $categories = $this->categoryTable->findList();
        return $this->renderer->render('@dev/index', compact('categories'));
    }
}
