<?php
namespace Framework;

use DI\ContainerBuilder;
use Exception;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Container\containerInterface;

class App implements DelegateInterface
{

    /**
     * List of modules
     * @var array
     */
    private $modules = [];

    /**
     * @var string
     */
    private $definition;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var string[]
     */
    private $middlewares;

    /**
     * @var int
     */
    private $index = 0;

    /**
     * App constructor.
     * @param string $definition
     */
    public function __construct(string $definition)
    {
        $this->definition = $definition;
    }

    /**
     * Ajoute un module
     * @param string $module
     * @return $this
     */
    public function addModule(string $module): self
    {
        $this->modules[] = $module;
        return $this;
    }

    /**
     * Ajoute un middleware
     * @param string $middleware
     * @return $this
     */
    public function pipe(string $middleware): self
    {
        $this->middlewares[] = $middleware;
        return $this;
    }

    /**
     * Permet d'executer tous les middleware
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws Exception
     */
    public function process(ServerRequestInterface $request): ResponseInterface
    {
        $middleware = $this->getMiddleware();
        if (is_null($middleware)) {
            throw new \Exception("Aucun middleware a intercepté cette requête !");
        } elseif (is_callable($middleware)) {
            return call_user_func_array($middleware, [$request, [$this, 'process']]);
        } elseif ($middleware instanceof MiddlewareInterface) {
            return $middleware->process($request, $this);
        }
    }

    public function run(ServerRequestInterface $request): ResponseInterface
    {
        foreach ($this->modules as $module) {
            $this->getContainer()->get($module);
        }
        return $this->process($request);
    }

    /**
     * @return containerInterface
     */
    private function getContainer(): ContainerInterface
    {
        if ($this->container === null) {
            $builder = new ContainerBuilder();
            $builder->addDefinitions($this->definition);
            foreach ($this->modules as $module) {
                if ($module::DEFINITIONS) {
                    $builder->addDefinitions($module::DEFINITIONS);
                }
            }
            $this->container = $builder->build();
        }
        return $this->container;
    }

    /**
     * @return object
     */
    private function getMiddleware(): object
    {
        if (array_key_exists($this->index, $this->middlewares)) {
            $middleware = $this->container->get($this->middlewares[$this->index]);
            $this->index++;
            return $middleware;
        }
        return null;
    }
}
