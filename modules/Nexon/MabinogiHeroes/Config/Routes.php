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
        $routes->get('marketplace-market-history', 'MarketplaceMarketHistory::index', ['as' => 'nexon_mabinogi_heroes_marketplace_market_history']);

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
