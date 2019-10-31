<?php

namespace Framework\Twig;

use Framework\Middleware\CsrfMiddleware;

class CsrfExtension extends \Twig_Extension
{
    /**
     * @var CsrfMiddleware
     */
    private $middleware;

    public function __construct(CsrfMiddleware $middleware)
    {
        $this->middleware = $middleware;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('csrf_input', [$this, 'csrfInput'], ['is_safe' => ['html']])
        ];
    }

    public function csrfInput()
    {
        return '<input type="hidden" name="' . $this->middleware->getFormKey() .'" value="' . $this->middleware->generateToken() . '"/>';
    }
}
