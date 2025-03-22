<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group(
    'nexon/mabinogi',
    [
        'namespace' => '\Modules\Nexon\Mabinogi\Controllers',
    ],
    function (RouteCollection $routes)
    {
        $routes->get('/', 'Main::index', ['as' => 'nexon_mabinogi_main']);
        $routes->get('npc-shop-list', 'NpcShopList', ['as' => 'nexon_mabinogi_npc_shop_list']);
        $routes->get('horn-bugle-world-history', 'HornBugleWorldHistory::index', ['as' => 'nexon_mabinogi_horn_bugle_world_history']);

        $routes->match(['get', 'post'], 'dye-color', 'DyeColor::index', ['as' => 'nexon_mabinogi_dye_color']);

        $routes->group(
            'auction',
            [
                'namespace' => '\Modules\Nexon\Mabinogi\Controllers\Auction',
            ],
            function (RouteCollection $routes)
            {
                $routes->get('list', 'Lists::index', ['as' => 'nexon_mabinogi_auction_list']);
                $routes->get('sales-commission', 'SalesCommission::index', ['as' => 'nexon_mabinogi_auction_sales_commission']);

                $routes->group(
                    'history',
                    [
                        'namespace' => '\Modules\Nexon\Mabinogi\Controllers\Auction\History',
                    ],
                    function (RouteCollection $routes)
                    {
                        $routes->get('', 'Main::index', ['as' => 'nexon_mabinogi_auction_history_main']);
                        $routes->get('view/(:segment)/(:segment)', 'View::index/$1/$2', ['as' => 'nexon_mabinogi_auction_history_view']);
                    }
                );
            }
        );

        $routes->group(
            'cli',
            [
                'namespace' => '\Modules\Nexon\Mabinogi\Controllers\Cli',
            ],
            function (RouteCollection $routes)
            {
                $routes->cli('horn-bugle-world-history', 'HornBugleWorldHistory::index');

                $routes->group(
                    'auction',
                    [
                        'namespace' => '\Modules\Nexon\Mabinogi\Controllers\Cli\Auction',
                    ],
                    function (RouteCollection $routes)
                    {
                        $routes->cli('history', 'History::index');
                    }
                );

                $routes->cli('delete', 'Delete::index');
            }
        );
    }
);
