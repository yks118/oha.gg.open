<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group(
    'nexon/first-descendant',
    [
        'namespace' => '\Modules\Nexon\FirstDescendant\Controllers',
    ],
    function (RouteCollection $routes)
    {
        $routes->get('', '');

        $routes->group(
            '{locale}',
            function (RouteCollection $routes)
            {
                $routes->get('',                        'Main::index',                  ['as' => 'nexon_first_descendant_main']);
                $routes->get('recommendation-module',   'RecommendationModule::index',  ['as' => 'nexon_first_descendant_recommendation_module']);

                $routes->group(
                    'meta',
                    [
                        'namespace' => '\Modules\Nexon\FirstDescendant\Controllers\Meta',
                    ],
                    function (RouteCollection $routes)
                    {
                        $routes->get('descendant-level-exp',    'DescendantLevelExp::index',    ['as' => 'nexon_first_descendant_meta_descendant_level_exp']);
                        $routes->get('mastery-rank-level-exp',  'MasteryRankLevelExp::index',   ['as' => 'nexon_first_descendant_meta_mastery_rank_level_exp']);
                        $routes->get('fellow-level-exp',        'FellowLevelExp::index',        ['as' => 'nexon_first_descendant_meta_fellow_level_exp']);
                        $routes->get('adapt-level-exp',         'AdaptLevelExp::index',         ['as' => 'nexon_first_descendant_meta_adapt_level_exp']);
                        $routes->get('medal',                   'Medal::index',                 ['as' => 'nexon_first_descendant_meta_medal']);
                        $routes->get('customizing-item',        'CustomizingItem::index',       ['as' => 'nexon_first_descendant_meta_customizing_item']);

                        $routes->group(
                            'descendant',
                            [
                                'namespace' => '\Modules\Nexon\FirstDescendant\Controllers\Meta\Descendant',
                            ],
                            function (RouteCollection $routes)
                            {
                                $routes->get('',                    'Main::index',      ['as' => 'nexon_first_descendant_meta_descendant_main']);
                                $routes->get('detail/(:segment)',   'Detail::index/$1', ['as' => 'nexon_first_descendant_meta_descendant_detail']);
                            }
                        );

                        $routes->group(
                            'weapon',
                            [
                                'namespace' => '\Modules\Nexon\FirstDescendant\Controllers\Meta\Weapon',
                            ],
                            function (RouteCollection $routes)
                            {
                                $routes->get('',                    'Main::index',      ['as' => 'nexon_first_descendant_meta_weapon_main']);
                                $routes->get('detail/(:segment)',   'Detail::index/$1', ['as' => 'nexon_first_descendant_meta_weapon_detail']);
                            }
                        );

                        $routes->group(
                            'module',
                            [
                                'namespace' => '\Modules\Nexon\FirstDescendant\Controllers\Meta\Module',
                            ],
                            function (RouteCollection $routes)
                            {
                                $routes->get('',                    'Main::index',      ['as' => 'nexon_first_descendant_meta_module_main']);
                                $routes->get('detail/(:segment)',   'Detail::index/$1', ['as' => 'nexon_first_descendant_meta_module_detail']);
                            }
                        );

                        $routes->group(
                            'reactor',
                            [
                                'namespace' => '\Modules\Nexon\FirstDescendant\Controllers\Meta\Reactor',
                            ],
                            function (RouteCollection $routes)
                            {
                                $routes->get('',                    'Main::index',      ['as' => 'nexon_first_descendant_meta_reactor_main']);
                                $routes->get('detail/(:segment)',   'Detail::index/$1', ['as' => 'nexon_first_descendant_meta_reactor_detail']);
                            }
                        );

                        $routes->group(
                            'external-component',
                            [
                                'namespace' => '\Modules\Nexon\FirstDescendant\Controllers\Meta\ExternalComponent',
                            ],
                            function (RouteCollection $routes)
                            {
                                $routes->get('',                    'Main::index',      ['as' => 'nexon_first_descendant_meta_external_component_main']);
                                $routes->get('detail/(:segment)',   'Detail::index/$1', ['as' => 'nexon_first_descendant_meta_external_component_detail']);
                            }
                        );

                        $routes->group(
                            'reward',
                            [
                                'namespace' => '\Modules\Nexon\FirstDescendant\Controllers\Meta\Reward',
                            ],
                            function (RouteCollection $routes)
                            {
                                $routes->get('',                    'Main::index',      ['as' => 'nexon_first_descendant_meta_reward_main']);
                                $routes->get('detail/(:segment)',   'Detail::index/$1', ['as' => 'nexon_first_descendant_meta_reward_detail']);
                            }
                        );

                        $routes->group(
                            'consumable-material',
                            [
                                'namespace' => '\Modules\Nexon\FirstDescendant\Controllers\Meta\ConsumableMaterial',
                            ],
                            function (RouteCollection $routes)
                            {
                                $routes->get('',                    'Main::index',      ['as' => 'nexon_first_descendant_meta_consumable_material_main']);
                                $routes->get('detail/(:segment)',   'Detail::index/$1', ['as' => 'nexon_first_descendant_meta_consumable_material_detail']);
                            }
                        );

                        $routes->group(
                            'research',
                            [
                                'namespace' => '\Modules\Nexon\FirstDescendant\Controllers\Meta\Research',
                            ],
                            function (RouteCollection $routes)
                            {
                                $routes->get('',                    'Main::index',      ['as' => 'nexon_first_descendant_meta_research_main']);
                                $routes->get('detail/(:segment)',   'Detail::index/$1', ['as' => 'nexon_first_descendant_meta_research_detail']);
                            }
                        );

                        $routes->group(
                            'fellow',
                            [
                                'namespace' => '\Modules\Nexon\FirstDescendant\Controllers\Meta\Fellow',
                            ],
                            function (RouteCollection $routes)
                            {
                                $routes->get('',                    'Main::index',      ['as' => 'nexon_first_descendant_meta_fellow_main']);
                                $routes->get('detail/(:segment)',   'Detail::index/$1', ['as' => 'nexon_first_descendant_meta_fellow_detail']);
                            }
                        );
                    }
                );
            }
        );

        $routes->group(
            'cli',
            [
                'namespace' => '\Modules\Nexon\FirstDescendant\Controllers\Cli',
            ],
            function (RouteCollection $routes)
            {}
        );
    }
);
