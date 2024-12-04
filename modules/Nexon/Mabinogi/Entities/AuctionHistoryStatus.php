<?php
namespace Modules\Nexon\Mabinogi\Entities;

use DateTime;
use Modules\Core\Entities\BaseEntity;

/**
 * @property ?string $auction_item_category
 * @property ?string $status
 * @property ?DateTime $date_auction_buy
 * @property ?DateTime $updated_at
 */
class AuctionHistoryStatus extends BaseEntity
{
    protected $casts = [];

    protected $dates = [
        'date_auction_buy',
        'updated_at',
    ];
}
