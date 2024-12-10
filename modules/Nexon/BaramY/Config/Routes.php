<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group(
    'nexon/baram-y',
    [
        'namespace' => '\Modules\Nexon\BaramY\Controllers',
    ],
    function (RouteCollection $routes)
    {
        $routes->get('/', 'Main::index', ['as' => 'nexon_baram_y_main']);

        $routes->group(
            'cli',
            [
                'namespace' => '\Modules\Nexon\BaramY\Controllers\Cli',
            ],
            function (RouteCollection $routes)
            {}
        );
    }
);
