<?php
namespace App\Ajax\Action;

use App\Blog\Table\PostTable;
use Psr\Http\Message\ServerRequestInterface;

class AjaxPostsAction
{

    public function __invoke(ServerRequestInterface $request)
    {
        echo  json_encode([
            [6, 'test'],
            [7, 'test2'],
            [10, 'test3']
        ]);
        die();
    }
}
