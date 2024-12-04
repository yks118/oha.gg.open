<?php

$cFilters = config(\Config\Filters::class);

$cFilters->aliases['nexonMabinogiNavigation'] = \Modules\Nexon\Mabinogi\Filters\Navigation::class;
$cFilters->filters['nexonMabinogiNavigation'] = [
    'before'    => [
        'nexon/mabinogi',
        'nexon/mabinogi/*',
    ],
];
