<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group(
    'nexon/crazy-arcade',
    [
        'namespace' => '\Modules\Nexon\CrazyArcade\Controllers',
    ],
    function (RouteCollection $routes)
    {
        $routes->get('/', 'Main::index', ['as' => 'nexon_crazy_arcade_main']);
        $routes->get('user', 'User::index', ['as' => 'nexon_crazy_arcade_user']);

        $routes->group(
            'cli',
            [
                'namespace' => '\Modules\Nexon\CrazyArcade\Controllers\Cli',
            ],
            function (RouteCollection $routes)
            {}
        );
    }
);
