<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group(
    'ncsoft/lineage2m',
    [
        'namespace' => '\Modules\NcSoft\Lineage2M\Controllers',
    ],
    function (RouteCollection $routes)
    {
        $routes->get('/',               'Main::index',      ['as' => 'ncsoft_lineage2m_main']);
        $routes->get('item/(:segment)', 'Item::index/$1',   ['as' => 'ncsoft_lineage2m_item']);

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
