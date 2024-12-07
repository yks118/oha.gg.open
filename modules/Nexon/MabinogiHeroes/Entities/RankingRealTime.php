<?php
namespace Modules\Nexon\MabinogiHeroes\Entities;

use Modules\Core\Entities\BaseEntity;

/**
 * @property ?int $ranking_type
 * @property ?int $ranking
 * @property ?string $character_name
 * @property ?int $score
 */
class RankingRealTime extends BaseEntity
{
    protected $casts = [
        'ranking_type'  => '?int',
        'ranking'       => '?int',

        'score' => '?int',
    ];

    protected $dates = [];
}
