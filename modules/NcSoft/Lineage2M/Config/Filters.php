<?php

$cFilters = config(\Config\Filters::class);

$cFilters->aliases['ncsoftLineage2MNavigation'] = \Modules\NcSoft\Lineage2M\Filters\Navigation::class;
$cFilters->filters['ncsoftLineage2MNavigation'] = [
    'before'    => [
        'ncsoft/lineage2m',
        'ncsoft/lineage2m/*',
    ],
];
