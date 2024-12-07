<?php

$cFilters = config(\Config\Filters::class);

$cFilters->aliases['nexonMabinogiHeroesNavigation'] = \Modules\Nexon\MabinogiHeroes\Filters\Navigation::class;
$cFilters->filters['nexonMabinogiHeroesNavigation'] = [
    'before'    => [
        'nexon/mabinogi-heroes',
        'nexon/mabinogi-heroes/*',
    ],
];
