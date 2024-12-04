<?php
namespace Modules\Nexon\Mabinogi\Entities;

use DateTime;
use Modules\Core\Entities\BaseEntity;

/**
 * @property ?string $auction_item_category
 * @property ?string $status
 * @property ?DateTime $updated_at
 */
class AuctionListStatus extends BaseEntity
{
    protected $casts = [];

    protected $dates = [
        'updated_at',
    ];
}
