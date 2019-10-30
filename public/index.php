<?php

require dirname(__DIR__) . '/vendor/autoload.php';

$modules = [
    \App\Admin\AdminModule::class,
    \App\Blog\BlogModule::class
];

$app = (new \Framework\App(dirname(__DIR__) . '/config/config.php'))
    ->addModule(\App\Admin\AdminModule::class)
    ->addModule(\App\Blog\BlogModule::class)
    ->pipe(\Framework\Middleware\TrailingSlashMiddleware::class)
    ->pipe(\Framework\Middleware\MethodMiddleware::class)
    ->pipe(\Framework\Middleware\RouterMiddleware::class)
    ->pipe(\Framework\Middleware\DispatcherMiddleware::class)
    ->pipe(\Framework\Middleware\NotFoundMiddleware::class);

if (php_sapi_name() !== "cli") {
    $response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
    \Http\Response\send($response);
}
