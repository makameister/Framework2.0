<?php

namespace Framework\Middleware;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;

class RedirectToHomeMiddleware
{
    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        $uri = $request->getUri()->getPath();
        if (strlen($uri) === 1) {
            return (new Response())
                ->withStatus(301)
                ->withHeader('Location', '/home');
        }
        return $next($request);
    }
}