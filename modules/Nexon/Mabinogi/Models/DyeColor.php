<?php
namespace Modules\Nexon\Mabinogi\Models;

use Modules\Core\Models\BaseModel;

class DyeColor extends BaseModel
{
    protected $table = 'nexon_mabinogi_dye_color';

    protected $primaryKey = 'hex';

    protected $allowedFields = [
        'hex', 'rgb', 'name', 'name_full',
    ];

    protected array $searchFields = [
        'name', 'name_full',
    ];

    protected $returnType = \Modules\Nexon\Mabinogi\Entities\DyeColor::class;

    protected $useTimestamps = true;

    protected $useSoftDeletes = false;

    protected $createdField = '';

    protected $updatedField = '';

    protected $deletedField = '';

    protected bool $cacheUse = true;

    protected int $cacheTtl = DAY;

    /**
     * @param mixed $id
     * @return \Modules\Nexon\Mabinogi\Entities\DyeColor|array|null
     */
    public function find($id = null): \Modules\Nexon\Mabinogi\Entities\DyeColor|array|null
    {
        return parent::find($id);
    }

    /**
     * @return \Modules\Nexon\Mabinogi\Entities\DyeColor[]|array
     */
    public function findAll(?int $limit = null, int $offset = 0): array
    {
        return parent::findAll($limit, $offset);
    }
}
