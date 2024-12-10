<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group(
    'nexon/kart-rider-rush-plus',
    [
        'namespace' => '\Modules\Nexon\KartRiderRushPlus\Controllers',
    ],
    function (RouteCollection $routes)
    {
        $routes->get('/', 'Main::index', ['as' => 'nexon_kart_rider_rush_plus_main']);
        $routes->get('user', 'User::index', ['as' => 'nexon_kart_rider_rush_plus_user']);

        $routes->group(
            'cli',
            [
                'namespace' => '\Modules\Nexon\KartRiderRushPlus\Controllers\Cli',
            ],
            function (RouteCollection $routes)
            {}
        );
    }
);
