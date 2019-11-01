<?php
namespace App\Blog\Actions;

use App\Blog\Entity\Post;
use App\Blog\PostUpload;
use App\Blog\Table\CategoryTable;
use App\Blog\Table\PostTable;
use Framework\Actions\CrudAction;
use Framework\Renderer\RendererInterface;
use Framework\Router;
use Framework\Session\FlashService;
use Framework\Validator;
use Psr\Http\Message\ServerRequestInterface;

class PostCrudAction extends CrudAction
{
    /**
     * @var string
     */
    protected $viewPath = "@blog/admin/posts";

    /**
     * @var string
     */
    protected $routePrefix = 'blog.admin';

    /**
     * @var CategoryTable
     */
    private $categoryTable;

    /**
     * @var PostUpload
     */
    private $postUpload;

    /**
     * PostCrudAction constructor.
     * @param RendererInterface $renderer
     * @param Router $router
     * @param PostTable $table
     * @param FlashService $flash
     * @param CategoryTable $categoryTable Table qui gère les categories des posts
     * @param PostUpload $postUpload
     */
    public function __construct(
        RendererInterface $renderer,
        Router $router,
        PostTable $table,
        FlashService $flash,
        CategoryTable $categoryTable,
        PostUpload $postUpload
    ) {
        parent::__construct($renderer, $router, $table, $flash);
        $this->categoryTable = $categoryTable;
        $this->postUpload = $postUpload;
    }

    public function delete(ServerRequestInterface $request)
    {
        $post = $this->table->find($request->getAttribute('id'));
        $this->postUpload->delete($post->image);
        return parent::delete($request);
    }

    /**
     * Rajoute des données à la vue (liste des catégories)
     * @param array $params
     * @return array
     */
    protected function formParams(array $params): array
    {
        $params['categories'] = $this->categoryTable->findList();
        return $params;
    }

    protected function getNewEntity()
    {
        $post = new Post();
        $post->created_at = new \DateTime();
        return $post;
    }

    /**
     * @param ServerRequestInterface $request
     * @param $post
     * @return array
     */
    protected function getParams(ServerRequestInterface $request, $post): array
    {
        $params = array_merge($request->getParsedBody(), $request->getUploadedFiles());
        //Upload du fichier
        $params['image'] = $this->postUpload->upload($params['image'], $post->image);
        $params = array_filter($params, function ($key) {
            return in_array($key, ['name', 'slug', 'content', 'created_at', 'category_id', 'image']);
        }, ARRAY_FILTER_USE_KEY);
        return array_merge($params, [
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * @param ServerRequestInterface $request
     * @return Validator
     */
    protected function getValidator(ServerRequestInterface $request): Validator
    {
        $validator = parent::getValidator($request)
            ->required('content', 'name', 'slug', 'category_id')
            ->length('content', 10, 250)
            ->length('name', 2, 25)
            ->length('slug', 2, 50)
            ->exists('category_id', $this->categoryTable->getTable(), $this->categoryTable->getPdo())
            ->dateTime('created_at')
            ->extension('image', ['jpg', 'png'])
            ->slug('slug');
        if (is_null($request->getAttribute('id'))) {
            $validator->uploaded('image');
        }
        return $validator;
    }
}
