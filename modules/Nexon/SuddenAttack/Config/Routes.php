<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group(
    'nexon/sudden-attack',
    [
        'namespace' => '\Modules\Nexon\SuddenAttack\Controllers',
    ],
    function (RouteCollection $routes)
    {
        $routes->get('/', 'Main::index', ['as' => 'nexon_sudden_attack_main']);

        $routes->group(
            'match',
            [
                'namespace' => '\Modules\Nexon\SuddenAttack\Controllers\Match',
            ],
            function (RouteCollection $routes)
            {
                $routes->get('/', 'Main::index', ['as' => 'nexon_sudden_attack_match_main']);
                $routes->get(
                    'detail/(:segment)',
                    'Detail::index/$1',
                    ['as' => 'nexon_sudden_attack_match_detail']
                );
            }
        );

        $routes->group(
            'cli',
            [
                'namespace' => '\Modules\Nexon\SuddenAttack\Controllers\Cli',
            ],
            function (RouteCollection $routes)
            {}
        );
    }
);
