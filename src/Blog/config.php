<?php

use App\Blog\BlogModule;
use function \Di\{object, get};

return [
    'blog.prefix' => '/blog',
    //BlogModule::class => Object()->constructorParameter('container', get('blog.prefix'))
    BlogModule::class => Object()->constructorParameter('prefix', get('blog.prefix'))
];
