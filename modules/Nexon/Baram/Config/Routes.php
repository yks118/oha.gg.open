<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group(
    'nexon/baram',
    [
        'namespace' => '\Modules\Nexon\Baram\Controllers',
    ],
    function (RouteCollection $routes)
    {
        $routes->get('/', 'Main::index', ['as' => 'nexon_baram_main']);

        $routes->group(
            'cli',
            [
                'namespace' => '\Modules\Nexon\Baram\Controllers\Cli',
            ],
            function (RouteCollection $routes)
            {}
        );
    }
);
