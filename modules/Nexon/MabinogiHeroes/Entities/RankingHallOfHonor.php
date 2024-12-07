<?php
namespace Modules\Nexon\MabinogiHeroes\Entities;

use DateTime;
use Modules\Core\Entities\BaseEntity;

/**
 * @property ?DateTime $date
 * @property ?int $ranking_type
 * @property ?int $ranking
 * @property ?string $character_name
 * @property ?int $score
 */
class RankingHallOfHonor extends BaseEntity
{
    protected $casts = [
        'ranking_type'  => '?int',
        'ranking'       => '?int',

        'score' => '?int',
    ];

    protected $dates = [
        'date',
    ];
}
