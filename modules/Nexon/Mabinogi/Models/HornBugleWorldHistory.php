<?php
namespace Modules\Nexon\Mabinogi\Models;

use Modules\Core\Models\BaseModel;

class HornBugleWorldHistory extends BaseModel
{
    protected $table = 'nexon_mabinogi_horn_bugle_world_history';

    protected $primaryKey = 'date_send';

    protected $allowedFields = [
        'server_name', 'date_send', 'character_name', 'message',
    ];

    protected array $searchFields = [
        'message',
    ];

    protected $returnType = \Modules\Nexon\Mabinogi\Entities\HornBugleWorldHistory::class;

    protected $useTimestamps = true;

    protected $useSoftDeletes = false;

    protected $createdField = '';

    protected $updatedField = '';

    protected $deletedField = '';

    protected bool $cacheUse = true;

    /**
     * @param mixed $id
     * @return \Modules\Nexon\Mabinogi\Entities\HornBugleWorldHistory|array|null
     */
    public function find($id = null): \Modules\Nexon\Mabinogi\Entities\HornBugleWorldHistory|array|null
    {
        return parent::find($id);
    }

    /**
     * @return \Modules\Nexon\Mabinogi\Entities\HornBugleWorldHistory[]|array
     */
    public function findAll(?int $limit = null, int $offset = 0): array
    {
        return parent::findAll($limit, $offset);
    }
}
