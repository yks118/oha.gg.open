<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group(
    'nexon/v4',
    [
        'namespace' => '\Modules\Nexon\V4\Controllers',
    ],
    function (RouteCollection $routes)
    {
        $routes->get('/', 'Main::index', ['as' => 'nexon_v4_main']);

        $routes->group(
            'cli',
            [
                'namespace' => '\Modules\Nexon\V4\Controllers\Cli',
            ],
            function (RouteCollection $routes)
            {}
        );
    }
);
