<?php

$cFilters = config(\Config\Filters::class);

$cFilters->aliases['nexonHit2Navigation'] = \Modules\Nexon\Hit2\Filters\Navigation::class;
$cFilters->filters['nexonHit2Navigation'] = [
    'before'    => [
        'nexon/hit2',
        'nexon/hit2/*',
    ],
];
