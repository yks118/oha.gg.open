<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group(
    'nexon/maple-story-m',
    [
        'namespace' => '\Modules\Nexon\MapleStoryM\Controllers',
    ],
    function (RouteCollection $routes)
    {
        $routes->get('/', 'Main::index', ['as' => 'nexon_maple_story_m_main']);

        $routes->group(
            'character',
            [
                'namespace' => '\Modules\Nexon\MapleStoryM\Controllers\Character',
            ],
            function (RouteCollection $routes)
            {
                $routes->get('', 'Main::index', ['as' => 'nexon_maple_story_m_character_main']);
                $routes->get('skill', 'Skill::index', ['as' => 'nexon_maple_story_m_character_skill']);
                $routes->get('vmatrix', 'Vmatrix::index', ['as' => 'nexon_maple_story_m_character_vmatrix']);
            }
        );

        $routes->group(
            'cli',
            [
                'namespace' => '\Modules\Nexon\MapleStoryM\Controllers\Cli',
            ],
            function (RouteCollection $routes)
            {}
        );
    }
);
