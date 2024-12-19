<?php

$cFilters = config(\Config\Filters::class);

$cFilters->aliases['nexonFirstDescendantNavigation'] = \Modules\Nexon\FirstDescendant\Filters\Navigation::class;
$cFilters->filters['nexonFirstDescendantNavigation'] = [
    'before'    => [
        'nexon/first-descendant',
        'nexon/first-descendant/*',
    ],
];
