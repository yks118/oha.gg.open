<?php

$cFilters = config(\Config\Filters::class);

$cFilters->aliases['nexonBaramNavigation'] = \Modules\Nexon\Baram\Filters\Navigation::class;
$cFilters->filters['nexonBaramNavigation'] = [
    'before'    => [
        'nexon/baram',
        'nexon/baram/*',
    ],
];
