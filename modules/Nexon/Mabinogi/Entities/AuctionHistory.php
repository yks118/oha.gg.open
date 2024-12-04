<?php
namespace Modules\Nexon\Mabinogi\Entities;

use DateTime;
use Modules\Core\Entities\BaseEntity;

/**
 * @property ?int $auction_buy_id
 * @property ?string $item_uuid
 * @property ?int $item_count
 * @property ?int $auction_price_per_unit
 * @property ?DateTime $date_auction_buy
 *
 * @property ?Item $item
 */
class AuctionHistory extends BaseEntity
{
    protected $casts = [
        'auction_buy_id'            => '?int',
        'item_count'                => '?int',
        'auction_price_per_unit'    => '?int',
    ];

    protected $dates = [
        'date_auction_buy',
    ];

    private ?Item $item = null;

    protected function getItem(): Item
    {
        if (is_null($this->item))
        {
            $mItem = model(\Modules\Nexon\Mabinogi\Models\Item::class);
            $this->item = $mItem->find($this->item_uuid);
        }

        return $this->item;
    }

    public function search(string $key): string
    {
        $cCms = core_config_cms();
        $uri = current_url(true);
        switch ($key)
        {
            case 'item_name':
                $uri->addQuery($cCms->searchName, 'item_name:"' . $this->item->item_name . '"');
                break;
        }

        return $uri;
    }
}
