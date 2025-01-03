<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group(
    'nexon/mabinogi-heroes',
    [
        'namespace' => '\Modules\Nexon\MabinogiHeroes\Controllers',
    ],
    function (RouteCollection $routes)
    {
        $routes->get('/', 'Main::index', ['as' => 'nexon_mabinogi_heroes_main']);
        $routes->get('meta-enchant', 'MetaEnchant::index', ['as' => 'nexon_mabinogi_heroes_meta_enchant']);

        $routes->group(
            'character',
            [
                'namespace' => '\Modules\Nexon\MabinogiHeroes\Controllers\Character',
            ],
            function (RouteCollection $routes)
            {
                $routes->get('', 'Main::index', ['as' => 'nexon_mabinogi_heroes_character_main']);
                $routes->get('item-equipment', 'ItemEquipment::index', ['as' => 'nexon_mabinogi_heroes_character_item_equipment']);
                $routes->get('title-equipment', 'TitleEquipment::index', ['as' => 'nexon_mabinogi_heroes_character_title_equipment']);
            }
        );

        $routes->group(
            'marketplace',
            [
                'namespace' => '\Modules\Nexon\MabinogiHeroes\Controllers\Marketplace',
            ],
            function (RouteCollection $routes)
            {
                $routes->get('history',         'History::index',       ['as' => 'nexon_mabinogi_heroes_marketplace_history']);

                $routes->group(
                    'gold-top',
                    [
                        'namespace' => '\Modules\Nexon\MabinogiHeroes\Controllers\Marketplace\GoldTop',
                    ],
                    function (RouteCollection $routes)
                    {
                        $routes->get('',                    'Main::index',      ['as' => 'nexon_mabinogi_heroes_marketplace_gold_top_main']);
                        $routes->get('detail/(:segment)',   'Detail::index/$1', ['as' => 'nexon_mabinogi_heroes_marketplace_gold_top_detail']);
                    }
                );
            }
        );

        $routes->group(
            'ranking',
            [
                'namespace' => '\Modules\Nexon\MabinogiHeroes\Controllers\Ranking',
            ],
            function (RouteCollection $routes)
            {
                $routes->get('hall-of-honor', 'HallOfHonor::index', ['as' => 'nexon_mabinogi_heroes_ranking_hall_of_honor']);
                $routes->get('real-time', 'RealTime::index', ['as' => 'nexon_mabinogi_heroes_ranking_real_time']);
            }
        );

        $routes->group(
            'cli',
            [
                'namespace' => '\Modules\Nexon\MabinogiHeroes\Controllers\Cli',
            ],
            function (RouteCollection $routes)
            {
                $routes->group(
                    'marketplace',
                    [
                        'namespace' => '\Modules\Nexon\MabinogiHeroes\Controllers\Cli\Marketplace',
                    ],
                    function (RouteCollection $routes)
                    {
                        $routes->cli('gold-top', 'GoldTop::index');
                    }
                );

                $routes->group(
                    'ranking',
                    [
                        'namespace' => '\Modules\Nexon\MabinogiHeroes\Controllers\Cli\Ranking',
                    ],
                    function (RouteCollection $routes)
                    {
                        $routes->cli('hall-of-honor', 'HallOfHonor::index');
                        $routes->cli('real-time', 'RealTime::index');
                    }
                );
            }
        );
    }
);
