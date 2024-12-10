<?php

$cFilters = config(\Config\Filters::class);

$cFilters->aliases['nexonKartRiderRushPlusNavigation'] = \Modules\Nexon\KartRiderRushPlus\Filters\Navigation::class;
$cFilters->filters['nexonKartRiderRushPlusNavigation'] = [
    'before'    => [
        'nexon/kart-rider-rush-plus',
        'nexon/kart-rider-rush-plus/*',
    ],
];
