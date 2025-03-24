<?php

$cFilters = config(\Config\Filters::class);

$cFilters->aliases['nexonSuddenAttackNavigation'] = \Modules\Nexon\SuddenAttack\Filters\Navigation::class;
$cFilters->filters['nexonSuddenAttackNavigation'] = [
    'before'    => [
        'nexon/sudden-attack',
        'nexon/sudden-attack/*',
    ],
];
