<?php
namespace Modules\Nexon\Mabinogi\Entities;

use DateTime;
use Modules\Core\Entities\BaseEntity;

/**
 * @property ?string $auction_item_category
 * @property ?int $id
 * @property ?string $item_uuid
 * @property ?int $item_count
 * @property ?int $auction_price_per_unit
 * @property ?DateTime $date_auction_expire
 *
 * @property ?Item $item
 */
class AuctionList extends BaseEntity
{
    protected $casts = [
        'id'                        => '?int',
        'item_count'                => '?int',
        'auction_price_per_unit'    => '?int',
    ];

    protected $dates = [
        'date_auction_expire',
    ];

    private ?Item $item = null;

    protected function getItem(): Item
    {
        if (is_null($this->item))
        {
            $mItem = model(\Modules\Nexon\Mabinogi\Models\Item::class);
            if (empty($this->item_uuid))
            {
                $row = $this->attributes;
                unset($row['item_count']);
                unset($row['auction_price_per_unit']);
                unset($row['date_auction_expire']);
                $serialize = serialize($row);
                $md5 = md5($serialize);
                $this->item = $mItem->where('md5', $md5)->findAll()[0] ?? null;
                if (empty($this->item) || $this->item->serialize !== $serialize)
                {
                    try
                    {
                        nexon_mabinogi_insert_item($this->attributes, $serialize, $md5, 0);
                        $this->item = $mItem->where('md5', $md5)->findAll()[0] ?? null;
                    }
                    catch (\ReflectionException $e)
                    {}
                }
            }
            else
            {
                $this->item = $mItem->find($this->item_uuid);
            }
        }

        return $this->item;
    }

    public function search(string $key): string
    {
        $cCms = core_config_cms();
        $uri = clone current_url(true);
        switch ($key)
        {
            case 'item_name':
                $uri->addQuery($cCms->searchName, 'item_name =:"' . $this->item->item_name . '"');
                break;
        }

        return $uri;
    }
}
