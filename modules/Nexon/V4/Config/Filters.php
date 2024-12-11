<?php

$cFilters = config(\Config\Filters::class);

$cFilters->aliases['nexonV4Navigation'] = \Modules\Nexon\V4\Filters\Navigation::class;
$cFilters->filters['nexonV4Navigation'] = [
    'before'    => [
        'nexon/v4',
        'nexon/v4/*',
    ],
];
