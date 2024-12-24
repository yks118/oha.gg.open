<?php
namespace Modules\Nexon\Mabinogi\Models;

use CodeIgniter\Database\BaseBuilder;
use Modules\Core\Models\BaseModel;

class AuctionList extends BaseModel
{
    protected $table = 'nexon_mabinogi_auction_list';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'auction_item_category', 'id',
        'item_uuid', 'item_count', 'auction_price_per_unit', 'date_auction_expire',
    ];

    protected array $searchFields = [
        // 'item_name',
        // 'auction_item_category',
    ];

    protected $returnType = \Modules\Nexon\Mabinogi\Entities\AuctionList::class;

    protected $useTimestamps = true;

    protected $useSoftDeletes = false;

    protected $createdField = '';

    protected $updatedField = '';

    protected $deletedField = '';

    protected bool $cacheUse = true;

    /**
     * @param mixed $id
     * @return \Modules\Nexon\Mabinogi\Entities\AuctionList|array|null
     */
    public function find($id = null): \Modules\Nexon\Mabinogi\Entities\AuctionList|array|null
    {
        return parent::find($id);
    }

    /**
     * @return \Modules\Nexon\Mabinogi\Entities\AuctionList[]|array
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
            $this->builder()
                ->whereIn(
                    'item_uuid',
                    function(BaseBuilder $builder) use($matches, $mOption)
                    {
                        $builder
                            ->select('item_uuid')
                            ->from($mOption->builder()->getTable())
                        ;

                        list($type, $subType, $value, $value2) = explode(':', $matches['value']);
                        if ($type)
                        {
                            $builder->where('option_type', $type);
                        }

                        if ($subType)
                        {
                            $builder->where('option_sub_type', $subType);
                        }

                        if ($value)
                        {
                            $builder->where('option_value' . $matches['eq'], $value);
                        }

                        if ($value2)
                        {
                            $builder->where('option_value2' . $matches['eq'], $value2);
                        }

                        return $builder;
                    }
                )
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
