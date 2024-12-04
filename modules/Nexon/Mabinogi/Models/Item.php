<?php
namespace Modules\Nexon\Mabinogi\Models;

use Modules\Core\Models\BaseModel;

class Item extends BaseModel
{
    protected $table = 'nexon_mabinogi_item';

    protected $primaryKey = 'uuid';

    protected $allowedFields = [
        'uuid', 'md5', 'serialize',
        'item_name', 'item_display_name',
    ];

    protected array $searchFields = [];

    protected $returnType = \Modules\Nexon\Mabinogi\Entities\Item::class;

    protected $useTimestamps = true;

    protected $useSoftDeletes = false;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $deletedField = '';

    protected bool $cacheUse = true;

    protected int $cacheTtl = YEAR;

    /**
     * @param mixed $id
     * @return \Modules\Nexon\Mabinogi\Entities\Item|array|null
     */
    public function find($id = null): \Modules\Nexon\Mabinogi\Entities\Item|array|null
    {
        return parent::find($id);
    }

    /**
     * @return \Modules\Nexon\Mabinogi\Entities\Item[]|array
     */
    public function findAll(?int $limit = null, int $offset = 0): array
    {
        return parent::findAll($limit, $offset);
    }
}
