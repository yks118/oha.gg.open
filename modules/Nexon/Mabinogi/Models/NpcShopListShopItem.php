<?php
namespace Modules\Nexon\Mabinogi\Models;

use Modules\Core\Models\BaseModel;

class NpcShopListShopItem extends BaseModel
{
    protected $table = 'nexon_mabinogi_npc_shop_list_shop_item';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'npc_shop_list_id', 'id',
        'tab_name', 'item_display_name', 'item_count', 'limit_type', 'limit_value', 'image_url', 'price_type', 'price_value',
    ];

    protected array $searchFields = [
        'item_display_name',
    ];

    protected $returnType = \Modules\Nexon\Mabinogi\Entities\NpcShopListShopItem::class;

    protected $useTimestamps = true;

    protected $useSoftDeletes = false;

    protected $createdField = '';

    protected $updatedField = '';

    protected $deletedField = '';

    protected bool $cacheUse = true;

    /**
     * @param mixed $id
     * @return \Modules\Nexon\Mabinogi\Entities\NpcShopListShopItem|array|null
     */
    public function find($id = null): \Modules\Nexon\Mabinogi\Entities\NpcShopListShopItem|array|null
    {
        return parent::find($id);
    }

    /**
     * @return \Modules\Nexon\Mabinogi\Entities\NpcShopListShopItem[]|array
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
        $fieldNpcShopList = ['server_name', 'npc_name', 'channel'];
        $fieldOption = ['option_type', 'option_sub_type', 'option_value', 'option_value2'];
        if (in_array($matches['field'], $fieldNpcShopList))
        {
            $mNpcShopList = model(\Modules\Nexon\Mabinogi\Models\NpcShopList::class);
            $ids = $mNpcShopList->_search($matches)->findColumn('id');

            $this->builder()->whereIn('npc_shop_list_id', $ids);
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

            $mOption = model(\Modules\Nexon\Mabinogi\Models\NpcShopListShopItemOption::class);
            if ($matches['eq'])
            {
                $list = $mOption->where($matches['field'] . $matches['eq'], $matches['value'])->findAll();
            }
            else
            {
                $list = $mOption->like($matches['field'], $matches['value'])->findAll();
            }

            $this->builder()
                ->whereIn('npc_shop_list_id', array_column($list, 'npc_shop_list_id'))
                ->whereIn('id', array_column($list, 'npc_shop_list_shop_item_id'))
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
