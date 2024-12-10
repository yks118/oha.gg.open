<?php

$cFilters = config(\Config\Filters::class);

$cFilters->aliases['nexonBaramYNavigation'] = \Modules\Nexon\BaramY\Filters\Navigation::class;
$cFilters->filters['nexonBaramYNavigation'] = [
    'before'    => [
        'nexon/baram-y',
        'nexon/baram-y/*',
    ],
];
