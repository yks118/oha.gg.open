<?php
namespace Modules\Nexon\MabinogiHeroes\Models;

use Modules\Core\Models\BaseModel;

class MetaEnchant extends BaseModel
{
    protected $table = 'nexon_mabinogi_heroes_meta_enchant';

    protected $primaryKey = 'name';

    protected $allowedFields = [
        'type', 'name',
        'grade', 'available_slot_name', 'stat',
    ];

    protected array $searchFields = [
        'grade', 'available_slot_name', 'stat',
    ];

    protected $returnType = \Modules\Nexon\MabinogiHeroes\Entities\MetaEnchant::class;

    protected $useTimestamps = true;

    protected $useSoftDeletes = false;

    protected $createdField = '';

    protected $updatedField = '';

    protected $deletedField = '';

    protected $beforeInsert = [
        'convertArrayToJson',
    ];

    protected $beforeUpdate = [
        'convertArrayToJson',
    ];

    protected bool $cacheUse = true;

    /**
     * @param mixed $id
     * @return \Modules\Nexon\MabinogiHeroes\Entities\MetaEnchant|array|null
     */
    public function find($id = null): \Modules\Nexon\MabinogiHeroes\Entities\MetaEnchant|array|null
    {
        return parent::find($id);
    }

    /**
     * @return \Modules\Nexon\MabinogiHeroes\Entities\MetaEnchant[]|array
     */
    public function findAll(?int $limit = null, int $offset = 0): array
    {
        return parent::findAll($limit, $offset);
    }

    protected function convertArrayToJson(array $data): array
    {
        foreach (['available_slot_name', 'stat'] as $value)
        {
            if (isset($data['data'][$value]))
            {
                if (is_array($data['data'][$value]))
                {
                    $data['data'][$value] = json_encode($data['data'][$value], JSON_UNESCAPED_UNICODE);
                }
                else
                {
                    $data['data'][$value] = '[]';
                }
            }
        }

        return $data;
    }
}
