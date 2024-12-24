<?php
namespace Modules\Nexon\Mabinogi\Entities;

use DateTime;
use Modules\Core\Entities\BaseEntity;

/**
 * @property DateTime $date
 * @property string $item_uuid
 * @property int $min
 * @property int $max
 * @property int $sum
 * @property int $count
 */
class AuctionHistoryDate extends BaseEntity
{
    protected $casts = [
        'min'   => '?int',
        'max'   => '?int',
        'sum'   => '?int',
        'count' => '?int',
    ];

    protected $dates = [
        'date',
    ];
}
