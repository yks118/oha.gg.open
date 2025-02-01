<?php

$cFilters = config(\Config\Filters::class);

$cFilters->aliases['nexonSuperviveNavigation'] = \Modules\Nexon\Supervive\Filters\Navigation::class;
$cFilters->filters['nexonSuperviveNavigation'] = [
    'before'    => [
        'nexon/supervive',
        'nexon/supervive/*',
    ],
];
