<?php

$cFilters = config(\Config\Filters::class);

$cFilters->aliases['nexonMapleStoryMNavigation'] = \Modules\Nexon\MapleStoryM\Filters\Navigation::class;
$cFilters->filters['nexonMapleStoryMNavigation'] = [
    'before'    => [
        'nexon/maple-story-m',
        'nexon/maple-story-m/*',
    ],
];
