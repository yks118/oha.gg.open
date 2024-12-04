<?php
namespace Modules\Nexon\Mabinogi\Models;

use Modules\Core\Models\BaseModel;

class ItemColorPart extends BaseModel
{
    protected $table = 'nexon_mabinogi_item_color_part';

    protected $primaryKey = 'item_uuid';

    protected $allowedFields = [
        'item_uuid',
        'a_r', 'a_g', 'a_b',
        'b_r', 'b_g', 'b_b',
        'c_r', 'c_g', 'c_b',
        'd_r', 'd_g', 'd_b',
        'e_r', 'e_g', 'e_b',
        'f_r', 'f_g', 'f_b',
    ];

    protected array $searchFields = [];

    protected $returnType = \Modules\Nexon\Mabinogi\Entities\ItemColorPart::class;

    protected $useTimestamps = true;

    protected $useSoftDeletes = false;

    protected $createdField = '';

    protected $updatedField = '';

    protected $deletedField = '';

    protected bool $cacheUse = true;

    protected int $cacheTtl = YEAR;

    /**
     * @param mixed $id
     * @return \Modules\Nexon\Mabinogi\Entities\ItemColorPart|array|null
     */
    public function find($id = null): \Modules\Nexon\Mabinogi\Entities\ItemColorPart|array|null
    {
        return parent::find($id);
    }

    /**
     * @return \Modules\Nexon\Mabinogi\Entities\ItemColorPart[]|array
     */
    public function findAll(?int $limit = null, int $offset = 0): array
    {
        return parent::findAll($limit, $offset);
    }
}
