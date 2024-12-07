<?php
namespace Modules\Nexon\MabinogiHeroes\Models;

use Modules\Core\Models\BaseModel;

class RankingRealTime extends BaseModel
{
    protected $table = 'nexon_mabinogi_heroes_ranking_real_time';

    protected $primaryKey = 'ranking_type';

    protected $allowedFields = [
        'ranking_type', 'ranking',
        'character_name', 'score',
    ];

    protected array $searchFields = [
        'character_name',
    ];

    protected $returnType = \Modules\Nexon\MabinogiHeroes\Entities\RankingRealTime::class;

    protected $useTimestamps = true;

    protected $useSoftDeletes = false;

    protected $createdField = '';

    protected $updatedField = '';

    protected $deletedField = '';

    protected bool $cacheUse = true;

    /**
     * @param mixed $id
     * @return \Modules\Nexon\MabinogiHeroes\Entities\RankingRealTime|array|null
     */
    public function find($id = null): \Modules\Nexon\MabinogiHeroes\Entities\RankingRealTime|array|null
    {
        return parent::find($id);
    }

    /**
     * @return \Modules\Nexon\MabinogiHeroes\Entities\RankingRealTime[]|array
     */
    public function findAll(?int $limit = null, int $offset = 0): array
    {
        return parent::findAll($limit, $offset);
    }
}
