<?php
namespace Framework\Auth;

use Framework\Auth;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Middleware vérifiant si l'utilisateur est connecté
 * Class LoggedInMiddleware
 * @package Framework\Auth
 */
class LoggedInMiddleware implements MiddlewareInterface
{
    /**
     * @var Auth
     */
    private $auth;

    /**
     * LoggedInMiddleware constructor.
     * @param Auth $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Vérifie si l'utilisateur est connecté
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return ResponseInterface
     * @throws ForbiddenException
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate): ResponseInterface
    {
        $user = $this->auth->getUser();
        if (is_null($user)) {
            throw new ForbiddenException();
        }
        return $delegate->process($request->withAttribute('user', $user));
    }
}
