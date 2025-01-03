<?php
namespace Modules\Nexon\MabinogiHeroes\Models;

use Modules\Core\Models\BaseModel;

class MarketplaceGoldTop extends BaseModel
{
    protected $table = 'nexon_mabinogi_heroes_marketplace_gold_top';

    protected $primaryKey = 'date';

    protected $allowedFields = [
        'date', 'type',
        'data',
    ];

    protected array $searchFields = [];

    protected $returnType = \Modules\Nexon\MabinogiHeroes\Entities\MarketplaceGoldTop::class;

    protected $useTimestamps = true;

    protected $useSoftDeletes = false;

    protected $createdField = '';

    protected $updatedField = '';

    protected $deletedField = '';

    protected $beforeInsert = [
        'convertArrayToJson',
    ];

    protected $beforeInsertBatch = [
        'convertArrayToJson',
    ];

    protected $beforeUpdate = [
        'convertArrayToJson',
    ];

    protected $beforeUpdateBatch = [
        'convertArrayToJson',
    ];

    protected array $convertArrayToJsonFields = ['data'];

    protected bool $cacheUse = true;

    /**
     * @param mixed $id
     * @return \Modules\Nexon\MabinogiHeroes\Entities\MarketplaceGoldTop|array|null
     */
    public function find($id = null): \Modules\Nexon\MabinogiHeroes\Entities\MarketplaceGoldTop|array|null
    {
        return parent::find($id);
    }

    /**
     * @return \Modules\Nexon\MabinogiHeroes\Entities\MarketplaceGoldTop[]|array
     */
    public function findAll(?int $limit = null, int $offset = 0): array
    {
        return parent::findAll($limit, $offset);
    }
}
