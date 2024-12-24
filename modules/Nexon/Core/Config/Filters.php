<?php

$cFilters = config(\Config\Filters::class);

$cFilters->aliases['nexonCoreNavigation'] = \Modules\Nexon\Core\Filters\Copyright::class;
$cFilters->filters['nexonCoreNavigation'] = [
    'before'    => [
        'nexon',
        'nexon/*',
    ],
];
