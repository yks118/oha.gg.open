<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group(
    'nexon/hit2',
    [
        'namespace' => '\Modules\Nexon\Hit2\Controllers',
    ],
    function (RouteCollection $routes)
    {
        $routes->get('/', 'Main::index', ['as' => 'nexon_hit2_main']);

        $routes->group(
            'cli',
            [
                'namespace' => '\Modules\Nexon\Hit2\Controllers\Cli',
            ],
            function (RouteCollection $routes)
            {}
        );
    }
);
