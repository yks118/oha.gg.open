<?php
namespace Modules\Nexon\Mabinogi\Models;

use CodeIgniter\Database\BaseBuilder;
use Modules\Core\Models\BaseModel;

class AuctionHistory extends BaseModel
{
    protected $table = 'nexon_mabinogi_auction_history';

    protected $primaryKey = 'auction_buy_id';

    protected $allowedFields = [
        'auction_buy_id',
        'item_uuid', 'item_count', 'auction_price_per_unit', 'date_auction_buy',
    ];

    protected array $searchFields = [
        'item_name',
    ];

    protected $returnType = \Modules\Nexon\Mabinogi\Entities\AuctionHistory::class;

    protected $useTimestamps = true;

    protected $useSoftDeletes = false;

    protected $createdField = '';

    protected $updatedField = '';

    protected $deletedField = '';

    protected bool $cacheUse = true;

    /**
     * @param mixed $id
     * @return \Modules\Nexon\Mabinogi\Entities\AuctionHistory|array|null
     */
    public function find($id = null): \Modules\Nexon\Mabinogi\Entities\AuctionHistory|array|null
    {
        return parent::find($id);
    }

    /**
     * @return \Modules\Nexon\Mabinogi\Entities\AuctionHistory[]|array
     */
    public function findAll(?int $limit = null, int $offset = 0): array
    {
        return parent::findAll($limit, $offset);
    }

    /**
     * @param array{
     *     or: string,
     *     not: string,
     *     field: string,
     *     eq: string,
     *     value: string,
     * } $matches
     * @return self
     */
    protected function _search(array $matches): self
    {
        $fieldItem = ['item_name'];
        $fieldOption = ['option'];
        if (in_array($matches['field'], $fieldItem))
        {
            $mItem = model(\Modules\Nexon\Mabinogi\Models\Item::class);
            $ids = $mItem
                ->setCacheTtl(MINUTE)
                ->_search($matches)
                ->findColumn('uuid')
            ;

            $this->builder()->whereIn('item_uuid', $ids);
        }
        elseif (in_array($matches['field'], $fieldOption))
        {
            if ($matches['or'])
            {
                if ($matches['not'])
                {
                    $this->builder()->orNotGroupStart();
                }
                else
                {
                    $this->builder()->orGroupStart();
                }
            }
            else
            {
                if ($matches['not'])
                {
                    $this->builder()->notGroupStart();
                }
                else
                {
                    $this->builder()->groupStart();
                }
            }

            $mOption = model(\Modules\Nexon\Mabinogi\Models\ItemOption::class);
            list($type, $subType, $value, $value2) = explode(':', $matches['value']);
            if ($type)
            {
                $mOption->where('option_type', $type);
            }

            if ($subType)
            {
                $mOption->where('option_sub_type', $subType);
            }

            if ($value)
            {
                $mOption->where('option_value' . $matches['eq'], $value);
            }

            if ($value2)
            {
                $mOption->where('option_value2' . $matches['eq'], $value2);
            }
            $itemUuids = $mOption->findColumn('item_uuid');
            $this->builder()
                ->whereIn('item_uuid', $itemUuids)
            ;

            $this->builder()->groupEnd();
        }
        else
        {
            parent::_search($matches);
        }

        return $this;
    }
}
