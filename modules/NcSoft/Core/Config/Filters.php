<?php

$cFilters = config(\Config\Filters::class);

$cFilters->aliases['ncsoftCoreNavigation'] = \Modules\NcSoft\Core\Filters\Copyright::class;
$cFilters->filters['ncsoftCoreNavigation'] = [
    'before'    => [
        'ncsoft',
        'ncsoft/*',
    ],
];
