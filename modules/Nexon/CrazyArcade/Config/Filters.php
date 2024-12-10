<?php

$cFilters = config(\Config\Filters::class);

$cFilters->aliases['nexonCrazyArcadeNavigation'] = \Modules\Nexon\CrazyArcade\Filters\Navigation::class;
$cFilters->filters['nexonCrazyArcadeNavigation'] = [
    'before'    => [
        'nexon/crazy-arcade',
        'nexon/crazy-arcade/*',
    ],
];
