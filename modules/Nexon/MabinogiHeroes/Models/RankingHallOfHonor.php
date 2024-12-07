<?php
namespace Modules\Nexon\MabinogiHeroes\Models;

use Modules\Core\Models\BaseModel;

class RankingHallOfHonor extends BaseModel
{
    protected $table = 'nexon_mabinogi_heroes_ranking_hall_of_honor';

    protected $primaryKey = 'date';

    protected $allowedFields = [
        'date', 'ranking_type', 'ranking',
        'character_name', 'score',
    ];

    protected array $searchFields = [
        'character_name',
    ];

    protected $returnType = \Modules\Nexon\MabinogiHeroes\Entities\RankingHallOfHonor::class;

    protected $useTimestamps = true;

    protected $useSoftDeletes = false;

    protected $createdField = '';

    protected $updatedField = '';

    protected $deletedField = '';

    protected bool $cacheUse = true;

    /**
     * @param mixed $id
     * @return \Modules\Nexon\MabinogiHeroes\Entities\RankingHallOfHonor|array|null
     */
    public function find($id = null): \Modules\Nexon\MabinogiHeroes\Entities\RankingHallOfHonor|array|null
    {
        return parent::find($id);
    }

    /**
     * @return \Modules\Nexon\MabinogiHeroes\Entities\RankingHallOfHonor[]|array
     */
    public function findAll(?int $limit = null, int $offset = 0): array
    {
        return parent::findAll($limit, $offset);
    }
}
