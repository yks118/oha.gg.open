<?php

$cFilters = config(\Config\Filters::class);

$cFilters->aliases['coreNavigation'] = \Modules\Core\Filters\Navigation::class;
$cFilters->filters['coreNavigation'] = [
    'before'    => [
        '/',
        'ratio-calculator',
    ],
];
