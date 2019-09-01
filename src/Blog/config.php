<?php

use App\Blog\BlogModule;
use function \Di\{object, get};

return [
    'blog.prefix' => '/blog',
    'admin.widgets' => \DI\add([
        get(\App\Blog\BlogWidget::class)
    ]),
    BlogModule::class => Object()->constructorParameter('prefix', get('blog.prefix'))
];
