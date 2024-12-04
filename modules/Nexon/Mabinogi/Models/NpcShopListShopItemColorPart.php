<?php
namespace Modules\Nexon\Mabinogi\Models;

use Modules\Core\Models\BaseModel;

class NpcShopListShopItemColorPart extends BaseModel
{
    protected $table = 'nexon_mabinogi_npc_shop_list_shop_item_color_part';

    protected $primaryKey = 'npc_shop_list_id';

    protected $allowedFields = [
        'npc_shop_list_id', 'npc_shop_list_shop_item_id',
        'a_r', 'a_g', 'a_b',
        'b_r', 'b_g', 'b_b',
        'c_r', 'c_g', 'c_b',
    ];

    protected array $searchFields = [];

    protected $returnType = \Modules\Nexon\Mabinogi\Entities\NpcShopListShopItemColorPart::class;

    protected $useTimestamps = true;

    protected $useSoftDeletes = false;

    protected $createdField = '';

    protected $updatedField = '';

    protected $deletedField = '';

    protected bool $cacheUse = true;

    /**
     * @param mixed $id
     * @return \Modules\Nexon\Mabinogi\Entities\NpcShopListShopItemColorPart|array|null
     */
    public function find($id = null): \Modules\Nexon\Mabinogi\Entities\NpcShopListShopItemColorPart|array|null
    {
        return parent::find($id);
    }

    /**
     * @return \Modules\Nexon\Mabinogi\Entities\NpcShopListShopItemColorPart[]|array
     */
    public function findAll(?int $limit = null, int $offset = 0): array
    {
        return parent::findAll($limit, $offset);
    }
}
