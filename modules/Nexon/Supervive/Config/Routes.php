<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group(
    'nexon/supervive',
    [
        'namespace' => '\Modules\Nexon\Supervive\Controllers',
    ],
    function (RouteCollection $routes)
    {
        $routes->get('/', 'Main::index', ['as' => 'nexon_supervive_main']);

        $routes->group(
            'match',
            [
                'namespace' => '\Modules\Nexon\Supervive\Controllers\Match',
            ],
            function (RouteCollection $routes)
            {
                $routes->get('/',       'Main::index',      ['as' => 'nexon_supervive_match_main']);
                $routes->get('detail',  'Detail::index',    ['as' => 'nexon_supervive_match_detail']);
            }
        );

        $routes->group(
            'meta',
            [
                'namespace' => '\Modules\Nexon\Supervive\Controllers\Meta',
            ],
            function (RouteCollection $routes)
            {
                $routes->get('hunter',      'Hunter::index',    ['as' => 'nexon_supervive_meta_hunter']);
                $routes->get('item',        'Item::index',      ['as' => 'nexon_supervive_meta_item']);
                $routes->get('rankgrade',   'Rankgrade::index', ['as' => 'nexon_supervive_meta_rankgrade']);
            }
        );

        $routes->group(
            'cli',
            [
                'namespace' => '\Modules\Nexon\Supervive\Controllers\Cli',
            ],
            function (RouteCollection $routes)
            {}
        );
    }
);
