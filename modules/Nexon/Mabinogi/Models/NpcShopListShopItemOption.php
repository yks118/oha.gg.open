<?php
namespace Modules\Nexon\Mabinogi\Models;

use Modules\Core\Models\BaseModel;

class NpcShopListShopItemOption extends BaseModel
{
    protected $table = 'nexon_mabinogi_npc_shop_list_shop_item_option';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'npc_shop_list_id', 'npc_shop_list_shop_item_id', 'id',
        'option_type', 'option_sub_type', 'option_value', 'option_value2', 'option_desc',
    ];

    protected array $searchFields = [];

    protected $returnType = \Modules\Nexon\Mabinogi\Entities\NpcShopListShopItemOption::class;

    protected $useTimestamps = true;

    protected $useSoftDeletes = false;

    protected $createdField = '';

    protected $updatedField = '';

    protected $deletedField = '';

    protected bool $cacheUse = true;

    /**
     * @param mixed $id
     * @return \Modules\Nexon\Mabinogi\Entities\NpcShopListShopItemOption|array|null
     */
    public function find($id = null): \Modules\Nexon\Mabinogi\Entities\NpcShopListShopItemOption|array|null
    {
        return parent::find($id);
    }

    /**
     * @return \Modules\Nexon\Mabinogi\Entities\NpcShopListShopItemOption[]|array
     */
    public function findAll(?int $limit = null, int $offset = 0): array
    {
        return parent::findAll($limit, $offset);
    }
}
