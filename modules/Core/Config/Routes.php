<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group(
    '/',
    [
        'namespace' => '\Modules\Core\Controllers',
    ],
    function (RouteCollection $routes)
    {
        $routes->get('', 'Main::index', ['as' => 'core_main']);
        $routes->post('migration', 'Migration::index', ['as' => 'core_migration']);

        $routes->get('ratio-calculator', 'RatioCalculator::index', ['as' => 'core_ratio_calculator']);
    }
);
