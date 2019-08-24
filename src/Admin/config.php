<?php

use App\Admin\AdminModule;
use App\Admin\DashboardAction;

return [
    'admin.prefix' => '/admin',
    'admin.widgets' => [],
    AdminModule::class => \DI\object()->constructorParameter('prefix', \DI\get('admin.prefix')),
    DashboardAction::class => \DI\object()->constructorParameter('widgets', \DI\get('admin.widgets'))
];
