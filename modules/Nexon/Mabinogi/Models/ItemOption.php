<?php
namespace Modules\Nexon\Mabinogi\Models;

use Modules\Core\Models\BaseModel;

class ItemOption extends BaseModel
{
    protected $table = 'nexon_mabinogi_item_option';

    protected $primaryKey = 'item_uuid';

    protected $allowedFields = [
        'item_uuid', 'id',
        'option_type', 'option_sub_type', 'option_value', 'option_value2', 'option_desc',
    ];

    protected array $searchFields = [];

    protected $returnType = \Modules\Nexon\Mabinogi\Entities\ItemOption::class;

    protected $useTimestamps = true;

    protected $useSoftDeletes = false;

    protected $createdField = '';

    protected $updatedField = '';

    protected $deletedField = '';

    protected bool $cacheUse = true;

    protected int $cacheTtl = YEAR;

    /**
     * @param mixed $id
     * @return \Modules\Nexon\Mabinogi\Entities\ItemOption|array|null
     */
    public function find($id = null): \Modules\Nexon\Mabinogi\Entities\ItemOption|array|null
    {
        return parent::find($id);
    }

    /**
     * @return \Modules\Nexon\Mabinogi\Entities\ItemOption[]|array
     */
    public function findAll(?int $limit = null, int $offset = 0): array
    {
        return parent::findAll($limit, $offset);
    }
}
