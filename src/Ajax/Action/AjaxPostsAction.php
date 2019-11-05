<?php
namespace App\Ajax\Action;

use App\Blog\Table\PostTable;
use Psr\Http\Message\ServerRequestInterface;

class AjaxPostsAction
{
    /**
     * @var PostTable
     */
    private $postTable;

    public function __construct(PostTable $postTable)
    {
        $this->postTable = $postTable;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        $value = $request->getParsedBody()['type'];
        $data = $this->postTable->findAll()->fetchAll();
        //var_dump($data);
        //die();
        echo json_encode($data);
        die();
    }
}
