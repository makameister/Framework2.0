<?php
namespace Framework\Middleware;

use DI\Container;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RoutePrefixedMiddleware implements MiddlewareInterface
{

    /**
     * @var Container
     */
    private $container;

    /**
     * @var string
     */
    private $prefix;

    /**
     * @var string
     */
    private $middleware;

    public function __construct(Container $container, string $prefix, string $middleware)
    {
        $this->container = $container;
        $this->prefix = $prefix;
        $this->middleware = $middleware;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate): ResponseInterface
    {
        $path = $request->getUri()->getPath();
        if (strpos($path, $this->prefix) === 0) {
            return $this->container->get($this->middleware)->process($request, $delegate);
        }
        return $delegate->process($request);
    }
}
